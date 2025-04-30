<?php 
include('admin/config/constants.php');
session_start(); // Start the session

// Handle registration
if (isset($_POST['register'])) {
    // 1. Get the Data from form
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = md5($_POST['password']); // Hash the password using MD5

    $sql = "INSERT INTO tbl_user (full_name, username, password) VALUES ('$full_name', '$username', '$password')";

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

    $sql = "SELECT * FROM tbl_user WHERE username='$username'"; // Only select by username
    $res = mysqli_query($conn, $sql);

    if ($res && mysqli_num_rows($res) == 1) {
        $row = mysqli_fetch_assoc($res);
        if ($password === $row['password']) { // Compare the MD5 hashed password
            // Set session variables
            $_SESSION['user_id'] = $row['id']; // Store user ID in session
            $_SESSION['username'] = $row['username']; // Store username in session
            $_SESSION['user'] = true; // Set user session variable to indicate the user is logged in
            header('location:'.SITEURL.'index.php'); 
            // $_SESSION['login_success'] = ", " . $row['username']; // Set success message(Login successful! Welcome)
        //  / / Redirect to home page
            exit(); // Always exit after a header redirect
        } else {
            $_SESSION['login_error'] = "<div class='error'>Password and username do not match</div>";
            header('location:'.SITEURL.'frontlogin.php');
            exit(); // Always exit after a header redirect
        }
    } else {
        $_SESSION['login_error'] = "<div class='error'>User  not found</div>";
        header('location:'.SITEURL.'frontlogin.php');
        exit(); // Always exit after a header redirect
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login - Food Order System</title>
    <!-- <link rel="stylesheet" href="css/admin.css"> -->
     <style>/* admin.css */

/* Reset some default styles */
body, h1, p {
    margin: 0;
    padding: 0;
    font-family: 'Arial', sans-serif;
}

/* Body styles */
body {
    background: linear-gradient(to right, #ff7e5f, #feb47b);
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}

/* Login container styles */
.login {
    background-color: white;
    border-radius: 10px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    padding: 40px;
    width: 300px;
    text-align: center;
}

/* Heading styles */
h1 {
    color: #333;
    margin-bottom: 20px;
}

/* Success and error message styles */
.success {
    background-color: #d4edda;
    color: #155724;
    padding: 10px;
    border: 1px solid #c3e6cb;
    border-radius: 5px;
    margin-bottom: 20px;
}

.error {
    background-color: #f8d7da;
    color: #721c24;
    padding: 10px;
    border: 1px solid #f5c6cb;
    border-radius: 5px;
    margin-bottom: 20px;
}

/* Form styles */
form {
    display: flex;
    flex-direction: column;
}

/* Input styles */
input[type="text"],
input[type="password"] {
    padding: 10px;
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
}

/* Button styles */
.btn-secondary {
    background-color: #ff7e5f;
    color: white;
    border: none;
    padding: 10px;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s ease;
}

.btn-secondary:hover {
    background-color: #feb47b;
}

/* Link styles */
a {
    color: #ff7e5f;
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}

/* Responsive styles */
@media (max-width: 400px) {
    .login {
        width: 90%;
    }
}</style>
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

    <p class="text-center">Created An Account- <a href="add-user.php">Join As </a></p>
</div>

</body>
</html>