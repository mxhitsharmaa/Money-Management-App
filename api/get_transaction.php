<?php

header("Content-Type: application/json");

require_once "../config/database.php";

$id = (int)($_GET["id"] ?? 0);
$userId = (int)($_GET["user_id"] ?? 0);

if ($id <= 0 || $userId <= 0) {
    http_response_code(422);

    echo json_encode([
        "success" => false,
        "message" => "Invalid transaction ID or user ID"
    ]);

    exit;
}

$stmt = $pdo->prepare(
    "SELECT
        id,
        type,
        category,
        amount,
        description,
        transaction_date,
        created_at
     FROM transactions
     WHERE id = ?
       AND user_id = ?
     LIMIT 1"
);

$stmt->execute([$id, $userId]);

$transaction = $stmt->fetch();

if (!$transaction) {
    http_response_code(404);

    echo json_encode([
        "success" => false,
        "message" => "Transaction not found"
    ]);

    exit;
}

echo json_encode([
    "success" => true,
    "transaction" => $transaction
]);