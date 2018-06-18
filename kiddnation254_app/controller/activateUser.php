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
                $user = $db->getUser($email);
                $response['error'] = false;
                $response['id'] = $user->user_id;
                $response['username'] = $user->user_uid;
                $response['email'] = $user->user_email;
                $response['phone'] = ($user->phone_number == null) ? "not set": $user->phone_number;
                $response['image_link'] = $user->user_image;
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
