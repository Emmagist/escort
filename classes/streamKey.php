<?php

class StreamKey{

    private Database $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function create(string $streamGuid): bool {

        $key = 'sk_' . bin2hex(random_bytes(32));

        $streamGuide = $this->db->escape($streamGuid);

        if (empty($streamGuide)) {
            return false;exit;
        }

        $create = $this->db->saveData(TBL_STREAM_KEYS, "st_key_guid = uuid(), stream_id = '$streamGuide', stream_key = '$key'");

        if ($create) {
            return $create;exit;
        }

        return false;
    }

    public function findActive(string $key): ?array {

        $key_string = $this->db->escape($key);

        if (empty($key_string)) {
            return null;exit;
        }

        $active = $this->db->singleData(TBL_STREAM_KEYS, "*", "stream_key = '$key_string', is_active = 1");

        return $active ?: null;
    }

    public function deactivate(string $key): bool {

        $key_string = $this->db->escape($key);

        if (empty($key_string)) {
            return false;exit;
        }

        $deactivate = $this->db->update(TBL_STREAM_KEYS, "is_active = 0", "stream_key = '$key_string'"
        );

        return $deactivate;
    }
}

$streamKeyModel = new StreamKey($db);