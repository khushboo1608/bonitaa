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
              <div class="address-first-box-1">
                <div class="address-inner-box">
                  <h2 class="mt-4">Select Date</h2>
                  <img src="images/line.webp" alt="" class="line">
                </div>
                <div class="address-inner-box">
                  <input class="date" id="date" type="date" name="date"  required/>
                </div>
              </div>
            </div>

            <input type="hidden" name="book_id" id="book_id" value="<?php echo $_GET['book']; ?>">
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
              be carried out next day/time. Now, you can check the body temperature of your assigned service provider in
              "My Appointments" tab
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