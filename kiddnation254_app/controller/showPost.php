<?php
require_once '../model/DbOperations.php';


$response = array();
$response_data = array();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if(!empty($_GET['id'])) {
        $db = new DbConnect();
        $id = $_GET['id'];
        $db = new DbOperations();
        $data = $db->showPost((int)$id);

        $response['error'] = false;
        $response['id'] = $data->id;
        $response['title'] = $data->title;
        $response['body'] = $data->body;
        $response['author'] = $data->author;
        $response['time'] = $data->time;
        $response['post_image'] = $data->post_image;

    }else{
        $response['error'] = true;
        $response['message'] = 'empty request';
    }

} else {
    $response['error'] = true;
    $response['message'] = 'invalid request';
}

echo json_encode($response);
