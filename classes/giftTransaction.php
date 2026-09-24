<?php

class GiftTransaction{
    private Database $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function sendGift(string $streamGuid, string $senderId, string $giftGuid, int $quantity = 1): array{

        $quantity = max(1, min($quantity, 100));

        $streamGuidEsc = $this->db->escape($giftGuid);
        $senderIdEsc = $this->db->escape($senderId);
        $quantityEsc = $this->db->escape($quantity);
        $giftGuidEsc = $this->db->escape($giftGuid);

        if($streamGuidEsc === '' || $senderIdEsc === '' || $giftGuidEsc === '' || $quantityEsc === ''){
            return [
                'success' => false,
                'message' => 'Invalid request'
            ];
        }

        // Get Stream
        $stream = $this->db->singleData(TBL_STREAMS, "stream_guid, user_id, status", "stream_guid = '$streamGuidEsc");

        if(!$stream || $stream['status'] !== 'live'){
            return [
                'success' => false,
                'message' => 'Stream is no longer live'
            ];
        }

        $streamerId = $stream['user_id'];

        if($senderIdEsc === $streamerId){
            return [
                'success' => false,
                'message' => 'You cannot send gift to yourself'
            ];
        }

        // Get Gift from Database
        $gift = $this->db->singleData(TBL_LIVE_GIFTS, "*", "gift_guid = '$giftGuidEsc', is_active = 1");

        if(!$gift){
            return [
                'success' => false,
                'message' => 'Gift not found'
            ];
        }

        $coins = (int)$gift['coins'];
        $streamerCoins = (int)$gift['streamer_coins'];

        $totalCoins = $coins * $quantityEsc;
        $totalStreamerCoins = $streamerCoins * $quantityEsc;

        // Start Transaction
        $this->db->myconn->begin_transaction();

        try {
            $wallet = $this->db->singleData(TBL_LIVE_GIFT_WALLETS, "coins", "user_id = '$senderIdEsc'");

            if($wallet['coins'] <= $totalCoins){
                $this->db->myconn->close();

                throw new Exception('Insufficient coin balance');
            }

            $this->db->myconn->close();

            // Record transaction
            $transaction = $this->db->saveData(TBL_LIVE_GIFT_TRANSACTIONS, "transaction_guid = uuid(), stream_guid = '$streamGuidEsc', sender_id = '$senderIdEsc', streamer_id = '$streamerId', gift_id = '$giftGuidEsc', quantity = '$quantityEsc', coins_spent = '$totalCoins', streamer_coins = '$totalStreamerCoins");

            $this->db->myconn->close();
            $this->db->myconn->commit();

            // New Balance
            $balance = $this->getBalance($giftGuidEsc);

            return [
                'success' => true,
                'gift' => [
                    'id' => $gift['gift_guid'],
                    'name' => $gift['name'],
                    'icon' => $gift['icon'],
                    'quantity' => $quantityEsc
                    ],
                'coins_spent' => $totalCoins,
                'balance' => $balance
            ];
        } catch (Throwable $e) {
            $this->db->myconn->rollback();

            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    private function getBalance($userId): int{
        $userIdEsc = $this->db->escape($userId);

        $row = $this->db->singleData(TBL_LIVE_GIFT_WALLETS, "coins", "user_id = '$userIdEsc");

        return (int)$row['coins'];
    }
}

$giftTransactionModel = new GiftTransaction($db);