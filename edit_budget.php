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
                    <h1 class="h3 mb-4 text-gray-800">Edit Budget</h1>

                    <?php
                       include('include/connectbd.php');

                       if(isset($_GET['editbudget']))
                       {
                       $edit_row_id=$_GET['editbudget'];
                       $select_budget="select * from budget where budget_id='$edit_row_id'";
                       $run_select=mysqli_query($conn,$select_budget);
                       $ary_buget_row=mysqli_fetch_array( $run_select);

                      $budget_cat_id=$ary_buget_row[1];
                        $budget_amount=$ary_buget_row[2];



                      /*  $Select_cat="select * from category where category_id='$budget_cat_id'";
                        $run_cat=mysqli_query($conn,$Select_cat);
                        $ary_cat=mysqli_fetch_array($run_cat);

                        $dbcategory_name=$ary_cat['category_name'];*/



                       }

                        
                        
                        ?>

                    <div class="row">
                        <div class="col">

                       
                    <form action="" method="post" enctype="multipart/form-data"> 

                    <div class="form-group">
                        <label>Amount</label>
                        <input type="number" value="<?php echo $budget_amount; ?>" class="form-control" name="budget_amount">
                    </div>

                    <div class="row">
                        <div class="col-md-12">

                        <div class="form-group">
                        <label>category</label>
                        <select class="form-control" name="bud_category_id" required>
                            <option disabled>select category</option>
                           <?php
                           include('include/connectbd.php');
                           $select_cat="select * from category where category_purpose = 'expense'";
                           $run_qry = mysqli_query($conn,$select_cat);

                        while($get_ary=mysqli_fetch_array($run_qry))
                        {

                           $category_id= $get_ary[0];
                           $category_name= $get_ary[1];

                           ?>


                            <option <?php if($budget_cat_id == $category_id){echo "selected";}?> value="<?php echo $category_id; ?>"><?php echo $category_name; ?></option>
                            <?php } ?>
                        </select>

                    </div>



                        </div>
                        
                       
                    </div>

                    
                          

                                <div class="form-group">
                                
                                <input type="submit" value="Edit budget" class=" btn btn-success btn-block " name="budget_insert">
                                </div>




                      </form>
                      <?php
                      include('include/connectbd.php');

                      if (isset($_POST['budget_insert']))
                      {
                         
                           $new_budget_amount=$_POST['budget_amount'];
                           $new_category_id=$_POST['bud_category_id'];
                          
                          

                         $update_qry ="update budget set budget_amount='$new_budget_amount',category_id='$new_category_id'
                          where budget_id='$edit_row_id'" ;

                          $runupdate_qry=mysqli_query($conn,$update_qry);

                          if($runupdate_qry)
                          {
                              echo "<div class='alert alert-success'>data update in DB successfull</div>";
                             
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