<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="dash.css">
    <title>Dashboard</title>
</head>
<body>
<div class="container">
    <nav class="sidebar">
        <header>
        <div class="image-text">
                <span class="image">
                    <!-- Place Our Logo Here? -->
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
                <li class="">
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

        <div class="dashboard-content">
            <div class="dashboard-box">
                <h1>Clinic System</h1>
                <p>Welcome to the Clinic System, a Clinic Management System.</p>
            </div>

            <!-- Rectangles -->
            <div class="rectangles-container">
                <div class="rectangle">
                    <i class="material-icons icon">medical_information</i>
                    <h2>Services</h2>
                    <p>Brief Description</p>
                </div>
                <div class="rectangle">
                    <i class="material-icons icon">perm_contact_calendar</i>
                    <h2>Contacts</h2>
                    <p>Brief Description</p>
                </div>
                <div class="rectangle">
                    <i class="material-icons icon">location_on</i>
                    <h2>Locations</h2>
                    <p>Brief Description</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>