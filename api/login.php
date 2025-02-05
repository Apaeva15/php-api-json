<?php
require_once "../db.php";

$data = json_decode(file_get_contents("php://input"), true);
$email = $data['email'];
$password = $data['password'];

$stmt = $conn->prepare("SELECT id, name, password FROM users WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($password, $user['password'])) {
    $token = bin2hex(random_bytes(32));
    $conn->prepare("UPDATE users SET token = ? WHERE id = ?")->execute([$token, $user['id']]);
    echo json_encode(["status" => "success", "token" => $token]);
} else {
    echo json_encode(["status" => "error", "message" => "Неверный email или пароль"]);
}
?>
