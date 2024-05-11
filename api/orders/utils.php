<?php
function fetch($url, $options = [])
{
    $default_options = [
        'method' => 'GET',
        'headers' => [],
        'body' => null,
    ];

    $options = array_merge($default_options, $options);

    $header_lines = [];
    foreach ($options['headers'] as $key => $value) {
        $header_lines[] = $key . ': ' . $value;
    }

    $context_options = [
        'http' => [
            'method' => $options['method'],
            'header' => implode("\r\n", $header_lines),
            'content' => $options['body'],
        ]
    ];

    $context = stream_context_create($context_options);
    $response = file_get_contents($url, false, $context);

    return $response;
}

function generateAccessToken()
{
    global $BASE_URL, $PAYPAL_CLIENT_ID, $PAYPAL_CLIENT_SECRET, $AUTH_URL;

    $AUTH_URL = $BASE_URL . "/v1/oauth2/token";
    $auth = base64_encode($PAYPAL_CLIENT_ID . ":" . $PAYPAL_CLIENT_SECRET);

    $options = [
        'method' => 'POST',
        'headers' => [
            "Content-Type" => "application/x-www-form-urlencoded",
            "Authorization" => "Basic $auth",
        ],
        'body' => "grant_type=client_credentials",
    ];
    try {
        return json_decode(fetch($AUTH_URL, $options))->access_token;
    } catch (\Throwable $th) {
        return null;
    }
}