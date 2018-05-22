<?php
require_once '../model/DbOperations.php';


$response = array();
$response_data = array();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!empty($_GET['limit']) && !empty($_GET['search_term']) ) {
        $db = new DbOperations();
        $limit = (int)$_GET['limit'];
        $search_term = $_GET['search_term'];

        if (!empty($_GET['start'])) {
            $start = (int)$_GET['start'];
            $response['error'] = false;
            $response['data'] = $db->searchMorePosts($search_term, $start, $limit);
            $response['total'] = $db->searchPostsCount($search_term);
            $response['next_start'] = $start+$limit;
        } else {
            $response['error'] = false;
            $total = $db->searchPostsCount($search_term);
            if ($total > 0) {
                $response['data'] = $db->searchFewPosts($search_term, $limit);
                $response['total'] = $total;
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