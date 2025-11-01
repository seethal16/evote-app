<?php
include("db_connect.php");
session_start();

$username = $_POST['username'];
$password = $_POST['password'];

if ($username == "" || $password == "") {
    echo "<script>alert('Please fill all fields!'); window.history.back();</script>";
    exit;
}

$sql = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $_SESSION['admin'] = $username;
    header("Location: ../admin-home.php");
} else {
    echo "<script>alert('Invalid username or password!'); window.history.back();</script>";
}
?>
