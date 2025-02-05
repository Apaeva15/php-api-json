<?php
require_once "../db.php";

$headers = getallheaders();
$token = $headers['Authorization'] ?? '';

$stmt = $conn->prepare("SELECT email, name FROM users WHERE token = ?");
$stmt->execute([$token]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user) {
    echo json_encode(["status" => "success", "user" => $user]);
} else {
    echo json_encode(["status" => "error", "message" => "Неверный токен"]);
}
?>
