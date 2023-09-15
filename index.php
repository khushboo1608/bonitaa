<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="css/sweetalert/sweetalert.css">
    <!-- new category slider code -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simplebar@latest/dist/simplebar.css"/>
</head>

		 <style>
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
    /* position: absolute !important; */
    /* margin-right: 8px; */
    display: block !important;
    /* left: 257px !important; */
    top: 20px !important;
			 }
			 .header-counter-text-2{
			    margin-top: -30px;
    float: right;
    margin-left: 0px !important;
			 }
			}



			/* tabs */
			@media (min-width: 768px) and (max-width: 991px) {
			}
		 </style>
	 </head>
<body>
    <!-- home page header start -->
	<?php include('common/header.php'); ?>
	<!-- home page end start -->
	
	<!-- home page header start -->
	<?php include('common/slider.php'); ?>
	<!-- home page slider End -->

	<!-- home page Content start -->
	<?php //echo 'Names:-'; echo $_SESSION['city_name']; echo $_SESSION['state_name']; ?>

	<?php include('content/home.php'); ?>
	<!-- home page Content End -->

	<!-- footer Section -->

	<?php
	include('common/footer.php')
	?>

	<div class="beauty-icon">
		<a target="_blank" href="https://api.whatsapp.com/send?phone=6397695174"><img src="images/service-details/whtsapp1.png" alt=""></a>
	</div>
	<a id="scrollUp" href="#top" style="position: fixed; z-index: 2147483647;"><i class="fi-rs-arrow-small-up"></i></a>
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
  
<!-- navbar-header -->

<!-- home slider -->
<script>
	$(document).ready(function() {
		$('.slider').slick({
			dots: true,
		});
	});
</script>

<!-- categary slider  -->
<script>
	// home page banner script
	$(".client-testimonials2 .owl-carousel").owlCarousel({
		loop: true,
		margin: 10,
		responsiveClass: true,
		autoplay: true,
		smartSpeed: 700,
		navText: ['<i class="fa fa-chevron-left active" aria-hidden="true"></i>', '<i class="fa fa-chevron-right " aria-hidden="true"></i>'],
		autoplayTimeout: 3000,
		autoplayHoverPause: true,
		dots: true,
		navigation: true,
		responsive: {
			0: {
				items: 3,
				nav: true,
			},
			600: {
				items: 4,
				nav: true,
			},
			1000: {
				items: 8,
				nav: true,
				loop: true,
			},
		},
	});
</script>

<!-- home a -->
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


<!-- categary slider -->

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
 $(".client-testimonials-3 .owl-carousel").owlCarousel({
        loop: true,
        margin: 10,
        slidesToShow: 3,
        slidesToScroll: 1,
        responsiveClass: true,
        autoplay: true,
        smartSpeed: 700,
        navText: ['<i class="fa fa-chevron-left active" aria-hidden="true"></i>', 
        '<i class="fa fa-chevron-right " aria-hidden="true"></i>'],
        autoplayTimeout: 3000,
        autoplayHoverPause: true,
        dots: false,
        navigation: true,
        responsive: {
            0: {
              slidesToShow: 1,
              slidesToScroll: 1,
                items: 1,
                nav: true,
            },
            600: {
                    slidesToShow: 2,
              slidesToScroll: 1,
                items: 2,
                nav: true,
            },
            1000: {
                items: 3,
                nav: true,
                // loop: true,
            },
        },
    });
</script>


<script>
 $(".client-testimonials-4 .owl-carousel").owlCarousel({
         loop: true,
        margin: 10,
        slidesToShow: 3,
        slidesToScroll: 1,
        responsiveClass: true,
        autoplay: true,
        smartSpeed: 700,
        navText: ['<i class="fa fa-chevron-left active" aria-hidden="true"></i>', 
        '<i class="fa fa-chevron-right " aria-hidden="true"></i>'],
        autoplayTimeout: 3000,
        autoplayHoverPause: true,
        dots: false,
        navigation: true,
        responsive: {
            0: {
              slidesToShow: 1,
              slidesToScroll: 1,
                items: 1,
                nav: true,
            },
            600: {
                    slidesToShow: 2,
              slidesToScroll: 1,
                items: 2,
                nav: true,
            },
            1000: {
                           slidesToShow: 2,
              slidesToScroll: 1,
                items: 3,
                nav: true,
                // loop: true,
            },
        },
    });
</script>

<script>
 $(".client-testimonials-5 .owl-carousel").owlCarousel({
        loop: true,
        margin: 10,
        slidesToShow: 3,
        slidesToScroll: 1,
        responsiveClass: true,
        autoplay: true,
        smartSpeed: 700,
        navText: ['<i class="fa fa-chevron-left active" aria-hidden="true"></i>', 
        '<i class="fa fa-chevron-right " aria-hidden="true"></i>'],
        autoplayTimeout: 3000,
        autoplayHoverPause: true,
        dots: false,
        navigation: true,
        responsive: {
            0: {
              slidesToShow: 1,
              slidesToScroll: 1,
                items: 1,
                nav: true,
            },
            600: {
                    slidesToShow: 2,
              slidesToScroll: 1,
                items: 2,
                nav: true,
            },
            1000: {
                          slidesToShow: 3,
              slidesToScroll: 1,
                items: 3,
                nav: true,
                // loop: true,
            },
        },
    });
</script>
 <!-- category Videos -slider -->
  <script> 
 $('.slider-box').slick({
	dots: false,
	arrows: true,
	slidesToShow: 3,
  slidesToScroll: 1,
  prevArrow: '<button class="slide-arrow prev-arrow"><i class="fas fa-chevron-left"></i></button>',
    nextArrow: '<button class="slide-arrow next-arrow"><i class="fas fa-chevron-right"></i></button>',
	draggable: true,
	touchMove: true,
    responsive: [
      {
        breakpoint: 991,
        settings: {
          slidesToShow: 2,
        }
      },
      {
        breakpoint: 767,
        settings: {
          slidesToShow: 1,
        }
      }
    ]
});
</script>
</html>