<?php
session_start(); // Start the session

include 'C:/xampp/htdocs/food-order/admin/config/constants.php'; // Include your constants file
include('partials/menu.php'); // Include the menu

// Ensure $conn is defined and connected to the database
$conn = mysqli_connect('localhost', 'root', 'root', 'a'); // Replace with your actual constants
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Directory path for uploaded images
$directoryPath = 'C:/xampp/htdocs/food-order/images/category'; // Use forward slashes

// Check if the directory already exists
if (!is_dir($directoryPath)) {
    // Create the directory
    if (mkdir($directoryPath, 0755, true)) {
        // Directory created successfully
    } else {
        echo "Failed to create directory.";
    }
}

?>
<head>
    <style>
        .tbl-30{
            width: 50%;
        }
    </style>
</head>
<div class="main-content">
    <div class="warpper">
        <h1>Add Category</h1>
        <br><br>
        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']); // Unset the error message after displaying it
        }

        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']); // Unset the error message after displaying it
        }
        ?>
        <br><br>

        <form action="" method="post" enctype="multipart/form-data"> <!-- Corrected enctype -->
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td><input type="text" name="Title" placeholder="Title" required></td>
                </tr>

                <tr>
                    <td>Select Image:</td>
                    <td><input type="file" name="images" placeholder="Title" required></td> <!-- Added required -->
                </tr>

                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="feature" value="Yes">Yes
                        <input type="radio" name="feature" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" name="submit" value="Add Category" class="btn-secondary"></td>
                </tr>
            </table>
        </form>

        <?php
        if (isset($_POST['submit'])) {
            // Escape user inputs for security
            $Title = mysqli_real_escape_string($conn, $_POST['Title']);

            if (isset($_POST['feature'])) {
                $feature = $_POST['feature'];
            } else {
                $feature = "No";
            }

            if (isset($_POST['active'])) {
                $active = $_POST['active'];
            } else {
                $active = "No";
            }

            // Check if the image is uploaded
            if (isset($_FILES['images']['name']) && $_FILES['images']['error'] == UPLOAD_ERR_OK) {
                $image_name = $_FILES['images']['name'];

                $ext = pathinfo($image_name, PATHINFO_EXTENSION); // Use pathinfo to get the extension

                $image_name = "Food_Category_" . rand(000, 999) . '.' . $ext;
                $source_path = $_FILES['images']['tmp_name'];
                $destination_path = $directoryPath . '/' . $image_name; // Add a slash

                // Move the uploaded file to the destination
                $upload = move_uploaded_file($source_path, $destination_path);

                if ($upload == false) {
                    $_SESSION['upload'] = "<div class='error'>Failed to add image:</div>"; // Show the error
                    header('location:' . SITEURL . 'admin/add-category.php');
                    die();
                } else {
                    $_SESSION['upload'] = "<div class='success'>Image uploaded successfully.</div>";
                }
            } else {
                $_SESSION['upload'] = "<div class='error'>Error uploading image: " . $_FILES['images']['error'] . "</div>";
                header('location:' . SITEURL . 'admin/add-category.php');
                die();
            }

            // Prepare the SQL query to insert the category
            $sql = "INSERT INTO tbl_category SET
            title = '$Title',
            image_name = '$image_name',
            feature = '$feature',
            active = '$active'";

            // Execute the query
            $res = mysqli_query($conn, $sql);

            // Check if the query was successful
            if ($res == true) {
                $_SESSION['add'] = "<div class='success'>Category added successfully.</div>";
            } else {
                $_SESSION['add'] = "<div class='error'>Failed to add category: " . mysqli_error($conn) . "</div>"; // Provide error details
            }

            // Redirect to the manage category page
            header('location:' . SITEURL . 'admin/manage-category.php');
        }
        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>