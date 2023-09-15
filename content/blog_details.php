<?php 
$query_blog="SELECT b.* FROM blog b
where b.status = 1
ORDER BY b.ID ASC";

$sql_blog = mysqli_query($con,$query_blog)or die(mysqli_error());
    
?>
<div class="blog-banner">
  <img src="images/beauty-blog/banner-2.jpg" alt="">

  <h2>Blog </h2>
  <div class="line"></div>
</div>
<div class="blog-latest-post">
  <div class="container" style="margin-top: 50px; margin-bottom:50px;">
    <div class="row">
        
        <?php while($data_blog = mysqli_fetch_assoc($sql_blog)){
            
            if(!empty($data_blog['pic'])){
                $image = UPLOAD_PATH.'blogs/'.$data_blog['pic'];
            }else{
                $image='';
            }
        
        ?>
        <div class="col-xl-3 col-lg-3 col-sm-12 col-md-4">
        <div class="blog-item">
          <div class="image-wrap">
            <a href="single_blog.php?blog=<?php echo $data_blog['ID']; ?>"><img src="<?php echo $image; ?>" alt=""></a>

          </div>
          <div class="blog-content">
            <ul class="blog-meta">
              <li class="date"><i class="fa fa-calendar-check-o"></i> <?php echo dateString($data_blog['date']); ?> </li>

            </ul>
            <h3 class="blog-title"><a href="single_blog.php?blog=<?php echo $data_blog['ID']; ?>"><?php echo $data_blog['tittle']; ?> </a></h3>
            <b class="desc " style="color:black;"><?php echo $data_blog['description']; ?> </b>
            <div class="blog-button"><a href="single_blog.php?blog=<?php echo $data_blog['ID']; ?>">Learn More</a></div>
          </div>
        </div>
      </div>
        <?php } ?>
    </div>
  </div>
</div>