<div class="row p-4">

<!-- monthly table expense  -->
<div class="col-xl-1 col-lg-1"></div>
<div class="col-xl-10 col-lg-10">
<div class="card shadow mb-4">
  
  <div
      class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary">Expense </h6>

     

  </div>
  <!-- Card Body -->
  <div class="card-body">

  <div class="table-responsive">
                          <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                              <thead>
                                  <tr>
                                      
                                      <th>AMOUNT</th>
                                      <th>CATEGORY</th>
                                      <th>DETAIL</th>
                                       <th>DATE</th>
                                     
                                  </tr>
                              </thead>
                              <tfoot>
                                  <tr>
                                  
                                      <th>AMOUNT</th>
                                      <th>CATEGORY</th>
                                      <th>DETAIL</th>
                                      <th>DATE</th>
                                     
                              
                                  </tr>
                              </tfoot>

                              <tbody>
                                  <?php

                                  include('include/connectbd.php');
                                  $select_expense="select * from expense  where expense_month='$month' and expense_year='$year' and user_id='$db_user_id'";
                                  $run_qry=mysqli_query($conn,$select_expense);

                                 while( $expense_array=mysqli_fetch_array($run_qry))
                                 {

                                  $exp_id=$expense_array['0'];
                                  $exp_amount=$expense_array['1'];
                                  $cat_id=$expense_array['2'];
                                  $exp_detail=$expense_array['3'];
                                  $exp_receipt=$expense_array['4'];
                                  $exp_date=$expense_array['5'];
                                  $exp_month=$expense_array['6'];
                                  $exp_year=$expense_array['7'];

                                  //select cat_name from cat table on basis of their id
                                  $select_cat="select * from category where category_id='$cat_id'";
                                  $selrun_qry=mysqli_query($conn,$select_cat);
                                  $select_ary=mysqli_fetch_array($selrun_qry);
                                  $cate_name=$select_ary['category_name'];
                                
                                  
                                  ?>

                              <tr>
                                      
                                      <td><?php echo ucfirst( $exp_amount); ?></td>
                                      <td><?php echo ucfirst($cate_name); ?></td>
                                      <td><?php echo ucfirst( $exp_detail); ?></td>
                                      
                                      <td><?php echo ucfirst( $exp_date); ?></td>
                                      
                               
                                  </tr>
                                  <?php }  ?>
                             
                              </tbody>
                          </table>
                      </div>


 
  </div>
</div>
</div>

                         

</div>

                                   <!-- monthly table income  -->
<div class="row p-4 ">



<div class="col-xl-1 col-lg-1"></div>
<div class="col-xl-10 col-lg-10">
<div class="card shadow mb-4 ">
  <!-- Card Header - Dropdown -->
  <div
      class="card-header py-3 d-flex flex-row align-items-center  justify-content-between" >
      <h6 class="m-0 font-weight-bold text-primary " >income</h6>
      
  </div>
  <!-- Card Body -->
  <div class="card-body">
  <div class="table-responsive">
                          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                              <thead>
                                  <tr>
                                     
                                      <th>AMOUNT</th>
                                      <th>CATEGORY</th>
                                      <th>DETAIL</th>
                                      
                                      <th>DATE</th>
                                     
                                     
                                  </tr>
                              </thead>
                              <tfoot>
                                  <tr>
                                 
                                      <th>AMOUNT</th>
                                      <th>CATEGORY</th>
                                      <th>DETAIL</th>
                                     
                                      <th>DATE</th>
                                      
                              
                                  </tr>
                              </tfoot>

                              <tbody>
                                  <?php

                                  include('include/connectbd.php');
                                  $select_income="select * from income where income_month='$month' and income_year='$year' and user_id='$db_user_id'";
                                  $run_qry=mysqli_query($conn,$select_income);

                                 while( $income_array=mysqli_fetch_array($run_qry))
                                 {

                                  $incm_id=$income_array['income_id'];
                                  $incm_amount=$income_array['income_amount'];
                                  $cat_id=$income_array['category_id'];
                                  $incm_detail=$income_array['income_details'];
                                  $incm_receipt=$income_array['income_receipt'];
                                  $incm_date=$income_array['income_date'];
                                  $incm_month=$income_array['income_month'];
                                  $incm_year=$income_array['income_year'];

                                  //select cat_name from cat table on basis of their id
                                  $select_cat="select * from category where category_id='$cat_id'";
                                  $selrun_qry=mysqli_query($conn,$select_cat);
                                  $select_ary=mysqli_fetch_array($selrun_qry);
                                  $cat_name=$select_ary['1'];

                                  ?>

                              <tr>
                                     
                                      <td><?php echo ucfirst( $incm_amount); ?></td>
                                      <td><?php echo ucfirst($cat_name); ?></td>
                                      <td><?php echo ucfirst( $incm_detail); ?></td>
                                     
                                      <td><?php echo ucfirst( $incm_date); ?></td>
                                      
           

                                       

                              
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
