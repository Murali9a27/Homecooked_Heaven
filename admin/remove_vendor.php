<?php
// Include database connection
include("../connection/connect.php");

// Check if ID parameter is set and is numeric
if(isset($_GET['id']) && is_numeric($_GET['id'])) {
    // Sanitize the ID parameter to prevent SQL injection
    $id = mysqli_real_escape_string($db, $_GET['id']);

    // Query to delete vendor
    $sql = "DELETE FROM vendors WHERE id = $id";

    // Execute the query
    if(mysqli_query($db, $sql)) {
        // Deletion successful
        echo "<script>alert('Vendor removed successfully');</script>";
        echo "<script>window.location.href = 'manage_vendors.php';</script>"; // Redirect back to manage_vendors.php
    } else {
        // Deletion failed
        echo "<script>alert('Error removing vendor');</script>";
        echo "<script>window.location.href = 'manage_vendors.php';</script>"; // Redirect back to manage_vendors.php
    }
} else {
    // Invalid ID parameter
    echo "<script>alert('Invalid vendor ID');</script>";
    echo "<script>window.location.href = 'manage_vendors.php';</script>"; // Redirect back to manage_vendors.php
}
?>
