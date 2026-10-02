<?php

class LiveLike
{
    private Database $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function like(string $streamGuid, string $userId): array {

        $streamGuid = trim($streamGuid);
        $userId = trim($userId);

        if ($streamGuid === '' || $userId === '') {
            return [
                'success' => false,
                'message' => 'Invalid request'
            ];
        }

        $streamGuidEsc = $this->db->escape($streamGuid);
        $userIdEsc = $this->db->escape($userId);

        $stream = $this->db->singleData(TBL_STREAMS, "stream_guid,user_id,status", "stream_guid = '$streamGuidEsc'");

        if (!$stream || $stream['status'] !== 'live') {
            return [
                'success' => false,
                'message' => 'Stream is not live'
            ];
        }

        $sql = "
            INSERT IGNORE INTO live_likes
            (live_likes_guid, stream_guid, user_id)
            VALUES
            (uuid(), '$streamGuidEsc', '$userIdEsc')
        ";

        $this->db->myconn->query($sql);

        $countResult = $this->db->myconn->query("SELECT COUNT(*) AS total FROM live_likes WHERE stream_guid = '$streamGuidEsc'");

        $count = 0;

        if ($countResult) {
            $row = $countResult->fetch_assoc();
            $count = (int)$row['total'];
        }

        return [
            'success' => true,
            'liked' => true,
            'count' => $count
        ];
    }

    public function hasLiked(string $streamGuid, string $userId): bool {

        $streamGuid = $this->db->escape($streamGuid);
        $userId = $this->db->escape($userId);

        $row = $this->db->selectData(TBL_LIVE_LIKES,"live_likes_guid", "stream_guid = '$streamGuid', user_id = '$userId'");

        return !empty($row);
    }
}

$likeModel = new LiveLike($db);