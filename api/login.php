<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

include "db_connect.php";

$data = json_decode(file_get_contents("php://input"), true);

if (!$data) {
  echo json_encode(["success" => false, "message" => "Invalid request"]);
  exit;
}

$username = trim($data["username"]);
$password = trim($data["password"]);

if (empty($username) || empty($password)) {
  echo json_encode(["success" => false, "message" => "Username and password required"]);
  exit;
}

$stmt = $conn->prepare("SELECT * FROM voters WHERE username=?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
  echo json_encode(["success" => false, "message" => "Invalid username or password"]);
  exit;
}

$user = $result->fetch_assoc();

if (password_verify($password, $user["password"])) {
  echo json_encode([
    "success" => true,
    "message" => "Login successful",
    "username" => $user["username"],
    "name" => $user["name"]
  ]);
} else {
  echo json_encode(["success" => false, "message" => "Invalid username or password"]);
}
?>
