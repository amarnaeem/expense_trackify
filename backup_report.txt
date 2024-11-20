<?php include('include/top.php'); ?>
<link href="css/layout.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include('include/sidebar.php'); ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column ">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include('include/topbar.php'); ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid" style="min-height: 100%;">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Report</h1>
                        <button onclick="window.print()" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</button>
                    </div>
                    <br>

                    <!-- form  -->
                    <form class="form-inline" style="display: flex; gap: 15px" method="post">
                        <div style="display: flex; gap: 3px">
                        <label>Month</label>
                        <select class="form-control" name="month">
                            <option value="01">January
                            <option>
                            <option value="02">Faburary
                            <option>
                            <option value="03">March
                            <option>
                            <option value="04">April
                            <option>
                            <option value="05">May
                            <option>
                            <option value="06">June
                            <option>
                            <option value="07">July
                            <option>
                            <option value="08">Auguest
                            <option>
                            <option value="09">September
                            <option>
                            <option value="10">October
                            <option>
                            <option value="11">November
                            <option>
                            <option value="12">December
                            <option>
                        </select>
                        </div>
                        <div style="display: flex; gap: 3px">
                        <label>Year</label>
                        <select class="form-control" name="year">

                            <option value="24">2024
                            <option>
                            <option value="23">2023
                            <option>
                            <option value="22">2022
                            <option>
                            <option value="21">2021
                            <option>
                            <option value="20">2020
                            <option>
                            <option value="19">2019
                            <option>
                            <option value="18">2018
                            <option>
                            <option value="17">2017
                            <option>
                            <option value="16">2016
                            <option>
                            <option value="15">2015
                            <option>
                            <option value="14">2014
                            <option>
                            <option value="13">2013
                            <option>
                            <option value="12">2012
                            <option>
                            <option value="11">2011
                            <option>
                            <option value="10">2010
                            <option>
                        </select>
                        </div>

                        <input type="submit" name="submit" class="btn btn-primary" value="Generate Report" />
                    </form>
                    <br>

                    <?php
                    include('include/connectbd.php');

                    if (isset($_POST['submit'])) {
                        $month = $_POST['month'];
                        $year = $_POST['year'];


                    ?>





                        <!-- panel -->
                        <div class="row">

                            <?php include('include/report_panel.php'); ?>
                        </div>

                        <!-- Content section -->

                        <?php include('include/report_expense_section.php'); ?>


                        <!-- table to show montly expense and income -->


                        <?php include('include/report_tables.php'); ?>
                    

                        <!--tables end-->

                        <!-- Footer -->
                        <!-- End of Footer -->
                        
                    <?php } ?>
                    <!-- End of Main Content -->

                    

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
        </div>
    </div>
 