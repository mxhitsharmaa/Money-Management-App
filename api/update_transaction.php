<?php

header("Content-Type: application/json");

require_once "../config/database.php";

if ($_SERVER["REQUEST_METHOD"] !== "PUT") {
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

$type = $data["type"] ?? "";
$category = trim($data["category"] ?? "");
$amount = (float)($data["amount"] ?? 0);
$description = trim($data["description"] ?? "");
$date = $data["transaction_date"] ?? "";

if ($id <= 0 || $userId <= 0) {
    http_response_code(422);

    echo json_encode([
        "success" => false,
        "message" => "Invalid transaction ID or user ID"
    ]);

    exit;
}

if (!in_array($type, ["income", "expense"], true)) {
    http_response_code(422);

    echo json_encode([
        "success" => false,
        "message" => "Transaction type must be income or expense"
    ]);

    exit;
}

if ($category === "" || $amount <= 0 || $date === "") {
    http_response_code(422);

    echo json_encode([
        "success" => false,
        "message" => "Category, amount and date are required"
    ]);

    exit;
}

$stmt = $pdo->prepare(
    "UPDATE transactions
     SET
        type = ?,
        category = ?,
        amount = ?,
        description = ?,
        transaction_date = ?
     WHERE id = ?
       AND user_id = ?"
);

$stmt->execute([
    $type,
    $category,
    $amount,
    $description,
    $date,
    $id,
    $userId
]);

if ($stmt->rowCount() === 0) {
    http_response_code(404);

    echo json_encode([
        "success" => false,
        "message" => "Transaction not found or nothing changed"
    ]);

    exit;
}

echo json_encode([
    "success" => true,
    "message" => "Transaction updated successfully"
]);