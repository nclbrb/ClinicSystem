<?php

$host = "localhost";
$username = "root";  
$password = "";      
$database = "clinic_db"; 


$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "<h2 class='text-center'>Patient Details</h2>";
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM admissions WHERE id = $id";
    $result = $conn->query($sql);

    // Check if any patient data is retrieved
    if ($result->num_rows > 0) {
        // Fetch the patient's data
        $row = $result->fetch_assoc();
        echo "<div class='patient-details-container'>";
        echo "<div class='patient-details-table'>";

echo "<div class='button-container-wrapper'>";
    echo "<div class='button-container1'>";
        echo "<a href='#' class='back-button'>Physical Test List</a>";
    echo "</div>";

    echo "<div class='button-container2'>";
        echo "<a href='#' class='back-button'>Diagnostic Test</a>";
    echo "</div>";

    echo "<div class='button-container3'>";
        echo "<a href='#' class='back-button'>Diagnosis Test</a>";
    echo "</div>";
echo "</div>";


        echo "<h2 class='text-center'>Patient Details</h2>";

        // Display patient data in a table
        echo "<table class='table table-bordered'>";
        echo "<thead><tr><th>Field</th><th>Details</th></tr></thead>";
        echo "<tbody>";
        echo "<tr><td><strong>Full Name</strong></td><td>" . $row['fullName'] . "</td></tr>";
        echo "<tr><td><strong>Date of Birth</strong></td><td>" . $row['dob'] . "</td></tr>";
        echo "<tr><td><strong>Age</strong></td><td>" . $row['age'] . "</td></tr>";
        echo "<tr><td><strong>Gender</strong></td><td>" . $row['gender'] . "</td></tr>";
        echo "<tr><td><strong>Address</strong></td><td>" . $row['address'] . "</td></tr>";
        echo "<tr><td><strong>Contact</strong></td><td>" . $row['contact'] . "</td></tr>";
        echo "<tr><td><strong>Emergency Contact</strong></td><td>" . $row['emergencyContactName'] . " (" . $row['emergencyContactRelationship'] . ") - " . $row['emergencyContactPhone'] . "</td></tr>";
        echo "<tr><td><strong>Guardian</strong></td><td>" . $row['guardianName'] . " (" . $row['guardianRelationship'] . ") - " . $row['guardianContact'] . "</td></tr>";
        echo "<tr><td><strong>Onset and Duration</strong></td><td>" . $row['onsetDuration'] . "</td></tr>";
        echo "<tr><td><strong>Current Condition</strong></td><td>" . $row['currentCondition'] . "</td></tr>";
        echo "<tr><td><strong>Past Medical History</strong></td><td>" . $row['pastMedicalHistory'] . "</td></tr>";
        echo "<tr><td><strong>Immunization History</strong></td><td>" . $row['immunizationHistory'] . "</td></tr>";
        echo "<tr><td><strong>Allergies</strong></td><td>" . $row['allergies'] . "</td></tr>";
        echo "<tr><td><strong>Current Medications</strong></td><td>" . $row['currentMedications'] . "</td></tr>";
        echo "<tr><td><strong>Family Medical History</strong></td><td>" . $row['familyMedicalHistory'] . "</td></tr>";
        echo "<tr><td><strong>Parental Consent</strong></td><td>" . ($row['parentalConsent'] ? 'Yes' : 'No') . "</td></tr>";
        echo "</tbody></table>";

      
        echo "<a href='view.php' class='back-button'>Back to Patient List</a>";
        echo "</div>";
        echo "</div>";
    } else {
        echo "<p>Patient not found.</p>";
    }
} else {
    // SQL query to fetch all full names from the database
    $sql = "SELECT id, fullName FROM admissions";
    $result = $conn->query($sql);

    // Check if any names were retrieved
    if ($result->num_rows > 0) {
        // Start the HTML to display the names
        echo "<div class='patient-list-container'>";
        echo "<h2 class='text-center'>Patient Names</h2>";

        // Loop through the results and display the names with a button next to each name
        while($row = $result->fetch_assoc()) {
            echo "<div class='patient-row'>";
            echo "<div class='patient-name'>" . $row['fullName'] . "</div>";
            echo "<div class='patient-button'>";
            echo "<a href='?id=" . $row['id'] . "' class='btn btn-primary'>View Profile</a>";
            echo "</div>";
            echo "</div>";
        }
        echo "<a href='dashboard.php' class='back-button'>Back to Patient List</a>";
        echo "</div>";
    } else {
        echo "<p>No patients found.</p>";
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
    <link rel="stylesheet" href="list_patient.css">
    <title>Patient Names and Details</title>
</head>
<body class="bg-light">
    <div class="container">
        <nav class="sidebar">
            <header>
                <div class="image-text">
                    <div class="text logo-text">
                        <span class="name">Clinic System</span>
                    </div>
                </div>
            </header>
            <div class="menu-bar">
                <div class="menu">
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

        <nav class="navbar">
            <ul class="navbar-links">
                <li><a href="#">About Us</a></li>
            </ul>
        </nav>
    </div>
</body>
</html>
