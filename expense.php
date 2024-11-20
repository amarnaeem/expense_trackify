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
                    <h1 class="h3 mb-4 text-gray-800">Expense</h1>
                    <div class="row">
                        <div class="col">

                            <!-- DataTales Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Expense record from Database</h6>
                                </div>

                                <?php
                                include('include/connectbd.php');

                                if (isset($_GET['del'])) {
                                    $del_id = $_GET['del'];

                                    $del_qry = "DELETE FROM expense WHERE expense_id='$del_id'";
                                    $del_runqry = mysqli_query($conn, $del_qry);

                                    if ($del_runqry) {
                                        echo "<div class='alert alert-success'>Record deleted successfully</div>";
                                    } else {
                                        echo "<div class='alert alert-danger'>Error in deletion</div>";
                                    }
                                }
                                ?>

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Amount</th>
                                                    <th>Category</th>
                                                    <th>Detail</th>
                                                    <th>Receipt</th>
                                                    <th>Date</th>
                                                    <th>Delete</th>
                                                    <th>Update</th>
                                                </tr>
                                            </thead>
                                            <!-- <tfoot>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Amount</th>
                                                    <th>Category</th>
                                                    <th>Detail</th>
                                                    <th>Receipt</th>
                                                    <th>Date</th>
                                                    <th>Delete</th>
                                                    <th>Update</th>
                                                </tr>
                                            </tfoot> -->
                                            <tbody>
                                                <?php
                                                $select_expense = "SELECT * FROM expense WHERE user_id = '$db_user_id' OR user_id IS NULL";
                                                $run_qry = mysqli_query($conn, $select_expense);

                                                while ($expense_array = mysqli_fetch_array($run_qry)) {
                                                    $exp_id = $expense_array['0'];
                                                    $exp_amount = $expense_array['1'];
                                                    $cat_id = $expense_array['2'];
                                                    $exp_detail = $expense_array['3'];
                                                    $exp_receipt = $expense_array['4'];
                                                    $exp_date = $expense_array['5'];

                                                    // Fetch category name
                                                    $select_cat = "SELECT category_name FROM category WHERE category_id = '$cat_id'";
                                                    $selrun_qry = mysqli_query($conn, $select_cat);
                                                    $cate_name = (mysqli_num_rows($selrun_qry) > 0) ? mysqli_fetch_assoc($selrun_qry)['category_name'] : 'Unknown';

                                                    echo "
                                                        <tr>
                                                            <td>{$exp_id}</td>
                                                            <td>" . ucfirst($exp_amount) . "</td>
                                                            <td>" . ucfirst($cate_name) . "</td>
                                                            <td>" . ucfirst($exp_detail) . "</td>
                                                            <td class='text-center'>";
                                                    if (empty($exp_receipt) || !file_exists("upload/$exp_receipt")) {
                                                        echo "No Image";
                                                    } else {
                                                        echo "<img src='upload/$exp_receipt' height='60px'>";
                                                    }
                                                    echo "</td>
                                                            <td>" . ucfirst($exp_date) . "</td>
                                                            <td>
                                                                <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#myModal{$exp_id}'>Delete</button>
                                                                <div class='modal' id='myModal{$exp_id}'>
                                                                    <div class='modal-dialog'>
                                                                        <div class='modal-content'>
                                                                            <div class='modal-header'>
                                                                                <h4 class='modal-title'>Delete Record</h4>
                                                                                <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                                                            </div>
                                                                            <div class='modal-body'>Are you sure...?</div>
                                                                            <div class='modal-footer'>
                                                                                <a href='expense.php?del={$exp_id}' class='btn btn-danger'>Delete</a>
                                                                                <button type='button' class='btn btn-success' data-dismiss='modal'>Close</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td><a href='edit_expense.php?editexp={$exp_id}' class='btn btn-success'>Update</a></td>
                                                        </tr>";
                                                }
                                                ?>
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

    <!-- Logout Modal -->
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

    <!-- All CDNs -->
    <?php include('include/end.php') ?>
