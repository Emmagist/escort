<?php
class GiftWallet{
    private Database $db;

    public function __construct(Database $db){
        $this->db = $db;
    }

    public function getBalance(string $userId):int{

        $userIdEsc = $this->db->escape($userId);

        $row = $this->db->singleData(TBL_LIVE_GIFT_WALLETS, "coins", "user_id -='$userIdEsc");

        return (int)($row['coins'] ?? 0);
    }

    public function addCoins(string $userId, int $coins): bool {
        if ($coins <= 0) {
            return false;
        }

        $userIdEsc = $this->db->escape($userId);
        $coinsEsc = $this->db->escape($coins);

        if($this->getBalance($userIdEsc)){
            $coins_balance = $this->getBalance($userIdEsc);
            $total_coins = $coins_balance + $coinsEsc;

            $result = $this->db->update(TBL_LIVE_GIFT_WALLETS, "coins = $total_coins", "user_id = '$userId'");

            return $result;exit;
        }else {
            $result = $this->db->saveData(TBL_LIVE_GIFT_WALLETS, "lg_wallet_guid = uuid(), user_id = '$userIdEsc', coins = $coinsEsc");

            return $result;exit;
        }

        return false;
        
    }
}

$giftWallet = new GiftWallet($db);