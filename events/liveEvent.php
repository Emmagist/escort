
<?php

class LiveEvent
{
    private Database $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function publish(string $streamGuid, string $userId, string $eventType, array $payload = []): bool {
        $allowedTypes = [
            'like', 'follow', 'share', 'gift', 'join'
        ];

        $streamGuid = trim($streamGuid);
        $userId = trim($userId);

        if ($streamGuid === '' || $userId === '' || !in_array($eventType, $allowedTypes, true)) {
            return false;
        }

        $json = json_encode($payload, JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);

        $stm = $this->db->saveData(TBL_STREAM_EVENTS, "event_guid = uuid(), stream_guid = '$streamGuid', actor_user_id = '$userId', event_type = '$eventType', payload = '$json'");

        return $stm;
    }

    public function getSince(string $streamGuid, int $afterId = 0, int $limit = 100): array {
        $afterId = max(0, $afterId);
        $limit = max(1, min($limit, 100));

        // On first load, don't replay the stream's entire history.
        if ($afterId === 0) {
            $result = $this->db->selectLimitAsc(TBL_STREAM_EVENTS, "event_guid, actor_user_id, event_type, payload, created_at", "stream_guid = '$streamGuid' AND id > '$afterId' AND created_at >= DATE_SUB(NOW(), INTERVAL 60 SECOND)", "id", "$limit");
        } else {
            $result = $this->db->selectLimitAsc(TBL_STREAM_EVENTS, "event_guid, actor_user_id, event_type, payload, created_at", "stream_guid = '$streamGuid' AND id > '$afterId'", "id", "$limit");
        }

        $events = [];

        if ($result) {
            $payload = json_decode($result['payload'], true);

            $events[] = [
                'id' => $result['event_guid'],
                'user_id' => $result['actor_user_id'],
                'type' => $result['event_type'],
                'payload' => is_array($payload) ? $payload : [],
                'created_at' => $result['created_at']
            ];
        }

        return $events;
    }
}
$eventsModel = new LiveEvent($db);