<?php
    // Start session
    session_start();

    // Check if user is logged in
    if (!isset($_SESSION["user_id"])) {
        // Redirect to login page if user is not logged in
        header("Location: login.php");
        exit;
    }

    // Database connection
    include("connection/connect.php"); // Include your database connection file


    // Retrieve subscription plans from the database
    $plan_query = "SELECT * FROM subscription_plans";
    $plan_result = $db->query($plan_query);

    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get subscription plan ID from the form
        $plan_id = $_POST["plan_id"];

        // Get user ID from session
        $user_id = $_SESSION["user_id"];

        // Get current date
        $start_date = date("Y-m-d");

        // Calculate end date (for demonstration, assuming a monthly subscription)
        $end_date = date("Y-m-d", strtotime("+1 month"));

        // Status of the subscription (for demonstration, assuming it's active)
        if ($end_date > date("Y-m-d")) {
            // If end date is greater, set status to "active"
            $status = "active";
        } else {
            // Otherwise, set status to "not active"
            $status = "not active";
        }

        // Insert subscription into the database
        $sql = "INSERT INTO subscriptions (user_id, plan_id, start_date, end_date, status) VALUES ('$user_id', '$plan_id', '$start_date', '$end_date', '$status')";

        if ($db->query($sql) === TRUE) {
            echo "Subscription saved successfully";
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
    <meta charset="UTF-8">
    <title>Subscribe</title>
    <!-- Include any CSS stylesheets here -->
</head>
<body>
    <section>
        <h2>Select Subscription Plan</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="plan_id">Subscription Plan:</label>
            <select id="plan_id" name="plan_id">
                <?php
                // Populate dropdown options with subscription plans from the database
                while ($row = $plan_result->fetch_assoc()) {
                    echo "<option value='" . $row['plan_id'] . "'>" . $row['name'] . "</option>";
                }
                ?>
            </select><br><br>

            <input type="submit" value="Subscribe">
        </form>
    </section>
    
</body>
</html>
