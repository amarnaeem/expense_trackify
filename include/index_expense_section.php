<div class="row">

<!-- Area Chart -->
<div class="col-xl-8 col-lg-7">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Expense Breakdown</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="chart-area" style="height: auto;">
                <script>
                    window.onload = function() {
                        var chart = new CanvasJS.Chart("chartContainer", {
                            theme: "light2",
                            exportEnabled: true,
                            animationEnabled: true,
                            title: { text: "" },
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
                                    // Track if data is available
                                    $data_available = false;
                                    $data_points = [];

                                    // Select all categories
                                    include('include/connectbd.php');
                                    $select_category = "select * from category";
                                    $run_cat = mysqli_query($conn, $select_category);
                                    while ($ary_cat = mysqli_fetch_array($run_cat)) {
                                        $cat_id = $ary_cat[0];
                                        $cat_name = $ary_cat[1];
                                        $current_month = date('m');

                                        // Calculate total expense sum
                                        $select_total_expense = "select sum(expense_amount) from expense where expense_month='$current_month' and user_id='$db_user_id'";
                                        $run_sum = mysqli_query($conn, $select_total_expense);
                                        $ary_sum = mysqli_fetch_array($run_sum);
                                        $total_sumof_expamount = $ary_sum['sum(expense_amount)'];

                                        // Select expenses from all categories
                                        $select_expense = "select * from expense where category_id='$cat_id' AND expense_month='$current_month' and user_id='$db_user_id'";
                                        $run_expense = mysqli_query($conn, $select_expense);
                                        while ($ary_expense = mysqli_fetch_array($run_expense)) {
                                            $expense_amount = $ary_expense[1];

                                            // Calculate percentage
                                            $percentage = $expense_amount * 100 / $total_sumof_expamount;
                                            $round_percentage = number_format($percentage, 2);
                                            
                                            // Data points to chart
                                            $data_points[] = "{ y: $round_percentage, label: '$cat_name' }";
                                            $data_available = true;
                                        }
                                    }
                                    
                                    echo implode(", ", $data_points);
                                    ?>
                                ]
                            }]
                        });

                        chart.render();
                    }
                </script>

                <!-- Conditionally display chart or message -->
                <?php if ($data_available): ?>
                    <div id="chartContainer" style="height: 300px; width: 100%;"></div>
                <?php else: ?>
                    <p class="text-muted d-flex justify-content-center align-items-center" style="height: 200px">No Expense Data Available</p>
                <?php endif; ?>
                <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
            </div>
        </div>
    </div>
</div>

<!-- Pie Chart - Budget Section -->
<div class="col-xl-4 col-lg-5">
    <div class="card shadow mb-4 pre-scrollable">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Budget</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <?php
            // Track if budget data is available
            $budget_data_available = false;

            // Select category
            include('include/connectbd.php');
            $select_category = "select * from category where category_purpose='expense'";
            $run_category = mysqli_query($conn, $select_category);
            while ($ary_cat = mysqli_fetch_array($run_category)) {
                $cat_id = $ary_cat[0];
                $cat_name = $ary_cat[1];

                // Select total expense/spent
                $select_total_expense = "select SUM(expense_amount) from expense where expense_month='$current_month' and category_id='$cat_id' and user_id='$db_user_id'";
                $run_total_expense = mysqli_query($conn, $select_total_expense);
                $ary_total_expense = mysqli_fetch_array($run_total_expense);

                $total_exp = $ary_total_expense['SUM(expense_amount)'];

                // Select budget
                $select_budget = "select sum(budget_amount) from budget where category_id='$cat_id' and user_id='$db_user_id'";
                $run_budget = mysqli_query($conn, $select_budget);
                $ary_budget = mysqli_fetch_array($run_budget);

                $total_budget = $ary_budget['sum(budget_amount)'];

                // Only show bar if budget is set and has expenses
                if ($total_budget > 0) {
                    $budget_data_available = true;
                    $percentage = $total_exp / $total_budget * 100;
                    $round_percentage = number_format($percentage, 1);
            ?>

                    <h4 class="small font-weight-bold"><?php echo $cat_name; ?> 
                        <span class="float-right">
                            <span class="text-success">spent: <?php echo $total_exp; ?> |</span>
                            <span class="text-danger">Budget: <?php echo $total_budget; ?></span>
                        </span>
                    </h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo $round_percentage; ?>%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                            <?php 
                            if ($round_percentage > 100) {
                                echo "Out of budget";
                            } else {
                                echo $round_percentage . "%";
                            }
                            ?>
                        </div>
                    </div>
            <?php 
                }
            }

            // Display message if no budget data is available
            if (!$budget_data_available) {
                echo "<p class='text-muted d-flex justify-content-center align-items-center' style='height: 200px'>No Budget Data Available</p>";
            }
            ?>
        </div>
    </div>
</div>
</div>
