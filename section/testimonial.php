<!-- ======================================= 
        ==Start Testimonial section==  
=======================================-->
<section class="testimonial-section">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2 col-md-8 offset-md-2">
                <div class="section-title pb-60 text-center">
                    <h3 class="color-ff fw-500">Testimonials</h3>
                </div>

                <div class="testimoial-wrapper owl-carousel">
                    <!--testimonial-1-->
                    <?php $testimonials =  getAllRecords($con,"testimonials","");
                    foreach ($testimonials as $value) { 
                       $pic = ($value['pic']!="") ? $value['pic'] : "avtar.jpg";
                    ?>
                    <div class="single-testimonial text-center">
                        <img src="<?= UPLOAD_PATH.'review/'. $pic; ?>" alt="author">
                        <p class="testimoinal-txt color-ff pt-25"><?= $value['details']; ?></p>
                        <p class="author color-ff"><?= $value['title']; ?></p>
                    </div>
                    <?php } ?>
                </div>
                <!--/testimoial wrapper-->
            </div>
            <!--/col-->
        </div>
    </div>
</section>
<!-- ======================================= 
        ==End Testimonial section== 
=======================================-->
