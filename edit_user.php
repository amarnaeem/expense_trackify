<?php include('include/top.php')?>

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
                    <h1 class="h3 mb-4 text-gray-800">Edit User Record</h1>

                    <?php
                    include('include/connectbd.php');

                    if(isset($_GET['edituser']))
                    {
                         $edit_id=$_GET['edituser'];
                        $select_qry="select * from user where user_id='$edit_id'";
                        $run_qry=mysqli_query($conn,$select_qry);
                        $ary_qry=mysqli_fetch_array($run_qry);

// getting values from user table selected row for edit

                       $usr_id=$ary_qry['user_id'];
                      $usr_name=$ary_qry['user_name'];
                       $usr_email=$ary_qry['user_email'];
                       $usr_pass=$ary_qry['user_pass'];
                       $usr_img=$ary_qry['user_image'];


                        

                    

                    }
                    
                    ?>

                    <div class="row">
                        <div class="col">
                       
                    <form action="" method="post" enctype="multipart/form-data"> 

                    <div class="form-group">
                        <label>User Name</label>
                        <input type="text" value="<?php echo $usr_name;?>" class="form-control" name="u_name">
                    </div>

                    <div class="row">
                        <div class="col-md-6">

                        <div class="form-group">
                        <label>Email</label>
                        <input type="email" value="<?php echo $usr_email;?>" class="form-control" name="u_email">
                      

                    </div>



                        </div>
                        <div class="col-md-6">


                        <div class="form-group">
                                <label>Password</label>
             <input type="text" value="<?php echo $usr_pass; ?>" class="form-control" name="u_pass">
                                </div>


                        </div>
                       
                    </div>

                    
                    <div class="form-group">

<label>User Image</label>
<input type="file" class="form-control" name="u_img">
</div>

                               

                                <div class="form-group">
                                
                                <input type="submit" value="Edit User" class=" btn btn-success btn-block " name="user_update">
                                </div>




                      </form>
                      <?php
                     

                      if (isset($_POST['user_update']))
                      {
                         
                           $u_name=$_POST['u_name'];
                           $ue_email=$_POST['u_email'];
                           $u_pass=$_POST['u_pass'];
                           $u_img=$_FILES['u_img']['name'];
                           $u_img_tmpname =$_FILES['u_img']['tmp_name'];


                         
                      // if user not update user img than store previous img in it
                          if(empty($u_img))
                          {
                            $u_img =  $usr_img;
                            
                          }

     $update_qry ="update user set user_name='$u_name',user_email='$ue_email',
     user_pass='$u_pass',user_image='$u_img' where user_id='$edit_id'";

                          $runin_qry=mysqli_query($conn,$update_qry);

                          if($runin_qry)
                          {
                              echo "<div class='alert alert-success'>data edited in DB successfull</div>";
                              move_uploaded_file($u_img_tmpname,"upload/$u_img");
                              echo "<script>window.open('users.php','_self')</script>";
                          }

                          else{
                            echo "<div class='alert alert-danger'>error</div>";

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
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

   <!-- all cdns-->

   <?php include('include/end.php') ?>