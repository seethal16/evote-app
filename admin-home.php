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
 <div ng-include="'includes/header_admin.html'"></div>

  <hr>

  <div style="width:500px;margin:auto;">
    <h3>Add New Candidate</h3>
    <form action="api/add_candidate.php" method="POST">
      <input type="text" name="name" placeholder="Candidate Name" required><br><br>
      <input type="text" name="party" placeholder="Party Name" required><br><br>
      <button type="submit">Add Candidate</button>
      <br/><br/><br/>
    </form>
  </div>


</body>
</html>