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

$data = json_decode(
    file_get_contents("php://input"),
    true
);

$userId = (int)($data["user_id"] ?? 0);
$currentPassword = $data["current_password"] ?? "";
$newPassword = $data["new_password"] ?? "";

if ($userId <= 0 || $currentPassword === "" || $newPassword === "") {
    http_response_code(422);

    echo json_encode([
        "success" => false,
        "message" => "All fields are required"
    ]);

    exit;
}

if (strlen($newPassword) < 8) {
    http_response_code(422);

    echo json_encode([
        "success" => false,
        "message" => "New password must be at least 8 characters"
    ]);

    exit;
}

$stmt = $pdo->prepare(
    "SELECT password
     FROM users
     WHERE id = ?
     LIMIT 1"
);

$stmt->execute([$userId]);

$user = $stmt->fetch();

if (!$user) {
    http_response_code(404);

    echo json_encode([
        "success" => false,
        "message" => "User not found"
    ]);

    exit;
}

if (!password_verify($currentPassword, $user["password"])) {
    http_response_code(401);

    echo json_encode([
        "success" => false,
        "message" => "Current password is incorrect"
    ]);

    exit;
}

$hashedPassword = password_hash(
    $newPassword,
    PASSWORD_DEFAULT
);

$stmt = $pdo->prepare(
    "UPDATE users
     SET password = ?
     WHERE id = ?"
);

$stmt->execute([
    $hashedPassword,
    $userId
]);

echo json_encode([
    "success" => true,
    "message" => "Password changed successfully"
]);