<?php
require_once '../model/DbOperations.php';

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['password']) || !empty($_POST['email'])) {

        $db = new DbOperations;
        $password = (int)$_POST['password'];
        $email = $_POST['email'];

        if ($db->resetPassword($email, $password)) {
            $response['error'] = false;
            $user = $db->getUser($email);
            $response['id'] = $user->user_id;
            $response['username'] = $user->user_uid;
            $response['email'] = $user->user_email;
            $response['phone'] = ($user->phone_number == null) ? "not set": $user->phone_number;
            $response['image_link'] = $user->user_image;
        } else {
            $response['error'] = true;
            $response['message'] = 'cannot reset password';
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
