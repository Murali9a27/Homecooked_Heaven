<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login || Homecooked Heaven</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">

    <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900'>
    <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <style>
        /* Custom CSS for responsiveness */
        .container {
            padding: 0;
        }

        .card-body {
            padding: 2rem;
        }

        .form-outline input,
        .form-outline textarea {
            border: 1px solid #ced4da;
            border-radius: .25rem;
            width: 100%;
            padding: .375rem .75rem;
            transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
        }

        .form-outline input:focus,
        .form-outline textarea:focus {
            border-color: #80bdff;
            outline: 0;
            box-shadow: 0 0 0 .25rem rgba(0,123,255,.25);
        }

        @media (max-width: 768px) {
            .hide-on-mobile {
                display: none;
            }
        }
    </style>
</head>

<body>
    <?php include "include/header.php" ?>
    <div style=" background-image: url('images/img/pimg.jpg');">

        <?php
        include("connection/connect.php");
        error_reporting(0);
        session_start();
        if (isset($_POST['submit'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            if (!empty($_POST["submit"])) {
                $loginquery = "SELECT * FROM users WHERE username='$username' && password='" . md5($password) . "'"; //selecting matching records
                $result = mysqli_query($db, $loginquery); //executing
                $row = mysqli_fetch_array($result);

                if (is_array($row)) {
                    $_SESSION["user_id"] = $row['u_id'];
                    header("refresh:1;url=index.php");
                } else {
                    $message = "Invalid Username or Password!";
                }
            }
        }
        ?>

        <div class="module form-module">
            <div class="row" style="height: 90vh;">
                <div class="col-12 col-md-10 offset-md-1 col-lg-8 offset-lg-2 mb-2">
                    <div class="card">
                        <div class="row g-0">
                            <div class="col-md-6 hide-on-mobile">
                                <img src="./images/img/jonathan-borba-uB7q7aipU2o-unsplash.jpg" alt="" class="img-fluid" />
                            </div>
                            <div class="col-md-6">
                                <div class="card-body">
                                    <form action="" method="post">
                                        <div class="form">
                                            <h2 class="fw-normal mt-3 pb-3" style="letter-spacing: 1px;">Login to your account</h2>
                                            <div class="form-outline mb-4">
                                                <input type="text" class="form-control form-control-lg" name="username" />
                                                <label class="form-label mb-0">Username</label>
                                            </div>
                                            <div class="form-outline mb-4">
                                                <input type="password" class="form-control form-control-lg" name="password" />
                                                <label class="form-label mb-0">Password</label>
                                            </div>
                                            <div class="pt-1 mb-4">
                                                <button class="btn btn-primary btn-lg btn-block" type="submit" name="submit" value="Login">Login</button>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="text-center">
                                        <p class="mb-5 pb-lg-2">Don't have an account? <a href="registration.php">Register here</a></p>
                                        <a href="#!" class="small">Terms of use.</a>
                                        <a href="#!" class="small">Privacy Policy</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include "include/footer.php" ?>
</body>

</html>
