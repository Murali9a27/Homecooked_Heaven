
   

   <?php
// Start session
session_start();

// Check if admin is logged in
if (!isset($_SESSION["user_id"])) {
    // Redirect to admin login page if not logged in
    header("Location: index.php");
    exit;
}

// Database connection
include("connection/connect.php"); // Include your database connection file

// Check if order ID is provided in the URL parameter
if(isset($_GET['order_del'])) {
    // Sanitize the order ID
    $order_del = mysqli_real_escape_string($db, $_GET['order_del']);

    // Query to fetch order status
    $status_query = "SELECT status FROM users_orders WHERE o_id = '$order_del'";
    $status_result = mysqli_query($db, $status_query);

    if ($status_result) {
        $row = mysqli_fetch_assoc($status_result);
        $order_status = $row['status'];

        // Check if order status is not "delivered"
        if ($order_status != "closed") {
            // Construct SQL query to delete the order
            $delete_query = "DELETE FROM users_orders WHERE o_id = '$order_del'";

            // Execute the query
            if(mysqli_query($db, $delete_query)) {
                // Order deleted successfully
                echo "<script>alert('Thank you. Your Order has been placed!');</script>"; 
                echo "<script>window.location.replace('your_orders.php');</script>"; 
            } else {
                // Error occurred while deleting the order
                echo "Error deleting order: " . mysqli_error($db);
            }
        } else {
            // Order status is "delivered", cannot delete
                echo "<script>alert('Cannot delete order.Your order has been delivered!');</script>"; 
                echo "<script>window.location.replace('your_orders.php');</script>"; 
        }
    } else {
        // Error occurred while fetching order status
        echo "Error fetching order status: " . mysqli_error($db);
    }
} else {
    // No order ID provided in the URL parameter
    echo "No order ID provided.";
}

// Close connection
mysqli_close($db);
?>
