<?php

session_start(); // Start the session
if (!defined('SITEURL')) {

    define('SITEURL', 'http://localhost/food-order/'); // Replace with your actual site URL

}
if (!isset($_SESSION['user'])) {
    $_SESSION['no-login-message'] = "<div class='error'>Please login to access the admin panel.</div>";
    header('location:'.SITEURL.'admin/Login.php'); // Redirect to login page
    exit(); // Always exit after a header redirect
}

// Include the menu
include('partials/menu.php'); // Include your menu file
?>

<!-- Main content section starts -->
<div class="main-content">
    <div class="warpper">
        <h1>DASHBOARD</h1><br><br>

        <?php
        if (isset($_SESSION['submit'])) {
            echo $_SESSION['submit'];
            unset($_SESSION['submit']);
        }

        if (isset($_SESSION['login_success'])) {
            echo "<div class='success'>" . $_SESSION['login_success'] . "</div>"; // Display success message
            unset($_SESSION['login_success']); // Unset the message after displaying it
        }
        if (isset($_SESSION['login_error'])) {
            echo $_SESSION['login_error'];
            unset($_SESSION['login_error']); // Unset the error message after displaying it
        }
        ?>
        <br><br>

        <div class="col-4 text-center ">
            <h1>5</h1>
            <br>
            Categories
        </div>

        <div class="col-4 text-center ">
            <h1>5</h1>
            <br>
            Categories
        </div>

        <div class="col-4 text-center ">
            <h1>5</h1>
            <br>
            Categories
        </div>

        <div class="col-4 text-center ">
            <h1>5</h1>
            <br>
            Categories
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!-- Main content section Ends -->

<!-- Footer section Starts -->
<?php include('partials/footer.php'); ?> 