<?php

class CoinWallet
{
    private Database $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }


    /**
     * Get or create user's coin wallet.
     */
    public function getOrCreate(string $userId): ?array
    {
        $userId = trim($userId);

        if ($userId === '') {
            return null;
        }

        $userIdEsc = $this->db->escape($userId);

        $wallet = $this->db->singleData(TBL_LIVE_COIN_WALLETS, "*", "user_id = '$userIdEsc'");

        if ($wallet) {
            return $wallet;exit;
        }

        $walletGuid = $this->db->escape('cw_' . bin2hex(random_bytes(24)));

        $created = $this->db->saveData(TBL_LIVE_COIN_WALLETS, "wallet_guid = uuid(), user_id = '$userIdEsc', coins = 0");

        if (!$created) {
            return null;
        }

        return $this->db->singleData(TBL_LIVE_COIN_WALLETS, "*", "user_id = '$userIdEsc'") ?: null;
    }


    /**
     * Get balance.
     */
    public function getBalance(string $userId): int{
        $wallet = $this->getOrCreate($userId);

        if (!$wallet) {
            return 0;
        }

        return (int)$wallet['coins'];
    }


    /**
     * Credit coins.
     */
    public function credit(string $userId, int $coins, string $reference = '', string $description = '' ): ?array {

        if ($coins <= 0) {
            return null;
        }

        $userId = trim($userId);

        if ($userId === '') {
            return null;
        }

        $userIdEsc = $this->db->escape($userId);

        $wallet = $this->getOrCreate($userIdEsc);

        if (!$wallet) {
            return null;
        }

        $before = (int)$wallet['coins'];
        $after = $before + $coins;

        $referenceEsc = $this->db->escape(trim($reference));

        $descriptionEsc = $this->db->escape(trim($description));

        $transactionGuid = $this->db->escape('ctx_' . bin2hex(random_bytes(24)));

        $updated = $this->db->update(TBL_LIVE_COIN_WALLETS, "coins = '$after'", "user_id = '$userIdEsc'");

        if (!$updated) {
            return null;
        }

        $inserted = $this->db->saveData(TBL_COIN_TRANSACTION, "transaction_guid = uuid(), user_id = '$userIdEsc', type = 'purchase', coins = '$coins', balance_before = '$before', balance_after = '$after', reference = '$referenceEsc', description = '$descriptionEsc', status = 'successful'");

        if (!$inserted) {
            return null;
        }

        return [
            'balance_before' => $before,
            'coins' => $coins,
            'balance_after' => $after,
            'transaction_guid' => $transactionGuid
        ];
    }
}


$coinWallet = new CoinWallet($db);