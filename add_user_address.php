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

<body>
  <?php include('common/header.php'); ?>
  <!-- cart-box desgin   -->
   
   <?php include('content/add_address_details.php'); ?> 
       
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
// alert('hii');
        $(".submitAddress").on("click",function(e){
        
        e.preventDefault();
        var address_type = $("input[type='radio'].address_type:checked").val();
        
        var address_name = $("#address_name").val();
        var address_number = $("#address_number").val();
        var address_houser_no = $("#address_houser_no").val();
        var address_lendmark = $("#address_lendmark").val();
        var state_id = $("#state_id").val();
        var city_id = $("#city_id").val();
        var lattitude = $("#lattitude1").val();
        var postal_code = $("#postal_code1").val();
        var longitude = $("#longitude1").val();
        var address = $("#address1").val();
        
        if(address_name == "")
        {
            alert('Enter your name');
        }else if(address_number == ""){
            alert('Enter your number');
        }else if(address_houser_no == ""){
            alert('Enter your house number');
        }else if(address_lendmark == ""){
            alert('Enter your lendmark');
        }else if(state_id === null){
            alert('Enter your state');
        }else if(city_id === null){
            alert('Enter your city');
        }else if(address == ""){
            alert('Enter your address');
        }else{
        //alert(address_id);
        // alert(address_name);
        // alert(address);
        // alert(address_type);
        
        $.ajax({
          type: "POST", 
          url: "public/insert_address.php",
          data: {address_type:address_type,address_name:address_name, address_number:address_number,address_houser_no:address_houser_no,address_lendmark:address_lendmark,state_id:state_id,city_id:city_id,lattitude:lattitude,postal_code:postal_code,longitude:longitude,address:address },
          success: function(res) {
            if(res == 0)
            {
                window.location ='#';
            }else if(res == 1){
                window.location ='my_address.php';
            }else if(res == 2){
                window.location ='#';
            }
          }
        });
        }
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
<script>
    function initMap() {
          
        var map = new google.maps.Map(document.getElementById('map1'), {
          center: {lat: -33.8688, lng: 151.2195},
          zoom: 5
        });
        
        var input = document.getElementById('searchInput11');
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.bindTo('bounds', map);

        var infowindow = new google.maps.InfoWindow();
        var marker = new google.maps.Marker({
            map: map,
            anchorPoint: new google.maps.Point(0, -29)
        });

        autocomplete.addListener('place_changed', function() {
            infowindow.close();
            marker.setVisible(true);
            var place = autocomplete.getPlace();
            if (!place.geometry) {
                window.alert("Autocomplete's returned place contains no geometry");
                return;
            }
      
            // If the place has a geometry, then present it on a map.
            if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
            } else {
                map.setCenter(place.geometry.location);
                map.setZoom(17);
            }
            marker.setIcon(({
                url: place.icon,
                size: new google.maps.Size(71, 71),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(17, 34),
                scaledSize: new google.maps.Size(35, 35)
            }));
            marker.setPosition(place.geometry.location);
            marker.setVisible(true);
        
            var address = '';
            if (place.address_components) {
                address = [
                  (place.address_components[0] && place.address_components[0].short_name || ''),
                  (place.address_components[1] && place.address_components[1].short_name || ''),
                  (place.address_components[2] && place.address_components[2].short_name || '')
                ].join(' ');
            }
        
            infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
            infowindow.open(map, marker);
            
            //Location details
            for (var i = 0; i < place.address_components.length; i++) {
                if(place.address_components[i].types[0] == 'postal_code'){
                    document.getElementById('postal_code1').value = place.address_components[i].long_name;
                }
                if(place.address_components[i].types[0] == 'city'){
                    document.getElementById('city1').value = place.address_components[i].long_name;
                }
            }
            document.getElementById('address1').value = place.formatted_address;
            document.getElementById('lattitude1').value = place.geometry.location.lat();
            document.getElementById('longitude1').value = place.geometry.location.lng();
        });
    }
    
    
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCLxVM_aB14W1tK54hGd10SMV6epdKZ2Go&libraries=places&callback=initMap" async defer></script>

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