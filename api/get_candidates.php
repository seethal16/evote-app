<?php
// header("Access-Control-Allow-Origin: *");
// header("Content-Type: application/json");
include("db_connect.php");

$result = mysqli_query($conn, "SELECT * FROM candidates");
$candidates = [];

while ($row = mysqli_fetch_assoc($result)) {
  $candidates[] = $row;
}

echo json_encode($candidates);
?>
