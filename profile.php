<?php

ob_start(); // Start output buffering
include('include/top.php');
?>

<style>
    /* Profile Image Styles */
    .profile-img-container {
        width: 100%;
        display: flex;
        justify-content: center;
    }

    .profile-img {
        width: 250px;
        height: 250px;
        border-radius: 50%;
        overflow: hidden;
        border: 1px solid #000;
    }

    .profile-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    @media (max-width: 576px) {
        .profile-img {
            width: 150px;
            height: 150px;
        }
    }
</style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include('include/sidebar.php'); ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include('include/topbar.php'); ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- 1st column -->
                    <h1 class="h3 mb-4 text-gray-800">Profile</h1>
                    <div class="row">
                        <div class="col-md-3 text-center">
                            <div class="profile-img-container">
                                <div class="profile-img">
                                    <img id="profileImage" src="upload/<?php echo $db_user_pic; ?>" alt="Profile Picture">
                                </div>
                            </div>

                            <ul class="list-group p-2 mt-3">
                                <a href="profile.php" class="list-group-item">Profile</a>
                                <a href="report.php" class="list-group-item">Report</a>
                                <a href="budget.php" class="list-group-item">Budget</a>
                            </ul>
                        </div>

                        <!-- 2nd column -->
                        <div class="col-md-9">
                            <h2>Edit Profile</h2>

                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="user_name" value="<?php echo $db_user_name; ?>" class="form-control" />
                                </div>

                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="user_email" value="<?php echo $db_user_email; ?>" class="form-control" required />
                                </div>

                                <div class="form-group">
                                    <label>Password (Enter new password if changing)</label>
                                    <input type="password" name="user_password" class="form-control" placeholder="Enter new password" />
                                </div>

                                <div class="form-group">
                                    <label>Profile Image</label>
                                    <input type="file" class="form-control" name="user_image" id="user_image" />
                                </div>

                                <div class="form-group">
                                    <input type="submit" class="btn btn-success" value="Save changes" name="insert_btn" />
                                </div>
                            </form>

                            <!-- Display success message -->
                            <?php
                            if (isset($_SESSION['success_message'])) {
                                echo "<div class='alert alert-success'>" . $_SESSION['success_message'] . "</div>";
                                unset($_SESSION['success_message']); // Clear the success message after displaying
                            }
                            ?>

                            <!-- Process form data to update user details -->
                            <?php
                            if (isset($_POST['insert_btn'])) {
                                $edit_name = $_POST['user_name'];
                                $edit_email = $_POST['user_email'];

                                // Only update password if entered
                                if (!empty($_POST['user_password'])) {
                                    $edit_password = password_hash($_POST['user_password'], PASSWORD_DEFAULT);
                                    $update_password_query = ", user_pass='$edit_password'";
                                } else {
                                    $update_password_query = '';  // Don't update password if it's not provided
                                }

                                $edit_img = $_FILES['user_image']['name'];
                                $edit_tmp_name = $_FILES['user_image']['tmp_name'];

                                // If a new image is selected, save it
                                if (!empty($edit_img)) {
                                    $image_extension = pathinfo($edit_img, PATHINFO_EXTENSION);
                                    $image_name = uniqid() . '.' . $image_extension; // Make the image name unique
                                    $image_path = "upload/" . $image_name;

                                    // Move uploaded image to the desired folder
                                    if (move_uploaded_file($edit_tmp_name, $image_path)) {
                                        $edit_img = $image_name;  // Use the new image name
                                    } else {
                                        echo "<div class='alert alert-danger'>Error uploading image</div>";
                                        exit;
                                    }
                                } else {
                                    // If no new image is selected, keep the old image
                                    $edit_img = $db_user_pic;
                                }

                                // Update user data
                                $update_user = "UPDATE user SET user_name='$edit_name', user_email='$edit_email' $update_password_query, user_image='$edit_img' WHERE user_id='$db_user_id'";
                                $run_update = mysqli_query($conn, $update_user);

                                if ($run_update) {
                                    $_SESSION['success_message'] = "User data updated successfully"; // Set session message
                                    header('Location: ' . $_SERVER['PHP_SELF']); // Redirect to refresh the page
                                    exit(); // Ensure no further code is executed
                                } else {
                                    echo "<div class='alert alert-danger'>Error updating data</div>";
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Content -->
            <?php include('include/footer.php'); ?> 
        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <?php include('include/end.php'); ?> 

    <script>
        document.getElementById('user_image').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    // Update the profile image container with the new image
                    document.getElementById('profileImage').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>

</body>

<?php
ob_end_flush(); // Send the buffered output to the browser
?>
