<?php
require_once 'constants.php';
require_once 'utils.php';

// Read the JSON input
$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, true);

// Check if order_id is provided in the request body
if (!isset($input['orderID'])) {
    http_response_code(400); // Bad Request
    echo json_encode(array('error' => 'orderID is required in the request body'));
    exit();
}

$ORDER_ID = $input['orderID'];

function captureOrder($ORDER_ID)
{
    global $BASE_URL;

    $accessToken = generateAccessToken();

    $CAPTURE_URL = $BASE_URL . '/v2/checkout/orders/' . $ORDER_ID . '/capture';

    return fetch($CAPTURE_URL, [
        'method' => 'POST',
        'headers' => [
            'Content-Type' => 'application/json',
            'Authorization' => "Bearer $accessToken",
        ],
    ]);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo captureOrder($ORDER_ID);
} else {
    http_response_code(405);
    echo json_encode(array('error' => 'Method Not Allowed'));
}
