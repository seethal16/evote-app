<?php
include("db_connect.php");

// Get the data from Angular
$data = json_decode(file_get_contents("php://input"));
$voter_username = $data->voter_username;
$candidate_id = $data->candidate_id;

// Check if voter already voted
$check = mysqli_query($conn, "SELECT * FROM votes WHERE voter_username='$voter_username'");
if (mysqli_num_rows($check) > 0) {
    echo json_encode(["success" => false, "message" => "You already voted!"]);
    exit;
}

// Save the vote
$insert = mysqli_query($conn, "INSERT INTO votes (voter_username, candidate_id) VALUES ('$voter_username', '$candidate_id')");

// Increase candidate vote count
if ($insert) {
    mysqli_query($conn, "UPDATE candidates SET votes = votes + 1 WHERE id='$candidate_id'");
    echo json_encode(["success" => true, "message" => "Vote submitted successfully!"]);
} else {
    echo json_encode(["success" => false, "message" => "Failed to submit vote!"]);
}
?>
