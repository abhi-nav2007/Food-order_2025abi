<?php include('partials/menu.php'); ?>

<style>
    .tbl-30 {
        width: 50%; /* Full width */
        margin: 15px 0; /* Margin for spacing */
        border-collapse: collapse; /* Collapse borders */
    }

    .tbl-30 th, .tbl-30 td {
        padding: 10px; /* Padding for cells */
        text-align: left; /* Align text to the left */
        border: 1px solid #ddd; /* Border for cells */
    }
</style>

<div class="main-content">
    <div class="warpper">
        <h1>Update Category</h1>
        <br><br>

        <?php
        // Check if ID is set in the URL
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            // Prepare the SQL query to get the category details
            $sql = "SELECT * FROM tbl_category WHERE id = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, 'i', $id);
            mysqli_stmt_execute($stmt);
            $res = mysqli_stmt_get_result($stmt);

            // Check if the category exists
            if ($res && mysqli_num_rows($res) == 1) {
                $row = mysqli_fetch_assoc($res);
                $title = $row['title'];
                $current_image = $row['image_name'];
                $feature = $row['feature']; // Ensure this is the correct column name
                $active = $row['active'];
            } else {
                $_SESSION['no-category-found'] = "<div class='error'>Category not found.</div>";
                header('location:' . SITEURL . 'admin/manage-category.php');
                exit();
            }
        } else {
            header('location:' . SITEURL . 'admin/manage-category.php');
            exit();
        }
        ?>

        <br><br>

        <form action="" method="post" enctype="multipart/form-data"> <!-- Corrected enctype -->
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td><input type="text" name="title" value="<?php echo htmlspecialchars($title); ?>" required></td>
                </tr>

                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php
                        if ($current_image != "") {
                            echo "<img src='" . SITEURL . "images/category/" . htmlspecialchars($current_image) . "' width='100px'>";
                        } else {
                            echo "Image not available.";
                        }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>New Image:</td>
                    <td><input type="file" name="images"></td> <!-- Removed required -->
                </tr>

                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="feature" value="Yes" <?php if (isset($feature) && $feature == "Yes") echo "checked"; ?>> Yes
                        <input type="radio" name="feature" value="No" <?php if (isset($feature) && $feature == "No") echo "checked"; ?>> No
                    </td>
                </tr>

                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes" <?php if ($active == "Yes") echo "checked"; ?>> Yes
                        <input type="radio" name="active" value="No" <?php if ($active == "No") echo "checked"; ?>> No
                    </td>
                </tr>
                <tr>
                    <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <td colspan="2"><input type="submit" name="submit" value="Update Category" class="btn-secondary"></td>
                </tr>
            </table>
        </form>

        <?php
        if (isset($_POST['submit'])) {
            $id = $_POST['id'];
            $title = $_POST['title'];
            $current_image = $_POST['current_image'];
            $feature = $_POST['feature'];
            $active = $_POST['active'];

            // Handle file upload
            if (isset($_FILES['images']['name']) && $_FILES['images']['name'] != "") {
                $image_name = $_FILES['images']['name'];
                $ext = pathinfo($image_name, PATHINFO_EXTENSION); // Use pathinfo to get the extension
                $image_name = "Food_Category_" . rand(000, 999) . '.' . $ext;
                $source_path = $_FILES['images']['tmp_name'];
                $destination_path = "../images/category/" . $image_name; // Ensure this path is correct

                // Move the uploaded file to the destination
                $upload = move_uploaded_file($source_path, $destination_path);

                if ($upload == false) {
                    $_SESSION['upload'] = "<div class='error'>Failed to add image:</div>"; // Show the error
                    header('location:' . SITEURL . 'admin/manage-category.php');
                    exit();
                }

                // Remove the current image if it exists
                if ($current_image != "") {
                    $remove_path = "../images/category/" . $current_image;

                    if (file_exists($remove_path)) {
                        $remove = unlink($remove_path);
                        if ($remove == false) {
                            $_SESSION['failed-remove'] = "<div class='error'>Failed to Remove current image:</div>"; // Show the error
                            header('location:' . SITEURL . 'admin/manage-category.php');
                            exit();
                        }
                    }
                }
            } else {
                $image_name = $current_image; // Retain the current image if no new image is uploaded
            }

            // Prepare the SQL update statement
            $sql2 = "UPDATE tbl_category SET
                title = ?,
                feature = ?,
                active = ?,
                image_name = ?
                WHERE id = ?";

            $stmt2 = mysqli_prepare($conn, $sql2);
            mysqli_stmt_bind_param($stmt2, 'ssssi', $title, $feature, $active, $image_name, $id);
            $res2 = mysqli_stmt_execute($stmt2);

            if ($res2) {
                $_SESSION['update2'] = "<div class='success'>Category Updated Successfully</div>"; // Corrected message
                header('location:' . SITEURL . 'admin/manage-category.php');
                exit(); // Always use exit after header redirection
            } else {
                $_SESSION['update2'] = "<div class='error'>Failed To Update the Category. Try Again Later</div>"; // Corrected message
                header('location:' . SITEURL . 'admin/update-category.php?id=' . $id);
                exit(); // Always use exit after header redirection
            }
        }
        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>