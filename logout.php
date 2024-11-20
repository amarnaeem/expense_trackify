<?php
include('include/connectbd.php');
session_start();

// Destroy the session first
session_destroy();

// Then redirect the user to the login page
echo "<script>window.open('login.php','_self')</script>";
?>
