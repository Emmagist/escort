<?php

require_once "../config/db.php";
// require_once "../phpMailer.php";
require_once "../vendor/autoload.php";

class Ajax
{
    // public static function getInvestmentProfit($plan, $amount)
    // {
    //     global $db;

    //     $gets = $db->singleData(TBL_PLAN, "percentage", "id = '$plan'");

    //     foreach ($gets as $get) { //echo $get['percentage'];exit;
    //         $profit = number_format(($get['percentage'] / 100) * $amount);
    //     }

    //     return $profit;
    // }

    public static function getUserByEmail($email){
        global $db;
        return $db->selectData(TBL_USERS, "*", "email = '$email'");
    }

    public static function getSideBarLists(){
        global $db;
        return $db->selectData(TBL_CATEGORY, "*");
    }

    public static function getAllEscortsBySlug($slug){
        global $db;
        $rows = [];
        $result = $db->query("SELECT * FROM " . TBL_ESCORTS . "
                 INNER JOIN " . TBL_USERS . " 
                 ON " . TBL_USERS . ".user_guid = " . TBL_ESCORTS . ".user_id 
                 WHERE " . TBL_ESCORTS . ".category_id = '$slug'
            ");
        if (!empty($result)) {
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
            return $rows;
        }
    }

    public static function getEscortById($token){
        global $db;

        $rows = [];
        $result = $db->query("SELECT * FROM " . TBL_ESCORTS . "
                 INNER JOIN " . TBL_USERS . " 
                 ON " . TBL_USERS . ".user_guid = " . TBL_ESCORTS . ".user_id
                 INNER JOIN " . TBL_CATEGORY . "
                 ON " . TBL_CATEGORY . ".token_guid = " . TBL_ESCORTS . ".category_id 
                 WHERE " . TBL_ESCORTS . ".entity_guid = '$token'
            ");
        if (!empty($result)) {
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
            return $rows;
        }
    }

    public static function getSugarById($token){
        global $db;

        $rows = [];
        $result = $db->query("SELECT * FROM " . TBL_SUGAR_CONNECT . "
                 INNER JOIN " . TBL_USERS . " 
                 ON " . TBL_USERS . ".user_guid = " . TBL_SUGAR_CONNECT . ".user_id 
                 WHERE " . TBL_SUGAR_CONNECT . ".enti_guid = '$token'
            ");
        if (!empty($result)) {
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
            return $rows;
        }
    }

    public static function getRequestById($token){
        global $db;

        $rows = [];
        $result = $db->query("SELECT * FROM ". TBL_REQUESTS . "
                INNER JOIN " . TBL_USERS . " 
                ON " . TBL_REQUESTS . ".escortee = ". TBL_USERS . ".user_guid
                INNER JOIN " . TBL_CATEGORY . " 
                ON " . TBL_REQUESTS . ".category_id = ". TBL_CATEGORY . ".token_guid 
                WHERE ". TBL_REQUESTS . ".entity = '$token'
            ");
        if (!empty($result)) {
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
            return $rows;
        }
    }

    public static function getAllEscortRequest($token){
        global $db;

        $rows = [];
        $result = $db->query("SELECT * FROM ". TBL_REQUESTS . "
                INNER JOIN " . TBL_USERS . " 
                ON " . TBL_REQUESTS . ".escortee = ". TBL_USERS . ".user_guid
                INNER JOIN " . TBL_CATEGORY . " 
                ON " . TBL_REQUESTS . ".category_id = ". TBL_CATEGORY . ".token_guid 
                WHERE ". TBL_REQUESTS . ".escorter = '$token'
            ");
        if (!empty($result)) {
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
            return $rows;
        }
    }

    public static function getAllSexVideos(){
        global $db;
        return $db->selectData(TBL_PORN_VIDEOS, "*");
    }

    public static function getSingleSexVideos($slug){
        global $db;
        return $db->selectData(TBL_PORN_VIDEOS, "*", "entity_guid = '$slug'");
    }

    public static function getRelatedSexVideos($slug, $cat){
        global $db;
        return $db->selectLimit(TBL_PORN_VIDEOS, "*", "sex_cat_id = '$cat' OR user_id = '$slug'", "title", 30);

    }

    public static function getSexVideosCategory(){
        global $db;
        return $db->selectData(TBL_SEX_VIDEO_CATEGORY, "*");
    }

    public static function getSingleSexVideosCategory($slug){
        global $db;
        return $db->selectData(TBL_SEX_VIDEO_CATEGORY, "*", "slugs = '$slug'");
    }

    public static function checkActiveSubscriber($user){
        global $db;

        $result = $db->selectData(TBL_SUBSCRIPTIONS, "*", "user_id = '$user'");

        if ($result) {
            foreach ($result as $key) {
                if ($key['sub_status'] == 'active') {
                    return true;
                }else {
                    return false;
                }
            }
        }else {
            return false;
        }
        
    }

    public static function getSubscriptionPlans(){
        global $db;
        return $db->selectData(TBL_SUBSCRIPTION_PLAN, "*");
    }

    public static function getSingleSubscriptionPlans($id){
        global $db;
        return $db->selectData(TBL_SUBSCRIPTION_PLAN, "*", "plan_guid = '$id'");
    }

    public static function getAllSugarConnectBySlug($slug, $gender){
        global $db;
        // $genders = $gender == 'female' ? 'male' : 'female'; return $genders;exit;
        $rows = [];
        $result = $db->query("SELECT * FROM " . TBL_SUGAR_CONNECT . "
                 INNER JOIN " . TBL_USERS . " 
                 ON " . TBL_USERS . ".user_guid = " . TBL_SUGAR_CONNECT . ".user_id 
                 WHERE " . TBL_SUGAR_CONNECT . ".gender_request = '$gender' AND payment_status = 'successful'
            ");
        if (!empty($result)) {
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
            return $rows;
        }
    }

    public static function getAllSugarConnect($slug){
        global $db;
        $rows = [];
        $result = $db->query("SELECT * FROM " . TBL_SUGAR_CONNECT . "
                 INNER JOIN " . TBL_USERS . " 
                 ON " . TBL_USERS . ".user_guid = " . TBL_SUGAR_CONNECT . ".user_id 
                 WHERE " . TBL_SUGAR_CONNECT . ".user_id = '$slug'
            ");
        if (!empty($result)) {
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
            return $rows;
        }//testing
    }

    public static function getMyTasks($token){
        global $db;
        $rows = [];
        $result = $db->query("SELECT * FROM " . TBL_PAYMENTS_LOG . "
            INNER JOIN " . TBL_ORDERS . "
            ON " . TBL_PAYMENTS_LOG . ".payment_entity = " . TBL_ORDERS . ".payments_log_id
            INNER JOIN " . TBL_USERS . " 
            ON " . TBL_PAYMENTS_LOG . ".escortee_id = " . TBL_USERS . ".user_guid 
            WHERE " . TBL_PAYMENTS_LOG . ".escorte_id = '$token' AND conditions = 'successful'
        ");
        if (!empty($result)) {
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
            return $rows;
        }
    }

    public static function getMySingleTasks($id){
        global $db;
        $rows = [];
        $result = $db->query("SELECT * FROM " . TBL_PAYMENTS_LOG . "
            INNER JOIN " . TBL_ORDERS . "
            ON " . TBL_PAYMENTS_LOG . ".payment_entity = " . TBL_ORDERS . ".payments_log_id
            INNER JOIN " . TBL_CATEGORY . "
            ON " . TBL_PAYMENTS_LOG . ".category_id = " . TBL_CATEGORY . ".token_guid
            INNER JOIN " . TBL_USERS . " 
            ON " . TBL_PAYMENTS_LOG . ".escortee_id = " . TBL_USERS . ".user_guid 
            WHERE " . TBL_PAYMENTS_LOG . ".payment_entity = '$id'
        ");
        if (!empty($result)) {
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
            return $rows;
        }
    }

    public static function checkPassword($token, $password){
        global $db;

        $user = $db->singleData(TBL_USERS, "password", "user_guid = '$token'");

        if ($user && password_verify($password, $user['password'])) {
            return true;
        }

        return false;
    }

    public static function getUserByToken($token){
        global $db;

        return $db->selectData(TBL_USERS, "*", "user_guid = '$token'");
    }

    public static function getWalletByToken($token){
        global $db;

        $result = $db->singleData(TBL_WALLET, "credit", "user_id = '$token'");

        if ($result) {
            $balance = $result['credit'];
            return $balance;
        }else{
            return false;
        }
    }

    public function creditEscortOnTaskDone($order_status, $order_csrf, $token){
        global $db;

        if ($token) {
            $result = $db->query("SELECT * FROM " . TBL_ORDERS . "
                INNER JOIN " . TBL_PAYMENTS_LOG . "
                ON " . TBL_ORDERS . ".payments_log_id = " . TBL_PAYMENTS_LOG . ".payment_entity 
                WHERE " . TBL_ORDERS . ".order_entity = '$order_csrf'
            ");

            if (!empty($result)) {
                while ($row = $result->fetch_assoc()) {
                    $amount = $row['amount'];
                    $current_balance = $this->getWalletByToken($token);
                    $wallet_balance = $current_balance + $amount;

                    if ($this->getWalletByToken($token) != false) {
                        $wallet = $db->update(TBL_WALLET, "credit = '$wallet_balance'", "user_id = '$token'");

                        $request = $db->update(TBL_ORDERS, "order_status = '$order_status', payment_status = 'pending'", "order_entity = '$order_csrf'");

                        if ($wallet && $request) {
                            return true;
                        }else{
                            return false;
                        }

                    }else {
                        $wallet = $db->saveData(TBL_WALLET, "user_id = '$token', entity_uuid = uuid(), credit = '$amount'");

                        $request = $db->update(TBL_ORDERS, "order_status = '$order_status', payment_status = 'pending'", "order_entity = '$order_csrf'");

                        if ($wallet && $request) {
                            return true;
                        }else{
                            return false;
                        }
                    }
                }
            }
        }else {
            return false;
        }
    }


    // public static function checkUserIfVerified($email)
    // {
    //     global $db;
    //     $verify = $db->selectData(TBL_SYSTEM_USER, "*", "email = '$email' AND email_verify = 'unverified'");

    //     if ($verify) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }

    // public static function verifySignupCode($verify)
    // {
    //     global $db;
    //     $codes = $db->selectData(TBL_REGISTRATION_CODE, "*", "code = '$verify'");

    //     if (isset($codes)) {
    //         foreach ($codes as $code) {
    //             $user = $code['user_guid'];
    //             $result = $db->update(TBL_SYSTEM_USER, "email_verify = 'verified'", "user_guid = '$user'");
    //             if ($result) {
    //                 $db->erase(TBL_REGISTRATION_CODE, "code = '$verify'");
    //                 $ngn = Database::ngnVirtualGen();
    //                 $usa = Database::usaVirtualGen();
    //                 $pounds = Database::poundsVirtualGen();
    //                 $euro = Database::euroVirtualGen();

    //                 $result = $db->saveData(TBL_VIRTUAL_ACCOUNT, "user_guid = '$user', entity_guid = uuid(), ngn = '$ngn', usa = '$usa', pounds = '$pounds', euro = '$euro'");
    //                 return true;
    //             }
    //         }
    //     } else {
    //         return false;
    //     }
    // }

    // public static function checkIfInvested($token, $id)
    // {
    //     global $db;

    //     $selects = $db->selectData(TBL_TRANSACTION_LOG, "*", "user_guid = '$token' AND plan_id = '$id' AND checker = 'invest' AND action = 'active'");

    //     if ($selects) {
    //         return false;
    //     } else {
    //         return true;
    //     }
    // }

    // // public static function verifyWithdrawalCode($verify, $token){
    // //     global $db;
    // //     $codes = $db->selectData(TBL_WITHDRAWAL_CODE, "*", "code = '$verify' AND user_guid = '$token'");

    // //     if (isset($codes)) {
    // //         foreach ($codes as $code) {
    // //             $user = $code['user_guid'];
    // //             $id = $code['withdrawal_id'];
    // //             $db->erase(TBL_WITHDRAWAL_CODE, "code = '$verify' AND user_guid = '$token'");
    // //             $update = $db->update(TBL_WITHDRAWAL, "conditions = 'successful', status = 'verified'", "user_guid = '$user' AND code = '$verify'"); //var_dump($r);exit;
    // //             if ($update) {
    // //                 $results = $db->selectData(TBL_WITHDRAWAL, "*", "id = '$id' AND user_guid = '$user'");

    // //                 foreach ($results as $result) {
    // //                     $investment_type = $result['investment_type'];
    // //                     $withdrawal_type_id = $result['withdrawal_type_id'];
    // //                     $amount = $result['requested_amount'];

    // //                     $withdrawal_type = $db->selectData(TBL_WITHDRAWAL_TYPE, "*", "id = '$withdrawal_type_id'");

    // //                     foreach ($withdrawal_type as $key) {
    // //                        $name = $key['name'];
    // //                         if ($name == 'investment') {
    // //                             $selects = $db->selectData(TBL_TRANSACTION_LOG, "*", "user_guid = '$user' AND plan_id = '$investment_type'");

    // //                             foreach ($selects as $select) {
    // //                                 $current = $select['amount'];
    // //                                 $balance = $current - $amount;
    // //                                 $updatewith = $db->update(TBL_TRANSACTION_LOG, "total_amount = '$balance', action = 'inactive'", "user_guid = '$user'");
    // //                                 $insert_with = $db->saveData(TBL_TRANSACTION_LOG, "user_guid = '$token', entity_guid = uuid(), plan_id = '$investment_type', payments_log_id = '', withdrawal_id = '$id', amount = '$amount', interest = '$amount', total_amount = '$amount', checker = 'withdraw', action = 'inactive'");
    // //                                 $db->erase(TBL_REGISTRATION_CODE, "code = '$verify'");
    // //                                 $wallets = $db->selectData(TBL_WALLET, "*", "user_guid = '$user'");

    // //                                 if ($wallets && $updatewith && $insert_with) {
    // //                                     foreach ($wallets as $wallet) {
    // //                                         $wallet_balance = $wallet['amount'];
    // //                                         $current_balance = $wallet_balance + $balance;
    // //                                          $db->update(TBL_WALLET, "amount = '$current_balance'", "user_guid = '$user'");
    // //                                     }

    // //                                     return true; 
    // //                                 }else {
    // //                                     foreach ($wallets as $wallet) {
    // //                                         $wallet_balance = $wallet['amount'];
    // //                                         $current_balance = $wallet_balance + $balance;
    // //                                         $db->saveData(TBL_WALLET, "user_guid = '$user', token_guid = 'uuid()', amount = '$current_balance'");
    // //                                     }

    // //                                     return true;
    // //                                 }
    // //                             }
    // //                         }elseif ($name == 'interest') {
    // //                             $selects = $db->selectData(TBL_TRANSACTION_LOG, "*", "user_guid = '$user' AND plan_id = '$investment_type'");

    // //                             foreach ($selects as $select) {
    // //                                 $current = $select['interest'];
    // //                                 $balance = $current - $amount;
    // //                                 $updatewith = $db->update(TBL_TRANSACTION_LOG, "interest = '$balance', action = 'inactive'", "user_guid = '$user'");

    // //                                 $insert_with = $db->saveData(TBL_TRANSACTION_LOG, "user_guid = '$token', entity_guid = uuid(), plan_id = '$investment_type', payments_log_id = '', withdrawal_id = '$id', amount = '$amount', interest = '$amount', total_amount = '$amount', checker = 'withdraw', action = 'inactive'");

    // //                                 $db->erase(TBL_REGISTRATION_CODE, "code = '$verify'");

    // //                                 $wallets = $db->selectData(TBL_WALLET, "*", "user_guid = '$user'");

    // //                                 if ($wallets && $updatewith && $insert_with) {
    // //                                     foreach ($wallets as $wallet) {
    // //                                         $wallet_balance = $wallet['amount'];
    // //                                         $current_balance = $wallet_balance + $balance;
    // //                                          $db->update(TBL_WALLET, "amount = '$current_balance'", "user_guid = '$user'");
    // //                                     }

    // //                                     return true;

    // //                                 }else {
    // //                                     foreach ($wallets as $wallet) {
    // //                                         $wallet_balance = $wallet['amount'];
    // //                                         $current_balance = $wallet_balance + $balance;
    // //                                         $db->saveData(TBL_WALLET, "user_guid = '$user', token_guid = 'uuid()', amount = '$current_balance'");
    // //                                     }

    // //                                     return true;
    // //                                 }
    // //                             }
    // //                         }elseif ($name == 'wallet') {
    // //                             $wallets = $db->selectData(TBL_WALLET, "*", "user_guid = '$user'");

    // //                             if ($wallets) {
    // //                                 foreach ($wallets as $wallet) {
    // //                                     $wallet_balance = $wallet['amount'];
    // //                                     $current_balance = $wallet_balance - $amount;
    // //                                     $db->update(TBL_WALLET, "amount = '$current_balance'", "user_guid = '$user'");
    // //                                     $db->erase(TBL_REGISTRATION_CODE, "code = '$verify'");
    // //                                 }

    // //                                 return true;

    // //                             }else {
    // //                                 return false;
    // //                             }
    // //                         }
    // //                     }


    // //                 }
    // //             }
    // //         }

    // //     }else {
    // //         return false;
    // //     }
    // // }



    // public static function validateWithdrawalAmount($token, $plan, $amount, $withdrawal_type)
    // {
    //     global $db;

    //     if ($withdrawal_type == 2) {
    //         $plans = $db->selectData(TBL_PLAN, "*", "id  = '$plan'");
    //         foreach ($plans as $key) {
    //             $plan_id = $key['id'];
    //             $pay_logs = $db->selectData(TBL_PAYMENTS_LOG, "*", "investment_plan_id  = '$plan_id'");
    //             foreach ($pay_logs as $pay_log) {
    //                 $pay_id = $pay_log['id'];
    //                 $tran_logs = $db->selectData(TBL_TRANSACTION_LOG, "*", "payments_log_id  = '$pay_id'AND user_guid = '$token' AND checker = 'invest'");
    //                 foreach ($tran_logs as $tran_log) {
    //                     $total_amount = $tran_log['amount'];
    //                     if ($plan_id == $plan && $total_amount >= $amount) {
    //                         return true;
    //                     } else {
    //                         return false;
    //                     }
    //                 }
    //             }
    //         }
    //     } elseif ($withdrawal_type == 3) {
    //         $plans = $db->selectData(TBL_PLAN, "*", "id  = '$plan'");
    //         foreach ($plans as $key) {
    //             $plan_id = $key['id'];
    //             $pay_logs = $db->selectData(TBL_PAYMENTS_LOG, "*", "investment_plan_id  = '$plan_id'");
    //             foreach ($pay_logs as $pay_log) {
    //                 $pay_id = $pay_log['id'];
    //                 $tran_logs = $db->selectData(TBL_TRANSACTION_LOG, "*", "payments_log_id  = '$pay_id'AND user_guid = '$token' AND checker = 'invest'");
    //                 foreach ($tran_logs as $tran_log) {
    //                     $total_amount = $tran_log['interest'];
    //                     if ($plan_id == $plan && $total_amount >= $amount) {
    //                         return true;
    //                     } else {
    //                         return false;
    //                     }
    //                 }
    //             }
    //         }
    //     } elseif ($withdrawal_type == 1) {
    //         $tran_logs = $db->selectData(TBL_WALLET, "*", "user_guid = '$token'");
    //         foreach ($tran_logs as $tran_log) {
    //             $total_amount = $tran_log['amount'];
    //             if ($total_amount >= $amount) {
    //                 return true;
    //             } else {
    //                 return false;
    //             }
    //         }
    //     }
    // }

    // public static function getWithdrawalDate($token, $plan)
    // {
    //     global $db;

    //     if ($plan == 1) {
    //         $result =  $db->selectDateBetween(TBL_TRANSACTION_LOG, "*", "user_guid = '$token'", "created_at", "7");

    //         if ($result) {
    //             return true;
    //         } else {
    //             return false;
    //         }
    //     } elseif ($plan == 2) {
    //         $result =  $db->selectDateBetween(TBL_TRANSACTION_LOG, "*", "user_guid = '$token'", "created_at", "7");

    //         if ($result) {
    //             return true;
    //         } else {
    //             return false;
    //         }
    //     } elseif ($plan == 3) {
    //         $result =  $db->selectDateBetween(TBL_TRANSACTION_LOG, "*", "user_guid = '$token'", "created_at", "13");

    //         if ($result) {
    //             return true;
    //         } else {
    //             return false;
    //         }
    //     } elseif ($plan == 4) {
    //         $result =  $db->selectDateBetween(TBL_TRANSACTION_LOG, "*", "user_guid = '$token'", "created_at", "20");

    //         if ($result) {
    //             return true;
    //         } else {
    //             return false;
    //         }
    //     } elseif ($plan == 5) {
    //         $result =  $db->selectDateBetween(TBL_TRANSACTION_LOG, "*", "user_guid = '$token'", "created_at", "25");

    //         if ($result) {
    //             return true;
    //         } else {
    //             return false;
    //         }
    //     }
    // }

    // public static function getTotalAmount($token)
    // {
    //     global $db;

    //     $result = $db->selectData(TBL_REF_BONUS, "*", "user_guid = '$token'");

    //     foreach ($result as $key) {
    //         if ($key['earn'] < 0) {
    //             return false;
    //         } else {
    //             return true;
    //         }
    //     }
    // }

    // public static function cancelInvestment($id)
    // {
    //     global $db;

    //     $result = $db->update(TBL_TRANSACTION_LOG, "action = 'inactive'", "entity_guid = '$id'");

    //     if ($result) {
    //         $selects = $db->selectData(TBL_TRANSACTION_LOG, "*", "entity_guid = '$id'");

    //         foreach ($selects as $key) {
    //             $amount = $key['amount'];
    //             $token = $key['user_guid'];

    //             $wallets = $db->selectData(TBL_WALLET, "*", "user_guid = '$token'");

    //             if ($wallets) {
    //                 foreach ($wallets as $wallet) {
    //                     $new_amount = $amount + $wallet['amount'];

    //                     $wallet_update = $db->update(TBL_WALLET, "amount = '$new_amount'", "user_guid = '$token'");

    //                     if ($wallet_update) {
    //                         return true;
    //                     } else {
    //                         return false;
    //                     }
    //                 }
    //             } else {
    //                 $wallet_update = $db->saveData(TBL_WALLET, "user_guid = '$token', token_guid = uuid(), amount = '$amount'");

    //                 if ($wallet_update) {
    //                     return true;
    //                 } else {
    //                     return false;
    //                 }
    //             }
    //         }
    //     } else {
    //         return false;
    //     }
    // }

    // public static function getCurrencySellingRate()
    // {
    //     global $db;

    //     return $db->singleData(TBL_CURRENCY_CONVERTER, "slug, selling_rate");
    // }

    // public static function getCurrencyBuyingRate()
    // {
    //     global $db;

    //     return $db->singleData(TBL_CURRENCY_CONVERTER, "slug, buying_rate");
    // }

    // public static function expireInvestment($token, $id)
    // {
    //     global $db;

    //     // $selects = $db->selectData(TBL_TRANSACTION_LOG, "*", "user_guid = '$token' AND entity_guid = '$id'");

    //     $selects = $db->selectDateBetween(TBL_TRANSACTION_LOG, "*", "user_guid = '$token' AND entity_guid = '$id'", "created_at", "");

    //     if ($selects) {
    //         $update = $db->update(TBL_TRANSACTION_LOG, "action = 'inactive'", "user_guid = '$token' AND entity_guid = '$id'");

    //         if ($update) {
    //             foreach ($selects as $key) {
    //                 $amount = $key['total_amount'];
    //                 $user = $key['user_guid'];
    //                 $gets = $db->selectData(TBL_WALLET, "*", "user_guid = '$token'");
    //                 if ($gets) {
    //                     foreach ($gets as $get) {
    //                         $cash = $get['amount'] + $amount;
    //                         $user_id = $get['user_guid'];
    //                         $update = $db->update(TBL_TRANSACTION_LOG, "amount = '$cash'", "user_guid = '$user_id'");
    //                     }
    //                 } else {
    //                     $insert = $db->saveData(TBL_WALLET, "user_guid = '$user', token_guid = uuid(), amount = '$amount'");
    //                 }
    //             }
    //         }
    //     }
    // }

    // public static function getAdminByEmail($email)
    // {
    //     global $db;
    //     return $db->selectData(TBL_ADMIN, "*", "email = '$email'");
    // }

    // public static function currencyConverter($plan, $amount, $avc)
    // {
    //     global $db;

    //     if ($plan == 'sl') {
    //         $convert = number_format($avc * $amount);

    //         return $convert;
    //     } elseif ($plan == 'by') {
    //         $convert = number_format($amount / $avc, 2);

    //         return $convert;
    //     }
    // }

    // public static function checkInvestorInWallet($token)
    // {
    //     global $db;
    //     $result = $db->selectData(TBL_WALLET, "*", "user_guid = '$token'");

    //     if ($result) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }

    // public static function getWalletBallance($token, $amount)
    // {
    //     global $db;
    //     $results = $db->selectData(TBL_WALLET, "*", "user_guid = '$token'");

    //     foreach ($results as $result) {
    //         if ($amount > $result['amount']) {
    //             return false;
    //         } else {
    //             return true;
    //         }
    //     }
    // }

    // public static function returnWalletBallance($token, $amount)
    // {
    //     global $db;
    //     $results = $db->selectData(TBL_WALLET, "*", "user_guid = '$token'");

    //     foreach ($results as $result) {
    //         $balance = $result['amount'] - $amount;
    //         $save_wallet = $db->update(TBL_WALLET, "amount = '$balance'", "user_guid = '$token'");
    //         if ($save_wallet) {
    //             return true;
    //         } else {
    //             return false;
    //         }
    //     }
    // }

    // public static function getActivePlan($id, $token)
    // {
    //     global $db;

    //     $result = $db->selectData(TBL_TRANSACTION_LOG, "*", "user_guid = '$token' AND plan_id = '$id' AND action = 'active'");

    //     if ($result) {
    //         return false;
    //     } else {
    //         return true;
    //     }
    // }

    // public static function getTradingTypeSubCategory($id)
    // {
    //     global $db;

    //     return $db->selectData(TBL_TRADERS_TYPE, "*", "sub_category = '$id'");
    // }

    // public static function getTraderByUsername($username)
    // {
    //     global $db;
    //     return $db->selectData(TBL_TRADERS, "*", "username = '$username'");
    // }

    // public static function verifyIDCardNumber($card_number)
    // {
    //     global $db;
    //     return $db->selectData(TBL_TRADERS, "*", "card_number = '$card_number'");
    // }

    // public static function getTraderPhoneNumber($phone_number)
    // {
    //     global $db;
    //     return $db->selectData(TBL_TRADERS, "*", "phone_number = '$phone_number'");
    // }

    // public static function getTraders($token)
    // {
    //     global $db;
    //     return $db->selectData(TBL_TRADERS, "*", "user_guid != '$token' AND trade_type = '2'");
    // }

    // public static function getSingleTrader($token)
    // {
    //     global $db;
    //     return $db->selectData(TBL_TRADERS, "*", "user_guid = '$token'");
    // }

    // public static function getAllSingleTraderReview($token)
    // {
    //     global $db;
    //     return $db->selectData(TBL_TRADERS_REVIEW, "*", "user_guid = '$token'");
    // }

    // public static function getClientIp($ip)
    // {
    //     global $db;
    //     return $db->selectData(TBL_VISITORS_COUNT, "*", "ip = '$ip'");
    // }

    // public static function getWallet($token)
    // {
    //     global $db;
    //     return $db->selectData(TBL_WALLET, "*", "user_guid = '$token'");
    // }

    // public static function getUSDWallet($token)
    // {
    //     global $db;
    //     return $db->selectData(TBL_US_WALLET, "*", "user_guid = '$token'");
    // }

    // public static function getPoundWallet($token)
    // {
    //     global $db;
    //     return $db->selectData(TBL_POUNDS_WALLET, "*", "user_guid = '$token'");
    // }

    // public static function getEuroWallet($token)
    // {
    //     global $db;
    //     return $db->selectData(TBL_EURO_WALLET, "*", "user_guid = '$token'");
    // }

    // public static function getBallanceFromAnyWallet($from, $token, $amount)
    // {
    //     global $db;

    //     if ($from == 'NGN') {
    //         $result = $db->singleData(TBL_WALLET, "amount", "user_guid = '$token'"); //var_dump($result);exit; 

    //         //echo $result[0]['amount'];exit;
    //         if ($amount > $result[0]['amount']) {
    //             return false;
    //         } elseif ($result[0]['amount'] >= $amount) {
    //             return true;
    //         }
    //     } elseif ($from == 'USD') {
    //         $result = $db->singleData(TBL_US_WALLET, "ballance", "user_guid = '$token'"); //var_dump($result);exit;

    //         if ($result[0]['ballance'] < $amount) {
    //             return false;
    //         } elseif ($result[0]['ballance'] >= $amount) {
    //             return true;
    //         }
    //     } elseif ($from == 'EUR') {
    //         $result = $db->singleData(TBL_EURO_WALLET, "ballance", "user_guid = '$token'"); //var_dump($result);exit;

    //         if ($amount > $result[0]['ballance']) {
    //             return false;
    //         } elseif ($result[0]['ballance'] >= $amount) {
    //             return true;
    //         }
    //     } elseif ($from == 'GBP') {
    //         $result = $db->singleData(TBL_POUNDS_WALLET, "ballance", "user_guid = '$token'");

    //         if ($amount > $result[0]['ballance']) {
    //             return false;
    //         } elseif ($result[0]['ballance'] >= $amount) {
    //             return true;
    //         }
    //     }
    // }

    // public static function conversion($from, $to, $token, $amount)
    // {
    //     global $db;

    //     if ($from == 'NGN') {
    //         $result = $db->selectData(TBL_CURRENCY, "*", "slug = '$to'");

    //         foreach ($result as $key) {
    //             $sell = $amount / $key['selling_rate'];

    //             $deduct = $db->singleData(TBL_WALLET, "amount", "user_guid = '$token'");

    //             $balance = $deduct[0]['amount'] - $amount;

    //             $insert = $db->update(TBL_WALLET, "amount = '$balance'", "user_guid = '$token'");

    //             if ($to == 'USD') {
    //                 $current_ballance = $db->singleData(TBL_US_WALLET, "ballance", "user_guid = '$token'");
    //                 $wallet_balance = $sell + $current_ballance[0]['ballance'];
    //                 $update = $db->update(TBL_US_WALLET, "ballance = '$wallet_balance'", "user_guid = '$token'");
    //             } elseif ($to == 'EUR') {
    //                 $current_ballance = $db->singleData(TBL_EURO_WALLET, "ballance", "user_guid = '$token'");
    //                 $wallet_balance = $sell + $current_ballance[0]['ballance'];
    //                 $update = $db->update(TBL_EURO_WALLET, "ballance = '$wallet_balance'", "user_guid = '$token'");
    //             } elseif ($to == 'GBP') {
    //                 $current_ballance = $db->singleData(TBL_POUNDS_WALLET, "ballance", "user_guid = '$token'");
    //                 $wallet_balance = $sell + $current_ballance[0]['ballance'];
    //                 $update = $db->update(TBL_POUNDS_WALLET, "ballance = '$wallet_balance'", "user_guid = '$token'");
    //             }

    //             if ($insert && $update) {
    //                 return true;
    //             }
    //         }
    //     } else {
    //         $result = $db->selectData(TBL_CURRENCY, "*", "slug = '$from'");

    //         foreach ($result as $key) {
    //             $buy = $key['buying_rate'] * $amount;

    //             if ($from == 'USD') {
    //                 $deduct = $db->singleData(TBL_US_WALLET, "ballance", "user_guid = '$token'");


    //                 $balance = $deduct[0]['ballance'] - $amount;

    //                 $update = $db->update(TBL_US_WALLET, "ballance = '$balance'", "user_guid = '$token'");

    //                 $current_ballance = $db->singleData(TBL_WALLET, "amount", "user_guid = '$token'");
    //                 $wallet_balance = $buy + $current_ballance[0]['amount'];

    //                 $insert = $db->update(TBL_WALLET, "amount = '$wallet_balance'", "user_guid = '$token'");

    //                 if ($insert && $update) {
    //                     return true;
    //                 }
    //             } elseif ($from == 'EUR') {
    //                 $deduct = $db->singleData(TBL_EURO_WALLET, "ballance", "user_guid = '$token'");

    //                 $balance = $deduct[0]['ballance'] - $amount;

    //                 $update = $db->update(TBL_EURO_WALLET, "ballance = '$balance'", "user_guid = '$token'");

    //                 $current_ballance = $db->singleData(TBL_WALLET, "amount", "user_guid = '$token'");
    //                 $wallet_balance = $buy + $current_ballance[0]['amount'];

    //                 $insert = $db->update(TBL_WALLET, "amount = '$wallet_balance'", "user_guid = '$token'");

    //                 if ($insert && $update) {
    //                     return true;
    //                 }
    //             } elseif ($from == 'GBP') {
    //                 $deduct = $db->singleData(TBL_POUNDS_WALLET, "ballance", "user_guid = '$token'");

    //                 $balance = $deduct[0]['ballance'] - $amount;

    //                 $update = $db->update(TBL_POUNDS_WALLET, "ballance = '$balance'", "user_guid = '$token'");

    //                 $current_ballance = $db->singleData(TBL_WALLET, "amount", "user_guid = '$token'");
    //                 $wallet_balance = $buy + $current_ballance[0]['amount'];

    //                 $insert = $db->update(TBL_WALLET, "amount = '$wallet_balance'", "user_guid = '$token'");

    //                 if ($insert && $update) {
    //                     return true;
    //                 }
    //             }
    //         }
    //     }
    // }

    // public static function checkChatToken($send, $receiver)
    // {
    //     global $db;

    //     $results = $db->selectData(TICKET, "*", "maker = '$send' AND receiver = '$receiver'");

    //     if (empty($results)) {
    //         $tickets = $db->chatTicket();

    //         $db->saveData(TICKET, "ticket = '$tickets', token_guid = uuid(), maker = '$send', receiver = '$receiver'"); //var_dump($r);exit;

    //         $checks = $db->selectData(TICKET, "*", "maker = '$send' AND receiver = '$receiver' AND ticket = '$tickets'");

    //         foreach ($checks as $check) {

    //             $ticket = $check['token_guid'];
    //         }

    //         return $ticket;
    //     } else {
    //         foreach ($results as $result) {

    //             $ticket = $result['token_guid'];
    //         }

    //         return $ticket;
    //     }
    // }

    // public static function checkChatTokenId($tickets) {
    //     global $db;

    //     $results = $db->selectData(TICKET, "*", "ticket = '$tickets'");

    //     foreach ($results as $result) {

    //         $ticket = $result['token_guid'];
    //     }

    //     return $ticket;
    // }

    // public static function checkMessageSender($token, $tickets) {
    //     global $db;

    //     return $db->selectData(TICKET, "*", "maker = '$token' OR receiver = '$token' AND ticket = '$tickets'");

    // }

    // public static function checkSingleChatHistory($token, $ch)
    // {
    //     global $db;

    //     $results =  $db->selectData(TICKET, "*", "maker = '$token' AND receiver = '$ch'");

    //     foreach ($results as $result) {
    //         $ticket = $result['token_guid'];

    //         return $ticket;
    //     }
    // }

    // public static function getSingleChat($ticket)
    // {
    //     global $db;

    //     $rows = [];
    //     $result = $db->query("SELECT * FROM " . TBL_TRADERS_CHAT . "
    //              INNER JOIN " . TICKET . " 
    //              ON " . TICKET . ".token_guid = " . TBL_TRADERS_CHAT . ".ticket_id 
    //              WHERE " . TBL_TRADERS_CHAT . ".ticket_id = '$ticket' ORDER BY maker DESC
    //         ");
    //     if (!empty($result)) {
    //         while ($row = $result->fetch_assoc()) {
    //             $rows[] = $row;
    //         }
    //         return $rows;
    //     }
    // }

    // public static function getMessageList($token)
    // {
    //     global $db;

    //     $rows = [];
    //     $result = $db->query("SELECT * FROM " . TICKET . "
    //                INNER JOIN " . TBL_SYSTEM_USER . " 
    //             ON " . TICKET . ".maker = " . TBL_SYSTEM_USER . ".user_guid 
    //             WHERE " . TICKET . ".receiver = '$token' OR maker = '$token' ORDER BY updated_at DESC
    //         ");

    //     if (!empty($result)) {
    //         while ($row = $result->fetch_assoc()) {
    //             $rows[] = $row;
    //         }
    //         return $rows;
    //     }
    // }

    // public static function getSenderMessageList($token)
    // {
    //     global $db;

    //     $results = $db->query("SELECT * FROM " . TICKET . "
    //         INNER JOIN " . TBL_SYSTEM_USER . " 
    //         ON " . TICKET . ".receiver = " . TBL_SYSTEM_USER . ".user_guid 
    //         WHERE " . TICKET . ".receiver = '$token' OR maker = '$token' ORDER BY updated_at DESC
            
    //     ");

    //     if (!empty($results)) {
    //         foreach ($results as $result) {
    //             $img = $result['image'];
    //             $username = $result['username'];
    //         }

    //         $rows = [
    //             'image' => $img,
    //             'username' => $username
    //         ];

    //         return $rows;
    //     }
    // }

    // public static function getLastMessageList($ticket_id)
    // {
    //     global $db;

    //     return $db->selectData(TBL_TRADERS_CHAT, "*", "ticket_id = '$ticket_id' ORDER BY sender_time OR receiver_time ASC");
    // }

    // public static function getLastMessage($ticket)
    // {

    //     global $db;

    //     // $rows = [];

    //     $result = $db->selectLimit(TBL_TRADERS_CHAT, "*", "ticket_id = '$ticket'", "sender_time", 1);
    //     foreach ($result as $key) {
    //         $message = $key['sender_comment'];
    //         $sender_time = $key['sender_time'];
    //         $receiver_comment = $key['receiver_comment'];
    //         $receiver_time = $key['receiver_time'];
    //     }

    //     $rows = [
    //         'sender_comment' => $message,
    //         'sender_time' => $sender_time,
    //         'receiver_comment' => $receiver_comment,
    //         'receiver_time' => $receiver_time,
    //     ];

    //     return $rows;
    // }

    // // public static function getSingleClientMessages($ticket){
    // //     global $db;

    // //     $rows = [];
    // //     $result = $db->query("SELECT * FROM ". TICKET . "
    // //         INNER JOIN " . TBL_TRADERS_CHAT . " 
    // //         ON " . TICKET . ".token_guid = ". TBL_TRADERS_CHAT . ".ticket_id
    // //         INNER JOIN " . TBL_SYSTEM_USER . " 
    // //         ON " . TICKET . ".maker = ". TBL_SYSTEM_USER . ".user_guid 
    // //         WHERE ". TICKET . ".ticket = '$ticket' ORDER BY maker DESC
    // //     ");

    // //     if (!empty($result)) {
    // //         while ($row = $result->fetch_assoc()) {
    // //             $rows[] = $row;
    // //         }
    // //         return $rows;
    // //     }
    // // }

    // public static function getSingleClientDetails($ticket)
    // {
    //     global $db;

    //     $rows = [];
    //     $result = $db->query("SELECT * FROM " . TICKET . "
    //             INNER JOIN " . TBL_SYSTEM_USER . " 
    //             ON " . TICKET . ".maker = " . TBL_SYSTEM_USER . ".user_guid 
    //             WHERE " . TICKET . ".ticket = '$ticket' ORDER BY maker DESC
    //         ");

    //     if (!empty($result)) {
    //         while ($row = $result->fetch_assoc()) {
    //             $rows[] = $row;
    //         }
    //         return $rows;
    //     }
    // }

    // public static function getSingleMessageHeaderDetails($ticket)
    // {
    //     global $db;

    //     $rows = [];
    //     $result = $db->query("SELECT * FROM " . TICKET . "
    //             INNER JOIN " . TBL_SYSTEM_USER . " 
    //             ON " . TICKET . ".receiver = " . TBL_SYSTEM_USER . ".user_guid 
    //             WHERE " . TICKET . ".ticket = '$ticket' ORDER BY maker DESC
    //         ");

    //     if (!empty($result)) {
    //         while ($row = $result->fetch_assoc()) {
    //             $rows[] = $row;
    //         }
    //         return $rows;
    //     }
    // }

    // public static function getSingleCryptoVendorRate($id)
    // {
    //       global $db;

    //       $rows = [];
    //       $result = $db->query("SELECT * FROM " . TBL_VENDOR_RATE . "
    //             INNER JOIN " . TBL_TRADERS_TYPE . " 
    //             ON " . TBL_VENDOR_RATE . ".traders_type_sub_category_id = " . TBL_TRADERS_TYPE . ".entity_guid 
    //             WHERE " . TBL_VENDOR_RATE . ".token_guid = '$id'");

    //       if (!empty($result)) {
    //            while ($row = $result->fetch_assoc()) {
    //                 $rows[] = $row;
    //            }
    //            return $rows;
    //       }
    // }

    // public static function getAllUserEmails()
    // {
    //     global $db;
    //     return $db->selectData(TBL_SYSTEM_USER, "*");
    // }

    // public static function getSingleUserAccountsBalance($account,$token)
    //  {
    //     global $db;

    //     if ($account == 'ngn') {
    //         $result = $db->selectData(TBL_WALLET, "*", "user_guid = '$token'");

    //         if ($result) {

    //             foreach($result as $key){

    //                 $balance = $key['amount'];
    //             }

    //             return $balance;

    //         }else{

    //             return false;
    //         }
            
    //     }elseif ($account == 'usd') {
    //         $result = $db->selectData(TBL_US_WALLET, "*", "user_guid = '$token'");

    //         if ($result) {

    //             foreach($result as $key){
    //                 $balance = $key['ballance'];
    //             }
    
    //             return $balance;

    //         }else{

    //             return false;
    //         }
            
    //     }elseif ($account == 'gbp') {
    //         $result = $db->selectData(TBL_POUNDS_WALLET, "*", "user_guid = '$token'");

    //         if ($result) {

    //             foreach($result as $key){
    //                 $balance = $key['ballance'];
    //             }
    
    //             return $balance;

    //         }else{

    //             return false;
    //         }

    //     }elseif ($account == 'eur') {
    //         $result = $db->selectData(TBL_EURO_WALLET, "*", "user_guid = '$token'");

    //         if ($result) {

    //             foreach($result as $key){
    //                 $balance = $key['ballance'];
    //             }
    
    //             return $balance;

    //         }else{

    //             return false;
    //         }
    //     }
        

    // }

    // public static function getReceiverAccountsDetails($receiver)
    //  {
    //     global $db;

    //     $ngn = $db->selectData(TBL_WALLET, "*", "account_number = '$receiver'");
    //     $usd = $db->selectData(TBL_US_WALLET, "*", "account_number = '$receiver'");
    //     $pounds = $db->selectData(TBL_POUNDS_WALLET, "*", "account_number = '$receiver'");
    //     $eur = $db->selectData(TBL_EURO_WALLET, "*", "account_number = '$receiver'");

    //     if ($ngn) {


    //         foreach($ngn as $key){

    //             $token = $key['user_guid'];
    //             $result = $db->selectData(TBL_SYSTEM_USER, "*", "user_guid = '$token'");

    //             foreach($result as $user){
    //                 $user = $user['full_name'];
    //             }
    //         }

    //         return $user;
            
    //     }elseif ($usd) {
    //         foreach($usd as $key){

    //             $token = $key['user_guid'];
    //             $result = $db->selectData(TBL_SYSTEM_USER, "*", "user_guid = '$token'");

    //             foreach($result as $user){
    //                 $user = $user['full_name'];
    //             }
    //         }
            
    //     }elseif ($pounds) {

    //         foreach($pounds as $key){

    //             $token = $key['user_guid'];
    //             $result = $db->selectData(TBL_SYSTEM_USER, "*", "user_guid = '$token'");

    //             foreach($result as $user){
    //                 $user = $user['full_name'];
    //             }
    //         }

    //     }elseif ($eur) {

    //         foreach($pounds as $key){

    //             $token = $key['user_guid'];
    //             $result = $db->selectData(TBL_SYSTEM_USER, "*", "user_guid = '$token'");

    //             foreach($result as $user){
    //                 $user = $user['full_name'];
    //             }
    //         }
    //     }
        

    // }

    // public static function transferFunds($token,$amount, $virtual_account, $receiver){
    //     global $db;
        

    //     if ($virtual_account == 'ngn') {
    //         $ngn = $db->selectData(TBL_WALLET, "*", "user_guid = '$token'");
    //         if ($ngn) {
    //             foreach ($ngn as $key) {
    //                 $balance = $key['amount'] - $amount;
    //                 $vat = (0.8 / 100) * $amount;
    //                 $total = $balance - $vat;
    //                 $save = $db->update(TBL_WALLET, "amount = '$total'", "user_guid = '$token'");
    //                 $save_vat = $db->SaveData(TBL_INVENTORY, "entity_guid = uuid(), transaction_name = 'transfer', amount = '$vat'");

    //                 if ($save && $save_vat) {

    //                     $results = $db->selectData(TBL_WALLET, "*", "account_number = '$receiver'");

    //                     foreach ($results as $result) {
    //                         $rec_balance = $result['amount'] + $amount;
    //                         $update = $db->update(TBL_WALLET, "amount = '$rec_balance'", "account_number = '$receiver'");
    //                         if ($update) {
    //                             return true;
    //                         }else{
    //                             return false;
    //                         }
    //                     }
    //                 }
    //             }
    //         }else {
    //             return false;
    //         }
            
    //     }elseif ($virtual_account == 'usd') {

    //         $usd = $db->selectData(TBL_US_WALLET, "*", "user_guid = '$token'");

    //         if ($usd) {
    //             foreach ($usd as $key) {

    //                 $balance = $key['ballance'] - $amount;
    //                 $vat = (0.8 / 100) * $amount;
    //                 $total = $balance - $vat;

    //                 $save = $db->update(TBL_US_WALLET, "ballance = '$total'", "user_guid = '$token'");
    //                 $save_vat = $db->SaveData(TBL_INVENTORY, "token_guid = uuid(), transaction_name = 'transfer', amount = '$vat'");

    //                 if ($save && $save_vat) {
    //                     $results = $db->selectData(TBL_US_WALLET, "*", "account_number = '$receiver'");

    //                     foreach ($results as $result) {
    //                         $rec_balance = $result['ballance'] + $amount;
    //                         $update = $db->update(TBL_US_WALLET, "ballance = '$rec_balance'", "account_number = '$receiver'");
    //                         if ($update) {
    //                             return true;
    //                         }else{
    //                             return false;
    //                         }
    //                     }
    //                 }
    //             }
    //         }else {
    //             return false;
    //         }
           
    //     }elseif ($virtual_account == 'gbp') {

    //         $pounds = $db->selectData(TBL_POUNDS_WALLET, "*", "user_guid = '$token'");

    //         if ($pounds) {
    //             foreach ($pounds as $key) {
    //                 $balance = $key['ballance'] - $amount;
    //                 $vat = (0.8 / 100) * $amount;
    //                 $total = $balance - $vat;

    //                 $save = $db->update(TBL_POUNDS_WALLET, "ballance = '$total'", "user_guid = '$token'");
    //                 $save_vat = $db->SaveData(TBL_INVENTORY, "token_guid = uuid(), transaction_name = 'transfer', amount = '$vat'");

    //                 if ($save && $save_vat) {
    //                     $results = $db->selectData(TBL_POUNDS_WALLET, "*", "account_number = '$receiver'");

    //                     foreach ($results as $result) {
    //                         $rec_balance = $result['ballance'] + $amount;
    //                         $update = $db->update(TBL_POUNDS_WALLET, "ballance = '$rec_balance'", "account_number = '$receiver'");
    //                         if ($update) {
    //                             return true;
    //                         }else{
    //                             return false;
    //                         }
    //                     }
    //                 }
    //             }
    //         }else{
    //             return false;
    //         }
            
    //     }elseif ($virtual_account == 'eur') {

    //         $eur = $db->selectData(TBL_EURO_WALLET, "*", "user_guid = '$token'");

    //         if ($eur) {

    //             foreach ($eur as $key) {
    //                 $balance = $key['ballance'] - $amount;
    //                 $vat = (0.8 / 100) * $amount;
    //                 $total = $balance - $vat;

    //                 $save = $db->update(TBL_EURO_WALLET, "ballance = '$total'", "user_guid = '$token'");
    //                 $save_vat = $db->SaveData(TBL_INVENTORY, "token_guid = uuid(), transaction_name = 'transfer', amount = '$vat'");

    //                 if ($save && $save_vat) {
    //                     $results = $db->selectData(TBL_EURO_WALLET, "*", "account_number = '$receiver'");

    //                     foreach ($results as $result) {
    //                         $rec_balance = $result['ballance'] + $amount;
    //                         $update = $db->update(TBL_EURO_WALLET, "ballance = '$rec_balance'", "account_number = '$receiver'");
    //                         if ($update) {
    //                             return true;
    //                         }else{
    //                             return false;
    //                         }
    //                     }
    //                 }
    //             }
    //         }else {
    //             false;
    //         }
            
    //     }else {
    //         false;
    //     }
    // }

    // public static function checkAccountBalance($token, $virtual_account, $amount){
    //     global $db;

    //     if ($virtual_account == 'ngn') {
    //         $ngn = $db->selectData(TBL_WALLET, "*", "user_guid = '$token'");
    //         if ($ngn) {
    //             foreach ($ngn as $key) {
    //                 if ($amount >= $key['amount']) {
    //                     return false;
    //                 }else {
    //                     return true;
    //                 }
                    
    //             }
    //         }else {
    //             return false;
    //         }
            
    //     }elseif ($virtual_account == 'usd') {

    //         $usd = $db->selectData(TBL_US_WALLET, "*", "user_guid = '$token'");

    //         if ($usd) {

    //             foreach ($usd as $key) {

    //                 if ($amount >= $key['ballance']) {
    //                     return false;
    //                 }else {
    //                     return true;
    //                 }
                        
    //             }
    //         }else {
    //             return false;
    //         }
           
    //     }elseif ($virtual_account == 'gbp') {

    //         $pounds = $db->selectData(TBL_POUNDS_WALLET, "*", "user_guid = '$token'");

    //         if ($pounds) {
    //             foreach ($pounds as $key) {
    //                 if ($amount >= $key['ballance']) {
    //                     return false;
    //                 }else {
    //                     return true;
    //                 }
    //             }
    //         }else{
    //             return false;
    //         }
            
    //     }elseif ($virtual_account == 'eur') {

    //         $eur = $db->selectData(TBL_EURO_WALLET, "*", "user_guid = '$token'");

    //         if ($eur) {

    //             foreach ($eur as $key) {
    //                 if ($amount >= $key['ballance']) {
    //                     return false;
    //                 }else {
    //                     return true;
    //                 }
    //             }
    //         }else {
    //             false;
    //         }
            
    //     }else {
    //         false;
    //     }
    // }

    // public static function getBetById($id) {
    //     global $db;

    //     $bet = $db->selectData(TBL_BET,"*", "entity_guid = '$id'");

    //     return $bet;
    // }

    // public static function getGames() {
    //     global $db;

    //     return $db->selectData(TBL_BET,"*");
    // }

    // public static function getSingleGameById($id, $game) {
    //     global $db;

    //     $result = $db->selectData(TBL_BET,"*", "entity_guid = '$id'");

    //     if ($result) {
    //         foreach ($result as $key) {
    //             if (strlen($key["rule"]) === strlen($game)) {
    //                 return true;
    //             }else{
    //                 return false;
    //             }
    //         }
    //     }
    // }

    // public static function getSingleGameReturn($id, $amount_play) {
    //     global $db;

    //     $result = $db->selectData(TBL_BET,"*", "entity_guid = '$id'");

    //     if ($result) {
    //         foreach ($result as $key) {
    //             $cal = ($key["percentage"]/100) * $amount_play;
    //             $percentage = $cal * $amount_play;
                
    //             return $percentage;
    //         }
    //     }
    // }

    // public static function gameResult($id, $game) {
    //     global $db;
    //     $result = $db->selectData(TBL_BET,"*", "entity_guid = '$id'");

    //     if ($result) {
    //         foreach ($result as $key) {
    //             if(strlen($key['rule']) == 1){
    //                 $game = Database::singleGame();
    //                 $result = Database::encryptGame($game);

    //                 return $result;
    //             }elseif(strlen($key['rule']) == 2){
    //                 $game = Database::twoGame();
    //                 $result = Database::encryptGame($game);

    //                 return $result;
    //             }elseif(strlen($key['rule']) == 3){
    //                 $game = Database::threeGame();
    //                 $result = Database::encryptGame($game);

    //                 return $result;
    //             }
    //         }
    //     }
    // }

    // public static function getAllGamesPlayedByUser($token) {
    //     global $db;

    //     $rows = [];
    //     $result = $db->query("SELECT * FROM " . TBL_ARENA . "
    //              INNER JOIN " . TBL_BET . " 
    //              ON " . TBL_ARENA . ".bet_id = " . TBL_BET . ".entity_guid 
    //              WHERE " . TBL_ARENA . ".user_id = '$token' ORDER BY played_date DESC LIMIT 7
    //         ");
    //     if (!empty($result)) {
    //         while ($row = $result->fetch_assoc()) {
    //             $rows[] = $row;
    //         }
    //         return $rows;
    //     }
    // }

    // public static function decodeGameResult($game_result){
    //     global $db;

    //     $decode = Database::decryptGame($game_result);

    //     return $decode;
    // }

    // public static function getAllBetWinners(){
    //     global $db;

    //     $rows = [];
    //     $result = $db->query("SELECT * FROM " . TBL_ARENA . "
    //              INNER JOIN " . TBL_SYSTEM_USER . " 
    //              ON " . TBL_ARENA . ".user_id = " . TBL_SYSTEM_USER . ".user_guid 
    //              WHERE " . TBL_ARENA . ".game_status = 'Win' ORDER BY played_date DESC LIMIT 2
    //         ");
    //     if (!empty($result)) {
    //         while ($row = $result->fetch_assoc()) {
    //             $rows[] = $row;
    //         }
    //         return $rows;
    //     }

    // }

    // public static function ballanceWalletOnBet($game, $amount_play, $decode, $token){
    //     global $db;
    //     if ($decode === $game) {
    //         $result = $db->selectData(TBL_WALLET, "*", "user_guid = '$token'");

    //         if ($result) {
    //             foreach ($result as $key) {
    //                 $balance = $key['amount'] + $amount_play;

    //                 $update = $db->update(TBL_WALLET, "amount = '$balance'", "user_guid = '$token'");

    //                 if ($update) {
    //                     return true;
    //                 }else{
    //                     return false;
    //                 }
    //             }
    //         }
    //     }elseif ($decode != $game) {
    //         $result = $db->selectData(TBL_WALLET, "*", "user_guid = '$token'");

    //         if ($result) {
    //             foreach ($result as $key) {
    //                 $balance = $key['amount'] - $amount_play;

    //                 $update = $db->update(TBL_WALLET, "amount = '$balance'", "user_guid = '$token'");

    //                 if ($update) {
    //                     return true;
    //                 }else{
    //                     return false;
    //                 }
    //             }
    //         }
    //     }
    // }

}

$ajax = new Ajax;
