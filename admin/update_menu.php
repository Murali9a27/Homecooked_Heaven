<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <title>Update Menu</title>
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
        <?php include "include/header.php"; ?>
        <div class="page-wrapper">
            <div class="container-fluid">
                <?php
                include("../connection/connect.php");
                error_reporting(0);
                session_start();

                if(isset($_POST['submit'])) {
                    if(empty($_POST['d_name']) || empty($_POST['about']) || empty($_POST['price']) || empty($_POST['res_name'])) {
                        $error = '<div class="alert alert-danger alert-dismissible fade show">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <strong>All fields must be filled!</strong>
                                </div>';
                    } else {
                        $res_name = mysqli_real_escape_string($db, $_POST['res_name']);
                        $d_name = mysqli_real_escape_string($db, $_POST['d_name']);
                        $about = mysqli_real_escape_string($db, $_POST['about']);
                        $price = mysqli_real_escape_string($db, $_POST['price']);

                        // Check if file input is empty
                        if(empty($_FILES['file']['name'])) {
                            // Keep the existing image path
                            $sql = "UPDATE dishes SET rs_id='$res_name', title='$d_name', slogan='$about', price='$price' WHERE d_id='$_GET[menu_upd]'";
                            if(mysqli_query($db, $sql)) {
                                echo "<script>window.location.href = 'all_menu.php';</script>";
                            } else {
                                $error = '<div class="alert alert-danger alert-dismissible fade show">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <strong>Error updating record:</strong> ' . mysqli_error($db) . '
                                        </div>';
                            }
                        } else {
                            // Process image upload
                            $fname = $_FILES['file']['name'];
                            $temp = $_FILES['file']['tmp_name'];
                            $fsize = $_FILES['file']['size'];
                            $extension = strtolower(pathinfo($fname, PATHINFO_EXTENSION));
                            $fnew = uniqid().'.'.$extension;
                            $store = "Res_img/dishes/" . $fnew;

                            if(in_array($extension, ['jpg','jpeg', 'png', 'gif'])) {
                                if($fsize >= 1000000) {
                                    $error = '<div class="alert alert-danger alert-dismissible fade show">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <strong>Max image size is 1024kb!</strong> Please choose a smaller image.
                                            </div>';
                                } else {
                                    $sql = "UPDATE dishes SET rs_id='$res_name', title='$d_name', slogan='$about', price='$price', img='$fnew' WHERE d_id='$_GET[menu_upd]'";
                                    if(mysqli_query($db, $sql)) {
                                        move_uploaded_file($temp, $store);
                                        $success = '<div class="alert alert-success alert-dismissible fade show">
                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        <strong>Record Updated!</strong>
                                                    </div>';
                                    } else {
                                        $error = '<div class="alert alert-danger alert-dismissible fade show">
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <strong>Error updating record:</strong> ' . mysqli_error($db) . '
                                                </div>';
                                    }
                                }
                            } else {
                                $error = '<div class="alert alert-danger alert-dismissible fade show">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <strong>Invalid file extension!</strong> Only JPG, PNG, and GIF are accepted.
                                        </div>';
                            }
                        }
                    }
                }
                ?>
                <div class="col-lg-12">
                    <div class="card card-outline-primary">
                        <div class="card-header">
                            <h4 class="m-b-0 text-white">Add Menu to Restaurant</h4>
                        </div>
                        <div class="card-body">
                            <form action='' method='post' enctype="multipart/form-data">
                                <div class="form-body">
                                    <?php 
                                        $qml ="select * from dishes where d_id='$_GET[menu_upd]'";
                                        $rest=mysqli_query($db, $qml); 
                                        $roww=mysqli_fetch_array($rest);
                                    ?>
                                    <hr>
                                    <div class="row p-t-20">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Dish Name</label>
                                                <input type="text" name="d_name" value="<?php echo $roww['title'];?>" class="form-control" placeholder="Morzirella">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group has-danger">
                                                <label class="control-label">About</label>
                                                <input type="text" name="about" value="<?php echo $roww['slogan'];?>" class="form-control form-control-danger" placeholder="Slogan">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row p-t-20">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Price </label>
                                                <input type="text" name="price" value="<?php echo $roww['price'];?>" class="form-control" placeholder="$">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group has-danger">
                                                <label class="control-label">Image</label>
                                                <input type="file" name="file" id="lastName" class="form-control form-control-danger" placeholder="12n">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">Select Category</label>
                                                <select name="res_name" class="form-control custom-select" data-placeholder="Choose a Category" tabindex="1">
                                                    <option>--Select Restaurant--</option>
                                                    <?php 
                                                        $ssql ="select * from restaurant";
                                                        $res=mysqli_query($db, $ssql); 
                                                        while($row=mysqli_fetch_array($res))  
                                                        {
                                                            echo '<option value="'.$row['rs_id'].'">'.$row['title'].'</option>';
                                                        }  
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <input type="submit" name="submit" class="btn btn-primary" value="Save">
                                    <a href="all_menu.php" class="btn btn-inverse">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include "include/footer.php"; ?>
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
