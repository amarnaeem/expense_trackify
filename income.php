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
                    <h1 class="h3 mb-4 text-gray-800">Income</h1>
                    <div class="row">
                        <div class="col">


                            <!-- DataTales Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Income record from Database</h6>
                                </div>

                                <?php
                                include('include/connectbd.php');

                                if (isset($_GET['del'])) {
                                    $del_id = $_GET['del'];

                                    $del_qry = "delete from income where income_id='$del_id'";
                                    $del_runqry = mysqli_query($conn, $del_qry);

                                    if ($del_runqry) {
                                        echo "<div class='alert alert-success'> record deleted succesfully</div>";
                                    } else {
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
                                                    <th>AMOUNT</th>
                                                    <th>CATEGORY</th>
                                                    <th>DETAIL</th>
                                                    <th>RECEIPT</th>
                                                    <th>DATE</th>
                                                    <th>DELETE</th>
                                                    <th>UPDATE</th>

                                                </tr>
                                            </thead>
                                            <!-- <tfoot>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>AMOUNT</th>
                                                    <th>CATEGORY</th>
                                                    <th>DETAIL</th>
                                                    <th>RECEIPT</th>
                                                    <th>DATE</th>
                                                    <th>DELETE</th>
                                                    <th>UPDATE</th>

                                                </tr>
                                            </tfoot> -->

                                            <tbody>
                                                <?php

                                                include('include/connectbd.php');
                                                $select_income = "select * from income where user_id='$db_user_id'";
                                                $run_qry = mysqli_query($conn, $select_income);

                                                while ($income_array = mysqli_fetch_array($run_qry)) {

                                                    $incm_id = $income_array['income_id'];
                                                    $incm_amount = $income_array['income_amount'];
                                                    $cat_id = $income_array['category_id'];
                                                    $incm_detail = $income_array['income_details'];
                                                    $incm_receipt = $income_array['income_receipt'];
                                                    $incm_date = $income_array['income_date'];
                                                    $incm_month = $income_array['income_month'];
                                                    $incm_year = $income_array['income_year'];

                                                    //select cat_name from cat table on basis of their id
                                                    $select_cat = "select * from category where category_id='$cat_id'";
                                                    $selrun_qry = mysqli_query($conn, $select_cat);
                                                    $select_ary = mysqli_fetch_array($selrun_qry);
                                                    $cat_name = $select_ary['1'];
                                                ?>
                                                    <tr>
                                                        <td><?php echo $incm_id; ?></td>
                                                        <td><?php echo ucfirst($incm_amount); ?></td>
                                                        <td><?php echo ucfirst($cat_name); ?></td>
                                                        <td>
    <?php echo empty($incm_detail) ? '<div class="text-center">-</div>' : ucfirst($incm_detail); ?>
</td>

                                                        
                                                        <td class="text-center">
    <?php if (empty($incm_receipt) || !file_exists("upload/$incm_receipt")): ?>
        -
    <?php else: ?>
        <img src="upload/<?php echo $incm_receipt; ?>" alt="Income Receipt" height="60px">
    <?php endif; ?>
</td>


                                                        <td><?php echo ucfirst($incm_date); ?></td>

                                                        <td class="text-center">
                                                            <!-- Button to Open the Modal -->
                                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal<?php echo $incm_id; ?>">
                                                                delete
                                                            </button>

                                                            <!-- The Modal -->
                                                            <div class="modal" id="myModal<?php echo $incm_id; ?>">
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
                                                                            <a href="income.php?del=<?php echo $incm_id ?>" class="btn btn-danger">Delete</a>
                                                                            <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </td>
                                                        <!-- delete btn ends-->

                                                        <!-- update btn td start-->

                                                        <td class="text-center"><a href="edit_income.php?editinc=<?php echo  $incm_id; ?>" class="btn btn-success">Update</a></td>


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