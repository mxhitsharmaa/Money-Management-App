<?php

header("Content-Type: application/json");

require_once "../config/database.php";

if ($_SERVER["REQUEST_METHOD"] !== "DELETE") {
    http_response_code(405);

    echo json_encode([
        "success" => false,
        "message" => "Method not allowed"
    ]);

    exit;
}

$data = json_decode(file_get_contents("php://input"), true);

$id = (int)($data["id"] ?? 0);
$userId = (int)($data["user_id"] ?? 0);

if ($id <= 0 || $userId <= 0) {
    http_response_code(422);

    echo json_encode([
        "success" => false,
        "message" => "Invalid transaction ID or user ID"
    ]);

    exit;
}

$stmt = $pdo->prepare(
    "DELETE FROM transactions
     WHERE id = ?
       AND user_id = ?"
);

$stmt->execute([$id, $userId]);

if ($stmt->rowCount() === 0) {
    http_response_code(404);

    echo json_encode([
        "success" => false,
        "message" => "Transaction not found"
    ]);

    exit;
}

echo json_encode([
    "success" => true,
    "message" => "Transaction deleted successfully"
]);