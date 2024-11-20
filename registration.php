<?php
session_start();
ob_start();

include('include/connectbd.php');

if (isset($_POST['user_insert'])) {
    $u_name = $_POST['user_name'];
    $u_email = $_POST['user_email'];
    $u_password = $_POST['user_password'];
    $u_img = $_FILES['user_image']['name'];
    $u_img_name = $_FILES['user_image']['tmp_name'];

    $secure_password = password_hash($u_password, PASSWORD_BCRYPT);

    // Check if username or email already exists
    $select_user = "SELECT * FROM user WHERE user_email='$u_email' OR user_name='$u_name'";
    $run_user = mysqli_query($conn, $select_user);

    if (mysqli_num_rows($run_user) > 0) {
        $_SESSION['error_message'] = "Username or Email already exists";
    } else {
        // Insert new user into database
        $insert_qry = "INSERT INTO user (user_name, user_email, user_pass, user_image, role) 
                       VALUES ('$u_name', '$u_email', '$secure_password', '$u_img', 'User')";
        $run_insert = mysqli_query($conn, $insert_qry);

        if ($run_insert) {
            move_uploaded_file($u_img_name, "upload/$u_img");
            $_SESSION['registered'] = true;
            header("Location: login.php");
            exit();
        } else {
            $_SESSION['error_message'] = "Error: " . mysqli_error($conn);
        }
    }
}
ob_end_flush();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Registration Form</title>

    <!-- Font Awesome CDN -->
    <script src="https://kit.fontawesome.com/364bc67fad.js" crossorigin="anonymous"></script>
    <link rel="icon" href="logo.png" type="image/x-icon">

    <!-- Custom fonts and styles -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    
    <style>
        .registration-card {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            padding: 2rem;
        }
        .bg-custom {
            background: linear-gradient(135deg, #4e73df, #224abe);
        }
        .register-btn {
            background-color: #4e73df;
            border: none;
            border-radius: 10rem;
            font-weight: bold;
            color: #fff;
        }
        .register-btn:hover {
            background-color: #224abe;
            color: #fff;
        }
        .alert-custom {
            font-size: 0.9rem;
            text-align: center;
        }
        .toggle-password {
            cursor: pointer;
        }
    </style>
</head>

<body class="bg-custom d-flex align-items-center" style="height: 100vh;">

<div class="container d-flex justify-content-center">
    <div class="col-lg-6 col-md-8">
        <div class="card registration-card">
            <h2 class="h3 text-gray-800 text-center mb-4">Register Account with <span style="color:#4e73df;">Trackify</span></h2>

            <form action="" method="post" enctype="multipart/form-data">
                <!-- Name Input -->
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" class="form-control" name="user_name" placeholder="Full Name" required>
                    </div>
                </div>

                <!-- Email Input -->
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        </div>
                        <input type="email" class="form-control" name="user_email" placeholder="Email Address" required>
                    </div>
                </div>

                <!-- Password Input with Toggle Icon -->
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        </div>
                        <input type="password" class="form-control" id="user_password" name="user_password" placeholder="Password" required>
                        <div class="input-group-append">
                            <span class="input-group-text toggle-password"><i class="fas fa-eye"></i></span>
                        </div>
                    </div>
                </div>

                <!-- Image Input -->
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-image"></i></span>
                        </div>
                        <input type="file" class="form-control" name="user_image" required>
                    </div>
                </div>

                <!-- Error Alert (if any) -->
                <?php if (isset($_SESSION['error_message'])): ?>
                    <div class="alert alert-danger alert-custom mt-3">
                        <?php echo $_SESSION['error_message']; ?>
                    </div>
                    <?php unset($_SESSION['error_message']); // Clear error after displaying ?>
                <?php endif; ?>

                <!-- Submit Button -->
                <div class="form-group">
                    <button type="submit" name="user_insert" class="btn btn-success btn-block register-btn">Register</button>
                </div>
            </form>

            <div class="text-center mt-3">
                <a class="small" href="login.php">Already have an account? Login!</a>
            </div>
        </div>
    </div>
</div>

<script>
    // Toggle password visibility
    document.querySelector('.toggle-password').addEventListener('click', function () {
        const passwordInput = document.getElementById('user_password');
        const icon = this.querySelector('i');
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    });
</script>

</body>
</html>
