<?php
if (!defined('SITEURL')) {

    define('SITEURL', 'http://localhost/food-order/'); // Replace with your actual site URL

}



$servername = "localhost"; // Usually localhost
$username = "root"; // Default username for XAMPP/WAMP
$password = "root"; // Default password is usually empty for XAMPP/WAMP
$dbname = "a"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "";
?>