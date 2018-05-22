<?php
require_once "../model/DbOperations.php";
$response = array();

//$server_ip = gethostbyname(gethostname());

$dst = "../../kidd_nation/user_images/";


if (!empty($_FILES['file']['name']) && !empty($_POST['userId'])) {
    $db = new DbOperations();
    $v1 = rand(1111, 9999);
    $v2 = rand(1111, 9999);
    $v3 = $v1 . $v2;
    $fnm = "KiddNation254_".$v3.$_FILES['file']['name'];
    $dst = $dst.$fnm;
    $user_id = (int)$_POST['userId'];
    if( move_uploaded_file($_FILES['file']['tmp_name'], $dst) && $db->updateUserImageLink($user_id, $fnm)){
        $response['error'] = false;
        $response['message'] = "profile photo changed successfully";
        $response['user_image'] = $fnm;
    }else{
        $response['error'] = true;
        $response['message'] = "unable to change profile photo";
    }

} else {
    $response['error'] = true;
    $response['message'] = 'File is missing';
}

echo json_encode($response);
