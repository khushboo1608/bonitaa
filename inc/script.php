<script>
  // Manage Cart JS Code
  function manage_cart(pid,type){
    if(type=='update'){
      var qty =jQuery("#"+pid+"qty").val();  
    }else{
      var qty =jQuery("#qty").val();
    }
    jQuery.ajax({
      url:'update_table.php?mode=managecart',
      type:'POST',
      data:'pid='+pid+'&qty='+qty+'&type='+type,
      success:function(result){
        if(type=='update' || type=='remove' || type=='empty'){
          window.location.href=window.location.href;
        }
        jQuery('.cart_class').html(result);
      }
    });
  }
</script>

<script>
  // Swiper Configuration (Custom SLider JS)
var swiper = new Swiper(".swiper-container", {
  slidesPerView: 1.5,
  spaceBetween: 10,
  centeredSlides: true,
  freeMode: true,
  grabCursor: true,
  loop: true,
  pagination: {
    el: ".swiper-pagination",
    clickable: true
  },
  autoplay: {
    delay: 4000,
    disableOnInteraction: false
  },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev"
  },
  breakpoints: {
    500: {
      slidesPerView: 1
    },
    700: {
      slidesPerView: 1.5
    }
  }
});

</script>


<script>
// Selling Packages  
$(document).ready(function() {
  $('.owl-carousel-package').owlCarousel({
    loop: true,
    margin: 10,
    responsiveClass: true,
    responsive: {
      0: {
        items: 1,
        nav: true,
        autoplay: true
      },
      600: {
        items: 1,
        nav: false,
        loop: true,
        autoplay: true
      },
      1000: {
        items: 3,
        nav: true,
        loop: true,
        autoplay: true,
        margin: 20
      }
    }
  })
});
</script>

<!-- Feedback Script :: START -->
<!-- <div id="id01" class="w3-modal" style="display: block;">
  <div class="w3-modal-content" style="min-height:130px;max-width: 430px;">
    <div style="height:22px; background:#FFFFFF; padding:6px;">
      <span>Title</span><br>
      <hr>
      <span onClick="document.getElementById('id01').style.display='none'" class="w3-button w3-display-topright" style="font-size:28px;">×</span>
      <span style="font-size:14px; color:#FFFFFF; font-weight:bold; padding:10px; font-family:Arial, Helvetica, sans-serif;"></span>
    </div>
    <div>
      <div align="center" style="padding:10px;background:#FFFFFF;">
        <div style="font-size:14px; font-family:Arial, Helvetica, sans-serif; line-height:25px;">
          <table width="98%" border="0" align="center" style="color:#000;">
            <tbody>
              <tr>
                <div class="form-group">
                  <input type="text" class="form-control" name="name" placeholder="Enter Your Name">
                </div>
              </tr>
              <tr>
                <td style="padding:5px; line-height:27px; font-size:20px; text-align: center;">
                <div align="center">
                  <br>
                  <hr>
                  <a class="btn btn-danger" href="">Submit</a>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
        </div>
      </div>
    </div>
  </div>
</div> -->

<div class="modal fade" id="id01" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header border-bottom-0">
        <h5 class="modal-title bold" id="exampleModalLabel">Write a Review </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form name="reviewform" id="reviewform">
        <div class="col-sm-12" style="padding-top: 10px;">
              <span id="message" style="color:#ff1a1a; font-weight: bold;"></span>
          </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="name" class="bold">Your Name</label>
            <input type="text" class="form-control" id="uname" name="uname" placeholder="Enter Your Name" required>
          </div>
          <div class="form-group">
            <label for="review" class="bold">Your Review </label>
            <textarea name="review" id="review" cols="30" rows="4" class="form-control" placeholder="Write your Review here" required></textarea>
          </div>
        </div>
        <div class="modal-footer border-top-0 d-flex justify-content-center">
          <button type="submit" class="btn btn-danger">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!--- Check username exists using jquery ajax --->
<script type="text/javascript">
  $(document).ready(function(){
      $("#reviewform").on("submit",function(e){
        e.preventDefault();
        var uname  = $("#uname").val();
        var review = $("#review").val();
        if (uname !== "" && review !=="") {
            $.ajax({
              url : "update_table.php?mode=reviewform",
              type : "POST",
              cache:false,
              data : {uname:uname,review:review},
              success:function(result){
                $("#message").text('Review Successfully Submitted !!');
                setTimeout(function() {$('#reviewform').modal('hide');}, 3000);
                // document.getElementById("reviewform").style.display = "none";
              }
            });
        }else{
          $("#message").text('Please fill the all fields');
        }
      });
  });
</script>
<!-- Feedback Script :: END -->

<!-- Fill form Mandatory  -->
<?php if(empty($_COOKIE['popup_entry']) && empty($userSession)){ ?>
<div id="id02" class="w3-modal" style="display: block; background-color: rgba(0,0,0,0.9);">
  <div class="w3-modal-content" style="min-height:130px;max-width: 430px;">
    <div style="height:50px; color: #fff; background: #323664; padding: 6px 1em; border-bottom: 1px solid gainsboro;">
      <h5 class="bold">Fill the Required Details</h5>
      <span onClick="document.getElementById('id02').style.display='none'" class="w3-button w3-display-topright" style="font-size:28px;">×</span>
    </div>
    <div>
      <div style="background:#FFFFFF;">
          <form name="mandatoryfillform" id="mandatoryfillform" method="POST" action="<?= $baseurl; ?>/update_table.php?mode=mandatoryfillform">
            <div class="col-sm-12" style="padding-top: 10px;">
                  <span id="message" style="color:#ff1a1a; font-weight: bold;"></span>
              </div>
            <div class="modal-body" style="padding: 0px 10px;">
              <div class="form-group">
                <label for="name" class="bold">Your Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Your Name" required>
              </div>
              <div class="form-group">
                <label for="name" class="bold">Location <small class="italic font-12">(City)</small></label>
                <input type="text" class="form-control" id="city" name="city" placeholder="Enter Your City" required>
              </div>
              <div class="form-group">
                <label for="name" class="bold">Mobile No</label>
                <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Enter Your Mobile No." required>
              </div>
              <div class="form-group">
                <label for="name" class="bold">Email ID <small class="italic font-12">(optional)</small></label>
                <input type="text" class="form-control" id="email" name="email" placeholder="Enter Your Email ID">
              </div>              
            </div>
            <div class="modal-footer border-top-0 d-flex justify-content-center">
              <button type="submit" class="btn btn-danger btn-block" style="background: #323664; border-color: #16193a;">Submit Details</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php } ?>


<!-- Location Modal -->
<!-- Modal -->
<div class="modal fade" id="locationModal" tabindex="-1" role="dialog" aria-labelledby="Select Location"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" id="modelc">
      <div class="modal-body" id="modelbody">
        <div class="text-center" style="font-size: 20px ;font-weight: 600;">Select Your City</div>
        <div class="text-center" style="font-size: 14px; font-weight: 500;">Currently Available in</div>
        <div class="row" style="margin-top: 25px;">

          <?php 
          // Display Data From Database
          $locations = getAllRecords($con,"location");
            foreach ($locations as $location) { 
              $citypic = (@$location['pic']!="") ? @$location['pic'] : "noimg.webp";
              $selected = (@$_COOKIE['location'] == @$location['city']) ? "(Selected)" : "";
              ?>
          <div class="col-4">
            <div class="locationmenu text-center">
              <form action="update_table.php?mode=setlocation" method="POST">
                <input type="hidden" name="city" id="city" value="<?= $location['city']; ?>">
                <img class="img-thumbnail" src="<?= UPLOAD_PATH.'location/'.$citypic; ?>"
                  alt="<?= $location['city']; ?>" style="width:100px;height:100px; border-radius: 50%; border: none; display: block;
                  margin-left: auto; margin-right: auto;">
                <button type="submit" name="submit" class="location_submit_button"><?= $location['city']; ?></button><br>
                <span class="font-13"><?= $selected ?></span>
              </form>
            </div>
          </div>
          <?php } ?>
          
          <!-- <div class="col-4">
            <div class="locationmenu">
              <a href="Delhi.php">
                <img class="img-thumbnail" src="https://www.homesalon.in/admin/images/New-Delhi-India-War-Memorial-arch-Sir.jpg"
                alt="Bestseller" style="width:80px;height:80px; border-radius: 50%; border: none; display: block;
                margin-left: auto;
              margin-right: auto;">
            </a>
            <p class="text-center font-16">Delhi</p>
            </div>
          </div> -->

        </div>
        <!-- <div class="modal-footer" style="margin-top: 10px; height: 70px;">
          <button class="autodetect"><i class="fa fa-map-pin" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp; Detect my
          location</button>
        </div> -->
      </div>
    </div>
  </div>
</div>

<!-- Btn Color Change On Click  -->
<script>
    $(".cart-btn").click(function () {
        $(this).addClass("btn btn-dark");
        $(this).removeClass("btn btn-danger");
    });
</script>   