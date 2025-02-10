<?php
// profile.php

// If this is an AJAX request, process and return JSON data.
if (isset($_GET['ajax']) && $_GET['ajax'] == 1) {
    // Expected parameters: test (Physical, Diagnostic, or Diagnosis) and patient_id
    if (!isset($_GET['test']) || !isset($_GET['patient_id'])) {
        echo json_encode(['error' => 'Missing parameters']);
        exit;
    }
    $test = $_GET['test'];
    $patientId = intval($_GET['patient_id']);

    // Database configuration
    $servername = "localhost";
    $dbname     = "clinic_db";
    $username   = "root";
    $password   = "";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        echo json_encode(['error' => 'DB connection failed: ' . $conn->connect_error]);
        exit;
    }

    // Instead of matching by full name, we can use the unique patient id.
    // However, if your test tables do not have a patient_id column,
    // you can first look up the patient’s full name.
    $stmt = $conn->prepare("SELECT patient_full_name FROM admissions WHERE id = ?");
    $stmt->bind_param("i", $patientId);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $patient_full_name = $row['patient_full_name'];
    } else {
        echo json_encode(['error' => 'Patient not found']);
        exit;
    }
    $stmt->close();

    // Determine which table to query based on test type.
    $table = '';
    if ($test === 'Physical') {
        $table = 'physical_tests';
    } elseif ($test === 'Diagnostic') {
        $table = 'diagnostic_tests';
    } elseif ($test === 'Diagnosis') {
        $table = 'diagnoses';
    } else {
        echo json_encode(['error' => 'Invalid test type']);
        exit;
    }

    // If possible, it’s best to have a patient_id column in the test tables.
    // For this example, we continue matching on the patient’s full name.
    $sql = "SELECT * FROM $table WHERE full_name = ? ORDER BY submitted_at DESC LIMIT 1";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        echo json_encode(['error' => 'Prepare failed: ' . $conn->error]);
        exit;
    }
    $stmt->bind_param("s", $patient_full_name);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        echo json_encode(['data' => $data]);
    } else {
        echo json_encode(['data' => null, 'message' => 'No test data available for this patient.']);
    }

    $stmt->close();
    $conn->close();
    exit;
}

// --- Normal page output starts here ---

// Database configuration
$servername = "localhost";
$dbname     = "clinic_db";
$username   = "root";
$password   = "";

// Create connection for normal page load
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the patient id is provided (from admission)
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $conn->prepare("SELECT * FROM admissions WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $patient = $result->fetch_assoc();
    } else {
        die("Patient not found.");
    }
    $stmt->close();
} else {
    die("No patient ID specified.");
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Patient Profile</title>
  <!-- Google Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!-- Link to our Profile CSS -->
  <link rel="stylesheet" href="profile.css">
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
              <a href="dashboard.php">
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

    <!-- Dashboard Content: Profile -->
    <div class="dashboard-content">
      <div class="profile-box">
        <!-- Test Buttons positioned at the upper right corner -->
        <div class="test-buttons">
          <button class="test-button">Physical Test</button>
          <button class="test-button">Diagnostic Test</button>
          <button class="test-button">Diagnosis Test</button>
        </div>

        <div class="profile-header">
          <div class="profile-image">
            <!-- Profile Icon Placeholder -->
            <img src="profilepic.jpg" alt="Profile Picture">
          </div>
          <div class="profile-info">
            <h1><?php echo htmlspecialchars($patient['patient_full_name']); ?></h1>
            <p><?php echo htmlspecialchars($patient['gender']); ?>, <?php echo htmlspecialchars($patient['age']); ?> years old</p>
            <p>Date of Birth: <?php echo htmlspecialchars($patient['dob']); ?></p>
          </div>
        </div>
        <div class="profile-details">
          <h2>Patient Details</h2>
          <div class="detail-item">
            <strong>Guardian Name:</strong>
            <span><?php echo htmlspecialchars($patient['guardian_full_name']); ?></span>
          </div>
          <div class="detail-item">
            <strong>Relationship:</strong>
            <span><?php echo htmlspecialchars($patient['relationship']); ?></span>
          </div>
          <div class="detail-item">
            <strong>Contact Numbers:</strong>
            <span><?php echo htmlspecialchars($patient['contact_numbers']); ?></span>
          </div>
          <div class="detail-item">
            <strong>Additional Contact:</strong>
            <span><?php echo htmlspecialchars($patient['additional_contact']); ?></span>
          </div>
          <div class="detail-item">
            <strong>Onset & Duration:</strong>
            <span><?php echo htmlspecialchars($patient['onset_duration']); ?></span>
          </div>
          <div class="detail-item">
            <strong>Current Condition:</strong>
            <span><?php echo htmlspecialchars($patient['current_condition']); ?></span>
          </div>
          <div class="detail-item">
            <strong>Past Medical History:</strong>
            <span><?php echo htmlspecialchars($patient['past_medical_history']); ?></span>
          </div>
          <div class="detail-item">
            <strong>Allergies:</strong>
            <span><?php echo htmlspecialchars($patient['allergies']); ?></span>
          </div>
          <div class="detail-item">
            <strong>Current Medications:</strong>
            <span><?php echo htmlspecialchars($patient['current_medications']); ?></span>
          </div>
          <div class="detail-item">
            <strong>Family Medical History:</strong>
            <span><?php echo htmlspecialchars($patient['family_medical_history']); ?></span>
          </div>
          <div class="detail-item">
            <strong>Consent:</strong>
            <span><?php echo $patient['consent'] ? 'Yes' : 'No'; ?></span>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal for Test Options (Fill Up / Display) -->
  <div id="testModal" class="modal">
    <div class="modal-content">
      <span class="close">&times;</span>
      <h2 id="modalTestType"></h2>
      <p>Please choose an option:</p>
      <div class="modal-buttons">
        <button id="fillUpButton" class="modal-button">Fill Up</button>
        <button id="displayButton" class="modal-button">Display</button>
      </div>
    </div>
  </div>

  <!-- Modal for Displaying Test Data -->
  <div id="displayModal" class="modal">
    <div class="modal-content">
      <span class="close" id="closeDisplay">&times;</span>
      <h2 id="displayModalTitle"></h2>
      <div id="displayContent" class="modal-display-content">
        <!-- Test data will be inserted here -->
      </div>
    </div>
  </div>

  <!-- Global JS Variables -->
  <script>
    // This variable is set using PHP and will be available in profile.js
    var patientId = <?php echo json_encode($patient['id']); ?>;
  </script>
  <!-- External JS file -->
  <script src="profile.js"></script>
</body>
</html>
