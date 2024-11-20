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
                    <h1 class="h3 mb-4 text-gray-800">Budget</h1>
                    <div class="row">
                    <div class="col">


                      <!-- DataTales Example -->
                      <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Budget record from Database</h6>
                        </div>

                        <?php
                        include('include/connectbd.php');

                        if(isset($_GET['del']))
                        {
                             $del_id=$_GET['del'];

                             $del_qry="delete from budget where budget_id='$del_id'";
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
                                            
                                            <th>CATEGORY</th>
                                            <th>BUDGET AMOUNT</th>
                                            <th>DELETE</th>
                                            <th>UPDATE</th>
                                           
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                        <th>ID</th>
                                           
                                            <th>CATEGORY</th>
                                            <th>BUDGET AMOUNT</th>
                                            <th>DELETE</th>
                                            <th>UPDATE</th>
                                    
                                        </tr>
                                    </tfoot>

                                    <tbody>
                                        <?php

                                        include('include/connectbd.php');
                                        $select_expense="select * from budget where user_id='$db_user_id'";
                                        $run_qry=mysqli_query($conn,$select_expense);

                                       while( $budget_array=mysqli_fetch_array($run_qry))
                                       {

                                        $budget_id=$budget_array[0];
                                        $cat_id=$budget_array[1];
                                        $budget_amount=$budget_array[2];
                                       
                                      

                                        //select cat_name from cat table on basis of their id
                                        $select_cat="select * from category where category_id='$cat_id'";
                                        $selrun_qry=mysqli_query($conn,$select_cat);
                                        $select_ary=mysqli_fetch_array($selrun_qry);
                                        $cate_name=$select_ary['category_name'];
                                      
                                        
                                        ?>

                                    <tr>
                                            <td><?php echo $budget_id; ?></td>
                                            <td><?php echo  $cate_name; ?></td>
                                            <td><?php echo $budget_amount; ?></td>
                                           
                                            
                                            <td>
                                                <!-- Button to Open the Modal -->
<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal<?php echo $budget_id; ?>">
  delete
</button>

<!-- The Modal -->
<div class="modal" id="myModal<?php echo $budget_id; ?>">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Delete Record</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
       Delete it. Are you sure...?
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
          <a href="budget.php?del=<?php echo $budget_id?>" class="btn btn-danger">Delete</a>
        <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

   </td>
   <!--delete btn model td end -->

     <!--update btn start -->
     <td><a href="edit_budget.php?editbudget=<?php echo   $budget_id; ?>" class="btn btn-success">Update</a></td>                                    
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