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
<body>
<script>
                  function myFunction() {
                    // Get the text field
                    var copyText = document.getElementById("myInput");

                    // Select the text field
                    copyText.select();
                    copyText.setSelectionRange(0, 99999);
                    // Copy the text inside the text field
                    navigator.clipboard.writeText(copyText.value);

                  }
                </script>
  <?php include('common/header.php'); ?>
    <div class="overlay"></div>

       <?php //echo 'timezone'.$_GET['timezone'];  echo $_GET['address']; ?>
    <!-- checkout desgin   -->
    <?php include('content/checkout_details.php'); ?>
    <!-- footer Section -->
    <?php include('common/footer.php'); ?>

    <div class="beauty-icon">
        <img src="images/service-details/whtsapp1.png" alt="">
    </div>
</body>
<script src="script.js"></script>
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
    //   alert('hiiiiiiii');
    $(".couponSubmit").on("click",function(e){
        //  alert('hii');
         e.preventDefault();


    });
});
</script>

<script type="text/javascript">
  $(document).ready(function(){
    //   alert('hiiiiiiii');
    $(".couponSubmit").on("click",function(e){
        //  alert('hii');
        e.preventDefault();
        var promocode = $('#promocode').val();
        var dis_amount = $('#dis_amount').val();
        var ori_amount = $('#ori_amount').val();
        
        // alert(promocode);
        // alert(dis_amount);
        
        $.ajax({
        url  : "public/check_coupon_code.php",
        type : "POST",
        cache: true,
        data : {promocode:promocode, dis_amount: dis_amount, ori_amount:ori_amount },
        success:function(result){
            if(result=='invalid')
            {   
                 swal({
                title: "Sorry!",
                text: "Sorry, the coupon code you entered is invalid or expired",
                type: "warning",
                showCancelButton: true,
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
                showConfirmButton: false
              }, 
              function () {
                setTimeout(function () {
                  // swal("Ajax request finished!");
                   location.reload();
                   //location.reload();
                }, 2000);
            });
            
                // alert('failed');
            }else if(result=='invalid_not')
            {   
                 swal({
                title: "Sorry!",
                text: "Sorry, the coupon code you entered is invalid",
                type: "warning",
                showCancelButton: false,
                closeOnConfirm: false,
                showLoaderOnConfirm: true
              }, 
              function () {
                setTimeout(function () {
                  // swal("Ajax request finished!");
                   location.reload();
                   //location.reload();
                }, 2000);
            });
            
                // alert('failed');
            }
            
            else{
                
                 swal({
                title: "Successfully",
                text: "The promotion code has been applied and redeemed successfully.",
                type: "success",
                showCancelButton: true,  
                confirmButtonClass: "btn-danger",  
                confirmButtonText: "Confirm",  
                closeOnConfirm: false,  
                showLoaderOnConfirm: true,
                timer: 2000,
                buttons: false,
              }, 
              function () {
                setTimeout(function (er) {
                  // swal("Ajax request finished!");
                //   location.reload();
                   //location.reload();
                   $('.steal-summary-main').html(result);
                    swal.close();
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
    //   alert('hiiiiiiii');
    $(".booksubmit").on("click",function(e){
        //  alert('hii');
        e.preventDefault();
        var payment_status = $("input[type='radio'].payment_status:checked").val();
        var instructions = $('#instructions').val();
        var address = $('#address').val();
        var timezone = $('#timezone').val();
        var promocode = $('#promocode').val();
        var date = $('#date').val();
        var recommended = $('#recommended').val();
            //  alert(recommended);
        // alert(payment_status);
        // alert(instructions);
        // alert(address);
        // alert(timezone);
        // alert(promocode);
        // alert(date);
        
        $.ajax({
        url  : "public/insert_booking.php",
        type : "POST",
        cache: true,
        data : { payment_status:payment_status, instructions: instructions, address:address, timezone:timezone, promocode:promocode, date:date, recommended:recommended },
        success:function(result){
    
            if(result=='failed')
            {
                 swal({
                title: "Sorry!",
                text: "Please select the payment type.",
                type: "warning",
                showCancelButton: true,
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
                showConfirmButton: false
              }, 
              function () {
                setTimeout(function () {
                  // swal("Ajax request finished!");
                   location.reload();
                   //location.reload();
                }, 2000);
            });
            
                // alert('Please select the payment type.');
            }else if(result=='success'){
                  swal({
                title: "Successful",
                text: "Service Booked Successful!",
                type: "success",
                showCancelButton: false,
                closeOnConfirm: false,
                showLoaderOnConfirm: true
              }, 
              function () {
                setTimeout(function () {
                  // swal("Ajax request finished!");
                    window.location ='thankyou.php';  
                   //location.reload();
                }, 2000);
            });
            
            //   window.location.href='thankyou.php';
            }else if(result=='service_min_time'){
                
                  swal({
                title: "Sorry!",
                text: "You have to book service minimum amount 500...!",
                type: "warning",
                showCancelButton: true,
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
                showConfirmButton: false
              }, 
              function () {
                setTimeout(function () {
                  // swal("Ajax request finished!");
                   location.reload();
                   //location.reload();
                }, 2000);
            });
            
                // alert('You have to book service minimum 1 hours...!');
            }else if(result=='wallet'){
                
                  swal({
                title: "Sorry!",
                text: "Insufficient balance in your wallet...!",
                type: "warning",
                showCancelButton: true,
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
                showConfirmButton: false
              }, 
              function () {
                setTimeout(function () {
                  // swal("Ajax request finished!");
                   location.reload();
                   //location.reload();
                }, 2000);
            });
                // alert('Insufficient balance in your wallet...!');
            }
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
<script type="text/javascript">
    function preventBack() {
        window.history.forward(); 
    }
    setTimeout("preventBack()", 0);
    window.onunload = function () { null };
</script>

</html>