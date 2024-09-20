<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Manage Vendors</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="css/helper.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    
</head>
<body class="fix-header fix-sidebar">

                    <div class="preloader">
                        <svg class="circular" viewBox="25 25 50 50">
                            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
                        </svg>
                    </div>

                    <div id="main-wrapper">

                        <?php include "include/header.php" ?>

                        <div class="page-wrapper">
                            <div class="container mt-5">
                                <h2 class="text-center mb-4">Manage Vendors</h2>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Shop</th>
                                                <th>Address</th>
                                                <th>Pincode</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            // Include database connection
                                            include("../connection/connect.php");

                                            // Fetch vendors data from the database
                                            $sql = "SELECT * FROM vendors";
                                            $result = mysqli_query($db, $sql);

                                            // Check if vendors exist
                                            if (mysqli_num_rows($result) > 0) {
                                                // Display vendors
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    echo "<tr>";
                                                    echo "<td>" . $row['id'] . "</td>";
                                                    echo "<td>" . $row['name'] . "</td>";
                                                    echo "<td>" . $row['email'] . "</td>";
                                                    echo "<td>" . $row['phone'] . "</td>";
                                                    echo "<td>" . $row['shop'] . "</td>";
                                                    echo "<td>" . $row['address'] . "</td>";
                                                    echo "<td>" . $row['pincode'] . "</td>";
                                                    echo "<td>";
                                                    if ($row['verified'] == 1) {
                                                        echo "<span class='text-success' style='padding-right: 3px;'>Verified</span>";
                                                    } else {
                                                        echo "<a href='verify_vendor.php?id=" . $row['id'] . "' class='btn btn-success btn-sm mr-2'>Verify</a>";
                                                    }
                                                    echo "<a href='remove_vendor.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm'>Remove</a>";
                                                    echo "</td>";
                                                    echo "</tr>";
                                                }
                                            } else {
                                                // No vendors found
                                                echo "<tr><td colspan='5' class='text-center'>No vendors found.</td></tr>";
                                            }
                                        ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script src="js/lib/jquery/jquery.min.js"></script>
                    <script src="js/lib/bootstrap/js/popper.min.js"></script>
                    <script src="js/lib/bootstrap/js/bootstrap.min.js"></script>
                    <script src="js/jquery.slimscroll.js"></script>
                    <script src="js/sidebarmenu.js"></script>
                    <script src="js/lib/sticky-kit-master/dist/sticky-kit.min.js"></script>
                    <script src="js/custom.min.js"></script>
                    <script src="js/lib/datatables/datatables.min.js"></script>
                    <script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
                    <script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
                    <script src="js/lib/datatables/cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
                    <script src="js/lib/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
                    <script src="js/lib/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
                    <script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
                    <script src="js/lib/datatables/datatables-init.js"></script>
</body>
</html>
