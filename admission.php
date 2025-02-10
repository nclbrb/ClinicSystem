<?php
// admission.php

// Database configuration (only servername and dbname need to be set)
$servername = "localhost";
$dbname     = "clinic_db";

// Default credentials for a local development environment (update if needed)
$username   = "root";
$password   = "";

// Create a new MySQLi connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check for a connection error and exit if any occur
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize a message variable (if needed for error feedback)
$message = "";

// Process the form if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form inputs
    $patient_full_name      = $conn->real_escape_string(trim($_POST['patient_full_name']));
    $dob                    = $_POST['dob'];  // Expected in YYYY-MM-DD format
    $age                    = intval($_POST['age']);
    $gender                 = $conn->real_escape_string(trim($_POST['gender']));
    $guardian_full_name     = $conn->real_escape_string(trim($_POST['guardian_full_name']));
    $relationship           = $conn->real_escape_string(trim($_POST['relationship']));
    $contact_numbers        = $conn->real_escape_string(trim($_POST['contact_numbers']));
    $additional_contact     = $conn->real_escape_string(trim($_POST['additional_contact']));
    $onset_duration         = $conn->real_escape_string(trim($_POST['onset_duration']));
    $current_condition      = $conn->real_escape_string(trim($_POST['current_condition']));
    $past_medical_history   = $conn->real_escape_string(trim($_POST['past_medical_history']));
    $allergies              = $conn->real_escape_string(trim($_POST['allergies']));
    $current_medications    = $conn->real_escape_string(trim($_POST['current_medications']));
    $family_medical_history = $conn->real_escape_string(trim($_POST['family_medical_history']));
    // Checkbox: set to 1 if checked, otherwise 0
    $consent                = isset($_POST['consent']) ? 1 : 0;

    // Prepare an SQL statement using placeholders for security
    $stmt = $conn->prepare("INSERT INTO admissions 
        (patient_full_name, dob, age, gender, guardian_full_name, relationship, contact_numbers, additional_contact, onset_duration, current_condition, past_medical_history, allergies, current_medications, family_medical_history, consent) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    if (!$stmt) {
        die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
    }

    // Bind the parameters. The string "ssisssssssssssi" indicates the types (s = string, i = integer).
    $stmt->bind_param(
        "ssisssssssssssi",
        $patient_full_name,
        $dob,
        $age,
        $gender,
        $guardian_full_name,
        $relationship,
        $contact_numbers,
        $additional_contact,
        $onset_duration,
        $current_condition,
        $past_medical_history,
        $allergies,
        $current_medications,
        $family_medical_history,
        $consent
    );

    // Execute the statement
    if ($stmt->execute()) {
        // After a successful insert, redirect to patient_list.php
        header("Location: patient_list.php");
        exit();
    } else {
        $message = "Error: " . $stmt->error;
    }
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Google Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!-- Link to our Admission Form CSS -->
  <link rel="stylesheet" href="admission.css">
  <title>Admission Form</title>
</head>
<body>
  <div class="container">
    <!-- Sidebar -->
    <nav class="sidebar">
      <header>
        <div class="image-text">
          <span class="image">
            <!-- Place Our Logo Here -->
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

    <!-- Dashboard Content: Admission Form -->
    <div class="dashboard-content">
      <div class="form-box">
        <h1>Admission Form</h1>
        <!-- Display message if any errors occur -->
        <?php if (!empty($message)) { echo "<p>" . $message . "</p>"; } ?>
        <p>Please fill out the form below.</p>
        <!-- The form posts to the same file -->
        <form action="admission.php" method="post">
          <div class="form-grid">
            <!-- Section 1: Patient Information -->
            <h2 class="section-title">Patient Information</h2>
            <div class="form-group">
              <label for="patient_full_name">Full Name</label>
              <input type="text" id="patient_full_name" name="patient_full_name" placeholder="Enter full name" required>
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

            <!-- Section 2: Parent/Guardian Information -->
            <h2 class="section-title">Parent/Guardian Information</h2>
            <div class="form-group">
              <label for="guardian_full_name">Full Name(s) of Parent/Guardian</label>
              <input type="text" id="guardian_full_name" name="guardian_full_name" placeholder="Enter parent/guardian full name" required>
            </div>
            <div class="form-group">
              <label for="relationship">Relationship to the Patient</label>
              <input type="text" id="relationship" name="relationship" placeholder="Enter relationship" required>
            </div>
            <div class="form-group">
              <label for="contact_numbers">Contact Numbers</label>
              <input type="text" id="contact_numbers" name="contact_numbers" placeholder="Enter contact numbers" required>
            </div>
            <div class="form-group">
              <label for="additional_contact">Additional Contact</label>
              <input type="text" id="additional_contact" name="additional_contact" placeholder="Enter additional contact (if any)">
            </div>

            <!-- Section 3: Reason for Admission -->
            <h2 class="section-title">Reason for Admission</h2>
            <div class="form-group">
              <label for="onset_duration">Onset and Duration of Symptoms</label>
              <textarea id="onset_duration" name="onset_duration" placeholder="Enter onset and duration of symptoms" required></textarea>
            </div>
            <div class="form-group">
              <label for="current_condition">Brief Description of the Current Condition</label>
              <textarea id="current_condition" name="current_condition" placeholder="Enter a brief description of the current condition" required></textarea>
            </div>

            <!-- Section 4: Medical History -->
            <h2 class="section-title">Medical History</h2>
            <div class="form-group">
              <label for="past_medical_history">Past Medical History</label>
              <textarea id="past_medical_history" name="past_medical_history" placeholder="Previous illnesses, hospitalizations, surgeries" required></textarea>
            </div>
            <div class="form-group">
              <label for="allergies">Allergies</label>
              <textarea id="allergies" name="allergies" placeholder="Food, medication, environmental" required></textarea>
            </div>
            <div class="form-group">
              <label for="current_medications">Current Medications</label>
              <textarea id="current_medications" name="current_medications" placeholder="Name, dosage, frequency" required></textarea>
            </div>
            <div class="form-group">
              <label for="family_medical_history">Family Medical History</label>
              <textarea id="family_medical_history" name="family_medical_history" placeholder="Chronic conditions, hereditary diseases" required></textarea>
            </div>

            <!-- Section 5: Consent Form -->
            <h2 class="section-title">Consent Form</h2>
            <div class="form-group full-width consent-group">
              <input type="checkbox" id="consent" name="consent" required>
              <label for="consent">
                The patient consents to the procedures and tests described below. He/she understands the purpose of these tests and agreed to proceed with the admission process.
              </label>
            </div>
            <div class="form-group full-width">
              <ul class="consent-list">
                <li><strong>Physical Test:</strong>
                  <ul>
                    <li>Urinalysis</li>
                    <li>Fecalysis</li>
                    <li>X-ray</li>
                    <li>Blood Analysis</li>
                  </ul>
                </li>
                <br>
                <li><strong>Diagnostic Test:</strong>
                  <ul>
                    <li>Diagnostic Imaging</li>
                    <li>Laboratory Analysis</li>
                  </ul>
                </li>
                <br>
                <li><strong>Diagnosis Test:</strong>
                  <ul>
                    <li>S.O.A.P. Assessment</li>
                    <li>Clinical Evaluation</li>
                  </ul>
                </li>
              </ul>
            </div>

            <!-- Submit Button -->
            <div class="form-group full-width">
              <button type="submit">Submit Admission Form</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
