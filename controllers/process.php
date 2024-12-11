<?php

    require_once "users.php";

    // $errors = [];
    // $success = [];
    //login
    if (isset($_POST['login_button'])) {
        $errors = '';
        $success = '';
        $email = $db->escape($_POST['email']);
        $password = $db->escape($_POST['password']);//exit;

        if (empty($email)) {
            $errors = "Email is required!";
        }

        if (empty($password)) {
            $errors = "Password is required!";
        }

        if (Users::getUserByEmail($email) > 0) { 

            // Set cookie
            // echo $_POST['checkbox'];exit; 
            if (!empty($_POST['checkbox'])) {
                setcookie("email", $email, time() + 3600, '/');
                setcookie("password", $password, time() + 3600, '/');

            }else {
                // Expire cookie
                setcookie("email", "", time() - 3600);
                setcookie("password", "", time() - 3600);

            }
        }
        if (empty($errors)) {//echo "done";exit;
            if (Users::getUserByEmail(($email))) {
                foreach (Users::getUserByEmail($email) as $userInfo) {
                    if (password_verify($password, $userInfo['password'])) {
                        $_SESSION['token'] = $userInfo['user_guid'];
                        $_SESSION['email'] = $userInfo['email'];
                        $_SESSION['role'] = $userInfo['role_id'];
                        $_SESSION['username'] = $userInfo['username'];
                        $_SESSION['gender'] = $userInfo['gender'];
                        $_SESSION['connect'] = $userInfo['connect'];
                        $db->set('login', true);
                        $redirect = $_REQUEST['page_url'];
                        if ($redirect == '') {
                            header('Location: ../index.php');
                        }else {
                            header("Location: $redirect");
                        }
                    }
                    else {
                        $errors = "Email or password not correct!";
                    }
                }
            }else {
                $errors = "Email or password not correct!";
            }
        }
        
        echo json_encode(['error' => $errors, 'success' => $success]);
    }


    // // Admin Login
    // if (isset($_POST['admin_login'])) {
    //     $errors = [];
    //     $success = [];
    //     $email = $db->escape($_POST['username']);
    //     $password = $db->escape($_POST['password']);

    //     if (empty($email)) {
    //         $errors['email'] = "Email is required!";
    //     }

    //     if (empty($password)) {
    //         $errors['password'] = "Password is required!";
    //     }

    //     if (Investor::getAdminByUsernameOrEmail($email) > 0) {

    //         // Set cookie
    //         // echo $_POST['checkbox'];exit; 
    //         if (!empty($_POST['checkbox'])) {
    //             setcookie("email", $email, time() + 3600, '/');
    //             setcookie("password", $password, time() + 3600, '/');

    //         }else {
    //             // Expire cookie
    //             setcookie("email", "", time() - 3600);
    //             setcookie("password", "", time() - 3600);

    //         }

    //         if (empty($errors)) {
    //             if (Investor::getAdminByUsernameOrEmail($email)) {
    //                 foreach (Investor::getAdminByUsernameOrEmail($email) as $userInfo) {
    //                     if (password_verify($password, $userInfo['password'])) {
    //                         $_SESSION['token'] = $userInfo['user_guid'];
    //                         $_SESSION['email'] = $userInfo['email'];
    //                         $_SESSION['role'] = $userInfo['role_id'];
    //                         $_SESSION['username'] = $userInfo['username'];
    //                         $db->set('login', true);
    //                         if ($_SESSION['role'] == 2) {
    //                             header('Location: admin/dashboard');
    //                         }else {
    //                             $errors['role'] = "Sorry you do not have access to the page you're requesting for!";
    //                         }
    //                     }else {
    //                         $errors['wrong'] = "Email or password not correct!";
    //                     }
    //                 }
                    
    //             }else {
    //                 $errors['wrong-credential'] = "Email or password not correct!";
    //             }
    //         }
    //     }
    // }

?>
