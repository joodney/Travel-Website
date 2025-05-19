<?php
header("Content-Type: application/json");

// الاتصال بقاعدة البيانات باستخدام environment variables
$host = getenv("MYSQL_ADDON_HOST");
$db   = getenv("MYSQL_ADDON_DB");
$user = getenv("MYSQL_ADDON_USER");
$pass = getenv("MYSQL_ADDON_PASSWORD");

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(["error" => "Connection failed"]);
    exit();
}

// إذا كان الطلب POST → إضافة feedback
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = json_decode(file_get_contents("php://input"), true);

    $name = $conn->real_escape_string($data["name"]);
    $email = $conn->real_escape_string($data["email"]);
    $rating = $conn->real_escape_string($data["rating"]);
    $services = $conn->real_escape_string(implode(", ", $data["services"]));
    $preference = $conn->real_escape_string($data["preference"]);
    $comments = $conn->real_escape_string($data["message"]);

    // تحقق من تكرار البريد الإلكتروني
    $check = $conn->query("SELECT id FROM feedback WHERE email = '$email'");
    if ($check->num_rows > 0) {
        echo json_encode(["status" => "error", "message" => "Email already exists."]);
        exit();
    }

    $sql = "INSERT INTO feedback (name, email, rating, services, preference, comments)
            VALUES ('$name', '$email', '$rating', '$services', '$preference', '$comments')";

    if ($conn->query($sql)) {
        echo json_encode(["status" => "success", "message" => "Feedback submitted successfully."]);
    } else {
        http_response_code(500);
        echo json_encode(["status" => "error", "message" => "Database error."]);
    }
}

// إذا كان الطلب GET → استرجاع جميع feedbacks
elseif ($_SERVER["REQUEST_METHOD"] === "GET") {
    $result = $conn->query("SELECT * FROM feedback ORDER BY submitted_at DESC");
    $feedbacks = [];
    while ($row = $result->fetch_assoc()) {
        $feedbacks[] = $row;
    }
    echo json_encode($feedbacks);
}

$conn->close();
?>
