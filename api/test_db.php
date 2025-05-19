<?php

$host = getenv("DB_HOST");
$db   = getenv("DB_NAME");
$user = getenv("DB_USER");
$pass = getenv("DB_PASSWORD");

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    echo "❌ Failed to connect: " . $conn->connect_error;
} else {
    echo "✅ Successfully connected to database: $db on host $host";
}

$conn->close();
?>
