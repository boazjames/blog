<?php

require_once "../model/DbOperations.php";

$response = array();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(!empty($_POST['post_id']) && !empty($_POST['user_id']) && !empty($_POST['comment'])){
        $db = new DbOperations();
        date_default_timezone_set("Africa/Nairobi");
        $date = date('Y-m-d H:i:s');
        $post_id = (int)$_POST['post_id'];
        $user_id = $_POST['user_id'];
        $comment = $_POST['comment'];
        $user = $db->getUserWithId($user_id);
        $username = $user->user_uid;
        $user_img = $user->user_image;

	if(!$user_img){
	    $user_img = "user.jpg";
	}

        if($db->insertComment($post_id, $user_id, $date, $username, $user_img, $comment)){
            $response['error'] = false;
            $response['message'] = "comment added successfully";
        }else{
            $response['error'] = true;
            $response['message'] = "system unable to insert comment";
        }
    }else{
        $response['error'] = true;
        $response['message'] = "empty request";
    }

}else{
    $response['error'] = true;
    $response['message'] = "invalid request";
}

echo json_encode($response);
