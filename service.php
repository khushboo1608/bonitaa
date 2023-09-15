<?php session_start(); ?>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bonitaa</title>
   
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
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
  <link href="https://www.cssscript.com/wp-includes/css/sticky.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css">
  <!-- <link rel="stylesheet" href="https://unpkg.com/tailwindcss@1.4.6/dist/tailwind.min.css"> -->
  <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.3.5/dist/alpine.min.js" defer></script>
  <!-- <link rel="stylesheet" href="css/custom.css"> -->
 <!-- <link rel="stylesheet" href="css/style.css">   -->
   <!-- <link rel="stylesheet" href="css/responsive.css"> -->
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

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>



		 <style>
       .has-search .search-icon{
         color: #212529;
       }
       .form-control{
          border-radius: 0.25rem;
       }
			 @media screen and (max-width: 61.938em){
.top-header-dropdown {
     display: block !important; 
}
.navbar {
    padding:20px !important;
	height: 275px !important;
}
.navbar .logo img{
width: 190px;
    margin-top: -26px !important;
}
.header-cart {
	margin-left: 20px;
}
.header-counter-text-2 .counter-header {
	margin-left: 34px;
	position: relative;
}
.menu-btn{
	margin-top: 5px;
}

.header-counter-text-2{
    margin-top: -20px;
    float: right;
    display: block !important;
    top: 20px !important;
			 }
    .header-counter-text-2{
      margin-top: -30px;
      float: right;
      margin-left: 0px !important;
    }
			}
		 </style>

</head>

<body class="font-sans antialiased">
<?php include('common/header.php'); ?>
  <div class="overflow-body">
  <?php include('content/service_details.php'); 
//   SERVER

  //$uriSegments = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
//print_r($uriSegments);

 // echo "<br/>";
  
  //$url = 'http://codeocean.co.in/app/bonitaa/service.php?category=9&sub_category=20#Hair%20Spa';
                                           // print_r(parse_url($url, PHP_URL_FRAGMENT));
                               
   ?>
  
  <?php include('common/footer.php'); ?>
  
    </div>
</body>
 <!-- scroll tabs -->
<script src="dist/scrollspy.min.js"></script>
<script>
  window.onload = function() {
    scrollSpy('nav', {
      sectionSelector: 'section',
      targetSelector: 'a',
      offset: 50,
      activeClass: 'text-gray-100 bg-gray-900 shadow-inner',
    });
  };
</script>

 <!-- scroll tabs -->
<script>
  try {
    fetch(new Request("https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js", {
      method: 'HEAD',
      mode: 'no-cors'
    })).then(function(response) {
      return true;
    }).catch(function(e) {
      var carbonScript = document.createElement("script");
      carbonScript.src = "//cdn.carbonads.com/carbon.js?serve=CE7DC2JW&placement=wwwcssscriptcom";
      carbonScript.id = "_carbonads_js";
      document.getElementById("carbon-block").appendChild(carbonScript);
    });
  } catch (error) {
    console.log(error);
  }
</script>
<script>
  (function(i, s, o, g, r, a, m) {
    i['GoogleAnalyticsObject'] = r;
    i[r] = i[r] || function() {
      (i[r].q = i[r].q || []).push(arguments)
    }, i[r].l = 1 * new Date();
    a = s.createElement(o),
      m = s.getElementsByTagName(o)[0];
    a.async = 1;
    a.src = g;
    m.parentNode.insertBefore(a, m)
  })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

  ga('create', 'UA-46156385-1', 'cssscript.com');
  ga('send', 'pageview');
</script>
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
    $(".addtocart").one("click",function(e){
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
    $(".qty_plus").one("click",function(e){
        // alert('hii');
         e.preventDefault();

        var _id=$(this).data("id");
        var _quantity = $("#quant_"+_id);
        var quantity1 = _quantity.val();
        
        // alert(_id);
        // alert(_quantity);
         $.ajax({
        url  : "public/add_cart_service_plus.php",
        type : "POST",
        cache: true,
        data : {service_id:_id,quantity:quantity1},
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
    $(".qty_minus").one("click",function(e){
        // alert('hii');
         e.preventDefault();

        var _id=$(this).data("id");
        var _quantity = $("#quant_"+_id);
        var quantity1 = _quantity.val();
        
        // alert(_id);
        // alert(_quantity);
         $.ajax({
        url  : "public/add_cart_service_minus.php",
        type : "POST",
        cache: true,
        data : {service_id:_id,quantity:quantity1},
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

<script>
document.getElementById("demo").innerHTML = 
"The full URL of this page is:<br>" + window.location.hash;

</script>

</html>