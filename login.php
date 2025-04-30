<?php 
include('config/constants.php');
session_start(); // Start the session

// Handle registration
if (isset($_POST['register'])) {
    // 1. Get the Data from form
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = md5($_POST['password']); // Hash the password using MD5

    $sql = "INSERT INTO tbl_admin (full_name, username, password) VALUES ('$full_name', '$username', '$password')";

    // Query Execution
    $res = mysqli_query($conn, $sql);

    if ($res) {
        // Data Inserted
        echo "Data Inserted";
    } else {
        // Failed to insert data
        echo "Failed to insert data: " . mysqli_error($conn);
    }
}

// Handle login
if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']); // Escape user input
    $password = md5($_POST['password']); // Hash the password using MD5

    $sql = "SELECT * FROM tbl_admin WHERE username='$username'"; // Only select by username
    $res = mysqli_query($conn, $sql);

    if ($res && mysqli_num_rows($res) == 1) {
        $row = mysqli_fetch_assoc($res);
        if ($password === $row['password']) { // Compare the MD5 hashed password
            // Set session variables
            $_SESSION['user_id'] = $row['id']; // Store user ID in session
            $_SESSION['username'] = $row['username']; // Store username in session
            $_SESSION['user'] = true; // Set user session variable to indicate the user is logged in
            $_SESSION['login_success'] = "Login successful! Welcome, " . $row['username']; // Set success message
            header('location:'.SITEURL.'admin/'); // Redirect to home page
            exit(); // Always exit after a header redirect
        } else {
            $_SESSION['login_error'] = "<div class='error'>Password and username do not match</div>";
            header('location:'.SITEURL.'admin/Login.php');
            exit(); // Always exit after a header redirect
        }
    } else {
        $_SESSION['login_error'] = "<div class='error'>User  not found</div>";
        header('location:'.SITEURL.'admin/Login.php');
        exit(); // Always exit after a header redirect
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login - Food Order System</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>

<div class="login">
    <h1 class="text-center">Login</h1><br><br>
    <?php
    if (isset($_SESSION['login_success'])) {
        echo "<div class='success'>" . $_SESSION['login_success'] . "</div>"; // Display success message
        unset($_SESSION['login_success']); // Unset the message after displaying it
    }
    if (isset($_SESSION['login_error'])) {
        echo $_SESSION['login_error'];
        unset($_SESSION['login_error']); // Unset the error message after displaying it
    }
    if (isset($_SESSION['no-login-message'])) {
        echo $_SESSION['no-login-message'];
        unset($_SESSION['no-login-message']); // Unset the error message after displaying it
    }
    ?>

    <form action="" method="POST" class="text-center">
        <div>
            <label for="username">Username:</label><br>
            <input type="text" name="username" placeholder="Enter Username" required>
        </div><br>

        <div>
            <label for="password">Password:</label><br>
            <input type="password" name="password" placeholder="Enter Password" required>
        </div><br>

        <div>
            <input type="submit" name="submit" value="Login" class="btn-secondary">
        </div>
    </form>

    <p class="text-center">Created By - <a href="http://www.vijaythapa.com">S.K. Abhinav</a></p>
</div>

</body>
</html>