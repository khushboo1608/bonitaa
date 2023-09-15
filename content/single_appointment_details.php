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

    if ($hours == 0)
        return "{$minutes} minutes";
    else
        return "{$hours} hours {$minutes} minutes";

    // return sprintf($format, $hours, $minutes);
}

if (isset($_GET['book'])) {
    $query = "SELECT *,s.ID as staffid, s.name as staffname, s.mobile as staffphone,ord.ID as orderid,u.ID as userid,u.name as
    username,a.ID as adderssid,a.status as
    adderssstatus,a.type as addersstype,a.name as adderssname,a.houser_no as addersshouserno,a.adderss as
    addersses,a.pincode as addersspincode,a.latitude as addersslatitude,a.longitude as addersslongitude,a.number as
    adderssnumber,a.lendmark as addersslendmark,ord.dis_price as dis_price, ord.ori_price as ori_price FROM `orders` ord
    LEFT JOIN user_registration u ON u.ID = ord.user_id
    LEFT JOIN staff s ON s.ID = ord.staff_id
    LEFT JOIN address a ON a.ID = ord.address
    LEFT JOIN review r ON r.ID = ord.id
    WHERE ord.id='" . $_GET['book'] . "'
    ORDER BY ord.id DESC";

    $sql = mysqli_query($con, $query) or die(mysqli_error());


    while ($data = mysqli_fetch_assoc($sql)) {
        if ($data['order_time'] != "") {
            $arr1 = explode(",", $data['order_time']);
            $arr = array_filter($arr1, 'strlen');
        } else {
            $arr = [];
        }

        // 1=Pending,2=Accepted,3=Rejected,4=Completed,5=Canceled 

        if ($data['payment_status'] == 1) {
            $payment_status = 'Pay at place';
        } else if ($data['payment_status'] == 2) {
            $payment_status = 'Online Payment';
        } else if ($data['payment_status'] == 3) {
            $payment_status = 'Wallet';
        }

        if ($data['payment_type'] == 1) {
            $payment_type = 'Pending';
            $class_name = 'btn btn-pending';
        } else if ($data['payment_type'] == 2) {
            $payment_type = 'Accepted';
            $class_name = 'btn btn-accept';
        } else if ($data['payment_type'] == 3) {
            $payment_type = 'Rejected';
            $class_name = 'btn btn-reject';
        } else if ($data['payment_type'] == 4) {
            $payment_type = 'Completed';
            $class_name = 'btn btn-complete';
        } else if ($data['payment_type'] == 5) {
            $payment_type = 'Canceled';
            $class_name = 'btn btn-cancle';
        }else if ($data['payment_type'] == 6) {
            $payment_type = 'Accepted';
            $class_name = 'btn btn-accept';
        }else if ($data['payment_type'] == 7) {
            $payment_type = 'Accepted';
            $class_name = 'btn btn-accept';
        }
        ?>
        <div class="my-Appoinment">
          <div class="container" style="margin-top: 50px; margin-bottom:50px;">
            <div class="row">
              <div class="col-lg-12">
                <div class="card-1">
                  <div class="header-single-box">
                    <p>Appointment ID : <?php echo $data['orderid']; ?></p>
                    <span><button class="<?php echo $class_name; ?>"><?php echo $payment_type; ?></button></span>
                  </div>
                  <div class="row">
                    <h4>Service Details</h4>
                    <?php
                    $query_order_details = "SELECT *,orderdetails.id as orderdetailsid,cat.category as categoryname,subcat.subcategory as sub_name,subsubcat.subsubcategory_name as subsubsubname,services.title as servicename,services.pic as serviceimage,orderdetails.type FROM `orders_detail` orderdetails
                      LEFT JOIN category cat ON cat.ID = orderdetails.category_id
                      LEFT JOIN subcategory subcat ON subcat.ID = orderdetails.subcategory_id
                      LEFT JOIN subsubcategory subsubcat ON subsubcat.ID = orderdetails.subsubcategory_id
                      LEFT JOIN services services ON services.ID = orderdetails.service_id
                      WHERE orderdetails.order_id='" . $_GET['book'] . "'
                      ORDER BY orderdetails.id ASC";

                    $sql_order_details = mysqli_query($con, $query_order_details) or die(mysqli_error());

                    while ($data_order_details = mysqli_fetch_array($sql_order_details)) {
                        if (!empty($data_order_details['serviceimage'])) {
                            $image = UPLOAD_PATH . 'service/' . $data_order_details['serviceimage'];
                        } else {
                            $image = '';
                        }

                        if($data_order_details['type'] == 1)
                        {  
                           $order_type = '';
                           // $ori_price       = $ori_price+($data_order_details['ori_price']*$data_order_details['qty']);
                           // $final_price       = $final_price+($data_order_details['dis_price']*$data_order_details['qty']);
                           $order_dis_price1 = 0;

                        }else  if($data_order_details['type'] == 2){
                            $order_type = ' [ Extra Service ] ';
                            // $ori_price1       = $ori_price+($data_order_details['ori_price']*$data_order_details['qty']);
                            // $final_price1       = $final_price+($data_order_details['dis_price']*$data_order_details['qty']);
                            $order_dis_price1    = $data['dis_price'];
                        }

                        ?>
                        <div class="col-xl-6 col-lg-6 col-sm-12 col-md-12">
                          <div class="main-single-box">
                            <div class="Apppontment-single-view">

                              <div class="single-view-first-box">
                                <img src="<?php echo $image; ?>" alt="">
                              </div>
                              <div class="single-view-last-box">
                                <h3><?php echo $data_order_details['servicename']; ?><?php echo $order_type; ?></h3>
                                <b>Facial</b>
                                <p><i class="fas fa-clock"></i><?php echo hoursandmins($data_order_details['duration']); ?><span>Qty:<?php echo $data_order_details['qty']; ?></span></p>

                                <div class="price-box">
                                  <P> ₹ <?php echo $data_order_details['dis_price']; ?>/-</P> <del>₹ <?php echo $data_order_details['ori_price']; ?>/- </del>
                                </div>
                              </div>
                            </div>
                            <ul>
                              <?php if ($data_order_details['short_description'] != "") { ?>
                                  <li><?php echo $data_order_details['short_description']; ?></li>
                              <?php } ?>
                            </ul>
                          </div>
                        </div>
                    <?php } ?>
                  </div>

                  <div class="row">
                    <div class="col-xl-6 col-lg-6 col-sm-12 col-md-12">

                  <div class="payment-method">
                        <h4>Payment Type</h4>
                        <p class="payment-method-p"> <i class="fas fa-wallet"></i> <span><?php echo $payment_status; ?></span></p>
                      </div>
               
               
                      <div class="single-paymwent-details">
                        <h2 class="payment-text">Payment Details</h2>

                        <div class="Total-amount">
                          <p>Total Amount</p>
                          <!--<span>₹ <?php echo $data['ori_price']; ?>/-</span>-->
                           <span>₹ <del><?php echo $data['ori_price']; ?></del>₹ <?php echo $data['dis_price']; ?>/-</span>
                        </div>
                     
                        <div class="serivice-amount">
                          <p>Previous Service Amount</p>
                          <span>₹ <?php echo $order_dis_price1; ?>/-</span>
                        </div>

                        <div class="serivice-amount">
                          <p>Addition Service Charge</p>
                          <span>₹ <?php if($data['service_price'] == ""){ echo '0'; }else{ echo $data['service_price'];} ?>/-</span>
                        </div>
                        
                        <div class="Promotion-amount">
                          <p>Promotion Applied</p>
                          <span>₹ <?php if ($data['coupon_value'] == "") {
                              echo "0";
                          } else {
                              echo $data['coupon_value'];
                          } ?>/-</span>
                        </div>
                        <div class="Charge-amount">
                          <p>Conveyance Charge</p>
                          <span>₹ <?php echo $data['conveyance_charges']; ?>/-</span>
                        </div>
                        <div class="Safety-amount">
                          <p>Safety & Hygiene Charges</p>
                          <span>₹ <?php echo $data['safety_hygiene_charges']; ?>/-</span>
                        </div>
                        <div class="payment-amount">
                          <p>Total Payable Amount</p>
                          <span>₹ <?php echo $data['final_price'];  ?>/-</span>
                        </div>

                      </div>

                    </div>

                    <div class="col-xl-6 col-lg-6 col-sm-12 col-md-12">
                      <div class="single-contact-details">
                        <h2 class="contect-text">Contact Details</h2>
                        <p><?php echo $data['adderssname']; ?> | <?php echo $data['adderssnumber']; ?></p>
                        <span><?php echo $data['addersshouserno'] . ',' . $data['addersslendmark'] . ',' . $data['addersses']; ?></span>
                      </div>
                      <div class="lazy">
                      
                               <?php
                                  $query_address="SELECT * FROM `staff` WHERE staff.ID = '".$data['staff_id']."'";
                            $sql_address = mysqli_query($con,$query_address)or die(mysqli_error());
        
                            $row = mysqli_fetch_assoc($sql_address);
                            
                               if($data['staff_id'] == 0)
                            {
                                
                            }else
                            {
                                
                        
                            
                         

                            ?>
                            <div class="box-wrapper">
                                    <div class="single-slot lazy-box">
                                      <h2>Professional</h2>
                                      <div class="d-flex">
                                        <img src="<?php echo UPLOAD_PATH.'staff/'.$row['dp']; ?>" class="lazy-img" alt="">
                                        <div>
                                        <h3 class="text-left">  <?php echo $row['name']; ?> </h3>
                                        <div class="d-flex align-items-center">
                                            <span>4.30</span>
                                            <img src="images/star.svg" class="star-img" />
                                        </div>
                                      </div>
                                      </div>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                      <!-- <div class="payment-method">
                        <h4>Payment Type</h4>
                        <p> <i class="fas fa-wallet"></i> <span><?php echo $payment_status; ?></span></p>
                      </div> -->

                      <!-- <div class="single-slot mt-3">
        
                        <h4 class="text-center mb-3">Date & Slot</h4>
                        <p><span> Date:</span> <?php echo dateString($data['order_date']); ?></p>
                        <p><span> Slot:</span>  <?php echo $data['order_time']; ?></p>
                      </div> -->

                      <div class="single-slot mt-3">
                        <h4 class="text-center mb-3 ">Date & Slot</h4>
                        <p><span class="mr-2"> Date:</span> <?php echo dateString($data['order_date']); ?></p>
                        <div class="d-flex"><span > Slot:</span> <p class="ml-3">
                        <?php if ($data['order_time'] != "") 
                 			{
                                $arr1= explode(",",$data['order_time']);
                                $arr = array_filter($arr1, 'strlen');
                            }else
                            {
                                $arr = [] ;
                            }
 		
                		    echo $row2['order_time'] = $arr[0];
    		            ?></p></div>
                      </div>
              
        
                    </div>
                    
       
                  </div>
        
                 <?php if (!empty($data['message'])) { ?>
                      <div class="single_page_suggetion">
                        <h4>Any suggestions? We will pass it.</h4>
                        <p><?php echo $data['message']; ?></p>
                      </div>
                 <?php } ?>
                 <br/>
                 <?php if ($data['payment_type'] == 5) { ?>
                     <div class="single_page_suggetion">
                        <h4>Cancel Reason</h4>
                        <p><?php echo $data['cancel_reason']; ?></p>
                      </div>
                 <?php } ?>
                 
                 <?php
                 if ($data['payment_type'] == 1) {
                     ?>
                      <div class="model-btn-box">
                        <button type="button" class="btn btn-primary model-btn" data-bs-toggle="modal"
                          data-bs-target="#exampleModal">
                          CANCEL
                        </button>
                      </div>


            
          
                      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title"  id="exampleModalLabel">Are you sure you want to cancel the Appointment?</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h5 class="modal-title" id="exampleModalLabel">Reason For Cancellation?</h5>
                                    <select class="form-select" id="cancel_reason" class="cancel_reason" aria-label="Default select example">
                                        <option value="Forgot to add/remove items">Forgot to add/remove items</option>
                                        <option value="I do not need the product anymore">I do not need the product anymore</option>
                                        <option value="Not avaliable to receive order">Not avaliable to receive order</option>
                                        <option value="I selected the wrong address">I selected the wrong address</option>
                                    </select>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" data-id="<?php echo $data['orderid']; ?>" class="cancelOrder btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </div>
                      </div>
                        
                <?php } ?>    

                 <div class="popup-btn-box">
                    <?php if ($data['payment_type'] == 4) { 
                        $query_testimonial ="SELECT *,r.ID as rid, u.ID as userid, c.ID as cityid,c.name as cityname,u.name as username,u.dp as userimage,r.status as rstatus,r.date as rdate FROM `review` r
                        LEFT JOIN user_registration u ON u.ID = r.user_id
                        LEFT JOIN city c ON c.ID = r.city
                        WHERE r.status = 1 and r.order_id = '".$_GET['book']."'
                        ORDER BY r.feature ASC";

                        $sql_testimonial = mysqli_query($con,$query_testimonial)or die(mysqli_error());

                        $data_testimonial = mysqli_fetch_assoc($sql_testimonial);

                        $num_row_testimonial = mysqli_num_rows($sql_testimonial);

                        if($num_row_testimonial > 0){

                      ?>
                      <button type="button" class="btn btn-primary model-btn-1" data-bs-toggle="modal" data-bs-target="#exampleModal-2"> VIEW RATE </button>
                    <?php }else { ?>
                      <button type="button" class="btn btn-primary model-btn-1" data-bs-toggle="modal" data-bs-target="#exampleModal-3"> RATE ME </button>
                    <?php } } ?>
                    <?php if ($data['payment_type'] == 1) { ?>
                     <a href="./reschedule_order.php?book=<?php echo $data['orderid']; ?>"><button class="btn btn-primary">Reschedule</button></a>
                    <?php } ?>
                 </div>

                </div>

                </body>

              </div>
            </div>
          </div>
        </div>




        <?php if ($data['payment_type'] == 4) { ?>

          <?php 
            $query_testimonial ="SELECT *,r.ID as rid, u.ID as userid, c.ID as cityid,c.name as cityname,u.name as username,u.dp as userimage,r.status as rstatus,r.date as rdate FROM `review` r
            LEFT JOIN user_registration u ON u.ID = r.user_id
            LEFT JOIN city c ON c.ID = r.city
            WHERE r.status = 1 and r.order_id = '".$_GET['book']."'
            ORDER BY r.feature ASC";
          
        $sql_testimonial = mysqli_query($con,$query_testimonial)or die(mysqli_error());
        
        $data_testimonial = mysqli_fetch_assoc($sql_testimonial);

        $num_row_testimonial = mysqli_num_rows($sql_testimonial);

        if($num_row_testimonial > 0){
            if(!empty($data_testimonial['userimage'])){
                    $image = UPLOAD_PATH.'users/'.$data_testimonial['userimage'];
                }else{
                    $image='';
                }
        ?>
         <div class="my-appointnment-mode">
            <div class="modal fade" id="exampleModal-2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-body">
                      <div class="single-model-box">
                        <div class="single-header-box-2">
                          <p>VIEW RATING</p>
                        </div>

                        <div class="model-box-appointment">
                          <div class="appointment-inner-first">
                            Rating
                          </div>
                          <?php for ($count = 1; $count <= 5; $count ++) {
                            $check ='far fa-star';
                          if ($count <= $data_testimonial['rate']) { $check = 'fas fa-star'; } ?>
                          <!-- <div class="appointment-inner-second">
                            <div class="outer">
                              <div class="ratings-box">
                                <div class="ratings-box__item">
                                  <label>
                                    <input id="rate-1" class="rating-star-button" type="radio" name="rating-star-button" value="1" ><p><?php echo $check; ?></p>
                                    <div class="star-line-box">
                                      <span class="rating-star"></span>
                                      <span class="rating-star-line"></span>
                                      <span class="rating-star-line"></span>
                                      <span class="rating-star-line"></span>
                                    </div>
                                  </label>
                                </div>

                              </div>
                            </div>
                          </div> -->

                          <i class="<?php echo $check; ?>"></i>
                          <?php }  ?>

                        </div>

                        <div class="model-textarea-box">
                          <div class="mb-3">
                            <textarea class="review form-control" id="review" rows="3" name="review" 
                              placeholder="Enter review" disabled><?php echo $data_testimonial['comment']; ?></textarea>
                          </div>
                        </div>

                        <div class="single-appointment-model-box">
                          <button class="btn btn-danger" data-bs-dismiss="modal" >CLOSE</button>
                        </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php }else{ ?>

          <div class="my-appointnment-mode">
            <div class="modal fade" id="exampleModal-3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-body">
                    <!-- <form name="myRateForm" id="myRateForm" >  -->
                      <div class="single-model-box">
                        <div class="single-header-box-2">
                          <p>ADD RATING</p>
                        </div>

                        <div class="model-box-appointment">
                          <div class="appointment-inner-first">
                            Overall
                          </div>
                          <div class="appointment-inner-second">
                            <div class="outer">
                              <div class="ratings-box">
                                <div class="ratings-box__item">
                                  <label>
                                    <input id="rate-1" class="rating-star-button" type="radio" name="rating-star-button" value="1">
                                    <div class="star-line-box">
                                      <span class="rating-star"></span>
                                      <span class="rating-star-line"></span>
                                      <span class="rating-star-line"></span>
                                      <span class="rating-star-line"></span>
                                    </div>
                                  </label>
                                    <p>Terrible</p>
                                </div>
                                <div class="ratings-box__item">
                                  <label>
                                    <input id="rate-2" class="rating-star-button" type="radio" name="rating-star-button" value="2">
                                    <div class="star-line-box">
                                      <span class="rating-star"></span>
                                      <span class="rating-star-line"></span>
                                      <span class="rating-star-line"></span>
                                      <span class="rating-star-line"></span>
                                    </div>
                                  </label>
                                    <p>Bad</p>
                                </div>
                                <div class="ratings-box__item">
                                  <label>
                                    <input id="rate-3" class="rating-star-button" type="radio" name="rating-star-button" value="3">
                                    <div class="star-line-box">
                                      <span class="rating-star"></span>
                                      <span class="rating-star-line"></span>
                                      <span class="rating-star-line"></span>
                                      <span class="rating-star-line"></span>
                                    </div>
                                  </label>
                                    <p>Okay</p>
                                </div>
                                <div class="ratings-box__item">
                                  <label>
                                    <input id="rate-4" class="rating-star-button" type="radio" name="rating-star-button" value="4">
                                    <div class="star-line-box">
                                      <span class="rating-star"></span>
                                      <span class="rating-star-line"></span>
                                      <span class="rating-star-line"></span>
                                      <span class="rating-star-line"></span>
                                    </div>
                                  </label>
                                    <p>Good</p>
                                </div>
                                <div class="ratings-box__item">
                                  <label>
                                    <input id="rate-5" class="rating-star-button" type="radio" name="rating-star-button" value="5">
                                    <div class="star-line-box">
                                      <span class="rating-star"></span>
                                      <span class="rating-star-line"></span>
                                      <span class="rating-star-line"></span>
                                      <span class="rating-star-line"></span>
                                    </div>
                                  </label>
                                    <p>Excellent</p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="model-box-appointment">
                          <div class="appointment-inner-first">
                            Quality
                          </div>
                          <div class="appointment-inner-second">
                            <div class="outer">
                              <div class="ratings-box">
                                <div class="ratings-box__item">
                                  <label>
                                    <input id="rate-1" class="rating-star-button" type="radio" name="rating-star-button-1" value="1">
                                    <div class="star-line-box">
                                      <span class="rating-star"></span>
                                      <span class="rating-star-line"></span>
                                      <span class="rating-star-line"></span>
                                      <span class="rating-star-line"></span>
                                    </div>
                                  </label>
                                    <p>Terrible</p>
                                </div>
                                <div class="ratings-box__item">
                                  <label>
                                    <input id="rate-2" class="rating-star-button" type="radio" name="rating-star-button-1" value="2">
                                    <div class="star-line-box">
                                      <span class="rating-star"></span>
                                      <span class="rating-star-line"></span>
                                      <span class="rating-star-line"></span>
                                      <span class="rating-star-line"></span>
                                    </div>
                                  </label>
                                    <p>Bad</p>
                                </div>
                                <div class="ratings-box__item">
                                  <label>
                                    <input id="rate-3" class="rating-star-button" type="radio" name="rating-star-button-1" value="3">
                                    <div class="star-line-box">
                                      <span class="rating-star"></span>
                                      <span class="rating-star-line"></span>
                                      <span class="rating-star-line"></span>
                                      <span class="rating-star-line"></span>
                                    </div>
                                  </label>
                                    <p>Okay</p>
                                </div>
                                <div class="ratings-box__item">
                                  <label>
                                    <input id="rate-4" class="rating-star-button" type="radio" name="rating-star-button-1" value="4">
                                    <div class="star-line-box">
                                      <span class="rating-star"></span>
                                      <span class="rating-star-line"></span>
                                      <span class="rating-star-line"></span>
                                      <span class="rating-star-line"></span>
                                    </div>
                                  </label>
                                    <p>Good</p>
                                </div>
                                <div class="ratings-box__item">
                                  <label>
                                    <input id="rate-5" class="rating-star-button" type="radio" name="rating-star-button-1" value="5">
                                    <div class="star-line-box">
                                      <span class="rating-star"></span>
                                      <span class="rating-star-line"></span>
                                      <span class="rating-star-line"></span>
                                      <span class="rating-star-line"></span>
                                    </div>
                                  </label>
                                    <p>Excellent</p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="model-box-appointment">
                          <div class="appointment-inner-first">
                            Experience
                          </div>
                          <div class="appointment-inner-second">
                            <div class="outer">
                              <div class="ratings-box">
                                <div class="ratings-box__item">
                                  <label>
                                    <input id="rate-1" class="rating-star-button" type="radio" name="rating-star-button-3" value="1">
                                    <div class="star-line-box">
                                      <span class="rating-star"></span>
                                      <span class="rating-star-line"></span>
                                      <span class="rating-star-line"></span>
                                      <span class="rating-star-line"></span>
                                    </div>
                                  </label>
                                    <p>Terrible</p>
                                </div>
                                <div class="ratings-box__item">
                                  <label>
                                    <input id="rate-2" class="rating-star-button" type="radio" name="rating-star-button-3" value="2">
                                    <div class="star-line-box">
                                      <span class="rating-star"></span>
                                      <span class="rating-star-line"></span>
                                      <span class="rating-star-line"></span>
                                      <span class="rating-star-line"></span>
                                    </div>
                                  </label>
                                    <p>Bad</p>
                                </div>
                                <div class="ratings-box__item">
                                  <label>
                                    <input id="rate-3" class="rating-star-button" type="radio" name="rating-star-button-3" value="3">
                                    <div class="star-line-box">
                                      <span class="rating-star"></span>
                                      <span class="rating-star-line"></span>
                                      <span class="rating-star-line"></span>
                                      <span class="rating-star-line"></span>
                                    </div>
                                  </label>
                                    <p>Okay</p>
                                </div>
                                <div class="ratings-box__item">
                                  <label>
                                    <input id="rate-4" class="rating-star-button" type="radio" name="rating-star-button-3" value="4">
                                    <div class="star-line-box">
                                      <span class="rating-star"></span>
                                      <span class="rating-star-line"></span>
                                      <span class="rating-star-line"></span>
                                      <span class="rating-star-line"></span>
                                    </div>
                                  </label>
                                    <p>Good</p>
                                </div>
                                <div class="ratings-box__item">
                                  <label>
                                    <input id="rate-5" class="rating-star-button" type="radio" name="rating-star-button-3" value="5">
                                    <div class="star-line-box">
                                      <span class="rating-star"></span>
                                      <span class="rating-star-line"></span>
                                      <span class="rating-star-line"></span>
                                      <span class="rating-star-line"></span>
                                    </div>
                                  </label>
                                    <p>Excellent</p>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="model-textarea-box">
                            <div class="mb-3">
                              <textarea class="review form-control" id="review" rows="3" name="review" 
                                placeholder="Enter review" ></textarea>
                            </div>
                          </div>

                          <div class="single-appointment-model-box">
                            <button class="btn btn-danger" data-bs-dismiss="modal" >CANCEL</button>
                            <button data-id="<?php echo $data['orderid']; ?>" class="addRate btn btn-success">SUBMIT</button>
                          </div>
                      </div>
                    <!-- </form> -->
                  </div>
                </div>
              </div>
            </div>
          </div>

          <?php } ?>
          

         

        <?php } ?>
    <?php }
} ?>