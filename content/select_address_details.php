<?php 
    if(!isset($_SESSION['user_id'])){
        echo "<script>window.location.href='index.php'</script>";
    } 
    if(isset($_SESSION['user_id']))
    {
?>
<div class="Address-box-desgin">
    <div class="container" style="margin-top:50px; margin-bottom: 50px;">
      <div class="row">
        <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
          <div class="main-address-box">
            <div class="address-box">
              <div class="address-first-box">
                <h2>Select Address</h2>
                <img src="images/line.png" alt="" class="line">
              </div>
              <div class="address-last-box">
                <a href="./add_address.php"><button class="btn btn-success">Add Address</button></a>
              </div>
            </div>


            <div class="row">
                <?php 
                $query_address="SELECT *,u.ID as userid,u.name as username,s.ID as stateid,s.name as statename,c.ID as cityid,c.name as cityname,a.ID as adderssid,a.status as adderssstatus,a.type as addersstype,a.name as adderssname,a.houser_no as addersshouserno,a.adderss as addersses,a.pincode as addersspincode,a.latitude as addersslatitude,a.longitude as addersslongitude,a.number as adderssnumber,a.lendmark as addersslendmark  FROM `address` a
    			LEFT JOIN user_registration u ON u.ID = a.user_id
    			LEFT JOIN state s ON s.ID = a.state_id
    			LEFT JOIN city c ON c.ID = a.city_id
    			WHERE a.user_id = '".$_SESSION['user_id']."' and a.status = 1
    			ORDER BY a.ID DESC";
    
        		$sql_address = mysqli_query($con,$query_address)or die(mysqli_error());
        
        		while($data_address = mysqli_fetch_assoc($sql_address))
        		{
		    ?>
              <div class="col-xl-6 .col-sm-12 col-md-12 col-lg-">
                <div class="address-cart-box-desgin">
                  <div class="main-address-cart">
                      
                    <input class="address_id ml-10" name="address_id" id="address_id" type="radio" style="width: 4%;  float:left;" value="<?php echo $data_address['adderssid'] ; ?>" required>
                    
                    <h4><?php echo $data_address['addersstype']; ?></h4>
                    <div class="main-address-text">

                      <p><?php echo $data_address['adderssname']; ?> | </p> <span> <?php echo $data_address['adderssnumber']; ?> </span>
                    </div>

                    <div class="main-details-box">
                      <i class="fas fa-map-marker-alt"></i>
                      <p> <?php echo $data_address['addersshouserno'].','.$data_address['addersslendmark'].','.$data_address['addersses']; ?> </p>
                    </div>
                    <div class="address-cart-btn">
                      <button type="button" class="btn btn-primary address_edit" data-id="<?php echo $data_address['adderssid'];?>">Edit</button>
                      <button type="button" class="btn btn-primary address_remove" data-id="<?php echo $data_address['adderssid'];?>" style="margin-left: 30px;">Delete</button>
                    </div>

                  </div>
                </div>
              </div>
            <?php } ?>
            </div>
            <div class="address-box">
              <div class="address-first-box-1">
                <div class="address-inner-box">
                  <h2 class="mt-4">Select Date</h2>
                  <img src="images/line.png" alt="" class="line">
                </div>
                <div class="address-inner-box">
                  <input class="date" id="date" type="date" name="date"  required/>
                      <input  type="hidden" id="recommended"  name="recommended" value="<?php echo $_GET['recommended'];?>" />
                </div>
              </div>
            </div>


            <div class="address-normal-slot">
              <h2>Select Time</h2>
              <div class="container" style="margin-top: 30px; padding:0px;">
                <ul>
                    
                  <div class="row" id="view_slot">

                  </div>
                  
                    
                
                </ul>
              </div>

            </div>
            <p class="note-text">
              <span> Note: </span> Service Provider will work till 8:00PM due to safety reasons. Remaining services will
              be carried out next day/time.
            </p>

            <!--<a href="Checkout.php"><button class="btn btn-primary">CHECKOUT</button></a>-->
            <button class="submit_checkout btn btn-primary">CHECKOUT</button>
          </div>




        </div>
      </div>
    </div>
  </div>
  </div>
<?php } ?>