<?php include 'config.php';

session_start();





$orders = $conn->query("SELECT * FROM confirm_order ") or die('query failed');
$orders_count = mysqli_num_rows( $orders );
$pending = $conn->query("SELECT * FROM confirm_order WHERE payment_status = 'pending'") or die('query failed');
$pending_count = mysqli_num_rows( $pending );
$complete = $conn->query("SELECT * FROM confirm_order WHERE payment_status = 'completed'") or die('query failed');
$complete_count = mysqli_num_rows( $complete );
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./css/admin.css" />
    <title>Book4U DP</title>
  </head>

  <body >
    <?php include'dp_header.php';?>
    <br/>
    
    <div class="main_box">
      <div class="card" style="width: 15rem">
      <?php
            // $total_pendings = 3;
            // $select_pending = mysqli_query($conn, "SELECT * FROM `confirm_order` WHERE payment_status = 'pending'") or die('query failed');
            // if(mysqli_num_rows($select_pending) > 0){
            //    while($fetch_pendings = mysqli_fetch_assoc($select_pending)){
            //       $total_price = $fetch_pendings['total_price'];
            //       $total_pendings += $total_price;
            //    };
            // };
         ?>
         
        <img class="card-img-top" src="./images/pen3.png" alt="Card image cap" /> 
        <div class="card-body">
          <h5 class="card-title">Number Of Pending Orders</h5>
          <p class="card-text"> 
          <?php echo $pending_count ?>
          </p>
          <div class="buttons" style="display: flex;">
          <a href="dp_p_orders.php" class="btn btn-primary">Details</a>
          </div>
        </div>
      </div>
      <div class="card" style="width: 15rem">
      <!-- <?php
            // $total_completed = 0;
            // $select_completed = mysqli_query($conn, "SELECT total_price FROM `confirm_order` WHERE payment_status = 'completed'") or die('query failed');
            // if(mysqli_num_rows($select_completed) > 0){
            //    while($fetch_completed = mysqli_fetch_assoc($select_completed)){
            //       $total_price = $fetch_completed['total_price'];
            //       $total_completed += $total_price;
            //    };
            // };
         ?> -->
        <img class="card-img-top" src="./images/compn.png" alt="Card image cap" />
        <div class="card-body">
          <h5 class="card-title">Number Of Completed Orders</h5>
          <p class="card-text">
          <?php echo $complete_count; ?>
          </p>
          <div class="buttons" style="display: flex;">
          <a href="dp_c_orders.php" class="btn btn-primary">Details</a>
          </div>
        </div>
      </div>
      <div class="card" style="width: 15rem">
        <img class="card-img-top" src="./images/orderpn.png" alt="Card image cap" />
        <div class="card-body">
          <h5 class="card-title">Number Of Orders Recived</h5>
          <p class="card-text">
          <?php echo $orders_count; ?>
          </p>
          <a href="dp_orders.php" class="btn btn-primary">Details</a>
        </div>
      </div>
    </div>  
  </body>
</html>
