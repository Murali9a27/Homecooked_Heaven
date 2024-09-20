
<footer class="bg-dark text-white" style="padding: 0;">
        <div class="container py-1">
            <div class="row" >
                <div class="col-md-6">
                    <h4>Contact Us</h4>
                    <p>Email: homecooked@mail.com</p>
                    <p>Phone: 123-456-7890</p>
                    <p>Address: 123 Street, Gunupur, India</p>
                </div>
                <div class="col-md-6">
                    <h4>Homecooked Heaven</h4>
                    <ul class="list-unstyled">
                        <li><a href="terms.html" class="text-white">Terms &amp; Conditions</a></li>
                        <li><a href="privacy.html" class="text-white">Privacy Policy</a></li>
                    </ul>
                    <?php
						if(empty($_SESSION["user_id"])) // if user is not login
							{
                                echo  '<a href="vendor_register.php" style="text-decoration: none; color:aliceblue">Register as vendor</a>';
                            }

						?>
                </div>
            </div>
        </div>
    </footer>