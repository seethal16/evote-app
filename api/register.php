<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

$data = json_decode(file_get_contents("php://input"), true);

if (!$data) {
  echo json_encode(["success" => false, "message" => "Invalid input"]);
  exit;
}

include "db_connect.php"; // create separate db_connect.php file

$name = trim($data["name"]);
$email = trim($data["email"]);
$username = trim($data["username"]);
$password = trim($data["password"]);
$phone = trim($data["phone"]);

if (empty($name) || empty($email) || empty($username) || empty($password)) {
  echo json_encode(["success" => false, "message" => "All fields are required!"]);
  exit;
}

$check = $conn->prepare("SELECT * FROM voters WHERE email=? OR username=?");
$check->bind_param("ss", $email, $username);
$check->execute();
$result = $check->get_result();

if ($result->num_rows > 0) {
  echo json_encode(["success" => false, "message" => "Email or Username already exists!"]);
  exit;
}

$hashed = password_hash($password, PASSWORD_DEFAULT);
$stmt = $conn->prepare("INSERT INTO voters (name, email, username, password, phone) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $name, $email, $username, $hashed, $phone);

if ($stmt->execute()) {
  echo json_encode(["success" => true, "message" => "Registration successful!"]);
} else {
  echo json_encode(["success" => false, "message" => "Error registering user."]);
}
?>
