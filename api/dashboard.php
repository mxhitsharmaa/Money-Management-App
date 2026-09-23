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
        COALESCE(SUM(CASE
            WHEN type = 'income' THEN amount
            ELSE 0
        END), 0) AS total_income,

        COALESCE(SUM(CASE
            WHEN type = 'expense' THEN amount
            ELSE 0
        END), 0) AS total_expense

     FROM transactions
     WHERE user_id = ?"
);

$stmt->execute([$userId]);

$data = $stmt->fetch();

$income = (float)$data["total_income"];
$expense = (float)$data["total_expense"];
$balance = $income - $expense;

echo json_encode([
    "success" => true,
    "dashboard" => [
        "total_income" => $income,
        "total_expense" => $expense,
        "balance" => $balance
    ]
]);