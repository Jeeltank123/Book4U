<?php

include 'config.php';



if (isset($_POST['update_order'])) {

   $order_update_id = $_POST['order_id'];
   $update_payment = $_POST['update_payment'];
   $date = date("d.m.Y");
   mysqli_query($conn, "UPDATE `confirm_order` SET payment_status = '$update_payment',date='$date' WHERE order_id = '$order_update_id'") or die('query failed');
   $message[] = 'payment status has been updated!';
}

if (isset($_GET['delete'])) {
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `confirm_order` WHERE order_id = '$delete_id'") or die('query failed');
   header('location:admin_orders.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>orders</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="./css/hello.css">

   <style>
      /* CSS Variables for Theme */
      :root {
  --primary-color: #ffa41c;
  --secondary-color: #e74c3c;
  --text-color: #333;
  --border-color: #09daff;
  --message-bg-color: #fff;
  --message-border-color: #44cbec;
  --message-text-color: #f01212;
  --message-icon-color: #03e3eb;
}

/* General Styles */
*,
*::before,
*::after {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}

body {
  font-family: Arial, sans-serif;
  line-height: 1.6;
  color: var(--text-color);
}

/* Cart Button Styles */
.cart-btn1,
.cart-btn2 {
  display: inline-block;
  margin-top: 0.4rem;
  padding: 0.3rem 1rem;
  cursor: pointer;
  color: #fff;
  font-size: 16px;
  font-weight: 500;
  border-radius: 0.5rem;
  text-transform: capitalize;
  transition: background-color 0.3s ease, transform 0.2s ease, box-shadow 0.2s ease;
}

.cart-btn1 {
  margin-left: 40%;
  background-color: var(--secondary-color);
}

.cart-btn2 {
  background-color: var(--primary-color);
  color: #000;
}

.cart-btn1:hover,
.cart-btn2:hover {
  transform: scale(1.05);
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

/* Orders Section */
.placed-orders .title {
  text-align: center;
  margin-bottom: 20px;
  text-transform: uppercase;
  color: #000;
  font-size: 2.5rem;
  font-weight: bold;
}

.placed-orders .box-container {
  max-width: 1200px;
  margin: 0 auto;
  display: flex;
  flex-wrap: wrap;
  align-items: stretch;
  gap: 20px;
  padding: 10px;
}

.placed-orders .box-container .empty {
  flex: 1;
  font-size: 1.5rem;
  color: var(--secondary-color);
  text-align: center;
  padding: 20px;
}

.placed-orders .box-container .box {
  flex: 1 1 400px;
  border-radius: 0.5rem;
  padding: 20px;
  background-color: #fff;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
  border: 2px solid var(--border-color);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.placed-orders .box-container .box:hover {
  transform: translateY(-8px);
  box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
}

.placed-orders .box-container .box p {
  padding-top: 10px;
  font-size: 1.2rem;
  color: var(--text-color);
  line-height: 1.6;
}

.placed-orders .box-container .box p span {
  color: #666;
  font-weight: 500;
}

/* Message Styles */
.message {
  position: sticky;
  top: 0;
  margin: 0 auto;
  width: 60%;
  background-color: var(--message-bg-color);
  padding: 10px 16px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  z-index: 100;
  border: 2px solid var(--message-border-color);
  border-top-right-radius: 8px;
  border-bottom-left-radius: 8px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.message:hover {
  transform: scale(1.02);
  box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
}

.message span {
  font-size: 1.4rem;
  color: var(--message-text-color);
  font-weight: 500;
}

.message i {
  cursor: pointer;
  color: var(--message-icon-color);
  font-size: 1.2rem;
  transition: color 0.2s ease, transform 0.2s ease;
}

.message i:hover {
  color: var(--secondary-color);
  transform: scale(1.2);
}

/* Media Queries */
@media (max-width: 768px) {
  .cart-btn1,
  .cart-btn2 {
    font-size: 14px;
    padding: 0.2rem 0.6rem;
  }

  .placed-orders .title {
    font-size: 2rem;
  }

  .placed-orders .box-container {
    flex-direction: column;
    gap: 15px;
    padding: 5px;
  }

  .message {
    width: 90%;
    padding: 8px 10px;
  }

  .message span {
    font-size: 1.2rem;
  }
}
    
   </style>

</head>
<body>

   <?php include 'dp_header.php'; ?>
   <?php
   if (isset($message)) {
      foreach ($message as $message) {
         echo '
        <div class="message" id= "messages"><span>' . $message . '</span>
        </div>
        ';
      }
   }
   ?>

   <section class="placed-orders">

      <h1 class="title">placed orders</h1>

      <div class="box-container">
         <?php
         $select_orders = mysqli_query($conn, "SELECT * FROM `confirm_order`") or die('query failed');
         if (mysqli_num_rows($select_orders) > 0) {
            while ($fetch_book = mysqli_fetch_assoc($select_orders)) {
         ?>
               <div class="box">
                  <p> Order Date : <span><?php echo $fetch_book['order_date']; ?></span> </p>
                  <p> Order Id : <span>#<?php echo $fetch_book['order_id']; ?> </p>
                  <p> Name : <span><?php echo $fetch_book['name']; ?></span> </p>
                  <p> Mobile Number : <span><?php echo $fetch_book['number']; ?></span> </p>
                  <p> Email Id : <span><?php echo $fetch_book['email']; ?></span> </p>
                  <p> Address : <span><?php echo $fetch_book['address']; ?></span> </p>
                  <p> Payment Method : <span><?php echo $fetch_book['payment_method']; ?></span> </p>
                  <p> Your orders : <span><?php echo $fetch_book['total_books']; ?></span> </p>
                  <p> Total price : <span>₹ <?php echo $fetch_book['total_price']; ?>/-</span> </p>
                  <form action="" method="post">
   <input type="hidden" name="order_id" value="<?php echo $fetch_book['order_id']; ?>">
   <p>
      Payment Status :
      <span class="payment-status <?php echo $fetch_book['payment_status'] === 'completed' ? 'completed' : 'pending'; ?>"style="color:<?php if ($fetch_book['payment_status']=='completed') {echo 'green';}else{echo 'red';}?>">
         <?php echo $fetch_book['payment_status']; ?>
      </span>
   </p>
</form>

               </div>
         <?php
            }
         } else {
            echo '<p class="empty">no orders placed yet!</p>';
         }
         ?>
      </div>

   </section>


   <script src="js/admin_script.js"></script>
   <script>
      setTimeout(() => {
         const box = document.getElementById('messages');

         box.style.display = 'none';
      }, 8000);
   </script>

</body>

</html>