<?php
session_start(); // Start the session

include 'C:/xampp/htdocs/food-order/admin/config/constants.php'; // Include your constants file

// Ensure the database connection
$conn = mysqli_connect('localhost', 'root', 'root', 'a'); // Replace with your actual constants
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if ID is set in the URL and is a valid integer
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']); // Convert to integer to prevent SQL injection

    // First, retrieve the image name from the database
    $sql = "SELECT image_name FROM tbl_category WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $image_name);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    // Check if an image name was retrieved
    if ($image_name) {
        // Define the path to the image
        $image_path = 'C:/xampp/htdocs/food-order/images/category/' . $image_name;

        // Delete the image file from the server
        if (file_exists($image_path)) {
            unlink($image_path); // Delete the file
        }
    }

    // Prepare the SQL query to delete the category
    $sql = "DELETE FROM tbl_category WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    $res = mysqli_stmt_execute($stmt);

    // Check if the query was successful
    if ($res) {
        $_SESSION['delete'] = "<div class='success'>Category and image deleted successfully.</div>";
    } else {
        $_SESSION['delete'] = "<div class='error'>Failed to delete category. Error: " . mysqli_error($conn) . "</div>"; // Show error message
    }

    // Close the statement
    mysqli_stmt_close($stmt);
} else {
    $_SESSION['delete'] = "<div class='error'>Category ID not provided or invalid.</div>";
}

// Redirect to the manage category page
header('location:' . SITEURL . 'admin/manage-category.php');
exit(); // Always use exit after header redirection
?>