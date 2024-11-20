<div class="row">

<!-- Area Chart -->
<div class="col-xl-8 col-lg-7">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div
            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Expense Breakdown</h6>

       <!--     <div class="dropdown no-arrow">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                    aria-labelledby="dropdownMenuLink">
                    <div class="dropdown-header">Dropdown Header:</div>
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </div>   -->
            
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="chart-area" style="height: auto;">
                
                <script>
                    window.onload = function() {
                        
                        var chart = new CanvasJS.Chart("chartContainer", {
                            theme: "light2", // "light1", "light2", "dark1", "dark2"
                            exportEnabled: true,
                            animationEnabled: true,
                            title: {
		text: ""
	},
	data: [{
		type: "pie",
		startAngle: 25,
		toolTipContent: "<b>{label}</b>: {y}%",
		showInLegend: "true",
		legendText: "{}",
		indexLabelFontSize: 16,
		indexLabel: "{label} - {y}%",
		dataPoints: [
            <?php

//select all categories
include('include/connectbd.php');
$select_category="select * from category where user_id='$db_user_id' OR user_id IS NULL";
$run_cat=mysqli_query($conn,$select_category);
while(  $ary_cat=mysqli_fetch_array( $run_cat))
{
    
    $cat_id=$ary_cat[0];
    $cat_name=$ary_cat[1];
    
    
    
    
    // calculate sum to find percenteges of each expense
    $select_total_expense="select sum(expense_amount) from expense where expense_month='$month' and expense_year='$year' and user_id='$db_user_id'";
    // $select_total_expense = "SELECT SUM(expense_amount) FROM expense WHERE $query_condition AND user_id='$db_user_id'";
    $run_sum=mysqli_query($conn,$select_total_expense) ;
    $ary_sum=mysqli_fetch_array($run_sum);
    $total_sumof_expamount=$ary_sum['sum(expense_amount)'];
    
    
    
    
    
    
    //select only expenses from all category
    
    $select_expense="select * from expense where category_id='$cat_id' and expense_month='$month' and expense_year='$year' and user_id='$db_user_id'";
    // $select_expense = "SELECT * FROM expense WHERE category_id='$cat_id' AND $query_condition AND user_id='$db_user_id'";
    $run_expense=mysqli_query($conn,$select_expense);
    while($ary_expense=mysqli_fetch_array($run_expense))
    {
                $expense_id=$ary_expense[0];
                $expense_amount=$ary_expense[1];
                
                //calculate percentage
               $percentege= $expense_amount*100/ $total_sumof_expamount;
               
               //number format round decimal point up to 2 digits
              $round_percentege= number_format($percentege,2);

              
              
              ?>


			{ y: <?php echo $round_percentege; ?>, label: "<?php echo $cat_name; ?>" },

            <?php } }?>
		
		]
	}]
});
chart.render();

}
</script>




            <div id="chartContainer" style="height: 300px; width: 100%;"></div>
            <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
            </div>
        </div>
    </div>
</div>



                                            <!-- Pie Chart -->

<div class="col-xl-4 col-lg-5">
    <div class="card shadow mb-4 pre-scrollable">
        <!-- Card Header - Dropdown -->
        <div
            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Budget</h6>

       <!--     <div class="dropdown no-arrow">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                    aria-labelledby="dropdownMenuLink">
                    <div class="dropdown-header">Dropdown Header:</div>
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </div>   -->
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <?php

            //select category
            include('include/connectbd.php');
            $select_category="select * from category where category_purpose='expense'";
            $run_category=mysqli_query($conn,$select_category);
           while( $ary_cat=mysqli_fetch_array($run_category))
           {

            $cat_id=$ary_cat[0];
            $cat_name=$ary_cat[1];

            // select total expense/spent
            $select_total_expense="select SUM(expense_amount) from expense where expense_month='$month' and expense_year='$year'  
            and category_id='$cat_id' and user_id='$db_user_id'";
            $run_total_expense=mysqli_query($conn,$select_total_expense);
            $ary_total_expense=mysqli_fetch_array($run_total_expense);

            $total_exp=$ary_total_expense['SUM(expense_amount)'];

            //select budget
            $select_budget="select sum(budget_amount) from budget where category_id='$cat_id' and user_id='$db_user_id'";
            $run_budget=mysqli_query($conn,$select_budget);
            $ary_budget=mysqli_fetch_array($run_budget);

             $total_budget=$ary_budget['sum(budget_amount)'];

             // condition to not show bar for whicj budget is not set
             if($total_budget>0 && $total_exp>0)
             {
                $percentage=$total_exp/$total_budget * 100;
                 $roundpercentage=number_format($percentage,1);

            ?>




            <h4 class="small font-weight-bold"><?php echo $cat_name ?> <span
                    class="float-right">
                    <span class="text-success">spent:<?php echo $total_exp;?> |</span>
                    <span class="text-danger">Budget:<?php echo $total_budget;?></span>
                
                </span></h4>
            <div class="progress mb-4">
                <div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo $roundpercentage;?>%"
                    aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">

<?php 
if($roundpercentage > 100)
{
    echo "Out of budget";
}
else
{
    echo $roundpercentage . "%" ;
}
?>

            
                </div>
            </div>
            <?php } }?>
            
        </div>
    </div>
</div>
</div>



</div>
<!-- /.container-fluid -->

</div>