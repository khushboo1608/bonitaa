<?php 
if (!isset($_SESSION['user_id'])) {
  echo "<script>window.location.href='index.php'</script>";
}

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

$query_cart="SELECT *,cart.ID as cartid,u.ID as userid,s.ID as serviceid,c.ID as catid,subcat.ID as subid,subsubcat.ID as subsubid,c.category as category_name,subcat.subcategory as sub_name,s.pic as serviceimage,s.short_description as servicedesc,s.status as servicestatus,c.status as cartstatus FROM `cart` as cart
LEFT JOIN user_registration u ON u.ID = cart.user_id 
LEFT JOIN services s ON s.ID = cart.services_id 
LEFT JOIN category c ON c.ID = s.category 
LEFT JOIN subcategory subcat ON subcat.ID = s.subcategory 
LEFT JOIN subsubcategory subsubcat ON subsubcat.ID = s.subsubcategory 
WHERE cart.user_id='".$_SESSION['user_id']."'
ORDER BY cart.ID DESC ";

$total = 0;
$totals_is_various = 0;

$sql_cart = mysqli_query($con,$query_cart)or die(mysqli_error());
$num_row = mysqli_num_rows($sql_cart);
                    
?>
<div class="card-main-box">
    <div class="container" style="margin-top: 50px;">
        <div class="row">
            <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                <div class="card-desgin-box card-main-price">
                    <h2>My Cart</h2>
                    <img src="images/line.png" alt="">
                    <?php 
                    if($num_row > 0)
                    {
                        $num=0;
                        while($data_cart = mysqli_fetch_assoc($sql_cart))
                        { 
                            $num=$num+1;
                            if(!empty($data_cart['serviceimage'])){
                                $image = UPLOAD_PATH.'service/'.$data_cart['serviceimage'];
                            }else{
                                $image='';
                            }
                            $totals_is_various1 =  $data_cart["cart_services_qty"] * $data_cart["cart_services_ori_amount"];
                            $totals_is_various += $totals_is_various1;
                
                            $totals =  $data_cart["cart_services_qty"] * $data_cart["cart_services_dis_amount"];
                            $total += $totals;
                            
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
                          <div class="main-cart-serivce-2">
                             <div class="cart-service-img">
                                 <img src="<?php echo $image; ?>" alt="">
                             </div>
    
                             <div class="card-service-box">
                            <h4><?php echo $data_cart['title']; ?></h4>
                            <div class="card-delete-price"> 
                            <div class="card-price">
                                <span>₹ <?php echo $data_cart['cart_services_dis_amount']; ?>/-</span>
                                <p><?php echo $data_cart['discount']; ?>% off</p>
                                <del>₹<?php echo $data_cart['cart_services_ori_amount']; ?></del>
                            </div>
                            <div class="card-delete">
                                <del>₹<?php echo $data_cart['cart_services_ori_amount']; ?></del>
                                <i class="fas fa-clock"></i>
                                <b><?php echo hoursandmins($data_cart['duration']); ?></b>
                            </div>
                             </div>
                            <ul>
                                <?php if($data_cart['servicedesc'] != ""){ ?>
                                <li><?php echo $data_cart['servicedesc'];  ?></li>
                                <?php } ?>
                            </ul>
                            <div class="row cart-12">
                            <div class="col-xl-6 col-lg-6 col-sm-6 col-md-6">
                                <div class="counter-text-box mt-3 " style="text-align: left;">
                                    <!--<button type="button" class="btn btn-danger btn-number-1 qty_minus" data-id="<?php echo $data_cart['serviceid'];?>" data-type="minus" data-field="quant[<?php echo $num; ?>]">-->
                                    <button  type="button" class="btn btn-primary model-btn cart_remove" data-id="<?php echo $data_cart['cartid'];?>" data-type="minus" data-bs-toggle="modal" data-bs-target="#exampleModal">REMOVE</button>
                                </div>
                            </div>
                                <div class="col-xl-6 col-lg-6 col-sm-6 col-md-6">
                                    <div class="Counter-number-add">
                                       
                                        <div class="center">
                                            <!-- <p>Service Charge: ₹ 2250/-</p> -->
                                            </p>
                                            <div class="input-group">
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-danger btn-number-1 qty_minus" data-id="<?php echo $data_cart['cartid'];?>" data-type="minus" data-field="quant[<?php echo $num; ?>]">
                                                        <i class="fa fa-minus"></i>
                                                    </button>
                                                </span>
                                                <input type="text" name="quant[<?php echo $num; ?>]"  id="quant_<?php echo $data_cart['cartid']; ?>" class="form-control input-number-1" value="<?php echo $data_cart['cart_services_qty'];  ?>" min="0" max="100">
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-success btn-number-1 qty_plus" data-id="<?php echo $data_cart['cartid'];?>" data-type="plus" data-field="quant[<?php echo $num; ?>]">
                                                        <i class="fa fa-plus"></i>
                                                    </button>
                                                </span>
                                            </div>
                                        </div>    
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                        <?php } ?> 
                    <div class="card-total-price">
             <h4>Cart Total</h4>
              <img src="images/line.png" alt="">
              
                  <div class="card-main-price">
                     <div class="card-price-box">
                            <div class="card-sub-total">
                              <p>Total Amount</p>
                               <span>₹ <?php echo $totals_is_various1; ?></span>
                            </div>
                            <div class="card-sub-total">
                              <p>Product After Discount</p>
                               <span>₹ <?php echo $total1; ?></span>
                            </div>
                            <div class="card-convency">
                             <p>Conveyance Charges</p>
                             <span>₹ <?php echo APP_conveyance; ?></span>
                            </div>

                            <div class="card-safety-total">
                                <p>Safety & Hygiene Charges </p>  
                                <span>₹ <?php echo APP_safety_hygiene; ?></span>
                            </div>
                            <div class="card-total-box">
                                <p> Total Payable Amount</p>
                                <span>₹ <?php echo $total1 + APP_conveyance + APP_safety_hygiene ;  ?></sapn>
                            </div>
                            
                            <!--<button id="customised" class="customised btn btn-primary w-100 p-2 mb-3" style="font-weight: 700;">Reset</button>-->
                            
                            
                            <div class="lazy">
                                

                            <?php
                            
                            $query_address="SELECT * FROM `staff` where city_id='".$_SESSION['city_id']."' ORDER BY `staff`.`ID` ASC";
                            $sql_address = mysqli_query($con,$query_address)or die(mysqli_error());
        
                            while($data_address = mysqli_fetch_assoc($sql_address))
                            {
                            ?>
                            
                         
                                <div class="box-wrapper">
                                    <input type="radio" id="<?php echo $data_address['ID']; ?>" class="recommended" name="recommended" value="<?php echo $data_address['ID']; ?>" />
                                    <label for="<?php echo $data_address['ID']; ?>" class="lazy-box">
                                            <img src="<?php echo UPLOAD_PATH.'staff/'.$data_address['dp']; ?>" class="lazy-img" alt="">
                                            <h3><?php echo $data_address['name']; ?></h3>
                                            <div class="d-flex align-items-center justify-content-center">
                                                <span>4.30</span>
                                                <img src="images/star.svg" class="star-img" />
                                            </div>
                                    </label>
                                </div>
                                
                                
                            <?php 
                            }
                            ?>
                                
                                
                                
                                
                            </div>
                            
                            
                            
                          <button id="recommended_submit_checkout" class="recommended_submit_checkout btn btn-primary w-100 p-2 mt-3" style="font-weight: 700;">PROCEED</button>
                     </div>
                  </div>
             </div>
             <?php }else{ ?> 
             <h3> Your cart is empty! </h3>
             <button class="btn btn-primary p-2 mt-3" onclick="location.href = 'index.php';" style="font-weight: 700;">Go to homepage </button>
             <?php } ?>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
 $(document).ready(function() {
  $(".customised").click(function() {
    alert('hii');                                            
  $('input[name="recommended"]').attr('checked', false);
              
});
});
</script>