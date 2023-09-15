<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
        /*Social Icons*/
.fa-social-footer {padding: 15px 1px; font-size: 30px; width: 60px; height: 60px; text-align: center; text-decoration: none; margin: 5px 2px; border-radius: 50%;}
.fa-social-footer:hover {opacity: 0.7; }
.fa-facebook {background: #3B5998; color: white;}
.fa-instagram { display: inline-block; text-align: center; color: #fff; background: #d6249f; background: radial-gradient(circle at 30% 107%, #fdf497 0%, #fdf497 5%, #fd5949 45%,#d6249f 60%,#285AEB 90%); box-shadow: 0px 3px 10px rgba(0,0,0,.25); }
.fa-twitter {background: #55ACEE; color: white;}
</style>
<!-- ================ START : Products We Use ================= -->
 <section class="service-section v2" style="background: #eaeada;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center" style="margin-bottom: 20px;">
                        <h3 class="color-72 fw-500" style="text-transform: none;">Our Single Time usable Brands</h3>
                    </div>
                </div>
                <!--/col-->
            </div>
            <!--/row-->

            <div class="row">
                <!--product-1-->
                <div class="col-lg-2 col-md-6 mob-cat">
                    <div class="onetime-use">
                        <div class="img-over-content text-center">
                            <img src="<?= UPLOAD_PATH.'products/ricca-black.webp'; ?>" class="img-fluid plogo">
                        </div>
                    </div>
                </div>
                <!--product-2-->
                <div class="col-lg-2 col-md-6 mob-cat">
                    <div class="onetime-use">
                        <div class="img-over-content text-center">
                            <img src="<?= UPLOAD_PATH.'products/vlcc.webp'; ?>" class="img-fluid plogo">
                        </div>
                    </div>
                </div>
                <!--product-3-->
                <div class="col-lg-2 col-md-6 mob-cat">
                    <div class="onetime-use">
                        <div class="img-over-content text-center">
                            <img src="<?= UPLOAD_PATH.'products/o3+.webp'; ?>" class="img-fluid plogo">
                        </div>
                    </div>
                </div>
                <!--product-4-->
                <div class="col-lg-2 col-md-6 mob-cat">
                    <div class="onetime-use">
                        <div class="img-over-content text-center">
                            <img src="<?= UPLOAD_PATH.'products/loreal.webp'; ?>" class="img-fluid plogo">
                        </div>
                    </div>
                </div>
                <!--product-5-->
                <div class="col-lg-2 col-md-6 mob-cat">
                    <div class="onetime-use">
                        <div class="img-over-content text-center">
                            <img src="<?= UPLOAD_PATH.'products/lotus.webp'; ?>" class="img-fluid plogo">
                        </div>
                    </div>
                </div>
                <!--product-6-->
                <div class="col-lg-2 col-md-6 mob-cat">
                    <div class="onetime-use">
                        <div class="img-over-content text-center">
                            <img src="<?= UPLOAD_PATH.'products/raaga.webp'; ?>" class="img-fluid plogo">
                        </div>
                    </div>
                </div>
                <!--/col-->
            </div>
            <!--/row-->
        </div>
    </section>
<!-- ================ END : Products We Use ================= -->
<div class="feedback_float">
    <button class="btn feedback_float_btn" data-toggle="modal" data-target="#id01">Review Us</button>
</div>
<!-- ======================================= 
        ==Start footer widget section==  
=======================================-->
<section class="footer-widget" style="padding: 40px 0;">
    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <div class="single-widget contact-widget">
                    <a href="<?= $baseurl; ?>">
                        <!-- <img alt="logo" src="<?= $footer_logo; ?>">
                        <p class="bold text-white font-13" style="margin-top: -11px;margin-left: 27px;">Salon at Home</p> -->
                        <img id="logo" src="<?= $header_logo; ?>" alt="logo" style="width: 70px;border-radius: 50%; border: 2px solid #fff;">
                        <p class="bold text-white font-11" style="padding: 0px;">Salon at Home</p>
                    </a>
                    <p>Bonitaa is India’s best professional beauty and wellness service provider at doorstep.</p>
                    <address>
                        <p class="address"><i class="fa fa-home"></i><span>Address:</span> <?= $address; ?></p>
                        <p class="phone"><i class="fa fa-phone"></i><span>Phone:</span> <?= $call_no; ?></p>
                        <p class="email"><i class="fa fa-envelope"></i><span>Email:</span> <a href=":mailto:<?= $info_email; ?>"> <?= $info_email; ?></a></p>
                        <p class="web"><i class="fa fa-globe"></i><span>Web:</span> <a href="<?= $baseurl; ?>" target="_blank"><?= $baseurl; ?></a></p>
                        <p class="timings"><i class="fa fa-clock-o"></i><span>Opening Hours: Mon - Sun : 10:00 AM - 05:00 PM</span></p>
                        <!-- <div class="opening-time text-left"><i class="fa fa-clock-o color-d5"></i> <span>Opening Hours: Mon - Sun : 10:00 AM - 05:00 PM</span> </div> -->
                    </address>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="single-widget footer-important-links">
                    <h5>Our Category</h5>
                    <ul style="list-style: inside;color: #fff;">
                        <?php $footer_category =  getAllRecords($con,"category","");
                        foreach ($footer_category as $value) { ?>
                        <li class="MB__8px"><a href="<?= $baseurl.'/services'. $extn; ?>" class="text-left text-white"><?= $value['category']; ?></a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>

            <div class="col-lg-2">
                <div class="single-widget footer-important-links">
                    <h5>Why Choose us </h5>
                    <ul style="list-style: inside;color: #fff;">
                        <li class="MB__8px"><a href="<?= $baseurl.'/aboutus'; ?>" class="text-left text-white">About Us</a></li>
                        <li class="MB__8px"><a href="<?= $baseurl.'/gallery'; ?>" class="text-left text-white">Gallery</a></li>
                        <li class="MB__8px"><a href="<?= $baseurl.'/contactus'; ?>" class="text-left text-white">Contact Us</a></li>
                        <li class="MB__8px"><a href="<?= $baseurl.'/blogs'; ?>" class="text-left text-white">Blogs</a></li>
                        <li class="MB__8px"><a href="<?= $baseurl.'/franchise'; ?>" class="text-left text-white">Franchise</a></li>
                        <!-- <li><a href="<?= $baseurl.''; ?>" class="text-left text-white">Blogs</a></li> -->
                    </ul>
                </div>
            </div>

            <div class="col-lg-2">
                <div class="single-widget footer-important-links">
                    <h5>Important Links </h5>
                    <ul style="list-style: inside;color: #fff;">
                        <li class="MB__8px"><a href="<?= $baseurl.'/faqs'; ?>" class="text-left text-white">FAQ's</a></li>
                        <li class="MB__8px"><a href="<?= $baseurl.'/privacy-policy'; ?>" class="text-left text-white">Privacy Policy</a></li>
                        <li class="MB__8px"><a href="<?= $baseurl.'/refund-policy'; ?>" class="text-left text-white">Refund Policy</a></li>
                        <li class="MB__8px"><a href="<?= $baseurl.'/terms-conditions'; ?>" class="text-left text-white">Terms & Conditions</a></li>
                        <!-- <li><a href="<?= $baseurl.''; ?>" class="text-left text-white">Blogs</a></li> -->
                    </ul>
                </div>
            </div>
            <!-- Currently Located in  -->
            <div class="col-md-12 ">
                <hr class="bg-white">
                <h5 class="text-white">Currently Available in </h5>
                <ul style="display: inline-flex; flex-direction: row; flex-wrap: wrap;" class="mt-3 city_available">
                    <?php $footer_locations = getAllRecords($con,"location");
                    foreach ($footer_locations as $loc) { 
                        echo "<li>$loc[city]</li>";
                    }
                    ?>
                </ul>
            </div>

             <!-- Social Icons  -->
            <div class="col-md-12 text-center mt-4">
                <h5 class="text-white">Follow us:</h5>
                <a href="<?= $fb; ?>"><i class="fa-social-footer fa fa-facebook"></i></a>
                <a href="<?= $ig; ?>"><i class="fa-social-footer fa fa-instagram"></i></a>
                <a href="<?= $tw; ?>"><i class="fa-social-footer fa fa-twitter"></i></a>
            </div>
        </div>
    </div>
</section>
<!-- ======================================= 
        ==End footer widget section== 
=======================================-->
<!-- ======================================= 
        ==Start footer section==  
=======================================-->
<footer>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <p class="copyright">&copy; <?= date('Y'); ?> <span class="text-white">Bonitaa</span> - All rights reserved. </p>
            </div>
        </div>
    </div>
</footer>
<!-- ======================================= 
        ==End footer section== 
=======================================-->
<!-- ======================================= 
    ==Start scroll top==  
=======================================-->
<div class="scroll-top not-visible"><i class="fa fa-angle-up"></i></div>
<!-- =======================================
    ==End scroll top==  
=======================================-->

<!-- Whatsapp Icon -->
<div class="whatsapp_float">
    <a href="<?= $whatsapp; ?>" target="_blank">
        <img src="<?= UPLOAD_PATH.'general/whatsapp.png'; ?>" width="50px" class="whatsapp_float_btn">
    </a>
</div>

<!-- Playstore Icon -->
<div class="playstore_float">
    <a href="<?= $app; ?>" target="_blank">
        <img src="<?= UPLOAD_PATH.'general/playstore.png'; ?>" width="50px" class="playstore_float_btn">
    </a>
</div>

<!-- Cart Icon -->
<?php 

// !empty($_SESSION['cart'])
if($totalProduct > 0){  ?>
<div class="cart_float">
    <a href="cart<?= $extn; ?>">
        <img src="<?= UPLOAD_PATH.'general/cart.png'; ?>" width="50px" class="cart_float_btn">
        <sup style="top: -2.5em;"><span style="background: #000; color: #fff; border-radius: 50%; padding: 8px; font-weight: bold;"><?= $totalProduct; ?></span></sup>
        <h5 class="font-15 bold underline">Go to Cart </h5>
    </a>
</div>
<?php } ?>    