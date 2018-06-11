<?php
require_once '../model/DbOperations.php';

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['username']) || !empty($_POST['password'])) {
        $db = new DbOperations;

        if ($db->userLogin($_POST['username'], $_POST['password'])){
            $user = $db->getUser($_POST['username']);

            $response['error'] = false;
            $response['id'] = $user->user_id;
            $response['username'] = $user->user_uid;
            $response['email'] = $user->user_email;
            $response['phone'] = ($user->phone_number == null) ? "not set": $user->phone_number;
            $response['image_link'] = $user->user_image;

        }else{
            $response['error'] = true;
            $response['message'] = 'invalid username or password';
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
