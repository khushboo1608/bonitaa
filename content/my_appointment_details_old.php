<?php 
if (!isset($_SESSION['user_id'])) {
  echo "<script>window.location.href='index.php'</script>";
}

if(isset($_SESSION['user_id']))
{
    $query_ongoing="SELECT *,s.ID as staffid, s.name as staffname, s.mobile as staffphone,ord.ID as orderid,u.ID as userid,u.name as
    username,a.ID as adderssid,a.status as
    adderssstatus,a.type as addersstype,a.name as adderssname,a.houser_no as addersshouserno,a.adderss as
    addersses,a.pincode as addersspincode,a.latitude as addersslatitude,a.longitude as addersslongitude,a.number as
    adderssnumber,a.lendmark as addersslendmark FROM `orders` ord
    LEFT JOIN user_registration u ON u.ID = ord.user_id
    LEFT JOIN staff s ON s.ID = ord.staff_id
    LEFT JOIN address a ON a.ID = ord.address
    LEFT JOIN review r ON r.ID = ord.id
    WHERE ord.user_id='".$_SESSION['user_id']."' and ( ord.payment_type= 1 or ord.payment_type= 2  )
    ORDER BY ord.id DESC";
    $sql_ongoing = mysqli_query($con,$query_ongoing)or die(mysqli_error());
    
    
    $query_history="SELECT *,s.ID as staffid, s.name as staffname, s.mobile as staffphone,ord.ID as orderid,u.ID as userid,u.name as
    username,a.ID as adderssid,a.status as
    adderssstatus,a.type as addersstype,a.name as adderssname,a.houser_no as addersshouserno,a.adderss as
    addersses,a.pincode as addersspincode,a.latitude as addersslatitude,a.longitude as addersslongitude,a.number as
    adderssnumber,a.lendmark as addersslendmark FROM `orders` ord
    LEFT JOIN user_registration u ON u.ID = ord.user_id
    LEFT JOIN staff s ON s.ID = ord.staff_id
    LEFT JOIN address a ON a.ID = ord.address
    LEFT JOIN review r ON r.ID = ord.id
    WHERE ord.user_id='".$_SESSION['user_id']."' and (ord.payment_type= 3 or ord.payment_type= 4 or ord.payment_type= 5 )
    ORDER BY ord.id DESC";
    $sql_history = mysqli_query($con,$query_history)or die(mysqli_error());
		
?>

<div class="my-Appoinment">
  <div class="container" style="margin-top: 50px; margin-bottom:50px;">
    <div class="row">
      <div class="col-lg-12">
        <div class="card ">
          <h2>My Appointment</h2>
          <nav>
            <div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">
              <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home"
                type="button" role="tab" aria-controls="nav-home" aria-selected="true">ONGOING</button>
              <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile"
                type="button" role="tab" aria-controls="nav-profile" aria-selected="false">HISTORY</button>
            </div>
          </nav>
          <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade active show" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
               <?php 
               
        		while($data_ongoing = mysqli_fetch_assoc($sql_ongoing))
        		{
        		    if ($data_ongoing['order_time'] != "") 
         			{
                        $arr1= explode(",",$data_ongoing['order_time']);
                        $arr = array_filter($arr1, 'strlen');
                    }else
                    {
                        $arr = [] ;
                    }
                    
                    // 1=Pending,2=Accepted,3=Rejected,4=Completed,5=Canceled	
            		
            		if($data_ongoing['payment_status'] == 1){ $payment_status = 'Online Payment'; }else if($data_ongoing['payment_status'] == 2){ $payment_status = 'Pay after Service'; }else if($data_ongoing['payment_status'] == 3){ $payment_status = 'Wallet'; }
    		
        		    if($data_ongoing['payment_type'] == 1){ $payment_type = 'Pending';}else if($data_ongoing['payment_type'] == 2){ $payment_type = 'Accepted';}else if($data_ongoing['payment_type'] == 3){ $payment_type = 'Rejected';}else if($data_ongoing['payment_type'] == 4){ $payment_type = 'Completed';} else if($data_ongoing['payment_type'] == 5){ $payment_type = 'Canceled';}
               ?>
                <div class="appointment-header-box">
                 <a href="./single_appointment.php?book=<?php echo $data_ongoing['orderid']; ?>">
                  <div class="apoinment-header">
                    <p>Appointment ID : <?php echo $data_ongoing['orderid']; ?></p>
                    <span><button class="btn btn-primary"><?php echo $payment_type; ?></button></span>
                  </div>
               
                  <div class="apointment-price">
                    <div class="price_type">
                      <span class="paymnt_type">Booking Date</span>
                      <span class="colon">:</span>
                      <span class="paymnt_price"><?php echo dateString($data_ongoing['order_date']); ?></span>
                    </div>
                    <div class="price_type"><span class="paymnt_type">Booking Time</span>
                        <span class="colon">:</span><span class="paymnt_price"><?php echo $arr1[0]; ?></span>
                    </div>
                    <div class="price_type"><span class="paymnt_type">Payment Mode</span>
                        <span class="colon">:</span><span class="paymnt_price"><?php echo $payment_status; ?></span>
                    </div>
                    <div class="price_type"><span class="paymnt_type">Price</span><span
                        class="colon">:</span><span class="paymnt_price">₹<?php echo $data_ongoing['final_price'];  ?>/-</span></div>
                    <!-- <div class="price_type"><span class="paymnt_type">Service Type</span><span class="colon">:</span><span class="paymnt_price">STANDARD</span></div> -->
                  </div>
                 </a>
                </div>
                <?php } ?>
            </div>
            



            <div class="tab-pane fade active" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                    
                <?php 
               
        		while($data_history = mysqli_fetch_assoc($sql_history))
        		{
        		    if ($data_history['order_time'] != "") 
         			{
                        $arr1= explode(",",$data_history['order_time']);
                        $arr = array_filter($arr1, 'strlen');
                    }else
                    {
                        $arr = [] ;
                    }
                    
                     // 1=Pending,2=Accepted,3=Rejected,4=Completed,5=Canceled	
            		
            		if($data_history['payment_status'] == 1){ $payment_status = 'Online Payment'; }else if($data_history['payment_status'] == 2){ $payment_status = 'Pay after Service'; }else if($data_history['payment_status'] == 3){ $payment_status = 'Wallet'; }
    		
        		    if($data_history['payment_type'] == 1){ $payment_type = 'Pending';}else if($data_history['payment_type'] == 2){ $payment_type = 'Accepted';}else if($data_history['payment_type'] == 3){ $payment_type = 'Rejected';}else if($data_history['payment_type'] == 4){ $payment_type = 'Completed';} else if($data_history['payment_type'] == 5){ $payment_type = 'Canceled';}
               ?>
                <div class="appointment-header-box">
                 <a href="./single_appointment.php?book=<?php echo $data_history['orderid']; ?>">
                  <div class="apoinment-header">
                    <p>Appointment ID : <?php echo $data_history['orderid']; ?></p>
                    <span><button class="btn btn-primary"><?php echo $payment_type; ?></button></span>
                  </div>
               
                  <div class="apointment-price">
                    <div class="price_type">
                      <span class="paymnt_type">Booking Date</span>
                      <span class="colon">:</span>
                      <span class="paymnt_price"><?php echo dateString($data_history['order_date']); ?></span>
                    </div>
                    <div class="price_type"><span class="paymnt_type">Booking Time</span>
                        <span class="colon">:</span><span class="paymnt_price"><?php echo $arr1[0]; ?></span>
                    </div>
                    <div class="price_type"><span class="paymnt_type">Payment Mode</span>
                        <span class="colon">:</span><span class="paymnt_price"><?php echo $payment_status; ?></span>
                    </div>
                    <div class="price_type"><span class="paymnt_type">Price</span><span
                        class="colon">:</span><span class="paymnt_price">₹<?php echo $data_history['final_price'];  ?>/-</span></div>
                    <!-- <div class="price_type"><span class="paymnt_type">Service Type</span><span class="colon">:</span><span class="paymnt_price">STANDARD</span></div> -->
                  </div>
                 </a>
                </div>
                <?php } ?>

            </div>
          </div>

          <!-- Button trigger modal -->



        </div>


        <div class="my-appointnment-mode">
          <div class="modal fade" id="exampleModal-2" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">

                <div class="modal-body">
                  <div class="single-model-box">
                    <div class="single-header-box-2">
                      <p>ADD RATING</p>
                    </div>

                    <div class="model-box-appointment">
                      <div class="appointment-inner-first">
                        Overall
                      </div>
                      <div class="appointment-inner-second">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star" style="color: #D9D9D9;"></i>

                      </div>
                    </div>

                    <div class="model-box-appointment">
                      <div class="appointment-inner-first">
                        Quality
                      </div>
                      <div class="appointment-inner-second">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star" style="color: #D9D9D9;"></i>

                      </div>
                    </div>
                    <div class="model-box-appointment">
                      <div class="appointment-inner-first">
                        Experience
                      </div>
                      <div class="appointment-inner-second">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star" style="color: #D9D9D9;"></i>

                      </div>
                    </div>


                    <div class="model-textarea-box">
                      <div class="mb-3">
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                          placeholder="Good"></textarea>
                      </div>
                    </div>

                    <div class="single-appointment-model-box">
                      <button class="btn btn-danger">CANCLE</button>
                      <button class="btn btn-success">SUBMIT</button>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
        </body>

      </div>
    </div>
  </div>
</div>
</div>
<?php } ?>