<?php 
include('partials/menu.php'); 
include('C:\xampp\htdocs\food-order\admin\config\constants.php');

$directoryPath = 'C:/xampp/htdocs/food-order/images/food'; // Use forward slashes

// Check if the directory already exists
if (!is_dir($directoryPath)) {
    // Create the directory
    if (!mkdir($directoryPath, 0755, true)) {
        echo "Failed to create directory.";
    }
}
?>
<head>
    <style>
        .tbl-30 {
            width: 50%;
        }
    </style>
</head>
<div class="main-content">
    <div class="warpper">
        <h1>Add Food</h1><br><br>
        <?php
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']); // Unset the error message after displaying it
        }
        ?>

        <form action="" method="post" enctype="multipart/form-data"> <!-- Corrected enctype -->
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td><input type="text" name="title" placeholder="Title of food" required></td> <!-- Changed to lowercase -->
                </tr>

                <tr>
                    <td>Description:</td>
                    <td><textarea name="description" cols="30" rows="5" placeholder="Description of Food" required></textarea></td> <!-- Added required -->
                </tr>

                <tr>
                    <td>Price:</td>
                    <td><input type="number" name="price" required></td> <!-- Added required -->
                </tr>
                
                <tr>
                    <td>Select Image:</td>
                    <td><input type="file" name="images" required></td> <!-- Added required -->
                </tr>
                
                <tr>
                    <td>Category:</td>
                    <td>
                        </ <!-- Added required -->
                            <?php
                            $sql = "SELECT * FROM tbl_category WHERE active='Yes'"; // Added semicolon

                            $res = mysqli_query($conn, $sql);

                            $count = mysqli_num_rows($res); // Corrected variable name

                            if ($count > 0) {
                                while ($row = mysqli_fetch_assoc($res)) { // Corrected to fetch associative array
                                    $id = $row['id'];
                                    $title = $row['title'];
                                    ?>
                                    <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                    <?php
                                }
                            } else {
                                ?>
                                <option value="0">No category Found</option> 
                                <?php
                            }
                            ?>
                        </select>
                    </td>
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
                    <td colspan="2"><input type="submit" name="submit" value="Add Food" class="btn-secondary"></td>
                </tr>
            </table>
        </form>
        <?php
        if (isset($_POST['submit'])) {
            $title = $_POST['title']; // Changed to lowercase
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];

            $feature = isset($_POST['feature']) ? $_POST['feature'] : "No";
            $active = isset($_POST['active']) ? $_POST['active'] : "No";

            if (isset($_FILES['images']['name'])) {
                $image_name = $_FILES['images']['name'];
                if ($image_name != "") {
                    $ext = pathinfo($image_name, PATHINFO_EXTENSION); // Use pathinfo to get the extension

                    $image_name = "Food-Name-" . rand(0000, 9999) . "." . $ext;    
                    $src = $_FILES['images']['tmp_name'];
                    $dst = "../images/food/" . $image_name; // Add a slash

                    // Move the uploaded file to the destination
                    $upload = move_uploaded_file($src, $dst);

                    if ($upload == false) {
                        $_SESSION['upload'] = "<div class='error'>Failed to upload the image.</div>"; // Added missing semicolon
                        header('location:' . SITEURL . 'admin/add-food.php');
                        die();
                    }
                } else {
                    $image_name = ""; // Set to empty if no image is uploaded
                }
            }

            // Insert food into the database
            $sql2 = "INSERT INTO tbl_food SET
                title = '$title',
                description = '$description',
                price = $price,
                image_name = '$image_name',
                category_id = $category,
                feature = '$feature',
                active = '$active'";

            $res2 = mysqli_query($conn, $sql2);

            // Check if the query was successful
            if ($res2 == true) {
                $_SESSION['add'] = "<div class='success'>Food added successfully.</div>";
            } else {
                $_SESSION['add'] = "<div class='error'>Failed to add food: " . mysqli_error($conn) . "</div>"; // Provide error details
            }

            // Redirect to the manage category page
            header('location:' . SITEURL . 'admin/manage-food.php');
        }
        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>