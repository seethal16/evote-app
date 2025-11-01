<?php
include("db_connect.php");

$name = $_POST['name'];
$party = $_POST['party'];

if ($name == "" || $party == "") {
    header("Location: ../admin-home.php?msg=error");
    exit();
}

$sql = "INSERT INTO candidates (name, party) VALUES ('$name', '$party')";
if (mysqli_query($conn, $sql)) {
    header("Location: ../admin-home.php?msg=success");
} else {
    header("Location: ../admin-home.php?msg=error");
}
?>
