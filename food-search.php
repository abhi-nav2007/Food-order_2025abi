<?php include('partials-front/menu.php');?>
    <!-- fOOD sEARCH Section Starts Here -->
    <!-- <section class="food-search text-center">
        <div class="container">
            
            

        </div>
    </section> -->
    <!-- fOOD sEARCH Section Ends Here



<!-- fOOD sEARCH Section Starts Here -->

<head>
<style>
        /* General Styles */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: lightblue; /* Background color for the body */
}
.box-3 img {
    width: 100%; /* Full width */
    height: 200px; /* Set a fixed height */
    object-fit: cover; /* Maintain aspect ratio */
    border-radius: 8px; /* Rounded corners */
}   
/* Food Search Section */
.food-search {
    padding: 20px;
    background-color: #fff; /* White background for the search section */
    border-radius: 8px; /* Rounded corners */
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Subtle shadow */
}

.food-search h2 {
    margin-bottom: 20px;
    color: #333; /* Dark text color */
}

.food-search input[type="search"] {
    padding: 10px;
    width: 300px; /* Width of the search input */
    border: 1px solid #ccc; /* Border color */
    border-radius: 4px; /* Rounded corners */
}

.food-search input[type="submit"] {
    padding: 10px 20px;
    background-color: #28a745; /* Green background for the button */
    color: white; /* White text color */
    border: none; /* No border */
    border-radius: 4px; /* Rounded corners */
    cursor: pointer; /* Pointer cursor on hover */
}

.food-search input[type="submit"]:hover {
    background-color: #218838; /* Darker green on hover */
}

/* Categories Section */
.categories {
    padding: 20px;
    background-color: #fff; /* White background for the categories section */
    border-radius: 8px; /* Rounded corners */
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Subtle shadow */
}

.categories h2 {
    margin-bottom: 20px;
    color: #333; /* Dark text color */
}

.box-3 {
    position: relative; /* Positioning for the text overlay */
    margin: 10px; /* Margin around each category box */
    overflow: hidden; /* Hide overflow */
    border-radius: 8px; /* Rounded corners */
}

.container {
    width: 100%; /* Full width */
    height: auto; /* Maintain aspect ratio */
    border-radius: 8px; /* Rounded corners */
}

.float-text {
    position: absolute; /* Positioning for the text overlay */
    bottom: 10px; /* Position from the bottom */
    left: 10px; /* Position from the left */
    color: white; /* White text color */
    background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent background */
    padding: 5px 10px; /* Padding around the text */
    border-radius: 4px; /* Rounded corners */
}

/* Food Menu Section */
.food-menu {
    padding: 20px;
    background-color: #fff; /* White background for the food menu section */
    border-radius: 8px; /* Rounded corners */
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Subtle shadow */
}

.food-menu h2 {
    margin-bottom: 20px;
    color: #333; /* Dark text color */
}

.food-menu-box {
    display: flex; /* Flexbox for layout */
    margin-bottom: 20px; /* Space between food items */
    border: 1px solid #ccc; /* Border around each food item */
    border-radius: 8px; /* Rounded corners */
    overflow: hidden; /* Hide overflow */
}

.food-menu-img {
    flex: 1; /* Take up equal space */
}

.food-menu-img img {
    width: 100%; /* Full width */
    height: auto; /* Maintain aspect ratio */
}

.food-menu-desc {
    flex: 2; /* Take up more space */
    padding: 10px; /* Padding inside the description */
}

.food-menu-desc h4 {
    margin: 0; /* Remove default margin */
    color: #333; /* Dark text color */
}

.food-price {
    color: #28a745; /* Green color for price */
    font-weight: bold; /* Bold text */
}

.food-detail {
    color: #666; /* Gray color for details */
}

/* Button Styles */
.btn {
    display: inline-block; /* Inline block for buttons */
    padding: 10px 15px; /* Padding for buttons */
    background-color: #007bff; /* Blue background for buttons */
    color: white; /* White text color */
    text-decoration: none; /* Remove underline */
    border-radius: 4px; /* Rounded corners */
}

.btn:hover {
    background-color: #0056b3; /* Darker blue on hover */
}

/* Clearfix for floating elements */
.clearfix::after {
    content: "";
    clear: both;
    display: table;
}
.text-white{
    color: black;
}
    </style>
</head>
<section class="food-search text-center">

    <div class="container">

    <?php

if (isset($_POST['submit'])) {

    $search = $_POST['search'];

    ?>
<h2>Foods on Your Search: <a href="#" class="text-white">"<?php echo htmlspecialchars($search); ?>"</a></h2>

        

    </div>

</section>

<!-- fOOD sEARCH Section Ends Here -->





    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <section class="food-search text-center">

<div class="container">

  

        <!-- <h2>Foods on Your Search: <a href="#" class="text-white">"<?php echo htmlspecialchars($search); ?>"</a></h2> -->

        <?php


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

                        <a href="<?php echo SITEURL;?>order.php?id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>

                    </div>

                </div>

                <?php

            }

        } else {

            echo "<div class='error'>No Foods Found</div>";

        }

    }

    ?>

                        <!-- </div>

                        <div class="food-menu-desc">

                            <h4><?php echo $title; ?></h4>

                            <p class="food-price">₹<?php echo $price; ?></p>

                            <p class="food-detail"><?php echo $description; ?></p>

                            <br>

                            <a href="order.php?id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>

                        </div>

                    </div>

                   

                }

            } else {

                echo "<div class='error'>No Foods Found</div>";

            }

        }

        ?> -->

            <!-- <div class="food-menu-box">
                <div class="food-menu-img">
                    <img src="images/b2.jpg" alt="Chicken biryani" class="img-responsive img-curve">
                </div>

                <div class="food-menu-desc">
                    <h4>Chicken biryani</h4>
                    <p class="food-price">₹300</p>
                    <p class="food-detail">
                        Made with  basmati rice, herbs, saffron infused milk, fried onions and ghee
                    </p>
                    <br>

                    <a href="order.php" class="btn btn-primary">Order Now</a>
                </div>
            </div>

            <div class="food-menu-box">
                <div class="food-menu-img">
                    <img src="images/menu-burger.jpg" alt="Smoky Burger" class="img-responsive img-curve">
                </div>

                <div class="food-menu-desc">
                    <h4>Smoky Burger</h4>
                    <p class="food-price"> ₹250</p>
                    <p class="food-detail">
                        Made with Italian Sauce, Chicken, and organice vegetables.
                    </p>
                    <br>

                    <a href="order.php" class="btn btn-primary">Order Now</a>
                </div>
            </div>

            <div class="food-menu-box">
                <div class="food-menu-img">
                    <img src="images/do1.jpg" alt="Dosa" class="img-responsive img-curve">
                </div>

                <div class="food-menu-desc">
                    <h4>Dosa</h4>
                    <p class="food-price">₹40</p>
                    <p class="food-detail">
                        Made with rice, urad dal (split lentils), and fenugreek seeds.
                    </p>
                    <br>

                    <a href="order.php" class="btn btn-primary">Order Now</a>
                </div>
            </div>

            <div class="food-menu-box">
                <div class="food-menu-img">
                    <img src="images/v.webp" alt="vadai" class="img-responsive img-curve">
                </div>

                <div class="food-menu-desc">
                    <h4>vadai</h4>
                    <p class="food-price">₹10</p>
                    <p class="food-detail">
                        Made with Italian Sauce, Chicken, and organice vegetables .
                    </p>
                    <br>

                    <a href="order.php" class="btn btn-primary">Order Now</a>
                </div>
            </div>

            <div class="food-menu-box">
                <div class="food-menu-img">
                    <img src="images/d1.jpg" alt="Idli" class="img-responsive img-curve">
                </div>

                <div class="food-menu-desc">
                    <h4>Idli</h4>
                    <p class="food-price">₹15</p>
                    <p class="food-detail">
                        Made with fermented de-husked black lentils and rice.
                    </p>
                    <br>

                    <a href="order.php" class="btn btn-primary">Order Now</a>
                </div>
            </div>

            <div class="food-menu-box">
                <div class="food-menu-img">
                    <img src="images/menu-momo.jpg" alt="Chicke Steam Momo" class="img-responsive img-curve">
                </div>

                <div class="food-menu-desc">
                    <h4>Chicken Steam Momo</h4>
                    <p class="food-price">₹99</p>
                    <p class="food-detail">
                        Made with Italian Sauce, Chicken, and organice vegetables.
                    </p>
                    <br>

                    <a href="order.php" class="btn btn-primary">Order Now</a>
                </div>
            </div> -->
 

            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php');?>