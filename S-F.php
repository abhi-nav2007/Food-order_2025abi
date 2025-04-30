<?php 
include('partials-front/menu.php'); 
include('C:\xampp\htdocs\food-order\admin\config\constants.php'); // Ensure you include the database connection
?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">
        <h2>Food Search Results</h2>
        <?php
        if (isset($_POST['submit'])) {
            $search = $_POST['search'];

            // SQL query to search for food items
            $sql = "SELECT * FROM tbl_food WHERE title LIKE '%$search%' AND active='Yes'";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);

            if ($count > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $description = $row['description'];
                    $image_name = $row['image_name'];
                    ?>
                    <div class="food-menu-box">
                        <div class="food-menu-img">
                            <?php 
                            if ($image_name != "") { // Check if image name is not empty
                                ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">
                                <?php
                            } else {
                                echo "<div class='error'>Image not Available</div>"; // Show error if image is not available
                            }
                            ?>
                        </div>
                        <div class="food-menu-desc">
                            <h4><?php echo $title; ?></h4>
                            <p class="food-price">₹<?php echo $price; ?></p>
                            <p class="food-detail"><?php echo $description; ?></p>
                            <br>
                            <a href="order.php?id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "<div class='error'>No Foods Found</div>";
            }
        }
        ?>
    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->

<?php include('partials-front/footer.php'); ?>