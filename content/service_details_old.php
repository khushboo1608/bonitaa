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
  <section class="fontWrapper d-none-tab">
    <div class="container">
      <div class="row">
        <div class="col-12 col-sm-3 col-md-12 col-lg-12 col-xl-12">
          <div class="tab-content-header-box">
            <nav id="navbar-example" class="navbar">
              <ul class="nav nav-pills ">
                 <?php
                $query_sub_sub_category="SELECT *,subsubcat.ID as subsubid,subcat.ID as subid,subsubcat.status as subsubstatus,c.ID as catid,c.category as category_name,subcat.subcategory as sub_name,subsubcat.pic as subsubimage,subsubcat.description as subsubdescription FROM `subsubcategory` subsubcat
        		LEFT JOIN category c ON c.ID = subsubcat.category
        		LEFT JOIN subcategory subcat ON subcat.ID = subsubcat.subcategory
        		WHERE subsubcat.category = '".$_GET['category']."' and subsubcat.subcategory = '".$_GET['sub_category']."' and subsubcat.hide = 0
        		ORDER BY subsubcat.sort ASC";
            	
        		$sql_sub_sub_category = mysqli_query($con,$query_sub_sub_category)or die(mysqli_error());
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
              
                <li class="nav-item active">
                  <a class="nav-link wow fadeInUp" data-wow-delay="0.12s" href="#<?php echo $data_sub_sub_category['subsubid']; ?>">
                        <img src="<?php echo $image; ?>" alt="">
                        <p class="active"><?php echo $data_sub_sub_category['subsubcategory_name']; ?></p>
                  </a>
                </li>
            
            
            <?php }  ?>

              </ul>

          </div>

        </div>
        <div class="col col-md-12 col-xl-12 col-lg-12 justify-content-center d-flex">
          <div class="scrollableArea wow fadeInUp" data-wow-delay="0.2s">
            <div data-spy="scroll" data-target="#navbar-example" data-offset="200" class="scrollspy-example">


     <?php
                $query_sub_sub_category="SELECT *,subsubcat.ID as subcatid FROM `subsubcategory` subsubcat
        		WHERE subsubcat.category = '".$_GET['category']."' and subsubcat.subcategory = '".$_GET['sub_category']."' and subsubcat.hide = 0
        		ORDER BY subsubcat.sort ASC";
            	
        		$sql_sub_sub_category = mysqli_query($con,$query_sub_sub_category)or die(mysqli_error());
        	
        		while($data_sub_sub_category = mysqli_fetch_assoc($sql_sub_sub_category))
    		    {
            ?>
            
                <div class="typeFont active <?php echo $data_sub_sub_category['subcatid']; ?>" id="<?php echo $data_sub_sub_category['subcatid']; ?>">
                    <h2 id="item1" class="text-dark"><?php echo $data_sub_sub_category['subsubcategory_name']; ?></h2>

                        <?php
                         $query_service="SELECT *,s.ID as serviceid,c.ID as catid,subcat.ID as subid,subsubcat.ID as subsubid,c.category as category_name,subcat.subcategory as sub_name,s.pic as serviceimage,s.status as servicestatus  FROM `services` s 
                		LEFT JOIN category c ON c.ID = s.category
                		LEFT JOIN subcategory subcat ON subcat.ID = s.subcategory 
                		LEFT JOIN subsubcategory subsubcat ON subsubcat.ID = s.subsubcategory
                		WHERE s.category = '".$_GET['category']."' AND s.subcategory = '".$_GET['sub_category']."' and s.hide = 0
                		ORDER BY s.sort ASC";
                    	
                		$sql_service = mysqli_query($con,$query_service)or die(mysqli_error());
                	    $num=0;
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
                                    <img src="images/waxix1.jpg" alt="">
                                    <h4><?php echo $data_service['title'];  ?></h4>
                                </div>
                    
                                <div class="service-details">
                                    <p>TRENDING</p>
                                </div>
                    
                                <div class="service-details3">
                                    <p>TRENDING</p>
                                </div>
                            </div>
                    
                            <div class="waxix-content">
                                <h4><?php echo $data_service['title'];  ?></h4>
                                    <ul>
                                        <li><?php echo $data_service['short_description'];  ?></li>
                                    </ul>
                    
                                    <a href="#">View Details</a>
                                    <div class="service_time"><i class="fa fa-clock-o"></i><span class="time"><?php echo hoursandmins($data_service['duration']); ?></span></div>
                                    <div class="bottom_right">
                    
                                        <div class="Price_box"><span class="Price">₹<?php echo $data_service['discount_amount']; ?>/-</span><span class="discount"><?php echo $data_service['discount']; ?>% off</span><span class="prev_price">₹<?php echo $data_service['original_amount']; ?></span></div>
                                        <div class="show_time"><i class="fa fa-clock-o"></i><span class="time"><?php echo hoursandmins($data_service['duration']); ?></span></div>
                                        <?php 
                                        if(isset($_SESSION['user_id'])) { 
                                        $sql = "SELECT * FROM cart WHERE user_id='".$_SESSION['user_id']."' and services_id='".$data_service['serviceid']."' ";
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
                                                        <input type="text" name="quant[<?php echo $num; ?>]"  id="quant" class="form-control input-number-1" value="<?php echo $row['cart_services_qty'];  ?>" min="0" max="100">
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
                                            
                                        <?php } ?>
                                        
                    
                                    </div>
                            </div>
                        </div>

              
                <?php
    		    }
    		    ?>
                  </div>
               <?php
    		    }
    		    ?>
          
          </div>
        </div>
      </div>
    </div>
    </div>
  </section>


