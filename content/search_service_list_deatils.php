<?php 
// if (!isset($_SESSION['user_id'])) {
//   echo "<script>window.location.href='index.php'</script>";
// }

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
<div class="card-main-box search_service">
    <div class="container" style="margin-top: 50px;">
        <div class="row">
            <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                <div class="card-desgin-box">
                    <h2>Search Services</h2>
                    <img class="services-img" src="images/line.png" alt="">
                    <?php 
                    $query_service="SELECT *,s.ID as serviceid,c.ID as catid,subcat.ID as subid,subsubcat.ID as subsubid,c.category as category_name,subcat.subcategory as sub_name,s.pic as serviceimage,s.status as servicestatus,s.short_description as servicedesc
                    FROM `services` s 
            		LEFT JOIN category c ON c.ID = s.category
            		LEFT JOIN subcategory subcat ON subcat.ID = s.subcategory 
            		LEFT JOIN subsubcategory subsubcat ON subsubcat.ID = s.subsubcategory
            		WHERE s.title like '%".addslashes($_GET['text'])."%' and s.status = 1
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
                      <div class="main-cart-serivce-2">
                         <div class="cart-service-img">
                             <img src="<?php echo $image; ?>" alt="">
                              <div class="counter-text-mobile-view">
                              <ul>
                              <li><?php echo $data_service['servicedesc'];  ?></li>
                             </ul>
                             <!--  <div class="counter-text-box mt-3 " style="text-align: left;">
                              <button  type="button" class="btn btn-primary model-btn cart_remove" data-id="<?php echo $data_service['cartid'];?>" data-type="minus" data-bs-toggle="modal" data-bs-target="#exampleModal">REMOVE</button>
                             </div> -->
                              </div>   
                         </div>

                         <div class="card-service-box">
                        <h4><?php echo $data_service['title']; ?></h4>
                        <div class="card-delete-price"> 
                        <div class="card-price">
                            <span>₹ <?php echo $data_service['discount_amount']; ?>/-</span>
                            <del>₹ <?php echo $data_service['original_amount']; ?></del>
                            <?php if($data_service['discount'] != ""){ ?> <p><?php echo $data_service['discount']; ?>% off</p> <?php } ?>
                           
                        </div>
                        <div class="card-delete">
                            <del>₹ <?php echo $data_service['original_amount']; ?></del>
                            
                         
                            <i class="fas fa-clock"></i>
                            <b><?php echo hoursandmins($data_service['duration']); ?></b>
                        </div>
                         </div>
                         <?php if($data_service['servicedesc'] != ""){ ?>
                        <ul>
                            <li><?php echo $data_service['servicedesc'];  ?></li>
                        </ul>
                        <?php } ?>
                        <div class="row">
                   
                        
                        
    
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
                            
                        <?php } ?>
                        
                        
                        
                            <!--<div class="col-xl-6 col-lg-6 col-sm-12 col-md-6">-->
                            <!--    <div class="Counter-number-add">-->
                                   
                            <!--        <div class="center">-->
                                        <!-- <p>Service Charge: ₹ 2250/-</p> -->
                            <!--            </p>-->
                            <!--            <div class="input-group">-->
                            <!--                <span class="input-group-btn">-->
                            <!--                    <button type="button" class="btn btn-danger btn-number-1 qty_minus" data-id="<?php echo $data_cart['cartid'];?>" data-type="minus" data-field="quant[<?php echo $num; ?>]">-->
                            <!--                        <i class="fa fa-minus"></i>-->
                            <!--                    </button>-->
                            <!--                </span>-->
                            <!--                <input type="text" name="quant[<?php echo $num; ?>]"  id="quant" class="form-control input-number-1" value="<?php echo $data_cart['cart_services_qty'];  ?>" min="0" max="100">-->
                            <!--                <span class="input-group-btn">-->
                            <!--                    <button type="button" class="btn btn-success btn-number-1 qty_plus" data-id="<?php echo $data_cart['cartid'];?>" data-type="plus" data-field="quant[<?php echo $num; ?>]">-->
                            <!--                        <i class="fa fa-plus"></i>-->
                            <!--                    </button>-->
                            <!--                </span>-->
                            <!--            </div>-->
                            <!--        </div>    -->
                            <!--    </div>-->
                            <!--</div>-->
                        </div>
                    </div>
                    </div>
                    <?php } ?> 

                </div>
            </div>
        </div>
    </div>
</div>