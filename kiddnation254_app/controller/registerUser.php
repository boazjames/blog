<?php
require_once '../model/DbOperations.php';

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (!empty($username) && !empty($email) && !empty($phone) && !empty($password) && !empty($confirm_password)) {
        $db = new DbOperations;
        if ($db->createUser($username, $email, $phone, $password, $confirm_password) == 2) {
            $response['error'] = false;
            $response['message'] = 'user registered successfully';
        } elseif ($db->createUser($username, $email, $phone, $password, $confirm_password) == 0) {
            $response['error'] = true;
            $response['message'] = 'username, mobile number or email already exists';
        } elseif ($db->createUser($username, $email, $phone, $password, $confirm_password) == 3) {
            $response['error'] = true;
            $response['message'] = 'invalid email';
        } elseif ($db->createUser($username, $email, $phone, $password, $confirm_password) == 4) {
            $response['error'] = true;
            $response['message'] = 'invalid mobile number';
        } elseif ($db->createUser($username, $email, $phone, $password, $confirm_password) == 5) {
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
