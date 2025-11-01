<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin-login.html");
    exit();
}

include("api/db_connect.php");

$result = mysqli_query($conn, "SELECT * FROM candidates ORDER BY votes DESC");
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Election Results - Admin</title>
  <link rel="stylesheet" href="css/style.css">
  <style>
    body {
      font-family: "Segoe UI", Arial, sans-serif;
      background-color: #f9f9f9;
      text-align: center;
    }
    h2 {
      margin-top: 30px;
      color: #333;
    }
    .container {
      max-width: 800px;
      margin: 30px auto;
      padding: 20px;
      background: #fff;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      border-radius: 10px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }
    th, td {
      padding: 12px;
      text-align: center;
      border-bottom: 1px solid #ddd;
    }
    th {
      background-color: #007bff;
      color: white;
    }
    tr:hover {
      background-color: #f1f1f1;
    }
    .top-candidate {
      background-color: #d4edda !important;
      font-weight: bold;
    }
    .btn {
      background-color: #007bff;
      color: white;
      border: none;
      padding: 8px 16px;
      border-radius: 5px;
      cursor: pointer;
      text-decoration: none;
      transition: 0.3s;
      display: inline-block;
      margin-top: 10px;
    }
    .btn:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Election Results</h2>
    <a href="admin-home.php" class="btn">← Back to Home</a>

    <table>
      <tr>
        <th>Rank</th>
        <th>Candidate Name</th>
        <th>Party</th>
        <th>Total Votes</th>
      </tr>

      <?php 
      $rank = 1;
      $topVotes = -1;
      while ($row = mysqli_fetch_assoc($result)) { 
          $highlight = ($rank == 1) ? "top-candidate" : "";
          if ($rank == 1) $topVotes = $row['votes'];
      ?>
        <tr class="<?php echo $highlight; ?>">
          <td><?php echo $rank++; ?></td>
          <td><?php echo htmlspecialchars($row['name']); ?></td>
          <td><?php echo htmlspecialchars($row['party']); ?></td>
          <td><?php echo $row['votes']; ?></td>
        </tr>
      <?php } ?>
    </table>

    <?php if ($topVotes > 0) { ?>
      <p style="margin-top: 15px; font-weight: bold; color: #155724;">
        🏆 The highlighted candidate is currently leading!
      </p>
    <?php } else { ?>
      <p style="margin-top: 15px; color: #555;">No votes have been cast yet.</p>
    <?php } ?>
  </div>
</body>
</html>
