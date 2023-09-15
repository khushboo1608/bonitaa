<?php if(isset($_GET['blog']))
{
    $query_blog="SELECT b.* FROM blog b
    where b.status = 1 and b.ID = '".$_GET['blog']."'
    ORDER BY b.ID ASC";
    
    $sql_blog = mysqli_query($con,$query_blog)or die(mysqli_error());
    
    $query_blog_latest="SELECT b.* FROM blog b
    where b.status = 1 and b.ID != '".$_GET['blog']."'
    ORDER BY b.ID ASC";
    
    $sql_blog_latest = mysqli_query($con,$query_blog_latest)or die(mysqli_error());
		
?>
<div class="blog-details-banner">
    <img src="images/beauty-blog/banner-3.jpg" alt="">
</div>
<div class="blog-details-contant">
    <div class="container" style="margin-top:50px;">
        <div class="row">
           <?php while($data_blog = mysqli_fetch_assoc($sql_blog)){
            
                if(!empty($data_blog['pic'])){
              	    $image = UPLOAD_PATH.'blogs/'.$data_blog['pic'];
              	}else{
              	    $image='';
              	}
        
            ?>
            <div class="col-xl-8 col-sm-12 col-md-12 col-lg-8">

                <div class="main-blog" style="margin-top:0px; background:white;">
                    <div class="blog-left-box" style="background:transparent; box-shadow:none;">
                        <img src="<?php echo $image; ?>" alt="">
                         <h4 class="mt-4"><?php echo $data_blog['tittle']; ?> </h4> 
                        <div class="date-box mt-5">
                            <i class="fa fa-calendar text-dark"></i>
                            <span><?php echo dateString($data_blog['date']); ?></span>
                            <i class="fa fa-user ml-5 text-dark" style="margin-left:20px;"></i>
                            <span>Admin</span>
                        </div>

                        <p class="mt-4">
                            <?php echo $data_blog['description']; ?>
                        </p>
                        <!-- <a href="#">Continue Reading</a> -->
                    </div>
                </div>

                <!--<div class="digital-technology">-->
                <!--    <div class="digital-text">-->
                <!--        <h2>Digital technology on the cutting edge</h2>-->

                <!--        <div class="  digital-desc">-->
                <!--            <ul>-->
                <!--                <li>-->
                <!--                    How will digital activities impact traditional manufacturing.-->
                <!--                </li>-->

                <!--                <li>-->
                <!--                    All these digital elements and projects aim to enhance .-->
                <!--                </li>-->

                <!--                <li>-->
                <!--                    I monitor my staff with software that takes screenshots.-->
                <!--                </li>-->

                <!--                <li>-->
                <!--                    Laoreet dolore magna niacin sodium glutimate aliquam hendrerit.-->
                <!--                </li>-->

                <!--                <li>-->
                <!--                    Minim veniam quis niacin sodium glutimate nostrud exerci dolor.-->
                <!--                </li>-->

                <!--            </ul>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->

                <!--<p class="latest-page-line">Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil-->
                <!--    impedit-->
                <!--    quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda-->
                <!--    est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis-->
                <!--    debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae-->
                <!--    sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente-->
                <!--    delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus-->
                <!--    asperiores repellat.</p>-->

                <!--<div class="main-blog">-->
                <!--    <div class="blog-left-box" style="background:transparent; box-shadow:none;">-->
                <!--        <img src="images/beauty-blog/b2.jpg" alt="">-->
                <!--        <p class="mt-5">Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil-->
                <!--            impedit quo minus id quod maxime placeat facere possimus, omnis voluptas-->
                <!--            assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut-->
                <!--            officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates-->
                <!--            repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur-->
                <!--            a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur-->
                <!--            aut perferendis doloribus asperiores repellat.</p>-->

                <!--    </div>-->
                <!--</div>-->
            </div>
            <?php } ?>
            <div class="col-lg-4 col-md-12 col-sm-12 col-xl-4">
                <div class="main-latest-box">
                    <h2>Latest Posts</h2>
                    
                    <?php while($data_blog_latest = mysqli_fetch_assoc($sql_blog_latest)){
            
                        if(!empty($data_blog_latest['pic'])){
                      	    $image = UPLOAD_PATH.'blogs/'.$data_blog_latest['pic'];
                      	}else{
                      	    $image='';
                      	}
                
                    ?>
                    <div class="latest-box-collection">
                        
                        <div class="latest-img-box">
                            <a href="single_blog.php?blog=<?php echo $data_blog_latest['ID']; ?>"><img src="<?php echo $image; ?>" alt=""></a>
                        </div>
                        <div class="latest-Content-box">
                            <p><a href="single_blog.php?blog=<?php echo $data_blog_latest['ID']; ?> " class="text-dark fw-bold " style="text-decoration: none
                            ;"><?php echo $data_blog_latest['tittle']; ?> </a></p>
                            <i class="fa fa-calendar text-dark"></i>
                            <span><?php echo dateString($data_blog_latest['date']); ?></span>
                        </div>
                    </div>
                    <?php } ?>

                </div>

                <div class="main-categary-box">
                    <h2>Category</h2>
                    <div class="categary-box">
                        <p>Application Testing</p>


                        <p>Artifical Intelligence</p>

                        <p>Digital Technology</p>

                        <p>IT Services</p>

                        <p>Software Development</p>

                        <p>Web Development</p>


                    </div>
                </div>

            </div>
        </div>
    </div>
    
</div>
<?php } ?>