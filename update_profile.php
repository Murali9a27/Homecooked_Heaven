<?php
// Start session
session_start();

// Check if user is logged in
if (!isset($_SESSION["user_id"])) {
    // Redirect to login page if user is not logged in
    header("Location: login.php");
    exit;
}

// Include database connection
include("connection/connect.php");

// Get user ID from session
$user_id = $_SESSION["user_id"];

// Fetch user details from POST data
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$pincode = $_POST['pincode'];
$password = $_POST['password'];

// Update user details in the database
$update_query = "UPDATE users SET f_name='$first_name', l_name='$last_name', email='$email', phone='$phone', address='$address', pincode='$pincode' WHERE u_id=$user_id";
if ($db->query($update_query) === TRUE) {
    // User details updated successfully
    // Check if password is provided and update password if so
    if (!empty($password)) {
        $hashed_password = md5($password);
        $update_password_query = "UPDATE users SET password='$hashed_password' WHERE u_id=$user_id";
        if ($db->query($update_password_query) === TRUE) {
            // Password updated successfully
            echo '<script>alert("Profile updated successfully."); window.location.href = "index.php";</script>';
            exit;
        } else {
            // Error updating password
            echo '<script>alert("Error updating password: "); window.location.href = "index.php";</script>';
            exit;
        }
    } else {
        // No password provided
        echo '<script>alert("Profile updated successfully."); window.location.href = "index.php";</script>';
        exit;
    }
} else {
    // Error updating user details
    echo '<script>alert("Error updating password: "); window.location.href = "index.php";</script>';
    exit;
}

// Close database connection
$db->close();
?>
