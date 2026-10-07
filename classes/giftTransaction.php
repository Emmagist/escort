<?php

class GiftTransaction
{
    private Database $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    /**
     * Send a gift to a live streamer.
     *
     * Sender coins are deducted.
     * Streamer coins are credited.
     * Gift transaction is recorded.
     *
     * Everything happens inside one database transaction.
     */
    public function sendGift(string $streamGuid, string $senderId, string $giftGuid, int $quantity = 1): array {
        $streamGuid = trim($streamGuid);
        $senderId   = trim($senderId);
        $giftGuid   = trim($giftGuid);

        $quantity = max(1, min($quantity, 100));

        if ($streamGuid === '' || $senderId === '' || $giftGuid === '') {
            return [
                'success' => false,
                'message' => 'Invalid request'
            ];
        }

        $streamGuidEsc = $this->db->escape($streamGuid);
        $senderIdEsc   = $this->db->escape($senderId);
        $giftGuidEsc   = $this->db->escape($giftGuid);

        /*
        |--------------------------------------------------------------------------
        | Get stream
        |--------------------------------------------------------------------------
        */
        $stream = $this->db->singleData(TBL_STREAMS, "stream_guid, user_id, status", "stream_guid = '$streamGuidEsc'");

        if (!$stream) {
            return [
                'success' => false,
                'message' => 'Stream not found'
            ];
        }

        if ($stream['status'] !== 'live') {
            return [
                'success' => false,
                'message' => 'Stream is no longer live'
            ];
        }

        $streamerId = trim((string)$stream['user_id']);

        /*
        |--------------------------------------------------------------------------
        | Prevent streamer from gifting himself
        |--------------------------------------------------------------------------
        */

        if ($senderId === $streamerId) {
            return [
                'success' => false,
                'message' => 'You cannot send a gift to yourself'
            ];
        }

        /*
        |--------------------------------------------------------------------------
        | Get gift
        |--------------------------------------------------------------------------
        |
        | IMPORTANT:
        | gift_guid is the identifier.
        | There is no numeric gift ID.
        |
        */

        $gift = $this->db->singleData(TBL_LIVE_GIFTS, "*", "gift_guid = '$giftGuidEsc' AND is_active = 1");

        if (!$gift) {
            return [
                'success' => false,
                'message' => 'Gift not available'
            ];
        }

        $giftPrice = (int)$gift['coins'];
        $streamerCoinsPerGift = (int)$gift['streamer_coins'];

        $totalCoins = $giftPrice * $quantity;
        $totalStreamerCoins = $streamerCoinsPerGift * $quantity;

        if ($totalCoins <= 0) {
            return [
                'success' => false,
                'message' => 'Invalid gift price'
            ];
        }

        /*
        |--------------------------------------------------------------------------
        | Start database transaction
        |--------------------------------------------------------------------------
        */

        $this->db->myconn->begin_transaction();

        try {

            /*
            |--------------------------------------------------------------------------
            | Lock sender wallet
            |--------------------------------------------------------------------------
            */

            $senderWallet = $this->db->singleData(TBL_LIVE_COIN_WALLETS, "wallet_guid, user_id, coins", "user_id = '$senderIdEsc'");

            // if (!$senderWallet) {
            //     throw new Exception('Unable to access sender wallet');
            // }

            /*
            |--------------------------------------------------------------------------
            | Create sender wallet if it does not exist
            |--------------------------------------------------------------------------
            */
            if (!$senderWallet) {
                $walletGuid = 'cw_' . bin2hex(random_bytes(24));
                $walletGuidEsc = $this->db->escape($walletGuid);

                $created = $this->db->saveData(TBL_LIVE_COIN_WALLETS, "wallet_guid = uuid(), user_id = '$senderIdEsc', coins = 0");

                if (!$created) {
                    throw new Exception('Unable to create sender wallet');
                }

                $senderBalance = 0;

            } else {

                $senderBalance = (int)$senderWallet['coins'];
            }

            /*
            |--------------------------------------------------------------------------
            | Check sender balance
            |--------------------------------------------------------------------------
            */

            if ($senderBalance < $totalCoins) {

                throw new Exception('Insufficient coin balance');
            }

            $senderNewBalance = $senderBalance - $totalCoins;

            /*
            |--------------------------------------------------------------------------
            | Deduct sender coins
            |--------------------------------------------------------------------------
            */

            $deducted = $this->db->update(
                TBL_LIVE_COIN_WALLETS, "coins = '$senderNewBalance'", "user_id = '$senderIdEsc'");

            if (!$deducted) {
                throw new Exception('Unable to deduct coins');
            }

            /*
            |--------------------------------------------------------------------------
            | Streamer wallet
            |--------------------------------------------------------------------------
            */

            $streamerIdEsc = $this->db->escape($streamerId);

            $streamerWallet = $this->db->singleData(TBL_LIVE_COIN_WALLETS, "wallet_guid, user_id, coins", "user_id = '$streamerIdEsc'");

            // if (!$streamerWallet) {
            //     throw new Exception('Unable to access streamer wallet');
            // }

            /*
            |--------------------------------------------------------------------------
            | Create streamer wallet if not exist
            |--------------------------------------------------------------------------
            */
            if (!$streamerWallet) {
                $createdStreamerWallet = $this->db->saveData(TBL_LIVE_COIN_WALLETS, "wallet_guid = uuid(), user_id = '$streamerIdEsc', coins = 0");

                if (!$createdStreamerWallet) {
                    throw new Exception('Unable to create streamer wallet');
                }

                $streamerBalance = 0;

            } else {

                $streamerBalance = (int)$streamerWallet['coins'];
            }

            $streamerNewBalance = $streamerBalance + $totalStreamerCoins;

            /*
            |--------------------------------------------------------------------------
            | Credit streamer coins
            |--------------------------------------------------------------------------
            */
            if ($totalStreamerCoins > 0) {
                $balanceUpdated = $this->db->update(TBL_LIVE_COIN_WALLETS, "coins = '$streamerNewBalance'", "user_id = '$streamerIdEsc'");

                if (!$balanceUpdated) {
                    throw new Exception('Unable to credit streamer coins');
                }
            }

            /*
            |--------------------------------------------------------------------------
            | Record gift transaction
            |--------------------------------------------------------------------------
            |
            |
            |
            */
            $inserted = $this->db->saveData(TBL_LIVE_GIFT_TRANSACTIONS, "transaction_guid = uuid(), stream_guid = '$streamGuidEsc', sender_id = '$senderIdEsc', streamer_id = '$streamerIdEsc', gift_id = '$giftGuidEsc', quantity = '$quantity', coins_spent = '$totalCoins', streamer_coins = '$totalStreamerCoins'");

            if (!$inserted) {
                throw new Exception('Unable to record gift transaction');
            }

            /*
            |--------------------------------------------------------------------------
            | Record sender coin transaction
            |--------------------------------------------------------------------------
            */
            $senderTransactionGuid = 'ctx_' . bin2hex(random_bytes(24));
            $senderTransactionGuidEsc = $this->db->escape($senderTransactionGuid);

            $senderDescription = $this->db->escape("Sent {$quantity} x {$gift['name']} gift");

            $transactionGuid = 'ctx_' . bin2hex(random_bytes(26));
            $senderReference = $this->db->escape($transactionGuid);

            $senderTransaction = $this->db->saveData(TBL_COIN_TRANSACTION, "transaction_guid = uuid(), user_id = '$senderIdEsc', type = 'gift_sent', coins = '$totalCoins', balance_before = '$senderBalance', balance_after = '$senderNewBalance', reference = '$senderReference', description = '$senderDescription', status = 'successful'");

            if (!$senderTransaction) {
                throw new Exception('Unable to record sender coin transaction');
            }

            /*
            |--------------------------------------------------------------------------
            | Record streamer coin transaction
            |--------------------------------------------------------------------------
            */
            if ($totalStreamerCoins > 0) {
                $streamerDescription = $this->db->escape("Received {$quantity} x {$gift['name']} gift");

                $streamerReference = $this->db->escape($transactionGuid);

                $streamerTransaction = $this->db->saveData(TBL_COIN_TRANSACTION, "transaction_guid = uuid(), user_id = '$streamerIdEsc', type = 'gift_received', coins = $totalStreamerCoins, balance_before = $streamerBalance, balance_after = $streamerNewBalance, reference = '$streamerReference', description = '$streamerDescription', status = 'successful' ");

                if (!$streamerTransaction) {
                    throw new Exception(
                        'Unable to record streamer coin transaction'
                    );
                }
            }

            /*
            |--------------------------------------------------------------------------
            | Commit everything
            |--------------------------------------------------------------------------
            */
            $this->db->myconn->commit();

            return [
                'success' => true,
                'message' => 'Gift sent successfully',
                'gift' => [
                    'gift_guid' => $gift['gift_guid'],
                    'name' => $gift['name'],
                    'icon' => $gift['icon'],
                    'quantity' => $quantity
                ],
                'coins_spent' => $totalCoins,
                'streamer_coins' => $totalStreamerCoins,
                'balance' => $senderNewBalance,
                'transaction_guid' => $transactionGuid
            ];
        } catch (Throwable $e) {
            /*
            |--------------------------------------------------------------------------
            | Rollback
            |--------------------------------------------------------------------------
            */

            $this->db->myconn->rollback();

            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    /**
     * Get user's current coin balance.
     */
    public function getBalance(string $userId): int
    {
        $userId = trim($userId);

        if ($userId === '') {
            return 0;
        }

        $userIdEsc = $this->db->escape($userId);

        $wallet = $this->db->singleData(TBL_LIVE_COIN_WALLETS, "coins", "user_id = '$userIdEsc'");

        if (!$wallet) {
            return 0;
        }

        return (int)$wallet['coins'];
    }
}
$giftTransactionModel = new GiftTransaction($db);