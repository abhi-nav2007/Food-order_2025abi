
<?php
SESSION_START();
include('config/constants.php');
//1.get the id  of admin to be delete
 $id = $_GET['id'];

 //create the sql query to delete admin
 $sql = "DELETE FROM tbl_admin WHERE id=$id";

// execute from ouery   
$res = mysqli_query($conn,$sql); 

if($res==true)
{
    // echo "Admin delete";
$_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully</div>";

// header('location:'.SITEURL.'admin/manage-admin.php');

}

else{
    // echo " fialed to admin delete";
    $_SESSION['delete'] = "<div class='error'>Fialed To Delete the Admin.Try Again Later</div>";
   
}

header('location:'.SITEURL.'admin/manage-admin.php');

?>