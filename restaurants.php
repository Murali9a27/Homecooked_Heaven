
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

    <?php include "include/header.php" ?>
    <div class="page-wrapper">
        <div class="top-links">
            <div class="container">
                <ul class="row links">
                    <li class="col-xs-12 col-sm-4 link-item active"><span>1</span><a href="#">Choose Restaurant</a></li>
                    <li class="col-xs-12 col-sm-4 link-item"><span>2</span><a href="#">Pick Your favorite food</a></li>
                    <li class="col-xs-12 col-sm-4 link-item"><span>3</span><a href="#">Order and Pay</a></li>
                </ul>
            </div>
        </div>
        <div class="inner-page-hero bg-image" data-image-src="images/img/bread.jpg">
            <?php
            

            ?>

            <<div class="container mt-3">
                
                <form action="" class="form-inline my-2 my-lg-0" method="POST">
                    <div>
                    <input class="form-control form-inline my-2 my-lg-0 w-75" type="text" name="search" placeholder="Search by pincode..." >
                    <button type="submit" name="submit" class="btn btn-default">
                    <span class="">Search</span>
                    </button>
                    </div>
                </form>
                <!-- <div class="row">
                    <div class="col">
                    <form class="form-inline">
                        <div class="input-group w-100">
                            <input type="text" class="form-control" placeholder="Search...">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button">Search</button>
                            </div>
                        </div>
                    </form>
                    </div>
                </div> -->
            </div>
        </div>
        <div class="result-show">
            <div class="container">
                <div class="row">
                    <h2>vendors</h2>
                </div>
            </div>
        </div>
        

        <section class="restaurants-page">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-5 col-md-5 col-lg-3">
                    </div>
                    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-9">
                        <div class="bg-gray restaurant-entry">
                            <div class="row">
                                <?php
                                
                                $pincode='';
                                // Check if form is submitted and search query is set
                                if(isset($_POST['search'])){
                                    $pincode=$_POST['search'];
                                    
                                    $search_query =mysqli_query($db,"SELECT * FROM restaurant WHERE pincode LIKE $pincode");
                                

                                    if(mysqli_num_rows($search_query)==0){
                                        echo "Sorry! No Vendor found. Try search again.";
                                        }
                                    else{
                                        while ($rows=mysqli_fetch_assoc($search_query)) 
                                            {
                                                            
                                
                                                echo' <div class="col-sm-12 col-md-12 col-lg-8 text-xs-center text-sm-left">
                                                    <div class="entry-logo">
                                                        <a class="img-fluid" href="dishes.php?res_id='.$rows['rs_id'].'" > <img src="admin/Res_img/'.$rows['image'].'" alt="Food logo"></a>
                                                    </div>
                                                    <!-- end:Logo -->
                                                    <div class="entry-dscr">
                                                        <h5><a href="dishes.php?res_id='.$rows['rs_id'].'" >'.$rows['title'].'</a></h5> <span>'.$rows['address'].'</span>
                                                        
                                                    </div>
                                                    <!-- end:Entry description -->
                                                </div>
                                                
                                                    <div class="col-sm-12 col-md-12 col-lg-4 text-xs-center">
                                                        <div class="right-content bg-white">
                                                            <div class="right-review">
                                                                
                                                                <a href="dishes.php?res_id='.$rows['rs_id'].'" class="btn btn-purple">View Menu</a> </div>
                                                        </div>
                                                        <!-- end:right info -->
                                                    </div>';
                                            }  
                                    }
                                }
                                else{
                                     	
                                


                                        $ress= mysqli_query($db,"select * from restaurant");
									      while($rows=mysqli_fetch_array($ress))
										  {
													
						
													 echo' <div class="col-sm-12 col-md-12 col-lg-8 text-xs-center text-sm-left">
															<div class="entry-logo">
																<a class="img-fluid" href="dishes.php?res_id='.$rows['rs_id'].'" > <img src="admin/Res_img/'.$rows['image'].'" alt="Food logo"></a>
															</div>
															<!-- end:Logo -->
															<div class="entry-dscr">
																<h5><a href="dishes.php?res_id='.$rows['rs_id'].'" >'.$rows['title'].'</a></h5> <span>'.$rows['address'].'</span>
																
															</div>
															<!-- end:Entry description -->
														</div>
														
														 <div class="col-sm-12 col-md-12 col-lg-4 text-xs-center">
																<div class="right-content bg-white">
																	<div class="right-review">
																		
																		<a href="dishes.php?res_id='.$rows['rs_id'].'" class="btn btn-purple">View Menu</a> </div>
																</div>
																<!-- end:right info -->
															</div>';
										  }
                                          
                                }
						
						        ?>
                                

                            </div>

                        </div>



                    </div>


                    

                </div>
            </div>
        </section>
    </div>
    

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