<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Become a Vendor</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Add custom styles here */
    </style>
</head>
<body>

<div class="contact-us p-3 p-md-5" style="background: radial-gradient(circle at 10% 20%, rgb(69, 86, 102) 0%, rgb(34, 34, 34) 90%); color: white;">
    <div class="m-3 m-md-5">
        <div class="text-center">
            <h2 class="mb-4">Want to be a Seller?</h2>
        </div>
        <div class="text-center mb-4" style="font-size: 1.25rem;">
            <p>Provide your details with us <i class="far fa-hand-point-down"></i>.</p>
            <p class="font-weight-bold text-purple">We will get back to you.</p>
        </div>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputName">Name</label>
                    <input type="text" class="form-control" id="inputName" name="name" placeholder="Name" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputEmail">Email</label>
                    <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Email">
                </div>
                <div class="form-group col-md-6">
                    <label for="phone">Phone Number</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone Number" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="shop">Shop Name</label>
                    <input type="text" class="form-control" id="shop" name="shop" placeholder="Shop Name" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputPincode">Pincode</label>
                    <input type="text" class="form-control" id="inputPincode" name="pincode" placeholder="Pincode" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputArea">Area</label>
                    <input type="text" class="form-control" id="inputArea" name="area" placeholder="Area" required>
                </div>
            </div>
            <div class="form-group">
                <label for="inputAddress">Address</label>
                <input type="text" class="form-control" id="inputAddress" name="address" placeholder="1234 Main St" required>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>

<?php
// Database connection parameters
include("connection/connect.php");  

// SQL query to create vendors table
$sql_create_table = "CREATE TABLE IF NOT EXISTS vendors (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255),
    phone VARCHAR(15) NOT NULL,
    shop VARCHAR(255) NOT NULL,
    pincode VARCHAR(10) NOT NULL,
    area VARCHAR(255) NOT NULL,
    address VARCHAR(255) NOT NULL,
    verified TINYINT(1) DEFAULT 0
)";

// Execute SQL query to create table
// if ($db->query($sql_create_table) === TRUE) {
//     echo "<script>alert('table created successfully');</script>";
// } else {
//     echo "Error creating table: " . $db->error;
// }

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape user inputs to prevent SQL injection
    $name = $db->real_escape_string($_POST['name']);
    $email = isset($_POST['email']) ? $db->real_escape_string($_POST['email']) : '';
    $phone = $db->real_escape_string($_POST['phone']);
    $shop = $db->real_escape_string($_POST['shop']);
    $pincode = $db->real_escape_string($_POST['pincode']);
    $area = $db->real_escape_string($_POST['area']);
    $address = $db->real_escape_string($_POST['address']);

    // SQL query to insert data into the database
    $sql = "INSERT INTO vendors (name, email, phone, shop, pincode, area, address)
            VALUES ('$name', '$email', '$phone', '$shop', '$pincode', '$area', '$address')";

    if ($db->query($sql) === TRUE) {
        echo '<script>alert("New record created successfully");window.location.href = "index.php";</script>';
    } else {
        echo "<script>alert('Error: " . $sql . "<br>" . $db->error . "');</script>";
    }
}

// Close connection
$db->close();
?>

</body>
</html>
