<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header("Content-Type: application/json");

// الاتصال
$host = getenv("MYSQL_ADDON_HOST");
$db   = getenv("MYSQL_ADDON_DB");
$user = getenv("MYSQL_ADDON_USER");
$pass = getenv("MYSQL_ADDON_PASSWORD");

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(["error" => "Connection failed", "details" => $conn->connect_error]);
    exit();
}

echo json_encode(["status" => "success", "message" => "Connected to database ✅"]);
$conn->close();
?>
