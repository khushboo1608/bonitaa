<?php 
if (!isset($_SESSION['user_id'])) {
  echo "<script>window.location.href='index.php'</script>";
}

    $query_address="SELECT *,u.ID as userid,u.name as username,s.ID as stateid,s.name as statename,c.ID as cityid,c.name as cityname,a.ID as adderssid,a.status as adderssstatus,a.type as addersstype,a.name as adderssname,a.houser_no as addersshouserno,a.adderss as addersses,a.pincode as addersspincode,a.latitude as addersslatitude,a.longitude as addersslongitude,a.number as adderssnumber,a.lendmark as addersslendmark  FROM `address` a
    LEFT JOIN user_registration u ON u.ID = a.user_id
    LEFT JOIN state s ON s.ID = a.state_id
    LEFT JOIN city c ON c.ID = a.city_id
    WHERE a.user_id = '".$_SESSION['user_id']."' and a.status = 1
    ORDER BY a.ID DESC";
    
    $sql_address = mysqli_query($con,$query_address)or die(mysqli_error());
    
 
?>
<div class="Address-box-desgin">
    <div class="container" style="margin-top:50px; margin-bottom: 50px;">
      <div class="row">
        <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
          <div class="main-address-box">
            <div class="address-box">
              <div class="address-first-box">
                <h2>My Address</h2>
                <img src="images/line.png" alt="" class="line">
              </div>
              <a href="./add_user_address.php"><button class="btn btn-success">Add Address</button></a>
            </div>
            <div class="row">
            <?php 
            while($data_address = mysqli_fetch_assoc($sql_address))
            {
            ?>          
              <div class="col-xl-6 .col-sm-12 col-md-12 col-lg-">
                <div class="address-cart-box-desgin">
                  <div class="main-address-cart">
                    <h4 style="margin-left: 0px;"><?php echo $data_address['addersstype']; ?></h4>
                    <div class="main-address-text">
                      <p><?php echo $data_address['adderssname']; ?> | </p> <span> <?php echo $data_address['adderssnumber']; ?></span>
                    </div>
    
                    <div class="main-details-box">
                      <i class="fas fa-map-marker-alt"></i>
                      <p><?php echo $data_address['addersshouserno'].','.$data_address['addersslendmark'].','.$data_address['addersses']; ?></p>
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
    
          </div>
        </div>
      </div>
    </div>
</div>