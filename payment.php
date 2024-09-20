<?php
// Include your database connection file
include("connection/connect.php");

if (isset($_GET['user_id']) && !empty($_GET['user_id'])) {
    // Sanitize the user_id to prevent SQL injection
    $user_id = mysqli_real_escape_string($db, $_GET['user_id']);
    
    // Execute the query
    $query = "SELECT * FROM users WHERE u_id = '$user_id'";
    $result = $db->query($query);

    // Check if the query was successful
    if ($result) {
        // Fetch the row
        $user = $result->fetch_assoc();
        // Check if user exists
        if ($user) {
            // User exists, continue with the rest of your code
        } else {
            // Handle case where user does not exist
            echo "User not found.";
            exit;
        }
    } else {
        // Handle case where query execution failed
        echo "Failed to retrieve user details: " . $db->error;
        exit;
    }
} else {
    // Handle case where user_id is not provided or empty
    echo '<script>alert("Login first to subscribe this plan."); window.location.href = "login.php";</script>';
    exit;
}

// Check if user is logged in
session_start();
if (empty($_SESSION["user_id"])) {
    // Redirect to login page if user is not logged in
    header("Location: login.php");
    exit;
}

// Check if plan_id is provided in the URL parameter
if (isset($_GET['plan_id'])) {
    // Retrieve plan_id from the URL parameter
    $plan_id = $_GET['plan_id'];
} else {
    // Handle case where plan_id is not provided
    echo "Plan ID is required.";
    exit;
}

// Check if the user is already subscribed to the same plan
$subscription_check_query = "SELECT * FROM subscriptions WHERE user_id = $user_id AND plan_id = $plan_id AND status = 'active'";
$subscription_check_result = $db->query($subscription_check_query);

// Check if the user is already subscribed to the same plan and the subscription status is active
if ($subscription_check_result->num_rows > 0) {
    // User is already subscribed to the same plan
    echo '<script>alert("You are already subscribed to this plan."); window.location.href = "index.php";</script>';
    exit;
}

// Retrieve plan price from subscription_plans table based on plan_id
$query = "SELECT * FROM subscription_plans WHERE plan_id = $plan_id";
$result = $db->query($query);

// Check if the query was successful
if ($result) {
    // Fetch the row
    $row = $result->fetch_assoc();
    // Extract price
    $plan = $row['name'];
    $price = $row['price'];
} else {
    // Handle case where plan price retrieval failed
    echo "Failed to retrieve plan price.";
    exit;
}

// Close the database connection
$db->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <style>
        .payment img {
            height: 100vh;
            width: 100vw;
            object-fit: cover;
            position: absolute;
        }
        .card{
            background-color: #F2E2ED;
            color: #d3d3d3;
            box-sizing: border-box;
            border-radius: 10px;
            box-shadow: 2px 2px 2px black;
        }
    </style>
</head>

<body>
    <div class="payment" style="background-color: #E3A7C0;">
        <img src="./images/img/back.jpg" alt="">
        <div class="container pay-div">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card mt-5" style="color: #353D70;">
                        <div class="card-header">
                            <h3 class="card-title text-center mt-3">Payment Details</h3>
                        </div>
                        <div class="card-body">
                            <!-- Display user details -->
                            <h5>User Details:</h5>
                            <p><strong>First Name:</strong> <?php echo $user['f_name']; ?></p>
                            <p><strong>Last Name:</strong> <?php echo $user['l_name']; ?></p>
                            <p><strong>Phone:</strong> <?php echo $user['phone']; ?></p>
                            <p><strong>Email:</strong> <?php echo $user['email']; ?></p>

                            <!-- Display plan details -->
                            <h5 class="mt-2">Plan Details:</h5>
                            <p><strong>Plan:</strong> <?php echo $plan; ?> </p>
                            <p><strong>Price:</strong> ₹<?php echo $price; ?> monthly</p>

                            <!-- Form to submit payment -->
                            <form action="payment_process.php" method="post">
                                <!-- Hidden fields for user_id, plan_id, and amount -->
                                <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                                <input type="hidden" name="plan_id" value="<?php echo $plan_id; ?>">
                                <input type="hidden" name="amount" value="<?php echo $price; ?>">

                                <!-- Payment method selection -->
                                <div class="form-group">
                                    <label for="paymentMethod">Payment Method:</label>
                                    <select class="form-control" name="paymentMethod" id="paymentMethod">
                                        <option value="cashondelivery">Cash on Delivery</option>
                                        <!-- Add more payment options if needed -->
                                    </select>
                                    <small class="form-text text-muted">
                                        Please note that selecting "Cash on Delivery" means you will pay in cash when the food is delivered, typically on the first day of food delivery.
                                    </small>
                                </div>


                                <button type="submit" class="btn btn-primary btn-block">Proceed to Payment</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
