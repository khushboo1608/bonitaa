<div class="home_page_slider">
	<div class="slider">
	    <?php  $query="SELECT *,b.pic as bannerimage FROM banner b
		LEFT JOIN category c ON c.ID = b.category_id
        where b.hide = 0 and b.type = '1' and b.category_id = '0'
        ORDER BY b.sort ASC";
    	
		$sql = mysqli_query($con,$query)or die(mysqli_error());
		
		
		while($data = mysqli_fetch_assoc($sql))
		{	
		    if(!empty($data['bannerimage'])){
          	    $image = UPLOAD_PATH.'banner/'.$data['bannerimage'];
          	}else{
          	    $image='';
          	}
          	
		?>
		<div>
			<div class="slideCopy-container">
				<div class="slideCopy-content">
					<img src="<?php echo $image ?>" alt="">
				</div>
			</div>
		</div>
	    <?php } ?>
	</div>
</div>