<?php 
$obj          = new add_to_cart();
$totalProduct = $obj->totalProduct(); 
?>
<!-- <div class="header-top">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="opening-time text-left"><i class="fa fa-clock-o color-d5"></i> <span>Opening Hours: Mon - Sun : 10:00 AM - 05:00 PM</span> </div>
            </div>

            <div class="col-md-6">
                <div class="contact-mail text-right"> 
                    <a href="mailto:<?= $info_email; ?>"><i class="fa fa-envelope color-d5"></i><?= $info_email; ?></a> 
                    <span>/</span> <a href="tel:<?= $call_no; ?>"><i class="fa fa-phone color-d5"></i><?= $call_no ?></a> 
                    <span>/</span> 
                </div>
            </div>
        </div>
    </div>
</div> -->

<header class="beauty-header" id="beauty-header">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div id="menuzord" class="menuzord">
                    <a href="<?= $baseurl; ?>" class="menuzord-brand custom-logo">
                        <img id="logo" src="<?= $header_logo; ?>" alt="logo" style="width: 70px;border-radius: 50%;">
                        <p class="bold text-black font-12" style="padding: 0px;">Salon at Home</p>
                    </a>
                    <ul class="menuzord-menu menuzord-left">
                        <li class="<?= @$homeactive; ?>"><a href="<?= $baseurl; ?>" title="Home">Home</a></li>
                        <li class="<?= @$aboutactive; ?>"><a href="<?= $baseurl.'/aboutus'.$extn; ?>" title="About Us">About</a></li>
                        <!-- <li class="<?= @$catactive; ?>"><a href="JavaScript:void(0)" title="Service">Services</a>
                            <ul class="dropdown triangle">
                            <?php $get_cat = getAllRecords($con, "category", "", "ASC"); 
                            foreach ($get_cat as $list){ ?>
                                <li><a href="<?= $baseurl.'/category/'.$list['categoryurl']; ?>"><?= $list['category']; ?></a></li>
                            <?php } ?>
                            </ul>
                        </li> -->
                        <li class="<?= @$catactive; ?>"><a href="<?= $baseurl.'/services'.$extn; ?>" title="Service">Services</a></li>
                        <li class="<?= @$galleryactive; ?>"><a href="<?= $baseurl.'/gallery'.$extn; ?>" title="Gallery">Gallery</a></li>
                        <li class="<?= @$conactive;?>"><a href="<?= $baseurl.'/contactus'.$extn; ?>" title="Contact">Contact</a></li>
                        <!-- <li class="<?= @$blogactive;?>"><a href="<?= $baseurl.'/blogs'.$extn; ?>" title="Blogs">Blogs</a></li> -->
                        <li class="<?= @$franchiseactive;?>"><a href="<?= $baseurl.'/franchise'.$extn; ?>" title="Franchise">Franchise</a></li>
                        <li><span id="locationbtn" data-toggle="modal" data-target="#locationModal"><i class="fa fa-map-marker"></i> <?php echo (!empty($_COOKIE['location'])) ? $_COOKIE['location'] : "Location"; ?></span></li>
                    </ul>
                    <div class="location-div"></div>
                    <div class="cart-div"></div>

                    <ul class="menuzord-menu menuzord-right">
                        <?php if(empty($userSession)){ ?>
                        <li>
                            <a href="<?= $baseurl.'/login'.$extn; ?>" class="btn btn-warning btn-sm" style="margin: 23px 10px; padding: 3px 7px;">Login / Signup</a>
                        </li>
                        <?php }else{ ?>
                        <li>
                            <a href="JavaScript:void(0)" title="Service" id="logged-user-name" class="btn btn-dark btn-sm text-white" style="margin: 16px 10px;padding: 2px 5px;"><i class="fa fa-user"></i> <?= ucfirst($CLU_name); ?></a>
                            <ul class="dropdown triangle">
                                <li><a href="myaccount<?= $extn; ?>"><i class="fa fa-user"></i> My Account</a></li>
                                <li><a href="#"><i class="fa fa-money"></i> Share & Earn</a></li>
                                <li><a href="#"><i class="fa fa-gift"></i> Offers & Gifts </a></li>
                                <li><a href="orders<?= $extn; ?>"><i class="fa fa-opencart"></i> Orders</a></li>
                                <li><a href="changepassword<?= $extn; ?>"><i class="fa fa-key"></i> Change Password</a></li>
                                <li><a href="logout<?= $extn; ?>"><i class="fa fa-sign-out"></i> Logout</a></li>
                            </ul>
                        </li>
                        <?php } ?>
                        <li><a href="<?= $baseurl.'/cart'.$extn; ?>" id="addtocart-button"><i class="fa fa-shopping-cart"></i> <sup class="cart_class bold" style="top: -.9em;"><?= $totalProduct; ?></sup></a></li>
                    </ul>
                    
                    
                    <!-- <button type="button" id="search-button" data-toggle="modal" data-target="#search-modal"><i class="fa fa-search"></i></button> -->
                </div>
                <!--/#menuzord-->
            </div>
            <!--/col-md-12-->
        </div>
    </div>
    <input type="hidden" name="baseurl" value="<?= $baseurl; ?>" id="baseurl">
</header>
