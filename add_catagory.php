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
                    <h1 class="h3 mb-4 text-gray-800">add_category</h1>


                <div class="row">
                    <div class="col">
                        <form action="" method="post">

                            <div class="form-group">
                                <label>Category Name</label>
                                <input type="text" name="category_name"  class="form-control" />
                            </div>

                            <div class="form-group">
                                <label>Category purpose</label>
                                <select class="form-control" name="category_purpose">
                                    <option value="income">income</option>
                                    <option value="expense">expense</option>
                                </select>
                            </div>

                            <div class="form-group">
                                
                                <input type="submit" name="insert_btn" value="Add Category" class="btn btn-success" />
                            </div>

                        </form>

                        <?php include('include/connectbd.php')  ?>
                        <?php
                        $user_id = $_SESSION['user_id'];

                        if(isset($_POST['insert_btn']))
                        {
                            $category_name = $_POST['category_name'];
                            $category_purpose = $_POST['category_purpose'];

                            $select_qry="select * from category where category_name='$category_name'";
                            $ren_qry = mysqli_query($conn,$select_qry);

                            if(mysqli_num_rows($ren_qry)>0)
                            {
                                echo "<div class='alert alert-danger'> data already exist</div>";
                            }
                            else{

                                $insert_qry="insert into category(category_name,category_purpose,  user_id) values('$category_name','$category_purpose', $user_id)";
                             $run_query =mysqli_query($conn,$insert_qry);

                             if($run_query)
                             echo "<div class='alert alert-success'>data insert in db succesfully</div>";
                             else
                             echo "<div class='alert alert-danger'>data not inserted</div>";

                            
                            }



                        
                           
                             /*
                             $insert_qry="insert into category(category_name,category_purpose) values('$category_name','$category_purpose')";
                             $run_qry =mysqli_query($conn,$insert_qry);

                             if($run_qry)
                             echo "<div class='alert alert-success'>data insert in db succesfully</div>";
                             else
                             echo "<div class='alert alert-danger'>data not inserted</div>"; */


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