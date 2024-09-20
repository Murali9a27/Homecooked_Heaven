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

// Fetch user details
$user_id = $_SESSION["user_id"];
$user_query = "SELECT * FROM users WHERE u_id = $user_id";
$user_result = $db->query($user_query);

// Close database connection
$db->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <style>
        /* Additional CSS for styling edit profile page */
        body {
            background-color: #f8f9fa; /* Light gray background */
            font-family: Arial, sans-serif; /* Font family */
        }
        .edit-profile-container {
            max-width: 600px; /* Maximum width of the edit profile container */
            margin: 0 auto; /* Center the container horizontally */
            padding: 30px; /* Padding around the container */
            background-color: #fff; /* White background */
            border-radius: 10px; /* Rounded corners */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Drop shadow */
        }
        .edit-profile-header {
            text-align: center; /* Center align the header */
            margin-bottom: 30px; /* Bottom margin for spacing */
        }
        .form-group {
            margin-bottom: 20px; /* Bottom margin for form groups */
        }
        .form-group label {
            font-weight: bold; /* Bold label text */
        }
        .form-control {
            width: 100%; /* Full width input fields */
            padding: 10px; /* Padding for input fields */
            border-radius: 5px; /* Rounded corners for input fields */
            border: 1px solid #ccc; /* Border color for input fields */
        }
        .btn-primary {
            width: 100%; /* Full width button */
            padding: 10px; /* Padding for button */
            border-radius: 5px; /* Rounded corners for button */
        }
    </style>
</head>
<body>
    <div class="container-fluid" style="margin: 0; padding: 0">
        <?php include "include/header.php" ?>
    </div>
    
    <section>
        <div class="edit-profile-container">
            <div class="edit-profile-header">
                <h2>Edit Profile</h2>
            </div>
            <form action="update_profile.php" method="post">
                <?php if ($user_result && $user_result->num_rows > 0) {
                    $user = $user_result->fetch_assoc(); ?>
                    <div class="form-group">
                        <label for="first_name">First Name:</label>
                        <input type="text" id="first_name" name="first_name" class="form-control" value="<?php echo $user['f_name']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name:</label>
                        <input type="text" id="last_name" name="last_name" class="form-control" value="<?php echo $user['l_name']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" class="form-control" value="<?php echo $user['email']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone No:</label>
                        <input type="text" id="phone" name="phone" class="form-control" value="<?php echo $user['phone']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="address">Address:</label>
                        <textarea id="address" name="address" class="form-control"><?php echo $user['address']; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="pincode">Pincode:</label>
                        <input type="text" id="pincode" name="pincode" class="form-control" value="<?php echo $user['pincode']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="password">New Password:</label>
                        <input type="password" id="password" name="password" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                <?php } else { ?>
                    <p>No user details found.</p>
                <?php } ?>
            </form>
        </div>
    </section>
    
</body>
</html>
