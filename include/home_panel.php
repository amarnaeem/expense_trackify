<?php
include('include/connectbd.php');

// calcultae sum of income from income table 

 $current_date=Date('m');
$select_income = "select sum(income_amount) from income where income_month='$current_date' AND (user_id='$db_user_id' OR user_id IS NULL)";
$run_qry=mysqli_query($conn,$select_income);
$ary_income=mysqli_fetch_array($run_qry);
 $total_income=$ary_income['sum(income_amount)'] ?? 0;


 // calcultae sum of expense from expense table 

 //echo $full_date=$_SESSION['add_exp_date'];
  $cur_date_in_single_dig=Date('n');
$select_expense = "select sum(expense_amount) from expense where expense_month='$cur_date_in_single_dig' AND (user_id='$db_user_id' OR user_id IS NULL)";
$run_qry=mysqli_query($conn,$select_expense);
$ary_expense=mysqli_fetch_array($run_qry);
 $total_expense=$ary_expense['sum(expense_amount)'] ?? 0;

 $total_balance= $total_income-$total_expense;

?>




<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-4 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                        Earnings (Monthly)</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">Rs.<?php echo $total_income;?></div>
                </div>
                <div class="col-auto">
                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-4 col-md-6 mb-4">
    <div class="card border-left-danger shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                        Expense (Montly)</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">Rs.<?php echo $total_expense?></div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-4 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Balance
                    </div>
                    <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">Rs.<?php echo $total_balance?></div>
                        </div>
                       
                    </div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>

