<?php  
$break_url = explode('?',$_SERVER['REQUEST_URI']);  
$url = $break_url['0'];
$url2 = @$break_url['1']; 
$subfolder = "admin";
?>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?= UPLOAD_PATH.'avtar.jpg'; ?>" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><?= $supername; ?></p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
<?php if($url== "/$subfolder/dashboard$extn" || $_SERVER['REQUEST_URI']== "/$subfolder/dashboard$extn") { ?><li class="active"><?php } else {?><li><?php } ?>
        <a href="dashboard<?=$extn;?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
      </li> 

<?php if($url=="/$subfolder/category$extn" || $_SERVER['REQUEST_URI']=="/$subfolder/category$extn") { ?><li class="active"><?php } else {?><li><?php } ?>
        <a href="category<?= $extn; ?>"><i class="fa fa-th-large"></i> <span>Category</span>
          <span class="pull-right-container">
            <small class="label pull-right bg-primary"><?php getCountWhere($con,'category',"WHERE hide=0"); ?></small>
          </span>
        </a>
      </li> 

<?php if($url=="/$subfolder/subcategory$extn" || $_SERVER['REQUEST_URI']=="/$subfolder/subcategory$extn") { ?><li class="active"><?php } else {?><li><?php } ?>
        <a href="subcategory<?= $extn; ?>"><i class="fa fa-cubes"></i> <span>Sub Category</span>
          <span class="pull-right-container">
            <small class="label pull-right bg-green"><?php getCountWhere($con,'subcategory',"WHERE hide=0"); ?></small>
          </span>
        </a>
      </li>    

<?php if($url=="/$subfolder/subsubcategory$extn" || $_SERVER['REQUEST_URI']=="/$subfolder/subsubcategory$extn") { ?><li class="active"><?php } else {?><li><?php } ?>
        <a href="subsubcategory<?= $extn; ?>"><i class="fa fa-cubes"></i> <span>Sub Sub Category</span>
          <span class="pull-right-container">
            <small class="label pull-right bg-green"><?php getCountWhere($con,'subsubcategory',"WHERE hide=0"); ?></small>
          </span>
        </a>
      </li>    

<?php if($url=="/$subfolder/services$extn" || $_SERVER['REQUEST_URI']=="/$subfolder/services$extn") { ?><li class="active"><?php } else {?><li><?php } ?>
        <a href="services<?= $extn; ?>"><i class="fa fa-shopping-cart"></i> <span>Services</span>
          <span class="pull-right-container">
            <small class="label pull-right bg-blue"><?php getCountWhere($con,'services',"WHERE hide=0"); ?></small>
          </span>
        </a>
      </li>     
    <li class="treeview">
      <a href="#"><i class="fa fa-laptop"></i><span> Appointment  </span><i class="fa fa-angle-left pull-right"></i></a>
      <!--<?php if($url=="/$subfolder/order$extn" || $_SERVER['REQUEST_URI']=="/$subfolder/order$extn") { ?><li class="active"><?php } else {?><li><?php } ?>-->
      <!--      <a href="order<?= $extn; ?>"><i class="fa fa-list"></i> <span>Appointment Masters</span></a>-->
      <!--    </li> -->
        <ul class="treeview-menu">    
            <?php if ($url == "/$subfolder/order$extn" || $_SERVER['REQUEST_URI'] == "/$subfolder/order$extn") {?>
            <li class="active"><?php } else {?><li><?php }?>
                <a href="order<?php echo $extn ?>"><i class="fa fa-list"></i> Appointment Masters</a></li>
            </li>
            
            <?php if ($url == "/$subfolder/todayorder$extn" || $_SERVER['REQUEST_URI'] == "/$subfolder/todayorder$extn") {?>
            <li class="active"><?php } else {?><li><?php }?>
                <a href="todayorder<?php echo $extn ?>"><i class="fa fa-list"></i> Today Appointment </a></li>
            </li>
        </ul>
    </li>
        
      
<!-- Frontend Settings ::START  -->
<?php if ($url == "/$subfolder/banner$extn" || $_SERVER['REQUEST_URI'] == "/$subfolder/banner$extn" || $url == "/$subfolder/gallery$extn" || $_SERVER['REQUEST_URI'] == "/$subfolder/gallery$extn" || $url == "/$subfolder/faqs$extn" || $_SERVER['REQUEST_URI'] == "/$subfolder/faqs$extn" || $url == "/$subfolder/pages$extn" || $_SERVER['REQUEST_URI'] == "/$subfolder/testimonials$extn" || $url == "/$subfolder/pages$extn" || $_SERVER['REQUEST_URI'] == "/$subfolder/testimonials$extn" || $url == "/$subfolder/locations$extn" || $_SERVER['REQUEST_URI'] == "/$subfolder/locations$extn") {?>
  <li class="active treeview">
    <a href="#"><i class="fa fa-laptop"></i><span> Website Settings </span><i class="fa fa-angle-left pull-right"></i></a>
  <?php } else {?>
    <li class="treeview">
      <a href="#"><i class="fa fa-laptop"></i><span> Website Settings </span><i class="fa fa-angle-left pull-right"></i></a>
  <?php }?>
    <ul class="treeview-menu">
      <?php if ($url == "/$subfolder/banner$extn" || $_SERVER['REQUEST_URI'] == "/$subfolder/banner$extn") {?>
      <li class="active"><?php } else {?><li><?php }?>
        <a href="banner<?php echo $extn ?>"><i class="fa fa-image"></i> Banner Settings</a>
      </li>

      <!-- <?php if ($url == "/$subfolder/brands$extn" || $_SERVER['REQUEST_URI'] == "/$subfolder/brands$extn") {?>-->
      <!--<li class="active"><?php } else {?><li><?php }?>-->
      <!--  <a href="brands<?php echo $extn ?>"><i class="fa fa-file-image-o"></i> Brands</a>-->
      <!--</li>      -->

     <!--  <?php if ($url == "/$subfolder/faqs$extn" || $_SERVER['REQUEST_URI'] == "/$subfolder/faqs$extn") {?>
      <li class="active"><?php } else {?><li><?php }?>
        <a href="faqs<?php echo $extn ?>"><i class="fa fa-question-circle"></i> Faqs</a>
      </li> -->

      <?php if($superrole==0){ ?>
      <?php if ($url == "/$subfolder/pages$extn" || $_SERVER['REQUEST_URI'] == "/$subfolder/pages$extn") {?>
      <!--<li class="active"><?php } else {?><li><?php }?>
      <!--  <a href="pages<?php echo $extn ?>"><i class="fa fa-th"></i> Dynamic Pages</a>-->
      <!--</li>-->
      <?php } ?>
      <?php if ($url == "/$subfolder/testimonials$extn" || $_SERVER['REQUEST_URI'] == "/$subfolder/testimonials$extn") {?>
      <li class="active"><?php } else {?><li><?php }?>
        <a href="testimonials<?php echo $extn ?>"><i class="fa fa-quote-left"></i> Testimonials</a>
      </li>
      <?php if ($url == "/$subfolder/state$extn" || $_SERVER['REQUEST_URI'] == "/$subfolder/state$extn") {?>
      <li class="active"><?php } else {?><li><?php }?>
        <a href="state<?php echo $extn ?>"><i class="fa fa-map-marker"></i> State</a>
      </li>  

      <?php if ($url == "/$subfolder/city$extn" || $_SERVER['REQUEST_URI'] == "/$subfolder/city$extn") {?>
      <li class="active"><?php } else {?><li><?php }?>
        <a href="city<?php echo $extn ?>"><i class="fa fa-map-marker"></i> City</a>
      </li>  
      
      <?php if ($url == "/$subfolder/pincode$extn" || $_SERVER['REQUEST_URI'] == "/$subfolder/pincode$extn") {?>
      <li class="active"><?php } else {?><li><?php }?>
        <a href="pincode<?php echo $extn ?>"><i class="fa fa-map-marker"></i> Pincode</a>
      </li>  


    </ul>
  </li> 
  

<!-- Frontend Settings ::END  -->

<?php if($superrole==0){ ?>
<!-- Franchise Managment Settings ::START  -->
<?php //if ($url == "/$subfolder/franchise-members$extn" || $_SERVER['REQUEST_URI'] == "/$subfolder/franchise-members$extn" || $url == "/$subfolder/franchise-enquiry$extn" || $_SERVER['REQUEST_URI'] == "/$subfolder/franchise-enquiry$extn") {?>
 <!--  <li class="active treeview">
    <a href="#"><i class="fa fa-sitemap"></i><span> Franchise Managment </span><i class="fa fa-angle-left pull-right"></i></a>
  <?php } else {?>
    <li class="treeview">
      <a href="#"><i class="fa fa-sitemap"></i><span> Franchise Managment </span><i class="fa fa-angle-left pull-right"></i></a>
  <?php }?>
    <ul class="treeview-menu">
      
      <?php if ($url == "/$subfolder/franchise-members$extn" || $_SERVER['REQUEST_URI'] == "/$subfolder/franchise-members$extn") {?>
      <li class="active"><?php } else {?><li><?php }?>
        <a href="franchise-members<?php echo $extn ?>"><i class="fa fa-hand-o-right"></i> Franchise Accounts</a>
      </li>

      <?php if($url=="/$subfolder/franchise-enquiry$extn" || $_SERVER['REQUEST_URI']=="/$subfolder/franchise-enquiry$extn") { ?><li class="active"><?php } else {?><li><?php } ?>
        <a href="franchise-enquiry<?=$extn;?>"><i class="fa fa-vcard"></i> <span>Franchise Enquiry</span></a>
      </li>

    </ul>
  </li>  -->
<!-- Franchise Managment Settings ::END  -->
<?php //} ?> 	  


<?php if($url=="/$subfolder/franchise$extn" || $_SERVER['REQUEST_URI']=="/$subfolder/franchise$extn") { ?><li class="active"><?php } else {?><li><?php } ?>
        <a href="franchise<?= $extn; ?>"><i class="fa fa-users"></i> <span>Franchise</span>
        </a>
      </li>    



<?php if($url=="/$subfolder/users$extn" || $_SERVER['REQUEST_URI']=="/$subfolder/users$extn") { ?><li class="active"><?php } else {?><li><?php } ?>
        <a href="users<?= $extn; ?>"><i class="fa fa-users"></i> <span>Users Master</span>
          <span class="pull-right-container">
            <small class="label pull-right bg-red"><?php getCount($con,'user_registration'); ?></small>
          </span>
        </a>
      </li>      

<?php if($superrole==0){ ?>
<!-- <?php if($url=="/$subfolder/review$extn" || $_SERVER['REQUEST_URI']=="/$subfolder/review$extn") { ?><li class="active"><?php } else {?><li><?php } ?>
        <a href="review<?= $extn; ?>"><i class="fa fa-star"></i> <span>Service Review</span></a>
      </li>  -->
<?php } ?> 	  
	  



<?php if($url=="/$subfolder/coupon-master$extn" || $_SERVER['REQUEST_URI']=="/$subfolder/coupon-master$extn") { ?><li class="active"><?php } else {?><li><?php } ?>
        <a href="coupon-master<?= $extn; ?>"><i class="fa fa-money"></i> <span>Coupon Master</span></a>
      </li>       
	  
<!--<?php if($url=="/$subfolder/offers$extn" || $_SERVER['REQUEST_URI']=="/$subfolder/offers$extn") { ?><li class="active"><?php } else {?><li><?php } ?>-->
<!--        <a href="offers<?= $extn; ?>"><i class="fa fa-money"></i> <span>Offers</span></a>-->
<!--      </li>  -->
      
     <li class="treeview">
      <a href="#"><i class="fa fa-laptop"></i><span> Offers  </span><i class="fa fa-angle-left pull-right"></i></a>
   
        <ul class="treeview-menu">    
           
            
            <?php if ($url == "/$subfolder/offers$extn" || $_SERVER['REQUEST_URI'] == "/$subfolder/offers$extn") {?>
            <li class="active"><?php } else {?><li><?php }?>
                <a href="offers<?php echo $extn ?>"><i class="fa fa-list"></i> Offers List </a></li>
            </li>
            
            <?php if ($url == "/$subfolder/newlunchoffers$extn" || $_SERVER['REQUEST_URI'] == "/$subfolder/newlunchoffers$extn") {?>
            <li class="active"><?php } else {?><li><?php }?>
                <a href="newlunchoffers<?php echo $extn ?>"><i class="fa fa-list"></i> New Launch Offers </a></li>
            </li>
            
            <?php if ($url == "/$subfolder/categoryoffers$extn" || $_SERVER['REQUEST_URI'] == "/$subfolder/categoryoffers$extn") {?>
            <li class="active"><?php } else {?><li><?php }?>
                <a href="categoryoffers<?php echo $extn ?>"><i class="fa fa-list"></i> Category offer </a></li>
            </li>
            
        </ul>
    </li>

    <li class="treeview">
      <a href="#"><i class="fa fa-laptop"></i><span> Staff  </span><i class="fa fa-angle-left pull-right"></i></a>
   
        <ul class="treeview-menu">    
            <?php if ($url == "/$subfolder/staff$extn" || $_SERVER['REQUEST_URI'] == "/$subfolder/staff$extn") {?>
            <li class="active"><?php } else {?><li><?php }?>
                <a href="staff<?php echo $extn ?>"><i class="fa fa-list"></i> Staff Master
                <span class="pull-right-container">
                    <small class="label pull-right bg-red"><?php getCount($con,'staff'); ?></small>
                </span></a></li>
                
            </li>
            
            <?php if ($url == "/$subfolder/stafforderinsight$extn" || $_SERVER['REQUEST_URI'] == "/$subfolder/stafforderinsight$extn") {?>
            <li class="active"><?php } else {?><li><?php }?>
                <a href="stafforderinsight<?php echo $extn ?>"><i class="fa fa-list"></i> Staff Book Insight </a></li>
            </li>
            
            <?php if ($url == "/$subfolder/stafforderfilter$extn" || $_SERVER['REQUEST_URI'] == "/$subfolder/stafforderfilter$extn") {?>
            <li class="active"><?php } else {?><li><?php }?>
                <a href="stafforderfilter<?php echo $extn ?>"><i class="fa fa-list"></i> Staff Book List </a></li>
            </li>
            
        </ul>
    </li>
    
    <?php if($url=="/$subfolder/staffleaves$extn" || $_SERVER['REQUEST_URI']=="/$subfolder/staffleaves$extn") { ?><li class="active"><?php } else {?><li><?php } ?>
        <a href="staffleaves<?= $extn; ?>"><i class="fa fa-users"></i> <span>Staff Leaves</span>
        </a>
      </li>

      <?php if($url=="/$subfolder/rechargefine$extn" || $_SERVER['REQUEST_URI']=="/$subfolder/rechargefine$extn") { ?><li class="active"><?php } else {?><li><?php } ?>
        <a href="rechargefine<?= $extn; ?>"><i class="fa fa-users"></i> <span>Staff Recharge & Fine</span>
        </a>
      </li> 



    <!--   <?php if($url=="/$subfolder/product$extn" || $_SERVER['REQUEST_URI']=="/$subfolder/product$extn") { ?><li class="active"><?php } else {?><li><?php } ?>
        <a href="product<?= $extn; ?>"><i class="fa fa-users"></i> <span>Product</span>
        </a>
      </li>    -->

<!-- 
      <?php if($url=="/$subfolder/product_staff_inventory$extn" || $_SERVER['REQUEST_URI']=="/$subfolder/product_staff_inventory$extn") { ?><li class="active"><?php } else {?><li><?php } ?>
        <a href="product_staff_inventory<?= $extn; ?>"><i class="fa fa-users"></i> <span>Product Inventory</span>
        </a>
      </li>  -->

       <li class="treeview">
      <a href="#"><i class="fa fa-laptop"></i><span> Products  </span><i class="fa fa-angle-left pull-right"></i></a>
   
        <ul class="treeview-menu">    
           
            
            <?php if ($url == "/$subfolder/product$extn" || $_SERVER['REQUEST_URI'] == "/$subfolder/product$extn") {?>
            <li class="active"><?php } else {?><li><?php }?>
                <a href="product<?php echo $extn ?>"><i class="fa fa-list"></i> Product List </a></li>
            </li>
            
            <?php if ($url == "/$subfolder/product_staff_inventory$extn" || $_SERVER['REQUEST_URI'] == "/$subfolder/product_staff_inventory$extn") {?>
            <li class="active"><?php } else {?><li><?php }?>
                <a href="product_staff_inventory<?php echo $extn ?>"><i class="fa fa-list"></i>Product Inventory</a></li>
            </li>
            
            <?php if ($url == "/$subfolder/product_request$extn" || $_SERVER['REQUEST_URI'] == "/$subfolder/product_request$extn") {?>
            <li class="active"><?php } else {?><li><?php }?>
                <a href="product_request<?php echo $extn ?>"><i class="fa fa-list"></i> Product Request </a></li>
            </li>

           <!--  <?php if ($url == "/$subfolder/product_request_variation$extn" || $_SERVER['REQUEST_URI'] == "/$subfolder/product_request_variation$extn") {?>
            <li class="active"><?php } else {?><li><?php }?>
                <a href="product_request_variation<?php echo $extn ?>"><i class="fa fa-list"></i> Product Request Variation</a></li>
            </li> -->
            
        </ul>
      </li>


      

      <!--<?php if($url=="/$subfolder/staff$extn" || $_SERVER['REQUEST_URI']=="/$subfolder/staff$extn") { ?><li class="active"><?php } else {?><li><?php } ?>-->
      <!--  <a href="staff<?= $extn; ?>"><i class="fa fa-users"></i> <span>Staff Master</span>-->
      <!--    <span class="pull-right-container">-->
      <!--      <small class="label pull-right bg-red"><?php getCount($con,'staff'); ?></small>-->
      <!--    </span>-->
      <!--  </a>-->
      <!--</li>   -->
      
      <?php if($url=="/$subfolder/blogs$extn" || $_SERVER['REQUEST_URI']=="/$subfolder/blogs$extn") { ?><li class="active"><?php } else {?><li><?php } ?>
        <a href="blogs<?= $extn; ?>"><i class="fa fa-users"></i> <span>Blogs</span>
        </a>
      </li> 
      
       <?php if($url=="/$subfolder/Videos$extn" || $_SERVER['REQUEST_URI']=="/$subfolder/videos$extn") { ?><li class="active"><?php } else {?><li><?php } ?>
        <a href="videos<?= $extn; ?>"><i class="fa fa-users"></i> <span>Videos</span>
        </a>
      </li> 

      
      <?php if($url=="/$subfolder/notification$extn" || $_SERVER['REQUEST_URI']=="/$subfolder/notification$extn") { ?><li class="active"><?php } else {?><li><?php } ?>
        <a href="notification<?= $extn; ?>"><i class="fa fa-users"></i> <span>Notification</span>
        </a>
      </li> 

      <?php if($url=="/$subfolder/settings$extn" || $_SERVER['REQUEST_URI']=="/$subfolder/settings$extn") { ?><li class="active"><?php } else {?><li><?php } ?>
        <a href="settings<?= $extn; ?>"><i class="fa fa-users"></i> <span>Settings</span>
        </a>
      </li> 
   
<!-- <?php if($url=="/$subfolder/contact$extn" || $_SERVER['REQUEST_URI']=="/$subfolder/contact$extn") { ?><li class="active"><?php } else {?><li><?php } ?>
        <a href="contact<?=$extn;?>"><i class="fa fa-comment"></i> <span>Website Query</span>
          <span class="pull-right-container">
            <small class="label pull-right label-danger"><?php //getCountWhere($con,'contact',"WHERE hide='0' AND seen='0'"); ?></small>
          </span>
        </a>
      </li> -->


<!-- <?php if($url=="/$subfolder/popup-query$extn" || $_SERVER['REQUEST_URI']=="/$subfolder/popup-query$extn") { ?><li class="active"><?php } else {?><li><?php } ?>
        <a href="popup-query<?=$extn;?>"><i class="fa fa-comment-o"></i> <span>Popup Query</span></a>
      </li> -->

<!-- <?php if($url=="/$subfolder/blogs$extn" || $_SERVER['REQUEST_URI']=="/$subfolder/blogs$extn") { ?><li class="active"><?php } else {?><li><?php } ?>
        <a href="blogs<?=$extn;?>"><i class="fa fa-rss-square"></i> <span>Blog Writing</span></a>
      </li>    -->   

<?php if($url=="/$subfolder/changepassword$extn" || $_SERVER['REQUEST_URI']=="/$subfolder/changepassword$extn") { ?><li class="active"><?php } else {?><li><?php } ?>
        <a href="changepassword<?=$extn;?>"><i class="fa fa-key"></i> <span>Change Password</span></a>
      </li>      
      <li><a href="logout<?=$extn;?>"><i class="fa fa-sign-out"></i><span>Logout</span></a></li>



     <!--  <?php if($url=="/$subfolder/extra$extn" || $_SERVER['REQUEST_URI']=="/$subfolder/extra$extn") { ?><li class="active"><?php } else {?><li><?php } ?>
        <a href="extra<?= $extn; ?>"><i class="fa fa-shopping-cart"></i> <span>Extra</span>
          <span class="pull-right-container">
            <small class="label pull-right bg-blue"><?php //getCountWhere($con,'extra',"WHERE hide='0'"); ?></small>
          </span>
        </a>
      </li>      -->

    </ul>
  </section>
  <!-- /.sidebar -->
</aside>