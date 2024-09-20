<?php
// Start session
session_start();

// Check if admin is logged in
if (!isset($_SESSION["admin_id"])) {
    // Redirect to admin login page if not logged in
    header("Location: index.php");
    exit;
}

// Database connection
include("../connection/connect.php"); // Include your database connection file

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $plan_id = $_POST["plan_id"];
    $plan_name = $_POST["name"];
    $plan_description = $_POST["description"];
    $plan_price = $_POST["price"];

    // Update subscription plan in the database
    $update_sql = "UPDATE subscription_plans SET name = '$plan_name', description = '$plan_description', price = '$plan_price' WHERE plan_id = '$plan_id'";

    if ($db->query($update_sql) === TRUE) {
        echo "Subscription plan updated successfully";
        header("Location: all_plans.php");
    } else {
        echo "Error updating subscription plan: " . $db->error;
    }

    // Close connection
    $db->close();
}

// Retrieve subscription plan details for the form


// Query to select subscription plan details
$plan_query = "SELECT * FROM subscription_plans WHERE plan_id = '$_GET[plan_upd]' ";
$plan_result = $db->query($plan_query);

// Fetch subscription plan details
if ($plan_result->num_rows > 0) {
    $plan_row = $plan_result->fetch_assoc();
} else {
    echo "Subscription plan not found";
    exit;
}
?>

<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
        <title>Update Restaurant</title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
        <link href="css/helper.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
    </head>
             

    <body class="fix-header">
        <div class="preloader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
            </svg>
        </div>
        <div id="main-wrapper">

            <?php include "include/header.php" ?>


            <div class="page-wrapper">
                

                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h3 class="text-primary">Dashboard</h3>
                    </div>
                </div>

                <div class="container-fluid">




                    <div class="col-lg-12">
                        <div class="card card-outline-primary">

                            <h4 class="m-b-0 ">Update Plans</h4>

                            <div class="card-body">
                                
                                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
                                    <input type="hidden" name="plan_id" value="<?php echo $plan_row['plan_id']; ?>">
                                    <label for="name">Plan Name:</label><br>
                                    <input type="text" id="name" name="name" value="<?php echo $plan_row['name']; ?>"><br><br>
                                    <label for="description">Plan Description:</label><br>
                                    <textarea id="description" name="description"><?php echo $plan_row['description']; ?></textarea><br><br>
                                    <label for="price">Plan Price:</label><br>
                                    <input type="text" id="price" name="price" value="<?php echo $plan_row['price']; ?>"><br><br>
                                    <input type="submit" value="Update Plan">
                                </form>
                            </div>
                        </div>
                    </div>
                <?php include "include/footer.php" ?>
                </div>

            </div>


        </div>

        </div>

        <script src="js/lib/jquery/jquery.min.js"></script>
        <script src="js/lib/bootstrap/js/popper.min.js"></script>
        <script src="js/lib/bootstrap/js/bootstrap.min.js"></script>
        <script src="js/jquery.slimscroll.js"></script>
        <script src="js/sidebarmenu.js"></script>
        <script src="js/lib/sticky-kit-master/dist/sticky-kit.min.js"></script>
        <script src="js/custom.min.js"></script>

    </body>


</html>
