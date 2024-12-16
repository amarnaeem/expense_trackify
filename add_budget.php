<?php include('include/top.php') ?>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->

        <?php include('include/sidebar.php') ?>

        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->

                <?php include('include/topbar.php') ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Add Budget</h1>

                    <div class="row">
                        <div class="col">

                            <form action="" method="post" enctype="multipart/form-data">

                                <div class="form-group">
                                    <label>Amount</label>
                                    <input type="number" class="form-control" name="budget_amount">
                                </div>

                                <div class="row">
                                    <div class="col">

                                        <div class="form-group">
                                            <label>category</label>
                                            <select class="form-control" name="ex_category_id" required>
                                                <option disabled selected>select category</option>
                                                <?php
                                                include('include/connectbd.php');

                                                // Ensure that $user_id is set correctly
                                                $user_id = $_SESSION['user_id'];  // Get user ID from the session

                                                $select_cat = "SELECT * FROM category WHERE category_purpose = 'expense' AND (user_id = '$user_id' OR user_id IS NULL)";
                                                $run_qry = mysqli_query($conn, $select_cat);

                                                // Check if any categories are returned
                                                if (mysqli_num_rows($run_qry) > 0) {
                                                    // Fetch categories and display them in the select dropdown
                                                    while ($get_ary = mysqli_fetch_array($run_qry)) {
                                                        $category_id = $get_ary['category_id'];  // Assuming 'category_id' is the column name
                                                        $category_name = $get_ary['category_name'];  // Assuming 'category_name' is the column name
                                                ?>
                                                        <option value="<?php echo $category_id; ?>"><?php echo $category_name; ?></option>
                                                <?php
                                                    }
                                                } else {
                                                    echo "<option>No categories found</option>";
                                                }
                                                ?>

                                            </select>

                                        </div>



                                    </div>


                                </div>




                                <div class="form-group">

                                    <input type="submit" value="Add budget" class=" btn btn-success btn-block " name="budget_insert">
                                </div>




                            </form>
                            <?php
                            include('include/connectbd.php');

                            $user_id = $_SESSION['user_id'];


                            if (isset($_POST['budget_insert'])) {

                                $budget_amount = $_POST['budget_amount'];
                                $category_id = $_POST['ex_category_id'];
                                $budget_year = Date('y');
                                $budget_month = Date('m');



                                $insert_qry = "insert into budget(category_id,budget_amount,user_id, budget_month, budget_year) 
                          values('$category_id',' $budget_amount','$user_id', '$budget_month', '$budget_year')";

                                $runin_qry = mysqli_query($conn, $insert_qry);

                                if ($runin_qry) {
                                    echo "<div class='alert alert-success'>data inserted Successfull</div>";
                                } else {
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

            <?php include('include/footer.php') ?>
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