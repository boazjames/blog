<?php
require_once '../model/DbOperations.php';

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['code']) || !empty($_POST['email'])) {
        $db = new DbOperations;
        $code = (int)$_POST['code'];
        $email = $_POST['email'];

        if ($db->verifyPasswordResetCode($email, $code)) {
                $response['error'] = false;
                $response['message'] = "Password reset code successfully verified. You can now reset your password";
            } else {
            $response['error'] = true;
            $response['message'] = 'invalid password reset code';
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
