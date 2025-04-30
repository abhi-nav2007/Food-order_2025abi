<?php include('partials-front/menu.php');?>

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
    color: #333; /* Dark te color */

}
.text-black{
    color:white;
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

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php
        $sql = "SELECT * FROM tbl_category WHERE active='Yes'  ";
        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);

        if ($count > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                $id = $row['id'];
                $title = $row['title'];
                $image_name = $row['image_name'];
                ?>
                <a href="<?php echo SITEURL;?>category-foods.php?id=<?php echo $id; ?>"> <!-- Link to category foods -->
                    <div class="box-3 float-container">
                        <?php 
                        if ($image_name != "") { // Check if image name is not empty
                            ?>
                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">
                            <?php
                        } else {
                            echo "<div class='error'>Image not Available</div>"; // Show error if image is not available
                        }
                        ?>
                        <h3 class="float-text text-black"><?php echo $title; ?></h3>
                    </div>
                </a>
                <?php
            }
        } else {
            echo "<div class='error'>No Categories Found</div>";
        }
        ?>


        

           
          

            

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


    <?php include('partials-front/footer.php');?>