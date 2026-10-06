<?php

class CoinPackage
{
    private Database $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }


    /**
     * Get all active coin packages.
     */
    public function getActivePackages(): array{
        $rows = $this->db->selectLimitAsc(TBL_COINS_PACKAGES, '*', 'is_active = 1', 'sort_order', 200);

        return is_array($rows) ? $rows : [];
    }


    /**
     * Find package by ID.
     */
    public function findByGuid(string $package_guid): ?array
    {
        if ($package_guid === '') {
            return null;
        }

        $packageGuid = $this->db->escape($package_guid);

        $package = $this->db->singleData(TBL_COINS_PACKAGES, "*", "package_guid = '$packageGuid' AND is_active = 1");

        return $package ?: null;
    }
}


$coinPackage = new CoinPackage($db);