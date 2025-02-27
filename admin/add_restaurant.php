
 

<?php
session_start();
if(empty($_SESSION['admin_id']))  
{
	header('location:index.php');
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
                
                <?php
                include("../connection/connect.php");
                error_reporting(E_ALL);
                ini_set('display_errors', 1);

                
                $success = "";
                $error = "";
                if(isset($_POST['submit'])) {
                    // Form submission handling
                    $name = $db->real_escape_string($_POST['res_name']);
                    $email = isset($_POST['email']) ? $db->real_escape_string($_POST['email']) : '';
                    $url = isset($_POST['url']) ? $db->real_escape_string($_POST['url']) : '';
                    $phone = $db->real_escape_string($_POST['phone']);
                    

                    // Check if all required fields are filled
                    if(empty($_POST['c_name']) || empty($_POST['res_name']) || empty($_POST['phone']) || empty($_POST['o_hr']) || empty($_POST['c_hr']) || empty($_POST['o_days']) ||empty($_POST['pincode']) || empty($_POST['address'])) {
                        $error = '<div class="alert alert-danger alert-dismissible fade show">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <strong>All fields must be filled!</strong>
                                  </div>';
                    } else {
                        // Form data validation and processing

                        // File upload handling
                        $fname = $_FILES['file']['name'];
                        $temp = $_FILES['file']['tmp_name'];
                        $fsize = $_FILES['file']['size'];
                        $extension = strtolower(pathinfo($fname, PATHINFO_EXTENSION));
                        $fnew = uniqid().'.'.$extension;
                        $store = "Res_img/" . $fnew;

                        // Check file extension and size
                        if(!in_array($extension, ['jpg', 'jpeg', 'png', 'gif'])) {
                            $error = '<div class="alert alert-danger alert-dismissible fade show">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <strong>Invalid file extension!</strong> Only JPG, JPEG, PNG, and GIF files are accepted.
                                      </div>';
                        } elseif($fsize >= 1000000) {
                            $error = '<div class="alert alert-danger alert-dismissible fade show">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <strong>Max image size is 1024kb!</strong> Try a different image.
                                      </div>';
                        } else {
                            // Database insertion
                            $sql = "INSERT INTO restaurant(c_id, title, email, phone, url, o_hr, c_hr, o_days, address, pincode, image) VALUES ('".$_POST['c_name']."', '$name', '$email', '$phone', '$url', '".$_POST['o_hr']."', '".$_POST['c_hr']."', '".$_POST['o_days']."', '".$_POST['address']."','".$_POST['pincode']."', '".$fnew."')";
                            if(mysqli_query($db, $sql)) {
                                // Move uploaded file to destination directory
                                move_uploaded_file($temp, $store);
                                echo '<script>alert("New vendor added successfully");window.location.href = "dashboard.php";</script>';
                            } else {
                                echo '<script>alert("Please try again");window.location.href = "add_restaurant.php";</script>';
                            }
                        }
                    }
                }
                ?>

                
                


                <!-- Restaurant form -->
                <div class="col-lg-12">
                    <div class="card card-outline-primary">
                        <div class="card-header">
                            <h4 class="m-b-0 text-white">Add Restaurant</h4>
                        </div>
                        <div class="card-body">
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="form-body">

                                    <hr>
                                    <div class="row p-t-20">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Restaurant Name</label>
                                                <input type="text" name="res_name" class="form-control" required>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group has-danger">
                                                <label class="control-label">Bussiness E-mail</label>
                                                <input type="text" name="email" class="form-control form-control-danger">
                                            </div>
                                        </div>


                                    </div>

                                    <div class="row p-t-20">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Phone </label>
                                                <input type="text" name="phone" class="form-control" required>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group has-danger">
                                                <label class="control-label">Website URL</label>
                                                <input type="text" name="url" class="form-control form-control-danger">
                                            </div>
                                        </div>

                                    </div>


                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Open Hours</label>
                                                <select name="o_hr" class="form-control custom-select" data-placeholder="Choose a Category" required>
                                                    <option>--Select your Hours--</option>
                                                    <option value="6am">6am</option>
                                                    <option value="7am">7am</option>
                                                    <option value="8am">8am</option>
                                                    <option value="9am">9am</option>
                                                    <option value="10am">10am</option>
                                                    <option value="11am">11am</option>
                                                    <option value="12pm">12pm</option>
                                                </select>
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Close Hours</label>
                                                <select name="c_hr" class="form-control custom-select" data-placeholder="Choose a Category" required>
                                                    <option>--Select your Hours--</option>
                                                    <option value="3pm">3pm</option>
                                                    <option value="4pm">4pm</option>
                                                    <option value="5pm">5pm</option>
                                                    <option value="6pm">6pm</option>
                                                    <option value="7pm">7pm</option>
                                                    <option value="8pm">8pm</option>
                                                    <option value="9pm">9pm</option>
                                                    <option value="10pm">10pm</option>
                                                    <option value="11pm">11pm</option>
                                                    <option value="12am">12am</option>
                                                    <option value="1am">1am</option>
                                                    <option value="2am">2am</option>
                                                    <option value="3am">3am</option>
                                                </select>
                                            </div>
                                        </div>
                                        

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Open Days</label>
                                                <select name="o_days" class="form-control custom-select" data-placeholder="Choose a Category" tabindex="1" required>
                                                    <option>--Select your Days--</option>
                                                    <option value="Mon-Tue">Mon-Tue</option>
                                                    <option value="Mon-Wed">Mon-Wed</option>
                                                    <option value="Mon-Thu">Mon-Thu</option>
                                                    <option value="Mon-Fri">Mon-Fri</option>
                                                    <option value="Mon-Sat">Mon-Sat</option>
                                                    <option value="24hr-x7">24hr-x7</option>
                                                </select>
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="form-group has-danger">
                                                <label class="control-label">Image</label>
                                                <input type="file" name="file" id="lastName" class="form-control form-control-danger" placeholder="12n" required>
                                            </div>
                                        </div>


                                        



                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">Select Category</label>
                                                <select name="c_name" class="form-control custom-select" data-placeholder="Choose a Category" tabindex="1" required>
                                                    <option>--Select Category--</option>
                                                    <?php $ssql ="select * from res_category";
                                                    $res=mysqli_query($db, $ssql); 
                                                    while($row=mysqli_fetch_array($res))  
                                                    {
                                                    echo' <option value="'.$row['c_id'].'">'.$row['c_name'].'</option>';;
                                                    }  
                                                
                                                    ?>
                                                </select>
                                            </div>
                                        </div>



                                    </div>

                                    <h3 class="box-title m-t-40">Restaurant Address</h3>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-6 ">
                                            <div class="form-group">

                                                <textarea name="address" type="text" style="height:100px;" class="form-control" required></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            
                                            <div class="form-group">
                                                <label for="pincode">Pincode:</label>
                                                <input type="text" id="pincode" class="form-control" name="pincode" pattern="\d{6}" title="Please enter a 6-digit pincode" maxlength="6" placeholder="Enter 6-digit pincode" required>           

                                            </div>
                                        </div>
                                        
                                    </div>
                                    


                                </div>
                                <div class="form-actions">
                                    <input type="submit" name="submit" class="btn btn-primary" value="Save">
                                    <a href="add_restaurant.php" class="btn btn-inverse">Cancel</a>
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
