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
    <!-- new category slider code -->
</head>
  <style>
     .thankyou_pro .thankyou_box{
        padding: 10px 50px 50px 50px ;
        background-color: white;
        box-shadow: 0px 0px 10px;
        border-radius: 10px;
     }
     .thankyou_pro .thankyou_box h2{
        margin-bottom: 20px;
     }
     .thankyou_pro .thankyou_box p{
        color: black;
        margin-bottom: 30px;
     }
     .thankyou_pro .thankyou_box .btn-success{
        padding: 12px 30px;
         border-radius: 8px;
        font-weight: 700;
        font-size: 18px;
        background-color:#444444;
        border: none;
        outline: none;

     }
     .thankyou_pro .thankyou_box .btn-success:focus{
        background-color:#444444 !important;
         color: white  !important;
         border: none  !important;
         box-shadow: none;
         outline: none  !important;
     }
     .thankyou_pro .thankyou_box .btn-success:hover{
        background-color: #444444  !important;
         color: white  !important;
         border: none  !important;
         box-shadow: none  !important;
         outline: none  !important;
     }
     .thankyou_pro .thankyou_box .btn-success:active{
        background-color:#444444  !important;
         color: white  !important;
         border: none  !important;
         box-shadow: none  !important ;
         outline: none  !important;
     }

  </style>
<body>
    <?php include('common/header.php'); ?>
    <!--  thankyou-page design   -->
       <div class="thankyou_pro">
         <div class="container" style="margin-bottom:50px; margin-top:50px">
             <div class="row justify-content-center">
                 <div class="col-lg-8 col-sm-12 col-md-12 col-xl-8">
                     <div class="thankyou_box">
                            <img src="images/thank.png" alt="">
                            <h2>Thank you for your Order !</h2>
                           <p>Your Service Has been Booked with us, We Will reach you soon !</p>
                           <a href="index.php"><button class="btn btn-success">GO TO HOMEPAGE</button></a>
                           <a href="my_appointment.php"><button class="btn btn-success">GO TO MY APPOINTMENT</button></a>
                     </div> 
                 </div>
             </div>
         </div>
       </div>
  
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