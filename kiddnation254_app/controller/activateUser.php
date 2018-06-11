<?php
require_once '../model/DbOperations.php';

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['code']) || !empty($_POST['email'])) {
        $db = new DbOperations;
        $code = (int) $_POST['code'];
        $email = $_POST['email'];

        if ($db->verifyCode($email, $code)) {
            if ($db->activateUser($email)) {
                $response['error'] = false;
                $response['message'] = "You have successfully activated your account. You can now login";
            } else {
                $response['error'] = true;
                $response['message'] = 'error';
            }

        } else {
            $response['error'] = true;
            $response['message'] = 'invalid verification code';
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
