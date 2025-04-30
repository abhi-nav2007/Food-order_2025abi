<?php
if(!isset($_SESSION['user'])){

    $_SESSION['no-login-message'] ="<div class='error'>Please login to access the admin panel.</div>";
    header('location:'.SITEURL.'admin/Login.php');
}

?>