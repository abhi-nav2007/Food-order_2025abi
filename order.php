<?php 
include('partials-front/menu.php'); 
include('C:\xampp\htdocs\food-order\admin\config\constants.php'); // Ensure you include the database connection

// Check if the food ID is set
if (isset($_GET['id'])) {
    $food_id = $_GET['id'];

    // Fetch food details based on the food ID
    $sql = "SELECT * FROM tbl_food WHERE id='$food_id' AND active='Yes'";
    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);

    if ($count == 1) {
        // Food found
        $row = mysqli_fetch_assoc($res);
        $title = $row['title'];
        $price = $row['price'];
        $image_name = $row['image_name'];
    } else {
        // Food not found
        header('location:'.SITEURL); // Redirect to homepage if food not found
        exit(); // Ensure no further code is executed
    }
} else {
    // Food ID not set
    header('location:'.SITEURL); // Redirect to homepage if no food ID is provided
    exit(); // Ensure no further code is executed
}

// Process the order when the form is submitted
// if (isset($_POST['submit'])) {
//     // Get the form data
//     $food = $_POST['food'];
//     $price = $_POST['price'];
//     $qty = $_POST['qty'];

//     // Calculate total price
//     $total = $price * $qty;

//     // Display success message
//     echo "<div class='success'>Order placed successfully! You ordered: <strong>$food</strong> for a total price of <strong>₹$total</strong>.</div>";

//     // Optionally, you can also insert the order into the database here
//     $order_date = date("Y-m-d H:i:s"); // Corrected date format
//     $status = "Ordered";
//     $customer_name = mysqli_real_escape_string($conn, $_POST['full-name']);
//     $customer_contact = mysqli_real_escape_string($conn, $_POST['contact']);
//     $customer_email = mysqli_real_escape_string($conn, $_POST['email']);
//     $customer_address = mysqli_real_escape_string($conn, $_POST['address']);

//     // Insert the order into the database
//     $sql2 = "INSERT INTO tbl_order (food, price, quantity, total, order_date, status, customer_name, customer_contact, customer_email, customer_address) 
//               VALUES ('$food', '$price', '$qty', '$total', '$order_date', '$status', '$customer_name', '$customer_contact', '$customer_email', '$customer_address')";

//     // Execute the query
//     $res2 = mysqli_query($conn, $sql2);

//     // Check if the order was successfully inserted
//     if ($res2) {
//         $_SESSION['order'] = "<div class='success'>Food Ordered successfully.</div>";
//         header('location:' . SITEURL); // Redirect to the homepage or another page
//         exit(); // Ensure no further code is executed
//     } else {
//         $_SESSION['order'] = "<div class='error'>Failed to Order Food: " . mysqli_error($conn) . "</div>"; // Provide error details
//         header('location:' . SITEURL); // Redirect to the homepage or another page
//         exit(); // Ensure no further code is executed
//     }
// }
?>

<head>
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: lightblue; /* Background color for the body */
        }
        /* Order Form Styles */
        .order {
            margin-top: 20px;
            padding: 20px;
            background-color: #fff; /* White background for the order section */
            border-radius: 8px; /* Rounded corners */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Subtle shadow */
        }
        fieldset {
            border: none; /* Remove default border */
            margin-bottom: 20px; /* Space between fieldsets */
        }
        legend {
            font-size: 1.5em; /* Larger font for legend */
            margin-bottom: 10px; /* Space below legend */
        }
        .food-menu-img {
            margin-bottom: 15px; /* Space below image */
        }
        .food-menu-img img {
            width: 100%; /* Full width */
            height: auto; /* Maintain aspect ratio */
            border-radius: 8px; /* Rounded corners */
        }
        .food-price {
            color: #28a745; /* Green color for price */
            font-weight: bold; /* Bold text */
        }
        /* Input Styles */
        .order-label {
            font-weight: bold; /* Bold text for labels */
            margin-top: 10px; /* Space above labels */
        }
        .input-responsive {
            width: 100%; /* Full width */
            padding: 10px; /* Padding inside inputs */
            margin: 5px 0; /* Space above and below inputs */
            border: 1px solid #ccc; /* Border color */
            border-radius: 4px; /* Rounded corners */
        }
        /* Button Styles */
        .btn {
            display: inline-block; /* Inline block for buttons */
            padding: 10px 15px; /* Padding for buttons */
            background-color: #007bff; /* Blue background for buttons */
            color: white; /* White text color */
            text-decoration: none; /* Remove underline */
            border-radius: 4px; /* Rounded corners */
            cursor: pointer; /* Pointer cursor on hover */
        }
        .btn:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }
        .success {
            color: green; /* Green color for success message */
            margin-top: 20px; /* Space above the message */
        }
    </style>
</head>

<body>
    <section class="order">
        <div class="container">
            <h2>Fill this form to confirm your order.</h2>
            <form action="" method="POST">
                <fieldset>
                    <legend>Selected Food</legend>
                    <div class="food-menu-img">
                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">
                    </div>
                    <div class="food-menu-desc">
                        <input type="hidden" name="food" value="<?php echo $title; ?>">
                        <h3><?php echo $title; ?></h3>
                        <p class="food-price">₹<?php echo $price; ?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">
                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                    </div>
                </fieldset> 
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. S.K.Abhinav" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g.Abi@gmail.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <a href="<?php echo SITEURL; ?>c.php?id=<?php echo $id; ?>"><botton type="submit" name="submit" class="btn btn-primary">Order Now</button></a>
               
                </fieldset>

            </form>
        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php include('partials-front/footer.php');?>
</body>