<?php
require_once 'constants.php';
require_once 'utils.php';

// Uncomment the following line if you want to pass more complex data in the request body
// $inputJSON = file_get_contents('php://input');
// $input = json_decode($inputJSON, true);

function createOrder($price)
{
    global $BASE_URL;

    $accessToken = generateAccessToken();

    $ORDER_URL = $BASE_URL . '/v2/checkout/orders';

    $payload = [
        'intent' => 'CAPTURE',
        'purchase_units' => [
            [
                'amount' => [
                    'currency_code' => 'EUR',
                    'value' => $price
                ]
            ]
        ]
    ];

    $options = [
        'method' => 'POST',
        'headers' => [
            'Content-Type' => 'application/json',
            'Authorization' => "Bearer $accessToken",
            // To force an error for negative testing (in sandbox mode only). Documentation:
            // https://developer.paypal.com/tools/sandbox/negative-testing/request-headers/
        ],
        'body' => json_encode($payload),
    ];

    try {
        return fetch($ORDER_URL, $options);
    } catch (\Throwable $th) {
        print_r($th);
    }
}

echo createOrder(1802);