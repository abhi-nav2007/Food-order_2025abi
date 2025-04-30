<?php
include 'C:/xampp/htdocs/food-order/admin/config/constants.php';
?>


<html>
    <head>
        <title>Food Order Website - Home Page</title>
        <link rel="stylesheet" href="../css/admin.css">
        <style>
            .tbl-30{
                width: 30%;
            }
        </style>
    </head>
    <body>
<!-- < ! menu Section Starts -->
<div class="menu text-center">
    <div class="warpper">
<!-- <ul>
    <li><a href="index.php">Home</a></li>
    <li><a href="manage-admin.php">Admin</a></li>
    <li><a href="manage-category.php">Category</a></li>
    <li><a href="manage-food.php">Food</a></li>
    <li><a href="manage-order.php">Order</a></li>
    <li><a href="logout.php">Logout</a></li>
</ul> -->
</div>
</div>
</body>
</html> 
<html>
    <head>
        <style>
/* General Styles */
/* General Styles */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 20px;
}

/* Menu Styles */
.menu {
    background-color: #333;
    color: white;
    padding: 10px 0;
}

.menu .warpper {
    width: 80%;
    margin: 0 auto;
}

.menu ul {
    list-style: none;
    padding: 0;
}

.menu ul li {
    display: inline; /* Display menu items in a row */
    margin-right: 20px; /* Space between menu items */
}

.menu ul li a {
    color: white;
    text-decoration: none;
    font-weight: bold;
}

.menu ul li a:hover {
    text-decoration: underline; /* Underline on hover */
}

/* Main Content */
.main-content {
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    margin-top: 20px; /* Space above the main content */
}

/* Table Styles */
.tbl-30 {
    width: 30%;
    margin: 0 auto; /* Center the table */
    border-collapse: collapse;
}

.tbl-30 td {
    padding: 10px;
    border: 1px solid #ddd;
}

/* Input Styles */
input[type="text"],
input[type="password"] {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box; /* Include padding in width */
}

/* Button Styles */
.btn-secondary {
    background-color: #5cb85c;
    color: white;
    border: none;
    padding: 10px 15px;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
}

.btn-secondary:hover {
    background-color: #4cae4c; /* Darker green on hover */
}

/* Header Styles */
h1 {
    text-align: center;
    color: #333;
}

/* Footer Styles */
.footer {
    background-color: #333;
    color: white;
    text-align: center;
    padding: 10px 0;
    margin-top: 20px; /* Space above the footer */
}

.footer .warpper {
    width: 80%;
    margin: 0 auto;
}

.footer p {
    margin: 0; /* Remove default margin */
}

        </style>
    </head>

<div class="main-content">
    <div class="warpper">
        <h1>Add Admin</h1><br><br>

        <form action="" method="post">
            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td><input type="text" name="full_name" placeholder="Enter Your Name" required></td>
                </tr>

                <tr>
                    <td>Username:</td>
                    <td><input type="text" name="username" placeholder="Your Username" required></td>
                </tr>

                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="password" placeholder="Your Password" required></td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" name="submit" value="Add Admin" class="btn-secondary"></td>
                </tr>
            </table>
        </form>
    </div>
</div>

<div class="footer">
<div class="warpper">
<p class="text-center">2020 All rights reasered,Food Hall.Develoed By-<a href="#"> S.k.Abhinav</a></p>

</div>
</div>
<!-- Footer Section Ends -->
</body>

</html>
<?php
if (isset($_POST['submit'])) {
    // 1. Get the Data from form
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = md5(mysqli_real_escape_string($conn, $_POST['password'])); // Hash the password

    // 2. Prepare the SQL query
    $sql = "INSERT INTO tbl_user (full_name, username, password) VALUES ('$full_name', '$username', '$password')";
        // 3. Query Execution
        $res = mysqli_query($conn, $sql);

        if ($res) {
            // Data Inserted
            $_SESSION['add'] = "Admin Added Successfully"; // Corrected to use $_SESSION
        
            header("Location: http://localhost/food-order/frontlogin.php"); // Added semicolon
            exit(); // It's a good practice to call exit after a header redirect
        } else {
            // Failed to insert data
            $_SESSION['add'] = "Failed to Add Admin: " . mysqli_error($conn); // Corrected to use $_SESSION
        
            header("Location: " . $siteurl . 'admin/manage-admin.php'); // Added semicolon
            exit(); // It's a good practice to call exit after a header redirect
        }
}

// Close the database connection
mysqli_close($conn);
    ?>