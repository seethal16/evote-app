<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin-login.html");
    exit;
}
include("api/db_connect.php");
?>
<!DOCTYPE html>
<html>
<head>
  <title>Admin Home | E-Voting</title>
  <link rel="stylesheet" href="css/style.css">
  <style>
       .admin-menu {
      background: #ffffff;
      padding: 15px 0;
      display: flex;
      justify-content: center;
      gap: 40px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }
  </style>
</head>
<body>
  <h2 style="text-align:center;">Welcome, <?php echo $_SESSION['admin']; ?> 👋</h2>
  <p style="text-align:center;"><a href="logout.php">Logout</a></p>

 <div class="admin-menu">
    <a href="admin-home.php">🏠 Add Candidate</a>
    <a href="admin_results.html">📊 Results</a>
    <a href="view_candidates.php">👥 View All Candidates</a>
  </div>
  <a href="admin-home.php">← Back to Home</a>
  <hr>
  <h3 style="text-align:center;">All Candidates</h3>
  <div style="width:600px;margin:auto;text-align:center;">
    <?php
    $sql = "SELECT * FROM candidates ORDER BY id DESC";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        echo "<table border='0' width='100%' cellpadding='10'>
                <tr><th>Name</th><th>Party</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>{$row['name']}</td>
                    <td>{$row['party']}</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No candidates found.</p>";
    }
    ?>
  </div>
</body>
</html>