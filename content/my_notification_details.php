<?php 
if(!isset($_SESSION['user_id'])){
    echo "<script>window.location.href='index.php'</script>";
}

$qry_profile = "SELECT * FROM user_registration WHERE ID='".$_SESSION['user_id']."'"; 
$result_profile = mysqli_query($con,$qry_profile);
$row_profile = mysqli_fetch_assoc($result_profile);

$query_notification="SELECT * FROM `notification` n
WHERE n.user_id = '".$_SESSION['user_id']."'
ORDER BY n.ID DESC";

$sql_notification = mysqli_query($con,$query_notification)or die(mysqli_error());

?>
<div class="bonitaa_wallet_box">
  <div class="container" style="margin-top: 0px; margin-bottom:0px;">
    <div class="row">
      <div class="col-xl-12 col-md-12 col-sm-12 col-lg-12">
     
        <div class="transation-history">
          <h5>Notification History</h5>
            <img src="images/line.png" alt="" class="line">
        </div>
        <div class="main-transaction-outer">
        <?php 
        while($data_notification = mysqli_fetch_assoc($sql_notification))
		{	
		 
		    $newdate = date("d M, Y H:i:s", strtotime($data_notification['date']));
            
            if($data_notification['date'] == "")
            {
                $date = '';
            }else{
                $date = $newdate;
            }
        ?>
          <div class="transation-details-box">
            <div class="line-box">
              <div class="transation-details-text">
                <h4><?php echo $data_notification['tittle']; ?></h4>  
                <p><?php echo $data_notification['msg']; ?></p>
                <p><?php echo $date; ?></p>
              </div>
            </div>

          </div>
        <?php } ?>
        </div>

      </div>
    </div>
  </div>
</div>
