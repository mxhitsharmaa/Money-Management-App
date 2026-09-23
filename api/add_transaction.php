<?php
//  header 
header("Content-Type: application/json");

require_once "../config/database.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);

    echo json_encode([
        "success" => false,
        "message" => "Method not allowed"
    ]);

    exit;
}

$data = json_decode(file_get_contents("php://input"), true);

$userId = (int)($data["user_id"] ?? 0);
$type = $data["type"] ?? "";
$category = trim($data["category"] ?? "");
$amount = (float)($data["amount"] ?? 0);
$description = trim($data["description"] ?? "");
$date = $data["transaction_date"] ?? date("Y-m-d");

if ($userId <= 0 || $category === "" || $amount <= 0) {
    http_response_code(422);

    echo json_encode([
        "success" => false,
        "message" => "Invalid transaction data"
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

$stmt = $pdo->prepare(
    "INSERT INTO transactions
    (user_id, type, category, amount, description, transaction_date)
    VALUES (?, ?, ?, ?, ?, ?)"
);

$stmt->execute([
    $userId,
    $type,
    $category,
    $amount,
    $description,
    $date
]);

echo json_encode([
    "success" => true,
    "message" => "Transaction added successfully",
    "transaction_id" => $pdo->lastInsertId()
]);