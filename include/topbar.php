<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

<!-- Sidebar Toggle (Topbar) -->
<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
    <i class="fa fa-bars"></i>
</button>


<!-- Topbar Navbar -->
<ul class="navbar-nav ml-auto">

    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
    <li class="nav-item dropdown no-arrow d-sm-none">
        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-search fa-fw"></i>
        </a>
        <!-- Dropdown - Messages -->
        <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
            aria-labelledby="searchDropdown">
            <form class="form-inline mr-auto w-100 navbar-search">
                <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small"
                        placeholder="Search for..." aria-label="Search"
                        aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </li>

  <!-- -----------notification-------- -->

  <!-- Nav Item - Alerts -->
<li class="nav-item dropdown no-arrow mx-1 position-relativ">
    <a class="nav-link dropdown-toggle position-relative" href="#" id="alertsDropdown" role="button"
        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-bell fa-fw"></i>
        <!-- Counter - Alerts -->
        <?php
        // Calculate the number of alerts
        $alert_count = 0;

        $select_category = "select * from category where category_purpose='expense'";
        $run_category = mysqli_query($conn, $select_category);

        while ($ary_cat = mysqli_fetch_array($run_category)) {
            $cat_id = $ary_cat[0];
            $current_month = date('m');
            $current_year = date('y');

            $select_total_expense = "select SUM(expense_amount) from expense 
                where expense_month='$current_month' 
                and expense_year='$current_year'  
                and category_id='$cat_id' 
                and user_id='$db_user_id'";
            $run_total_expense = mysqli_query($conn, $select_total_expense);
            $ary_total_expense = mysqli_fetch_array($run_total_expense);
            $total_exp = $ary_total_expense['SUM(expense_amount)'];

            $select_budget = "select sum(budget_amount) from budget 
                where category_id='$cat_id' 
                and user_id='$db_user_id'";
            $run_budget = mysqli_query($conn, $select_budget);
            $ary_budget = mysqli_fetch_array($run_budget);
            $total_budget = $ary_budget['sum(budget_amount)'];

            if ($total_budget > 0 && $total_exp > 0) {
                $percentage = $total_exp / $total_budget * 100;
                if ($percentage > 100) {
                    $alert_count++;
                }
            }
        }

        // Only show the badge if there are notifications
        if ($alert_count > 0) {
            echo '<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="margin-left: 16px; margin-top: -20px; z-index: 1">' . $alert_count . '
                  </span>';
        }
        
        ?>
    </a>
    <!-- Dropdown - Alerts -->
    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
        aria-labelledby="alertsDropdown">
        <h6 class="dropdown-header">
            Alerts Center
        </h6>

        <?php
        // Initialize a flag to check if any notifications exist
        $has_notifications = false;

        $run_category = mysqli_query($conn, $select_category);

        while ($ary_cat = mysqli_fetch_array($run_category)) {
            $cat_id = $ary_cat[0];
            $cat_name = $ary_cat[1];

            $select_total_expense = "select SUM(expense_amount) from expense 
                where expense_month='$current_month' 
                and expense_year='$current_year'  
                and category_id='$cat_id' 
                and user_id='$db_user_id'";
            $run_total_expense = mysqli_query($conn, $select_total_expense);
            $ary_total_expense = mysqli_fetch_array($run_total_expense);
            $total_exp = $ary_total_expense['SUM(expense_amount)'];

            $select_budget = "select sum(budget_amount) from budget 
                where category_id='$cat_id' 
                and user_id='$db_user_id'";
            $run_budget = mysqli_query($conn, $select_budget);
            $ary_budget = mysqli_fetch_array($run_budget);
            $total_budget = $ary_budget['sum(budget_amount)'];

            if ($total_budget > 0 && $total_exp > 0) {
                $percentage = $total_exp / $total_budget * 100;
                if ($percentage > 100) {
                    $has_notifications = true;
                    ?>
                    <a class="dropdown-item d-flex align-items-center" href="#">
                        <div class="mr-3">
                            <div class="icon-circle bg-primary">
                                <i class="fas fa-file-alt text-white"></i>
                            </div>
                        </div>
                        <div>
                            <span class="font-weight-bold">Alert: You are out of Budget in <b><?php echo $cat_name; ?></b></span>
                        </div>
                    </a>
                    <?php
                }
            }
        }

        // If no notifications, show "No notifications" message
        if (!$has_notifications) {
            echo '<a class="dropdown-item text-center" href="#">No notifications</a>';
        }
        ?>
    </div>
</li>

  <!-- -----------notification-------- -->



    <div class="topbar-divider d-none d-sm-block"></div>

    <!-- Nav Item - User Information -->
    <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $db_user_name ?></span>
            <img class="img-profile rounded-circle"
                src="upload/<?php echo $db_user_pic?>">
        </a>
        <!-- Dropdown - User Information -->
        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
            aria-labelledby="userDropdown">
            <a class="dropdown-item" href="profile.php">
                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                Profile
            </a>
            <a class="dropdown-item" href="profile.php">
                <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                Settings
            </a>
           
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                Logout
            </a>
        </div>
    </li>

</ul>

</nav>