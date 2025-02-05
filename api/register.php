<?php
require_once "../db.php";

$data = json_decode(file_get_contents("php://input"), true);
$email = $data['email'];
$name = $data['name'];
$password = password_hash($data['password'], PASSWORD_BCRYPT);

$stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
$stmt->execute([$email]);
if ($stmt->fetch()) {
    echo json_encode(["status" => "error", "message" => "Email уже зарегистрирован"]);
    exit;
}

$stmt = $conn->prepare("INSERT INTO users (email, name, password) VALUES (?, ?, ?)");
if ($stmt->execute([$email, $name, $password])) {
    echo json_encode(["status" => "success", "message" => "Регистрация успешна"]);
} else {
    echo json_encode(["status" => "error", "message" => "Ошибка регистрации"]);
}
?>
