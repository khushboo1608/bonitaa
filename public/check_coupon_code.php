<?php

include('../inc/config.php'); 



 // session_start();

  // Send OTP to email Form post
  if (isset($_POST['promocode']) ) {
        
    $coupon_code = $_POST['promocode'];

    $total_dis_price = $_POST['dis_amount'];
    $total_ori_price = $_POST['ori_amount'];
    
    

    date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
    $date = date('Y-m-d');

    //INSERT INTO `coupon_master`(`ID`, `status`, `category_id`, `coupon_name`, `coupon_promocode`, `coupon_minamount`, `coupon_maxamount`, `coupon_type`, `coupon_peruser`, `coupon_price`, 
    //`coupon_start_date`, `coupon_end_date`)
    
    $query = "SELECT * FROM coupon_master 
    WHERE status = 1 and coupon_start_date <= '".$date."' and coupon_end_date >= '".$date."' 
    and coupon_master.coupon_promocode = '".$coupon_code."'
    ORDER BY coupon_master.`ID` ASC ";

    $result = $con->query($query);
    $row1 = mysqli_fetch_assoc($result);
    $num_rows2 = mysqli_num_rows($result);
          
        if ($num_rows2 > 0 )
        {

            if($total_dis_price >= $row1['coupon_minamount'])
            {
                // echo 'Hii1';
                if($row1['coupon_type'] == 1)
                {
                    $total_price_min = $total_dis_price * $row1['coupon_price'];
                    $amount = $total_price_min / 100;
                    
                

                    if($amount >= $row1['coupon_maxamount'])
                    {
                        //$final = $total_dis_price - $row1['cpn_maxdiscount'];
                        //echo $final;
                        //echo $row1['cpn_maxdiscount'];

                        //  echo 'Hello';  
                        // echo "<ul>";
                        // echo "<li>₹";
                        // echo $total_ori_price;
                        // echo "/-</li>";
                        // echo "<li>₹";
                        // echo $total_dis_price;
                        // echo "/-";
                        // echo "</li>";
                        // echo "<li>₹";
                        // echo  $coupon_amount =$row1['coupon_maxamount'];
                        //   $coupon_amount1 = $total_dis_price - $row1['coupon_maxamount'];
                        // echo "/-</li>";
                        // echo "<li>₹";
                        // echo APP_safety_hygiene;
                        // echo "/-</li>";
                        // echo "<li>₹";
                        // echo APP_conveyance;
                        // echo "/-</li>";
                        // echo "<li>₹";
                        // echo $coupon_amount1+APP_conveyance + APP_safety_hygiene ; 
                        // echo "/-</li></ul>";
                        
                        
                        
                        echo '<div class="steal-summary-first">';
                        echo '<ul>';
                        echo '<li>';
                        echo '<h4>Total Amount</h4>';
                        echo '<h4>₹ ';
                        echo $total_ori_price;
                        echo '/-</h4>';
                        echo '</li>';
                        echo '<li>';
                        echo '<h4> Product After Discount </h4>';
                        echo '<h4>₹';
                        echo $total_dis_price;
                        echo '/-';
                        echo '</h4>';
                        echo '</li>';
                        
                        echo '<li>';
                        echo '<h4>Promotion Applied </h4>';
                        echo '<h4> ₹';
                        echo $coupon_amount =$row1['coupon_maxamount'];
                          $coupon_amount1 = $total_dis_price - $row1['coupon_maxamount'];
                        echo '/- </h4>';
                        echo '</li>';
                       
                        echo '<li>';
                        echo '<h4> Safety & Hygiene Charges </h4>';
                        echo '<h4>₹';
                        echo APP_safety_hygiene .'/-';
                        echo '</h4>';
                        echo '</li>';
                        echo '<li>';
                        echo '<h4>Conveyance Charges </h4>';
                        echo '<h4>₹';
                        echo APP_conveyance .'/-';
                        echo '</h4>';
                        echo '</li>';
                        
                        echo '<li>';
                        echo '<div class="payble-amount-selction-box-2">';
                        echo '<h4>Total Payable Amount</h4>';
                        echo '<h4>₹' ;
                        echo $coupon_amount1 + APP_conveyance + APP_safety_hygiene ;
                        echo '/-</h4>';
                        echo '</div>';
                        echo '</li>';
                        echo '</ul>';
                        echo '</div>';
                            
                        
                      
                
                    }else{

                        
                        // echo "<ul>";
                        // echo "<li>₹";
                        // echo $total_ori_price;
                        // echo "/-</li>";
                        // echo "<li>₹";
                        // echo $total_dis_price;
                        // echo "/-";
                        // echo "</li>";
                        // echo "<li>₹";
                        //   $coupon_amount1 = $total_dis_price - $amount;
                        // echo  $coupon_amount = $amount;
                        // echo "/-</li>";
                        // echo "<li>₹";
                        // echo APP_safety_hygiene;
                        // echo "/-</li>";
                        // echo "<li>₹";
                        // echo APP_conveyance;
                        // echo "/-</li>";
                        // echo "<li>₹";
                        // echo $coupon_amount1 + APP_conveyance + APP_safety_hygiene; 
                        // echo "/-</li></ul>";
                        
                        
                        echo '<div class="steal-summary-first">';
                        echo '<ul>';
                        echo '<li>';
                        echo '<h4>Total Amount</h4>';
                        echo '<h4>₹ ';
                        echo $total_ori_price;
                        echo '/-</h4>';
                        echo '</li>';
                        echo '<li>';
                        echo '<h4> Product After Discount </h4>';
                        echo '<h4>₹';
                        echo $total_dis_price;
                        echo '/-';
                        echo '</h4>';
                        echo '</li>';
                        
                        echo '<li>';
                        echo '<h4>Promotion Applied </h4>';
                        echo '<h4> ₹';
                         $coupon_amount1 = $total_dis_price - $amount;
                        echo $coupon_amount =$amount;
                         
                        echo '/- </h4>';
                        echo '</li>';
                       
                        echo '<li>';
                        echo '<h4> Safety & Hygiene Charges </h4>';
                        echo '<h4>₹';
                        echo APP_safety_hygiene .'/-';
                        echo '</h4>';
                        echo '</li>';
                        echo '<li>';
                        echo '<h4>Conveyance Charges </h4>';
                        echo '<h4>₹';
                        echo APP_conveyance .'/-';
                        echo '</h4>';
                        echo '</li>';
                        
                        echo '<li>';
                        echo '<div class="payble-amount-selction-box-2">';
                        echo '<h4>Total Payable Amount</h4>';
                        echo '<h4>₹' ;
                        echo $coupon_amount1 + APP_conveyance + APP_safety_hygiene ;
                        echo '/-</h4>';
                        echo '</div>';
                        echo '</li>';
                        echo '</ul>';
                        echo '</div>';
                        
                    }

                    //echo 1;

                }else if($row1['coupon_type'] == 2)
                {
                    //$amount = $total_dis_price - $row['cpn_price'];
                    //echo '₹'.$amount;
                    

                   
                        // echo "<ul>";
                        // echo "<li>₹";
                        // echo $total_ori_price;
                        // echo "/-</li>";
                        // echo "<li>₹";
                        // echo $total_dis_price;
                        // echo "/-";
                        // echo "</li>";
                        // echo "<li>₹";
                        
                        // echo  $row1['coupon_price'];
                        //   $coupon_amount = $total_dis_price - $row1['coupon_price'];
                        // echo "/-</li>";
                        // echo "<li>₹";
                        // echo APP_safety_hygiene;
                        // echo "/-</li>";
                        // echo "<li>₹";
                        // echo APP_conveyance;
                        // echo "/-</li>";
                        // echo "<li>₹";
                        // echo $coupon_amount + APP_conveyance + APP_safety_hygiene ; 
                        // echo "/-</li></ul>";
                        
                        
                        echo '<div class="steal-summary-first">';
                        echo '<ul>';
                        echo '<li>';
                        echo '<h4>Total Amount</h4>';
                        echo '<h4>₹ ';
                        echo $total_ori_price;
                        echo '/-</h4>';
                        echo '</li>';
                        echo '<li>';
                        echo '<h4> Product After Discount </h4>';
                        echo '<h4>₹';
                        echo $total_dis_price;
                        echo '/-';
                        echo '</h4>';
                        echo '</li>';
                        
                        echo '<li>';
                        echo '<h4>Promotion Applied </h4>';
                        echo '<h4> ₹';
                         
                        echo  $row1['coupon_price'];
                         $coupon_amount = $total_dis_price - $row1['coupon_price'];
                        echo '/- </h4>';
                        echo '</li>';
                       
                        echo '<li>';
                        echo '<h4> Safety & Hygiene Charges </h4>';
                        echo '<h4>₹';
                        echo APP_safety_hygiene .'/-';
                        echo '</h4>';
                        echo '</li>';
                        echo '<li>';
                        echo '<h4>Conveyance Charges </h4>';
                        echo '<h4>₹';
                        echo APP_conveyance .'/-';
                        echo '</h4>';
                        echo '</li>';
                        
                        echo '<li>';
                        echo '<div class="payble-amount-selction-box-2">';
                        echo '<h4>Total Payable Amount</h4>';
                        echo '<h4>₹' ;
                        echo $coupon_amount + APP_conveyance + APP_safety_hygiene ;
                        echo '/-</h4>';
                        echo '</div>';
                        echo '</li>';
                        echo '</ul>';
                }
                
            }else{
                echo 'invalid';
            }
            
       
          
    }else{
               echo 'invalid_not';
                        // // echo "<ul>";
                        // // echo "<li>₹";
                        // // echo $total_ori_price;
                        // // echo "/-</li>";
                        // // echo "<li>₹";
                        // // echo $total_dis_price;
                        // // echo "/-";
                        // // echo "</li>";
                        // // echo "<li>₹";
                        
                        // // echo  0;
                          
                        // // echo "/-</li>";
                        // // echo "<li>₹";
                        // // echo APP_safety_hygiene;
                        // // echo "/-</li>";
                        // // echo "<li>₹";
                        // // echo APP_conveyance;
                        // // echo "/-</li>";
                        // // echo "<li>₹";
                        // // echo $total_dis_price + APP_conveyance + APP_safety_hygiene ; 
                        // // echo "/-</li></ul>";
                        
                        
                        // echo '<div class="steal-summary-first">';
                        // echo '<ul>';
                        // echo '<li>';
                        // echo '<h4>Total Amount</h4>';
                        // echo '<h4>₹ ';
                        // echo $total_ori_price;
                        // echo '/-</h4>';
                        // echo '</li>';
                        // echo '<li>';
                        // echo '<h4> Product After Discount </h4>';
                        // echo '<h4>₹';
                        // echo $total_dis_price;
                        // echo '/-';
                        // echo '</h4>';
                        // echo '</li>';
                        
                        // echo '<li>';
                        // echo '<h4>Promotion Applied </h4>';
                        // echo '<h4> ₹';
                         
                        // echo  0;
                        // echo '/- </h4>';
                        // echo '</li>';
                       
                        // echo '<li>';
                        // echo '<h4> Safety & Hygiene Charges </h4>';
                        // echo '<h4>₹';
                        // echo APP_safety_hygiene .'/-';
                        // echo '</h4>';
                        // echo '</li>';
                        // echo '<li>';
                        // echo '<h4>Conveyance Charges </h4>';
                        // echo '<h4>₹';
                        // echo APP_conveyance .'/-';
                        // echo '</h4>';
                        // echo '</li>';
                        
                        // echo '<li>';
                        // echo '<div class="payble-amount-selction-box-2">';
                        // echo '<h4>Total Payable Amount</h4>';
                        // echo '<h4>₹' ;
                        // echo $total_dis_price + APP_conveyance + APP_safety_hygiene ;
                        // echo '/-</h4>';
                        // echo '</div>';
                        // echo '</li>';
                        // echo '</ul>';
    } 
                 
  }  
  

?>