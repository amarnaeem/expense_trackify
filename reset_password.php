<?php
session_start();
include('include/connectbd.php');
date_default_timezone_set('UTC');

$error_message = "";
$isTokenValid = false; // Flag to check token validity

// Check if token and email are present in the URL
if (isset($_GET['token']) && isset($_GET['email'])) {
    $token = hash("sha256", $_GET['token']);
    $email = mysqli_real_escape_string($conn, $_GET['email']);
    
    // Validate the reset link
    $query = "SELECT * FROM user WHERE user_email = '$email' AND reset_token = '$token'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    // Check if the row exists and if token expiration is valid
    if ($row) {
        $token_expiration = $row['token_expiration'];
        if ($token_expiration && strtotime($token_expiration) > time()) {
            $isTokenValid = true;
        } else {
            $error_message = "The reset link has expired.";
        }
    } else {
        $error_message = "The reset link is invalid.";
    }
} else {
    $error_message = "Invalid request.";
}

// Process form submission only if POST data exists and token is valid
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $isTokenValid) {
    $new_password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    
    if ($new_password === $confirm_password) {
        $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
        $sql = "UPDATE user SET user_pass = '$hashed_password', reset_token = NULL, token_expiration = NULL WHERE user_email = '$email'";
        mysqli_query($conn, $sql);

        // Set session flag for successful password reset
        $_SESSION['password_reset'] = true;

        header("Location: login.php");
        exit();
    } else {
        $error_message = "Passwords do not match.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <link href="https://kit.fontawesome.com/364bc67fad.js" crossorigin="anonymous">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="icon" href="logo.png" type="image/x-icon">

    <style>
        .login-card { border-radius: 1rem; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); padding: 2rem; }
        .bg-custom { background: linear-gradient(135deg, #4e73df, #224abe); }
        .btn-primary { background-color: #4e73df; border: none; }
        .app-name { font-weight: bold; color: #4e73df; font-size: 1.5rem; }
    </style>
</head>
<body class="bg-custom d-flex align-items-center" style="height: 100vh;">
<div class="container d-flex justify-content-center">
    <div class="col-lg-6 col-md-8">
        <div class="card login-card">
            <h2 class="app-name text-center mb-2">Trackify</h2>
            <h4 class="text-center mb-4">Reset Your Password</h4>

            <!-- Error Message Display -->
            <?php if (!empty($error_message)): ?>
                <div class="alert alert-danger text-center"><?= $error_message ?></div>
            <?php endif; ?>

            <!-- Success Message Display -->
            <?php if (isset($success_message)): ?>
                <div class="alert alert-success text-center"><?= $success_message ?></div>
            <?php endif; ?>

            <!-- Show form only if the token is valid -->
            <?php if ($isTokenValid): ?>
            <form action="" method="post">
                <div class="form-group">
                    <div class="input-group">
                        <input type="password" name="password" id="newPasswordField" class="form-control" placeholder="New Password" required>
                        <div class="input-group-append" style="cursor:pointer">
                            <span class="input-group-text" onclick="togglePasswords()">
                                <i id="toggleIcon" class="fas fa-eye"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <input type="password" name="confirm_password" id="confirmPasswordField" class="form-control" placeholder="Confirm Password" required>
                        <div class="input-group-append" style="cursor:pointer">
                            <span class="input-group-text" onclick="togglePasswords()">
                                <i class="fas fa-eye"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <button type="submit" name="reset-password" class="btn btn-primary btn-block">Reset Password</button>
            </form>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- JavaScript for Synchronized Password Toggle -->
<script>
    function togglePasswords() {
        const newPasswordField = document.getElementById("newPasswordField");
        const confirmPasswordField = document.getElementById("confirmPasswordField");
        const toggleIcon = document.getElementById("toggleIcon");
        
        const isPassword = newPasswordField.type === "password";
        newPasswordField.type = isPassword ? "text" : "password";
        confirmPasswordField.type = isPassword ? "text" : "password";
        
        toggleIcon.classList.toggle("fa-eye-slash");
        toggleIcon.classList.toggle("fa-eye");
    }
</script>

</body>
</html>
