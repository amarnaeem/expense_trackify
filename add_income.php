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
                    <h1 class="h3 mb-4 text-gray-800">Add Income</h1>

                    <div class="row">
                        <div class="col">
                       
                    <form action="" method="post" enctype="multipart/form-data"> 

                    <div class="form-group">
                        <label>Amount</label>
                        <input type="number" class="form-control" name="amount">
                    </div>

                    <div class="row">
                        <div class="col-md-6">

                        <div class="form-group">
                        <label>category</label>
                        <select class="form-control" name="category_id" required>
                            <option disabled selected>select category</option>
                           <?php
                           include('include/connectbd.php');
                           $select_cat="select * from category where category_purpose = 'income'  AND (user_id = '$db_user_id' OR user_id IS NULL)";
                           $run_qry = mysqli_query($conn,$select_cat);

                        while($get_ary=mysqli_fetch_array($run_qry))
                        {

                           $category_id= $get_ary[0];
                           $category_name= $get_ary[1];

                           ?>


                            <option value="<?php echo $category_id; ?>"><?php echo $category_name; ?></option>
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

                    
                            <div class="form-group">
                                <label>Date</label>
                                <input type="date" class="form-control" name="income_date">
                                </div>

                                <div class="form-group">
                                <label>Details</label>
                                <textarea class="form-control" name="income_details"></textarea>
                                </div>

                                <div class="form-group">
                                
                                <input type="submit" value="Add Income" class=" btn btn-success btn-block " name="income_insert">
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
                        //   $year = date('y', strtotime($in_date)); 
                        //   $month = date('m', strtotime($in_date)); 
                          $in_receipt_name =$_FILES['income_receipt']['name'];
                          $in_receipt_tmpname =$_FILES['income_receipt']['tmp_name'];

                         $insert_qry ="insert into income(income_amount,category_id,income_details,income_receipt,income_date,income_month,income_year,user_id) 
                          values('$in_amount',' $in_id','$in_details','$in_receipt_name','$in_date','$month','$year','$db_user_id')";

                          $runin_qry=mysqli_query($conn,$insert_qry);

                          if($runin_qry)
                          {
                              echo "<div class='alert alert-success'>data insert in DB successfull</div>";
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