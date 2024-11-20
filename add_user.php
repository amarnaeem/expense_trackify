<?php include('include/top.php')?>
<?php
if( $_SESSION['ROLE'] != 'Admin')
{
    header("location:index.php");
}
?>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->

        <?php include('include/sidebar.php')?>

        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
               
                <?php include('include/topbar.php')?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Add User </h1>

                    <div class="row">
                        <div class="col">
                       
                    <form action="" method="post" enctype="multipart/form-data"> 

                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="user_name">
                    </div>

                    <div class="row">
                        <div class="col-md-6">

                        <div class="form-group">
                        <label>email</label>
                       <input type="email" class="form-control" name="user_email">

                    </div>



                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>password</label>
                                <input type="password" class="form-control" name="user_password">
                            </div>



                        </div>
                       
                    </div>

                    
                            <div class="form-group">
                                <label>Image</label>
                                <input type="file" class="form-control" name="user_image">
                                </div>

                                

                                <div class="form-group">
                                
                                <input type="submit" value="Add User" class=" btn btn-success btn-block " name="user_insert">
                                </div>




                      </form>
                      <?php
                      include('include/connectbd.php');

                      if (isset($_POST['user_insert']))
                      {
                         
                           $u_name=$_POST['user_name'];
                           $u_email=$_POST['user_email'];
                          
                           $u_password=$_POST['user_password'];
                          $u_img =$_FILES['user_image']['name'];
                          $u_img_name=$_FILES['user_image']['tmp_name'];

                           // making password secure and save it in another variable

                          $select_salt="select * from user order by user_id desc limit 1";
                          $run_salt=mysqli_query($conn,$select_salt);
                          $row_salt=mysqli_fetch_array($run_salt);
                          
                          $salt = $row_salt['salt'];
                        //    $secure_password = crypt($u_password,$salt);
                        $secure_password = password_hash($u_password, PASSWORD_DEFAULT);

                          // check email

                          $select_email="select * from user where user_email='$u_email'";
                          $run_email=mysqli_query($conn,$select_email);
                          if(mysqli_num_rows($run_email)>0)
                          {
                              echo "<div class='alert alert-danger'>Email already Exist</div>";
                          }
                          else
                          {
                            // $insert_qry ="insert into user (user_name,user_email,user_pass,user_image) 
                            // values('$u_name','$u_email','$u_password','$u_img')";


                            $insert_qry = "INSERT INTO user (user_name, user_email, user_pass, user_image, role) 
               VALUES ('$u_name', '$u_email', '$secure_password', '$u_img', 'User')";


                            $run_user = mysqli_query($conn,$insert_qry);

                            if($run_user)
                            {
                                echo "<div class='alert alert-success'>New User added in DB successfull</div>";
                                move_uploaded_file($u_img_name,"upload/$u_img");
                            }
  
                            else{
                              echo "<div class='alert alert-danger'>error</div>";
  
                            }







                          }






                      }


                      ?>
</div>
</div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
          
            <?php include('include/footer.php')?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

   <!-- all cdns-->

   <?php include('include/end.php') ?>