<?php include('partials/menu.php'); ?>

<STYle>
    .tbl-30{
        width:30%;
    }
</STYle>
<div class="main-content">
    <div class="warpper"> <!-- Corrected "warpper" to "wrapper" -->
        <h1>Change Password</h1><br>
        <?php
        if (isset($_GET['id'])) { // Corrected from $GET to $_GET
            $id = $_GET['id'];
        }
        ?>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Old Password:</td>
                    <td><input type="password" name="current_password" placeholder="Current Password"></td>
                </tr>

                <tr>
                    <td>New Password:</td>
                    <td><input type="password" name="new_password" placeholder="New Password"></td>
                </tr>

                <tr>
                    <td>Confirm Password:</td> <!-- Corrected "Confrim" to "Confirm" -->
                    <td><input type="password" name="confirm_password" placeholder="Confirm Password"></td> <!-- Corrected name -->
                </tr>

                <tr>
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <td colspan="2"><input type="submit" name="submit" value="Change Password" class="btn-secondary"></td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php 
if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $current_password = md5($_POST['current_password']);
    $new_password = md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']); // Corrected name

    // SQL query with closing quote
    $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'"; // Added closing quote

    $res = mysqli_query($conn, $sql);

    if ($res == true) {
        $count = mysqli_num_rows($res);

        if ($count == 1) {
            // echo "User  found";

            if ($new_password == $confirm_password) {
                // echo "hello";

                $sql2 = "UPDATE tbl_admin SET
                password='$new_password'
                WHERE id=$id"; // Removed the unnecessary comma

                $res = mysqli_query($conn, $sql2);

                if ($res == true) {
                    $_SESSION['change-pwd'] = "<div class='success'>Password changed successfully</div>";
                    header('location:' . SITEURL . 'admin/manage-admin.php');
                    echo"hello";
                    exit(); // Always exit after a header redirection
                } else {
                    $_SESSION['change-pwd'] = "<div class='error'>Failed to change the password</div>";
                    header('location:' . SITEURL . 'admin/manage-admin.php');
                    exit(); // Always exit after a header redirection
                }
            } else {
                $_SESSION['pwd-not-match'] = "<div class='error'>Passwords did not match</div>";
                header('location:' . SITEURL . 'admin/manage-admin.php');
                exit(); // Always exit after a header redirection
            }
        } else {
            $_SESSION['user-not-found'] = "<div class='error'>User  not found</div>";
            header('location:' . SITEURL . 'admin/manage-admin.php');
            exit(); // Always exit after a header redirection
        }
    } else {
        // Handle query error
        echo "Error executing query: " . mysqli_error($conn);
    }
}
?>

<?php include('partials/footer.php'); ?>