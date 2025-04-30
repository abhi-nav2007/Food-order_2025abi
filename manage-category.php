<?php 
include('partials/menu.php');

// Ensure the SITEURL constant is defined
if (!defined('SITEURL')) {
    define('SITEURL', 'http://localhost/food-order/'); // Replace with your actual site URL
}

// Include database connection
$conn = mysqli_connect('localhost', 'root', 'root', 'a'); // Replace with your actual constants
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

<div class="main-content">
    <div class="warpper">
        <h1>Manage Category</h1><br>

        <a href="add-category.php" class="btn-primary">Add Category</a><br><br><br>
        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']); // Unset the error message after displaying it
        }

        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']); // Unset the error message after displaying it
        }

        if (isset($_SESSION['delete'])) {

            echo $_SESSION['delete'];

            unset($_SESSION['delete']); // Unset the error message after displaying it

        }

        // if (isset($_SESSION['update'])) {
        //     echo $_SESSION['update'];
        //     unset($_SESSION['update']); // Unset the error message after displaying it
        // }

        if (isset($_SESSION['no-category-found'])) {
            echo $_SESSION['no-category-found'];
            unset($_SESSION['no-category-found']); // Unset the error message after displaying it
        }
        
  
        if (isset($_SESSION['update2'])) {
            echo $_SESSION['update2'];
            unset($_SESSION['update2']); // Unset the error message after displaying it
        }

        
        if (isset($_SESSION['failed-remove'])) {
            echo $_SESSION['failed-remove'];
            unset($_SESSION['failed-remove']); // Unset the error message after displaying it
        }
        ?>

        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Title</th>
                <th>Image</th>
                <th>Feature</th> <!-- Corrected typo -->
                <th>Active</th>
                <th>Actions</th>
            </tr>

            <?php
            $sql = "SELECT * FROM tbl_category";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);

            if ($count > 0) {
                $sn = 1; // Serial number for S.N. column
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];
                    $featured = $row['feature']; // Corrected column name
                    $active = $row['active'];
                    ?>
                    <tr>
                        <td><?php echo $sn++; ?></td> <!-- Display serial number -->
                        <td><?php echo $title; ?></td>
                        
                        <td><?php 
                        if ($image_name != "") { // Check if image name is not empty
                            ?>
                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" width="100px">
                            <?php
                        } else {
                            echo "<div class='error'>Image not added</div>"; // Corrected echo syntax
                        }
                        ?></td>
                        
                        <td><?php echo $featured; ?></td>
                        <td><?php echo $active; ?></td>
                        <td>
                        <a href="<?php echo  SITEURL;?>admin/update-category.php?id=<?php echo $id?>" class="btn-secondary">Update Category</a>
                            <a href="delete-category.php?id=<?php echo $id; ?>" class="btn-danger">Delete Category</a>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="6"><div class="error">No Category Added</div></td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>
</div>

<?php include('partials/footer.php'); ?>