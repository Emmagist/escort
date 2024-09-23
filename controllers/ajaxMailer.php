<?php
    
    require "../phpMailer.php";

    if (isset($_GET['pg'])) {
        $pg = $_GET['pg'];
    }

    //Email Sender
    if ($pg == 201) {
        $error = '';
        $success = '';
        $name = $_POST['name'];
        $subject = $_POST['subject'];
        // $to = $_POST['email'];
        $body = $_POST['code'];
        $from = $_POST['from'];
        $reply = $_POST['reply'];
        $attach = '';
        // echo explode('', $to);exit;

        if (empty($name)) {
            $error = 'Sender name is required';
        }

        // if (empty($to)) {
        //     $error = 'Email is required';
        // }

        if (empty($subject)) {
            $error = 'Subject is required';
        }

        if (empty($body)) {
            $error = 'Paste your Html code here';
        }

        if (empty($from)) {
            $error = 'Sender email required';
        }

        if(empty($error)){
            // foreach(Ajax::getAllUserEmails() as $to){

                $mail = Mailer::bulkMailer($from, $name, $reply, $subject, $body, $attach);

                // var_dump($mail);exit;

                if($mail){
                    $success = 'Mail sent successfully...';
                }
            // }
        }

        echo json_encode([
            'error' => $error,
            'success' => $success
        ]);
    }

?>