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
            $response['message'] = "Password reset was successful. You can now login";
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
