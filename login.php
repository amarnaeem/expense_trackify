    <?php
    session_start();
    // $_SESSION['registered'] = true; 
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Login</title>
        <!-- Font Awesome and custom CSS -->
        <script src="https://kit.fontawesome.com/364bc67fad.js" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
        <link href="css/sb-admin-2.min.css" rel="stylesheet">
        <link rel="icon" href="logo.png" type="image/x-icon">

        
        <!-- Toastify CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
        
        <style>
            .login-card { border-radius: 1rem; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); padding: 2rem; }
            .bg-custom { background: linear-gradient(135deg, #4e73df, #224abe); }
            .login-btn { background-color: #4e73df; color: #fff; font-weight: bold; border: none; }
            .login-btn:hover { background-color: #224abe; color: #fff; }
            .text-black { color: #4e73df; font-weight: 600; cursor: pointer;}
            .text-black:hover {text-decoration: underline;} 
            hr {margin-bottom: 5px !important;}
        </style>
    </head>

    <body class="bg-custom d-flex align-items-center" style="height: 100vh;">

    <div class="container d-flex justify-content-center">
        <div class="col-lg-6 col-md-8">
            <div class="card login-card">
                <h1 class="h4 text-gray-800 text-center mb-4">Login to <span style="color:#4e73df;">Trackify</span></h1>
                
                <!-- Login Form -->
                <form class="user" action="" method="post">
                    <!-- Username or Email Input -->
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" name="username_or_email" class="form-control" placeholder="Username or Email" required>
                        </div>
                    </div>

                    <!-- Password Input with Toggle -->
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            </div>
                            <input type="password"  name="password" class="form-control" placeholder="Password" id="passwordField" required>
                            <div class="input-group-append" style="cursor:pointer">
                                <span class="input-group-text" onclick="togglePassword()"><i id="toggleIcon" class="fas fa-eye"></i></span>
                            </div>
                        </div>
                        <div class="text-right">
                            <a class="small  cursor-pointer text-black" href="forgot_password.php">Forgot Password?</a>
                        </div>
    </div>

                    <button type="submit" name="login-btn" class="btn btn-primary btn-user btn-block login-btn">Login</button>
                </form>


                <!-- PHP Login Validation -->
                <?php 
                include('include/connectbd.php');

                if (isset($_POST['login-btn'])) {
                    $input = $_POST['username_or_email'];
                    $password = $_POST['password'];
                    $isEmail = filter_var($input, FILTER_VALIDATE_EMAIL);
                    $query = $isEmail ? "SELECT * FROM user WHERE user_email='$input'" : "SELECT * FROM user WHERE user_name='$input'";
                    $result = mysqli_query($conn, $query);

                    if (mysqli_num_rows($result) > 0) {
                        $user = mysqli_fetch_array($result);
                        if (password_verify($password, $user['user_pass'])) {
                            $_SESSION['email'] = $user['user_email'];
                            $_SESSION['ROLE'] = $user['role'];
                            $_SESSION['is_logged_in'] = true;
                            $_SESSION['user_id'] = $user['user_id'];

                            echo "<script>window.open('index.php','_self')</script>";
                        } else {
                            echo "<div class='alert alert-danger mt-3'>Incorrect username or password</div>";
                        }
                    } else {
                        echo "<div class='alert alert-danger mt-3'>Incorrect username or password</div>";
                    }
                }
                ?>

                <hr>
                <div class="text-center">
                    <a class="" href="registration.php">Create an Account!</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Toastify JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    <!-- JS for Toastify Notification and Password Toggle -->
    <script>
        // Display Toastify notification if 'registered' is in the URL
        <?php if (isset($_SESSION['registered'])): ?>
        Toastify({
            text: "New user registered successfully. Please log in!",
            duration: 5000,
            close: true,
            gravity: "top",
            position: "right",
            backgroundColor: "green", // Green color for success
            stopOnFocus: true
        }).showToast();
        <?php unset($_SESSION['registered']); // Clear session flag ?>
    <?php endif; ?>

    // Display Toastify notification if 'password_reset' is in the session
<?php if (isset($_SESSION['password_reset'])): ?>
Toastify({
    text: "Password reset successfully. Please log in!",
    duration: 5000,
    close: true,
    gravity: "top",
    position: "right",
    backgroundColor: "green", // Green color for success
    stopOnFocus: true
}).showToast();
<?php unset($_SESSION['password_reset']); // Clear session flag ?>
<?php endif; ?>


        // Password toggle function
        function togglePassword() {
            const passwordField = document.getElementById("passwordField");
            const toggleIcon = document.getElementById("toggleIcon");
            passwordField.type = passwordField.type === "password" ? "text" : "password";
            toggleIcon.classList.toggle("fa-eye-slash");
            toggleIcon.classList.toggle("fa-eye");
        }
    </script>

    </body>
    </html>
