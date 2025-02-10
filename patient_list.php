<?php
// patient_list.php

// Database configuration
$servername = "localhost";
$dbname     = "clinic_db";
$username   = "root";
$password   = "";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query the admissions table for patient list
$sql = "SELECT id, patient_full_name FROM admissions ORDER BY id DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Patient List</title>
  <!-- Google Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!-- Link to our Patient List CSS -->
  <link rel="stylesheet" href="patient_list.css">
</head>
<body>
  <div class="container">
    <!-- Sidebar -->
    <nav class="sidebar">
      <header>
        <div class="image-text">
          <span class="image">
            <!-- Place Your Logo Here -->
          </span>
          <div class="text logo-text">
            <span class="name">Clinic System</span>
          </div>
        </div>
      </header>
      <div class="menu-bar">
        <div class="menu">
          <li class="search-box">
            <i class="material-icons icon">search</i>
            <input type="text" placeholder="Search...">
          </li>
          <ul class="menu-links">
            <li class="nav-link">
              <a href="#">
                <i class="material-icons icon">home</i>
                <span class="text nav-text">Homepage</span>
              </a>
            </li>
            <li class="nav-link">
              <a href="admission.php">
                <i class="material-icons icon">local_hospital</i>
                <span class="text nav-text">Admit a Patient</span>
              </a>
            </li>
            <li class="nav-link">
              <a href="patient_list.php">
                <i class="material-icons icon">people</i>
                <span class="text nav-text">Patient List</span>
              </a>
            </li>
          </ul>
        </div>
        <div class="bottom-content">
          <li>
            <a href="login.php">
              <i class="material-icons icon">logout</i>
              <span class="text nav-text">Logout</span>
            </a>
          </li>
        </div>
      </div>
    </nav>

    <!-- Navbar -->
    <nav class="navbar">
      <ul class="navbar-links">
        <li><a href="#">About Us</a></li>
      </ul>
    </nav>

    <!-- Dashboard Content: Patient List -->
    <div class="dashboard-content">
      <div class="list-box">
        <h1>Patient List</h1>
        <div class="patient-list">
          <?php
          if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
                  echo '<div class="patient-item">';
                  echo '  <span class="patient-name">' . htmlspecialchars($row['patient_full_name']) . '</span>';
                  echo '  <a class="view-button" href="profile.php?id=' . $row['id'] . '">View</a>';
                  echo '</div>';
              }
          } else {
              echo '<p>No patients found.</p>';
          }
          ?>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
<?php $conn->close(); ?>
