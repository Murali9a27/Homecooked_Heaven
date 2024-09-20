
<!DOCTYPE html>
                <html lang="en">
                <?php
include("../connection/connect.php");
error_reporting(0);
session_start();
if(empty($_SESSION['admin_id']))  
{
	header('location:index.php');
}


?>


                <head>
                    <meta charset="utf-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <meta name="viewport" content="width=device-width, initial-scale=1">
                    <meta name="description" content="">
                    <meta name="author" content="">
                    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
                    <title>All Restaurants</title>
                    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
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

                            <div class="container-fluid">

                                <div class="row">
                                    <div class="col-12">

                                        <div class="col-lg-12">
                                            <div class="card card-outline-primary">
                                                <div class="card-header">
                                                    <h4 class="m-b-0 text-white">All Subscriber</h4>
                                                </div>

                                                <div class="table-responsive m-t-40">
                                                    <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                                        <thead class="thead-dark">
                                                        <tr>
                                                            
                                                            <th>Username</th>
                                                            <th>plan id</th>
                                                            <th>Start Date</th>
                                                            <th>End Date</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                        </thead>

                                                        <tbody>


                                                        <?php
												$sql="SELECT * FROM subscriptions order by sub_id desc";
												$query=mysqli_query($db,$sql);
												
													if(!mysqli_num_rows($query) > 0 )
														{
															echo '<td colspan="11"><center>No Menu</center></td>';
														}
													else
														{				
																	while($rows=mysqli_fetch_array($query))
																		{
																				$mql="select * from users where u_id='".$rows['user_id']."'";
																				$newquery=mysqli_query($db,$mql);
																				$fetch=mysqli_fetch_array($newquery);
																				
																				
																					echo '<tr>
                                                                                                <td>'.$fetch['username'].'</td>
																					
																								<td>'.$rows['plan_id'].'</td>
																								<td>'.$rows['start_date'].'</td>
																								<td>$'.$rows['end_date'].'</td>
                                                                                                <td>$'.$rows['status'].'</td>

                                                                                                    <td><a href="delete_menu.php?menu_del='.$rows['d_id'].'" class="btn btn-danger btn-flat btn-addon btn-xs m-b-10"><i class="fa fa-trash-o" style="font-size:16px"></i></a> 
                                                                                                    <a href="update_menu.php?menu_upd='.$rows['d_id'].'" class="btn btn-info btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="fa fa-edit"></i></a>
                                                                                                </td>
                                                                                                </tr>';
                                                                                    
																						
																						
																		}	
														}
												
											
											?>

                                                        </tbody>
                                                    </table>
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