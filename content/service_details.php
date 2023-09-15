<?php
function hoursandmins($time)
{
    if ($time < 1) {
        return;
    }
    $hours = floor($time / 60);
    $minutes = ($time % 60);
    
    if( $hours == 0 )
        return "{$minutes} minutes";
    else
        return "{$hours} hours {$minutes} minutes";
        
    // return sprintf($format, $hours, $minutes);
}
?>
 <?php 
         $query_sub_sub_category="SELECT *,subsubcat.ID as subsubid,subcat.ID as subid,subsubcat.status as subsubstatus,c.ID as catid,c.category as category_name,subcat.subcategory as sub_name,subsubcat.pic as subsubimage,subsubcat.description as subsubdescription FROM `subsubcategory` subsubcat
        LEFT JOIN category c ON c.ID = subsubcat.category
        LEFT JOIN subcategory subcat ON subcat.ID = subsubcat.subcategory
        WHERE subsubcat.category = '".$_GET['category']."' and subsubcat.subcategory = '".$_GET['sub_category']."' and subsubcat.status = 1
        ORDER BY subsubcat.sort ASC";
        
        $sql_sub_sub_category = mysqli_query($con,$query_sub_sub_category)or die(mysqli_error());
        $count = mysqli_num_rows($sql_sub_sub_category);
        if($count>0){
        ?>
            <div class="nav-scroller-box">
                <div class="container" style="margin-top:0px;">
                    <div class="flex-container">
                        <nav class=" flex-col text-gray-600 nav-control">
                            <div class="nav-control-iiner-box">     
                                <?php
                                   
                                    $num=0;
                                    
                                    while($data_sub_sub_category = mysqli_fetch_assoc($sql_sub_sub_category))
                                    {
                                       $num=$num+1; 
                                       if(!empty($data_sub_sub_category['subsubimage'])){
                                            $image = UPLOAD_PATH.'subsubcategory/'.$data_sub_sub_category['subsubimage'];
                                        }else{
                                            $image='';
                                        }
                  
                                ?>

                                <a href="#<?php echo $data_sub_sub_category['subsubcategory_name']; ?>" class="item p-2 mt-1 font-medium text-sm rounded transition duration-150 ease-in-out  bg-gray-900 shadow-inner active"> <?php echo $data_sub_sub_category['subsubcategory_name']; ?> </a>

                                <?php } ?>                               
                                <!--     <a href="#deal1000" class="item p-2 mt-1 font-medium text-sm rounded transition duration-150 ease-in-out  bg-gray-900 shadow-inner active">Deal 1000</a>
                                                                
                                    <a href="#deal1250" class="item p-2 mt-1 font-medium text-sm rounded transition duration-150 ease-in-out  bg-gray-900 shadow-inner active">Deal 1250</a>
                                                                
                                    <a href="#deal1500" class="item p-2 mt-1 font-medium text-sm rounded transition duration-150 ease-in-out  bg-gray-900 shadow-inner active">Deal 1500</a>
                                                                
                                    <a href="#deal2000" class="item p-2 mt-1 font-medium text-sm rounded transition duration-150 ease-in-out  bg-gray-900 shadow-inner active">Deal 2000</a>
                                                                
                                    <a href="#deal2500" class="item p-2 mt-1 font-medium text-sm rounded transition duration-150 ease-in-out  bg-gray-900 shadow-inner active">Deal 2500</a>
                                                                
                                    <a href="#deal3000" class="item p-2 mt-1 font-medium text-sm rounded transition duration-150 ease-in-out  bg-gray-900 shadow-inner active">Deal 3000</a>                           -->
                                    
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
<?php }else{ ?>
<h4 class="not-found-text"> No data found. </h4>
<?php } ?>


<div class="deal-wrapper">
    <div class="container" style="margin-top:0;">

    
        <?php
        $num=0;
        $query_sub_sub_category="SELECT *,subsubcat.ID as subsubcatid FROM `subsubcategory` subsubcat
        WHERE subsubcat.category = '".$_GET['category']."' and subsubcat.subcategory = '".$_GET['sub_category']."' and subsubcat.status = 1
        ORDER BY subsubcat.sort ASC";
        
        $sql_sub_sub_category = mysqli_query($con,$query_sub_sub_category)or die(mysqli_error());
        while($data_sub_sub_category = mysqli_fetch_assoc($sql_sub_sub_category))
        {
        ?>
        <div class="deal deal-850" id="<?php echo $data_sub_sub_category['subsubcategory_name']; ?>">
            <div class="nav-controller_box">
                <div>
                    <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:leading-9 sm:truncate mb-8"><?php echo $data_sub_sub_category['subsubcategory_name']; ?></h2>
                </div>
            <div>
        </div>


        <?php
            $query_service="SELECT *,s.ID as serviceid,c.ID as catid,subcat.ID as subid,subsubcat.ID as subsubid,c.category as category_name,subcat.subcategory as sub_name,s.pic as serviceimage,s.status as servicestatus  FROM `services` s 
            LEFT JOIN category c ON c.ID = s.category
            LEFT JOIN subcategory subcat ON subcat.ID = s.subcategory 
            LEFT JOIN subsubcategory subsubcat ON subsubcat.ID = s.subsubcategory
            WHERE s.category = '".$_GET['category']."' AND s.subcategory = '".$_GET['sub_category']."' and s.subsubcategory='".$data_sub_sub_category['subsubcatid']."' and s.status = 1
            GROUP BY s.ID
            ORDER BY s.sort ASC";
            
            $sql_service = mysqli_query($con,$query_service)or die(mysqli_error());
            
            while($data_service = mysqli_fetch_assoc($sql_service))
            {
                $num=$num+1;
                 if(!empty($data_service['serviceimage'])){
                    $image = UPLOAD_PATH.'service/'.$data_service['serviceimage'];
                }else{
                    $image='';
                }
            ?>

                    <div class="waxix-box">
                        <div class="waxix-img">
                            <img src="<?php echo $image; ?>" />
                            <?php if($data_service['feature'] == 1){ ?>
                            <div class="service-details">TRENDING</div>
                            <?php } ?>
                        </div>
                        <div class="waxix-content">
                            <h4><?php echo $data_service['title'];  ?></h4>
                            <?php if(!empty($data_service['short_description'])){ ?>
                            <ul>
                                <li><?php echo $data_service['short_description'];  ?></li>
                            </ul>
                            <?php } ?>
                            <script>
                                $(document).ready(function(){
                                $(".<?php echo $data_service['serviceid'];?>-details").click(function(){
                                    $(".<?php echo $data_service['serviceid'];?>-wrapper").addClass("main");
                                    $("html").addClass(" overflow-hidden");
                                });
                                });
                                $(document).ready(function(){
                                $(".remove-wrapper").click(function(){
                                    $(".<?php echo $data_service['serviceid'];?>-wrapper").removeClass("main");
                                    $("html").removeClass(" overflow-hidden");
                                });
                                });
                            </script>
                            <div class="view-details-links">
                                <a class="<?php echo $data_service['serviceid'];?>-details view-details-text">View Details</a>
                            </div>
                            <div class="service_time"><i class="fa fa-clock"></i><span class="time"><?php echo hoursandmins($data_service['duration']); ?></span></div>
                            <div class="bottom_right">        
                                <div class="Price_box">
                                    <span class="Price">₹<?php echo $data_service['discount_amount']; ?>/-</span>
                                    <span class="prev_price">₹<?php echo $data_service['original_amount']; ?></span>
                                    <span class="discount"><?php echo $data_service['discount']; ?>% off</span>
                                </div>
                               
                                <?php 
                                    if(isset($_SESSION['user_id'])) { 
                                    $sql = "SELECT * FROM cart WHERE user_id='".$_SESSION['user_id']."' and services_id='".$data_service['serviceid']."' ";
                                    
                                    $total = 0;
                                    $totals_is_various = 0;
                                    $total_qty = 0;
                                    
                                    $result = mysqli_query($con,$sql);
                                    $count = mysqli_num_rows($result);
                                    if($count>0){
                                    while($row = mysqli_fetch_array($result)) {
                                ?> 
                                <div class="home-page_conuter">
                                    <div class="Counter-number-add">
                                        <div class="center">
                                            <div class="input-group">
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-danger btn-number-1 qty_minus" data-id="<?php echo $data_service['serviceid'];?>" data-type="minus" data-field="quant[<?php echo $num; ?>]">
                                                        <i class="fa fa-minus"></i>
                                                    </button>
                                                </span>
                                                <!-- <input type="text" name="quant[<?php echo $num; ?>]"  id="quant" class="form-control input-number-1" value="<?php echo $row['cart_services_qty'];  ?>" min="0" max="100"> -->
        
                                                <input type="text" name="quant[<?php echo $num; ?>]"  id="quant_<?php echo $data_service['serviceid']; ?>" class="form-control input-number-1" value="<?php echo $row['cart_services_qty'];  ?>" min="0" max="100">
        
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-success btn-number-1 qty_plus" data-id="<?php echo $data_service['serviceid'];?>" data-type="plus" data-field="quant[<?php echo $num; ?>]">
                                                        <i class="fa fa-plus"></i>
                                                    </button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php }
                                                
                                }else{ ?>               
                                 <!-- <a href="javascript:void(0)" data-toggle="tooltip" data-id="<?php echo $data_service['serviceid'];?>" name="addtocart" class="text-white addtocart add">
                                    <span class="Login-btn transition duration-150 ease-in-out  bg-gray-900">ADD TO CART</span>
                                </a> -->
                                 <div class="add_cart"><a name="addtocart" class="addtocart" href="javascript:void(0)" data-toggle="tooltip" data-id="<?php echo $data_service['serviceid'];?>" ><button class="add_cart_btn">ADD TO CART</button></a></div> 

                                <?php } }else{ ?>
                                <a href="./register.php" class="text-white">
                                    <span class="Login-btn transition duration-150 ease-in-out  bg-gray-900">Login / Register</span>
                                </a>
                                <?php } ?>
                            </div>
                        </div>
               
                    </div>
                    <!-- modal -->
                    <div class="<?php echo $data_service['serviceid'];?>-wrapper wrappers">
                        <div class="box-waxix">
                            <div class="remove-wrapper">
                                <i class="fa fa-remove"></i>
                            </div>
                            <div class="waxix-box">
                                <div class="waxix-img">
                                    <img src="<?php echo $image; ?>" />
                                    <?php if($data_service['feature'] == 1){ ?>
                                    <?php } ?>
                                </div>
                                <div class="waxix-content">
                                    <h4><?php echo $data_service['title'];  ?></h4>
                                    <?php if(!empty($data_service['long_description'])){ ?>
                                   
                                        <?php echo $data_service['long_description'];  ?>
                                    
                                    <?php } ?>
                                    <div class="bottom_right">        
                                        <div class="Price_box">
                                            <span class="Price">₹<?php echo $data_service['discount_amount']; ?>/-</span>
                                            <span class="prev_price">₹<?php echo $data_service['original_amount']; ?></span>
                                            <span class="discount"><?php echo $data_service['discount']; ?>% off</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- modal end -->
                <?php } ?>
                </div>
            </div>
        <?php } ?>
        </div>       
    </div>
</div>