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

                                                       <!-- 1st coloumn -->
                    <h1 class="h3 mb-4 text-gray-800">Profile</h1>
                    <div class="row">
                        <div class="col-md-3 text-center">
                            <img src="upload/<?php echo $db_user_pic?>" style="width:60%; border-radius:50%;" >
                            

                            <ul class="list-group p-2">  
                        <a href="profile.php" class="list-group-item">Profile</a>
						<a href="report.php" class="list-group-item">Report</a>
						<a href="budget.php" class="list-group-item">Budget</a>
                              </ul>
                       </div>
                                                          <!--2nd coloumn -->
                       <div class="col-md-9"> 
                       
                       <h2>Edit Profile</h2>

                       <form action="" method="post" enctype="multipart/form-data">
						<div class="form-group">
							<label>Name</label>
							<input type="text" name="user_name" value="<?php echo $db_user_name;?>" class="form-control"  />
						</div>
						
						<div class="form-group">
							<label>Password</label>
							<input type="text" class="form-control" value="<?php echo $bd_user_password;?>" name="user_password" required  />
						</div>
						
						<div class="form-group">
							<label>Image</label>
							<input type="file" class="form-control" name="user_image" />
						</div>
						
						
						<div class="form-group">
							<input type="submit" class="btn btn-success" value="Save changes" name="insert_btn" />
						</div>
						
					</form>

                            <!-- pick form values to update -->
 
                    <?php
                   if(isset($_POST['insert_btn']))
                
                    {
                        $edit_name=$_POST['user_name'];
                        $edit_password=$_POST['user_password'];
                        $edit_img=$_FILES['user_image']['name'];
                        $edit_tmp_nmae=$_FILES['user_image']['tmp_name'];
                       





                     // if img is not update(mean it is empty )then store last updated img
                      if(empty($edit_img))
                      {
                        $edit_img=$db_user_pic;
                      }

                      

                      

                      $update_user = "update user set user_name='$edit_name',user_pass='$edit_password', user_image='$edit_img' where user_id=' $db_user_id'";
                       $run_update=mysqli_query($conn,$update_user);
                       if($run_update)
                       {
                        echo "<div class='alert alert-success'>user data updated succesfully</div>";
                        move_uploaded_file( $edit_tmp_nmae,"upload/$edit_img");
                       }
                       else{
                        echo "<div class='alert alert-danger'>error to update</div>";
                       }    






                    }
                
                    
                    ?>
                    
                    
                       </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

           

        </div>
        <!-- End of Content Wrapper -->
        


          <!-- Footer -->
        <?php include('include/footer.php')?>
        <!-- End of Footer -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button -->
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
                    <a class="btn btn-primary" href="login.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

   

   <!-- all cdns-->

   <?php include('include/end.php') ?>