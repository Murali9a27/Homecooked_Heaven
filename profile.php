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

    // Fetch user subscription details with plan name
    $subscription_query = "SELECT s.*, p.name AS plan_name FROM subscriptions s INNER JOIN subscription_plans p ON s.plan_id = p.plan_id WHERE user_id = $user_id";
    $subscription_result = $db->query($subscription_query);

    // Close database connection
    $db->close();
    ?>

 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>User Profile</title>
     <link href="css/bootstrap.min.css" rel="stylesheet">
     <link href="css/style.css" rel="stylesheet">
     <style>
         .box {
             display: flex;
             justify-content: center;
             margin-top: 100px;

         }

         .card {
             border-radius: 5px;
             box-shadow: 0 1px 20px 0 rgba(69, 90, 100, 0.08);
             width: 55rem;
         }

         .bg-c-lite-green {
             background: linear-gradient(to right, #ee5a6f, #f29263);
             height: 100%;
         }

         .text-muted {
             color: #919aa3 !important;
         }
     </style>

 </head>

 <body>
     <div class="container-fluid" style="margin: 0; padding: 0;">
         <?php include "include/header.php" ?>
     </div>

     <div class="box">
         <div class="row card">
             <div class="col-sm-4 bg-c-lite-green">
                 <div class="text-white" style="text-align: center; margin-top: 200px">
                     <div class="mb-3">
                         <img src="https://cdn.picpng.com/icon/icon-business-user-51495.png" height="150px" alt="puser-profile-Image" />
                     </div>
                     <?php
                        if ($user_result && $user_result->num_rows > 0) {
                            $user = $user_result->fetch_assoc(); ?>
                         <h6><?php echo $user['username']; ?></h6>
                         
                 </div>
             </div>
             <div class="col-sm-8 pl-3">
                 <h4 class="p-2">Information</h4>
                 <div class="row">
                     <div class="col-sm-6">
                         <h6>Name</h6>
                         <h6 class="text-muted mb-1"><?php echo $user['f_name'] . ' ' . $user['l_name']; ?></h6>
                     </div>
                     <div class="col-sm-6">
                         <h6>Phone</h6>
                         <h6 class="text-muted mb-1"><?php echo $user['phone']; ?></h6>
                     </div>
                 </div>
                 <div class="row">
                     <div class="col-sm-6">
                         <h6>Email</h6>
                         <h6 class="text-muted mb-1"><?php echo $user['email']; ?></h6>
                     </div>
                     <div class="col-sm-6">
                         <h6>Address</h6>
                         <h6 class="text-muted mb-1"><?php echo $user['address'] . ',' . $user['pincode']; ?></h6>
                     </div>
                 </div>
                 <a href="edit_profile.php" class="btn btn-secondary mb-1">Edit Profile</a>
             <?php
                        } else { ?>
                 <p>No user details found.</p>
             <?php
                        } ?>

             <h4 class="p-2">Plan</h4>
             <?php
                if ($subscription_result && $subscription_result->num_rows > 0) {
                    while ($subscription = $subscription_result->fetch_assoc()) { ?>


                     <div class="row">
                         <div class="col-sm-6">
                             <h6>Type</h6>
                             <h6 class="text-muted mb-1"><?php echo $subscription['plan_name']; ?></h6>
                         </div>
                         <div class="col-sm-6">
                             <h6>Status</h6>
                             <h6 class="text-muted mb-1"><?php echo $subscription['status']; ?></h6>
                         </div>
                     </div>
                     <div class="row">
                         <div class="col-sm-6">
                             <h6>Start</p>
                             <h6 class="text-muted mb-1"><?php echo $subscription['start_date']; ?></h6>
                         </div>
                         <div class="col-sm-6">
                             <h6>End</h6>
                             <h6 class="text-muted mb-1"> <?php echo $subscription['status']; ?></h6>
                         </div>
                     </div>
                 <?php
                    }
                } else { ?>
                 <p>No subscription details found.</p>
             <?php
                } ?>
             </div>
         </div>
     </div>


     <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
 </body>

 </html>