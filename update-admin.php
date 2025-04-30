<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="warpper"> <!-- Corrected "warpper" to "wrapper" -->
        <h1>Update Admin</h1><br><br>

        <?php
        // Ensure $conn is defined
        $id = $_GET['id'];

        $sql = "SELECT * FROM tbl_admin WHERE id = $id";
        $res = mysqli_query($conn, $sql);

        if ($res == true) {
            $count = mysqli_num_rows($res);
            if ($count == 1) {
                // Admin Available
                $row = mysqli_fetch_assoc($res);
                $full_name = $row['full_name'];
                $username = $row['username'];
            } else {
                header('location:' . SITEURL . 'admin/manage-admin.php');
                exit(); // Always exit after a redirect
            }
        } else {
            // Handle query error
            echo "Error executing query: " . mysqli_error($conn);
        }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td><input type="text" name="full_name" value="<?php echo htmlspecialchars($full_name); ?>" required></td>
                </tr>

                <tr>
                    <td>Username:</td> <!-- Closed <td> tag properly -->
                    <td><input type="text" name="username" value="<?php echo htmlspecialchars($username); ?>" required></td>
                </tr>

                <tr>
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <td colspan="2"><input type="submit" name="submit" value="Update Admin" class="btn-secondary"></td>
                </tr>
            </table>
        </form>

    </div>
</div>

<?php
if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];

    // Update query
    $sql = "UPDATE tbl_admin SET
        full_name = '$full_name',
        username = '$username'
        WHERE id = '$id'";

    // Execute the query
    $res = mysqli_query($conn, $sql);

    if ($res == true) {
        $_SESSION['update'] = "<div class='success'>Admin Updated Successfully</div>"; // Corrected message
        header('location:' . SITEURL . 'admin/manage-admin.php');
        exit(); // Always use exit after header redirection
    } else {
        $_SESSION['update'] = "<div class='error'>Failed To Update the Admin. Try Again Later</div>"; // Corrected message
        header('location:' . SITEURL . 'admin/manage-admin.php');
        exit(); // Always use exit after header redirection
    }
}
?>

<?php include('partials/footer.php'); ?>