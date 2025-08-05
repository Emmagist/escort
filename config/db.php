<?php

use Google\Service\Analytics\Column;

    require_once "constant.php";

    session_start();

    // error_reporting(0);

    class Database{
        private $con = false; // Check to see if the connection is active
        public $myconn ;// This will be our mysqli object
        private $result = array(); // Any results from a query will be stored here
        private $myQuery = ""; // used for debugging process with SQL return
        private $numResults = ""; // used for returning the number of rows

        function __construct(){
            $this->connect();
        }

        // Function to make connection to database
        public function connect() {
        
                $this->myconn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); // mysql_connect() with variables defined at the start of Database class
                if ($this->myconn->connect_errno) {
                    die("Database connection failed". $this->myconn->connect_error);
                }
        }

        public function query($sql) {
          return $this->myconn->query($sql);
        }

        public function selectData($table, $field = '*', $conditions = "", $column = ''){
            $rows = [];
                $fields = trim($field);
                $where = !empty($conditions) ? "WHERE" : "";
            $result = $this->query("SELECT " . $fields . " FROM " . $table . "  $where " . $conditions);
            // var_dump($result);exit;
            $count = $result->num_rows;
            if ($count > 0) {
              while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
              }
              return $rows;
            }
        }

        public function singleData($table, $column = "*", $conditions = "")
        {
            $rows = [];
            $where = !empty($conditions) ? "WHERE $conditions" : "";

            $result = $this->query("SELECT $column FROM $table $where");

            if ($result && $result->num_rows > 0) {
                return $result->fetch_assoc();
            }

            return null;
        }


        public function activeUsers($table, $field = '*', $conditions = ""){
            $rows = [];
                $fields = trim($field);
                $where = !empty($conditions) ? "WHERE" : "";
            $result = $this->query("SELECT " . $fields . " FROM " . $table . "  $where " . $conditions . " < DATE_SUB(NOW(),INTERVAL 5 minute");
            // var_dump($result);exit;
            $count = $result->num_rows;
            if ($count > 0) {
              while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
              }
              return $rows;
            }
        }

        public function searchData($table, $field = "*", $conditions = "", $columns = [], $val = '', $limit = '') {
            $rows = [];
            $fields = trim($field);
            $where = "";

            if (is_array($columns) && !empty($columns)) {
                $searchParts = array_map(function ($col) use ($val) {
                    $col = preg_replace('/[^a-zA-Z0-9_]/', '', $col); 
                    return "$col LIKE '%$val%'";
                }, $columns);
                $searchClause = implode(" OR ", $searchParts);
            } else {
                return 0; 
            }

            if (!empty($conditions)) {
                $where = "WHERE $conditions AND ($searchClause)";
            } else {
                $where = "WHERE $searchClause";
            }

            $limitClause = !empty($limit) ? "LIMIT $limit" : "";
            $sql = "SELECT $fields FROM $table $where $limitClause";

            $result = $this->query($sql);
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $rows[] = $row;
                }
                return $rows;
            }

            return 0;
        }




        public function saveData($table, $sql){
            return $this->query("INSERT INTO " . $table . "  SET " . $sql);
        }

        public function erase($table, $conditions) {
            return $this->query("DELETE FROM " . $table . "  WHERE " . $conditions);
        }

        public function update($table, $sql, $conditions) {
            return $this->query("UPDATE " . $table . "  SET " . $sql . " WHERE " . $conditions);
        }
    
        // to generate a token
        public function entityGuid(){
            return substr(strtolower(hash_hmac("sha256", uniqid(), bin2hex(openssl_random_pseudo_bytes(22)))), 0, 50);
        }

        //real_escape_string
        public function escape($data) {
            return strtolower(trim(addslashes($this->myconn->real_escape_string($data))));
        }

        public function set($key, $val){
            $_SESSION[$key] = $val;
            
        }

        public function getSession($key){
            if (isset($_SESSION[$key])) {
                return $_SESSION[$key];
            } else {
                return false;
            }
        }

        public function getLogin(){
            if ($this->getSession('login') == false) {
                unset($_SESSION["token"]);
                session_destroy();
                // header("Location: login.php?page_url=$redirect");
                header("Location: login.php");
            }
        }

        public function getAdminLogin($redirect){
            if ($this->getSession('login') == false) {
                unset($_SESSION["token"], $_SESSION["email"], $_SESSION["role"]);
                session_destroy();
                header("Location: ../login?page_url=$redirect");
                // header("Location: login.php");
            }
        }

        public function getAdminSession(){
            if ($this->getSession('login') == false) {
                unset($_SESSION["token"], $_SESSION["email"], $_SESSION["role"]);
                session_destroy();
                header("Location: ../admin-login");
                // header("Location: login.php");
            }
        }

        public function getLoginSession($redirect){
            if ($this->getSession('login') == false) {
                unset($_SESSION["token"], $_SESSION["email"], $_SESSION["role"]);
                session_destroy();
                // header("Location: login?page_url=$redirect");
                header("Location: login.php?page_url=$redirect");
            }
        }

        public function redirectURI(){
            $protocol = $_SERVER['SERVER_PROTOCOL'];
            // echo $protocol;
            if (strpos($protocol, "HTTPS")) {
                $protocol = "HTTPS://";
            }else{
                $protocol = "HTTP://";
            }

            return $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        }

        public function validatePhoneNumber($phone_number){
            // Allow + and - in phone number
            $phoneNumberValidate = filter_var($phone_number, FILTER_SANITIZE_NUMBER_INT);

            //Remove - form phone number
            $checkPhoneNumber = str_replace("-", "", $phoneNumberValidate);

            // check phone number length
            if (strlen($checkPhoneNumber <= 10) && strlen($checkPhoneNumber > 15)) {
                return false;
            }else {
                return true;
            }
        }

        public function validateEmail($email){
            //check if email is invalid
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return true;
            }else {
                return false;
            }
        }

        public static function dateFormat($date){
            $timestamp = strtotime($date);
            // $timestamp = preg_replace('-', ' ', $timestamp);
            return date('d M, Y', $timestamp);
        }

        public static function monthFormat($date){
            $timestamp = strtotime($date);
            // $timestamp = preg_replace('-', ' ', $timestamp);
            return date('F d, Y', $timestamp);
        }

        public static function dateDiffence($date){
            $edate = date("Y-m-d H:i:s");

            $date_diff = abs(strtotime($edate) - strtotime($date));

            $years = floor($date_diff / (365*60*60*24));
            $months = floor(($date_diff - $years * 365*60*60*24) / (30*60*60*24));
            $days = floor(($date_diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

            if ($years == 1) {
                return $years . 'Year';
            }if ($years > 1) {
                return $years . 'Years';
            }elseif ($months == 1) {
                return $months . 'Month';
            }elseif ($months > 1) {
                return $months . 'Months';
            }elseif ($days == 1) {
                return $days . 'day';
            }elseif ($days > 1) {
                return $days . 'days';
            }elseif ($days < 1) {
                return 'recent';
            }
        }

        public static function time($date){
            $time = date('g:i A', strtotime($date));

            return $time;
        }

        public function selectRandLimit($table, $field = '*', $conditions = "", $limit = ""){
            $rows = [];
            $fields = trim($field);
            $where = !empty($conditions) ? "WHERE" : "";
            $limits = $limit;
            $result = $this->query("SELECT" . $fields . " FROM " . $table . " $where " . $conditions . " ORDER BY RAND() LIMIT " . $limits);
            if (!empty($result)) {
                while ($row = $result->fetch_assoc()) {
                   $rows[] = $row;
                }
                return $rows;
            }
        }

        public function selectAllLimited($table, $field = '*', $conditions = "", $limit = ""){
            $rows = [];
            $fields = trim($field);
            $where = !empty($conditions) ? "WHERE" : "";
            $limits = $limit;
            $result = $this->query("SELECT" . $fields . " FROM " . $table . " $where " . $conditions . " LIMIT " . $limits);
            if (!empty($result)) {
                while ($row = $result->fetch_assoc()) {
                   $rows[] = $row;
                }
                return $rows;
            }
        }

        public function selectLimit($table, $field = '*', $conditions = "", $column="", $limit = ""){
            $rows = [];
            $fields = trim($field);
            $where = !empty($conditions) ? "WHERE" : "";
            $limits = $limit;
            $result = $this->query("SELECT" . $fields . " FROM " . $table . " $where " . $conditions . " ORDER BY " . $column . " DESC LIMIT " . $limits);
            if (!empty($result)) {
                while ($row = $result->fetch_assoc()) {
                   $rows[] = $row;
                }
                return $rows;
            }
        }

        public function selectLimitAsc($table, $field = '*', $conditions = "", $column="", $limit = ""){
            $rows = [];
            $fields = trim($field);
            $where = !empty($conditions) ? "WHERE" : "";
            $limits = $limit; 
            $result = $this->query("SELECT" . $fields . " FROM " . $table . " $where " . $conditions . " ORDER BY " . $column . " ASC LIMIT " . $limits);
            if (!empty($result)) {
                while ($row = $result->fetch_assoc()) {
                   $rows[] = $row;
                }
                return $rows;
            }
        }

        public function selectDESC($table, $field = '*', $conditions = "", $column=""){
            $rows = [];
            $fields = trim($field);
            $where = !empty($conditions) ? "WHERE" : "";
            $result = $this->query("SELECT" . $fields . " FROM " . $table . " $where " . $conditions . " ORDER BY " . $column . " DESC");
            if (!empty($result)) {
                while ($row = $result->fetch_assoc()) {
                   $rows[] = $row;
                }
                return $rows;
            }
        }

        public function sumUp($table, $column = "", $conditions = ""){
            $rows = [];
            $where = !empty($conditions) ? "WHERE" : "";
            $result = $this->query("SELECT SUM(".$column.") FROM " . $table . "  $where " . $conditions);
            // $r = array_sum($result); print_r($r);
            // var_dump($result);exit;
            if (!empty($result)) {
                while ($row = $result->fetch_assoc()) {
                   $rows[] = $row;
                }
                return $rows;
            }
        }

        public function selectDateBetween($table, $field, $column, $conditions = "", $interval = ""){
            $row = [];
            $fields = trim($field);
            $condition = ! empty($conditions) ? "AND" : "";
            $where = ! empty($column || $conditions) ? "WHERE" : "";
            $result = $this->query("SELECT " . $fields . " FROM " . $table . " $where " . $condition . "  DATE(".$column.") > (NOW() - INTERVAL " . $interval ." DAY)");

            if (!empty($result)) {
                while ($row = $result->fetch_assoc()) {
                   $rows[] = $row;
                }
                return $rows;
            }
        }

        public function remote_Addr(){
            return $_SERVER['REMOTE_ADDR'];
        }

        public function curlNamePage(){
            return substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
        }

        public function referralCode() { 
            $str_result = 'ABCDEFGHIJKLM1234abcdefghijklmnop567890qrstuvwxyz0987NOPQRSTUVWXYZ654321'; 
            return substr(str_shuffle($str_result), 0, 6); 
        }

        public static function withdrawalCode() { 
            $str_result = '12345678900987654321'; 
            return 'sanmwth-' . substr(str_shuffle($str_result), 0, 4); 
        }

        public static function withdrawalVerificationCode() { 
            $str_result = '12345678900987654321'; 
            return substr(str_shuffle($str_result), 0, 6); 
        }

        public static function registrationCode() { 
            $str_result = '12345678900987654321'; 
            return substr(str_shuffle($str_result), 0, 6); 
        }

        public static function chatTicket() { 
            $str_result = '1234567890098765432198501280045'; 
            return substr(str_shuffle($str_result), 0, 6); 
        }

        public static function ngnVirtualGen() { 
            $str_result = '23451678909807651324';
            $unique = 40;
            return $unique.substr(str_shuffle($str_result), 0, 8); 
        }

        public static function usaVirtualGen() { 
            $str_result = '12345678900987654321';
            $unique = 22;
            return $unique.substr(str_shuffle($str_result), 0, 6); 
        }

        public static function poundsVirtualGen() { 
            $str_result = '12567834906540791832';
            $unique = 46;
            return $unique.substr(str_shuffle($str_result), 0, 6); 
        }

        public static function euroVirtualGen() { 
            $str_result = '13452906780987652143';
            $unique = 32;
            return $unique.substr(str_shuffle($str_result), 0, 6); 
        }

        public static function autoGenPass() { 
            $str_result = 'abcdefghi1234jklm_@%*-!`nop567890qrstuvwxyz_@%*-!`'; 
            return substr(str_shuffle($str_result), 0, 8); 
        }

        public static function strengthPassword($password) {
            if (!preg_match('/^(?=.{8,20})(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*\W)/', $password)) {
                return false;
            }
            return true;
        }

        public static function invoiceCode(){
            $code = mt_rand(100000,999999);
            return 'kzone_'.substr(str_shuffle($code),0,8);
        }

        public static function timeCountDown2($expire_time){ 
            $result = "";
            $unix_timestamp = strtotime($expire_time);
            //$pretty_date = date('l, F jS, Y \a\t g:ia', $unix_timestamp);
            $pretty_date = date('F jS, Y', $unix_timestamp);
            $thisyear = date("Y");
            $today = date("d");
            if(date('Y', $unix_timestamp) == $thisyear){
                if(date('d', $unix_timestamp) == $today){
                    $result = date('g:ia', $unix_timestamp);
                }
                else{
                    $result = date('F jS', $unix_timestamp);
                }
            }
            else{
                $result = date('F jS, Y', $unix_timestamp);
            }
            return $result;
        }

        // Function to get the client IP address
        public static function getClientIp() {
            $ipaddress = '';
            if (isset($_SERVER['HTTP_CLIENT_IP']))
                $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
            else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
                $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
            else if(isset($_SERVER['HTTP_X_FORWARDED']))
                $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
            else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
                $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
            else if(isset($_SERVER['HTTP_FORWARDED']))
                $ipaddress = $_SERVER['HTTP_FORWARDED'];
            else if(isset($_SERVER['REMOTE_ADDR']))
                $ipaddress = $_SERVER['REMOTE_ADDR'];
            else
                $ipaddress = 'UNKNOWN';
            return $ipaddress;
        }

        public static function expire_at($duration){
            $date=date("Y-m-d");
            $int_date = $duration + 1;
            $expire_at = date('Y-m-d', strtotime($date. ' + ' . $int_date . ' days'));

            return $expire_at;
        }

        public static function userUrlTitleFormat($page){
            $url = '';
            if($page=='dashboard.php'){$url =  'User | Dashboard';}elseif($page=='investment.php'){$url =  'User | Investment';}elseif($page=='cashout.php'){$url =  'User | Cashout';}elseif($page=='sell-fx.php'){$url =  'FX | Echange';}elseif($page=='buy-fx.php'){$url =  'FX | Buy';}elseif($page=='refer.php'){$url =  'User | Referral';}elseif($page=='history.php'){$url =  'User | History';}elseif($page=='profile.php'){$url =  'User | Profile';}elseif($page=='email.php'){$url =  'User | Email';}elseif($page=='password.php'){$url =  'User | Password';}elseif($page=='account.php'){$url =  'User | Wallet';}elseif($page=='mining.php'){$url =  'User | Mining';}elseif($page=='agric-plan.php'){$url =  'User | Agricultural Investment';}elseif($page=='create-vta.php'){$url =  'Create Virtual Account';}elseif($page=='messages.php'){$url =  'Messages';}

            return $url;
        }

        public static function singleGame() { 
            $str_result = '1345290876';
            return substr(str_shuffle($str_result), 6, 1); 
        }

        public static function twoGame() { 
            $str_result = '13452908763720581469';
            return substr(str_shuffle($str_result), 16, 2); 
        }

        public static function threeGame() { 
            $str_result = '134529087637205814693810765429';
            return substr(str_shuffle($str_result), 19, 3); 
        }

        public static function encryptGame($game){
            $key = "secret";
            $method = "AES-256-CBC";
            $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($method));
            $encrypted = openssl_encrypt($game, $method, $key, 0, $iv);

            return base64_encode($iv.$encrypted);
        }

        public static function decryptGame($encrypted){
            $key = "secret";
            $method = "AES-256-CBC";
            $encrypt = base64_decode($encrypted);
            $iv = substr($encrypt, 0, openssl_cipher_iv_length($method));
            $decrypt = substr($encrypt, openssl_cipher_iv_length($method));

            return openssl_decrypt($decrypt, $method, $key, 0, $iv);
        }

        public static function slug($str) {
    
            // Convert string to lowercase 
            $str = strtolower($str); 
            
            // Replace the spaces with hyphens 
            $str = str_replace(' ', '-', $str); 
            
            // Remove the special characters 
            $str = preg_replace('/[^a-z0-9\-]/', '', $str); 
            
            // Remove the consecutive hyphens 
            $str = preg_replace('/-+/', '-', $str); 
            
            // Trim hyphens from the beginning 
            // and ending of String 
            $str = trim($str, '-'); 
            
            return $str; 
        }

        public static function videoToGif($videoPath, $outputGif, $start = 0, $duration = 5, $scale = 320) {
            $ffmpeg = "/usr/bin/ffmpeg";
            $cmd = "$ffmpeg -ss $start -t $duration -i \"$videoPath\" -vf \"fps=10,scale=$scale:-1:flags=lanczos\" -gifflags -transdiff -y \"$outputGif\" 2>&1";
            $output = shell_exec($cmd);

            if (!file_exists($outputGif)) {
                file_put_contents("ffmpeg_error_log.txt", "GIF FAILED:\n$cmd\n$output\n\n", FILE_APPEND);
            }

            return file_exists($outputGif);
        }


        public static function videoToImage($videoPath, $outputImage, $timestamp = '00:00:01') {
            $ffmpeg = "/usr/bin/ffmpeg";
            $cmd = "$ffmpeg -ss $timestamp -i \"$videoPath\" -frames:v 1 -q:v 2 \"$outputImage\" 2>&1";
            $output = shell_exec($cmd);

            if (!file_exists($outputImage)) {
                file_put_contents("ffmpeg_error_log.txt", "IMAGE FAILED:\n$cmd\n$output\n\n", FILE_APPEND);
            }

            return file_exists($outputImage);
        }



        public static function getVideoDuration($filePath) {
            $ffmpeg = "/usr/bin/ffmpeg";
            $output = shell_exec("$ffmpeg -i \"$filePath\" 2>&1");

            if (preg_match('/Duration: (\d{2}:\d{2}:\d{2})/', $output, $matches)) {
                return $matches[1]; // HH:MM:SS
            }

            file_put_contents("ffmpeg_error_log.txt", "DURATION FAILED:\n$output\n\n", FILE_APPEND);
            return null;
        }

    }
    $db = new Database;
