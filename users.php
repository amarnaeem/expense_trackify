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


<?php
include('include/connectbd.php');
                // find number of users

$select_users="select * from user";
$run_users=mysqli_query($conn,$select_users);
$numrows=mysqli_num_rows($run_users);
// remove admin from users than display no of users

 $total_users=$numrows-1;
 ?>

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Total Users : <?php echo $total_users;?></h1>
                    <div class="row">
                    <div class="col">


                      <!-- DataTales Example -->
                      <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h4 class="m-0 font-weight-bold text-primary">User record </h4>
                        </div>

                        <?php
                        include('include/connectbd.php');

                        if(isset($_GET['del']))
                        {
                             $del_id=$_GET['del'];

                             $del_qry="delete from user where user_id='$del_id'";
                             $del_runqry=mysqli_query($conn,$del_qry);

                             if($del_runqry)
                             {
                                 echo "<div class='alert alert-success'> record deleted succesfully</div>";
                             }
                             else
                             {
                                echo "<div class='alert alert-danger'> error</div>";

                             }


                        }
                        ?>






                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>User Name</th>
                                            <th>User Email</th>
                                            <th>User Password</th>
                                            <th>User Image</th>
                                            <th>DELETE</th>
                                            <th>UPDATE</th>
                                           
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php

                                        include('include/connectbd.php');
                                        $select_user="select * from user ";
                                        $run_qry=mysqli_query($conn,$select_user);
                                        $index = 0;

                                       while( $user_array=mysqli_fetch_array($run_qry))
                                       {

                                        $usr_id=$user_array['user_id'];
                                        $usr_name=$user_array['user_name'];
                                        $usr_email=$user_array['user_email'];
                                        $usr_pass=$user_array['user_pass'];
                                        $usr_img=$user_array['user_image'];
                                 

                                     /*  //select cat_name from cat table on basis of their id
                                        $select_cat="select * from category where category_id='$cat_id'";
                                        $selrun_qry=mysqli_query($conn,$select_cat);
                                        $select_ary=mysqli_fetch_array($selrun_qry);
                                        $cate_name=$select_ary['category_name']; */
                                      
                                        
                                        ?>

                                    <tr>
                                            <td><?php echo ++$index; ?></td>
                                            <td><?php echo ucfirst( $usr_name); ?></td>
                                            <td><?php echo ( $usr_email); ?></td>
                                            <td><?php echo "********"; ?></td>
                                            <td><img src="upload/<?php echo $usr_img ?>" height="60px"></td>
                                            
                                            
                                            <td>
                                                <!-- Button to Open the Modal -->
<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal<?php echo $usr_id; ?>">
  delete
</button>

<!-- The Modal -->
<div class="modal" id="myModal<?php echo $usr_id; ?>">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Delete Record</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        Are you sure...?
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
          <a href="users.php?del=<?php echo $usr_id?>" class="btn btn-danger">Delete</a>
        <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

   </td>
   <!--delete btn model td end -->

     <!--update btn start -->
     <td><a href="edit_user.php?edituser=<?php echo $usr_id; ?>" class="btn btn-success">Update</a></td>                                    
                                        </tr>
                                        <?php }  ?>
                                   
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
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