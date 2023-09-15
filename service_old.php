<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
  <title>Colorsoul</title>
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
<!-- new link bootstrap -->

<style>
  /* .topSection {
      /* background-color: #f5f8fc;
      color: #282828;
      padding: 25px; 
    } */

  .topSection .font-name {
    font-size: 18px;
  }

  .font-description {
    font-size: 30px;
  }

  .font-details {
    font-size: 18px;
  }

  .nav-pills .nav-link {
    text-align: left;
  }

  .btn-primary {
    margin-top: 0px;
    font-weight: 700;
    background-color: white;
    width: 100%;
    color: black;
    border-bottom: 2px solid black;
    padding: 10px 0px;
    text-align: left;
    padding-left: 20px;
    border-top: none;
    border-left: none;
    border-right: none;
  }

  .btn-primary:hover {
    background-color: white;
    color: black;
  }

  .btn-primary:focus {
    color: black;
    box-shadow: none;
    border: none;
    background-color: white;
  }

  .btn-primary .active {
    color: black;
    background-color: white !important;
  }

  .fontWrapper {
    background-color: #f5f8fc;
    position: relative;
    overflow: hidden;
  }

  .fontWrapper .navbar {
    width: 100%;
    height: 100%;
    align-items: center;
    position: relative;
    background-color: transparent;
  }

  .navar {
    padding: 0px 0px !important;
  }

  .fontWrapper .navbar.nav {
    position: relative;
    z-index: 9;
  }

  .fontWrapper .navbar.nav .nav-pills {
    width: 100%;
  }

  .fontWrapper .navbar.nav .nav-pills .nav-link {
    padding: 0px !important;
    font-size: 36px;
    color: #999;
    transition: all 0.3s ease-out;
  }


  .nav-pills .nav-link.active,
  .nav-pills .show>.nav-link {
    color: black;
    background-color: white !important;
  }

  .tab-content-header-box .nav-item {
    margin-right: 10px;
    background: white;
    padding: 20px;
    border-radius: 10px;
  }

  .tab-content-header-box .nav-item:active {
    border: 1px solid #999999;
    border-radius: 10px;
  }

  .tab-content-header-box .nav-item.active {
    border: 1px solid #999999;
    border-radius: 10px;
    color: #b93c5b !important;
  }

  .tab-content-header-box .nav-item:focus {
    border: 1px solid black;
  }

  .tab-content-header-box .nav-item a p {
    margin-top: 15px;
    color: black;
    text-align: center;
  }

  .tab-content-header-box .nav-item a p.active {
    color: red !important;
  }

  .tab-content-header-box .nav-item a p:active {
    color: red !important;
  }

  .fontWrapper .navbar.nav .nav-pills .nav-link:hover {
    background-color: transparent;
    color: #000;

  }

  .fontWrapper .navbar.nav .nav-pills .nav-link.active {
    color: #fff;
  }

  .scrollableArea {
    padding-top: 32px;
  }

  .scrollspy-example {
    position: relative;
    max-height: 800px;
    overflow-y: auto;
    overflow-x: hidden;
  }

  .scrollspy-example::-webkit-scrollbar {
    width: 0px;
  }

  .bold-content h1 {
    font-size: 30px;
  }

  .medium-content {
    min-height: 250px;
  }

  .light1 {
    min-height: 250px;
  }

  .medium-content h3 {
    font-size: 26px;
  }

  .regular-content {
    min-height: 400px;
    padding-bottom: 0px;
  }

  .regular-content .fontRegularContent {
    font-size: 16px;
  }

  .light-content {
    padding-top: -30px;
    min-height: 350px;
  }

  .light-content h3 {
    font-size: 28px;
    padding-left: 80px;
    position: relative;
  }

  .light-content h3:before {
    display: block;
    padding-left: 10px;
    content: "\201C";
    font-size: 100px;
    position: absolute;
    left: 0px;
    top: 0px;
    line-height: 84px;
    color: #d8d8d8;
  }

  .scrollingTabFooter {
    display: flex;
    width: 100%;
    border-top: 2px solid #1c1c1c;
    padding-top: 10px;
    padding-bottom: 60px;
  }

  .scrollingTabFooter div {
    display: inline-block;
  }

  .fontName {
    margin-right: auto;
  }

  .fontType {
    margin-left: auto;
  }

  .scrollingTabFooter {
    display: flex;
    width: 100%;
    border-top: 2px solid #1c1c1c;
    padding-top: 10px;
    padding-bottom: 30px;
  }

  .scrollingTabFooter div {
    display: inline-block;
  }

  .fontName {
    margin-right: auto;
  }

  .fontType {
    margin-left: auto;
  }

  .bottomSection {
    padding: 60px 0px 100px;
  }

  .scrollableArea {
    width: 100%;
    position: sticky;

  }

  .show_time {
    display: none;
  }

  .nav-pills .nav-link {
    padding: 0px;
    color: black;
    font-weight: 600;
    /* border-bottom: 1px solid #bdb6b6;  */
  }

  .nav-pills .nav-link img {
    margin: 0 auto;
    border-radius: 50px;
    width: 100px;
    display: flex;
  }

  .nav-pills .nav-link:active {
    padding: 0px;
    background: transparent !important;
    color: black;
    /* width: 80px; */
    border-radius: 50px;
  }

  .tab-content-header-box p {
    text-align: left;
    margin-bottom: 0px;
    color: black;
    font-size: 16px;
  }

  .tab-content-header-box .navbar {
    -webkit-box-shadow: 0 0px 0px 0 rgb(0 0 0 / 5%);
    box-shadow: 0 0px 0px 0 rgb(0 0 0 / 5%);
    padding: 0px;
  }

  /* cusmtom css */
  .waxix-box {
    height: 270px;
    margin-top: 30px;
    margin-bottom: 30px;
    display: flex;
    background-color: white;
    border-radius: 10px;
  }

  .waxix-box .waxix-img {
    width: 300px;
    height: 300px;
  }

  .waxix-box .waxix-img img {
    width: 100%;
    height: 270px;
    border-radius: 10px 0px 0px 10px;
  }

  .waxix-box .waxix-content {
    width: 70%;
    padding: 10px;
  }

  .waxix-box .waxix-content a {
    display: flex;
    margin-left: 35px;
    font-weight: 600;
    color: #b93c5b;
    text-align: left;
  }

  .waxix-box .waxix-content h4 {
    font-size: 20px;
    margin-left: 13px;
    text-align: left;
  }

  .waxix-box .waxix-content ul li {
    text-align: left;
    margin-left: 20px;
    font-size: 14px;
    font-weight: 600;
  }

  .waxix-box .waxix-content .bottom_right {
    padding: 0px 10px;
    margin-top: 12px;
  }

  .waxix-box .waxix-content .bottom_right .Price_box {
    text-align: start;
    margin-left: 4px;
    margin-bottom: 10px;
    width: 100%;

  }

  .waxix-box .waxix-content .bottom_right .discount {
    color: green;
    margin-left: 15px;
  }

  .waxix-box .waxix-content .bottom_right .prev_price {
    margin-left: 15px;
    text-decoration: line-through;
    opacity: 50%;
  }

  .waxix-box .waxix-content .bottom_right .add_cart_btn {
    width: 143px;
    font-size: 13px;
    height: 40px;
    border: none;
    border-radius: 25px;
    display: flex;
    display: -webkit-box;
    display: -moz-box;
    display: -ms-flexbox;
    display: -webkit-flex;
    justify-content: center;
    align-items: center;
    color: #fff;
    background: #b93c5b;
    cursor: pointer;
    font-weight: bold;
    margin-left: 6px;
  }

  .waxix-box .waxix-content .bottom_right a {
    text-decoration: none;
  }

  .waxix-box .waxix-content .bottom_right a .add_cart_btn {
    margin-left: -32px;
    background-color: white;
    border: 1px solid #b93c5b;
    text-decoration: none;
    color: #b93c5b;
  }

  .waxix-box .waxix-content .service_time span {
    text-align: initial;
    margin-top: 12px;
    margin-left: 10px;
  }

  .waxix-box .waxix-content .service_time {
    text-align: initial;
    margin-top: 12px;
    margin-left: 13px;
  }

  .waxix-box .waxix-content .service_time1 {
    text-align: initial;
    margin-top: 12px;
    margin-left: 18px;
  }

  .waxix-box .waxix-img .service-details {
    background: rgb(56, 142, 60);
    color: rgb(255, 255, 255);
    font-size: 12px;
    font-weight: 700;
    text-align: center;
    padding-top: 9px;
    padding-bottom: 9px;
    border-radius: 0px 25px 25px 0px;
    box-shadow: rgb(100 100 111 / 0%) 0px 7px;
    width: 117px;
    position: relative;
    top: 22%;
  }

  .typeFont h2 {
    text-align: left;
    font-size: 30px;
  }

  .waxix-box .waxix-img .service-details p {
    margin-bottom: 0px;
  }

  .waxix-box .waxix-img .service-details1 p {
    margin-bottom: 0px;
  }

  .waxix-box .waxix-img .service-details3 p {
    margin-bottom: 0px;
  }

  .waxix-box .waxix-img .service-details1 {
    background: rgb(56, 142, 60);
    color: rgb(255, 255, 255);
    font-size: 12px;
    font-weight: 700;
    text-align: center;
    padding-top: 9px;
    padding-bottom: 9px;
    border-radius: 0px 25px 25px 0px;
    box-shadow: rgb(100 100 111 / 0%) 0px 7px;
    width: 32%;
    position: realtive;
    top: 46%;
    position: relative;
  }

  .waxix-box .waxix-img .service-details3 {
    background: rgb(56, 142, 60);
    color: rgb(255, 255, 255);
    font-size: 12px;
    font-weight: 700;
    text-align: center;
    padding-top: 9px;
    padding-bottom: 9px;
    border-radius: 0px 25px 25px 0px;
    box-shadow: rgb(100 100 111 / 0%) 0px 7px;
    width: 117PX;
    position: absolute;
    top: 94px;
  }

  .flex-sm-column {
    width: 100%;
  }

  .waxim-text-img h4 {
    display: none;
  }

  .waxix-box .waxix-content .service_time1 span {
    margin-left: 10px;
  }


  @media screen and (max-width: 61.938em) {
    .waxix-box .waxix-img .service-details1 {

      display: block;
    }

    .waxim-text-img h4 {
      display: block;
    }

    .tab-content-header-box .nav-item {
      margin-left: 6px;
      margin-right: 4px;
      margin-top: 20px;
      width: 47%;
    }

    .waxix-box .waxix-content .bottom_right .Price_box {
      margin-left: 170px;
    }

    .tab-content-header-box {
      margin-top: 0px !important;
    }

    .fontWrapper .container {
      margin-top: 0px;
    }

    .tab-content-header-box p {
      margin-top: 5px;
      width: 100%;
    }

    .fontWrapper .navbar {
      margin-top: -133px !important;
      margin-bottom: 25px;
    }

    .waxix-box .waxix-content .service_time1 {
      text-align: initial;
      margin-top: -23px;
      margin-left: 10px;
    }

    .typeFont h2 {
      font-size: 24px;
    }
  }

  @media (min-width: 768px) and (max-width: 991px) {

    .tab-content-header-box .nav-item {
      width: auto;
    }
  }
</style>

<body>
    <!--  page header start -->
    <?php include('common/header.php'); ?>
    <!--  page end start -->

    <!--  page content start -->
    <?php include('content/service_details.php'); ?>
    <!--  page content end -->

    <!--  page footer start -->
    <?php include('common/footer.php'); ?>
    <!--  page footer end -->
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
    $(".addtocart").on("click",function(e){
        // alert('hii');
         e.preventDefault();

        var _id=$(this).data("id");
        // var _quantity = $("#quant").val();
        
        // alert(_id);
        // alert(_quantity);
         $.ajax({
        url  : "public/add_cart_service.php",
        type : "POST",
        cache: true,
        data : {service_id:_id},
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
  $(document).ready(function(){
    $(".qty_plus").on("click",function(e){
        // alert('hii');
         e.preventDefault();

        var _id=$(this).data("id");
        var _quantity = $("#quant").val();
        
        // alert(_id);
        // alert(_quantity);
         $.ajax({
        url  : "public/add_cart_service_plus.php",
        type : "POST",
        cache: true,
        data : {service_id:_id,quantity:_quantity},
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
  $(document).ready(function(){
    $(".qty_minus").on("click",function(e){
        // alert('hii');
         e.preventDefault();

        var _id=$(this).data("id");
        var _quantity = $("#quant").val();
        
        // alert(_id);
        // alert(_quantity);
         $.ajax({
        url  : "public/add_cart_service_minus.php",
        type : "POST",
        cache: true,
        data : {service_id:_id,quantity:_quantity},
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

<script>
  $(document).ready(function() {
    $('.slider').slick({
      dots: true,
    });
  });
</script>

<script>
  const overlay = document.querySelector(".overlay");
  const body = document.querySelector("body");
  const menuBtn = document.querySelector(".menu-btn");
  const menuItems = document.querySelector(".menu-items");
  const expandBtn = document.querySelectorAll(".expand-btn");

  function toggle() {
    // disable overflow body
    body.classList.toggle("overflow");
    // dark background
    overlay.classList.toggle("overlay--active");
    // add open class
    menuBtn.classList.toggle("open");
    menuItems.classList.toggle("open");
  }

  menuBtn.addEventListener("click", (e) => {
    e.stopPropagation();
    toggle();
  });

  window.onkeydown = function(event) {
    const key = event.key; // const {key} = event; in ES6+
    const active = menuItems.classList.contains("open");
    if (key === "Escape" && active) {
      toggle();
    }
  };

  document.addEventListener("click", (e) => {
    let target = e.target,
      its_menu = target === menuItems || menuItems.contains(target),
      its_hamburger = target === menuBtn,
      menu_is_active = menuItems.classList.contains("open");
    if (!its_menu && !its_hamburger && menu_is_active) {
      toggle();
    }
  });

  // mobile menu expand
  expandBtn.forEach((btn) => {
    btn.addEventListener("click", () => {
      btn.classList.toggle("open");
    });
  });
</script>
<script>
  $(".fontWrapper .navbar .nav .nav-link").click(function(event) {
    event.preventDefault();
    var href1 = $(this).attr("href");

    let $parentDiv = $(".scrollspy-example");
    let $innerListItem = $(href1);
    // Scroll to the center
    $parentDiv.scrollTop(
      $parentDiv.scrollTop() +
      $innerListItem.position().top -
      $parentDiv.height() / 2 +
      $innerListItem.height() / 2 +
      80
    );
  });
</script>



<!-- faq-service script-->
<script>
  var acc = document.getElementsByClassName('faqs-title');
  var i;

  for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener('click', function() {
      this.classList.toggle('active');
      var panel = this.nextElementSibling;
      if (panel.style.maxHeight) {
        panel.style.maxHeight = null;
      } else {
        panel.style.maxHeight = panel.scrollHeight + 'px';
      }
    });
  }
</script>


<!-- conuter btn -->
<script>
  $('.btn-number').click(function(e) {
    e.preventDefault();

    fieldName = $(this).attr('data-field');
    type = $(this).attr('data-type');
    var input = $("input[name='" + fieldName + "']");
    var currentVal = parseInt(input.val());
    if (!isNaN(currentVal)) {
      if (type == 'minus') {

        if (currentVal > input.attr('min')) {
          input.val(currentVal - 1).change();
        }
        if (parseInt(input.val()) == input.attr('min')) {
          $(this).attr('disabled', true);
        }

      } else if (type == 'plus') {

        if (currentVal < input.attr('max')) {
          input.val(currentVal + 1).change();
        }
        if (parseInt(input.val()) == input.attr('max')) {
          $(this).attr('disabled', true);
        }

      }
    } else {
      input.val(0);
    }
  });
  $('.input-number').focusin(function() {
    $(this).data('oldValue', $(this).val());
  });
  $('.input-number').change(function() {

    minValue = parseInt($(this).attr('min'));
    maxValue = parseInt($(this).attr('max'));
    valueCurrent = parseInt($(this).val());

    name = $(this).attr('name');
    if (valueCurrent >= minValue) {
      $(".btn-number[data-type='minus'][data-field='" + name + "']").removeAttr('disabled')
    } else {
      alert('Sorry, the minimum value was reached');
      $(this).val($(this).data('oldValue'));
    }
    if (valueCurrent <= maxValue) {
      $(".btn-number[data-type='plus'][data-field='" + name + "']").removeAttr('disabled')
    } else {
      alert('Sorry, the maximum value was reached');
      $(this).val($(this).data('oldValue'));
    }


  });
  $(".input-number").keydown(function(e) {
    // Allow: backspace, delete, tab, escape, enter and .
    if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
      // Allow: Ctrl+A
      (e.keyCode == 65 && e.ctrlKey === true) ||
      // Allow: home, end, left, right
      (e.keyCode >= 35 && e.keyCode <= 39)) {
      // let it happen, don't do anything
      return;
    }
    // Ensure that it is a number and stop the keypress
    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
      e.preventDefault();
    }
  });
</script>


<script>
  $('.btn-number-1').click(function(e) {
    e.preventDefault();

    fieldName = $(this).attr('data-field');
    type = $(this).attr('data-type');
    var input = $("input[name='" + fieldName + "']");
    var currentVal = parseInt(input.val());
    if (!isNaN(currentVal)) {
      if (type == 'minus') {

        if (currentVal > input.attr('min')) {
          input.val(currentVal - 1).change();
        }
        if (parseInt(input.val()) == input.attr('min')) {
          $(this).attr('disabled', true);
        }

      } else if (type == 'plus') {

        if (currentVal < input.attr('max')) {
          input.val(currentVal + 1).change();
        }
        if (parseInt(input.val()) == input.attr('max')) {
          $(this).attr('disabled', true);
        }

      }
    } else {
      input.val(0);
    }
  });
  $('.input-number-1').focusin(function() {
    $(this).data('oldValue', $(this).val());
  });
  $('.input-number-1').change(function() {

    minValue = parseInt($(this).attr('min'));
    maxValue = parseInt($(this).attr('max'));
    valueCurrent = parseInt($(this).val());

    name = $(this).attr('name');
    if (valueCurrent >= minValue) {
      $(".btn-number-1[data-type='minus'][data-field='" + name + "']").removeAttr('disabled')
    } else {
      alert('Sorry, the minimum value was reached');
      $(this).val($(this).data('oldValue'));
    }
    if (valueCurrent <= maxValue) {
      $(".btn-number-1[data-type='plus'][data-field='" + name + "']").removeAttr('disabled')
    } else {
      alert('Sorry, the maximum value was reached');
      $(this).val($(this).data('oldValue'));
    }


  });
  $(".input-number-1").keydown(function(e) {
    // Allow: backspace, delete, tab, escape, enter and .
    if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
      // Allow: Ctrl+A
      (e.keyCode == 65 && e.ctrlKey === true) ||
      // Allow: home, end, left, right
      (e.keyCode >= 35 && e.keyCode <= 39)) {
      // let it happen, don't do anything
      return;
    }
    // Ensure that it is a number and stop the keypress
    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
      e.preventDefault();
    }
  });
</script>


  

</html>