
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
    <title>Restaurants</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>

    <header id="header" class="header-scroll top-header headrom">
        <nav class="navbar navbar-dark">
            <div class="container">
                <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#mainNavbarCollapse">&#9776;</button>
                <a class="navbar-brand" href="index.php"> <img class="img-rounded" src="images/logo.png" alt="" width="18%"> </a>
                <div class="collapse navbar-toggleable-md  float-lg-right" id="mainNavbarCollapse">
                    <ul class="nav navbar-nav">
                        <li class="nav-item"> <a class="nav-link active" href="index.php">Home <span class="sr-only">(current)</span></a> </li>
                        <li class="nav-item"> <a class="nav-link active" href="restaurants.php">Vendors <span class="sr-only"></span></a> </li>

                        <?php
						if(empty($_SESSION["user_id"]))
							{
								echo '<li class="nav-item"><a href="login.php" class="nav-link active">Login</a> </li>
							  <li class="nav-item"><a href="registration.php" class="nav-link active">Register</a> </li>';
							}
						else
							{
									
									
										echo  '<li class="nav-item"><a href="your_orders.php" class="nav-link active">My Orders</a> </li>';
									echo  '<li class="nav-item"><a href="logout.php" class="nav-link active">Logout</a> </li>';
							}

						?>
                        

                    </ul>
                </div>
            </div>
        </nav>
    </header>
    

     <!-- vendors specialist -->

     <section class="vendors-special m-b-30 space-sm ">
        <h1 class="m-b-30 space-sm " style="color: white;">Enjoy Our Delicious Specialities of Our Home Chefs.</h1>
  
        <div class="row  specialities" >
            <?php  
                // Select one dish from every restaurant
            $query = "SELECT dishes.*, restaurant.title AS restaurant_name 
            FROM dishes 
            INNER JOIN restaurant ON dishes.rs_id = restaurant.rs_id 
            GROUP BY dishes.rs_id LIMIT 3" ;
            $result = mysqli_query($db, $query);

            // Display the results
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="col-lg-4">';
                echo '<img src="admin/Res_img/dishes/'.$row['img'].'" style="border-radius:50%" width="200px" height="200px" alt="dishes photo">';  
                //<a class="restaurant-logo" href="dishes.php?res_id='.$row['rs_id'].'" > <img src="admin/Res_img/dishes/'.$row['img'].'" alt="dishs photo"> </a>
                
                echo "<h2 class='' style='color: white'>{$row['title']}</h2>";
                // echo '<p>Restaurant: '.$row['restaurant_name'].'</p>'; 
                echo '<a href="dishes.php?res_id=' . $row['rs_id'] . '" class=" " style:"color:white"><h4>'.$row['restaurant_name'].'</h4></a>';   
                echo '</div>';

            }
            
            ?>


            

            
            
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
</body>


</html>
