
    <?php
include("../connection/connect.php");
error_reporting(0);
session_start();

if(empty($_SESSION['admin_id']))  
{
	header('location:index.php');
}


mysqli_query($db,"DELETE FROM res_category WHERE c_id = '".$_GET['cat_del']."'");
header("location:add_category.php");  

?>
