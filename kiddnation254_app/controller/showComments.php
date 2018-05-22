<?php
require_once '../model/DbOperations.php';


$response = array();
$response_data = array();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!empty($_GET['postId']) && !empty($_GET['limit'])) {
        $db = new DbOperations();
        $postId = (int)$_GET['postId'];
        $limit = (int)$_GET['limit'];

        if (!empty($_GET['start'])) {
            $start = (int)$_GET['start'];
            $response['error'] = false;
            $response['data'] = $db->showMoreComments($postId, $start, $limit);
            $response['total'] = $db->commentsCount($postId);
            $response['next_start'] = $start+$limit;
        } else {
            $response['error'] = false;
            $total = $db->commentsCount($postId);
            if ($total > 0) {
                $response['data'] = $db->showFewComments($postId, $limit);
                $response['total'] = $db->commentsCount($postId);
                $response['next_start'] = $limit;
                $response['noData'] = false;
            } else {
                $response['noData'] = true;
            }
        }
    } else {
        $response['error'] = true;
        $response['message'] = 'empty request';
    }

} else {
    $response['error'] = true;
    $response['message'] = 'invalid request';
}

echo json_encode($response);