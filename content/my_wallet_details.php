<?php 
if(!isset($_SESSION['user_id'])){
    echo "<script>window.location.href='index.php'</script>";
}

$qry_profile = "SELECT * FROM user_registration WHERE ID='".$_SESSION['user_id']."'"; 
$result_profile = mysqli_query($con,$qry_profile);
$row_profile = mysqli_fetch_assoc($result_profile);

$query_wallet="SELECT *,u.name as username FROM `wallet_history` w
LEFT JOIN user_registration u ON u.ID = w.wh_user_id
WHERE w.wh_user_id = '".$_SESSION['user_id']."'
ORDER BY w.wh_id DESC";

$sql_wallet = mysqli_query($con,$query_wallet)or die(mysqli_error());

?>
<div class="bonitaa_wallet_box">
  <div class="container" style="margin-top: 0px; margin-bottom:0px;">
    <div class="row">
      <div class="col-xl-12 col-md-12 col-sm-12 col-lg-12">
        <div class="bonitaa-wallet-main-box">
          <div class="row">
            <div class="col-xl-4 col-sm-12 col-md-4 col-lg-4">
              <div class="bonitaa-total-balace">
                <i class="fas fa-wallet"></i> <span>Total wallet Balance</span>
              </div>
              <div class="wallet-price">
                <h4> ₹<?php echo $row_profile['wallet']; ?> </h4>
              </div>
            </div>

            <div class="col-xl-4 col-sm-12 col-md-4 col-lg-4">
              <div class="bonitaa-code-box">
                <h4>Your Code : <?php echo $row_profile['code']; ?></h4>
              </div>

            </div>

            <!--<div class="col-xl-4 col-sm-12 col-md-4 col-lg-4">-->
            <!--  <div class="bonitaa-share">-->
            <!--    <button class="btn btn-primary">-->
            <!--      <i class="fas fa-share-alt"></i> Share-->
            <!--    </button>-->
            <!--  </div>-->
            <!--</div>-->
          </div>
        </div>


        <div class="transation-history">
          <h5>Transaction History</h5>
        </div>
        <div class="main-transaction-outer">
        <?php 
        while($data_wallet = mysqli_fetch_assoc($sql_wallet))
		{	
		  //  1=plus,2=minus
		    if($data_wallet['wh_transaction_type'] == 1)
		    {
		        $transaction_type = '+';
		    }else if($data_wallet['wh_transaction_type'] == 2)
		    {
		        $transaction_type = '-';
		    }
		    
		    $newdate = date("d M, Y H:i:s", strtotime($data_wallet['wallet_date']));
            
            if($data_wallet['wallet_date'] == "")
            {
                $date = '';
            }else{
                $date = $newdate;
            }
        ?>
          <div class="transation-details-box">
            <div class="line-box">
              <div class="transation-details-text">
                <p><?php echo $data_wallet['description']; ?></p>
                <p><?php echo $date; ?></p>
              </div>
              <div class="transation-details-price">
                <h4><?php echo $transaction_type.''.$data_wallet['wh_amount']; ?></h4>
              </div>
            </div>

          </div>
        <?php } ?>
        </div>

      </div>
    </div>
  </div>
</div>
