<?php
$host = "localhost";
$db_name = "api_db";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $exception) {
    die(json_encode(["error" => "Ошибка подключения: " . $exception->getMessage()]));
}
?>
