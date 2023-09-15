<?php
if (!isset($_SESSION['user_id'])) {
  echo "<script>window.location.href='index.php'</script>";
}
if (isset($_SESSION['user_id'])) {

  $query_checkout = "SELECT * FROM `user_registration` a
  WHERE a.ID = '" . $_SESSION['user_id'] . "' and a.status = 1
  ORDER BY a.ID DESC";

  $sql_checkout = mysqli_query($con, $query_checkout) or die(mysqli_error());

  $data_checkout = mysqli_fetch_assoc($sql_checkout);

// unset($_SESSION['coupon_amount']);
  ?>
  
<input type="hidden" name='timezone' id="timezone" class="timezone" value="<?php echo $_GET['timezone'] ?>" >
<input type="hidden" name='address' id="address" class="address" value="<?php echo $_GET['address'] ?>"  >
<input type="hidden" name='date' id="date" class="date" value="<?php echo $_GET['date'] ?>"  >
<input type="hidden" name='recommended' id="recommended" class="recommended" value="<?php echo $_GET['recommended'] ?>"  >


  <div class="checkout-main-box">
    <div class="container" style="margin-top: 50px; margin-bottom:30px;">
      <div class="row">
        <div class="col-xl-8 col-md-12 col-sm-12 col-lg-8">
          <div class="checkout-box">
            <div class="checkout-first-box">
              <h5>Payment Type</h5>
              <div class="payment-selector-box">
                <div class="row">
                          <button class="paymet-select-first-box" style="margin-left: 20px;">
                            <input type="radio" name="payment_status" id="payment_status" class="payment_status" value="1"> Pay at place
                          </button>
                      
                         <!--<button class="paymet-select-first-box" style="margin-left: 20px;">-->
                         <!--   <input type="radio" name="payment_status" id="payment_status" class="payment_status" value="2"> Online Payment-->
                         <!--</button>-->
                     
                         
                          <button class="paymet-select-first-box" style="margin-left: 20px;">
                            <input type="radio" name="payment_status" id="payment_status" class="payment_status" value="3"> My Wallet
                          </button>
                    
                   
                           
              
                  <!--<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">-->
                  <!--  <div class="payment-selection active">-->
                  <!--    <div class="payment-img">-->
                  <!--      <img src="images/rs-img.webp" alt="" class="left-img">-->
                  <!--    </div>-->
                      <!--<p>Pay After Service</p>-->

                      

                  <!--    <img src="images/right-img.webp" alt="" class="right-img">-->
                  <!--  </div>-->
                  <!--</div>-->
                  <!--<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">-->
                  <!--  <div class="payment-selection">-->
                  <!--    <div class="payment-img">-->
                  <!--      <img src="images/online pay.png" alt="" class="left-img">-->
                  <!--    </div>-->
                      <!--<p>Online Payment</p>-->
                      
                      <!-- <img src="images/right-img.webp" alt="" class="right-img"> -->
                  <!--  </div>-->
                  <!--</div>-->
                  <!--<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">-->
                  <!--  <div class="payment-selection">-->
                  <!--    <div class="payment-img">-->
                  <!--      <img src="images/wallet1.png" alt="" class="left-img">-->
                  <!--    </div>-->
                      <!--<p>My Wallet</p>-->
                      
                      <!-- <img src="images/right-img.webp" alt="" class="right-img"> -->
                  <!--  </div>-->
                  <!--</div>-->
                </div>
              </div>
            </div>
            <div class="checkbox-collpase">
              <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                      data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"
                      style="border-top:0px solid white;">
                      <img src="images/sub-2_categary tabs image/wallet.webp" alt=""> <span>BonitaA Wallet</span>
                    </button>
                  </h2>
                  <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                      <p>Balance : <span>₹
                          <?php echo $data_checkout['wallet']; ?>/-
                        </span></p>
                    </div>
                  </div>
                </div>



                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingfour">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                      data-bs-target="#collapsefour" aria-expanded="false" aria-controls="collapsefour">
                      <img src="images/sub-2_categary tabs image/reedom.webp" alt=""> <span>Redeem Coupon</span>
                    </button>
                  </h2>
                  <div id="collapsefour" class="accordion-collapse collapse" aria-labelledby="headingfour"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                      <form id="couponForm" name="couponForm">
                          <div>
                            <div class="mb-3">
                              <input type="text" name='promocode' id="promocode" class="form-control">
                            </div>
                            <button class="couponSubmit btn btn-primary">REDEEM</button>
                          </div>
                          <div class="wrapper-box">
                              
                            
                                   <?php
                            date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
                            $date = date('Y-m-d');
                            
                            $query_address="SELECT * FROM `coupon_master` 
                            WHERE coupon_master.status = 1 and coupon_master.coupon_start_date <= '".$date."' and coupon_master.coupon_end_date >= '".$date."' 
                            ORDER BY `coupon_master`.`ID` ASC";
                            $sql_address = mysqli_query($con,$query_address)or die(mysqli_error());
        
                            while($data_address = mysqli_fetch_assoc($sql_address))
                            {
                            ?>
                             <script>
                              function myFunction() {
                                // Get the text field
                                var copyText = document.getElementById("myInput_<?php echo $data_address['ID']; ?>");
            
                                // Select the text field
                                copyText.select();
                                copyText.setSelectionRange(0, 99999);
                                // Copy the text inside the text field
                                navigator.clipboard.writeText(copyText.value);
            
                              }
                            </script> 
                              
                            <div class="box-wrapper">
                              <div class="lazy-box">
                                  <h3 class="flat-off"><?php echo $data_address['coupon_name']; ?></h3>
                                  <span class="discount-off">Discount of  <?php echo $data_address['coupon_price']; ?> <?php if($data_address['coupon_type'] == 1) { echo "%"; } else  { echo "₹" ;} ?></span>
                                  <span class="discount-off"> On minimum cart amount of ₹ <?php echo $data_address['coupon_minamount']; ?></span>
                                  <span class="discount-off"> Max discount of ₹ <?php echo $data_address['coupon_maxamount']; ?></span>
                                  <div class=" d-flex align-items-center justify-content-between mt-3">
                                  <div class="position-relative">
                                     <h3>Code : <?php echo $data_address['coupon_promocode']; ?></h3>
                                    <!--<span class="flat-50"><?php echo $data_address['coupon_promocode']; ?></span>-->
                                    <!--<input class="end-0 start-0" type="text" value="<?php echo $data_address['coupon_promocode']; ?>" id="myInput_<?php echo $data_address['ID']; ?>">-->
                                  </div>  
                                    <!--<button onclick="myFunction()" class="couponSubmit btn btn-primary w-30">Copy</button>-->
                                  </div>
                              </div>
                            </div>
                             
                            
                            <?php
                            }
                            ?>
                            
                       <!--     <div class="box-wrapper">
                              <div class="lazy-box">
                                  <h3 class="flat-off">Flat 20% off</h3>
                                  <span class="discount-off">Discount of 50%</span>
                                  <span class="discount-off"> On minimum cart amount of ₹ 500</span>
                                  <span class="discount-off"> Max discount of ₹ 200</span>
                                  <div class=" d-flex align-items-center justify-content-between">
                                  <div class="position-relative">
                                    <span class="flat-50">FLAT50</span>
                                    <input class="end-0 start-0" type="text" value="FLAT501" id="myInput">
                                  </div>  
                                    <button onclick="myFunction()" class="couponSubmit btn btn-primary w-30">Copy</button>
                                  </div>
                              </div>
                            </div>
                            <div class="box-wrapper">
                              <div class="lazy-box">
                                  <h3 class="flat-off">Flat 20% off</h3>
                                  <span class="discount-off">Discount of 50%</span>
                                  <span class="discount-off"> On minimum cart amount of ₹ 500</span>
                                  <span class="discount-off"> Max discount of ₹ 200</span>
                                  <div class=" d-flex align-items-center justify-content-between">
                                  <div class="position-relative">
                                    <span class="flat-50">FLAT50</span>
                                    <input class="end-0 start-0" type="text" value="FLAT502" id="myInput">
                                  </div>  
                                    <button onclick="myFunction()" class="couponSubmit btn btn-primary w-30">Copy</button>
                                  </div>
                              </div>
                            </div>-->
                            
                          </div>
                      </form>
                    </div>
                  </div>
                </div>

                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingthree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                      data-bs-target="#collapsethree" aria-expanded="false" aria-controls="collapsethree">
                      <img src="images/sub-2_categary tabs image/massege.webp" alt=""> <span>Any suggestions? We will pass
                        it.</span>
                    </button>
                  </h2>
                  <div id="collapsethree" class="accordion-collapse collapse" aria-labelledby="headingthree"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                      <div class="mb-3">
                        <!--<textarea class="instructions form-control" id="instructions exampleFormControlTextarea1" rows="3"-->
                        <!--  placeholder="Please add your instructions...." name="instructions"></textarea>-->
                        <input type="text" name='instructions' id="instructions" class="instructions form-control" placeholder="Please add your instructions....">
                        <p class="third-pg"> We follow your instructions on the best effort basis </p>
                        <!--<button class="btn btn-primary ">Submit</button>-->
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="professional-main-box">

            <p>Cancellation fee of Rs 200 will be levied if the cancellation is done within 4 hours of the appointment
              time.</p>
          </div>

        </div>
        <div class="col-xl-4 col-md-12 col-sm-12 col-lg-4">
          <div class="steal-deals-main-box">

            <!-- <img src="images/steal_deal.webp" alt=""> -->
            <div class="steal-summary-box">
              <h4>Summary</h4>
              <?php
              $query_cart = "SELECT *,cart.ID as cartid,u.ID as userid,s.ID as serviceid,c.ID as catid,subcat.ID as subid,subsubcat.ID as subsubid,c.category as category_name,subcat.subcategory as sub_name,s.pic as serviceimage,s.short_description as servicedesc,s.status as servicestatus,c.status as cartstatus FROM `cart` as cart
                    LEFT JOIN user_registration u ON u.ID = cart.user_id 
                    LEFT JOIN services s ON s.ID = cart.services_id 
                    LEFT JOIN category c ON c.ID = s.category 
                    LEFT JOIN subcategory subcat ON subcat.ID = s.subcategory 
                    LEFT JOIN subsubcategory subsubcat ON subsubcat.ID = s.subsubcategory 
                    WHERE cart.user_id='" . $_SESSION['user_id'] . "'
                    ORDER BY cart.ID DESC ";

              $total = 0;
              $totals_is_various = 0;

              $sql_cart = mysqli_query($con, $query_cart) or die(mysqli_error());

              $num = 0;
              while ($data_cart = mysqli_fetch_assoc($sql_cart)) {

                $totals_is_various1 = $data_cart["cart_services_qty"] * $data_cart["cart_services_ori_amount"];
                $totals_is_various += $totals_is_various1;

                $totals = $data_cart["cart_services_qty"] * $data_cart["cart_services_dis_amount"];
                $total += $totals;

                if ($total == "") {
                  $total1 = '0';
                } else {
                  $total1 = $total;
                }

                if ($totals_is_various == "") {
                  $totals_is_various1 = '0';
                } else {
                  $totals_is_various1 = $totals_is_various;
                }

              }
              ?>
              <input type="hidden" name='dis_amount' id="dis_amount" class="dis_amount" value="<?php echo $total1; ?>" >
              <input type="hidden" name='ori_amount' id="ori_amount" class="ori_amount" value="<?php echo $totals_is_various1; ?>" >
              <!--<div class="steal-summary-main">-->
              <!--  <div class="steal-summary-first">-->
              <!--    <ul>-->
              <!--      <li>Total Amount</li>-->
              <!--      <li>Product After Discount</li>-->
              <!--      <li>Promotion Applied</li>-->
              <!--      <li>Safety & Hygiene Charges</li>-->
              <!--      <li>Conveyance Charges</li>-->
                    <!--<li>Total Payable Amount</li>-->
              <!--    </ul>-->
              <!--  </div>-->
              <!--  <div class="steal-summary-last">-->
              <!--    <div id="promo_calu_price">-->
              <!--        <ul>-->
              <!--          <li>₹-->
              <!--            <?php echo $totals_is_various1; ?>/--->
              <!--          </li>-->
              <!--          <li>₹-->
              <!--            <?php echo $total1; ?>/--->
              <!--          </li>-->
                        <!--<div id="promo_calu_price">-->
              <!--          <li>₹ 0/-</li>-->
                        <!--</div>-->
              <!--          <li>₹-->
              <!--            <?php echo APP_safety_hygiene; ?>/--->
              <!--          </li>-->
              <!--           <li>₹-->
              <!--            <?php echo APP_conveyance; ?>/--->
              <!--          </li>-->
                        <!--<li>₹-->
                        <!--  <?php  echo $total1 + APP_conveyance + APP_safety_hygiene ; ?>/--->
                        <!--</li>-->
              <!--        </ul>-->
              <!--      </div>-->
              <!--  </div>-->
              <!--</div>-->
              <!--<div class="steel-max-box">-->
              <!--  <ul>-->
              <!--    <li>-->
              <!--      <p>Conveyance Charges</p>-->
              <!--      <p> ₹-->
              <!--        <?php echo APP_conveyance; ?>/--->
              <!--      </p>-->
              <!--    </li>-->
                  <!--<li>-->
                  <!--  <p class="service-text-list">Goods & services tax (Central & state tax)</p>-->
                  <!--    <p class="service-text-list">+ ₹15.1/-</p>-->
                  <!--</li>-->
              <!--  </ul>-->
              <!--  <p></p>-->
              <!--</div>-->
             
                <!--<div class="payble-amount-selction-box-2">-->
                <!--    <h4>Total Payable Amount</h4>-->
                <!--    <h4>₹ <?php  echo $total1 + APP_conveyance + APP_safety_hygiene ; ?>/-</h4>-->
                <!--</div>-->
                
                <div class="steal-summary-main">
                  <div class="steal-summary-first">
                    <ul>
                      <li>
                        <h4>Total Amount</h4>
                        <h4>₹ <?php echo $totals_is_various1; ?>/-</h4>
                      </li>
                
                      <li>
                        <h4> Product After Discount </h4>
                        <h4>₹
                          <?php echo $total1; ?>/-
                        </h4>
                      </li>
                
                      <li>
                        <h4>Promotion Applied </h4>
                        <h4> ₹ 0/- </h4>
                      </li>
                      
                      <li>
                        <h4> Safety & Hygiene Charges </h4>
                        <h4>₹
                          <?php echo APP_safety_hygiene; ?>/-
                        </h4>
                      </li>
                      <li>
                        <h4>Conveyance Charges </h4>
                        <h4>₹
                          <?php echo APP_conveyance; ?>/-
                        </h4>
                      </li>
                
                      <li>
                        <div class="payble-amount-selction-box-2">
                          <h4>Total Payable Amount</h4>
                          <h4>₹ <?php echo $total1 + APP_conveyance + APP_safety_hygiene; ?>/-</h4>
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>

            </div>
            <button class="booksubmit btn btn-success">Book Appointment</button>

          </div>
        </div>


      </div>
    </div>
  </div>
<?php } ?>