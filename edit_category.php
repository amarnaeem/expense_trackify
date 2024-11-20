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
                    <h1 class="h3 mb-4 text-gray-800">Edit Category</h1>

                    <?php
                    // query for update button
                    include('include/connectbd.php');

if(isset($_GET['edit']))
{
     $update_id=$_GET['edit'];
   $select_qry="select * from category where category_id='$update_id'";
   $run_qry=mysqli_query($conn,$select_qry);
   $get_ary=mysqli_fetch_array($run_qry);

   echo $cat_name=$get_ary['1'];
   echo $cat_purpose=$get_ary['2'];

}


?>


                <div class="row">
                    <div class="col">
                        <form action="" method="post">

                            <div class="form-group">
                                <label>Category Name</label>
                                <input type="text" name="category_name" value="<?php echo $cat_name;?>" class="form-control" />
                            </div>

                            <div class="form-group">
                                <label>Category purpose</label>
                                <select class="form-control" name="category_purpose">
                                    <option selected value="<?php echo $cat_purpose;?>"><?php echo $cat_purpose;?></option>
                                    <option value="income">income</option>
                                    <option value="expense">expense</option>
                                </select>
                            </div>

                            <div class="form-group">
                                
                                <input type="submit" name="insert_btn" value="Edit Category" class="btn btn-success" />
                            </div>

                        </form>

                        <?php include('include/connectbd.php')  ?>
                        <?php

                        if(isset($_POST['insert_btn']))
                        {
                            $ecategory_name = $_POST['category_name'];
                            $ecategory_purpose = $_POST['category_purpose'];

                            $select_qry="select * from category where category_name='$ecategory_name'
                             & category_purpose='$ecategory_purpose'";
                            $ren_qry = mysqli_query($conn,$select_qry);

                            if(mysqli_num_rows($ren_qry)>0)
                            {
                                echo "<div class='alert alert-danger'> data already exist</div>";
                            }
                            else{

                                $update_qry="update category set category_name='$ecategory_name', category_purpose='$ecategory_purpose'
                                where category_id='$update_id'";
                             $run_query =mysqli_query($conn,$update_qry);

                             if($run_query)
                             {
                             //echo "<div class='alert alert-success'>data updated in db succesfully</div>";
                             echo "<script>window.open('category.php','_self')</script>";
                             }
                             else
                             {
                             echo "<div class='alert alert-danger'>data not updated</div>";
                             }

                            
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
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- all cdns-->

    <?php include('include/end.php') ?>