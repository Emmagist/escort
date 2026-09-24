<?php

class LiveFollow
{
    private Database $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function follow(string $followerId, string $streamerId): bool {

        if (
            trim($followerId) === '' || trim($streamerId) === '') {
            return false;exit;
        }

        if ($followerId === $streamerId) {
            return false;exit;
        }

        $followerId = $this->db->escape($followerId);
        $streamerId = $this->db->escape($streamerId);

        return (bool)$this->db->saveData(TBL_LIVE_FOLLOW, "live_follw_guid = uuid(), follower_id = '$followerId', streamer_id = '$streamerId'");
    }

    public function unfollow(string $followerId, string $streamerId): bool {

        $followerId = $this->db->escape($followerId);
        $streamerId = $this->db->escape($streamerId);

        return (bool)$this->db->erase(TBL_LIVE_FOLLOW, "follower_id = '$followerId', streamer_id = '$streamerId'");
    }

    public function isFollowing(string $followerId, string $streamerId): bool {

        $followerId = $this->db->escape($followerId);
        $streamerId = $this->db->escape($streamerId);

        $row = $this->db->singleData(TBL_LIVE_FOLLOW, "live_follw_guid", "follower_id = '$followerId', streamer_id = '$streamerId'");

        return !empty($row);
    }
}

$followModel = new LiveFollow($db);