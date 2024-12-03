<?php
session_start();
include('include/connectbd.php');
require 'vendor/autoload.php';
// date_default_timezone_set('UTC');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$error = ''; 


$resetRequested = false;

// Handle password reset request
if (isset($_POST['reset-request'])) {
    $user_email = mysqli_real_escape_string($conn, $_POST['email']);
    $query = "SELECT * FROM user WHERE user_email = '$user_email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $token = bin2hex(random_bytes(16));
        $token_hash = hash("sha256", $token);
        $expires = time() + 100;

        $sql = "UPDATE user SET reset_token = '$token_hash', token_expiration = '$expires' WHERE user_email = '$user_email'";
        mysqli_query($conn, $sql);

        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'tracifyapp@gmail.com';
            $mail->Password = 'qenc wrnh dqxx epsh';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('noreply@example.com', 'Trackify');
            $mail->addAddress($user_email);

            $mail->isHTML(true);
            $mail->Subject = 'Password Reset Request';
            $reset_url = "http://localhost/eme/reset_password.php?token=$token&email=$user_email";
            $mail->Body = "To reset your password, click the following link: <a href='$reset_url'>Change Password</a>";

            $mail->send();
            $resetRequested = true;
        } catch (Exception $e) {
            $error = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        $error = "No account found with that email address.";
    }
}?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="icon" href="logo.png" type="image/x-icon">
    <style>
        .login-card { border-radius: 1rem; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); padding: 2rem; }
        .bg-custom { background: linear-gradient(135deg, #4e73df, #224abe); }
        .btn-primary { background-color: #4e73df; color: #fff; font-weight: bold; border: none; }
        .btn-primary:disabled, .btn-primary:disabled:hover { background-color: #888; }
        .btn-primary:hover { background-color: #224abe; color: #fff; }
        .error-message { color: red; font-weight: bold; }
    </style>
</head>
<body class="bg-custom d-flex align-items-center" style="height: 100vh;">
<div class="container d-flex justify-content-center">
    <div class="col-lg-6 col-md-8">
        <div class="card login-card">
        <h2 style="color:#4e73df;" class="mb-4 text-center">Trackify</h2>
            <h2 class="text-center">Forgot Password?</h2>

            <?php if ($resetRequested): ?>
                <div class="alert alert-success text-center">A reset link has been sent to your email.</div>
            <?php endif; ?>

            <form action="" method="post" id="resetForm">
                <div class="form-group">
                    <?php if ($error): ?>
                        <div class="error-message"><?php echo $error; ?></div>
                    <?php endif; ?>
                    <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
                </div>
                <button type="submit" name="reset-request" id="resetButton" class="btn btn-primary btn-block" <?= $resetRequested ? 'disabled' : '' ?>>Send Reset Link</button>
                <div class="text-center mt-2" id="countdown" style="display: none; font-weight: bold;"></div>
            </form>
            <div class="text-center mt-3">
                <a class="small" href="login.php">Dont wants to reset password</a>
            </div>
        </div>
    </div>
</div>

<script>
    <?php if ($resetRequested): ?>
    let countdownDuration = 30 * 60; // 30 minutes in seconds

    const countdownElement = document.getElementById("countdown");
    const resetButton = document.getElementById("resetButton");
    countdownElement.style.display = "block";

    const countdownInterval = setInterval(() => {
        const minutes = Math.floor(countdownDuration / 60);
        const seconds = countdownDuration % 60;
        countdownElement.textContent = `Please wait ${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
        
        if (countdownDuration <= 0) {
            clearInterval(countdownInterval);
            resetButton.disabled = false;
            countdownElement.style.display = "none";
        }
        
        countdownDuration--;
    }, 1000);
    <?php endif; ?>
</script>
</body>
</html>
