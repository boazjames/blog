<?php
require_once '../model/DbOperations.php';

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $code = rand(10000, 99999);

    if (!empty($username) && !empty($email) && !empty($phone) && !empty($password) && !empty($confirm_password)) {
        $db = new DbOperations;
        if ($db->createUser($username, $email, $phone, $password, $confirm_password, $code) == 2) {
            $to = $email;
            $subject = 'Signup | Verification'; // Give the email a subject
            $message = '
 
Thanks for signing up! Use the verification code below to activate your account.
 
------------------------
Verification code: ' . $code . '
------------------------

Together we are KiddNation254.
 ';

            $headers = 'From: KiddNation254 <support@kiddnation254.com>' . "\r\n"; // Set from headers
            mail($to, $subject, $message, $headers);
            $response['error'] = false;
            $response['email'] = $email;
            $response['message'] = 'user registered successfully';
        } elseif ($db->createUser($username, $email, $phone, $password, $confirm_password, $code) == 0) {
            $response['error'] = true;
            $response['message'] = 'username, mobile number or email already exists';
        } elseif ($db->createUser($username, $email, $phone, $password, $confirm_password, $code) == 3) {
            $response['error'] = true;
            $response['message'] = 'invalid email';
        } elseif ($db->createUser($username, $email, $phone, $password, $confirm_password, $code) == 4) {
            $response['error'] = true;
            $response['message'] = 'invalid mobile number';
        } elseif ($db->createUser($username, $email, $phone, $password, $confirm_password, $code) == 5) {
            $response['error'] = true;
            $response['message'] = 'password does not match';
        } else {
            $response['error'] = true;
            $response['message'] = 'some error occurred please try again';
        }

    } else {
        $response['error'] = true;
        $response['message'] = 'fill all required fields';
    }
} else {
    $response['error'] = true;
    $response['message'] = 'invalid request';
}

echo json_encode($response);
