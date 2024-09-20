
<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php");  
error_reporting(0);  
session_start(); 


?>


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="#">
    <title>Home || Homecooked Heaven</title>
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    
    <!-- subcribre -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <style>
    .menu-card, .menu-card>.card-header {
      background: linear-gradient(90deg, rgb(229, 132, 58) 0%,
       rgb(236, 165, 34) 61%);
      margin-bottom: 3px;
    }
    .sub-text {
      color: rgb(255, 115, 0);
      font-weight: 700;
    }
    


  </style>
</head>



<body class="home">

    <?php include "include/header.php" ?>
   
    <!-- hero section -->

    <section class="hero bg-image" data-image-src="images/img/bread.jpg">
        <div class="hero-inner">
            <div class="container text-center hero-text font-white">
                <h1>Homecooked Heaven </h1>

                <div class="steps">
                    <div class="step-item step1">
                        <h4><span style="color:white;">Bringing Homemade Goodness to Your Door Step. </span></h4>
                    </div>
                    
                </div>

            </div>
        </div>

    </section>

    

    <!-- dishes of month -->


    <section class="popular">
        <div class="container">
            <div class="title text-xs-center m-b-30">
                <h2>Popular Dishes</h2>
                <!-- <p class="lead">Easiest way to order your favourite food among these top 6 dishes</p> -->
            </div>
            <div class="row">

            <!-- search functionalities -->
                            

            <!-- end search -->
                <?php
                // Fetch popular dishes from the database
                $query_res = mysqli_query($db, "SELECT * FROM dishes LIMIT 6");
                while ($r = mysqli_fetch_array($query_res)) {
                    // Display each dish as a card
                    echo '<div class="col-xs-12 col-sm-6 col-md-4 food-item">';
                        echo '<div class="food-item-wrap">';
                            echo '<div class="figure-wrap bg-image" data-image-src="admin/Res_img/dishes/' . $r['img'] . '"></div>';
                                echo '<div class="content">';
                                    echo '<h5><a href="dishes.php?res_id=' . $r['rs_id'] . '">' . $r['title'] . '</a></h5>';
                                    echo '<div class="product-name">' . $r['slogan'] . '</div>';
                                    echo '<div class="price-btn-block">';
                                    echo '<span class="price">₹' . $r['price'] . '</span>';
                                    echo '<a href="dishes.php?res_id=' . $r['rs_id'] . '" class="btn btn-bg-secondary pull-right">Order Now</a>';
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </section>

    <!-- vendors specialist -->

    <section class="vendors-special m-b-30 space-sm " data-image-src="images/img/bread.jpg">
        <h1 class="m-b-30 space-sm " style="color: #e0e0e0;">Enjoy Our Delicious Specialities of Our Home Chefs.</h1>
  
        <div class="row  specialities" >
            <?php  
                // Select one dish from every restaurant
            $query = "SELECT dishes.*, restaurant.title AS restaurant_name 
            FROM dishes 
            INNER JOIN restaurant ON dishes.rs_id = restaurant.rs_id 
            GROUP BY dishes.rs_id ORDER BY dishes.rs_id DESC LIMIT 3" ;
            $result = mysqli_query($db, $query);

            // Display the results
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="col-lg-4">';
                echo '<img src="admin/Res_img/dishes/'.$row['img'].'" style="border-radius:50%" width="200px" height="200px" alt="dishes photo">';  
                //<a class="restaurant-logo" href="dishes.php?res_id='.$row['rs_id'].'" > <img src="admin/Res_img/dishes/'.$row['img'].'" alt="dishs photo"> </a>
                
                echo "<h2 class='' style='color: white'>{$row['title']}</h2>";
                // echo '<p>Restaurant: '.$row['restaurant_name'].'</p>'; 
                echo '<a href="dishes.php?res_id=' . $row['rs_id'] . '" class=" " style:"color:#fcfcfc"><h4>'.$row['restaurant_name'].'</h4></a>';   
                echo '</div>';

            }
            
            ?>


            

            
            
        </div>
    </section>

    

    <!-- subscribe plans -->
    <hr><hr>

    <section>
        <div>
        <p class="m-t-20 " style="text-align: center; font-size:2rem">Our Menu</p>

        <div class="container mt-3">
            <div class="row">
            <div class="col-md-6" style="text-align:center">
                <p class="mb-2" style="font-size: 1.5rem; text-align:center">Veg Package</p>
                <div id="accordion">
                <!-- Veg Package menu cards -->
                
                    <div class="menu-card card">
                    <div class="card-header " id="headingOne">
                        <h5 class="mb-0">
                        <h3  data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Monday
                        </h3>
                        </h5>
                    </div>
                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                        <p>
                            <b>Lunch</b>: Rice, Dal, Veg Curry, Bhaja, Salad <br />
                            <b>Dinner</b>: Roti (4 pcs), Chana Masala
                        </p>
                        </div>
                    </div>
                    </div>
                    <div class="menu-card card">
                    <div class="card-header text-center" id="headingTwo">
                        <h5 class="mb-0">
                        <h3  data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Tuesday
                        </h3>
                        </h5>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                        <div class="card-body">
                        <p>
                            <b>Lunch</b>: Rice, Dal, Mushroom Curry, Bhaja, Papad, Salad <br />
                            <b>Dinner</b>: Roti(4pcs), Mixed Veg Curry
                        </p>
                        </div>
                    </div>
                    </div>
                    <div class="menu-card card">
                    <div class="card-header text-center" id="headingThree">
                        <h5 class="mb-0">
                        <h3  data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Wednesday
                        </h3>
                        </h5>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                        <div class="card-body">
                        <p>
                            <b>Lunch</b>: Rice, Dal, Veg curry, Chips, Salad <br />
                            <b>Dinner</b>: Roti (4pcs), Veg Curry
                        </p>
                        </div>
                    </div>
                    </div>
                    <div class="menu-card card">
                    <div class="card-header text-center" id="headingFour">
                        <h5 class="mb-0">
                        <h3  data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                            Thursday
                        </h3>
                        </h5>
                    </div>
                    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                        <div class="card-body">
                        <p>
                            <b>Lunch</b>: Rice, Dal, Paneer, Alu Bharta, Khatta <br />
                            <b>Dinner</b>: Roti/Paratha/Poori (4pcs), Santula/Mix Curry
                        </p>
                        </div>
                    </div>
                    </div>
                    <div class="menu-card card">
                    <div class="card-header text-center" id="headingFive">
                        <h5 class="mb-0">
                        <h3  data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                            Friday
                        </h3>
                        </h5>
                    </div>
                    <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
                        <div class="card-body">
                        <p>
                            <b>Lunch</b>: Rice, Dal, Veg Curry, Mix Bhaja, Salad, Papad <br />
                            <b>Dinner</b>: Roti (4pcs), Veg Tadka
                        </p>
                        </div>
                    </div>
                    </div>
                    <div class="menu-card card">
                    <div class="card-header text-center" id="headingSix">
                        <h5 class="mb-0">
                        <h3  data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                            Saturday
                        </h3>
                        </h5>
                    </div>
                    <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordion">
                        <div class="card-body">
                        <p>
                            <b>Lunch</b>: Rice, Dal, Veg Curry, Khata, Saga, Baigan Bharta <br />
                            <b>Dinner</b>: Roti (4pcs), Aloo Matar Curry
                        </p>
                        </div>
                    </div>
                    </div>
                    <div class="menu-card card">
                    <div class="card-header text-center" id="headingSeven">
                        <h5 class="mb-0">
                        <h3  data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                            Sunday
                        </h3>
                        </h5>
                    </div>
                    <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-parent="#accordion">
                        <div class="card-body">
                        <p>
                            <b>Lunch</b>: Reera Rice/Plain Rice, Dal, Paneer Curry, Mix Bhaja, Dahi Salad <br />
                            <b>Dinner</b>: Roti (4pcs), Dalma
                        </p>
                        </div>
                    </div>
                    </div>

                </div>
            </div>
            <div class="col-md-6" style="text-align:center">
                <p class=" mb-2" style="font-size: 1.5rem;">Non-veg Package</p>
                <div id="accordion1">
                <!-- Non-veg Package menu cards -->
                <!-- Include your menu cards here -->
                    <div class="menu-card card">
                        <div class="card-header text-center" id="heading8">
                            <h5 class="mb-0">
                            <h3  data-toggle="collapse" data-target="#collapse8" aria-expanded="true" aria-controls="collapse8">
                                Monday
                            </h3>
                            </h5>
                        </div>
                        <div id="collapse8" class="collapse" aria-labelledby="heading8" data-parent="#accordion1">
                            <div class="card-body">
                            <p>
                                <b>Lunch</b>: Rice, Dal, Veg Curry, Bhaja, Salad <br />
                                <b>Dinner</b>: Roti (4 pcs), Chana Masala
                            </p>
                        </div>
                    </div>
                    </div>
                    

                    <div class="menu-card card">
                    <div class="card-header text-center" id="heading9">
                        <h5 class="mb-0">
                        <h3  data-toggle="collapse" data-target="#collapse9" aria-expanded="false" aria-controls="collapse9">
                            Tuesday
                        </h3>
                        </h5>
                    </div>
                    <div id="collapse9" class="collapse" aria-labelledby="heading9" data-parent="#accordion1">
                        <div class="card-body">
                        <p>
                            <b>Lunch</b>: Rice, Dal, Mushroom Curry, Bhaja, Papad, Salad <br />
                            <b>Dinner</b>: Roti(4pcs), Mixed Veg Curry
                        </p>
                        </div>
                    </div>
                    </div>

                    <div class="menu-card card">
                    <div class="card-header text-center" id="heading10">
                        <h5 class="mb-0">
                        <h3  data-toggle="collapse" data-target="#collapse10" aria-expanded="false" aria-controls="collapse10">
                            Wednesday
                        </h3>
                        </h5>
                    </div>
                    <div id="collapse10" class="collapse" aria-labelledby="heading10" data-parent="#accordion1">
                        <div class="card-body">
                        <p>
                            <b>Lunch</b>: Rice, Dal, Fish Curry, Chips, Salad <br />
                            <b>Dinner</b>: Roti/Poori(4pcs), Egg Curry/Bhujia
                        </p>
                        </div>
                    </div>
                    </div>

                    <div class="menu-card card">
                    <div class="card-header text-center" id="heading11">
                        <h5 class="mb-0">
                        <h3  data-toggle="collapse" data-target="#collapse11" aria-expanded="false" aria-controls="collapse11">
                            Thursday
                        </h3>
                        </h5>
                    </div>
                    <div id="collapse11" class="collapse" aria-labelledby="heading11" data-parent="#accordion1">
                        <div class="card-body">
                        <p>
                            <b>Lunch</b>: Rice, Dal, Paneer, Alu Bharta, Khatta <br />
                            <b>Dinner</b>: Roti/Paratha/Poori (4pcs), Santula/Mix Curry
                        </p>
                        </div>
                    </div>
                    </div>

                    <div class="menu-card card">
                    <div class="card-header text-center" id="heading12">
                        <h5 class="mb-0">
                        <h3  data-toggle="collapse" data-target="#collapse12" aria-expanded="false" aria-controls="collapse12">
                            Friday
                        </h3>
                        </h5>
                    </div>
                    <div id="collapse12" class="collapse" aria-labelledby="heading12" data-parent="#accordion1">
                        <div class="card-body">
                        <p>
                            <b>Lunch</b>: Rice, Dal, Chicken Curry, Mix Bhaja, Salad, Papad <br />
                            <b>Dinner</b>: Roti (4pcs), Egg Tadka
                        </p>
                        </div>
                    </div>
                    </div>

                    <div class="menu-card card">
                    <div class="card-header text-center" id="heading13">
                        <h5 class="mb-0">
                        <h3  data-toggle="collapse" data-target="#collapse13" aria-expanded="false" aria-controls="collapse13">
                            Saturday
                        </h3>
                        </h5>
                    </div>
                    <div id="collapse13" class="collapse" aria-labelledby="heading13" data-parent="#accordion1">
                        <div class="card-body">
                        <p>
                            <b>Lunch</b>: Rice, Dal, Veg Curry, Khata, Saga, Baigan Bharta <br />
                            <b>Dinner</b>: Roti (4pcs), Aloo Matar Curry
                        </p>
                        </div>
                    </div>
                    </div>

                    <div class="menu-card card">
                    <div class="card-header text-center" id="heading14">
                        <h5 class="mb-0">
                        <h3  data-toggle="collapse" data-target="#collapse14" aria-expanded="false" aria-controls="collapse14">
                            Sunday
                        </h3>
                        </h5>
                    </div>
                    <div id="collapse14" class="collapse" aria-labelledby="heading14" data-parent="#accordion1">
                        <div class="card-body">
                        <p>
                            <b>Lunch</b>: Jeera Rice/Plain Rice, Dal, Egg Curry, Mix Bhaja, Dahi Salad <br />
                            <b>Dinner</b>: Roti (4pcs), Chingudi Dalma
                        </p>
                        </div>
                    </div>
                    </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- delivery timing -->
        <hr><hr>
        <div class="text-center mt-5">
            <p class="m-t-20" style="text-align: center; font-size:2rem" >Delivery Timing</p>
        </div>
        <div class="container mt-2">
            <div class="row">
            <div class="col-lg-6">
                <img src="./images/img/lunch.jpg" style="height: 500px; width:100%; object-fit: fill;">
            </div>
            <div class="col-lg-6">
                <img src="./images/img/dinner.jpg" style="height: 500px; width: 100%; object-fit: fill;">
            </div>
            </div>
        </div>

        <!-- subscription -->
        <hr><hr>
        <div class="text-center m-4">
            <p class="m-t-20" style="text-align: center; font-size:2rem">Subscription Plans</p>
        </div>
        <?php
            


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
        <div class="container">
            <div class="row" style="text-align: center;">
                <?php
                // Populate dropdown options with subscription plans from the database
                while ($row = $plan_result->fetch_assoc()) {
                    echo '
                        <div class="col-md-3">
                            <div class="card mb-4 rounded-3 shadow-sm">
                                <div class="card-header py-3">
                                    <h3 class="my-0 sub-text">' . $row['name'] . '</h3>
                                    <p>' . $row['description'] . '</p>
                                </div>
                                <div class="card-body m-1">
                                    <h1 class="card-title pricing-card- sub-text">
                                        <sup>₹</sup>' . intval($row['price']) . '<small class="text-body-secondary fw-light sub-text fs-4"><sup>monthly</sup></small>
                                    </h1>
                                    <ul class="list-unstyled ">
                                        <li><i class="fa-solid fa-circle-check"></i> Veg and Non-veg options available</li>
                                        <hr />
                                        <li><i class="fa-solid fa-circle-check"></i> Free Home Delivery</li>
                                    </ul>
                                    <a href="payment.php?plan_id='. $row['plan_id'] .'&user_id=' . $_SESSION['user_id'] . '" class="btn btn-lg" style="background-color: rgb(255, 115, 0); color: white; text-decoration: none; font-weight: bold;">Subscribe</a>
                                </div>
                            </div>
                        </div>';
                }
                ?>
            </div>
        </div>

        </div>
    </section>

    
    



    <!-- sumcription plan ends -->
    

    <!-- How it works -->
    

    <section class="how-it-works">
        <div class="container">
            <div class="text-xs-center">
                <h2>Easy to Order</h2>
                <div class="row how-it-works-solution">
                    <div class="col-xs-12 col-sm-12 col-md-4 how-it-works-steps white-txt col1">
                        <div class="how-it-works-wrap">
                            <div class="step step-1">
                                <div class="icon" data-step="1">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 483 483" width="512" height="512">
                                        <g fill="#FFF">
                                            <path d="M467.006 177.92c-.055-1.573-.469-3.321-1.233-4.755L407.006 62.877V10.5c0-5.799-4.701-10.5-10.5-10.5h-310c-5.799 0-10.5 4.701-10.5 10.5v52.375L17.228 173.164a10.476 10.476 0 0 0-1.22 4.938h-.014V472.5c0 5.799 4.701 10.5 10.5 10.5h430.012c5.799 0 10.5-4.701 10.5-10.5V177.92zM282.379 76l18.007 91.602H182.583L200.445 76h81.934zm19.391 112.602c-4.964 29.003-30.096 51.143-60.281 51.143-30.173 0-55.295-22.139-60.258-51.143H301.77zm143.331 0c-4.96 29.003-30.075 51.143-60.237 51.143-30.185 0-55.317-22.139-60.281-51.143h120.518zm-123.314-21L303.78 76h86.423l48.81 91.602H321.787zM97.006 55V21h289v34h-289zm-4.198 21h86.243l-17.863 91.602h-117.2L92.808 76zm65.582 112.602c-5.028 28.475-30.113 50.19-60.229 50.19s-55.201-21.715-60.23-50.19H158.39zM300 462H183V306h117v156zm21 0V295.5c0-5.799-4.701-10.5-10.5-10.5h-138c-5.799 0-10.5 4.701-10.5 10.5V462H36.994V232.743a82.558 82.558 0 0 0 3.101 3.255c15.485 15.344 36.106 23.794 58.065 23.794s42.58-8.45 58.065-23.794a81.625 81.625 0 0 0 13.525-17.672c14.067 25.281 40.944 42.418 71.737 42.418 30.752 0 57.597-17.081 71.688-42.294 14.091 25.213 40.936 42.294 71.688 42.294 24.262 0 46.092-10.645 61.143-27.528V462H321z" />
                                            <path d="M202.494 386h22c5.799 0 10.5-4.701 10.5-10.5s-4.701-10.5-10.5-10.5h-22c-5.799 0-10.5 4.701-10.5 10.5s4.701 10.5 10.5 10.5z" />
                                        </g>
                                    </svg>
                                </div>
                                <h3>Choose a restaurant</h3>
                                <p>We"ve got your covered with menus from a variety of delivery restaurants online.</p>
                            </div>
                        </div>
                    </div>
                    

                    <div class="col-xs-12 col-sm-12 col-md-4 how-it-works-steps white-txt col2">
                        <div class="step step-2">
                            <div class="icon" data-step="2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewbox="0 0 380.721 380.721">
                                    <g fill="#FFF">
                                        <path d="M58.727 281.236c.32-5.217.657-10.457 1.319-15.709 1.261-12.525 3.974-25.05 6.733-37.296a543.51 543.51 0 0 1 5.449-17.997c2.463-5.729 4.868-11.433 7.25-17.01 5.438-10.898 11.491-21.07 18.724-29.593 1.737-2.19 3.427-4.328 5.095-6.46 1.912-1.894 3.805-3.747 5.676-5.588 3.863-3.509 7.221-7.273 11.107-10.091 7.686-5.711 14.529-11.137 21.477-14.506 6.698-3.724 12.455-6.982 17.631-8.812 10.125-4.084 15.883-6.141 15.883-6.141s-4.915 3.893-13.502 10.207c-4.449 2.917-9.114 7.488-14.721 12.147-5.803 4.461-11.107 10.84-17.358 16.992-3.149 3.114-5.588 7.064-8.551 10.684-1.452 1.83-2.928 3.712-4.427 5.6a1225.858 1225.858 0 0 1-3.84 6.286c-5.537 8.208-9.673 17.858-13.995 27.664-1.748 5.1-3.566 10.283-5.391 15.534a371.593 371.593 0 0 1-4.16 16.476c-2.266 11.271-4.502 22.761-5.438 34.612-.68 4.287-1.022 8.633-1.383 12.979 94 .023 166.775.069 268.589.069.337-4.462.534-8.97.534-13.536 0-85.746-62.509-156.352-142.875-165.705 5.17-4.869 8.436-11.758 8.436-19.433-.023-14.692-11.921-26.612-26.631-26.612-14.715 0-26.652 11.92-26.652 26.642 0 7.668 3.265 14.558 8.464 19.426-80.396 9.353-142.869 79.96-142.869 165.706 0 4.543.168 9.027.5 13.467 9.935-.002 19.526-.002 28.926-.002zM0 291.135h380.721v33.59H0z" />
                                    </g>
                                </svg>
                            </div>
                            <h3>Choose a dish</h3>
                            <p>We"ve got your covered with a variety of delivery restaurants online.</p>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4 how-it-works-steps white-txt col3">
                        <div class="step step-3">
                            <div class="icon" data-step="3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewbox="0 0 612.001 612">
                                    <path d="M604.131 440.17h-19.12V333.237c0-12.512-3.776-24.787-10.78-35.173l-47.92-70.975a62.99 62.99 0 0 0-52.169-27.698h-74.28c-8.734 0-15.737 7.082-15.737 15.738v225.043h-121.65c11.567 9.992 19.514 23.92 21.796 39.658H412.53c4.563-31.238 31.475-55.396 63.972-55.396 32.498 0 59.33 24.158 63.895 55.396h63.735c4.328 0 7.869-3.541 7.869-7.869V448.04c-.001-4.327-3.541-7.87-7.87-7.87zM525.76 312.227h-98.044a7.842 7.842 0 0 1-7.868-7.869v-54.372c0-4.328 3.541-7.869 7.868-7.869h59.724c2.597 0 4.957 1.259 6.452 3.305l38.32 54.451c3.619 5.194-.079 12.354-6.452 12.354zM476.502 440.17c-27.068 0-48.943 21.953-48.943 49.021 0 26.99 21.875 48.943 48.943 48.943 26.989 0 48.943-21.953 48.943-48.943 0-27.066-21.954-49.021-48.943-49.021zm0 73.495c-13.535 0-24.472-11.016-24.472-24.471 0-13.535 10.937-24.473 24.472-24.473 13.533 0 24.472 10.938 24.472 24.473 0 13.455-10.938 24.471-24.472 24.471zM68.434 440.17c-4.328 0-7.869 3.543-7.869 7.869v23.922c0 4.328 3.541 7.869 7.869 7.869h87.971c2.282-15.738 10.229-29.666 21.718-39.658H68.434v-.002zm151.864 0c-26.989 0-48.943 21.953-48.943 49.021 0 26.99 21.954 48.943 48.943 48.943 27.068 0 48.943-21.953 48.943-48.943.001-27.066-21.874-49.021-48.943-49.021zm0 73.495c-13.534 0-24.471-11.016-24.471-24.471 0-13.535 10.937-24.473 24.471-24.473s24.472 10.938 24.472 24.473c0 13.455-10.938 24.471-24.472 24.471zm117.716-363.06h-91.198c4.485 13.298 6.846 27.54 6.846 42.255 0 74.28-60.431 134.711-134.711 134.711-13.535 0-26.675-2.045-39.029-5.744v86.949c0 4.328 3.541 7.869 7.869 7.869h265.96c4.329 0 7.869-3.541 7.869-7.869V174.211c-.001-13.062-10.545-23.606-23.606-23.606zM118.969 73.866C53.264 73.866 0 127.129 0 192.834s53.264 118.969 118.969 118.969 118.97-53.264 118.97-118.969-53.265-118.968-118.97-118.968zm0 210.864c-50.752 0-91.896-41.143-91.896-91.896s41.144-91.896 91.896-91.896c50.753 0 91.896 41.144 91.896 91.896 0 50.753-41.143 91.896-91.896 91.896zm35.097-72.488c-1.014 0-2.052-.131-3.082-.407L112.641 201.5a11.808 11.808 0 0 1-8.729-11.396v-59.015c0-6.516 5.287-11.803 11.803-11.803 6.516 0 11.803 5.287 11.803 11.803v49.971l29.614 7.983c6.294 1.698 10.02 8.177 8.322 14.469-1.421 5.264-6.185 8.73-11.388 8.73z" fill="#FFF" />
                                </svg>
                            </div>
                            <h3>Pick up or Delivery</h3>
                            <p>Get your food delivered! And enjoy your meal! </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 text-center">
                    <p class="pay-info">Cash on Delivery</p>
                </div>
            </div>
        </div>
    </section>

    <!-- featured restaurants -->

    <section class="featured-restaurants">
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="title-block pull-left">
                        <h4>Featured Restaurants</h4>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="restaurants-filter pull-right">
                        <nav class="primary pull-left">
                            <ul>
                                <li><a href="#" class="selected" data-filter="*">all</a> </li>
                                <?php 
									$res= mysqli_query($db,"select * from res_category");
									      while($row=mysqli_fetch_array($res))
										  {
											echo '<li><a href="#" data-filter=".'.$row['r.title'].'"> '.$row['d.title'].'</a> </li>';
										  }
								?>

                            </ul>
                        </nav>
                    </div>

                </div>
            </div>
            

            <div class="row">
                <div class="restaurant-listing">


                    <?php  
						$ress= mysqli_query($db,"select * from restaurant");  
									      while($rows=mysqli_fetch_array($ress))
										  {
													
													$query= mysqli_query($db,"select * from res_category where c_id='".$rows['c_id']."' ");
													 $rowss=mysqli_fetch_array($query);
						
													 echo ' <div class="col-xs-12 col-sm-12 col-md-6 single-restaurant all '.$rowss['c_name'].'">
                                                                <div class="restaurant-wrap">
                                                                    <div class="row">
                                                                        <div class="col-xs-12 col-sm-3 col-md-12 col-lg-3 text-xs-center">
                                                                            <a class="restaurant-logo" href="dishes.php?res_id='.$rows['rs_id'].'" > <img src="admin/Res_img/'.$rows['image'].'" alt="Restaurant logo"> </a>
                                                                        </div>
                                                            
                                                                        <div class="col-xs-12 col-sm-9 col-md-12 col-lg-9">
                                                                            <h5><a href="dishes.php?res_id='.$rows['rs_id'].'" >'.$rows['title'].'</a></h5> <span>'.$rows['address'].'</span>
                                                                        </div>
                                                            
                                                                    </div>
                                                        
                                                                </div>
												
													        </div>';
										  }
						
						
					?>


                    


                </div>
            </div>


        </div>
    </section>
    


    <?php include "include/footer.php" ?>


    <script src="js/jquery.min.js"></script>
    <script src="js/tether.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/animsition.min.js"></script>
    <script src="js/bootstrap-slider.min.js"></script>
    <script src="js/jquery.isotope.min.js"></script>
    <script src="js/headroom.js"></script>
    <script src="js/foodpicky.min.js"></script>

    <!-- <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/js/bootstrap.min.js"></script> -->
  

</body>


</html>