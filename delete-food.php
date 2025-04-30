<?php
include('partials/menu.php');
include('config/constants.php');

// Check if the id is set
if (isset($_GET['id'])) {
    // Get the id
    $id = $_GET['id'];

    // SQL query to get the image name before deleting the food item
    $sql = "SELECT image_name FROM tbl_food WHERE id=$id";
    $res = mysqli_query($conn, $sql);

    if ($res == true) {
        // Check if the food item exists
        $count = mysqli_num_rows($res);
        if ($count == 1) {
            // Get the image name
            $row = mysqli_fetch_assoc($res);
            $image_name = $row['image_name'];

            // Delete the food item from the database
            $sql = "DELETE FROM tbl_food WHERE id=$id";
            $res = mysqli_query($conn, $sql);

            // Check if the query was successful
            if ($res == true) {
                // If image exists, delete it from the folder
                if ($image_name != "") {
                    $path = "C:/xampp/htdocs/food-order/images/food/" . $image_name; // Path to the image
                    $remove = unlink($path); // Delete the image file

                    // Check if the image was deleted
                    if ($remove == false) {
                        $_SESSION['delete'] = "<div class='error'>Failed to remove image file.</div>";
                    }
                }

                // Set a success message
                $_SESSION['delete'] = "<div class='success'>Food item deleted successfully.</div>";
                // Redirect to the manage food page
                header('location:' . SITEURL . 'admin/manage-food.php');
            } else {
                // Set an error message
                $_SESSION['delete'] = "<div class='error'>Failed to delete food item from database.</div>";
                // Redirect to the manage food page
                header('location:' . SITEURL . 'admin/manage-food.php');
            }
        } else {
            // If food item does not exist
            $_SESSION['delete'] = "<div class='error'>Food item not found.</div>";
            header('location:' . SITEURL . 'admin/manage-food.php');
        }
    } else {
        // If the query failed
        $_SESSION['delete'] = "<div class='error'>Failed to execute query.</div>";
        header('location:' . SITEURL . 'admin/manage-food.php');
    }
} else {
    // Redirect to the manage food page if id is not set
    header('location:' . SITEURL . 'admin/manage-food.php');
}
?>

<?php include('partials/footer.php'); ?>