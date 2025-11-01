<?php
include("db_connect.php");

// Get all candidates and their votes
$result = mysqli_query($conn, "SELECT * FROM candidates ORDER BY votes DESC");

$candidates = [];
while ($row = mysqli_fetch_assoc($result)) {
  $candidates[] = $row;
}

echo json_encode($candidates);
?>
