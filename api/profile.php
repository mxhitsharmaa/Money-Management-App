<?php

header("Content-Type: application/json");

require_once "../config/database.php";

if ($_SERVER["REQUEST_METHOD"] === "GET") {

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
        "SELECT id, name, email, created_at
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

    echo json_encode([
        "success" => true,
        "user" => $user
    ]);

    exit;
}


if ($_SERVER["REQUEST_METHOD"] === "PUT") {

    $data = json_decode(
        file_get_contents("php://input"),
        true
    );

    $userId = (int)($data["user_id"] ?? 0);
    $name = trim($data["name"] ?? "");
    $email = trim($data["email"] ?? "");

    if ($userId <= 0 || $name === "" || $email === "") {
        http_response_code(422);

        echo json_encode([
            "success" => false,
            "message" => "User ID, name and email are required"
        ]);

        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(422);

        echo json_encode([
            "success" => false,
            "message" => "Invalid email address"
        ]);

        exit;
    }

    $stmt = $pdo->prepare(
        "SELECT id
         FROM users
         WHERE email = ?
         AND id != ?
         LIMIT 1"
    );

    $stmt->execute([$email, $userId]);

    if ($stmt->fetch()) {
        http_response_code(409);

        echo json_encode([
            "success" => false,
            "message" => "Email already in use"
        ]);

        exit;
    }

    $stmt = $pdo->prepare(
        "UPDATE users
         SET name = ?, email = ?
         WHERE id = ?"
    );

    $stmt->execute([
        $name,
        $email,
        $userId
    ]);

    echo json_encode([
        "success" => true,
        "message" => "Profile updated successfully"
    ]);

    exit;
}


http_response_code(405);

echo json_encode([
    "success" => false,
    "message" => "Method not allowed"
]);
