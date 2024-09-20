<?php
// Start session
session_start();

// Check if admin is logged in
if (!isset($_SESSION["admin_id"])) {
    // Redirect to login page if admin is not logged in
    header("Location: login.php");
    exit;
}

// Database connection
include("../connection/connect.php"); // Include your database connection file
error_reporting(0);
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST["name"];
    $description = $_POST["description"];
    $price = $_POST["price"];

    // Insert subscription plan into the database
    $sql = "INSERT INTO subscription_plans (name, description, price) VALUES ('$name', '$description', '$price')";

    if ($db->query($sql) === TRUE) {
        echo "Subscription plan created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $db->error;
    }

    // Close connection
    $db->close();
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
    <title>Add Restaurant</title>
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
            <div class="container-fluid">
               


                <!-- Plan form -->
                <div class="col-lg-12">
                    <div class="card card-outline-primary">
                        <div class="card-header">
                            <h4 class="m-b-0 text-white">Add New Plan</h4>
                        </div>
                        <div class="card-body">
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                                <div class="form-body">

                                    <hr>
                                    <div class="row p-t-20">
                                        <div class="col-md-6">
                                            <div class="form-group">
        
        
                                                <label for="name" class="control-label">Plan Name:</label>
                                                <input type="text" id="name" name="name" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row p-t-20">

                                        <div class="col-md-6">
                                            <div class="form-group has-danger">
                                                <label class="control-label" for="description">Description:</label>
                                                <textarea id="description" name="description"  class="form-control form-control-danger"></textarea>
                                            </div>
                                        </div>


                                    </div>

                                    <div class="row p-t-20">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="price" class="control-label">Price: </label>
                                                <input type="text" id="price" name="price" class="form-control">
                                            </div>
                                        </div>
                                    </div>


                                    

                                    


                                </div>
                                <div class="form-actions">
                                    <input type="submit" name="submit" class="btn btn-primary" value="Create Plan">
                                    <a href="add_plan.php" class="btn btn-inverse">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php include "include/footer.php" ?>
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
