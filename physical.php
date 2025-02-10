<?php
// Process the form if it was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Database connection details
    $servername = "localhost";
    $dbname     = "clinic_db";
    $username   = "root";
    $password   = "";
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 

    // Retrieve and sanitize form data
    $full_name              = $conn->real_escape_string($_POST['full_name']);
    $dob                    = $_POST['dob'];
    $age                    = (int)$_POST['age'];
    $gender                 = $conn->real_escape_string($_POST['gender']);
    $past_medical_history   = $conn->real_escape_string($_POST['past_medical_history']);
    $family_medical_history = $conn->real_escape_string($_POST['family_medical_history']);
    $allergies              = $conn->real_escape_string($_POST['allergies']);
    $current_medications    = $conn->real_escape_string($_POST['current_medications']);
    $height                 = (float)$_POST['height'];
    $weight                 = (float)$_POST['weight'];
    $bmi                    = (float)$_POST['bmi'];
    $blood_pressure         = $conn->real_escape_string($_POST['blood_pressure']);
    $heart_rate             = (int)$_POST['heart_rate'];
    $temperature            = (float)$_POST['temperature'];
    $general_appearance     = $conn->real_escape_string($_POST['general_appearance']);
    $head_and_neck          = $conn->real_escape_string($_POST['head_and_neck']);
    $eyes                   = $conn->real_escape_string($_POST['eyes']);
    $ears                   = $conn->real_escape_string($_POST['ears']);
    $nose_and_throat        = $conn->real_escape_string($_POST['nose_and_throat']);
    $chest_and_lungs        = $conn->real_escape_string($_POST['chest_and_lungs']);
    $heart                  = $conn->real_escape_string($_POST['heart']);
    $abdomen                = $conn->real_escape_string($_POST['abdomen']);

    // Build the SQL query
    $sql = "INSERT INTO physical_tests 
            (full_name, dob, age, gender, past_medical_history, family_medical_history, allergies, current_medications, height, weight, bmi, blood_pressure, heart_rate, temperature, general_appearance, head_and_neck, eyes, ears, nose_and_throat, chest_and_lungs, heart, abdomen)
            VALUES 
            ('$full_name', '$dob', $age, '$gender', '$past_medical_history', '$family_medical_history', '$allergies', '$current_medications', $height, $weight, $bmi, '$blood_pressure', $heart_rate, $temperature, '$general_appearance', '$head_and_neck', '$eyes', '$ears', '$nose_and_throat', '$chest_and_lungs', '$heart', '$abdomen')";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        // Get the last inserted ID
        $last_id = $conn->insert_id;
        
        // Close the connection before redirection
        $conn->close();
        
        // Redirect to profile.php with the new ID
        header("Location: profile.php?id=" . $last_id);
        exit();
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
  <!-- Link to our physical form CSS -->
  <link rel="stylesheet" href="physical.css">
  <title>Physical Test Results Form</title>
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

    <!-- Navbar (same as dashboard) -->
    <nav class="navbar">
      <ul class="navbar-links">
        <li><a href="#">About Us</a></li>
      </ul>
    </nav>

    <!-- Dashboard Content: Expanded Physical Test Results Form -->
    <div class="dashboard-content">
      <div class="form-box">
        <h1>Physical Test Results Form</h1>
        <p>Please fill out the details below.</p>

        <!-- Display success or error message (only visible if not redirected) -->
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

            <!-- Brief Medical History Section -->
            <h2 class="section-title">Brief Medical History</h2>
            <div class="form-group">
              <label for="past_medical_history">Past Medical History</label>
              <textarea id="past_medical_history" name="past_medical_history" placeholder="Previous illnesses, hospitalizations, surgeries"></textarea>
            </div>
            <div class="form-group">
              <label for="family_medical_history">Family Medical History</label>
              <textarea id="family_medical_history" name="family_medical_history" placeholder="Chronic conditions, hereditary diseases"></textarea>
            </div>
            <div class="form-group">
              <label for="allergies">Allergies</label>
              <textarea id="allergies" name="allergies" placeholder="Food, medication, environmental"></textarea>
            </div>
            <div class="form-group">
              <label for="current_medications">Current Medications</label>
              <textarea id="current_medications" name="current_medications" placeholder="Name, dosage, frequency"></textarea>
            </div>

            <!-- Vital Signs Section -->
            <h2 class="section-title">Vital Signs</h2>
            <div class="form-group">
              <label for="height">Height (m)</label>
              <input type="number" step="any" id="height" name="height" placeholder="Enter height in meters" required>
            </div>
            <div class="form-group">
              <label for="weight">Weight (kg)</label>
              <input type="number" step="any" id="weight" name="weight" placeholder="Enter weight in kg" required>
            </div>
            <div class="form-group">
              <label for="bmi">Body Mass Index (BMI)</label>
              <input type="number" step="any" id="bmi" name="bmi" placeholder="Weight/Height²" required>
            </div>
            <div class="form-group">
              <label for="blood_pressure">Blood Pressure</label>
              <input type="text" id="blood_pressure" name="blood_pressure" placeholder="e.g., 120/80" required>
            </div>
            <div class="form-group">
              <label for="heart_rate">Heart Rate (bpm)</label>
              <input type="number" id="heart_rate" name="heart_rate" placeholder="Enter heart rate" required>
            </div>
            <div class="form-group">
              <label for="temperature">Temperature (°C)</label>
              <input type="number" step="any" id="temperature" name="temperature" placeholder="Enter temperature" required>
            </div>

            <!-- Physical Examination Sections -->
            <h2 class="section-title">Physical Examination Sections</h2>
            <div class="form-group">
              <label for="general_appearance">General Appearance</label>
              <textarea id="general_appearance" name="general_appearance" placeholder="Describe general appearance"></textarea>
            </div>
            <div class="form-group">
              <label for="head_and_neck">Head and Neck</label>
              <textarea id="head_and_neck" name="head_and_neck" placeholder="Describe head and neck findings"></textarea>
            </div>
            <div class="form-group">
              <label for="eyes">Eyes</label>
              <textarea id="eyes" name="eyes" placeholder="Describe eye findings"></textarea>
            </div>
            <div class="form-group">
              <label for="ears">Ears</label>
              <textarea id="ears" name="ears" placeholder="Describe ear findings"></textarea>
            </div>
            <div class="form-group">
              <label for="nose_and_throat">Nose and Throat</label>
              <textarea id="nose_and_throat" name="nose_and_throat" placeholder="Describe nose and throat findings"></textarea>
            </div>
            <div class="form-group">
              <label for="chest_and_lungs">Chest and Lungs</label>
              <textarea id="chest_and_lungs" name="chest_and_lungs" placeholder="Describe chest and lung findings"></textarea>
            </div>
            <div class="form-group">
              <label for="heart">Heart</label>
              <textarea id="heart" name="heart" placeholder="Describe heart findings"></textarea>
            </div>
            <div class="form-group">
              <label for="abdomen">Abdomen</label>
              <textarea id="abdomen" name="abdomen" placeholder="Describe abdominal findings"></textarea>
            </div>

            <!-- Submit Button -->
            <div class="form-group full-width">
              <button type="submit">Submit Exam</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
