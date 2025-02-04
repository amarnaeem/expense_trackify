 <!-- Sidebar -->
 <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion " id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
    <div class="sidebar-brand-icon rotate-n-15">
    <i class="fas fa-chart-pie"></i>
    </div>
    <div class="sidebar-brand-text mx-3">Trackify <sup>APP</sup></div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
    <a class="nav-link" href="index.php">
    <i class="fa-solid fa-gauge"></i>
   
        <span>Dashboard</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Interface
</div>

<?php if($_SESSION['ROLE'] =='Admin'){ ?>
<!-- Nav Add user - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwooo"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fa-solid fa-users"></i>
        <span>Users</span>
    </a>
    <div id="collapseTwooo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            
            <a class="collapse-item" href="add_user.php">Add User</a>
            <a class="collapse-item" href="users.php">View Users</a>
        </div>
    </div>
</li>
      <?php } ?>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fa-solid fa-money-bill-1-wave"></i>
        <span>Income</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            
            <a class="collapse-item" href="add_income.php">Add Income</a>
            <a class="collapse-item" href="income.php">View Income</a>
        </div>
    </div>
</li>

<!-- Nav Item - Utilities Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
        aria-expanded="true" aria-controls="collapseUtilities">
        <i class="fa-solid fa-money-bill-1-wave"></i>
        <span>Expense</span>
    </a>
    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            
            <a class="collapse-item" href="add_expense.php">Add Expense</a>
            <a class="collapse-item" href="expense.php">View Expense</a>
        </div>
    </div>
</li>

<!-- Divider 
<hr class="sidebar-divider">-->



<!-- Nav Item - category Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsecategory"
        aria-expanded="true" aria-controls="collapsecategory">
        <i class="fa-solid fa-list"></i>
        <span>Category</span>
    </a>
    <div id="collapsecategory" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            
            <a class="collapse-item" href="add_catagory.php">Add Category</a>
            <a class="collapse-item" href="category.php">View Category</a>
        </div>
    </div>
</li>

<!-- Nav Item - budget Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsebudget"
        aria-expanded="true" aria-controls="collapsebudget">
        <i class="fa-solid fa-wallet"></i>
        <span>Budget</span>
    </a>
    <div id="collapsebudget" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            
            <a class="collapse-item" href="add_budget.php">Add Budget</a>
            <a class="collapse-item" href="budget.php">View Budget</a>
        </div>
    </div>
</li>

<!-- Nav Item - Charts -->
<li class="nav-item">
    <a class="nav-link" href="report.php">
    <i class="fa-solid fa-file-waveform"></i>
        <span>Reports</span></a>
</li>





</ul>
<!-- End of Sidebar -->