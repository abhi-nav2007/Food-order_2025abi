<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="warpper">
        <h1>Manage Food</h1><br>

        <?php
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']); // Unset the error message after displaying it
        }
        ?>

        <a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary">Add Food</a><br><br><br>

        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Title</th>
                <th>Price</th>
                <th>Image</th>
                <th>Feature</th>
                <th>Active</th>
                <th>Action</th>
            </tr>

            <?php
            $sql = "SELECT * FROM tbl_food"; // Corrected to select from tbl_food
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);

            if ($count > 0) {
                $sn = 1;
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id']; // Assuming 'id' is the primary key in tbl_food
                    $title = $row['title'];
                    $price = $row['price'];
                    $image_name = $row['image_name'];
                    $featured = $row['feature']; // Corrected column name
                    $active = $row['active'];
                    ?>

                    <tr>
                        <td><?php echo $sn++; ?></td> <!-- Display serial number -->
                        <td><?php echo $title; ?></td>
                        <td>₹<?php echo  $price ; ?></td>
                        <td>
                            <?php 
                            if ($image_name != "") { // Check if image name is not empty
                                ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" width="100px">
                                <?php
                            } else {
                                echo "<div class='error'>Image not added</div>"; // Corrected echo syntax
                            }
                            ?>
                        </td>
                        <td><?php echo $featured; ?></td>
                        <td><?php echo $active; ?></td>
                        <td>
                            <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>" class="btn-secondary">Update Food</a> <!-- Corrected link -->
                            <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>" class="btn-danger" onclick="return confirm('Are you sure you want to delete this food item?')">Delete Food</a> <!-- Corrected link -->
                        </td>
                    </tr>

                    <?php
                }
            } else {
                echo "<tr><td colspan='7'><div class='error'>No Food Added</div></td></tr>";
            }
            ?>
        </table>
    </div>
</div>

<?php include('partials/footer.php'); ?>