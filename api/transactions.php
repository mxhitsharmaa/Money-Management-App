<?php

header("Content-Type: application/json");

require_once "../config/database.php";

$userId = (int)($_GET["user_id"] ?? 0);

if ($userId <= 0) {
    http_response_code(422);

    echo json_encode([
        "success" => false,
        "message" => "Invalid user ID"
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
     WHERE user_id = ?
     ORDER BY transaction_date DESC, id DESC"
);

$stmt->execute([$userId]);

$transactions = $stmt->fetchAll();

echo json_encode([
    "success" => true,
    "transactions" => $transactions
]);