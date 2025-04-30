<?php include('partials/menu.php'); ?>
<html>
    <head>
        <style>
            .tbl-30{
    width: 30%;
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

<?php include('partials/footer.php'); ?>

<?php
if (isset($_POST['submit'])) {
    // 1. Get the Data from form
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = md5(mysqli_real_escape_string($conn, $_POST['password'])); // Hash the password

    // 2. Prepare the SQL query
    $sql = "INSERT INTO tbl_admin (full_name, username, password) VALUES ('$full_name', '$username', '$password')";
        // 3. Query Execution
        $res = mysqli_query($conn, $sql);

        if ($res) {
            // Data Inserted
            $_SESSION['add'] = "Admin Added Successfully"; // Corrected to use $_SESSION
        
            header("Location: http://localhost/food-order/admin/manage-admin.php"); // Added semicolon
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