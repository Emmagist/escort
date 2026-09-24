<?php

class LiveGift
{
    private Database $db;


    public function __construct(Database $db)
    {
        $this->db = $db;
    }


    /*
    |--------------------------------------------------------------------------
    | Get available gifts
    |--------------------------------------------------------------------------
    */

    public function getAvailableGifts(): array
    {
        $gifts = $this->db->selectLimitSort(TBL_LIVE_GIFTS, "*", "is_active = 1", "price ASC", "100");

        return is_array($gifts) ? $gifts : [];
    }


    /*
    |--------------------------------------------------------------------------
    | Find gift
    |--------------------------------------------------------------------------
    */

    public function find(string $giftGuid): ?array
    {
        $giftGuid = $this->db->escape($giftGuid);

        if ($giftGuid === '') {
            return null;
        }

        $gift = $this->db->singleData(TBL_LIVE_GIFTS, "*", "gift_guid = '$giftGuid' AND is_active = 1");

        return $gift ?: null;
    }


    /*
    |--------------------------------------------------------------------------
    | Send gift
    |--------------------------------------------------------------------------
    */

    public function send(string $streamGuid, string $senderId, string $streamerId, string $giftGuid, int $quantity = 1): array {

        $sender_id = $this->db->escape($senderId);

        $quantity = max(1, min($quantity, 100));

        $gift = $this->find($giftGuid);

        if (!$gift) {

            return [
                'success' => false,
                'message' => 'Gift not found'
            ];
        }

        $coinsRequired = (int) $gift['price'] * $quantity;

        $streamerValue = (int) $gift['streamer_value'] * $quantity;

        $wallet = $this->db->singleData(TBL_LIVE_COIN_WALLETS, "*", "user_id = '$sender_id'");

        if (!$wallet) {
            return [
                'success' => false,
                'message' => 'Gift wallet not found'
            ];
        }


        $balance =
            (int) $wallet['balance'];


        if ($balance < $coinsRequired) {

            return [
                'success' => false,
                'message' => 'Insufficient gift balance',
                'required' => $coinsRequired,
                'balance' => $balance
            ];
        }


        /*
        |--------------------------------------------------------------------------
        | Deduct coins
        |--------------------------------------------------------------------------
        */

        $walletGuid =
            (int) $wallet['wallet_guid'];


        $deduct = $this->db->update(TBL_LIVE_COIN_WALLETS, "balance = balance - $coinsRequired", "wallet_guid = '$walletGuid' AND balance >= $coinsRequired");

        if (!$deduct) {

            return [
                'success' => false,
                'message' => 'Unable to process gift payment'
            ];
        }


        /*
        |--------------------------------------------------------------------------
        | Save gift transaction
        |--------------------------------------------------------------------------
        */

        $transactionGuid = bin2hex(random_bytes(20));


        $streamGuidEscaped = $this->db->escape($streamGuid);

        $senderIdEscaped = $this->db->escape($senderId);

        $streamerIdEscaped = $this->db->escape($streamerId);

        $giftGuidEscaped = $this->db->escape($giftGuid);


        $saved = $this->db->saveData(TBL_LIVE_GIFT_TRANSACTIONS, "transaction_guid = uuid(), stream_guid = '$streamGuidEscaped', gift_guid = '$giftGuidEscaped', sender_id = '$senderIdEscaped', streamer_id = '$streamerIdEscaped', quantity = '$quantity', coins_spent = '$coinsRequired', streamer_value = '$streamerValue'");

        if (!$saved) {

            /*
             * In production this should be inside
             * a database transaction so the coin
             * deduction can be rolled back.
             */

            return [
                'success' => false,
                'message' => 'Gift transaction could not be saved'
            ];
        }


        return [

            'success' => true,

            'message' => 'Gift sent',

            'gift' => $gift,

            'quantity' => $quantity,

            'coins_spent' => $coinsRequired,

            'balance' => $balance - $coinsRequired
        ];
    }
}

$liveGiftModel = new LiveGift($db);
