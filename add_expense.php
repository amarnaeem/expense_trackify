<?php
include('include/top.php');
?>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include('include/sidebar.php')?>

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
                    <h1 class="h3 mb-4 text-gray-800">Add Expense</h1>

                    <div class="row">
                        <div class="col">
                            <form action="" method="post" enctype="multipart/form-data"> 

                                <div class="form-group">
                                    <label>Amount</label>
                                    <input type="number" class="form-control" name="ex_amount">
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Category</label>
                                            <select class="form-control" name="ex_category_id" required>
                                                <option disabled selected>select category</option>
                                                <?php
                                                include('include/connectbd.php');
                                                $select_cat = "select * from category where category_purpose = 'expense' AND (user_id = '$db_user_id' OR user_id IS NULL)";
                                                $run_qry = mysqli_query($conn, $select_cat);
                                                while ($get_ary = mysqli_fetch_array($run_qry)) {
                                                    $category_id = $get_ary[0];
                                                    $category_name = $get_ary[1];
                                                ?>
                                                    <option value="<?php echo $category_id; ?>"><?php echo $category_name; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Receipt</label>
                                            <input type="file" class="form-control" name="ex_receipt">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Date</label>
                                    <input type="date" class="form-control" name="ex_date">
                                </div>

                                <div class="form-group">
                                    <label>Details</label>
                                    <textarea class="form-control" name="ex_details"></textarea>
                                </div>

                                <div class="form-group">
                                    <input type="submit" value="Add Expense" class="btn btn-success btn-block" name="ex_insert">
                                </div>

                            </form>
                            <?php
                            include('include/connectbd.php');

                            if (isset($_POST['ex_insert'])) {
                                $exp_amount = $_POST['ex_amount'];
                                $exp_id = $_POST['ex_category_id'];
                                $exp_date = $_POST['ex_date'];
                                $exp_details = $_POST['ex_details'];
                                $exp_receipt_name = $_FILES['ex_receipt']['name'];
                                $exp_receipt_tmpname = $_FILES['ex_receipt']['tmp_name'];

                                $exp_year = Date('y');
                                $exp_month = Date('m');

                                // Extract year and month from the selected date
                                // $exp_year = date('y', strtotime($exp_date)); 
                                // $exp_month = date('m', strtotime($exp_date)); 

                                // Insert query
                                $insert_qry = "INSERT INTO expense (expense_amount, category_id, expense_details, expense_receipt, expense_date, expense_month, expense_year, user_id) 
                                                VALUES ('$exp_amount', '$exp_id', '$exp_details', '$exp_receipt_name', '$exp_date', '$exp_month', '$exp_year', '$db_user_id')";

                                $runin_qry = mysqli_query($conn, $insert_qry);

                                if ($runin_qry) {
                                    echo "<div class='alert alert-success'>Data inserted into DB successfully</div>";
                                    move_uploaded_file($exp_receipt_tmpname, "upload/$exp_receipt_name");
                                } else {
                                    echo "<div class='alert alert-danger'>Error occurred while inserting data</div>";
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
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
</body>

</html>
