<?php 

    $query="SELECT *,b.pic as bannerimage FROM banner b
    LEFT JOIN category c ON c.ID = b.category_id
    where b.hide = 0 and b.type = '2' and b.category_id = '".$_GET['category']."'
    ORDER BY b.sort ASC";
    
    $sql = mysqli_query($con,$query)or die(mysqli_error());
    $num_row = mysqli_num_rows($sql);
    
    if($num_row > 0)
    {
?>

<div class="sub-categary-slider">
    <div class="slider">
        <?php 
		while($data = mysqli_fetch_assoc($sql))
		{	
		    if(!empty($data['bannerimage'])){
          	    $image = UPLOAD_PATH.'banner/'.$data['bannerimage'];
          	}else{
          	    $image='';
          	}
          	
		?>
        <div>
            <div class="slideCopy-container">
                <div class="slideCopy-content">
                    <img src="<?php echo $image; ?>" alt="">
                </div>
            </div>
        </div>
        <?php } ?>
        
    </div>
</div>
<?php } ?>

<div class="categary-details-section">
    <div class="container" style="margin-top:0px;">
        <?php 
        if(isset($_GET['category']) )
        {
             $query_sub_category_1="SELECT *,s.ID as subid, c.ID as catid,c.category as cname,s.status as substatus,s.pic as subimage FROM `subcategory` s
    		left join category c ON c.ID = s.category_id
    		Where s.category_id = '".$_GET['category']."' and s.status = 1 
    		ORDER BY s.sort ASC";
        	
    		$sql_sub_category_1 = mysqli_query($con,$query_sub_category_1)or die(mysqli_error());
    		
    		$data_sub_category_1 = mysqli_fetch_assoc($sql_sub_category_1);
		
        
        ?>
        <h2 class="text-left"><?php echo $data_sub_category_1['cname']; ?></h2>
        <img src="images/line.png" alt="" class=" mb-4">

        <h2 class="text-left mb-3">Select Your Service</h2>
        <!-- <img src="images/line.webp" alt="" class=" mb-5"> -->
        <div class="row">
            <?php 
            
            $query_sub_category="SELECT *,s.ID as subid, c.ID as catid,c.category as cname,s.status as substatus,s.pic as subimage FROM `subcategory` s
    		left join category c ON c.ID = s.category_id
    		Where s.category_id = '".$_GET['category']."' and s.status = 1 
    		ORDER BY s.sort ASC";
        	
    		$sql_sub_category = mysqli_query($con,$query_sub_category)or die(mysqli_error());
    	
            $num=0; 
            while($data = mysqli_fetch_assoc($sql_sub_category))
		    {	$num=$num+1;
		    
		        if(!empty($data['subimage'])){
          	        $image = UPLOAD_PATH.'subcategory/'.$data['subimage'];
              	}else{
              	    $image='';
              	}
		    ?>
            <div class="col-lg-2 col-sm-6 col-md-3 col-xl-2">
                <div class="categart-details-box">
                    <div class="main-categary">
                        <a href="service.php?category=<?php echo $_GET['category']; ?>&sub_category=<?php echo $data['subid']; ?>">
                            <img src="<?php echo $image; ?>" alt="">
                            <h4 class=""><?php echo $data['subcategory']; ?></h4>
                        </a>
                    </div>
                </div>
            </div>
            <?php } } ?>
        </div>
    </div>
</div>

<!-- single image same as home page -->
<!--<div class="sub_categary_single-img">-->
<!--    <div class="container" style="margin-top: 50px;">-->
<!--        <div class="row">-->
<!--            <div class="col-xl-12 col-md-12 col-sm-12 col-lg-1">-->
<!--                <img src="images/safe-img.webp" alt="">-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
<!--<div class="bonitaa-safer-brand">-->
<!--    <div class="container" style="margin-top: 50px;">-->
<!--        <h2> <img src="images/line  (3).png" alt=""> Bonitaa Safety Standards</h2>-->

<!--        <div class="row">-->
<!--            <div class="col-xl-3 col-sm-6 col-md-4 col-lg-3">-->
<!--                <div class="safer-brand-box">-->
<!--                    <img src="images/bonita safaty/Icon 1.png" alt="">-->
<!--                    <p>Sanitized kits And tools </p>-->
<!--                </div>-->
<!--            </div>-->

<!--            <div class="col-xl-3 col-sm-6 col-md-4 col-lg-3">-->
<!--                <div class="safer-brand-box">-->
<!--                    <img src="images/bonita safaty/Icon 2.png" alt="">-->
<!--                    <p>Temperature Record</p>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-xl-3 col-sm-6 col-md-4 col-lg-3">-->
<!--                <div class="safer-brand-box">-->
<!--                    <img src="images/bonita safaty/Icon 3.png" alt="">-->
<!--                    <p>Vaccinated Professional</p>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-xl-3 col-sm-6 col-md-4 col-lg-3">-->
<!--                <div class="safer-brand-box">-->
<!--                    <img src="images/bonita safaty/Icon 4.png" alt="">-->
<!--                    <p>Mono</p>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->

<div class="why-choos-section">
	<div class="container" style="margin-top:0px;">
		<!--<h2>Our New Launch</h2>-->
		<!--<img src="images/line.png" alt="" class="line-img">-->
		<div class="row">
		    <?php
    		    $query_cat_offers="SELECT *,co.ID as catofferid,co.status as catofferstatus,co.title as catoffername,co.click as catofferclick,co.pic as catofferimage,c.category as category_name,subcat.subcategory as sub_name,subsubcat.subsubcategory_name as subsubsubname FROM `cat_offer` co
        		LEFT JOIN category c ON c.ID = co.category_id
        		LEFT JOIN subcategory subcat ON subcat.ID = co.subcategory_id
        		LEFT JOIN subsubcategory subsubcat ON subsubcat.ID = co.subsubcategory_id
        		WHERE co.status = 1 and co.type=2 and co.category_id='".$_GET['category']."'
        		ORDER BY co.sort ASC";
            	
        		$sql_cat_offers = mysqli_query($con,$query_cat_offers)or die(mysqli_error());
        		
        		
        		while($data_cat_offers = mysqli_fetch_assoc($sql_cat_offers))
        		{	
                  	
                  	if(!empty($data_cat_offers['catofferimage'])){
                  	    $image = UPLOAD_PATH.'cat_offers/'.$data_cat_offers['catofferimage'];
                  	}else{
                  	    $image='';
                  	}

			?>
			<div class="col-xl-12 col-sm-`12 col-md-12 col-lg-12">
				<div class="why-choosh-box">
				    <?php if($data_cat_offers['click'] == 1){ ?>
					<a href="service.php?category=<?php echo $data_cat_offers['category_id']; ?>&sub_category=<?php echo $data_cat_offers['subcategory_id']; ?>">
					<?php }else if($data_cat_offers['click'] == 0){ ?>
					<a href="#">
					<?php } ?>
					    <img src="<?php echo $image; ?>" alt="">
					</a>
				</div>
			</div>
            <?php } ?>
		</div>
    </div>
</div>

<?php 
if(isset($_SESSION['city_id']))
{

$query_testimonial ="SELECT *,r.ID as rid, u.ID as userid, c.ID as cityid,c.name as cityname,u.name as username,u.dp as userimage,r.status as rstatus,r.date as rdate FROM `review` r
LEFT JOIN user_registration u ON u.ID = r.user_id
LEFT JOIN city c ON c.ID = r.city
WHERE r.status = 1 and r.city = '".$_SESSION['city_id']."'
ORDER BY r.feature ASC";

$sql_testimonial = mysqli_query($con,$query_testimonial)or die(mysqli_error());
$num_row_testimonial   = mysqli_num_rows($sql_testimonial);                        
?>
<?php if($num_row_testimonial > 0){ ?>

<!-- testimonial slider -->
<div class="sub-category-page-slider">
    <section class="client-testimonials">
        <div class="container" style="margin-top:0px;">
            <h2>Testimonials</h2>
            <img src="images/line.png" alt="" class="safety-img">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xl-12">
                    <div class="owl-carousel owl-theme ">
                        <?php 
                        
                		while($data_testimonial = mysqli_fetch_assoc($sql_testimonial))
                		{
                		    if(!empty($data_testimonial['userimage'])){
                      	        $image = UPLOAD_PATH.'users/'.$data_testimonial['userimage'];
                          	}else{
                          	    $image='';
                          	}
                        ?>
                        <div class="item">
                            <div class="box">
                                <div class="sub-categary-details">
                                    <div class="sub_categary_page-icon">
                                        <ul>
                                            <?php for ($i=1; $i <= $data_testimonial['rate']; $i++) { ?>
                                                <li><i class="fas fa-star"></i></li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                    <p><?php echo $data_testimonial['comment']; ?></p>
                                </div>
                                <div class="slider-sub-img">
                                    <img src="<?php echo $image; ?>" alt="">
                                </div>
                                <h5 class="mt-3"><?php echo $data_testimonial['username']; ?></h5>
                            </div>
                        </div>
                        <?php }  ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php } ?>
<?php } ?>

<!-- trusted-Brands -->
<!--<div class="trasted-brand">
    <div class="container" style="margin-top: 0px;">
        <h2>Trusted Product And Brand Used By Us</h2>
        <img src="images/line.png" alt="" class="safety-img">
        <div class="row">
         
          <?php 
      /*       $query_brands ="SELECT * FROM brands b where b.status = 1 ORDER BY b.ID DESC";
        	
    		$sql_brands = mysqli_query($con,$query_brands)or die(mysqli_error());
    		
    		while($data_brands = mysqli_fetch_assoc($sql_brands))
    		{
    		    if(!empty($data_brands['image'])){
          	        $image = UPLOAD_PATH.'brands/'.$data_brands['image'];
              	}else{
              	    $image='';
              	}*/
            ?>
            
            <div class="col-xl-2 col-sm-6 col-md-6 col-lg-3">
                <div class="trasted-brand-box">
                    <img src="<?php //echo $image; ?>" alt="">
                </div>
            </div>
            <?php //} ?>
        </div>
    </div>
</div>-->