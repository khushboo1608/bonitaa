<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
  <title>Bonitaa</title>

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
  <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>-->

<body>
  <?php include('common/header.php'); ?>
  <!-- cart-box desgin   -->
   
   <?php include('content/franchise_details.php'); ?> 
       
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

<script>
$(document).ready(function(){
       // Verify OTP email jquery
//alert('hii');
        $(".submitFranchise").on("click",function(e){
        
        
        e.preventDefault();
        var franchise_type = $("input[type='radio'].franchise_owner_space:checked").val();
        
        var franchise_name = $("#franchise_name").val();
        var franchise_email = $("#franchise_email").val();
        var franchise_number = $("#franchise_number").val();
        
        var state_id = $("#state_id").val();
        var city_id = $("#city_id").val();
        
        var franchise_occupation = $("#franchise_occupation").val();
        var franchise_age = $("#franchise_age").val();
        var franchise_experience = $("#franchise_experience").val();
        
        var franchise_query = $("#franchise_query").val();
     
        // alert(franchise_type);
        // alert(franchise_query);
        // alert(address);
        // alert(address_type);
        // if(!preg_match("/^[a-zA-Z-' ]*$/", franchise_email)){
        //     alert('Enter valid email address.');
        // }else if(!preg_match("/^([0-9]{10})+$/", franchise_number)){
            
        //     alert('Enter valid number.');
        // }else {
        
        $.ajax({
          type: "POST", 
          url: "public/insert_franchise.php",
          data: {franchise_type:franchise_type,franchise_name:franchise_name, franchise_email:franchise_email,franchise_number:franchise_number,state_id:state_id,city_id:city_id,franchise_occupation:franchise_occupation,franchise_age:franchise_age,franchise_experience:franchise_experience,franchise_query:franchise_query },
          success: function(res) {
            if(res == 0)
            {
                alert('All fields are required.');
            }else if(res == 1){
                alert('Successfully inserted.');
                // window.reload();
                window.location ='index.php';
            }else if(res == 3){
                alert('Enter valid Number.');
            }else if(res == 4){
                alert('Enter valid email address.');
            }else if(res == 34){
                alert('Enter valid email address and number.');
            }
          }
        });
      //}
    });

});
</script>


<script type="text/javascript">
$(function() {
   $("#state_id").bind("change", function() {

       $.ajax({
           type: "GET", 
           url: "change1.php",
           data: "state_id="+$("#state_id").val(),
           success: function(response) {
               $("#city_id").html(response);
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