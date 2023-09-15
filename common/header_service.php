<?php
include('./inc/config.php');
//session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<body>

  <header class="navbar sticky" style="position: sticky;">
    <a href="index.php" class="logo">
     <img src="images/logo-header.svg" alt="">
    </a>
    <div class="menu-btn">
      <div class="menu-btn__lines">
      </div>
    </div>
    <div class="header-counter-text-2">
      <span class="counter-header"><?php if(isset($_SESSION['user_id'])){getCountWhere($con,'cart',"WHERE user_id='".$_SESSION['user_id']."'"); }else { echo '0'; } ?></span>
      <div class=" header-cart"><a href="cart.php"><img src="images/h1.png" alt=""> <span style="    font-size: 16px;
    font-weight: 500;
    color: #670099">Cart</span></a> </div>
    </div>
    <div class="top-header-dropdown">
      <ul>
        <li><img src="images/drop.png" alt=""></li>
        <!--<li><span></span></li>-->

        <li><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
             <?php if(isset($_SESSION['city_name'])){ echo $_SESSION['city_name']; }?>
                 <img src="images/icon-5.png" alt="" class="service-select-icon">
          </button></li>
            
          
      
        <!-- <li>  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal-1">
                Ahmedabad
                 </button></li> -->
        <!--<li><i class="fa fa-caret-down"></i></li>-->
      </ul>

      <div class="form-group has-search">
        <form id='searchForm' name='searchForm' method='POST'>
                <!-- <span class="fa fa-search form-control-feedback"></span> -->
            <input type="text" class="form-control" placeholder="Search Services..." name='search_item' value='<?php if(isset($_GET['text'])){ echo $_GET['text']; } ?>'  id='search_item' required>
            <a class="searchButton" id="searchButton"><i class="fas fa-search search-icon" ></i></a>
        </form>      
      </div>
    </div>

    <div class="header-mobile">
      <ul class="menu-items">
        <li><a href="./index.php" class="logo-2"><img src="images/ym-logo-round.webp" alt=""></a></li>
        
        <!--<li><a href="./index.php" class="menu-item first-item"> Hello <?php if(isset($_SESSION['user_id'])){echo $_SESSION['user_name']; }else{echo 'User';} ?> </a></li>-->
         <?php if(isset($_SESSION['user_id'])){ ?>
        <li><a href="./index.php" class="menu-item first-item"> <?php if(isset($_SESSION['user_id'])){echo 'Hello '.$_SESSION['user_name']; }else{echo 'Login / Register';} ?> </a></li>
        <?php }else{ ?>
        <li><a href="./register.php" class="menu-item first-item"> Login / Register </a></li>
        <?php } ?>
                
        <li><a href="./index.php"><i class="fas fa-home" ></i> <span>Home</span></a>  </li>
        <li> <a href="./blog.php"><img src="images/mobile_viewer/blog.webp" alt=""> <span>Blog</span>  </a></li>
        <li> <a href="./my_appointment.php"><i class="fas fa-envelope"></i> <span>My appointment</span> </a></li>
        <li> <a href="./my_address.php"><i class="fas fa-map-marker-alt"></i> <span>My Address</span> </a></li>
        <li> <a href="./my_profile.php"><i class="fas fa-user"></i> <span>My Profile</span> </a></li>
        <li> <a href="./my_wallet.php"> <i class="fas fa-wallet"></i> <span> Bonitaa Wallet </span></a> </li>
        <li> <a href="./franchise.php"> <img src="images/mobile_viewer/french.webp" alt=""> <span> Franchisee </span> </a> </li>
        <li> <a href="./my_notification.php"><img src="images/website_icon/profile_wallet.png" alt="">  <span> Notification </span></a> </li>
        <!--<li> <a href="./logout.php"> <i class="fas fa-sign-out-alt"></i><span> Logout </span> </a> </li>-->
        <li> <?php
                if(isset($_SESSION['user_id']))
                {?>
                    <a href="./logout.php"><i class="fas fa-sign-out-alt"></i><span> Logout </span> </a>
                <?php }else{ ?>
                    <a href="./register.php"><i class="fas fa-sign-out-alt"></i><span>  Login / Register </span> </a>
                <?php } ?> </li>
              

    </div>

    <ul class="menu-items">

       <?php if(isset($_SESSION['user_id'])){ ?>
            <li><a href="./index.php" class="menu-item first-item"> <?php if(isset($_SESSION['user_id'])){echo 'Hello '.$_SESSION['user_name']; }else{echo 'Login / Register';} ?> </a></li>
            <?php }else{ ?>
            <li><a href="./register.php" class="menu-item first-item"> Login / Register </a></li>
            <?php } ?>

      <div class="navbar-categary-box">
        <div class="dropdown" style="float:right;">
          <button class="dropbtn">
            <img src="images/h1.png" alt="">
          </button>
          <div class="dropdown-content">
            <a href="./blog.php">Blog</a>
            <a href="./my_appointment.php">My appointment</a>
            <a href="./my_address.php">My Address</a>
            <a href="./my_profile.php">My Profile</a>
            <a href="./my_wallet.php">Bonitaa Wallet </a>
            <a href="./franchise.php">Franchisee</a>
            <a href="./my_notification.php">Notification</a>
            <?php
            if(isset($_SESSION['user_id']))
            {?>
                <a href="./logout.php">Logout</a>
            <?php }else{ ?>
                <a href="./register.php"> Login / Register</a>
            <?php } ?>


          </div>
        </div>
      </div>

      <div class="header-counter-text">
        <span class="counter-header"><?php if(isset($_SESSION['user_id'])){getCountWhere($con,'cart',"WHERE user_id='".$_SESSION['user_id']."'"); }else { echo '0'; } ?></span>
        <div class=" header-cart">
          <a href="./cart.php"><img src="images/c1.png" alt=""> <span style="font-size: 16px;font-weight: 500;color: #670099;">Cart</span></a> 
        </div>
      </div>
    </ul>

  </header>


  <!-- Modal -->

  <div class="top-model-header-popup">
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title text-center" id="exampleModalLabel">Select Your City</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <P class="text-center">Current City Available</P>

            <div class="header-category-tabs">

               <?php
                $query_city="SELECT *,c.ID as cityid,c.status as citystatus,c.name as cityname,s.name as statename,s.ID as stateid,s.status as statestatus FROM `city` c
                LEFT JOIN state s ON s.ID = c.state_id
                ORDER BY c.ID DESC";
        
                $sql_city = mysqli_query($con,$query_city)or die(mysqli_error());
        
        
                while($data_city = mysqli_fetch_assoc($sql_city))
                { 
                    if(isset($_SESSION['city_id']))
                    {
                        if($data_city['cityid'] == $_SESSION['city_id'])
                        {
                            $active_class = 'active';
                        }else{
                            $active_class = '';
                        }  
                    }
                   
                ?>
                       
  <button class="tablink selectCity <?php echo $active_class; ?>" data-id="<?php echo $data_city['cityid']; ?>"><?php echo $data_city['cityname']; ?></button>    
                <?php } ?>
             

            </div>
          </div>

        </div>
      </div>
    </div>
  </div>


  <div class="overlay"></div>
  <script src="script.js"></script>
</body>

<!-- tabs popup script -->
<script>
  function openCity(cityName, elmnt, color) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablink");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].style.backgroundColor = "";
    }
    document.getElementById(cityName).style.display = "block";
    elmnt.style.backgroundColor = color;

  }
  // Get the element with id="defaultOpen" and click on it
  document.getElementById("defaultOpen").click();
</script>
<!--tabs popup script close  -->
<script src="js/jquery.min.js"></script>
<script src="js/wow.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/owl.carousel.js"></script>
<script type="text/javascript" src="js/stellarnav.min.js"></script>
<!-- <script src="plugins/jQuery/jquery.min.js"></script> -->
<script src="plugins/slick/slick.min.js"></script>
<script src="plugins/slick/slick-animation.min.js"></script>
<!-- navbar-header -->

<!-- home slider -->
<script>
  $(document).ready(function () {
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

  window.onkeydown = function (event) {
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
<!-- my tabs Script -->

</html>