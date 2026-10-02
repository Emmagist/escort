<?php

class LiveChat
{
    private Database $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function send(string $streamGuid, string $userId, string $message): ?array {

        $streamGuid = trim($streamGuid);
        $userId = trim($userId);
        $message = trim($message);

        if ($streamGuid === '' || $userId === '' || $message === '') {
            return null;
        }

        $message = mb_substr($message, 0, 500);

        $streamGuidEsc = $this->db->escape($streamGuid);
        $userIdEsc = $this->db->escape($userId);
        $messageEsc = $this->db->escape($message);

        $ok = $this->db->myconn->query("
            INSERT INTO live_messages
            (
                message_guid,
                stream_guid,
                user_id,
                message
            )
            VALUES
            (
                UUID(),
                '$streamGuidEsc',
                '$userIdEsc',
                '$messageEsc'
            )
        ");

        if (!$ok) {
            return null;
        }

        return [
            'message' => $message
        ];
    }

    public function getMessages(string $streamGuid, int $afterId = 0, int $limit = 50): array {

        $streamGuid = $this->db->escape($streamGuid);

        $afterId = max(0, $afterId);
        $limit = max(1, min($limit, 100));

        $rows = [];

        $rows = $this->db->selectLimitAsc(TBL_LIVE_MESSAGES, "*", "stream_guid = '$streamGuid' AND is_deleted = 0 AND id > $afterId", "id", $limit);

        if (!is_array($rows)) {
            return [];
        }

        return $rows;
    }
}

$liveChat = new LiveChat($db);