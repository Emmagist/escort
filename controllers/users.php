<?php

require_once "config/db.php";
// require_once "emailVerification.php";

class Users
{
     public static function getCategories()
     {
          global $db;
          return $db->selectData(TBL_CATEGORY, "*");
     }

     public static function getUserByEmail($email)
    {
        global $db;
        return $db->selectData(TBL_USERS, "*", "email = '$email'");
    }

    public static function getSingleSexVideos($slug)
    {
        global $db;
        return $db->selectData(TBL_PORN_VIDEOS, "*", "entity_guid = '$slug'");
    }

     // public static function getInvestorByUsername($username)
     // {
     //      global $db;
     //      return $db->selectData(TBL_SYSTEM_USER, "*", "username = '$username'");
     // }

     // public static function findUserByPassword($password)
     // {
     //      global $db;
     //      return $db->selectData(TBL_SYSTEM_USER, "*", "password = '$password'");
     // }

     public static function checkUserIfVerified($token)
     {
          global $db;
          $verify = $db->selectData(TBL_USERS, "*", "user_guid = '$token' AND email_verify = 'unverified'");

          if ($verify) {
               return true;
          } else {
               return false;
          }
     }

     public static function findUserByToken($token){
         global $db;
         return $db->selectData(TBL_USERS, "*", "user_guid = '$token'");
     }

     public static function subscriptionVerify($code, $amount, $paystackCode, $token, $plan)
     {
          global $db;

          // check if user exist
          $userExist = $db->selectData(TBL_USERS, "*", "user_guid = '$token'");

          if ($userExist) {
               $get = $db->selectData(TBL_SUBSCRIPTIONS, "*", "amount = '$amount' AND invoice_code = '$code'");        //var_dump($get);exit;

               if ($get) {
                    foreach ($get as $key) {
                         // $id = $key['id'];
                         // $expire_at = Database::expire_at($key['duration']);

                         if ($key['sub_condition'] == 'successful') {
                         } else {
                              //update subscription log
                              $update = $db->update(TBL_SUBSCRIPTIONS, "paystack_invoice = '$paystackCode', sub_condition = 'successful', sub_status = 'active'", "amount = '$amount' AND invoice_code = '$code' AND user_id = '$token'");
                              if ($update) {
                                   return true;
                              } else {
                                   return false;
                              }
                         }
                    }
               } else {
                    return false;
               }
          } else {
               return false;
          }
     }

     // public static function getReferrerCode($ref)
     // {
     //      global $db;
     //      return $db->selectData(TBL_SYSTEM_USER, "*", "ref_code = '$ref'");
     // }

     // public static function getInvestorToken($token)
     // {
     //      global $db;
     //      return $db->selectData(TBL_SYSTEM_USER, "*", "user_guid = '$token'");
     // }

     // public static function getReferralUserToken($token)
     // {
     //      global $db;
     //      return $db->selectData(TBL_REF_BONUS, "*", "user_guid = '$token'");
     // }

     // public static function getInvestorByUsernameOrEmail($email)
     // {
     //      global $db;
     //      return $db->selectData(TBL_SYSTEM_USER, "*", "email = '$email' OR username = '$email'");
     // }

     // public static function getAdminByUsernameOrEmail($email)
     // {
     //      global $db;
     //      return $db->selectData(TBL_ADMIN, "*", "email = '$email' OR username = '$email'");
     // }

     // public static function getInvestmentPlan()
     // {
     //      global $db;

     //      return $db->selectData(TBL_PLAN, "*", "status = '0'");
     // }

     // public static function getInvestmentCategory()
     // {
     //      global $db;
     //      return $db->selectData(TBL_PLAN, "*");
     // }

     // public static function getAllUsers()
     // {
     //      global $db;
     //      return $db->selectData(TBL_SYSTEM_USER, "*");
     // }

     // public static function getNewUsers()
     // {
     //      global $db;
     //      $date = date("Y-m-d");
     //      return $db->selectData(TBL_SYSTEM_USER, "*", "Date(created_at) = DATE(NOW())");
     // }

     // public static function getRemoteAddress()
     // {
     //      global $db;
     //      $address = $db->redirectURI();
     //      if ($address == 'https://sanmtosapp.com/about' || $address == 'http://sanmtosapp.com/about') {
     //           return "About";
     //      } elseif ($address == 'https://sanmtosapp.com/mining' || $address == 'http://sanmtosapp.com/mining') {
     //           return "Mining";
     //      } elseif ($address == 'https://sanmtosapp.com/contact' || $address == 'https://sanmtosapp.com/contact') {
     //           return "Contact";
     //      }
     // }

     // public static function searchEngine($page)
     // {
     //      global $db;

     //      return $db->selectData(TBL_OPTIMIZATION, "*", "page = '$page'");
     // }

     public static function checkRole($role)
     {
          global $db;

          $result =  $db->selectData(TBL_USERS, "*", "role_id = '$role'");

          if ($result) {
               return true;
          } else {
               return false;
          }
     }

     // public static function cardType()
     // {
     //      global $db;

     //      return $db->selectData(TBL_CARD_TYPE, "*");
     // }

     // public static function getCurrencyType()
     // {
     //      global $db;

     //      return $db->selectData(TBL_CURRENCY_CONVERTER, "*");
     // }

     // public static function getCrytoType()
     // {
     //      global $db;

     //      return $db->selectData(TBL_CRYPTO_CURRENCY, "*");
     // }

     // public static function getTradingType()
     // {
     //      global $db;

     //      return $db->selectData(TBL_TRADERS_TYPE, "*", "sub_category = '0'");
     // }

     // public static function getTradingTypeSubCategory($sub)
     // {
     //      global $db;

     //      return $db->selectData(TBL_TRADERS_TYPE, "*", "sub_category = '$sub'");
     // }

     // public static function getAgricPlan()
     // {
     //      global $db;

     //      return $db->selectData(TBL_PLAN, "*", "investment_category_id = '2'");
     // }

     // public static function getAllPlans()
     // {
     //      global $db;

     //      return $db->selectData(TBL_PLAN, "*");
     // }

     // public static function getActiveAgricPlan()
     // {
     //      global $db;

     //      $rows = [];
     //      $result = $db->query("SELECT * FROM " . TBL_PLAN_ACTIVATOR . "
     //           INNER JOIN " . TBL_PLAN . " 
     //           ON " . TBL_PLAN_ACTIVATOR . ".plan_id = " . TBL_PLAN . ".id 
     //           WHERE " . TBL_PLAN_ACTIVATOR . ".conditions = 'off' AND investment_category_id = '2'
     //      ");
     //      if (!empty($result)) {
     //           while ($row = $result->fetch_assoc()) {
     //                $rows[] = $row;
     //           }
     //           return $rows;
     //      }
     // }

     // public static function getAllUserEmails()
     // {
     //     global $db;
     //     return $db->selectData(TBL_SYSTEM_USER, "*");
     // }
     
     // public static function getAdminRoles()
     // {
     //     global $db;
     //     return $db->selectData(TBL_ROLE, "*", "role != 3 AND role != 1");
     // }
}

$users = new Users;
