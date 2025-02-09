<?php
$host = "localhost"; 
$username = "root";  
$password = "";      
$database = "clinic_db"; 


$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fullName = $conn->real_escape_string($_POST['fullName']);
    $dob = $_POST['dob'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $address = $conn->real_escape_string($_POST['address']);
    $contact = $_POST['contact'];
    $emergencyContactName = $conn->real_escape_string($_POST['emergencyContactName']);
    $emergencyContactRelationship = $conn->real_escape_string($_POST['emergencyContactRelationship']);
    $emergencyContactPhone = $_POST['emergencyContactPhone'];
    $guardianName = $conn->real_escape_string($_POST['guardianName']);
    $guardianRelationship = $conn->real_escape_string($_POST['guardianRelationship']);
    $guardianContact = $_POST['guardianContact'];
    $onsetDuration = $conn->real_escape_string($_POST['onsetDuration']);
    $currentCondition = $conn->real_escape_string($_POST['currentCondition']);
    $pastMedicalHistory = $conn->real_escape_string($_POST['pastMedicalHistory']);
    $immunizationHistory = $conn->real_escape_string($_POST['immunizationHistory']);
    $allergies = $conn->real_escape_string($_POST['allergies']);
    $currentMedications = $conn->real_escape_string($_POST['currentMedications']);
    $familyMedicalHistory = $conn->real_escape_string($_POST['familyMedicalHistory']);
    $parentalConsent = isset($_POST['parentalConsent']) ? 1 : 0; 
   
    $sql = "INSERT INTO admissions (fullName, dob, age, gender, address, contact, emergencyContactName, emergencyContactRelationship, emergencyContactPhone, guardianName, guardianRelationship, guardianContact, onsetDuration, currentCondition, pastMedicalHistory, immunizationHistory, allergies, currentMedications, familyMedicalHistory, parentalConsent)
            VALUES ('$fullName', '$dob', '$age', '$gender', '$address', '$contact', '$emergencyContactName', '$emergencyContactRelationship', '$emergencyContactPhone', '$guardianName', '$guardianRelationship', '$guardianContact', '$onsetDuration', '$currentCondition', '$pastMedicalHistory', '$immunizationHistory', '$allergies', '$currentMedications', '$familyMedicalHistory', '$parentalConsent')";

    if ($conn->query($sql) === TRUE) {
        $message = "<div class='alert alert-success'>New record created successfully!</div>";
    } else {
        $message = "<div class='alert alert-danger'>Error: " . $sql . "<br>" . $conn->error . "</div>";
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="patient_form.css">
    <title>Document</title>
    <script>
        function validateForm(event) {
            var fullName = document.getElementById('fullName').value;
            var dob = document.getElementById('dob').value;
            var age = document.getElementById('age').value;
            var gender = document.getElementById('gender').value;
            var address = document.getElementById('address').value;
            var contact = document.getElementById('contact').value;
            var emergencyContactName = document.getElementById('emergencyContactName').value;
            var emergencyContactPhone = document.getElementById('emergencyContactPhone').value;
            var guardianName = document.getElementById('guardianName').value;
            var guardianContact = document.getElementById('guardianContact').value;
            var onsetDuration = document.getElementById('onsetDuration').value;
            var currentCondition = document.getElementById('currentCondition').value;
            var pastMedicalHistory = document.getElementById('pastMedicalHistory').value;
            var immunizationHistory = document.getElementById('immunizationHistory').value;
            var allergies = document.getElementById('allergies').value;
            var currentMedications = document.getElementById('currentMedications').value;
            var familyMedicalHistory = document.getElementById('familyMedicalHistory').value;

            if (!fullName || !dob || !age || !gender || !address || !contact || !emergencyContactName || !emergencyContactPhone || !guardianName || !guardianContact || !onsetDuration || !currentCondition || !pastMedicalHistory || !immunizationHistory || !allergies || !currentMedications || !familyMedicalHistory) {
                alert("Please fill out all fields before submitting.");
                event.preventDefault();  
                return false;
            }
            return true;
        }
    </script>
</head>
<body class="bg-light">

<nav class="navbar">
    <ul class="navbar-links">
        <li><a href="#">About Us</a></li>
    </ul>
</nav>

<div class="container-fluid d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="row w-100">
        <div class="col-3">
            <nav class="sidebar">
                <header>
                    <div class="image-text">
                        <span class="image">
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
                                <a href="patient_form.php">
                                    <i class="material-icons icon">local_hospital</i>
                                    <span class="text nav-text">Admit a Patient</span>
                                </a>
                            </li>
                            <li class="nav-link">
                                <a href="list_patient.php">
                                    <i class="material-icons icon">people</i>
                                    <span class="text nav-text">Patient List</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="bottom-content">
                        <li class="">
                            <a href="login.php">
                                <i class="material-icons icon">logout</i>
                                <span class="text nav-text">Logout</span>
                            </a>
                        </li>
                    </div>
                </div>
            </nav>
        </div>

        <!-- Main Form Content -->
        <div class="col-9">
            <div class="card shadow-lg" style="width: 100%; max-width: 700px; padding: 20px;">
                <h1 class="text-center text-primary mb-4">Patient Admission Form</h1>

                <!-- Displaying Success or Error Message -->
                <?php if (isset($message)) { echo $message; } ?>
                <form action="" method="POST" onsubmit="return validateForm(event)">
                    <div class="section-container mb-4">
                        <fieldset class="border p-4 rounded">
                            <legend class="w-auto font-weight-bold text-primary">Patient Information</legend>
                            <div class="form-group">
                                <label for="fullName">Full Name:</label>
                                <input type="text" class="form-control" id="fullName" name="fullName">
                            </div>
                            <div class="form-group">
                                <label for="dob">Date of Birth:</label>
                                <input type="date" class="form-control" id="dob" name="dob">
                            </div>
                            <div class="form-group">
                                <label for="age">Age:</label>
                                <input type="number" class="form-control" id="age" name="age">
                            </div>
                            <div class="form-group">
                                <label for="gender">Gender:</label>
                                <select class="form-control" id="gender" name="gender">
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="address">Address:</label>
                                <textarea class="form-control" id="address" name="address" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="contact">Contact Information:</label>
                                <input type="tel" class="form-control" id="contact" name="contact">
                            </div>
                            <div class="form-group">
                                <label for="emergencyContact">Emergency Contact Details:</label>
                                <input type="text" class="form-control" id="emergencyContactName" name="emergencyContactName" placeholder="Name">
                                <input type="text" class="form-control mt-2" id="emergencyContactRelationship" name="emergencyContactRelationship" placeholder="Relationship">
                                <input type="tel" class="form-control mt-2" id="emergencyContactPhone" name="emergencyContactPhone" placeholder="Phone Number">
                            </div>
                        </fieldset>
                    </div>
                    <div class="section-container mb-4">
                        <fieldset class="border p-4 rounded">
                            <legend class="w-auto font-weight-bold text-primary">Parent/Guardian Information</legend>
                            <div class="form-group">
                                <label for="guardianName">Full Name(s) of Parent/Guardian:</label>
                                <input type="text" class="form-control" id="guardianName" name="guardianName">
                            </div>
                            <div class="form-group">
                                <label for="guardianRelationship">Relationship to the Patient:</label>
                                <input type="text" class="form-control" id="guardianRelationship" name="guardianRelationship">
                            </div>
                            <div class="form-group">
                                <label for="guardianContact">Contact Numbers:</label>
                                <input type="tel" class="form-control" id="guardianContact" name="guardianContact">
                            </div>
                        </fieldset>
                    </div>

                    <!-- Reason for Admission Section -->
                    <div class="section-container mb-4">
                        <fieldset class="border p-4 rounded">
                            <legend class="w-auto font-weight-bold text-primary">Reason for Admission</legend>
                            <div class="form-group">
                                <label for="onsetDuration">Onset and Duration of Symptoms:</label>
                                <textarea class="form-control" id="onsetDuration" name="onsetDuration" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="currentCondition">Brief Description of the Current Condition:</label>
                                <textarea class="form-control" id="currentCondition" name="currentCondition" rows="3"></textarea>
                            </fieldset>
                    </div>

                    <!-- Medical History Section -->
                    <div class="section-container mb-4">
                        <fieldset class="border p-4 rounded">
                            <legend class="w-auto font-weight-bold text-primary">Medical History</legend>
                            <div class="form-group">
                                <label for="pastMedicalHistory">Past Medical History:</label>
                                <textarea class="form-control" id="pastMedicalHistory" name="pastMedicalHistory" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="immunizationHistory">Immunization History:</label>
                                <textarea class="form-control" id="immunizationHistory" name="immunizationHistory" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="allergies">Allergies:</label>
                                <textarea class="form-control" id="allergies" name="allergies" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="currentMedications">Current Medications:</label>
                                <textarea class="form-control" id="currentMedications" name="currentMedications" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="familyMedicalHistory">Family Medical History:</label>
                                <textarea class="form-control" id="familyMedicalHistory" name="familyMedicalHistory" rows="3"></textarea>
                            </div>
                        </fieldset>
                    </div>

                    <!-- Parental Consent Section -->
                    <div class="form-group">
                        <label for="parentalConsent">
                            <input type="checkbox" id="parentalConsent" name="parentalConsent">I give my full consent for following medical treatment, procedures, and interventions as recommended by the healthcare professionals involved in my child's care. I understand that this consent may be required for routine medical treatment and any emergency medical procedures that may become necessary.
                        </label>
                        <ul>
                                    <li>Physical Test</li>
                                    <li>Vital Signs Tests</li>
                                    <li>Body Composition Tests</li>
                                    <li>Pulmonary Function Tests</li>
                                </ul>
                                <ul>
                                    <li>Diagnostic Test</li>
                                    <li>Allergy Tests</li>
                                    <li>Vision and Hearing Tests</li>
                                    <li>Laboratory Tests</li>
                                </ul>
                    </div>

                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
