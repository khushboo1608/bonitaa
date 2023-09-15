<?php
function hoursandmins($time)
{
    if ($time < 1) {
        return;
    }
    $hours = floor($time / 60);
    $minutes = ($time % 60);
    
    if( $hours == 0 )
        return "{$minutes} minutes";
    else
        return "{$hours} hours {$minutes} minutes";
        
    // return sprintf($format, $hours, $minutes);
}
?>
<div class="header-box" style="position: sticky; top:50px; background:red;"></div>
   
<div class="md:relative">
    <div class=" z-50 md:h-auto sticky inset-x-0 top-0%  md:shadow-none md:inset-y-0 md:left-0 bg-gray-800"
        x-data="{ open: false }">
        <div class="  bg-gray-900 flex items-center justify-between md:justify-center" style="display: none;">
            <button
                class="md:hidden inline-flex p-2 text-gray-600 hover:text-gray-100 hover:bg-gray-700 focus:text-gray-100 focus:bg-gray-700 rounded focus:outline-none items-center justify-center"
                @click="open = !open">
                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" clip-rule="evenodd" x-show="!open"
                        d="M3 7a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 13a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" />
                    <path fill-rule="evenodd" clip-rule="evenodd" x-show="open"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" />
                </svg>
            </button>
        </div>
        <?php 
         $query_sub_sub_category="SELECT *,subsubcat.ID as subsubid,subcat.ID as subid,subsubcat.status as subsubstatus,c.ID as catid,c.category as category_name,subcat.subcategory as sub_name,subsubcat.pic as subsubimage,subsubcat.description as subsubdescription FROM `subsubcategory` subsubcat
        LEFT JOIN category c ON c.ID = subsubcat.category
        LEFT JOIN subcategory subcat ON subcat.ID = subsubcat.subcategory
        WHERE subsubcat.category = '".$_GET['category']."' and subsubcat.subcategory = '".$_GET['sub_category']."' and subsubcat.status = 1
        ORDER BY subsubcat.sort ASC";
        
        $sql_sub_sub_category = mysqli_query($con,$query_sub_sub_category)or die(mysqli_error());
        $count = mysqli_num_rows($sql_sub_sub_category);
        if($count>0){
        ?>
        <div class="nav-scroller-box">
            <div class="container" style="margin-top:0px;">
                <div class="flex-container">
                    <!-- <div class="item">First item</div> -->
                    <nav class=" flex-col text-gray-600 nav-control">
                        <div class="nav-control-iiner-box">
                            <?php
                               
                        		$num=0;
                        		
                        		while($data_sub_sub_category = mysqli_fetch_assoc($sql_sub_sub_category))
                    		    {
                    		       $num=$num+1; 
                		           if(!empty($data_sub_sub_category['subsubimage'])){
                                  	    $image = UPLOAD_PATH.'subsubcategory/'.$data_sub_sub_category['subsubimage'];
                                  	}else{
                                  	    $image='';
                                  	}
              
                            ?>
                            
                            <a href="#<?php echo $data_sub_sub_category['subsubcategory_name']; ?>"
                                class=" item p-2 mt-1 font-medium text-sm rounded transition duration-150 ease-in-out  bg-gray-900 shadow-inner active">
                                <img src="images/sub-2_categary tabs image/1.webp" alt=""> <?php echo $data_sub_sub_category['subsubcategory_name']; ?></a>
                            <?php } ?>
                            
                        </div>

                    </nav>
                </div>

            </div>
        </div>
        <?php }else{ ?>
        <h4 class="not-found-text"> No data found. </h4>
        <?php }?>
        
        
        
        
        <!-- mobile View Scroll -->
        
        <?php
            $query_sub_sub_category="SELECT *,subsubcat.ID as subsubid,subcat.ID as subid,subsubcat.status as subsubstatus,c.ID as catid,c.category as category_name,subcat.subcategory as sub_name,subsubcat.pic as subsubimage,subsubcat.description as subsubdescription FROM `subsubcategory` subsubcat
            LEFT JOIN category c ON c.ID = subsubcat.category
            LEFT JOIN subcategory subcat ON subcat.ID = subsubcat.subcategory
            WHERE subsubcat.category = '".$_GET['category']."' and subsubcat.subcategory = '".$_GET['sub_category']."' and subsubcat.status = 1
            ORDER BY subsubcat.sort ASC";
            
            $sql_sub_sub_category = mysqli_query($con,$query_sub_sub_category)or die(mysqli_error());
            
            $count = mysqli_num_rows($sql_sub_sub_category);
            if($count>0){
            
        ?>
        <div class="nav-fixed-box">
            <div class="mobile-scroller-box">
                <div class="container" style="margin-top:0px; position:fixed;">
                    <div class="flex-container">
                        <!-- <div class="item">First item</div> -->
                        <nav class=" flex-col text-gray-600 nav-control">
                            <div class="nav-control-iiner-box">
                                
                        		<?php $num=0;
                        		while($data_sub_sub_category = mysqli_fetch_assoc($sql_sub_sub_category))
                    		    {
                    		       $num=$num+1; 
                		           if(!empty($data_sub_sub_category['subsubimage'])){
                                  	    $image = UPLOAD_PATH.'subsubcategory/'.$data_sub_sub_category['subsubimage'];
                                  	}else{
                                  	    $image='';
                                  	}
                               
                                ?>
                                
                                <a href="#<?php echo $data_sub_sub_category['subsubcategory_name']; ?>"
                                class="<?php echo $data_sub_sub_category['subsubcategory_name']; ?> item p-2 mt-1 font-medium text-sm rounded transition duration-150 ease-in-out  bg-gray-900 shadow-inner active"><img
                                    src="images/sub-2_categary tabs image/1.webp" alt=""> <?php echo $data_sub_sub_category['subsubcategory_name']; ?></a>
                                <?php } ?>
                            </div>

                        </nav>
                    </div>

                </div>
            </div>
        </div>
        <?php }else{ ?>
        <h4 class="not-found-text-2"> No data found. </h4>
        <?php } ?>

    </div>
</div>
</div>
<div class=" md:ml-auto md:sticky">
    <div class="container" style="margin-top: 0px;">
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <main>
                    <?php
                    $num=0;
                    $query_sub_sub_category="SELECT *,subsubcat.ID as subsubcatid FROM `subsubcategory` subsubcat
            		WHERE subsubcat.category = '".$_GET['category']."' and subsubcat.subcategory = '".$_GET['sub_category']."' and subsubcat.status = 1
            		ORDER BY subsubcat.sort ASC";
                	
            		$sql_sub_sub_category = mysqli_query($con,$query_sub_sub_category)or die(mysqli_error());
            		while($data_sub_sub_category = mysqli_fetch_assoc($sql_sub_sub_category))
        		    {
                    ?>
                    <section id="<?php echo $data_sub_sub_category['subsubcategory_name']; ?>">
                        <div class="w-full max-w-8xl mx-auto    nav-controller_box mt-2 active">
                            <h2
                                class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:leading-9 sm:truncate mb-8">
                                <?php echo $data_sub_sub_category['subsubcategory_name']; ?>
                            </h2>
                            <div>
                               
                    
                            <?php
                            $query_service="SELECT *,s.ID as serviceid,c.ID as catid,subcat.ID as subid,subsubcat.ID as subsubid,c.category as category_name,subcat.subcategory as sub_name,s.pic as serviceimage,s.status as servicestatus  FROM `services` s 
                    		LEFT JOIN category c ON c.ID = s.category
                    		LEFT JOIN subcategory subcat ON subcat.ID = s.subcategory 
                    		LEFT JOIN subsubcategory subsubcat ON subsubcat.ID = s.subsubcategory
                    		WHERE s.category = '".$_GET['category']."' AND s.subcategory = '".$_GET['sub_category']."' and s.subsubcategory='".$data_sub_sub_category['subsubcatid']."' and s.status = 1
                    		GROUP BY s.ID
                    		ORDER BY s.sort ASC";
                        	
                    		$sql_service = mysqli_query($con,$query_service)or die(mysqli_error());
                    	    
                    		while($data_service = mysqli_fetch_assoc($sql_service))
                		    {
                		        $num=$num+1;
                		         if(!empty($data_service['serviceimage'])){
                          	        $image = UPLOAD_PATH.'service/'.$data_service['serviceimage'];
                              	}else{
                              	    $image='';
                              	}
                		    ?>
                            <div class="waxix-box">
                                <div class="waxix-img">
                                    <div class="waxim-text-img">
                                        <img src="<?php echo $image; ?>" alt="">
                                        <!-- <h4><?php echo $data_service['title'];  ?></h4> -->

                                    </div>
                                    <?php if(!empty($data_service['short_description'])){ ?>
                                    <ul>
                                        <li><?php echo $data_service['short_description'];  ?></li>
                                        <a href="#" class="view-details-text-2">View Details</a>
                                    </ul>
                                    <?php }else{} ?>
                                    
                                    <?php if($data_service['feature'] == 1){ ?>
                                    <div class="service-details">
                                        <p>TRENDING</p>
                                    </div>
                                    <?php } ?>
                                    <!--<div class="service-details3">-->
                                    <!--    <p>TRENDING</p>-->
                                    <!--</div>-->
                            </div>
                                <div class="waxix-content">
                                    <h4><?php echo $data_service['title'];  ?></h4>
                                    <!--<h4>Service ID:- <?php echo $data_service['serviceid'];  ?></h4>-->
                                        <?php if(!empty($data_service['short_description'])){ ?>
                                        <ul>
                                            <li><?php echo $data_service['short_description'];  ?></li>
                                        </ul>
                                        <?php }else{} ?>
                        
                                        <a href="#" class="view-details-text">View Details</a>
                                        <div class="service_time"><i class="fa fa-clock"></i><span class="time"><?php echo hoursandmins($data_service['duration']); ?></span></div>
                                        <div class="bottom_right">
                        
                                            <div class="Price_box"><span class="Price">₹<?php echo $data_service['discount_amount']; ?>/-</span><span class="prev_price">₹<?php echo $data_service['original_amount']; ?></span><span class="discount"><?php echo $data_service['discount']; ?>% off</span></div>
                                            <div class="show_time"><i class="fa fa-clock-o"></i><span class="time"><?php echo hoursandmins($data_service['duration']); ?></span></div>
                                            <?php 
                                            if(isset($_SESSION['user_id'])) { 
                                            $sql = "SELECT * FROM cart WHERE user_id='".$_SESSION['user_id']."' and services_id='".$data_service['serviceid']."' ";
                                            
                                            $total = 0;
                                            $totals_is_various = 0;
                                            $total_qty = 0;
                                            
                                            $result = mysqli_query($con,$sql);
                                            $count = mysqli_num_rows($result);
                                            if($count>0){
                                            while($row = mysqli_fetch_array($result)) {

                                                 
            
                                            ?>
                                             
                                            <div class="home-page_conuter">
                                                <div class="Counter-number-add">
                                                    <div class="center">
                                                        <div class="input-group">
                                                            <span class="input-group-btn">
                                                                <button type="button" class="btn btn-danger btn-number-1 qty_minus" data-id="<?php echo $data_service['serviceid'];?>" data-type="minus" data-field="quant[<?php echo $num; ?>]">
                                                                    <i class="fa fa-minus"></i>
                                                                </button>
                                                            </span>
                                                            <!-- <input type="text" name="quant[<?php echo $num; ?>]"  id="quant" class="form-control input-number-1" value="<?php echo $row['cart_services_qty'];  ?>" min="0" max="100"> -->
                    
                                                            <input type="text" name="quant[<?php echo $num; ?>]"  id="quant_<?php echo $data_service['serviceid']; ?>" class="form-control input-number-1" value="<?php echo $row['cart_services_qty'];  ?>" min="0" max="100">
                    
                                                            <span class="input-group-btn">
                                                                <button type="button" class="btn btn-success btn-number-1 qty_plus" data-id="<?php echo $data_service['serviceid'];?>" data-type="plus" data-field="quant[<?php echo $num; ?>]">
                                                                    <i class="fa fa-plus"></i>
                                                                </button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            
                                            <?php }
                                                
                                            }else{ ?>
                                            
                                                <div class="add_cart"><a name="addtocart" class="addtocart add" href="javascript:void(0)" data-toggle="tooltip" data-id="<?php echo $data_service['serviceid'];?>" ><button class="add_cart_btn">ADD TO CART</button></a></div> 
        
                                            <?php }
                                            ?>
                                                
                                            <?php }else{ ?>
                                             <a href="./register.php" class="text-white">
                                               <button type="button" class="Login-btn" >
                                                 Login / Register
                                                </button>
                                            </a>
                                            <?php } ?>
                                        </div>
                            </div>
                            </div>
                            <?php } ?>
                           
                        </div>
                    </section>
                    <?php } ?>
                
                </main>
            </div>
        </div>
    </div>

</div>


<!-- service-bottom sticky-box   -->
 <?php 
    if(isset($_SESSION['user_id'])) { 
    $sql = "SELECT * FROM cart WHERE user_id='".$_SESSION['user_id']."' ";
    
    $total = 0;
    $totals_is_various = 0;
    $total_qty = 0;
    
    $result = mysqli_query($con,$sql);
    $count = mysqli_num_rows($result);
    if($count>0){
    while($row_cart = mysqli_fetch_array($result)) { 
        
        $totals_is_various1 =  $row_cart["cart_services_qty"] * $row_cart["cart_services_ori_amount"];
        $totals_is_various += $totals_is_various1;
    
        $totals =  $row_cart["cart_services_qty"] * $row_cart["cart_services_dis_amount"];
        $total += $totals;
        
        
        $totals_qty +=  $row_cart["cart_services_qty"];
        // $total_qty += $totals_qty;
        
        if($total == "")
        {
            $total1 = '0';
        }else{
            $total1 = $total; 
        }
    
        if($totals_is_various == "")
        {
            $totals_is_various1 = '0';
        }else{
            $totals_is_various1 = $totals_is_various; 
        }
?>
<div class="footer-sticky-box">
    <div class="service-sticky-box ">
        <div class="sticky-first">
            <p>Total Cost: ₹<?php echo $total1; ?>/-</p>
            <p>Total Qty: <?php echo $totals_qty; ?></p> 
        </div>
        <div class="sticky-second">
            <a href="./select_address.php"><button class="btn btn-primary">CHECKOUT</button></a>  
        </div>
    </div>
</div>
<?php }}} ?>
