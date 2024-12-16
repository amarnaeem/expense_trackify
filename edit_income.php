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
                    <h1 class="h3 mb-4 text-gray-800">Edit Income Records</h1>

                    <?php
                    include('include/connectbd.php');
                    if(isset($_GET['editinc']))
                    {
                         $edit_id=$_GET['editinc'];
                        $select_qry="select * from income where income_id='$edit_id'";
                        $run_qry=mysqli_query($conn,$select_qry);
                        $ary_qry=mysqli_fetch_array($run_qry);

                        $inc_amount=$ary_qry[1];
                        $cat_id=$ary_qry[2];
                       $inc_datail= $ary_qry[3];
                        $inc_receipt=$ary_qry[4];
                        $inc_date=$ary_qry[5];
                        $inc_month=$ary_qry[6];
                        $inc_year=$ary_qry[7];



                    }
                    
                    ?>

                    <div class="row">
                        <div class="col">
                       
                    <form action="" method="post" enctype="multipart/form-data"> 

                    <div class="form-group">
                        <label>Amount</label>
                        <input type="number" value="<?php echo $inc_amount;?>" class="form-control" name="amount">
                    </div>

                    <div class="row">
                        <div class="col-md-6">

                        <div class="form-group">
                        <label>category</label>
                        <select class="form-control" name="category_id" >
                            
                           <?php
                         
                           $select_cat="select * from category where category_purpose = 'income'";
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
                                <input type="file" class="form-control" name="income_receipt">
                            </div>
                          </div>
                        </div>

                                    
                                                <!-- date field-->


                            <div class="form-group">
                                <label>Date</label>
             <input type="date" value="<?php echo $inc_date;?>" class="form-control" name="income_date">
                                </div>

                                <div class="form-group">
                                <label>Details</label>
                                <textarea class="form-control" name="income_details"><?php echo $inc_datail; ?></textarea>
                                </div>

                                <div class="form-group">
                                
                                <input type="submit" value="Edit Income" class=" btn btn-success btn-block " name="income_insert">
                                </div>




                      </form>
                      <?php
                      include('include/connectbd.php');

                      if (isset($_POST['income_insert']))
                      {
                         
                           $in_amount=$_POST['amount'];
                           $in_id=$_POST['category_id'];
                          
                           $in_date=$_POST['income_date'];
                          $in_details=$_POST['income_details'];
                          $month = Date('m');
                          $year = Date('y');
                          $in_receipt_name =$_FILES['income_receipt']['name'];
                          $in_receipt_tmpname =$_FILES['income_receipt']['tmp_name'];

                          if(empty($in_receipt_name))
                          {
                             $in_receipt_name =  $inc_receipt;
                            
                          }

     $update_qry ="update income set income_amount='$in_amount',category_id='$in_id',
     income_details='$in_details',income_receipt='$in_receipt_name',income_date=' $in_date',
     income_month='$month',income_year='$year' where income_id='$edit_id'";

                          $runin_qry=mysqli_query($conn,$update_qry);

                          if($runin_qry)
                          {
                              echo "<div class='alert alert-success'>data edited in DB successfull</div>";
                              move_uploaded_file($in_receipt_tmpname,"upload/$in_receipt_name");
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