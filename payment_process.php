<?php
session_start();
include("connection/connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'];
    $plan_id = $_POST['plan_id'];
    $price = $_POST['price'];
    $paymentMethod = $_POST['paymentMethod'];

    // Process the payment here
    // For demonstration purposes, let's assume the payment is successful
    $payment_success = true;

    if ($payment_success) {
        // Update the subscriptions table in the database
        $start_date = date("Y-m-d");
        $end_date = date("Y-m-d", strtotime("+1 month"));
        $status = 'active'; // Assuming payment success means subscription is active

        $insert_query = "INSERT INTO subscriptions (user_id, plan_id, start_date, end_date, status) 
                        VALUES ('$user_id', '$plan_id', '$start_date', '$end_date', '$status')";
        $insert_result = $db->query($insert_query);

        if ($insert_result) {
            header("Location: payment_success.php");
            exit;
        } else {
            header("Location: payment_error.php");
            exit;
        }
    } else {
        header("Location: payment_error.php");
        exit;
    }
} else {
    header("Location: payment.php");
    exit;
}
?>
