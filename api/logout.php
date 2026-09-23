<?php

header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);

    echo json_encode([
        "success" => false,
        "message" => "Method not allowed"
    ]);

    exit;
}

/*
|--------------------------------------------------------------------------
| Logout
|--------------------------------------------------------------------------
| Current API authentication is user_id based.
| When token/session authentication is added, this endpoint
| will also revoke the active authentication token.
|--------------------------------------------------------------------------
*/

echo json_encode([
    "success" => true,
    "message" => "Logout successful"
]);