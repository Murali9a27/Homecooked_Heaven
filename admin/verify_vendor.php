<?php
// Include database connection
include("../connection/connect.php");

// Check if ID parameter is set and is numeric
if(isset($_GET['id']) && is_numeric($_GET['id'])) {
    // Sanitize the ID parameter to prevent SQL injection
    $id = mysqli_real_escape_string($db, $_GET['id']);

    // Query to update vendor verification status
    $sql = "UPDATE vendors SET verified = 1 WHERE id = $id";

    // Execute the query
    if(mysqli_query($db, $sql)) {
        // Verification successful
        echo "<script>alert('Vendor verified successfully');</script>";
    } else {
        // Verification failed
        echo "<script>alert('Error verifying vendor');</script>";
    }
} else {
    // Invalid ID parameter
    echo "<script>alert('Invalid vendor ID');</script>";
}

// Redirect back to manage_vendors.php
echo "<script>window.location.href = 'manage_vendors.php';</script>";
?>