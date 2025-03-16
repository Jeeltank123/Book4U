<?php

include 'config.php';

// session_start();

// $admin_id = $_SESSION['admin_id'];

// if (!isset($admin_id)) {
//    header('location:login.php');
// }


if (isset($_POST['update_order'])) {

   $order_update_id = $_POST['order_id'];
   $update_payment = $_POST['update_payment'];
   $date = date("d.m.Y");
   mysqli_query($conn, "UPDATE `confirm_order` SET payment_status = '$update_payment',date='$date' WHERE order_id = '$order_update_id'") or die('query failed');
   $message[] = 'Payment status has been updated!';
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
   <title>Orders</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<style>/* Modern Theme CSS */
:root {
  --primary-color: #4CAF50;
  --secondary-color: #f44336;
  --text-color: #333;
  --background-color: #f9f9f9;
  --border-color: #ddd;
  --message-bg-color: #333;
  --message-text-color: #fff;
}

/* Reset */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: Arial, sans-serif;
}

body {
  background-color: var(--background-color);
  color: var(--text-color);
}

/* Message Styles */
.message {
  position: fixed;
  top: 1rem;
  left: 50%;
  transform: translateX(-50%);
  background-color: var(--message-bg-color);
  color: var(--message-text-color);
  padding: 1rem 1.5rem;
  border-radius: 8px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
  display: flex;
  align-items: center;
  font-size: 1rem;
  animation: fadeOut 8s forwards;
}

@keyframes fadeOut {
  0% { opacity: 1; }
  80% { opacity: 1; }
  100% { opacity: 0; }
}

/* Title */
.placed-orders .title {
  text-align: center;
  font-size: 2rem;
  margin: 2rem 0;
  color: var(--primary-color);
}

/* Orders Section */
.placed-orders .box-container {
  max-width: 1000px;
  margin: 0 auto;
  display: grid;
  gap: 1rem;
  padding: 1rem;
}

.placed-orders .box {
  background-color: #fff;
  padding: 1.5rem;
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  border: 1px solid var(--border-color);
  transition: transform 0.3s, box-shadow 0.3s;
}

.placed-orders .box:hover {
  transform: translateY(-5px);
  box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
}

.placed-orders .box p {
  margin: 0.5rem 0;
  color: var(--text-color);
}

.placed-orders .box span {
  font-weight: bold;
  color: var(--primary-color);
}

/* Buttons */
.button {
  display: inline-block;
  padding: 0.5rem 1rem;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  font-size: 0.9rem;
  text-align: center;
  transition: background-color 0.3s;
}

.button.primary {
  background-color: var(--primary-color);
  color: #fff;
}

.button.secondary {
  background-color: red;
  color: #fff;
}

.button:hover {
  opacity: 0.9;
}

.empty {
  font-size: 1.2rem;
  text-align: center;
  color: var(--text-color);
  margin: 2rem;
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
      <h1 class="title">Completed Orders</h1>
      <div class="box-container">
         <?php
         $select_orders = mysqli_query($conn, "SELECT * FROM `confirm_order` WHERE `payment_status` = 'completed'") or die('query failed');
         if (mysqli_num_rows($select_orders) > 0) {
            while ($fetch_book = mysqli_fetch_assoc($select_orders)) {
         ?>
               <div class="box">
                  <p> Order Date: <span><?php echo $fetch_book['order_date']; ?></span> </p>
                  <p> Order ID: <span>#<?php echo $fetch_book['order_id']; ?></span> </p>
                  <p> Name: <span><?php echo $fetch_book['name']; ?></span> </p>
                  <p> Mobile Number: <span><?php echo $fetch_book['number']; ?></span> </p>
                  <p> Email ID: <span><?php echo $fetch_book['email']; ?></span> </p>
                  <p> Address: <span><?php echo $fetch_book['address']; ?></span> </p>
                  <p> Payment Method: <span><?php echo $fetch_book['payment_method']; ?></span> </p>
                  <p> Your Orders: <span><?php echo $fetch_book['total_books']; ?></span> </p>
                  <p> Total Price: <span>₹ <?php echo $fetch_book['total_price']; ?>/-</span> </p>
                  <form action="" method="post">
                     <input type="hidden" name="order_id" value="<?php echo $fetch_book['order_id']; ?>">
                     <p>
      Payment Status :
      <span class="payment-status <?php echo $fetch_book['payment_status'] === 'completed' ? 'completed' : 'pending'; ?>"style="color:<?php if ($fetch_book['payment_status']=='completed') {echo 'green';}else{echo 'red';}?>">
         <?php echo $fetch_book['payment_status']; ?>
      </span>
   </p>
                     Payment Status: <select name="update_payment">
                        <option value="" selected disabled><?php echo $fetch_book['payment_status']; ?></option>
                        <option value="pending">Pending</option>
                        <option value="completed">Completed</option>
                     </select>
                     
                     
                     <input type="submit" value="Update" name="update_order" class="button primary">
                  </form>
               </div>
         <?php
            }
         } else {
            echo '<p class="empty">No pending orders placed yet!</p>';
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
