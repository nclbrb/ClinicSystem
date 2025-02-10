<?php
// diagnosis.php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $servername = "localhost";
    $dbname     = "clinic_db";
    $username   = "root";
    $password   = "";
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // Patient Information
    $full_name = $conn->real_escape_string($_POST['full_name']);
    $dob       = $_POST['dob'];
    $age       = (int)$_POST['age'];
    $gender    = $conn->real_escape_string($_POST['gender']);
    
    // S.O.A.P. fields
    $subjective_symptoms = $conn->real_escape_string($_POST['subjective_symptoms']);
    $objective_findings  = $conn->real_escape_string($_POST['objective_findings']);
    $assessment_goals    = $conn->real_escape_string($_POST['assessment_goals']);
    $diagnosis           = $conn->real_escape_string($_POST['diagnosis']);
    $treatment_plans     = $conn->real_escape_string($_POST['treatment_plans']);
    $medications         = $conn->real_escape_string($_POST['medications']);
    $therapies           = $conn->real_escape_string($_POST['therapies']);
    $follow_up           = $conn->real_escape_string($_POST['follow_up']);
    
    $sql = "INSERT INTO diagnoses 
            (full_name, dob, age, gender, subjective_symptoms, objective_findings, assessment_goals, diagnosis, treatment_plans, medications, therapies, follow_up)
            VALUES 
            ('$full_name', '$dob', $age, '$gender', '$subjective_symptoms', '$objective_findings', '$assessment_goals', '$diagnosis', '$treatment_plans', '$medications', '$therapies', '$follow_up')";

    if ($conn->query($sql) === TRUE) {
        $message = "Diagnosis submitted successfully.";
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Google Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!-- Link to our diagnosis form CSS -->
  <link rel="stylesheet" href="diagnosis.css">
  <title>Diagnosis Form</title>
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

    <!-- Dashboard Content: Diagnosis Form -->
    <div class="dashboard-content">
      <div class="form-box">
        <h1>Diagnosis Form</h1>
        <p>Please fill out the details below using the S.O.A.P. method.</p>
        
        <!-- Display message -->
        <?php if (isset($message)) { echo "<p>$message</p>"; } ?>

        <form action="" method="post">
          <div class="form-grid">
            <!-- Patient Information Section -->
            <h2 class="section-title">Patient Information</h2>
            <div class="form-group">
              <label for="full_name">Full Name</label>
              <input type="text" id="full_name" name="full_name" placeholder="Enter full name" required>
            </div>
            <div class="form-group">
              <label for="dob">Date of Birth</label>
              <input type="date" id="dob" name="dob" required>
            </div>
            <div class="form-group">
              <label for="age">Age</label>
              <input type="number" id="age" name="age" placeholder="Enter age" required>
            </div>
            <div class="form-group">
              <label for="gender">Gender</label>
              <select id="gender" name="gender" required>
                <option value="">Select gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
              </select>
            </div>
            <!-- Subjective Symptoms Section -->
            <h2 class="section-title">Subjective Symptoms</h2>
            <div class="form-group full-width">
              <label for="subjective_symptoms">Subjective Symptoms</label>
              <textarea id="subjective_symptoms" name="subjective_symptoms" placeholder="Enter patient's subjective symptoms" required></textarea>
            </div>
            <!-- Objective Findings Section -->
            <h2 class="section-title">Objective Findings</h2>
            <div class="form-group full-width">
              <label for="objective_findings">Objective Findings</label>
              <textarea id="objective_findings" name="objective_findings" placeholder="Enter objective findings" required></textarea>
            </div>
            <!-- Assessment Goals Section -->
            <h2 class="section-title">Assessment Goals</h2>
            <div class="form-group full-width">
              <label for="assessment_goals">Assessment Goals</label>
              <textarea id="assessment_goals" name="assessment_goals" placeholder="Enter assessment goals" required></textarea>
            </div>
            <!-- Plan Of Treatment Section -->
            <h2 class="section-title">Plan Of Treatment</h2>
            <div class="form-group full-width">
              <label for="diagnosis">Diagnosis for All Assessment Tests</label>
              <textarea id="diagnosis" name="diagnosis" placeholder="Enter diagnosis details" required></textarea>
            </div>
            <div class="form-group full-width">
              <label for="treatment_plans">Treatment Plans</label>
              <textarea id="treatment_plans" name="treatment_plans" placeholder="Enter treatment plans" required></textarea>
            </div>
            <div class="form-group full-width">
              <label for="medications">Medications Prescribed</label>
              <textarea id="medications" name="medications" placeholder="Enter medications prescribed" required></textarea>
            </div>
            <div class="form-group full-width">
              <label for="therapies">Therapies Recommended</label>
              <textarea id="therapies" name="therapies" placeholder="Enter therapies recommended" required></textarea>
            </div>
            <div class="form-group full-width">
              <label for="follow_up">Follow-up Appointments Scheduled</label>
              <textarea id="follow_up" name="follow_up" placeholder="Enter follow-up appointments scheduled" required></textarea>
            </div>
            <!-- Submit Button -->
            <div class="form-group full-width">
              <button type="submit">Submit Diagnosis</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
