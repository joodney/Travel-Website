<?php

$host = getenv("MYSQL_ADDON_HOST");
$db   = getenv("MYSQL_ADDON_DB");
$user = getenv("MYSQL_ADDON_USER");
$pass = getenv("MYSQL_ADDON_PASSWORD");


$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    echo "❌ Failed to connect: " . $conn->connect_error;
} else {
    echo "✅ Successfully connected to database: $db on host $host";
}

$conn->close();
?>
