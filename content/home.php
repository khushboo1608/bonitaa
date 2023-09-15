<div class="categary-slider-boxses">
  <div class="container" style="margin-top: 50px;">
    <div class="row">
      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
        <h2>Your Personal Salon At Home</span> </h2>
        <img src="images/line.png" alt="" class="line-img">

        <div class="main-category-box">
          <div class="row">
            <?php
            $query_category = "SELECT *,c.category as cname,c.pic as cimage,c.ID as cid FROM category c
                        where c.status = 1
                        ORDER BY c.sort ASC";
            $sql_category = mysqli_query($con, $query_category) or die(mysqli_error());
            while ($data_category = mysqli_fetch_assoc($sql_category)) {
              if (!empty($data_category['cimage'])) {
                $image = UPLOAD_PATH . 'category/' . $data_category['cimage'];
              } else {
                $image = '';
              }
              ?>
              <div class="col-xl-2 col-lg-2  col-6  col-md-3">
                <div class="custom-box">
                    <a href="sub_category.php?category=<?php echo $data_category['cid']; ?>">
                        <img src="<?php echo $image; ?>" alt="">
                        <p>
                            <?php echo $data_category['cname']; ?>
                        </p>
                    </a>
                </div>
              </div>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- home slider category  1-->
<div class="Home-category-page-slider">
  <div class="container" style="margin-top:0px;">
    <h2 style="margin-top:0px;">Videos</h2>
    <img src="images/line.png" alt="" class="line-img">
    <div class="slider-box">
      <?php
      $query_videos = "SELECT * FROM video v
		where v.status = 1
		ORDER BY v.ID DESC";
      $sql_videos = mysqli_query($con, $query_videos) or die(mysqli_error());
      while ($data_videos = mysqli_fetch_assoc($sql_videos)) {
        if (!empty($data_videos['image'])) {
          $image = UPLOAD_PATH . 'videos/' . $data_videos['image'];
        } else {
          $image = '';
        }
        $url =  $data_videos['url'];
        ?>
        <div>
          <a href="<?php echo $url; ?>" target="_blank">
            <img src="<?php echo $image; ?>" alt="">
          </a>
        </div>
      <?php } ?>
    </div>
  </div>
</div>




<!-- home slider category 2-->
<div class="Home-category-page-slider">
  <div class="container" style="margin-top:0px;">
    <h2>Offers</h2>
    <img src="images/line.png" alt="" class="line-img">
    <div class="slider-box">
      <?php
      $query_offers = "SELECT *,o.ID as offerid,o.status as offerstatus,o.title as offername,o.click as offerclick,o.pic as offerimage,c.category as category_name,subcat.subcategory as sub_name,subsubcat.subsubcategory_name as subsubsubname FROM `offers` o
	LEFT JOIN category c ON c.ID = o.category_id
	LEFT JOIN subcategory subcat ON subcat.ID = o.subcategory_id
	LEFT JOIN subsubcategory subsubcat ON subsubcat.ID = o.subsubcategory_id
	WHERE o.type = '1' and o.hide = 0
	ORDER BY o.sort ASC";

      $sql_offers = mysqli_query($con, $query_offers) or die(mysqli_error());


      while ($data_offers = mysqli_fetch_assoc($sql_offers)) {


        if (!empty($data_offers['offerimage'])) {
          $image = UPLOAD_PATH . 'offers/' . $data_offers['offerimage'];
        } else {
          $image = '';
        }
        ?>

        <div>
          <?php if ($data_offers['click'] == 1) { ?>
            <a
              href="service.php?category=<?php echo $data_offers['category_id']; ?>&sub_category=<?php echo $data_offers['subcategory_id']; ?>">
            <?php } else if ($data_offers['click'] == 0) { ?>
                <a href="#">
              <?php } ?>
              <img src="<?php echo $image; ?>" alt="">
            </a>
        </div>
      <?php } ?>
    </div>
  </div>
</div>




<!-- <div class="Home-category-page-slider-3"> -->

<div class="Home-category-page-slider">
  <div class="container" style="margin-top:0px;">
    <h2 class="category-deals">Hot Deals</h2>
    <img src="images/line.png" alt="" class="line-img">
    <div class="slider-box">
      <?php
      $query_offers = "SELECT *,o.ID as offerid,o.status as offerstatus,o.title as offername,o.click as offerclick,o.pic as offerimage,c.category as category_name,subcat.subcategory as sub_name,subsubcat.subsubcategory_name as subsubsubname FROM `offers` o
	LEFT JOIN category c ON c.ID = o.category_id
	LEFT JOIN subcategory subcat ON subcat.ID = o.subcategory_id
	LEFT JOIN subsubcategory subsubcat ON subsubcat.ID = o.subsubcategory_id
	WHERE o.type = '2' and o.hide = 0
	ORDER BY o.sort ASC";

      $sql_offers = mysqli_query($con, $query_offers) or die(mysqli_error());


      while ($data_offers = mysqli_fetch_assoc($sql_offers)) {


        if (!empty($data_offers['offerimage'])) {
          $image = UPLOAD_PATH . 'offers/' . $data_offers['offerimage'];
        } else {
          $image = '';
        }

        ?>

        <div>
          <?php if ($data_offers['click'] == 1) { ?>
            <a
              href="service.php?category=<?php echo $data_offers['category_id']; ?>&sub_category=<?php echo $data_offers['subcategory_id']; ?>">
            <?php } else if ($data_offers['click'] == 0) { ?>
                <a href="#">
              <?php } ?>
              <img src="<?php echo $image; ?>" alt="">
            </a>

        </div>
      <?php } ?>
    </div>
  </div>
</div>






<div class="why-choos-section">
  <div class="container" style="margin-top:50px;">
    <h2>Our New Launch</h2>
    <img src="images/line.png" alt="" class="line-img">
    <div class="row">
      <?php
      //  $query_launch_offers="SELECT *,n.ID as offerid,n.status as newlunchstatus,n.title as newlunchname,n.click as newlunchclick,n.pic as newlunchimage,c.category as category_name,subcat.subcategory as sub_name,subsubcat.subsubcategory_name as subsubsubname FROM `new_lunch` n
      // 		LEFT JOIN category c ON c.ID = n.category_id
      // 		LEFT JOIN subcategory subcat ON subcat.ID = n.subcategory_id
      // 		LEFT JOIN subsubcategory subsubcat ON subsubcat.ID = n.subsubcategory_id
      // 		WHERE n.hide = 0
      // 		ORDER BY n.sort ASC";
      
      // 		$sql_launch_offers = mysqli_query($con,$query_launch_offers)or die(mysqli_error());
      

      // 		while($data_launch_offers = mysqli_fetch_assoc($sql_launch_offers))
      // 		{	
      
      //   	if(!empty($data_launch_offers['newlunchimage'])){
      $image_service = UPLOAD_PATH . 'new_lunch_offers/newlunchoffers-230220155846.png';
      //   	}else{
      //   	    $image='';
      //   	}
      
      $image_city = UPLOAD_PATH . 'new_lunch_offers/newlunchoffers-230425104534.png';

      $image_best_service = UPLOAD_PATH . 'new_lunch_offers/newlunchoffers-230220171134.png';

      ?>
      <div class="col-xl-12 col-sm-`12 col-md-12 col-lg-12">
        <div class="why-choosh-box">
          <a href="service.php?category=10&sub_category=25">
            <!--<a href="#">-->
            <img src="<?php echo $image_service; ?>" alt="">
          </a>
        </div>
      </div>

      <div class="col-xl-12 col-sm-`12 col-md-12 col-lg-12">
        <div class="why-choosh-box">
          <a href="#">
            <img src="<?php echo $image_city; ?>" alt="">
          </a>
        </div>
      </div>

      <div class="col-xl-12 col-sm-`12 col-md-12 col-lg-12">
        <div class="why-choosh-box">
          <a href="#">
            <img src="<?php echo $image_best_service; ?>" alt="">
          </a>
        </div>
      </div>

      <?php //} ?>
    </div>
  </div>
</div>

<!--covid-19-->
<!--<div class="why-choos-section">-->
<!--	<div class="container" style="margin-top:0px;">-->
<!--<h2>Our New Launch</h2>-->
<!--<img src="images/line.png" alt="" class="line-img">-->
<!--		<div class="row">-->

<!--			<div class="col-xl-12 col-sm-`12 col-md-6 col-lg-12">-->
<!--				<div class="why-choosh-box">-->
<!--					    <img src="<?php echo UPLOAD_PATH . 'image_2023_02_21T06_17_04_675Z.png'; ?>" alt="">-->
<!--					</a>-->
<!--				</div>-->
<!--			</div>-->
<!--		</div>-->
<!--	</div>-->
<!--</div>-->



<!-- Why Choose Bonitaa -->
<div class="why-choos-section">
  <div class="container" style="margin-top:0px;">
    <h2>Why Choose <span>Bonitaa</span></h2>
    <img src="images/line.png" alt="" class="line-img">
    <div class="row">
      <div class="col-xl-4 col-sm-12 col-md-4">
        <div class="why-choosh-box">
            <?php  $image1 = UPLOAD_PATH . '/woman.png'; ?>
          <img src="<?php echo $image1; ?>" alt="">
          <!--<h4>Trained and Verified Experts</h4>-->
          <!--<p><strong>Breaking Barriers, Building Bridges  for Women</strong></p>-->
        </div>
      </div>

      <div class="col-xl-4 col-sm-12 col-md-4">
        <div class="why-choosh-box">
             <?php  $image2 = UPLOAD_PATH . '/indian.png'; ?>
          <img src="<?php echo $image2; ?>" alt="">
          <!--<h4>Genuine and Sealed Products</h4>-->
          <!--<p><strong>Truly Indian,-->
             <!--Truly Yours</strong>-->
          <!--</p>-->
        </div>
      </div>


      <div class="col-xl-4 col-sm-12 col-md-4">
        <div class="why-choosh-box">
             <?php  $image3 = UPLOAD_PATH . '/price.png'; ?>
          <img src="<?php echo $image3; ?>" alt="">
          <!--<h4>Transparent and Affordable Prices</h4>-->
          <!--<p><strong>Price Transparency, Product Integrity</strong>-->
          <!--</p>-->
        </div>
      </div>
    </div>
  </div>
</div>


<div class="bonitaa-safer-brand">
  <div class="container" style="margin-top: 0px;">
    <h2> <img src="images/line  (3).png" alt=""> Bonitaa Safety Standards</h2>

    <div class="row">
      <div class="col-xl-3 col-sm-6 col-md-4 col-lg-3">
        <div class="safer-brand-box">
          <?php  $image4 = UPLOAD_PATH . '/image_6.png'; ?>
          <img src="<?php echo $image4; ?>" alt="">
          <p>Sanitized kits And tools </p>
        </div>
      </div>

      <div class="col-xl-3 col-sm-6 col-md-4 col-lg-3">
        <div class="safer-brand-box">
            <?php  $image5 = UPLOAD_PATH . '/image_7.png'; ?>
          <img src="<?php echo $image5; ?>" alt="">
          <p>Wearing Mask </p>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 col-md-4 col-lg-3">
        <div class="safer-brand-box">
            <?php  $image6 = UPLOAD_PATH . '/image_8.png'; ?>
          <img src="<?php echo $image6; ?>" alt="">
          <p>Vaccinated Professional</p>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 col-md-4 col-lg-3">
        <div class="safer-brand-box">
            <?php  $image7 = UPLOAD_PATH . '/image_9.png'; ?>
          <img src="<?php echo $image7; ?>" alt="">
          <p>Low Contact</p>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- safe hygienic  -->
<!--<div class="safe-full-img">-->
<!--  <div class="container" style="margin-top: 50px; margin-bottom:50px;">-->
<!--    <div class="row">-->
<!--      <div class="col-xl-12 col-lg-12">-->
<!--        <img src="images/safe-img.webp" alt="">-->
<!--      </div>-->
<!--    </div>-->
<!--  </div>-->
<!--</div>-->
<!-- Download via sms -->
<div class="download-sms-section">
  <div class="container">
    <div class="row">
      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
        <div class="download-main-section">
          <div class="row align-items-center">
            <div class="col-xl-6 col-lg-6 col-sm-12 col-md-12">
              <div class="download-content-section">
                <h2>Download Apps</h2>
                <p>For Better Customer Experiance And Satisfaction. Download Our Mobile  Apps</p>
                <div class="download-img-section d-lg-none d-block">
                <img src="images/footer-mobile.png" alt="">
              </div>
                <!--<form action="/action_page.php">-->


                  <!--<div class="input-group mb-3">-->
                  <!--  <span>+91</span>-->
                  <!--  <input type="text" class="form-control" placeholder="Your Mobile Number" name="email">-->
                  <!--  <button class="input-group-text">SEND</button>-->
                  <!--</div>-->
                <!--</form>-->

                <div class="google-img-box">
                  <a class="google-play-link" href='https://play.google.com/store/apps/details?id=com.salonathome.bonitaabeauty' target="_blank"><img src="images/google-play.svg" alt=""></a>
                  <a class="google-play-link" href='' target="_blank"><img src="images/app-store.svg" alt=""></a>
                </div>
              </div>
            </div>

            <div class="col-xl-6 col-lg-6 col-sm-12 col-md-12 d-lg-block d-none">
              <div class="download-img-section">
                <img src="images/footer-mobile.png" alt="">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Faq Section -->
<!--<div class="faq-section">-->
<!--  <div class="container" style="margin-top: 50px; margin-bottom:30px;">-->
<!--    <div class="row">-->
<!--      <div class="col-xl-6 col-lg-6 col-sm-12 col-md-12">-->
<!--        <main>-->
<!--          <div class="faqs-grid">-->

<!--            <div class="faqs-item ">-->

<!--              <a class="faqs-title" href="#custom">-->
<!--                Manicure and pedicure at home-->
<!--              </a>-->


<!--              <div class="faqs-content">-->
<!--                <div class="faqs-content-inside">-->
<!--                  <p>Our hands and feet do the most amount of work and thus deserve-->
<!--                    the most amount of relaxation and pampering as well.</p>-->
<!--                  <p>Get those dwarfs a surprise gift and clean them up with the services.-->
<!--                    And to make that part easier, Yes Madam brings Manicure and Pedicure-->
<!--                    services to your doorstep.</p>-->
<!--                  <p>Taking a few minutes for yourself will not harm your productivity rather you will-->
<!--                    be charged and fresh with it. With one simple click on the Yes Madam app,-->
<!--                    avail manicure and pedicure service at home. Hassle-free and refreshing.</p>-->
<!--                </div>-->
<!--              </div>-->
<!--            </div>-->

<!--            <div class="faqs-item ">-->

<!--              <a class="faqs-title" href="#custom">-->
<!--                Salon at Home-->
<!--              </a>-->


<!--              <div class="faqs-content">-->
<!--                <div class="faqs-content-inside">-->
<!--                  <p>Going to the salon can be quite tedious but we have a very convenient way out for you.</p>-->
<!--                  <p>Get rid of all hassles related to getting yourself treated in a salon and consider getting your-->
<!--                    next beautician at the comfort of your home instead of making the trip. We at Yes Madam offer salon-->
<!--                    services at home that save you time and money whilst delivering outstanding results for you. Our-->
<!--                    beauticians bring salon services straight to your home, so there won't be any worry about booking-->
<!--                    haircut slots anymore, as Yes Madam will bring your desired haircut service at home for you. You-->
<!--                    won't have to go to Google and search "Salon at home near me or Salon services near me", just 2-->
<!--                    words- Yes Madam, and the job will be done. Our team of service professionals will be at your-->
<!--                    doorstep to do the needful with the entire setup and safety precautions.</p>-->
<!--                  <p>So the next time when you wonder about making a visit to any salon, stop that thought right there-->
<!--                    and go on the Yes Madam app. You will find a whole range of Salon and Spa services for males and-->
<!--                    females right there.</p>-->
<!--                </div>-->
<!--              </div>-->
<!--            </div>-->
<!--            <div class="faqs-item ">-->
<!--              <a class="faqs-title" href="#custom">-->
<!--                Beauty services at Home-->
<!--              </a>-->
<!--              <div class="faqs-content">-->
<!--                <div class="faqs-content-inside">-->
<!--                  <p> Yes Madam is an in-home Beauty and Wellness solution whose vision is to help create a-->
<!--                    culture of good health and beauty.</p>-->
<!--                  <p>We provide all the services from head to toe in the comfort of your house. We set our parlor-->
<!--                    at home so that you don't need to worry about anything. We bring the required things and also-->
<!--                    make items proof so that you don't have to hassle. We aim to bring the salon home and give you the-->
<!--                    best of our service and a relaxing time.</p>-->
<!--                  <p>Now, if you are tired, getting late or anything that doesn't allow you to visit the parlor,-->
<!--                    simply book Yes Madam to get it done at home. Keep Yes Madam handy as it will be there to cover-->
<!--                    you whenever you are tired, too lazy, or getting late for any of the beauty services.</p>-->
<!--                </div>-->
<!--              </div>-->
<!--            </div>-->

<!--            <div class="faqs-item ">-->

<!--              <a class="faqs-title" href="#custom">-->
<!--                Facial service at home-->
<!--              </a>-->


<!--              <div class="faqs-content">-->
<!--                <div class="faqs-content-inside">-->
<!--                  <P>After a long day at the office and the tiring meetings, why not relax your skin by allowing a-->
<!--                    professional to give you a calming facial right at the comfort of your home? Thinking of it as a-->
<!--                    dream? Let us burst your bubble then because it can very much come true. Get a few hours of-->
<!--                    relaxation with Yes Madam facial services at home and all your woes will be over in moments.</P>-->
<!--                  <P>Our at-home facial services are convenient and affordable. For those who are always on the go,-->
<!--                    all our facial services are nearby as we come to you! We can help you restore your skin back-->
<!--                    to its natural radiance with regular facials. We provide you with a wide range of classic and-->
<!--                    luxury facials that are performed at the convenience of your home, which ensures no travel or-->
<!--                    long waiting at the parlors. Yes Madam offers a premium range of at-home facials for all skin types.-->
<!--                  </P>-->
<!--                  <p>We use premium quality products and proven techniques that leaves your skin refreshed and glowy.-->
<!--                    So, take the stress out of life with a relaxing session of a spa facial at home with Yes Madam!</p>-->
<!--                </div>-->
<!--              </div>-->
<!--            </div>-->

<!--            <div class="faqs-item ">-->

<!--              <a class="faqs-title" href="#custom">-->
<!--                De-taning bleaching services at home-->
<!--              </a>-->


<!--              <div class="faqs-content">-->
<!--                <div class="faqs-content-inside">-->

<!--                  <p>Summers are the favorite season of many but it does bring tan and heat with it. That harms our skin-->
<!--                    and makes it dark.</p>-->
<!--                  <p>To prevent all those things you can book a salon at home service from Yes Madam to get a Detan and-->
<!--                    at very affordable-->
<!--                    prices. Now, give some rest to the scorching heat.</p>-->
<!--                  <p>Get even skin tone while resting at your home eating your favorite dish and binge-watching your-->
<!--                    favorite series.-->
<!--                    As it is never too late to pamper yourself and that too at your home.</p>-->
<!--                </div>-->
<!--              </div>-->
<!--            </div>-->

<!--          </div>-->

<!--        </main>-->
<!--      </div>-->

<!--      <div class="col-xl-6 col-lg-6 col-sm-12 col-md-12">-->
<!--        <main>-->
<!--          <div class="faqs-grid">-->

<!--            <div class="faqs-item ">-->

<!--              <a class="faqs-title" href="#custom">-->
<!--                Waxing at home-->
<!--              </a>-->


<!--              <div class="faqs-content">-->
<!--                <div class="faqs-content-inside">-->
<!--                  <p>Getting super late for the party but your legs aren't cooperating with your outfit? No worries! Yes-->
<!--                    Madam's Professional will be at your rescue. Book a slot from the application according to your-->
<!--                    preferred time and get waxed by Yes Madam's professionals.</p>-->
<!--                  <p>Yes Madam provides professional luxury waxing services at home with great products that ensure a-->
<!--                    smooth and flawless finish. Our therapists will pamper you during your visit by providing amazing-->
<!--                    wax treatments with top-range products. Yes Madam will come to your home and make you feel-->
<!--                    comfortable-->
<!--                    in your own space and thereby end all your struggles of finding nearby in-home waxing services. We-->
<!--                    provide an array of waxing services covering all types from normal wax, to Chocolate Wax, to Honey-->
<!--                    Wax and Rica Wax</p>-->
<!--                  <p>We prepare your skin with pre-waxing oil and serum and an after gel just so that your-->
<!--                    skin is smooth as butter and will help you reach your goal of achieving the right look-->
<!--                    for you. So quit visiting the salon when the salon itself can visit you. Book your slots-->
<!--                    as per your convenience and get the Waxing services started now.</p>-->
<!--                </div>-->
<!--              </div>-->
<!--            </div>-->

<!--            <div class="faqs-item ">-->

<!--              <a class="faqs-title" href="#custom">-->
<!--                Makeup services at Home-->
<!--              </a>-->


<!--              <div class="faqs-content">-->
<!--                <div class="faqs-content-inside">-->
<!--                  <p>Everyone likes to become the spotlight of the evening and a good makeup look is one thing that can-->
<!--                    bring all the eyes on you.</p>-->
<!--                  <p>To have the best of it we provide makeup at home services to give you the comfort of your home.-->
<!--                    This also cuts the traveling-->
<!--                    time which is a-->
<!--                    bsolutely a waste. There are different packages that one can choose from, according to their-->
<!--                    requirements.</p>-->
<!--                  <p>Now, if you are tired, getting late or anything that doesn't allow you to visit the parlor,-->
<!--                    simply book Yes Madam to get it done at home. Keep Yes Madam handy as it will be there to cover-->
<!--                    you whenever you are tired, too lazy, or getting late for any of the beauty services.</p>-->
<!--                </div>-->
<!--              </div>-->
<!--            </div>-->
<!--            <div class="faqs-item ">-->
<!--              <a class="faqs-title" href="#custom">-->
<!--                Beauty services at Home-->
<!--              </a>-->
<!--              <div class="faqs-content">-->
<!--                <div class="faqs-content-inside">-->
<!--                  <p> Yes Madam is an in-home Beauty and Wellness solution whose vision is to help create a-->
<!--                    culture of good health and beauty.</p>-->
<!--                  <p>We provide all the services from head to toe in the comfort of your house. We set our parlor-->
<!--                    at home so that you don't need to worry about anything. We bring the required things and also-->
<!--                    make items proof so that you don't have to hassle. We aim to bring the salon home and give you the-->
<!--                    best of our service and a relaxing time.</p>-->
<!--                  <p>Now, if you are tired, getting late or anything that doesn't allow you to visit the parlor,-->
<!--                    simply book Yes Madam to get it done at home. Keep Yes Madam handy as it will be there to cover-->
<!--                    you whenever you are tired, too lazy, or getting late for any of the beauty services.</p>-->
<!--                </div>-->
<!--              </div>-->
<!--            </div>-->

<!--            <div class="faqs-item ">-->

<!--              <a class="faqs-title" href="#custom">-->
<!--                Female Spa at Home-->
<!--              </a>-->


<!--              <div class="faqs-content">-->
<!--                <div class="faqs-content-inside">-->
<!--                  <P>After a long day at the office and the tiring meetings, why not relax your skin by allowing a-->
<!--                    professional to give you a calming facial right at the comfort of your home? Thinking of it as a-->
<!--                    dream? Let us burst your bubble then because it can very much come true. Get a few hours of-->
<!--                    relaxation with Yes Madam facial services at home and all your woes will be over in moments.</P>-->
<!--                  <P>Our at-home facial services are convenient and affordable. For those who are always on the go,-->
<!--                    all our facial services are nearby as we come to you! We can help you restore your skin back-->
<!--                    to its natural radiance with regular facials. We provide you with a wide range of classic and-->
<!--                    luxury facials that are performed at the convenience of your home, which ensures no travel or-->
<!--                    long waiting at the parlors. Yes Madam offers a premium range of at-home facials for all skin types.-->
<!--                  </P>-->
<!--                  <p>We use premium quality products and proven techniques that leaves your skin refreshed and glowy.-->
<!--                    So, take the stress out of life with a relaxing session of a spa facial at home with Yes Madam!</p>-->
<!--                </div>-->
<!--              </div>-->
<!--            </div>-->

<!--            <div class="faqs-item ">-->

<!--              <a class="faqs-title" href="#custom">-->
<!--                Male massage at Home-->
<!--              </a>-->


<!--              <div class="faqs-content">-->
<!--                <div class="faqs-content-inside">-->

<!--                  <P>After a long day at the office and the tiring meetings, why not relax your skin by allowing a-->
<!--                    professional to give you a calming facial right at the comfort of your home? Thinking of it as a-->
<!--                    dream? Let us burst your bubble then because it can very much come true. Get a few hours of-->
<!--                    relaxation with Yes Madam facial services at home and all your woes will be over in moments.</P>-->
<!--                  <P>Our at-home facial services are convenient and affordable. For those who are always on the go,-->
<!--                    all our facial services are nearby as we come to you! We can help you restore your skin back-->
<!--                    to its natural radiance with regular facials. We provide you with a wide range of classic and-->
<!--                    luxury facials that are performed at the convenience of your home, which ensures no travel or-->
<!--                    long waiting at the parlors. Yes Madam offers a premium range of at-home facials for all skin types.-->
<!--                  </P>-->
<!--                  <p>We use premium quality products and proven techniques that leaves your skin refreshed and glowy.-->
<!--                    So, take the stress out of life with a relaxing session of a spa facial at home with Yes Madam!</p>-->
<!--                </div>-->
<!--              </div>-->
<!--            </div>-->

<!--          </div>-->

<!--        </main>-->
<!--      </div>-->

<!--    </div>-->
<!--  </div>-->
<!--</div>-->