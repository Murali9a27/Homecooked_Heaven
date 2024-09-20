<!-- payment_success.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Success</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <!-- <div class="card-header">
                        <h4 class="card-title"> Success</h4>
                    </div>
                    <div class="card-body">
                        <p>Your Subscription was successful. Thank you!</p>
                        
                    </div> -->
                    <?php
                    echo '<script>alert("Your subscription to this plan is successful."); window.location.href = "index.php";</script>';
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
