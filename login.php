<?php
session_start();

// Handle login request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conn = new mysqli('localhost', 'root', '', 'clinic_db');

    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

    // Sanitize user inputs
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);

    // Query to fetch the user from the database
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    // Check if the username exists and if the password matches
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if ($password === $user['password']) {
            $_SESSION['username'] = $username;
            header('Location: dashboard.php');
            exit();
        } else {
            $error_message = "Invalid username or password!";
        }
    } else {
        $error_message = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <!-- Error Message Outside Login Container -->
    <?php if (isset($error_message)): ?>
        <div class="alert fade show text-center" id="error-message" role="alert">
            <?php echo $error_message; ?>
        </div>
    <?php endif; ?>

    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="login-container p-4 shadow-lg">
            <h2 class="text-center mb-4">Login</h2>

            <form method="POST" action="">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="username" id="username" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="password-container">
                        <input type="password" name="password" id="password" class="form-control" required>
                        <span class="eye-icon" id="toggle-password" onclick="togglePassword()">👁️</span>
                    </div>
                </div>
                <button type="submit" class="btn btn-custom w-100">Login</button>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Hide error message after a few seconds
        $(document).ready(function() {
            setTimeout(function() {
                $('#error-message').fadeOut();
            }, 3000);
        });

        // Toggle password visibility
        function togglePassword() {
            const passwordField = document.getElementById("password");
            const eyeIcon = document.getElementById("toggle-password");

            if (passwordField.type === "password") {
                passwordField.type = "text";
                eyeIcon.textContent = "🙈"; 
            } else {
                passwordField.type = "password";
                eyeIcon.textContent = "👁️"; 
            }
        }
    </script>
</body>
</html>
