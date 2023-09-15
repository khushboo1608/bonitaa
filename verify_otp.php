<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
    <title>Bonitaa</title>

    <!--Boostrap Core Css Start-->

    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />

    <!--Boostrap Core Css end-->
    <!-- favicon -->
    <link rel="apple-touch-icon" sizes="57x57" href="images/favicon.png">
    <link rel="apple-touch-icon" sizes="60x60" href="images/favicon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="images/favicon.png">
    <link rel="apple-touch-icon" sizes="76x76" href="images/favicon.png">
    <link rel="apple-touch-icon" sizes="114x114" href="images/favicon.png">
    <link rel="apple-touch-icon" sizes="120x120" href="images/favicon.png">
    <link rel="apple-touch-icon" sizes="144x144" href="images/favicon.png">
    <link rel="apple-touch-icon" sizes="152x152" href="images/favicon.png">
    <link rel="apple-touch-icon" sizes="180x180" href="images/favicon.png">
    <link rel="icon" type="image/png" sizes="192x192" href="images/favicon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="images/favicon.png">
    <link rel="icon" type="image/png" sizes="96x96" href="images/favicon.png">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <link rel="manifest" href="images/favicon.png">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="images/favicon.png">
    <meta name="theme-color" content="#ffffff">
    <!--Google Font Css Start-->
    <link rel="stylesheet" href="fonts/Poppins-Medium.ttf">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600&display=swap" rel="stylesheet">
    <!--Google Font Css end-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css">
    <!--External Core Css start-->
    <link href="css/default.css" rel="stylesheet" type="text/css" />
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <link href="css/responsive.css" rel="stylesheet" type="text/css" />
    <link href="css/animate.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/slider.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" type="text/css" media="all" href="css/stellarnav.css">
    <!-- Animation -->
    <link rel="stylesheet" href="plugins/animate-css/animate.css">
    <!-- slick Carousel -->
    <link rel="stylesheet" href="plugins/slick/slick.css">
    <link rel="stylesheet" href="plugins/slick/slick-theme.css">
    <link rel="stylesheet" href="css/animated.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/sweetalert/sweetalert.css">
    <!-- new category slider code -->
</head>
<style>

    .main-address-box .my_profile_box .form-control{
        margin-bottom: 20px !important;
    }
    @media screen and (max-width: 61.938em){
     .main-address-box .my_profile_box .form-container {
    padding: 20px !important;
}

.Address-box-desgin .main-address-box {
        padding: 0px 0px !important;
    }
    }
</style>

<body>
    <?php include('common/header.php'); ?>
    <!-- cart-box desgin   -->
    
    <!-- content start   -->
    <?php include('content/verify_otp_details.php'); ?>
    <!-- content End   -->
    
    <!-- footer Section -->
    <?php include('common/footer.php'); ?>
    <div class="beauty-icon">
        <img src="images/service-details/whtsapp1.png" alt="">
    </div>
</body>
<script src="js/jquery.min.js"></script>
<script src="js/wow.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/owl.carousel.js"></script>
<script type="text/javascript" src="js/stellarnav.min.js"></script>
<!-- <script src="plugins/jQuery/jquery.min.js"></script> -->
<script src="plugins/slick/slick.min.js"></script>
<script src="plugins/slick/slick-animation.min.js"></script>
<script type="text/javascript" src="css/sweetalert/sweetalert.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $("#searchForm").on("submit", function(e){
            e.preventDefault();
            var search_text = $("#search_item").val();

            window.location = "search_service_list.php?text="+search_text;
            
        });
    });

</script>

<script type="text/javascript">
    $(document).ready(function(){
        $("#searchButton").on("click",function(e){
            e.preventDefault();
           
            var search_text = $("#search_item").val();
             if(search_text == "")
             {
                 alert('Please enter the service name, whatever you have to find the service.')
             }else{
                 window.location = "search_service_list.php?text="+search_text;
             }
            
            
        });
    });

</script>

<script type="text/javascript">
  $(document).ready(function(){
       // Verify OTP email jquery
    $("#verifyOtp").on("click",function(e){
     // alert('hii');

      e.preventDefault();
      /*var text1 = $("#text1").val();
      var text2 = $("#text2").val();
      var text3 = $("#text3").val();
      var text4 = $("#text4").val();*/
      var user_otp = $("#user_otp").val();
      //alert(user_otp);
      $.ajax({
        url  : "public/verify_otp.php",
        type : "POST",
        cache: true,
        data : {user_otp:user_otp},
        success:function(response){
          //alert(response);
          if (response == 1) {
            swal({
                title: "Successfully",
                text: "Your OTP verified Successfully!",
                type: "success",
                showCancelButton: false,
                closeOnConfirm: false,
                showLoaderOnConfirm: true
              }, 
              function () {
                setTimeout(function () {
                  // swal("Ajax request finished!");
                  window.location.href='profile.php';
                }, 2000);
              });


            //alert('success login');
            
          }
          if (response == 2) {
            swal({
                title: "Successfully",
                text: "Your OTP verified Successfully!",
                type: "success",
                showCancelButton: false,
                closeOnConfirm: false,
                showLoaderOnConfirm: true
              }, 
              function () {
                setTimeout(function () {
                  // swal("Ajax request finished!");
                  window.location.href='index.php';
                }, 2000);
              });


            //alert('success login');
            
          }
          if (response == 3) {
            $(".otp-message").html("Please enter valid OTP");
          }  
          
         if(response== 0){
                //alert('failed');
                
                  swal({
                  title: "Failed!",
                  text: "something went wrong",
                  type: "error",
                  showCancelButton: false,
                  closeOnConfirm: false,
                  showLoaderOnConfirm: true,
                  showConfirmButton: true
                }, 
                function () {
                  setTimeout(function () {
                    // swal("Ajax request finished!");
                    location.reload();
                  }, 2000);
                });
                
              }
        
        }
      });
    });
  });
  </script>

  <script type="text/javascript">
  $(document).ready(function(){
    $("#resendOTP").on("click",function(e){
      //alert('dfvgfv');
      e.preventDefault();
      var user_phone = $("#user_phone").val();
      // alert(user_phone);
      swal({
        title: "Resend OTP!",
        text: "Are you sure resend your OTP ?",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        cancelButtonClass: "btn-warning",
        confirmButtonText: "Confirm!",
        cancelButtonText: "Cancel",
        closeOnConfirm: false,
        closeOnCancel: false,
        showLoaderOnConfirm: true
      },
      function(isConfirm) {
      if (isConfirm) {
        $.ajax({
          url  : "public/send_otp.php",
          type : "POST",
          data :{user_phone : user_phone},
          cache: true,
          success:function(response){
          //console.log(response);
            //alert(response);
              if(response== 'insert')
              {
                window.location.reload();
                //alert('Successfully inserted..!')
                
              }else if(response== 'invalid'){
                //alert('failed');
                
                  swal({
                  title: "Failed!",
                  text: "something went wrong",
                  type: "error",
                  showCancelButton: false,
                  closeOnConfirm: false,
                  showLoaderOnConfirm: true,
                  showConfirmButton: true
                }, 
                function () {
                  setTimeout(function () {
                    // swal("Ajax request finished!");
                    location.reload();
                  }, 2000);
                });
                
              }
               
          }
        });
      }else{
            swal.close();
        }
    });
    });

   });
 </script>

 <script type="text/javascript">
  $(document).ready(function(){
    $(".selectCity").on("click",function(e){
        // alert('hii');
         e.preventDefault();

         var _id=$(this).data("id");

         // alert('Hello');

        //alert(_id);

        $.ajax({
        url  : "public/add_city.php",
        type : "POST",
        cache: true,
        data : {id:_id},
        success:function(response){
          //alert(response);
          if (response == 1) {
            location.reload();
          }else if (response == 0) {
            location.reload();
          }
          
        }
        });

    });
});
</script>

</html>