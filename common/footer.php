
    <!-- footer Section -->
    <div class="footer-section">
        <div class="container-fluid">
            <div class="footer-border">
                <div class="row gy-3">
                    <div class="col-lg-6 col-sm-12 col-md-6 col-xl-3">
                        <div class="footer-logo">
                            <img src="images/logo-footer.svg" alt="">
                            <p>India's Best and Affordable Beauty and Wellness Service Provider At Doorstep.</p>
                        </div>

                        <ul class="footer-icon">
                            <li><a target="_blank" href="https://www.facebook.com/bonitaAservices"><i class="fab fa-facebook"></i></a></li>
                            <li><a target="_blank" href="https://www.instagram.com/bonitaa_beauty_/"><i class="fab fa-instagram"></i></a></li>
                            <li><a target="_blank" href="https://api.whatsapp.com/send?phone=6397695174"><i class="fab fa-whatsapp"></i></a></li>
                            <li><a  href=""><i class="fab fa-linkedin-in"></i></a></li>
                        </ul>
                    </div>
                    <div class="col-lg-6 col-sm-12 col-md-6 col-xl-3">
                        <div class="footer-content">
                            <h4> Our Category </h4>
                            <ul>
                                <?php
        					    $query_category="SELECT *,c.category as cname,c.pic as cimage,c.ID as cid FROM category c
                                where c.status = 1 and c.hide = 0
                                ORDER BY c.sort ASC";
                            	
                        		$sql_category = mysqli_query($con,$query_category)or die(mysqli_error());

                        		while($data_category = mysqli_fetch_assoc($sql_category))
                        		{
                        		  
        					    ?>
                            
                                <li> <a href="sub_category.php?category=<?php echo $data_category['cid']; ?>" ><?php echo $data_category['cname']; ?></a> </li>
                                
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12 col-md-6 col-xl-3">
                        <div class="footer-content">
                            <h4> More from BonitaA </h4>
                            <ul>
                                <li> <a href="./about_us.php">About us</a> </li>
                                <li><a href="./my_wallet.php">BonitaA Wallet</a> </li>
                                <li> <a href="./privacy_policy.php">Privacy Policy</a> </li>
                                <!--<li><a href="./faq.php"> FAQ's </a></li>-->
                                <li><a href="./terms_condition.php"> Terms & Condition </a> </li>
                                <li><a href="./contact.php"> Contact us </a> </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12 col-md-6 col-xl-3">
                        <div class="footer-content">
                            <h4>Get In Touch</h4>
                            <ul style="padding-left: 10px;">
                                <li class="location"><a href="#"><i class="fas fa-envelope"></i></a>
                                    <div class="footer-location">
                                        <h4>Email</h4>
                                        <p>
                                            <!--<a href = "mailto: bonitaaservices@gmail.com"></a>-->
                                                bonitaaservices@gmail.com
                                                </p>
                                    </div>
                                </li>

                                <li class="location"><a href="#"><img src="images/map.png"></a>
                                    <div class="footer-location">
                                        <h4>Location</h4>
                                        <p>Meerut Uttar Pradesh</p>
                                    </div>
                                </li>

                                <li class="location"><a href="#"><i class="fas fa-user"></i></a>
                                    <div class="footer-location">
                                        <h4>Contact</h4>
                                        <p>+916397695174</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

          
            </div>
            <p class="footer-text">Copyright 2021-2023 @BonitaA Beauty</p>

        </div>
    </div>

   
</body>
<script src="js/jquery.min.js"></script>
<script src="js/wow.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/owl.carousel.js"></script>
<script type="text/javascript" src="js/stellarnav.min.js"></script>
<!-- <script src="plugins/jQuery/jquery.min.js"></script> -->
<script src="plugins/slick/slick.min.js"></script>
<script src="plugins/slick/slick-animation.min.js"></script>
<!-- navbar-header -->

<!-- home slider -->


</html>