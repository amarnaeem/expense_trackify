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
                    <h1 class="h3 mb-4 text-gray-800">Edit Expense Record</h1>

                    <?php
                    include('include/connectbd.php');

                    if(isset($_GET['editexp']))
                    {
                         $edit_id=$_GET['editexp'];
                        $select_qry="select * from expense where expense_id='$edit_id'";
                        $run_qry=mysqli_query($conn,$select_qry);
                        $ary_qry=mysqli_fetch_array($run_qry);

// getting values from expense table selected row for edit

                        $exp_amount=$ary_qry[1];
                        $cat_id=$ary_qry[2];
                        $exp_datail= $ary_qry[3];
                        $exp_receipt=$ary_qry[4];
                         $exp_date=$ary_qry[5];
                        $exp_month=$ary_qry[6];
                        $exp_year=$ary_qry[7];

                    

                    }
                    
                    ?>

                    <div class="row">
                        <div class="col">
                       
                    <form action="" method="post" enctype="multipart/form-data"> 

                    <div class="form-group">
                        <label>Amount</label>
                        <input type="number" value="<?php echo $exp_amount;?>" class="form-control" name="amount">
                    </div>

                    <div class="row">
                        <div class="col-md-6">

                        <div class="form-group">
                        <label>category</label>
                        <select class="form-control" name="c_id" >
                           
                           <?php
                         
                           $select_cat="select * from category where category_purpose = 'expense'";
                           $run_query = mysqli_query($conn,$select_cat);

                        while($get_ary=mysqli_fetch_array($run_query))
                        {

                           $category_id= $get_ary[0];
                           $category_name= $get_ary[1];

                           ?>


                            <option <?php if($cat_id == $category_id ){echo "selected";} ?> value="<?php echo $category_id; ?>"><?php echo $category_name; ?></option>
                            <?php } ?>
                        </select>

                    </div>



                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>recipt</label>
                                <input type="file" class="form-control" name="expense_receipt">
                            </div>



                        </div>
                       
                    </div>

                    
                            <div class="form-group">
                                <label>Date</label>
             <input type="date" value="<?php echo $exp_date; ?>" class="form-control" name="expense_date">
                                </div>

                                <div class="form-group">
                                <label>Details</label>
                                <textarea class="form-control" name="expense_details"><?php echo $exp_datail; ?></textarea>
                                </div>

                                <div class="form-group">
                                
                                <input type="submit" value="Edit Expense" class=" btn btn-success btn-block " name="expense_update">
                                </div>




                      </form>
                      <?php
                     

                      if (isset($_POST['expense_update']))
                      {
                         
                           $uexp_amount=$_POST['amount'];
                           $uexp_id=$_POST['c_id'];
                          
                           $uexp_date=$_POST['expense_date'];
                           $uexp_details=$_POST['expense_details'];
                          $month = Date('m');
                          $year = Date('y');
                          $uexp_receipt_name =$_FILES['expense_receipt']['name'];
                          $uexp_receipt_tmpname =$_FILES['expense_receipt']['tmp_name'];

                          if(empty($uexp_receipt_name))
                          {
                            $uexp_receipt_name =  $exp_receipt;
                            
                          }

     $update_qry ="update expense set expense_amount='$uexp_amount',category_id='$uexp_id',
     expense_details='$uexp_details',expense_receipt='$uexp_receipt_name',expense_date=' $uexp_date',
     expense_month='$month',expense_year='$year' where expense_id='$edit_id'";

                          $runin_qry=mysqli_query($conn,$update_qry);

                          if($runin_qry)
                          {
                              echo "<div class='alert alert-success'>data edited in DB successfull</div>";
                              move_uploaded_file($uexp_receipt_tmpname,"upload/$uexp_receipt_name");
                              echo "<script>window.open('expense.php','_self')</script>";
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
                    <a class="btn btn-primary" href="login.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

   <!-- all cdns-->

   <?php include('include/end.php') ?>