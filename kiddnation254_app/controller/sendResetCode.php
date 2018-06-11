<?php
require_once '../model/DbOperations.php';

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['email'])) {
        $db = new DbOperations;
        $email = $_POST['email'];
        $code = rand(10000, 99999);

        if ($db->doesEmailExist($email)) {
            if ($db->updatePasswordResetCode($email, $code)) {

                $to = $email;
                $subject = 'Password Reset'; // Give the email a subject
                $message = '
 
You have received this email because you requested for password reset. If it was not you please contact us.
 
------------------------
Reset code: ' . $code . '
------------------------

Together we are KiddNation254.
 ';

                $headers = 'From: KiddNation254 <support@kiddnation254.com>' . "\r\n"; // Set from headers
                mail($to, $subject, $message, $headers);

                $response['error'] = false;
                $response['email'] = $email;
                $response['message'] = "Password reset code have been sent to your email";
            }

        } else {
            $response['error'] = true;
            $response['message'] = 'email does not exist';
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
