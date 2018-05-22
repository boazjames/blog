<?php
require_once "../model/DbOperations.php";

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $db = new DbOperations();

    if ($db->showLatestQuote()) {
        $response['error'] = false;
        $quote = $db->showLatestQuote();
        $response['id'] = $quote->id;
        $response['body'] = $quote->body;
        $response['author'] = $quote->author;
    } else {
        $response['error'] = true;
        $response['message'] = "unable to get quote";
    }
} else {
    $response['error'] = true;
    $response['message'] = 'invalid request';
}

echo json_encode($response);