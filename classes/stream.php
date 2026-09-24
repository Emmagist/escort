<?php
class Stream{

    private Database $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function create(string $userId, string $title): ?string {

        $slug = strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', trim($title)));

        $slug .= '-' . bin2hex(random_bytes(4));

        $roomName = 'stream-' . bin2hex(random_bytes(16));

        $user = $this->db->escape($userId);
        $titles = $this->db->escape($title);

        if (empty($user) || empty($titles)) {
            return null;exit;
        }

        $stream_id = $this->db->saveData(TBL_STREAMS, "stream_guid = uuid(), user_id = '$user', title = '$titles', slug = '$slug', room_name = '$roomName', status = 'scheduled'");

        if($stream_id) {

            $stream = $this->db->singleData(TBL_STREAMS, "stream_guid, room_name", "id = '$stream_id'");

            $streamGuid = $stream['stream_guid'];

            return  $streamGuid;exit;
        }

        return null;
        
    }

    public function find(string $streamGuid): ?array {

        $stream_Guid = $this->db->escape($streamGuid);

        if (empty($stream_Guid)) {
            return null;exit;
        }

        $stream = $this->db->singleData(TBL_STREAMS, "*", "stream_guid = '$stream_Guid'");

        return $stream ?: null;
    }

    public function findBySlug(string $slug): ?array {

        $slug_code = $this->db->escape($slug);

        if (empty($slug_code)) {
            return null;exit;
        }

        $stream = $this->db->singleData(TBL_STREAMS, "*", "slug = '$slug_code'");

        return $stream ?: null;
    }

    public function start(string $streamGuid): bool {

        $stream_Guid = $this->db->escape($streamGuid);

        if (empty($stream_Guid)) {
            return false;exit;
        }

        $start = $this->db->update(TBL_STREAMS, "status = 'live', started_at = COALESCE(started_at, NOW())", "stream_guid = '$stream_Guid'");

        return $start;
    }

    public function end(string $streamGuid): bool {

        $stream_Guid = $this->db->escape($streamGuid);

        if (empty($stream_Guid)) {
            return false;exit;
        }

        $end = $this->db->update(TBL_STREAMS, "status = 'ended', ended_at = NOW()", "stream_guid = '$stream_Guid'");

        return $end;
    }

    public function increaseViewers( string $streamGuid): bool {

        $stream_Guid = $this->db->escape($streamGuid);

        if (empty($stream_Guid)) {
            return false;exit;
        }

        $increaseViewers = $this->db->update(TBL_STREAMS, "viewer_count = viewer_count + 1", "stream_guid = '$stream_Guid'");

        return $increaseViewers;
    }

    public function decreaseViewers(string $streamGuid): bool {

        $stream_Guid = $this->db->escape($streamGuid);

        if (empty($stream_Guid)) {
            return false;exit;
        }

        $decreaseViewers = $this->db->update(TBL_STREAMS, "viewer_count = GREATEST(viewer_count - 1, 0)", "stream_guid = '$stream_Guid'");

        return $decreaseViewers;
    }

    public function getLiveStreams(int $limit = 50): array
    {
        $limit = max(1, min($limit, 100));

        $streams = $this->db->selectLimitSort(TBL_STREAMS, "*", "status = 'live' AND is_public = 1", "viewer_count DESC, started_at DESC", $limit);

        return is_array($streams) ? $streams : [];
    }

}

$streamModel = new Stream($db);