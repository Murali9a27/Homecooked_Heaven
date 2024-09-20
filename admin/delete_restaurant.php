
                <?php
include("../connection/connect.php");
error_reporting(0);
session_start();

if(empty($_SESSION['admin_id']))  
{
	header('location:index.php');
}


mysqli_query($db,"DELETE FROM restaurant WHERE rs_id = '".$_GET['res_del']."'");
mysqli_query($db,"DELETE FROM dishes WHERE rs_id = '".$_GET['res_del']."'");
header("location:all_restaurant.php");  

?>
