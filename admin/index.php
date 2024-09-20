<!DOCTYPE html>
<html lang="en">
<?php
include("../connection/connect.php");
error_reporting(0);
session_start();
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (!empty($_POST["submit"])) {
        // $loginquery ="SELECT * FROM admin WHERE username='$username' && password='".md5($password)."'";
        $loginquery = "SELECT * FROM admin WHERE username='$username' && password='$password'";
        $result = mysqli_query($db, $loginquery);
        $row = mysqli_fetch_array($result);

        if (is_array($row)) {
            $_SESSION["admin_id"] = $row['adm_id'];
            header("refresh:1;url=dashboard.php");
        } else {
            echo "<script>alert('Invalid Username or Password!');</script>";
        }
    }
}

?>


<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(112.1deg, rgb(32, 38, 57) 11.4%, rgb(63, 76, 119) 70.2%);
        }
    </style>
</head>

<div class="row">
    <div class="col col-xl-10">
        <div class="card" style="border-radius: 1rem; margin-top: 50px; margin-left: 20vw">
            <div class="row">
                <div class="col-md-6 col-lg-5 d-md-block">
                    <img src="./images/jonathan-borba-uB7q7aipU2o-unsplash.jpg" alt="" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
                </div>
                <div class="col-md-6 col-lg-7 d-flex align-items-center pr-3" style="margin-top: 4rem;">
                    <div class="card-body p-4 p-lg-5 text-black">
                        <form action="" method="post">
                            <div class="form">
                                <h2 class="fw-normal mt-3 pb-3" style="text-align: center">Admin Login</h2>
                                <div class="form-outline mb-4">
                                    <input type="text" class="form-control form-control-lg" name="username" />
                                    <label class="form-label">Username</label>
                                </div>
                                <div class="form-outline mb-4">
                                    <input type="password" class="form-control form-control-lg" name="password" />
                                    <label class="form-label">Password</label>
                                </div>
                                <div class="pt-1 mb-4">
                                    <button class="btn btn-primary btn-lg btn-block" type="submit" name="submit" value="Login">Login</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>











    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src='js/index.js'></script>
    </body>

</html>