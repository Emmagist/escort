<?php

use Egulias\EmailValidator\EmailValidator;

require_once "ajaxRequest.php";

// Configure API key authorization: Apikey
$config = Swagger\Client\Configuration::getDefaultConfiguration()->setApiKey('Apikey', CLOUD_MERSIVE);
$apiInstance = new Swagger\Client\Api\VideoApi(new GuzzleHttp\Client(), $config);

if (isset($_GET['pg'])) {
    $pg = $_GET['pg'];
}

//Signup
if ($pg == 200) {
    $errors = "";
    $success = "";
    $full_name = $db->escape($_POST['name']);//exit;
    $email = $db->escape($_POST['email']);//exit;
    $password = $db->escape($_POST['password']);//exit;

    $hash_password = password_hash($password, PASSWORD_DEFAULT);//exit;

    if (empty($full_name)) {
        $errors = "Full Name is required!";
    }

    if (empty($email)) {
        $errors = "Email is required!";
    }

    if (empty($password)) {
        $errors = "Password is required!";
    }

    if ($db->validateEmail($email) == false) {
        $errors = "Invalid email address";
    }

    if (Ajax::getUserByEmail($email) > 0) {
        $errors = "Email already exist!";
    }

    if (empty($errors)) {
        $user_guid = $db->entityGuid();
        $code = Database::registrationCode();
        
        $result = $db->saveData(TBL_USERS, "user_guid = '$user_guid', role_id = '3', name = '$full_name', email = '$email', password = '$hash_password'");// var_dump($result);exit;
    
        if ($result) {

            // $send = emailVerification::sendSignupCode($email, $username, $code);

            // if ($send) {
                $success = "Kindly check your email for verification";
            // }
        }else{
            $errors = "Something went wrong!";
        }
    }
    else{
        $errors = "Something went wrong!";
    }
    
    echo json_encode(['error' => $errors, 'success' => $success]);
}

//login
if ($pg == 201) {
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

    if (Ajax::getUserByEmail($email) > 0) { 

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
        if (Ajax::getUserByEmail(($email))) {
            foreach (Ajax::getUserByEmail($email) as $userInfo) {
                if (password_verify($password, $userInfo['password'])) {
                    $_SESSION['token'] = $userInfo['user_guid'];
                    $_SESSION['email'] = $userInfo['email'];
                    $_SESSION['role'] = $userInfo['role_id'];
                    // $_SESSION['username'] = $userInfo['username'];
                    $db->set('login', true);
                    // $redirect = $_REQUEST['page_url'];
                    // if ($redirect == '') {
                    //     header('Location: ../');
                    // }else {
                    //     header("Location: $redirect");
                    // }

                    $success = "Login successfull...";
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

//payment form
if ($pg == 202) {
    echo 202;
    echo $escort_id = $db->escape($_POST['escort']);
    echo $amount = $db->escape($_POST['esc_price']);
    echo $escortee_id = $db->escape($_POST['escortee']);
    echo $escortee_date = $db->escape($_POST['escortee_date']);
    echo $escortee_time = $db->escape($_POST['escortee_time']);
    echo $invoice = $db->escape($_POST['ref_invoice']);
    echo $invoice = $db->escape($_POST['page']); exit;

    $db->saveData(TBL_PAYMENTS_LOG, "user_guid = '$token', investment_plan_id = '$plan', invoice_code = '$invoice', paystack_invoice = '', amount = '$amount', payment_channel = 'FlutterWave', conditions = 'processing'");
    // var_dump($re);
    echo json_encode('Done');
}

//upload escort profile
if ($pg == 203) {
    $error = '';
    $success = '';
    $category = $db->escape($_POST['category']);
    $age = $db->escape($_POST['age']);
    $token = $db->escape($_POST['token']);
    $period = $db->escape($_POST['period']);
    $currency = $db->escape($_POST['currency']);
    $prices = $db->escape($_POST['prices']);
    $weight = $db->escape($_POST['weight']);
    $height = $db->escape($_POST['height']);
    $ethnicity = $db->escape($_POST['ethnicity']);
    $hair_long = $db->escape($_POST['hair_long']);
    $hair_color = $db->escape($_POST['hair_color']);
    $bust_size = $db->escape($_POST['bust_size']);
    $smoker = $db->escape($_POST['smoker']);
    $alcohol = $db->escape($_POST['alcohol']);
    $build = $db->escape($_POST['build']);
    $sexual_orientation = $db->escape($_POST['sexual_orientation']);
    $bio = $_POST['bio'];

    if (empty($category)) {
        $error = "Category is required!";
    }

    if (empty($age)) {
        $error = "Age is required!";
    }

    if (empty($token)) {
        $error = "Something went wrong!";
    }

    if (empty($period)) {
        $error = "Period is required!";
    }

    if (empty($currency)) {
        $error = "Currency is required!";
    }
    if (empty($prices)) {
        $error = "Prices is required!";
    }

    if (empty($weight)) {
        $error = "Weight is required!";
    }

    if (empty($height)) {
        $error = "Height is required!";
    }

    if (empty($ethnicity)) {
        $error = "Ethnicity is required!";
    }

    if (empty($hair_long)) {
        $error = "Hair long is required!";
    }

    if (empty($hair_color)) {
        $errors = "Hair color is required!";
    }

    if (empty($bust_size)) {
        $error = "Bust size is required!";
    }

    if (empty($smoker)) {
        $error = "Smoker is required!";
    }

    if (empty($alcohol)) {
        $error = "Alcohol is required!";
    }

    if (empty($build)) {
        $error = "Build is required!";
    }

    if (empty($sexual_orientation)) {
        $error = "Sexual orientation is required!";
    }

    if (empty($bio)) {
        $error = "Bio is required!";
    }

    // File upload
    $target_dir = "../escort_img/";
    $target_file  = $target_dir . basename($_FILES["fileUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $check = getimagesize($_FILES["fileUpload"]["tmp_name"]);
    if ($check == false) {
        $error =  "File is not an image";
        $uploadOk = 0;
    }

    if (file_exists($target_file)) {
        $error = "Sorry, file already exists.";
        $uploadOk = 0;
    }

    if ($_FILES["fileUpload"]["size"] > 500000) {
        $error = "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        $error = "Sorry, only JPG, JPEG, PNG files are allowed.";
        $uploadOk = 0;
    }

    if ($uploadOk == 1 && empty($error)) {
        $move_file = move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $target_file);
        if ($move_file) {
            $result = $db->saveData(TBL_ESCORTS, "user_id = '$token', category_id = '$category', entity_guid = uuid(), age = '$age', height = '$height', weight = '$weight', period_prices = '$period', prices = '$prices', currency = '$currency', comments = '$bio', ethnicity = '$ethnicity', hair_long = '$hair_long', hair_color = '$hair_color', bust_size = '$bust_size', smoker = '$smoker', alcohol = '$alcohol', build = '$build', sexual_orientation = '$sexual_orientation', profile_image = '$target_file'");
            // var_dump($re);
            if ($result) {
                $success = "Successfully uploaded...";
            }else {
                $error = "Something went wrong";
            }
        }else {
            $error = "File not uploaded! Something went wrong";
        }
    }

    echo json_encode(['error' => $error, 'success' => $success]);
}

//upload porn video
if ($pg == 204) {
    $error = '';
    $success = '';
    $title = $db->escape($_POST['title']);
    $hash_tag = $db->escape($_POST['hash_tag']);
    $token = $db->escape($_POST['token']);
    $content = $_POST['content'];

    if (empty($title)) {
        $error = "Title is required!";
    }

    if (empty($token)) {
        $error = "Something went wrong!";
    }

    if (empty($content)) {
        $error = "Contents is required!";
    }

    // File upload
    $target_dir = "../porn_video/";
    $target_gif = "../porn_gif/";
    $target_file  = $target_dir . basename($_FILES["fileUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    // $check = getimagesize($_FILES["fileUpload"]["tmp_name"]);
    // if ($check == false) {
    //     $error =  "File is not an image";
    //     $uploadOk = 0;
    // }

    if (file_exists($target_file)) {
        $error = "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // if ($_FILES["fileUpload"]["size"] > 5000000) {
    //     $error = "Sorry, your file is too large.";
    //     $uploadOk = 0;
    // }

    if ($imageFileType != "mp3" && $imageFileType != "mp4" && $imageFileType != "mkv" && $imageFileType != "avi") {
        $error = "Sorry, only mp3, mp4, mkv videos are allowed.";
        $uploadOk = 0;
    }

    if ($uploadOk == 1 && empty($error)) { 
        $move_file = move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $target_file);
        if ($move_file) {
            // $gif= $apiInstance->videoConvertToGif($target_file, $target_file, '560', '170', );
            // $target_gif_file  = $target_gif . basename($gif);
            // $move_file = move_uploaded_file($git, $target_gif_file);
            $result = $db->saveData(TBL_PORN_VIDEOS, "user_id = '$token', entity_guid = uuid(), title = '$title', contents = '$content', porn_video = '$target_file'");
            // var_dump($re);
            if ($result) {
                $success = "Successfully uploaded...";
            }else {
                $error = "Something went wrong";
            }
        }else {
            $error = "File not uploaded! Something went wrong";
        }
    }

    echo json_encode(['error' => $error, 'success' => $success]);
}

//upload escort profile
if ($pg == 205) {
    $error = '';
    $success = '';
    $category = $db->escape($_POST['category']);
    $age = $db->escape($_POST['age']);
    $token = $db->escape($_POST['token']);
    $currency = $db->escape($_POST['currency']);
    $prices = $db->escape($_POST['prices']);
    $business = $db->escape($_POST['business']);
    $age_request = $db->escape($_POST['age_request']);
    $ethnicity = $db->escape($_POST['ethnicity']);
    $smoker = $db->escape($_POST['smoker']);
    $alcohol = $db->escape($_POST['alcohol']);
    $sexual_orientation = $db->escape($_POST['sexual_orientation']);
    $weight_request = $db->escape($_POST['weight_request']);
    $height_request = $db->escape($_POST['height_request']);
    $complexion = $db->escape($_POST['complexion']);
    $note = $_POST['note'];

    if (empty($category)) {
        $error = "Category is required!";
    }

    if (empty($age)) {
        $error = "Age is required!";
    }

    if (empty($token)) {
        $error = "Something went wrong!";
    }

    if (empty($currency)) {
        $error = "Currency is required!";
    }
    if (empty($prices)) {
        $error = "Prices is required!";
    }

    if (empty($business)) {
        $error = "Business is required!";
    }

    if (empty($age_request)) {
        $error = "All field is required!";
    }

    if (empty($ethnicity)) {
        $error = "Ethnicity is required!";
    }

    if (empty($smoker)) {
        $error = "Smoker is required!";
    }

    if (empty($alcohol)) {
        $error = "Alcohol is required!";
    }

    if (empty($sexual_orientation)) {
        $error = "Sexual orientation is required!";
    }

    if (empty($weight_request)) {
        $error = "All field is required!";
    }

    if (empty($height_request)) {
        $error = "All field is required!";
    }

    if (empty($complexion)) {
        $error = "All field is required!";
    }

    if (empty($note)) {
        $error = "All field is required!";
    }

    // File upload
    $target_dir = "../sugar_mum_dad_boy_girl/";
    $target_file  = $target_dir . basename($_FILES["fileUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $check = getimagesize($_FILES["fileUpload"]["tmp_name"]);
    if ($check == false) {
        $error =  "File is not an image";
        $uploadOk = 0;
    }

    if (file_exists($target_file)) {
        $error = "Sorry, file already exists.";
        $uploadOk = 0;
    }

    if ($_FILES["fileUpload"]["size"] > 500000) {
        $error = "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        $error = "Sorry, only JPG, JPEG, PNG files are allowed.";
        $uploadOk = 0;
    }

    if ($uploadOk == 1 && empty($error)) {
        $move_file = move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $target_file);
        if ($move_file) {
            $result = $db->saveData(TBL_ESCORTS, "user_id = '$token', category_id = '$category', entity_guid = uuid(), age = '$age', currency = '$currency', prices = '$prices', occupation = '$business', age_request = '$age_request', ethnicity = '$ethnicity', smoker = '$smoker', alcohol = '$alcohol', weight_request = '$weight_request', height_request = '$height_request', complexion = '$complexion', upload_file = '$target_file', description = '$note'");
            // var_dump($re);
            if ($result) {
                $success = "Successfully uploaded...";
            }else {
                $error = "Something went wrong";
            }
        }else {
            $error = "File not uploaded! Something went wrong";
        }
    }

    echo json_encode(['error' => $error, 'success' => $success]);
}

//Video to GIF
// if ($pg == 204) {
//     try {
//         $result = $apiInstance->videoConvertToGif($input_file, $file_url, $max_width, $max_height, $preserve_aspect_ratio, $frame_rate, $start_time, $time_span);
//         print_r($result);
//     } catch (Exception $e) {
//         echo 'Exception when calling VideoApi->videoConvertToGif: ', $e->getMessage(), PHP_EOL;
//     }
// }


//Contact Us
// if ($pg == 201) {
//     $error = '';
//     $success = '';
//     $name = $db->escape($_POST['full_name']);
//     $email = $db->escape($_POST['email']);
//     $subject = $db->escape($_POST['subject']);
//     $message = $db->escape($_POST['message']);

//     if ($db->validateEmail($email) == false) {
//         $error = "Invalid Email!";
//     }

//     if (empty($error)) {
//         $db->saveData(TBL_CONTACT, "name = '$name', email = '$email', subject = '$subject', message = '$message'");
//         $success = "Message sent successfully...";
//     }

//     echo json_encode(['error' => $error, 'success' => $success]);
// }

// //Investment process 1
// if ($pg == 202) {
//     $id = $_GET['plan_id'];
//     $token = $_GET['token_id'];
//     $error = '';
//     $success = '';

//     if (Ajax::checkIfInvested($token, $id) == false) {
//         $error = "Sorry you have invested in this plan already!";
//     } elseif (Ajax::checkIfInvested($token, $id) == true) {
//         $success = "Successful";
//     }

//     echo json_encode([
//         'error' => $error,
//         'success' => $success
//     ]);
// }

// //Investment process 2
// if ($pg == 203) {
//     $plan = $db->escape($_POST['plan']);
//     $amount = $db->escape($_POST['amount_pay']);
//     $token = $db->escape($_POST['token']);
//     $invoice = $db->escape($_POST['invoiceGen']); //echo $invoice;exit;

//     $re = $db->saveData(TBL_PAYMENTS_LOG, "user_guid = '$token', investment_plan_id = '$plan', invoice_code = '$invoice', paystack_invoice = '', amount = '$amount', payment_channel = 'FlutterWave', conditions = 'processing'");
//     var_dump($re);
//     echo json_encode('Done');
// }

// //Profile Update
// if ($pg == 204) {
//     $error = '';
//     $success = '';
//     $full_name = $db->escape($_POST['full_name']);
//     $username = $db->escape($_POST['username']);
//     $phone_number = $db->escape($_POST['phone_number']);
//     $token = $db->escape($_POST['token']);

//     if (Ajax::getUsername($username)) {
//         $error = "Sorry this username is in use!";
//         // echo json_encode($error);
//     }

//     if (empty($error)) {
//         $insert = $db->update(TBL_SYSTEM_USER, "full_name = '$full_name', username = '$username', phone_number = '$phone_number'", "user_guid = '$token'");

//         $success = "Updated successfully...";

//         // if (isset($insert)) {
//         // $outPut = array();
//         // foreach (Ajax::findUserByToken($token) as $userInfo) {}

//         // echo json_encode(
//         //     [
//         //         'name' => $userInfo['full_name'],
//         //         'username' => $userInfo['username'] ,
//         //         'phone_number' => $userInfo['phone_number']
//         //     ]
//         // );

//         // }
//     }

//     echo json_encode([
//         'error' => $error,
//         'success' => $success
//     ]);
// }

// //Profile Image Upload
// if ($pg == 205) {
//     $error = '';
//     $success = '';
//     $token = $db->escape($_POST['token']);
//     $current_image = $db->escape($_POST['current_file']);
//     // File upload
//     $target_dir = "../user/user_img/";
//     $target_file  = $target_dir . basename($_FILES["fileUpload"]["name"]);
//     $uploadOk = 1;
//     $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
//     $check = getimagesize($_FILES["fileUpload"]["tmp_name"]);
//     if ($check == false) {
//         $error =  "File is not an image";
//         $uploadOk = 0;
//     }

//     if (file_exists($target_file)) {
//         $error = "Sorry, file already exists.";
//         $uploadOk = 0;
//     }

//     if ($_FILES["fileUpload"]["size"] > 500000) {
//         $error = "Sorry, your file is too large.";
//         $uploadOk = 0;
//     }

//     if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
//         $error = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
//         $uploadOk = 0;
//     }

//     if ($uploadOk == 1) {
//         $move_file = move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $target_file);
//         if ($move_file) {
//             $db->update(TBL_SYSTEM_USER, "image = '$target_file'", "user_guid = '$token'");
//             unlink($current_image);
//             $success = "Profile uploaded successfully";
//         }
//     } else {
//         $error =  "Your file was not uploaded";
//     }

//     echo json_encode([
//         'error' => $error,
//         'success' => $success
//     ]);
// }

// //Email Update
// if ($pg == 206) {
//     $error = '';
//     $success = '';
//     $email = $db->escape($_POST['email']);
//     $token = $db->escape($_POST['token']);

//     if (empty($email)) {
//         $error = "Email is required!";
//     }

//     if ($db->validateEmail($email) == false) {
//         $error = "Invalid email address";
//     }

//     if (Ajax::getUserByEmail($email)) {
//         $error = "You can not use existing email!";
//     }

//     if (empty($error)) {
//         $insert = $db->update(TBL_SYSTEM_USER, "email = '$email'", "user_guid = '$token'");

//         $success = "Email updated successfully...";
//     }

//     echo json_encode([
//         'error' => $error,
//         'success' => $success
//     ]);
// }

// //Password Update
// if ($pg == 207) {
//     $error = '';
//     $success = '';
//     $current_password = $db->escape($_POST['current_password']);
//     $password = $db->escape($_POST['password']);
//     $cPassword = $db->escape($_POST['cPassword']);
//     $token = $db->escape($_POST['token']);

//     if (empty($password)) {
//         $error = "Password can not be empty!";
//     }

//     if (empty($current_password)) {
//         $error = "Current password can not be empty!";
//     }

//     if (empty($cPassword)) {
//         $error = "Confirm password can not be empty!";
//     }

//     if (Ajax::getPassword($password)) {
//         $error = "Current password not valid!";
//     }

//     if ($cPassword != $password) {
//         $error = "Confirm password not match!";
//     }

//     // if (DataBase::strengthPassword($password) == false) {
//     //     $error = 'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
//     // }

//     if (empty($error)) {
//         $hashPassword = password_hash($password, PASSWORD_DEFAULT);
//         $insert = $db->update(TBL_SYSTEM_USER, "password = '$hashPassword'", "user_guid = '$token'");

//         $success = "Password updated successfully...";
//     }

//     echo json_encode([
//         'error' => $error,
//         'success' => $success
//     ]);
// }

// //Cash withdrawal
// if ($pg == 208) {
//     $error = '';
//     $success = '';
//     $plan = $db->escape($_POST['plan']);
//     $amount = $db->escape($_POST['amount']);
//     $bank = $db->escape($_POST['bank']);
//     $acc_name = $db->escape($_POST['acc_name']);
//     $acc_number = $db->escape($_POST['acc_number']);
//     $token = $db->escape($_POST['token']);
//     $withdrawal_type = $db->escape($_POST['withdrawal_type']);

//     if (empty($bank)) {
//         $error = "Select a bank!";
//     }

//     if (empty($acc_name)) {
//         $error = "Fill in a your bank account name!";
//     }

//     if (empty($acc_number)) {
//         $error = "Fill in a your bank account number!";
//     }

//     if (Ajax::validateWithdrawalAmount($token, $plan, $amount, $withdrawal_type) == false) {
//         $error = "Amount you pressed is greater than plan balance";
//     }


//     if (empty($error)) {
//         if (Ajax::findUserByToken($token)) {
//             $withdrawal_code = Database::withdrawalCode();
//             $result = $db->saveData(TBL_WITHDRAWAL, "user_guid = '$token', investment_type = '$plan', withdrawal_type_id = '$withdrawal_type', crypto_id = '', wallet_id = '', account_number = '$acc_number', account_name = '$acc_name', bank = '$bank', requested_amount = '$amount', withdrawal_code = '$withdrawal_code', conditions = 'processing', status = 'unverified'");

//             if ($result) {
//                 $gets = $db->selectData(TBL_WITHDRAWAL, "*", "withdrawal_code = '$withdrawal_code'");
//                 if ($gets) {
//                     foreach ($gets as $get) {
//                         $id = $get['id'];
//                         $ref = $get['withdrawal_code'];
//                     }
//                     $code = Database::withdrawalVerificationCode();

//                     $results = $db->saveData(TBL_WITHDRAWAL_CODE, "user_guid = '$token', withdrawal_id = '$id',  code = '$code', status = 'unverified'");

//                     foreach (Ajax::findUserByToken($token) as $key) {

//                         $mail = EmailVerification::sendWithdrawCode($key['email'], $key['username'], $amount, $code, $token, $ref);

//                         // if ($mail) {
//                         $success = 'Your withdrawal slip have been submitted, check your email for verification code to complete your request';
//                         // }
//                     }
//                 } else {

//                     unset($_SESSION["user_guid"], $_SESSION["email"], $_SESSION["username"]);
//                     // $db->set('login',false);
//                     session_destroy();
//                     header("Location: 401?ec=419");
//                 }
//             } else {
//                 $error = 'Something went wrong, refresh your page before another request';
//             }

//             // $success = "Your withdrawal slip have been submitted, we will process your withdrawal in the next 45 minutes, if no objection to this withdrawal within the period. Sorry for the inconvenience.";


//         } else {
//             unset($_SESSION["user_guid"], $_SESSION["email"], $_SESSION["username"]);
//             // $db->set('login',false);
//             session_destroy();
//             header("Location: ../user/401/ec=419");
//         }
//     }

//     echo json_encode([
//         'error' => $error,
//         'success' => $success
//     ]);
// }

// //Crypto withdrawal
// if ($pg == 209) {
//     $error = '';
//     $success = '';
//     $plan = $db->escape($_POST['plan']);
//     $crypto_id = $db->escape($_POST['crypto_id']);
//     $wallet_id = $db->escape($_POST['wallet_id']);
//     $token = $db->escape($_POST['token']);
//     $amount = $db->escape($_POST['amount']);

//     if (empty($plan)) {
//         $error = "Choose an investment to withdraw!";
//     }

//     if (empty($crypto_id)) {
//         $error = "Select a crypto!";
//     }

//     if (empty($wallet_id)) {
//         $error = "Provide your wallet ID!";
//     }

//     if (empty($error)) {
//         if (Ajax::findUserByToken($token)) {
//             $withdrawal_code = Database::withdrawalCode();
//             $result = $db->saveData(TBL_WITHDRAWAL, "user_guid = '$token', investment_type = '$plan', crypto_id = '$crypto_id', wallet_id = '$wallet_id', account_number = '', account_name = '', bank = '', requested_amount = '$amount', withdrawal_code = '$withdrawal_code', conditions = 'processing', status = 'unverified'");

//             if ($result) {
//                 $gets = $db->selectData(TBL_WITHDRAWAL, "*", "withdrawal_code = '$withdrawal_code'");
//                 if ($gets) {
//                     foreach ($gets as $get) {
//                         $id = $get['id'];
//                         $ref = $get['withdrawal_code'];
//                     }
//                     $code = Database::withdrawalVerificationCode();

//                     $results = $db->saveData(TBL_WITHDRAWAL_CODE, "user_guid = '$token', withdrawal_id = '$id',  code = '$code', status = 'unverified'");

//                     foreach (Ajax::findUserByToken($token) as $key) {
//                     }
//                     $mail = EmailVerification::sendWithdrawCode($key['email'], $key['username'], $amount, $code, $token, $ref);

//                     // if ($mail) {
//                     $success = 'Your withdrawal slip have been submitted, check your email for verification code to complete your request';
//                     // }
//                 } else {
//                     unset($_SESSION["user_guid"], $_SESSION["email"], $_SESSION["username"]);
//                     // $db->set('login',false);
//                     session_destroy();
//                     header("Location: 401?ec=419");
//                 }
//             } else {
//                 $error = 'Something went wrong, refresh your page before another request';
//             }

//             // $success = "Your withdrawal slip have been submitted, we will process your withdrawal in the next 45 minutes, if no objection to this withdrawal within the period. Sorry for the inconvenience.";

//         } else {
//             unset($_SESSION["user_guid"], $_SESSION["email"], $_SESSION["username"]);
//             // $db->set('login',false);
//             session_destroy();
//             header("Location: 401?ec=419");
//         }
//     }


//     echo json_encode([
//         'error' => $error,
//         'success' => $success
//     ]);
// }

// // verify signup
// if ($pg == 2010) {
//     if (isset($_GET['val'])) {
//         $verify = $_GET['val'];
//         $error = '';
//         $success = '';

//         $code = Ajax::verifySignupCode($verify);

//         if ($code == true) {
//             $db->erase(TBL_REGISTRATION_CODE, "code = '$verify'");
//             $success = "Registration successful, you will be redirected to login page shortly";
//         } elseif ($code == false) {
//             $error = 'Invalid verification code';
//         }

//         echo json_encode([
//             'error' => $error,
//             'success' => $success
//         ]);
//     }
// }

// //withdrawal verification
// if ($pg == 2011) {
//     if (isset($_GET['val']) && isset($_GET['id'])) {
//         $verify = $_GET['val'];
//         $token = $_GET['id'];
//         $error = '';
//         $success = '';
//         // $verify = $db->escape($_POST['verify']);

//         //$code = Ajax::verifyWithdrawalCode($verify, $token);

//         if ($code == true) {
//             $db->erase(TBL_REGISTRATION_CODE, "code = '$verify'");
//             $success = "Your withdrawal slip have been submitted, we will process your withdrawal in the next 45 minutes, if no objection to this withdrawal within the period. Sorry for the inconvenience.";
//         } elseif ($code === false) {
//             $error = 'Invalid verification code';
//         }

//         echo json_encode([
//             'error' => $error,
//             'success' => $success
//         ]);
//     }
// }

// //refer withdrawal
// if ($pg == 2012) {
//     $error = '';
//     $success = '';
//     $amount = $db->escape($_POST['amount']);
//     $bank = $db->escape($_POST['bank']);
//     $acc_name = $db->escape($_POST['acc_name']);
//     $acc_number = $db->escape($_POST['acc_number']);
//     $token = $db->escape($_POST['token']);

//     if (empty($bank)) {
//         $error = "Select a bank!";
//     }

//     if (empty($acc_name)) {
//         $error = "Fill in a your bank account name!";
//     }

//     if (empty($acc_number)) {
//         $error = "Fill in a your bank account number!";
//     }

//     if (Ajax::getTotalAmount($token) == false) {
//         $error = "Amount you pressed is greater than your balance";
//     }


//     if (empty($error)) {
//         if (Ajax::findUserByToken($token)) {
//             $result = $db->saveData(TBL_BONUS_WITHDRAWAL, "user_guid = '$token', account_number = '$acc_number', account_name = '$acc_name', bank = '$bank', amount = '$amount', conditions = 'processing'");

//             if ($result) {
//                 $get = $db->selectData(TBL_REF_BONUS, "*", "user_guid = '$token'");
//                 foreach ($get as $key) {
//                     $earn = $key['earn'] - $amount;
//                     $total_amount = $key['total_amount'] - $amount;
//                     $update = $db->update(TBL_REF_BONUS, "earn = '$earn', total_amount = '$total_amount'", "user_guid = '$token'");
//                     if ($update) {
//                         $success = "Withdrawal successful...";
//                     }
//                 }
//             }
//         } else {
//             unset($_SESSION["user_guid"], $_SESSION["email"], $_SESSION["username"]);
//             // $db->set('login',false);
//             session_destroy();
//             header("Location: ../user/401/ec=419");
//         }
//     }

//     echo json_encode([
//         'error' => $error,
//         'success' => $success
//     ]);
// }

// // Recover Pasword
// if ($pg == 2013) {
//     $error = '';
//     $success = '';
//     $email = $db->escape($_POST['username']);

//     if (empty($email)) {
//         $error = "Provide a valid email address";
//     }

//     if ($db->validateEmail($email) == false) {
//         $error = "Invalid email address";
//     }

//     if (empty($error)) {
//         if (Ajax::getUserByEmail($email)) {
//             foreach (Ajax::getUserByEmail($email) as $key) {
//                 $token = $key['user_guid'];
//                 if (isset($token)) {
//                     $sent = EmailVerification::sendPasswordResendLink($email, $token);
//                     $success = "Verification link has been sent to your mail address";
//                 }
//             }
//         } else {
//             $error = 'The email you provided is not recognize';
//         }
//     } else {
//         $error = 'Something went wrong !';
//     }

//     echo json_encode([
//         'error' => $error,
//         'success' => $success
//     ]);
// }

// // Reset Password
// if ($pg == 2014) {
//     $error = '';
//     $success = '';
//     $password = $db->escape($_POST['password']);
//     $cPassword = $db->escape($_POST['cPassword']);
//     $token = $db->escape($_POST['token']);

//     if (empty($password)) {
//         $error = "New Password is required !";
//     }

//     if (empty($cPassword)) {
//         $error = "Confirm password !";
//     }

//     // if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/', $password)) {
//     //     $errors['password-preg'] = 'Password must be uppercase, lowercase, number and special characters!';
//     // }

//     if ($password != $cPassword) {
//         $error = "Password not match !";
//     }

//     if (empty($error)) {
//         if (Ajax::findUserByToken($token)) {
//             $password_hash = password_hash($password, PASSWORD_DEFAULT);

//             $db->update(TBL_SYSTEM_USER, "password='$password_hash'", "user_guid='$token'");
//             $success = "Password reset successfully";
//         } else {
//             $error = 'Sorry your reset link has been hacked !';
//         }
//     } else {
//         $error = 'Something went wrong !';
//     }

//     echo json_encode([
//         'error' => $error,
//         'success' => $success
//     ]);
// }

// // Get selling/buying currency
// if ($pg == 2015) {
//     $outPut = '';
//     $inPut = '';
//     if ($_GET['id'] == 'by') :

//         $outPut = '<option value="">Available Currencies</option>';
//         foreach (Ajax::getCurrencySellingRate() as $selling) :
//             $outPut .= '<option value="' . $selling['selling_rate'] . '">' . $selling['slug'] . '<span>/' . $selling['selling_rate'] . '</span></option>';
//         endforeach;

//         $inPut =  '<option value="">Choose Currency</option>';
//         // foreach(Ajax::getCurrencyBuyingRate() as $buying) :
//         $inPut .= '<option value="NGN">NGN</option>';
//     // endforeach;

//     elseif ($_GET['id'] == 'sl') :

//         $outPut =  '<option value="">Available Currencies</option>';
//         foreach (Ajax::getCurrencyBuyingRate() as $buying) :
//             $outPut .= '<option value="' . $buying['buying_rate'] . '">' . $buying['slug'] . '<span>/' . $buying['buying_rate'] . ' </span></option>';
//         endforeach;

//         $inPut = '<option value="">Choose Currency</option>';
//         foreach (Ajax::getCurrencySellingRate() as $selling) :
//             $inPut .= '<option value="' . $selling['slug'] . '">' . $selling['slug'] . '</option>';
//         endforeach;
//     endif;

//     echo json_encode([
//         'outPut' => $outPut,
//         'inPut' => $inPut
//     ]);
// }

// //Faq question
// if ($pg == 2016) {
//     $error = '';
//     $success = '';
//     $name = $db->escape($_POST['full_name']);
//     $email = $db->escape($_POST['email']);
//     $subject = $db->escape($_POST['subject']);
//     $message = $db->escape($_POST['message']);

//     if ($db->validateEmail($email) == false) {
//         $error = "Invalid Email!";
//     }

//     if (empty($error)) {
//         $db->saveData(TBL_FAQ_QUESTION, "name = '$name', email = '$email', subject = '$subject', message = '$message'");
//         $success = "Message sent successfully...";
//     }

//     echo json_encode(['error' => $error, 'success' => $success]);
// }

// // Admin Signup
// if ($pg == 2017) {
//     $error = '';
//     $success = '';
//     $full_name = $db->escape($_POST['full_name']); //;exit;
//     $email = $db->escape($_POST['email']); //exit;
//     $phone_number = $db->escape($_POST['tel']); //exit;
//     $role = $db->escape($_POST['role']);
//     $password = DataBase::autoGenPass(); //exit;

//     $hash_password = password_hash($password, PASSWORD_DEFAULT); //exit;

//     if (empty($full_name)) {
//         $error = "Full Name is required!";
//     }

//     if (empty($email)) {
//         $error = "Email is required!";
//     }

//     if (empty($phone_number)) {
//         $error = "Phone Number is required!";
//     }

//     if (empty($role)) {
//         $error = "Give user a role!";
//     }

//     if ($db->validateEmail($email) == false) {
//         $error = "Invalid email address";
//     }

//     if (Ajax::getAdminByEmail($email)) {
//         $error = "Email already exist!";
//     }


//     if ($db->validatePhoneNumber($phone_number) == false) {
//         $error = "Invalid phone number format";
//     }

//     if (empty($error)) {
//         $user_guid = $db->entityGuid();

//         $result = $db->saveData(TBL_ADMIN, "user_guid = '$user_guid', role_id = '$role', full_name = '$full_name', username = '', email = '$email', phone_number = '$phone_number', password = '$hash_password', image = ''");  //var_dump($result);exit;

//         if ($result) {

//             $send = emailVerification::sendAdminSignupDetails($email, $password);

//             $success = "Registration Successful...";
//         }
//     } else {
//         $errors['wrong'] = "Something went wrong!";
//     }

//     echo json_encode([
//         'error' => $error,
//         'success' => $success
//     ]);
// }

// // FX Converter
// if ($pg == 2018) {
//     $plan = $_GET['plan'];
//     $amount = $_GET['amount']; //exit;
//     $avc = $_GET['avc'];
//     $tc = $_GET['tc'];

//     $result = Ajax::currencyConverter($plan, $amount, $avc);

//     echo json_encode($result);
// }

// //Sell FX
// if ($pg == 2019) {
//     $error = '';
//     $success = '';
//     $plan = $db->escape($_POST['currency']);
//     $amount = $db->escape($_POST['amount']);
//     $bank = $db->escape($_POST['bank']);
//     $acc_name = $db->escape($_POST['acc_name']);
//     $acc_number = $db->escape($_POST['acc_number']);
//     $token = $db->escape($_POST['token']);

//     if (empty($bank)) {
//         $error = "Select a bank!";
//     }

//     if (empty($acc_name)) {
//         $error = "Fill in a your bank account name!";
//     }

//     if (empty($acc_number)) {
//         $error = "Fill in a your bank account number!";
//     }

//     $target_dir = "../user/fx_upload/";
//     $target_file  = $target_dir . basename($_FILES["fileUpload"]["name"]);
//     $uploadOk = 1;
//     $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

//     if (file_exists($target_file)) {
//         $error = "Sorry, file already exists.";
//         $uploadOk = 0;
//     }

//     if ($_FILES["fileUpload"]["size"] > 500000) {
//         $error = "Sorry, your file is too large.";
//         $uploadOk = 0;
//     }

//     if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "docs" && $imageFileType != "txt") {
//         $error = "Sorry, only JPG, JPEG, PNG & DOCS files are allowed.";
//         $uploadOk = 0;
//     }


//     if (empty($error)) {
//         if ($uploadOk == 1) {
//             if (Ajax::findUserByToken($token)) {
//                 $move_file = move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $target_file);
//                 $result = $db->saveData(TBL_EXCHANGE, "user_guid = '$token', entity_guid = uuid(), currency = '$plan', account_number = '$acc_number', account_name = '$acc_name', bank = '$bank', amount = '$amount', conditions = 'processing', file_upload = '$target_file'");

//                 EmailVerification::sendAdminCurrencySellingAlert($amount, $plan);

//                 $success = "Transaction successful, you will receive your payment within 20 minutes";
//             } else {
//                 unset($_SESSION["user_guid"], $_SESSION["email"], $_SESSION["username"]);
//                 // $db->set('login',false);
//                 session_destroy();
//                 header("Location: ../user/401/ec=419");
//             }
//         } else {
//             $error =  "Your file was not uploaded";
//         }
//     }

//     echo json_encode([
//         'error' => $error,
//         'success' => $success
//     ]);
// }

// //Investment wallet process 
// if ($pg == 2020) {
//     $error = '';
//     $success = '';
//     $plan = $db->escape($_POST['plan']);
//     $amount = $db->escape($_POST['amount']);
//     $token = $db->escape($_POST['token']);
//     $invoice = $db->escape($_POST['invoice']);

//     if (empty($amount)) {
//         $error = "This field can not be empty";
//     }

//     if($plan == 1 && $amount < 5000){
//         $error = 'Investment can not be lower than #5000!!';
//     }

//     if($plan == 2 && $amount < 20000){
//         $error = 'Investment can not be lower than #20000!!';
//     }

//     if($plan == 3 && $amount < 400000){
//         $error = 'Investment can not be lower than #50000!!';
//     }

//     if($plan == 4 && $amount < 1000000){
//         $error = 'Investment can not be lower than #200000!!';
//     }

//     if($plan == 1 && $amount > 20000){
//         $error = 'Amount too high for this plan. Kindly invest on higher plans!!';
//     }

//     if($plan == 2 && $amount > 200000){
//         $error = 'Amount too high for this plan. Kindly invest on higher plans!!';
//     }

//     if($plan == 3 && $amount > 700000){
//         $error = 'Amount too high for this plan. Kindly invest on higher plans!!';
//     }

//     if (Ajax::checkInvestorInWallet($token) == false) {
//         $error = 'You do not have cash in your wallet!!';
//     }

//     if (Ajax::getWalletBallance($token, $amount) == false) {
//         $error = "The amount is greater than your wallet ballance!!";
//     }

//     $results = $db->selectData(TBL_PLAN, "*", "id = '$plan'"); //var_dump($results);exit;

//     foreach ($results as $result) {
//         if ($amount < $result['min_plan']) {
//             $error = "Investment can not be lower than " . $result['min_plan'];
//         }
//     }

//     if (empty($error)) {
//         if (Ajax::returnWalletBallance($token, $amount) == true) {
//             $result = $db->saveData(TBL_PAYMENTS_LOG, "user_guid = '$token', investment_plan_id = '$plan', invoice_code = '$invoice', paystack_invoice = '', amount = '$amount', payment_channel = 'Wallet', conditions = 'processing'");

//             if ($result) {
//                 $selects = $db->selectData(TBL_PAYMENTS_LOG, "*", "invoice_code = '$invoice'");

//                 foreach ($selects as $key) {
//                     $id = $key['id'];
//                     $gets = $db->selectData(TBL_PLAN, "*", "id = '$plan'");

//                     foreach ($gets as $get) {
//                         $profit = ($get['percentage'] / 100) * $amount;
//                         $total = $amount + $profit;
//                         $expire_at = Database::expire_at($get['duration']);
//                         $insert = $db->saveData(TBL_TRANSACTION_LOG, "user_guid = '$token', entity_guid = uuid(), plan_id = '$plan', payments_log_id = '$id', amount = '$amount', interest = '$profit', total_amount = '$total', checker = 'invest', action = 'active', expire_at = '$expire_at'");

//                         if ($insert) {
//                             $update = $db->update(TBL_PAYMENTS_LOG, "conditions = 'successful'", "user_guid = '$token' AND invoice_code = '$invoice'");

//                             if ($update) {
//                                 $success = "Transaction Successful...";
//                             }
//                         }
//                     }
//                 }
//             }
//         } else {
//             $error = "Something went wrong, please reload your browser before another transaction";
//         }
//     }

//     echo json_encode([
//         'error' => $error,
//         'success' => $success
//     ]);
// }

// //Validate Plan
// if ($pg == 2021) {
//     $error = '';
//     $success = '';
//     $invalid = '';
//     $id = $_GET['id'];
//     $token = $_GET['token'];

//     if (Ajax::getActivePlan($id, $token) == false) {
//         $error = "You have invested on this plan";
//     } elseif (Ajax::getActivePlan($id, $token) == true) {
//         $success = "Done";
//     } else {
//         $invalid = "Invalid plan !!";
//     }

//     echo json_encode([
//         'error' => $error,
//         'success' => $success,
//         'invalid' => $invalid
//     ]);
// }

// //Fetch trading type
// if ($pg == 2022) {
//     $id = $_GET['id']; //var_dump(Ajax::getTradingTypeSubCategory($id));exit;
//     $outPut = '';
//     $outPut = '<option value="">Choose Trading Category</option>';
//     foreach (Ajax::getTradingTypeSubCategory($id) as $subCat) :
//         $outPut .= '<option value="' . $subCat['slug'] . '">' . $subCat['trading_type'] . '</option>';
//     endforeach;

//     echo json_encode($outPut);
// }

// //Traders registration
// if ($pg == 2023) {
//     $error = '';
//     $success = '';
//     $card_type = $db->escape($_POST['card_type']);
//     $card_number = $db->escape($_POST['card_number']);
//     $token = $db->escape($_POST['token']);
//     $trading_type = $db->escape($_POST['trading_type']);
//     $currency = $db->escape($_POST['currency']);
//     $username = $db->escape($_POST['username']);
//     $phone_number = $db->escape($_POST['phone_number']);
//     $profile = $db->escape($_POST['profile']);

//     if (empty($card_type)) {
//         $error = "This field can not be empty !";
//     }

//     if (empty($card_number)) {
//         $error = "Kindly input your ID card number !";
//     }

//     if (empty($trading_type)) {
//         $error = "Select a trading type !";
//     }

//     if (empty($username)) {
//         $error = "Username can not be empty !";
//     }

//     if (empty($_FILES["fileUpload"])) {
//         $error = "Kindly upload your ID card";
//     }

//     if (empty($currency)) {
//         $error = "Select a currency to trade !";
//     }

//     if (empty($phone_number)) {
//         $error = "Kindly input your phone number !";
//     }

//     if (empty($profile)) {
//         $error = "Write a short information about yourself !";
//     }

//     if (Ajax::getTraderByUsername($username)) {
//         $error = "Username already exist !";
//     }

//     if (Ajax::verifyIDCardNumber($card_number)) {
//         $error = "This card has been used to registered by another user !";
//     }

//     if (Ajax::getTraderPhoneNumber($phone_number)) {
//         $error = "Phone number already taken !";
//     }

//     // File upload
//     $target_dir = "../id_card_img/";
//     $target_file  = $target_dir . basename($_FILES["fileUpload"]["name"]);
//     $uploadOk = 1;
//     $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
//     $check = getimagesize($_FILES["fileUpload"]["tmp_name"]);
//     if ($check == false) {
//         $error =  "File is not an image";
//         $uploadOk = 0;
//     }

//     if (file_exists($target_file)) {
//         $error = "Sorry, file already exists.";
//         $uploadOk = 0;
//     }

//     if ($_FILES["fileUpload"]["size"] > 500000) {
//         $error = "Sorry, your file is too large.";
//         $uploadOk = 0;
//     }

//     if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
//         $error = "Sorry, only JPG, JPEG, PNG files are allowed.";
//         $uploadOk = 0;
//     }

//     if ($uploadOk == 1) {
//         $move_file = move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $target_file);
//         if ($move_file) {
//             $db->saveData(TBL_TRADERS, "user_guid = '$token', entity_guid = uuid(), card_type = '$card_type', card_number =          
//                 '$card_number', id_card = '$target_file', trade_type = '$trading_type', currency = '$currency', 
//                 username = '$username', bio = '$profile', phone_number = '$phone_number'");
//             $success = "Registration successfull, your account account will be verify before 24 hours.";
//         }
//     }

//     echo json_encode([
//         'error' => $error,
//         'success' => $success
//     ]);
// }

// // get Traders
// if ($pg == 2024) {
//     $token = $_GET['id']; /// echo $_GET['id'];exit;

//     $outPut = '';
//     if (Ajax::getTraders($token)) :
//         foreach (Ajax::getTraders($token) as $trader) :
//             foreach (Ajax::findUserByToken($trader['user_guid']) as $userInfo) :
//                 $outPut .= '
//                         <div class="traderContentLink"><span class="trader-online">
//                                 </span>
//                             <div class="traderMainImg">
//                                 ';
//                 if ($userInfo['image']) :
//                     $outPut .= ' <a href="./fx-traders-profile?sat=' . $trader['user_guid'] . '" ><img src="' . str_replace('../user', '.', $userInfo['image']) . '" alt=""></a>';
//                 else :
//                     $outPut .= ' <a href="./fx-traders-profile?sat=' . $trader['user_guid'] . '" ><img src="./img/avatar.jpg" alt=""></a>';
//                 endif;
//                 $outPut .= '<div class="d-flex" style="display: flex;">
//                                     <p class="" style="padding-right: 10px; margin-top:20px; height:25px; border-right:3px solid gray; font-weight:800; font-size:20px;"><a href="./fx-traders-profile?sat=' . $trader['user_guid'] . '" >' . $trader['username'] . ' </a></p>
//                                     <p style="padding-left: 5px; margin-top:20px; height:25px; font-weight:800; font-size:20px;"> ' . Database::dateDiffence($trader['created_at']) . ' Trader <span>';
//                 if ($trader['verify'] === 'verified') :
//                     $outPut .= ' <i class="fa fa-check-circle " style="color: #FF6F61;"></i>';
//                 elseif ($trader['verify'] === 'unverified') :
//                     $outPut .= ' <i class="fa fa-circle text-primary"></i>';
//                 endif;
//                 $outPut .= ' </span></p>
//                                 </div>
                                
//                                 <!-- Rating Stars Box -->
//                                 <div class="rating-stars rating-starsMain ">
//                                     <ul id="stars">
//                                     <li class="star list-unstyled" title="Poor" data-value="1">
//                                         <i class="fa fa-star fa-fw"></i>
//                                     </li>
//                                     <li class="star list-unstyled" title="Fair" data-value="2">
//                                         <i class="fa fa-star fa-fw"></i>
//                                     </li>
//                                     <li class="star list-unstyled" title="Good" data-value="3">
//                                         <i class="fa fa-star fa-fw"></i>
//                                     </li>
//                                     <li class="star list-unstyled" title="Excellent" data-value="4">
//                                         <i class="fa fa-star fa-fw"></i>
//                                     </li>
//                                     <li class="star list-unstyled" title="WOW!!!" data-value="5">
//                                         <i class="fa fa-star fa-fw"></i>
//                                     </li>
//                                     </ul>
//                                 </div>
//                             </div>
                            
//                         </div>
//                     ';
//             endforeach;
//         endforeach;
//     else : $outPout .= '<p class="text-center text-danger">No Trader available yet!</p>';
//     endif;

//     echo json_encode($outPut);
// }

// //Trader profile
// if ($pg == 2025) {
//     $token = $_GET['id']; // echo $_GET['id'];exit;

//     $outPut = '';
//     foreach (Ajax::getSingleTrader($token) as $trader) :
//         foreach (Ajax::findUserByToken($trader['user_guid']) as $userInfo) :
//             $outPut = '
//                 <div class="profile--MainBox">';
//             if ($userInfo['image']) :
//                 $outPut .= ' <a href=""><img src="' . str_replace('../user', '.', $userInfo['image']) . '" alt="" style="width: 240px;height: 240px;"></a>';
//             else :
//                 $outPut .= ' <img src="./img/avatar.jpg" alt=""></a>';
//             endif;
//             if ($trader['id_card_verify'] == 'unverified') : $outPut .= '""';
//             else :
//                 $outPut .= '
//                 <button class="chat-span icon nalika-chat" style="border:none; color:#152036; background:transparent;" onclick="location.href=`fx-trader-chat?ch=' . $trader['user_guid'] . '`"></button><br>';
//             endif;
//             $outPut .= '
//                 <h2 class="text-center">' . ucwords($userInfo['full_name']) . '</h2>
//                 <h5 class="text-center">Trading since ' . Database::dateDiffence($trader['created_at']) . ' ago </h5>
//                 <p class="text-center">' . $userInfo['email'] . '</p>';
//             if ($trader['id_card_verify'] == 'unverified') : $outPut .= '
//                     <p class="text-center">Account under review</p>';
//             else : $outPut .= '';
//             endif;
//             $outPut .= '
//                 <div class="rating-stars text-center">
//                     <ul id="stars">
//                         <li class="star list-unstyled" title="Poor" data-value="1">
//                             <i class="fa fa-star fa-fw"></i>
//                         </li>
//                         <li class="star list-unstyled" title="Fair" data-value="2">
//                             <i class="fa fa-star fa-fw"></i>
//                         </li>
//                         <li class="star list-unstyled" title="Good" data-value="3">
//                             <i class="fa fa-star fa-fw"></i>
//                         </li>
//                         <li class="star list-unstyled" title="Excellent" data-value="4">
//                             <i class="fa fa-star fa-fw"></i>
//                         </li>
//                         <li class="star list-unstyled" title="WOW!!!" data-value="5">
//                              <i class="fa fa-star fa-fw"></i>
//                         </li>
//                     </ul>
//                 </div>
//                 </div>

//                 <div class="profile--bio">
//                     <p >
//                     ' . $trader['bio'] . '
//                     </p>
//                 </div>

//                 <div class="profile--bottomContainer">
//                     <h2>Review</h2>';
//             if (Ajax::getAllSingleTraderReview($trader['user_guid'])) :
//                 foreach (Ajax::getAllSingleTraderReview($trader['user_guid']) as $review) :
//                     foreach (Ajax::findUserByToken($review['client_guid']) as $clientInfo) :
//                         $outPout .= '
//                                 <div class="profile--bottomBoxContent">
//                                     <a>
//                                         <div class="profile--bottomBox">';
//                         if ($clientInfo['image']) :
//                             $outPut .= ' <img src="' . str_replace('../user', '.', $clientInfo['image']) . '" alt="" style="width: 240px;height: 240px;"></a>';
//                         else :
//                             $outPut .= ' <img src="./img/avatar.jpg" alt=""></a>';
//                         endif;
//                         $outPut .= ' <p> ' . $trader['review'] . '</p>
//                                         </div>
//                                     </a>
//                                 </div>
//                             ';
//                     endforeach;
//                 endforeach;
//             else : $outPut .= '<h4 class="text-muted text-center">This trader have no customer review.</h4>';
//             endif;
//             $outPut .= '</div> 
//                     ';
//         endforeach;
//     endforeach;

//     echo json_encode($outPut);
// }

// //Get client iP
// if ($pg == 2026) {
//     $ip = $db->escape($_GET['ip']);

//     $ipdat = @json_decode(file_get_contents(
//         "http://www.geoplugin.net/json.gp?ip=" . $ip
//     ));

//     $country = $ipdat->geoplugin_countryName;
//     $city = $ipdat->geoplugin_city;
//     $continent = $ipdat->geoplugin_continentName;
//     $latitude = $ipdat->geoplugin_latitude;
//     $code = $ipdat->geoplugin_countryCode;
//     $longitude = $ipdat->geoplugin_longitude;
//     $timezone =  $ipdat->geoplugin_timezone;

//     // if (empty($error)) {
//     $date = date('Y M, d');
//     $get = $db->selectData(TBL_VISITORS_COUNT, "*", "ip = '$ip' AND updated_at = '$date'");
//     if ($get) {
//         foreach ($get as $key) {
//             $current = $get['current_count'] + 1;
//             $page_count = $get['page_count'] + 1;
//         }
//         $db->update(TBL_VISITORS_COUNT, "current_count = '$current', page_count = '$page_count'", "ip = '$ip'");
//     } else {
//         $db->saveData(TBL_VISITORS_COUNT, "ip = '$ip', country = '$country', city = '$city', continent = '$continent', latitude = '$latitude', country_code = '$code', longitude = '$longitude', timezone = '$timezone', current_count = '1', page_count = '1'");
//     }

//     // }

//     echo json_encode('Done');
// }

// //Fetch account details
// if ($pg == 2027) {
//     $token = $_GET['token'];
//     $id = $_GET['id'];

//     $outPut = '';
//     $outPut = '
//         <h4>Account Details</h4>
//         <table>
//             <tr>
//                 <th>Account Number</th>
//                 <th>Balance</th>
//                 <th>Action</th>
//             </tr>';
//     if ($id == 'ngn') :
//         foreach (Ajax::getWallet($token) as $wallet) :

//             $outPut .= '<tr>
//                     <td>' . $wallet['account_number'] . '</td>
//                     <td>
//                         &#8358;' . $wallet['amount'] . '
//                     </td>
//                     <td><button class="btn btn-warning"><i class="icon nalika-eye"></i></button></td>
//                 </tr>';
//         endforeach;
//     elseif ($id == 'usd') :
//         foreach (Ajax::getUSDWallet($token) as $wallet) :

//             $outPut .= '<tr>
//                     <td>' . $wallet['account_number'] . '</td>
//                     <td>
//                         &#36;' . $wallet['ballance'] . '
//                     </td>
//                     <td><button class="btn btn-warning"><i class="icon nalika-eye"></i></button></td>
//                 </tr>';
//         endforeach;
//     elseif ($id == 'pds') :
//         foreach (Ajax::getPoundWallet($token) as $wallet) :

//             $outPut .= '<tr>
//                     <td>' . $wallet['account_number'] . '</td>
//                     <td>
//                         &#163;' . $wallet['ballance'] . '
//                     </td>
//                     <td><button class="btn btn-warning"><i class="icon nalika-eye"></i></button></td>
//                 </tr>';
//         endforeach;
//     elseif ($id == 'euro') :
//         foreach (Ajax::getEuroWallet($token) as $wallet) :

//             $outPut .= '<tr>
//                     <td>' . $wallet['account_number'] . '</td>
//                     <td>
//                         &#128;' . $wallet['ballance'] . '
//                     </td>
//                     <td><button class="btn btn-warning"><i class="icon nalika-eye"></i></button></td>
//                 </tr>';
//         endforeach;
//     else : $outPut .= '<td style="color:#fff;">No transaction yet!</td>';
//     endif;
//     $outPut .=
//         '</table>';


//     echo json_encode($outPut);
// }

// //create account for old users
// if ($pg == 2028) {
//     $id = $_GET['id'];
//     $ngn = DataBase::ngnVirtualGen();
//     $us = DataBase::usaVirtualGen();
//     $pd = DataBase::poundsVirtualGen();
//     $eur = DataBase::euroVirtualGen();

//     if ($id) {
//         if (Ajax::getWallet($id)) { //echo $id.' hi';exit;
//             $nresult = $db->update(TBL_WALLET, "account_number = '$ngn'", "user_guid = '$id'");

//             $uresult = $db->saveData(TBL_US_WALLET, "user_guid = '$id', account_number = '$us', ballance = '0'");
//             $presult = $db->saveData(TBL_POUNDS_WALLET, "user_guid = '$id', account_number = '$pd', ballance = '0'");
//             $eresult = $db->saveData(TBL_EURO_WALLET, "user_guid = '$id', account_number = '$eur', ballance = '0'");

//             if ($nresult && $uresult && $presult && $eresult) {
//                 $success = "done";
//             }
//         } else { //echo $id.' hi';exit;
//             $nresult = $db->saveData(TBL_WALLET, "user_guid = '$id', token_guid = uuid(), account_number = '$ngn', amount = '0'");
//             $uresult = $db->saveData(TBL_US_WALLET, "user_guid = '$id', account_number = '$us', ballance = '0'");
//             $presult = $db->saveData(TBL_POUNDS_WALLET, "user_guid = '$id', account_number = '$pd', ballance = '0'");
//             $eresult = $db->saveData(TBL_EURO_WALLET, "user_guid = '$id', account_number = '$eur', ballance = '0'");

//             if ($nresult && $uresult && $presult && $eresult) {
//                 $success = "done";
//             }
//         }
//     }

//     echo json_encode($success);
// }

// //Get convert currency
// if ($pg == 2029) {
//     $id = $_GET['id'];
//     $outPut = '';

//     if ($id == 'NGN') { //echo 'Yes NGN';exit;
//         $result = $db->selectData(TBL_CURRENCY, "*", "slug != '$id'"); //var_dump($result);exit;

//         foreach ($result as $currency) { //var_dump($currency['slug']);exit;
//             $outPut .= ' <option value="' . $currency['slug'] . '">' . $currency['slug'] . '</option>';
//         };
//     } else { //echo 'No NGN';exit;
//         // $currency = $db->selectData(TBL_CURRENCY, "*", "slug = 'NGN'");

//         $outPut .= ' <option value="NGN">NGN</option>';
//     }

//     echo json_encode($outPut);
// }

// //Converting currency to currency
// if ($pg == 2030) {
//     $error = '';
//     $success = '';
//     $from = $_POST['currencyFrom'];
//     $to = $_POST['currencyTo'];
//     $amount = $_POST['amount'];
//     $token = $_POST['token'];

//     if (empty($from)) {
//         $error = 'Select a currency from';
//     }

//     if (empty($to)) {
//         $error = 'Select a currency to';
//     }

//     if (empty($amount)) {
//         $error = 'Specify amount to convert';
//     }

//     if (empty($amount)) {
//         $error = 'Specify amount to convert';
//     }


//     if (Ajax::findUserByToken($token) > 0) {
//         if (Ajax::getBallanceFromAnyWallet($from, $token, $amount) == false) {
//             $error = "Amount is high than balance";
//         } elseif (Ajax::getBallanceFromAnyWallet($from, $token, $amount) == true) {
//             if (Ajax::conversion($from, $to, $token, $amount)) {
//                 $success = "Transaction Successful";
//             }
//         }
//     } else {
//         header("Location: ../logout");
//     }

//     echo json_encode([
//         'error' => $error,
//         'success' => $success,
//     ]);
// }

// //Admin Profile Update
// if ($pg == 2031) {
//     $error = '';
//     $success = '';
//     $full_name = $db->escape($_POST['full_name']);
//     $username = $db->escape($_POST['username']);
//     $phone_number = $db->escape($_POST['phone_number']);
//     $token = $db->escape($_POST['token']);

//     if (Ajax::getAdminUsername($username)) {
//         $error = "Sorry this username is in use!";
//     }

//     if (empty($error)) {
//         $insert = $db->update(TBL_ADMIN, "full_name = '$full_name', username = '$username', phone_number = '$phone_number'", "user_guid = '$token'"); //var_dump($insert);exit;

//         $success = "Updated successfully...";

//         // if (isset($insert)) {
//         // $outPut = array();
//         // foreach (Ajax::findUserByToken($token) as $userInfo) {}

//         // echo json_encode(
//         //     [
//         //         'name' => $userInfo['full_name'],
//         //         'username' => $userInfo['username'] ,
//         //         'phone_number' => $userInfo['phone_number']
//         //     ]
//         // );

//         // }
//     }

//     echo json_encode([
//         'error' => $error,
//         'success' => $success
//     ]);
// }

// //Admin Profile Image Upload
// if ($pg == 2032) {
//     $error = '';
//     $success = '';
//     $token = $db->escape($_POST['token']);
//     $current_image = $db->escape($_POST['current_file']);
//     // File upload
//     $target_dir = "../user/user_img/";
//     $target_file  = $target_dir . basename($_FILES["fileUpload"]["name"]);
//     $uploadOk = 1;
//     $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
//     $check = getimagesize($_FILES["fileUpload"]["tmp_name"]);
//     if ($check == false) {
//         $error =  "File is not an image";
//         $uploadOk = 0;
//     }

//     if (file_exists($target_file)) {
//         $error = "Sorry, file already exists.";
//         $uploadOk = 0;
//     }

//     if ($_FILES["fileUpload"]["size"] > 500000) {
//         $error = "Sorry, your file is too large.";
//         $uploadOk = 0;
//     }

//     if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
//         $error = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
//         $uploadOk = 0;
//     }

//     if ($uploadOk == 1) {
//         $move_file = move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $target_file);
//         if ($move_file) {
//             $db->update(TBL_ADMIN, "image = '$target_file'", "user_guid = '$token'");
//             unlink($current_image);
//             $success = "Profile uploaded successfully";
//         }
//     } else {
//         $error =  "Your file was not uploaded";
//     }

//     echo json_encode([
//         'error' => $error,
//         'success' => $success
//     ]);
// }

// //Admin Email Update
// if ($pg == 2033) {
//     $error = '';
//     $success = '';
//     $email = $db->escape($_POST['email']);
//     $token = $db->escape($_POST['token']);

//     if (empty($email)) {
//         $error = "Email is required!";
//     }

//     if ($db->validateEmail($email) == false) {
//         $error = "Invalid email address";
//     }

//     if (Ajax::getUserByEmail($email)) {
//         $error = "You can not use existing email!";
//     }

//     if (empty($error)) {
//         $insert = $db->update(TBL_ADMIN, "email = '$email'", "user_guid = '$token'");

//         $success = "Email updated successfully...";
//     }

//     echo json_encode([
//         'error' => $error,
//         'success' => $success
//     ]);
// }

// //Admin Password Update
// if ($pg == 2034) {
//     $error = '';
//     $success = '';
//     $current_password = $db->escape($_POST['current_password']);
//     $password = $db->escape($_POST['password']);
//     $cPassword = $db->escape($_POST['cPassword']);
//     $token = $db->escape($_POST['token']);

//     if (empty($password)) {
//         $error = "Password can not be empty!";
//     }

//     if (empty($current_password)) {
//         $error = "Current password can not be empty!";
//     }

//     if (empty($cPassword)) {
//         $error = "Confirm password can not be empty!";
//     }

//     if (Ajax::getPassword($password)) {
//         $error = "Current password not valid!";
//     }

//     if ($cPassword != $password) {
//         $error = "Confirm password not match!";
//     }

//     // if (DataBase::strengthPassword($password) == false) {
//     //     $error = 'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
//     // }

//     if (empty($error)) {
//         $hashPassword = password_hash($password, PASSWORD_DEFAULT);
//         $insert = $db->update(TBL_ADMIN, "password = '$hashPassword'", "user_guid = '$token'");

//         $success = "Password updated successfully...";
//     }

//     echo json_encode([
//         'error' => $error,
//         'success' => $success
//     ]);
// }

// // Send Chat
// if ($pg == 2035) {
//     $error = '';
//     $success = '';
//     $sender_token = $db->escape($_POST['sender_token']);
//     $receiver_token = $db->escape($_POST['receiver_token']);
//     $message = $_POST['message'];
//     // $token = $db->escape($_POST['token']);

//     if (empty($message)) {
//         $error = "Empty message can not be send!";
//     }

//     if (empty($error)) {
//         $ticket = Ajax::checkChatToken($sender_token, $receiver_token);

//         $db->saveData(TBL_TRADERS_CHAT, "ticket_id = '$ticket', sender_comment = '$message', receiver_comment = '', sender_file = '', receiver_file = '', sender_notification = 'old'");
//         $success = 'Done';
//     }

//     echo json_encode([
//         'error' => $error,
//         'success' => $success
//     ]);
// }

// //Notification Count
// if ($pg == 2036) {
//     $results = $db->selectData(TBL_TRADERS_CHAT, "*"); //receiver_notify != null
//     foreach ($results as $result) {
//         $count = $result['id'];
//     }

//     // echo $count;
//     echo '';
// }

// //Fetch Chat
// if ($pg == 2037) {
//     $ch = $_GET['ch'];
//     $token = $_GET['token'];

//     $ticket = Ajax::checkSingleChatHistory($token, $ch);

//     $outPut = '';
//     if (Ajax::getSingleChat($ticket)) : foreach (Ajax::getSingleChat($ticket) as $details) :
//             if ($details['receiver_comment']) :
//                 $outPut .= '<div class="received" style="margin-bottom:5px">
//                     <div class="received__box">
//                         <p title="' . html_entity_decode($details['receiver_comment']) . '">' . htmlspecialchars_decode($details['receiver_comment']) . '</p>
//                         <span title="' . Database::time($details['receiver_time']) . '">' . Database::time($details['receiver_time']) . '</span>
//                     </div>
//                 </div>';
//             endif;
//             if ($details['sender_comment']) :
//                 $outPut .= '<div class="sent" style="margin-bottom:5px">
//                     <div class="sent__box">
//                         <p title="' . html_entity_decode($details['sender_comment']) . '">' . html_entity_decode($details['sender_comment']) . '</p>
//                         <span title="' . Database::time($details['sender_time']) . '">' . Database::time($details['sender_time']) . ' 
//                         <!--<i class="uil uil-check"></i>-->
//                         </span>
//                     </div>
//                 </div>';
//             endif;

//         endforeach;
//     endif;

//     echo json_encode($outPut);
// }

// // Vendor Messages List
// if ($pg == 2038) {
//     $token = $_GET['id'];
//     $outPut = '';

//     if (Ajax::getMessageList($token)) : 
//         foreach (Ajax::getMessageList($token) as $message_list) : 
//             $receiver_list = Ajax::getSenderMessageList($token);
//             $outPut .= '<div class="Message-List-Container listContainer" data-token="' . $message_list['ticket'] . '" onclick="showChat(' . $message_list['ticket'] . ')">
//                 <div class="message__list" onclick="closeNav()">';
//                     if($message_list['maker'] == $token):
//                         if ($$receiver_list['image']) :
//                             $outPut .= '
//                             <img src="' . $$receiver_list['image'] . '" alt="Profile Image" class="profile__message"/>';
//                         else :
//                             $outPut .= '<img src="img/avatar.jpg" alt="Profile Image" class="profile__message"/>';
//                         endif; 
//                     elseif($message_list['receiver'] == $token):
//                         if ($message_list['image']) :
//                             $outPut .= '
//                             <img src="' . $message_list['image'] . '" alt="Profile Image" class="profile__message"/>';
//                         else :
//                             $outPut .= '<img src="img/avatar.jpg" alt="Profile Image" class="profile__message"/>';
//                         endif; 
//                     endif;
//                     $outPut .= '<div class="message__listContent">';
//                         if($message_list['maker'] == $token):
//                             $outPut .= '<h5 title="'.ucwords($$receiver_list['username']).'">' . ucwords($$receiver_list['username']) . '</h5>';
//                         elseif($message_list['receiver'] == $token):
//                             $outPut .= '<h5 title="'.ucwords($message_list['username']).'">' . ucwords($message_list['username']) . '</h5>';
//                         endif;
//                             // foreach (Ajax::getLastMessage($message_list['token_guid']) as $row):
//                         $row = Ajax::getLastMessage($message_list['token_guid']); 
//                         if ($row['sender_comment']) : 
//                             $outPut .= '<p class="chat__previewText" title="' . $row['sender_comment'] . '"><span style="color:gray;font-size:12px;">';if($message_list['maker']==$token): $outPut .= 'You: ';endif; $outPut .='</span>' . htmlspecialchars($row['sender_comment']) . '</p>';
//                         elseif ($row['receiver_comment']) :
//                             $outPut .= '<p class="chat__previewText" title="' . $row['receiver_comment'] . '"><span style="color:gray;font-size:12px;">';if($message_list['receiver']==$token): $outPut .= 'You: ';endif; $outPut .='</span>' . htmlspecialchars($row['receiver_comment']) . '</p>';
//                         endif;
//                     $outPut .= '</div>
//                     <div>';
//                         if ($row['sender_time']) :
//                             $outPut .= '<span title="' . Database::time($row['sender_time']) . '"  class="chat-time">' . Database::time($row['sender_time']) . '</span>';
//                         elseif ($row['receiver_time']) :
//                             $outPut .= '<span title="' . Database::time($row['receiver_time']) . '"  class="chat-time">' . Database::time($row['receiver_time']) . '</span>';
//                         endif;
//                         // endforeach;
//                     $outPut .= '</div>
//                 </div>
//             </div>';
            
//         endforeach;//endforeach;
//     else :
//         $outPut .= '<div class="no__message"><span>You have no messages</span></div>';
//     endif;

//     echo json_encode($outPut);
// }

// // Vendor Message Header
// if ($pg == 2039) {
//     $ticket = $_GET['id'];
//     $token = $_GET['token_id'];
//     $outPut = '';
//     // var_dump(Ajax::getMessageList($token));exit;

//     if (Ajax::getSingleClientDetails($ticket) && Ajax::getSingleMessageHeaderDetails($ticket)) :
//         foreach (Ajax::getSingleClientDetails($ticket) as $user) :
//             if($user['receiver'] == $token) :
//                 if ($user['image']) :
//                     $outPut .= '<img src="' . $user['image'] . '" alt="" class="profile__message" />';
//                 else :
//                     $outPut .= '<img src="img/avatar.jpg" alt="" class="profile__message" />';
//                 endif;
//                 $outPut .= '<h2>' . ucwords($user['username']) . '</h2>
//                     <i class="uil uil-ellipsis-v"></i>';
//             elseif($user['maker'] == $token):
//                 foreach(Ajax::getSingleMessageHeaderDetails($ticket) as $receiverInfo):
//                     if ($receiverInfo['image']) :
//                         $outPut .= '<img src="' . $receiverInfo['image'] . '" alt="" class="profile__message" />';
//                     else :
//                         $outPut .= '<img src="img/avatar.jpg" alt="" class="profile__message" />';
//                     endif;
//                     $outPut .= '<h2>' . ucwords($receiverInfo['username']) . '</h2>
//                         <i class="uil uil-ellipsis-v"></i>';
//                 endforeach;
//             endif;
//         endforeach;
//     endif;

//     echo json_encode($outPut);
// }

// // Vendor Messages
// if ($pg == 2040) {
//     $ticket = $_GET['id'];
//     $token = $_GET['token_id'];
//     $outPut = '';
//     // var_dump(Ajax::getMessageList($token));exit;

//     if (Ajax::getSingleClientDetails($ticket)) :
//         foreach (Ajax::getSingleClientDetails($ticket) as $user) :
//             if($user['receiver'] == $token):
//                 if (Ajax::getSingleChat($user['token_guid'])) :

//                     foreach (Ajax::getSingleChat($user['token_guid']) as $message) :
//                         if ($message['receiver_comment']) :
//                             $outPut .= '<div class="sent" style="margin-bottom:10px;">
//                                     <div class="sent__box">
//                                         <p>' . $message['receiver_comment'] . '</p>
//                                         <span>' . Database::time($message['receiver_time']) . ' <i class="uil uil-check"></i></span>
//                                     </div>
//                                 </div>';
//                         endif;
//                         if ($message['sender_comment']) :
//                             $outPut .= '<div class="received" style="margin-bottom:10px;">
//                                     <div class="received__box">
//                                         <p>' . $message['sender_comment'] . '</p>
//                                         <span>' . Database::time($message['sender_time']) . ' </span>
//                                     </div>
//                                 </div>';
//                         endif;
//                     endforeach;

//                 endif;
//             elseif($user['maker'] == $token):
//                 foreach(Ajax::getSingleMessageHeaderDetails($ticket) as $receiverInfo):
//                     if (Ajax::getSingleChat($user['token_guid'])) :

//                         foreach (Ajax::getSingleChat($user['token_guid']) as $message) :
//                             if ($message['sender_comment']) :
//                                 $outPut .= '<div class="sent" style="margin-bottom:10px;">
//                                         <div class="sent__box">
//                                             <p>' . $message['sender_comment'] . '</p>
//                                             <span>' . Database::time($message['sender_time']) . ' <i class="uil uil-check"></i></span>
//                                         </div>
//                                     </div>';
//                             endif;
//                             if ($message['receiver_comment']) :
//                                 $outPut .= '<div class="received" style="margin-bottom:10px;">
//                                         <div class="received__box">
//                                             <p>' . $message['receiver_comment'] . '</p>
//                                             <span>' . Database::time($message['receiver_time']) . ' </span>
//                                         </div>
//                                     </div>';
//                             endif;
//                         endforeach;
    
//                     endif;
//                 endforeach;
//             endif;
//         endforeach;
//     endif;

//     echo json_encode($outPut);
// }

// // Send Chat
// if ($pg == 2041) {
//     $error = '';
//     $success = '';
//     $token = $db->escape($_POST['token']);
//     $message = $_POST['message'];
//     $tickets = $db->escape($_POST['tickets']);

//     if (empty($message)) {
//         $error = "Empty message can not be send!";
//     }

//     if (empty($error)) {
//         $ticket = Ajax::checkChatTokenId($tickets);

//         if (Ajax::checkMessageSender($token, $tickets)) {
//             foreach(Ajax::checkMessageSender($token, $tickets) as $sender){
//                 if($sender['maker'] == $token){
//                     $query = $db->saveData(TBL_TRADERS_CHAT, "ticket_id = '$ticket', sender_comment = '$message', receiver_comment = '', sender_file = '', receiver_file = '', sender_notification = 'old', receiver_notification = 'new'");

//                     if($query){
//                         $db->update(TICKET, "global = 'true'", "token_guid = '$ticket'");

//                         $success = 'Done';
//                     }
                    
//                 }elseif($sender['receiver'] == $token){
//                     $query = $db->saveData(TBL_TRADERS_CHAT, "ticket_id = '$ticket', sender_comment = '', receiver_comment = '$message', sender_file = '', receiver_file = '', sender_notification = 'new', receiver_notification = 'old'");

//                     if($query){
//                         $db->update(TICKET, "global = 'false'", "token_guid = '$ticket'");
                        
//                         $success = 'Done';
//                     }
//                 }
//             }
//         }
//     }

//     echo json_encode([
//         'error' => $error,
//         'success' => $success
//     ]);
    
// }

// //Fetch Chat
// if ($pg == 2042) {
//     $ch = $_GET['ch'];
//     $id = $_GET['token'];

//     $outPut = '';
//     if (Ajax::findUserByToken($ch)) : foreach (Ajax::findUserByToken($ch) as $userInfo) :
//             if ($userInfo['image']) :
//                 $outPut .= '<img src="' . $userInfo['image'] . '" alt="Profile Image" title="Profile Image" class="profile__message" />';
//             else :
//                 $outPut .= '<img src="img/avatar.jpg" alt="Profile Image" title="Profile Image" class="profile__message" />';
//             endif;
//             $outPut .= '
//                 <h2>' . $userInfo['username'] . '</h2>
//                 <h4 onclick="location.href=`escrobar-forum?tch=' . $id . '`" style="color:blue; cursor:pointer">Escobar</h4>
//                 <i class="uil uil-ellipsis-v"></i>
//             ';

//         endforeach;
//     endif;

//     echo json_encode($outPut);
// }

// // Vendor Messages List
// if ($pg == 2043) {
//     $token = $_GET['id'];
//     $outPut = '';

//     // var_dump(Ajax::getMessageList($token));exit;

//     if (Ajax::getMessageList($token)) :
//         foreach (Ajax::getMessageList($token) as $message_list) :
//             $outPut .= '<div class="Message-List-Container mobileContainer"  onclick="showMessageMobile(' .$message_list['ticket']. ')" data-token="' . $message_list['ticket'] . '">
//                             <div class="message__list" onclick="closeNav()">';
//                             if ($message_list['image']) :

//                                 $outPut .= '
//                                         <img src="' . $message_list['image'] . '" alt="" class="profile__message"/>';
//                             else :
//                                 $outPut .= '
//                                         <img src="img/avatar.jpg" alt="" class="profile__message"/>';
//                             endif;
//                             $row = Ajax::getLastMessage($message_list['token_guid']);
//                             $outPut .= '
//                                         <div class="message__listContent">
//                                             <h5 title="'.ucwords($message_list['username']).'">' . ucwords($message_list['username']) . '</h5>';
//                             if ($row['sender_comment']) :
//                                 $outPut .= '<p class="chat__previewText" title="' . $row['sender_comment'] . '"><span style="color:gray;font-size:12px;">';if($message_list['maker']==$token): $outPut .= 'You: ';endif; $outPut .='</span>' . htmlspecialchars($row['sender_comment']) . '</p>';
//                             elseif ($row['receiver_comment']) :
//                                 $outPut .= '<p class="chat__previewText" title="' . $row['receiver_comment'] . '"><span style="color:gray;font-size:12px;">';if($message_list['receiver']==$token): $outPut .= 'You: ';endif; $outPut .='</span>' . htmlspecialchars($row['receiver_comment']) . '</p>';
//                             endif;
//                             $outPut .= '</div>';
//                             if ($row['sender_time']) :
//                                 $outPut .= '<div>
//                                 <span class="chat-time" title="' . Database::time($row['sender_time']) . '">' . Database::time($row['sender_time']) . '</span>
//                             </div>';
//                             elseif ($row['receiver_time']) :
//                                 $outPut .= '<div>
//                                 <span class="chat-time" title="' . Database::time($row['receiver_time']) . '">' . Database::time($row['receiver_time']) . '</span>
//                             </div>';
//                             endif;
//                             $outPut .= '</div>
//                         </div>';
//         endforeach;
//     else :
//         $outPut .= '<div class="no__message"><span>You have no messages</span></div>';
//     endif;

//     echo json_encode($outPut);
// }

// // Vendor Message Header
// if ($pg == 2044) {
//     $ticket = $_GET['id'];
//     $token = $_GET['token_id'];
//     $outPut = '';
//     // var_dump(Ajax::getMessageList($token));exit;

//     if (Ajax::getSingleClientDetails($ticket)) :
//         foreach (Ajax::getSingleClientDetails($ticket) as $user) :

//             if($user['receiver'] == $token):
//                 $outPut .= '<div class="profile-container">
//                     <span style="font-size:30px;cursor:pointer;"
//                     onclick="openNav()"><i class="uil uil-bars"></i>
//                     </span>';
//                 if ($user['image']) :
//                     $outPut .= '
//                         <img src="' . $user['image'] . '" alt="" class="profile__message" />';
//                 else :
//                     $outPut .= '<img src="img/avatar.jpg" alt="" class="profile__message" />';
//                 endif;
                        
//                 $outPut .= '</div>
//                 <h2>' . ucwords($user['username']) . '</h2>
//                 <i class="uil uil-ellipsis-v"></i>';
            
//             elseif($user['maker'] == $token):
//                 foreach(Ajax::getSingleMessageHeaderDetails($ticket) as $receiverInfo):
//                     $outPut .= '<div class="profile-container">
//                     <span style="font-size:30px;cursor:pointer;"
//                     onclick="openNav()"><i class="uil uil-bars"></i>
//                     </span>';
//                     if ($receiverInfo['image']) :
//                         $outPut .= '
//                             <img src="' . $receiverInfo['image'] . '" alt="" class="profile__message" />';
//                     else :
//                         $outPut .= '<img src="img/avatar.jpg" alt="" class="profile__message" />';
//                     endif;
                            
//                     $outPut .= '</div>
//                     <h2>' . ucwords($receiverInfo['username']) . '</h2>
//                     <i class="uil uil-ellipsis-v"></i>';
//                 endforeach;
//             endif;

//         endforeach;
//     endif;

//     echo json_encode($outPut);
// }

// //Vendor Add Currency Rate
// if ($pg == 2046) {
//     $error = '';
//     $success = '';
//     $currency_type = $db->escape($_POST['currency_type']);
//     $selling_rate = $db->escape($_POST['selling_rate']);
//     $buying_rate = $db->escape($_POST['buying_rate']);
//     $token = $db->escape($_POST['token']);

//     if (empty($currency_type)) {
//         $error = 'Currency type is required!';
//     }

//     if (empty($selling_rate)) {
//         $error = 'Indicate selling rate!';
//     }

//     if (empty($buying_rate)) {
//         $error = 'Indicate buying rate!';
//     }

//     if(empty($error)){

//         $result = $db->saveData(TBL_VENDOR_RATE, "user_guid = '$token', token_guid = uuid(), traders_type_id = '2', traders_type_sub_category_id = '$currency_type', selling_rate = '$selling_rate', buying_rate = '$buying_rate'");
        
//         if($result){
//             $success = 'Rate added successfully...';
//         }
//     }

//     echo json_encode([
//         'error' => $error,
//         'success' => $success
//     ]);
// }

// //Vendor Add Crypto Currency Rate
// if ($pg == 2047) {
//     $error = '';
//     $success = '';
//     $currency_type = $db->escape($_POST['currency_type']);
//     $selling_rate = $db->escape($_POST['selling_rate']);
//     $buying_rate = $db->escape($_POST['buying_rate']);
//     $token = $db->escape($_POST['token']);

//     if (empty($currency_type)) {
//         $error = 'Currency type is required!';
//     }

//     if (empty($selling_rate)) {
//         $error = 'Indicate selling rate!';
//     }

//     if (empty($buying_rate)) {
//         $error = 'Indicate buying rate!';
//     }

//     if(empty($error)){

//         $result = $db->saveData(TBL_VENDOR_RATE, "user_guid = '$token', token_guid = uuid(), traders_type_id = '1', traders_type_sub_category_id = '$currency_type', selling_rate = '$selling_rate', buying_rate = '$buying_rate'");
        
//         if($result){
//             $success = 'Rate added successfully...';
//         }
//     }

//     echo json_encode([
//         'error' => $error,
//         'success' => $success
//     ]);
// }

// // Show Vendor Rate
// if ($pg == 2048) {
//     $id = $_GET['id'];
//     $outPut = '';
//     // var_dump(Ajax::getSingleCryptoVendorRate($id));exit;

//     if (Ajax::getSingleCryptoVendorRate($id)) :
//         foreach (Ajax::getSingleCryptoVendorRate($id) as $rate) :

//             $outPut .= '<div class="modal-content">
//             <div class="modal-header">';
//             if($_GET['ed']==2):
//                 $outPut .= '<h2 class="modal-title" id="exampleModalLabel"> Edit '. $rate['trading_type'].' Rate</h2>';
//             else:
//                 $outPut .= '<h2 class="modal-title" id="exampleModalLabel">'. $rate['trading_type'].' Rate</h2>';
//             endif;
//                 $outPut .= '<button type="button" class="close" data-dismiss="modal" aria-label="Close">
//                 <span aria-hidden="true">&times;</span>
//               </button>
//             </div>
//             <div class="modal-body">
//               <form action="" method="post" id="editFxRateForm">
//                     <div class="form-group">
//                         <li class="alert alert-success list-unstyled" style="display: none;"></li>
//                         <li class="alert alert-danger list-unstyled" style="display: none;"></li>
//                     </div>
//                   <div class="form-group">
//                       <label for="exampleInputEmail1">Currency Type</label>
//                       <select name="currency_type" id="" class="form-control">
//                           <option value="'.$rate['entity_guid'].'">'.$rate['trading_type'].'</option>
//                       </select>
//                   </div>
//                   <div class="form-group">
//                       <label for="exampleInputEmail1">Selling Rate</label>
//                       <input type="number" class="form-control" name="selling_rate" id="exampleInputEmail1" aria-describedby="emailHelp" value="'.$rate['selling_rate'].'">
//                   </div>
//                   <div class="form-group">
//                       <label for="exampleInputPassword1">Buying Rate</label>
//                       <input type="number" class="form-control" name="buying_rate" id="exampleInputPassword1" value="'.$rate['buying_rate'].'">
//                       <input type="hidden"name="token_id" id="exampleInputPassword1" value="'.$_GET['id'].'">
//                   </div>
//                   </div>
//                   <div class="modal-footer">
//                       <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>';
//                       if($_GET['ed']==2) :
//                         $outPut .= '<button type="submit" class="btn btn-success">Save changes</button>';
//                       endif;
//                     $outPut .= '</div>
//               </form>
//           </div>';

//         endforeach;
//     endif;

//     echo json_encode($outPut);
// }

// //Vendor Edit Currency Rate
// if ($pg == 2049) {
//     $error = '';
//     $success = '';
//     $currency_type = $db->escape($_POST['currency_type']);
//     $selling_rate = $db->escape($_POST['selling_rate']);
//     $buying_rate = $db->escape($_POST['buying_rate']);
//     $id = $db->escape($_POST['token_id']);

//     if (empty($currency_type)) {
//         $error = 'Currency type is required!';
//     }

//     if (empty($selling_rate)) {
//         $error = 'Indicate selling rate!';
//     }

//     if (empty($buying_rate)) {
//         $error = 'Indicate buying rate!';
//     }

//     if(empty($error)){

//         $result = $db->update(TBL_VENDOR_RATE, "traders_type_sub_category_id = '$currency_type', selling_rate = '$selling_rate', buying_rate = '$buying_rate'", "token_guid = '$id'");
        
//         if($result){
//             $success = 'Rate updated successfully...';
//         }
//     }

//     echo json_encode([
//         'error' => $error,
//         'success' => $success
//     ]);
// }

// //Vendor Edit Currency Rate
// if ($pg == 2050) {
//     $error = '';
//     $success = '';
//     $username = $db->escape($_POST['username']);
//     $number = $db->escape($_POST['number']);
//     $bio = $_POST['bio'];
//     $token = $db->escape($_POST['token']);

//     if (empty($username)) {
//         $error = 'Username is required!';
//     }

//     if (empty($number)) {
//         $error = 'Number is required!';
//     }

//     if (empty($bio)) {
//         $error = 'Bio is required!';
//     }

//     if (strlen($bio) < 250) {
//         $error = 'Bio can not be less than 250 words!';
//     }

//     if (strlen($bio) > 500) {
//         $error = 'Bio can not be greater than 500 words!';
//     }

//     if(empty($error)){

//         $result = $db->update(TBL_TRADERS, "username = '$username', bio = '$bio', phone_number = '$number'", "user_guid = '$token'");
        
//         if($result){
//             $success = 'Profile updated successfully...';
//         }
//     }

//     echo json_encode([
//         'error' => $error,
//         'success' => $success
//     ]);
// }

// //Transfer
// if ($pg == 2051) {
//     $error = '';
//     $success = '';
//     $virtual_account = $db->escape($_POST['virtual_account']);
//     $account_balance = $db->escape($_POST['account_balance']);
//     $amount = $db->escape($_POST['amount']);
//     $rec_acc_number = $db->escape($_POST['rec_acc_number']);
//     $rec_acc_name = $db->escape($_POST['rec_acc_name']);
//     $token = $db->escape($_POST['token']);

//     if (empty($virtual_account)) {
//         $error = 'Select an account!';
//     }

//     if (empty($amount)) {
//         $error = 'Amount is required!';
//     }

//     if (empty($rec_acc_number)) {
//         $error = 'Receiver account number is required!';
//     }

//     if (Ajax::checkAccountBalance($token, $virtual_account, $amount) === false) {
//         $error = 'Insufficient account balance';
//     }


//     if(empty($error)){

//         $result = Ajax::transferFunds($token, $amount, $virtual_account, $rec_acc_number);
        
//         if($result == true){
//             $success = 'Transaction successfully...';
//         }elseif($result == false){
//             $error = 'Something went wrong, reload your browser';
//         }
//     }

//     echo json_encode([
//         'error' => $error,
//         'success' => $success
//     ]);
// }

// //Testimony
// if ($pg == 2052) {
//     $error = '';
//     $success = '';
//     $name = $db->escape($_POST['name']);
//     $token = $db->escape($_POST['token']);
//     $accept = $db->escape($_POST['accept']);
//     $satisfy_rate = $db->escape($_POST['satisfy_rate']);
//     $recommend = $db->escape($_POST['recommend']);
//     $rate = $db->escape($_POST['rate']);
//     $customer_service = $db->escape($_POST['customer_service']);
//     $message = $db->escape($_POST['message']);

//     if (empty($name)) {
//         $error = 'Name can not be empty!';
//     }

//     if (empty($satisfy_rate)) {
//         $error = 'How satisfy are you?';
//     }

//     if (empty($rate)) {
//         $error = 'Kindly rate us';
//     }

//     if (empty($customer_service)) {
//         $error = 'Can you rate our customer service?';
//     }

//     if (empty($message)) {
//         $error = 'How satisfy are you in general?';
//     }

//     if(empty($error)){

//         $result = $db->saveData(TBL_TESTIMONY, "user_guid = '$token', token_guid = uuid(), accept = '$accept', satisfy_rate = '$satisfy_rate', recommend = '$recommend', rate = '$rate', customer_service = '$customer_service', message = '$message'");

//         if($result){
//             $success = 'Sent successfully. Thanks for your time...';
//         }
//     }

//     echo json_encode([
//         'error' => $error,
//         'success' => $success
//     ]);
// }

// //Asiri Betting
// if ($pg == 2053) {
//     $error = '';
//     $success = '';
//     $amount_play = $db->escape($_POST['amount_play']);
//     $game = $db->escape($_POST['game']);
//     $id = $db->escape($_POST['game_id']);
//     $token = $db->escape($_POST['token']);

//     if (empty($amount_play)) {
//         $error = 'Amount field can not be empty';
//     }

//     if (empty($game)) {
//         $error = 'Game can not be empty';
//     }


//     if (Ajax::getSingleGameById($id, $game) == false) {
//         $error = 'Game length is higher or lower to the game rule';
//     }

//     if (empty($error)) {
//         $return = Ajax::getSingleGameReturn($id, $amount_play);
//         $game_result = Ajax::gameResult($id, $game);
//         $decode = Ajax::decodeGameResult($game_result);
//         if ($decode === $game) {
//             if (Ajax::ballanceWalletOnBet($game, $amount_play, $decode, $token) == true) {
//                 $result = $db->saveData(TBL_ARENA, "token_guid = uuid(), user_id = '$token', bet_id = '$id', amount_played = '$amount_play', returns = '$return', game_played = '$game', result = '$game_result', game_status = 'Win'");

//                 if($result){
//                     $success = "Game successful, check your game on the result table";
//                 }
//             }else{
//                 $error = "Something went wrong";
//             }

//         }else{

//             if (Ajax::ballanceWalletOnBet($game, $amount, $decode, $token) == true) {
//                 $result = $db->saveData(TBL_ARENA, "token_guid = uuid(), user_id = '$token', bet_id = '$id', amount_played = '$amount_play', returns = '$return', game_played = '$game', result = '$game_result'");

//                 if($result){
//                     $success = "Game successful, check your game on the result table";
//                 }
//             }else{
//                 $error = "Something went wrong";
//             }
//         }
//     }

//     echo json_encode([
//         'error' => $error,
//         'success' => $success
//     ]);
// }