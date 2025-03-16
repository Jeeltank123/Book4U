<?php
include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];
$user_name =$_SESSION['user_name'];

if(!isset($user_id)){
   header('location:login.php');
}


if(isset($_GET['remove'])){
    $remove_id=$_GET['remove'];
    mysqli_query($conn, "DELETE FROM `cart` WHERE id='$remove_id'") or die('query failed');
    $message[]='Removed Successfully';
    header('location:cart.php');
}
if(isset($_POST['update'])){
    $update_cart_id =$_POST['cart_id'];
    $book_price=$_POST['book_price'];
    $update_quantity =$_POST['update_quantity'];
    $total_price =$book_price * $update_quantity;
    mysqli_query($conn, "UPDATE `cart` SET `quantity`='$update_quantity', `total`='$total_price' WHERE `id`='$update_cart_id'") or die('query failed');
    
    $message[]=''.$user_name.' your cart updated successfully';
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="css/hello.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <style>
      /* Theme Variables */
/* Theme Variables */
:root {
  --primary-button-color: #ffa41c;
  --secondary-button-color: rgb(0, 167, 245);
  --message-bg-color: #fff;
  --message-border-color: rgb(68, 203, 236);
  --message-font-color: rgb(240, 18, 18);
  --icon-color: rgb(3, 227, 235);
  --button-hover-shadow: rgba(0, 0, 0, 0.2);
  --transition-duration: 0.3s;
  --focus-outline-color: rgba(0, 167, 245, 0.5);
  --btn-padding: 0.8rem 1.2rem;
  --btn-font-size: 15px;
  --btn-border-radius: 0.5rem;
  --message-width: 60%;
  --message-padding: 8px 12px;
  --message-border-radius-top: 8px;
  --message-border-radius-bottom: 8px;
}

/* Button Styles */
.cart-btn1,
.cart-btn2 {
  display: inline-block;
  margin: auto;
  padding: var(--btn-padding);
  cursor: pointer;
  font-size: var(--btn-font-size);
  border-radius: var(--btn-border-radius);
  color: white;
  text-transform: capitalize;
  transition: background var(--transition-duration) ease, 
              transform 0.2s ease, 
              box-shadow 0.2s ease;
}

.cart-btn1 {
  margin-left: 40%;
  background-color: var(--primary-button-color);
  color: #000;
}

.cart-btn2 {
  background-color: var(--secondary-button-color);
  color: #000;
}

/* Advanced Button Hover Effects */
.cart-btn1:hover,
.cart-btn2:hover {
  transform: translateY(-3px);
  box-shadow: 0 6px 12px var(--button-hover-shadow);
  filter: brightness(1.1);
}

.cart-btn1:active,
.cart-btn2:active {
  transform: translateY(1px);
  box-shadow: 0 2px 6px var(--button-hover-shadow);
}

/* Focus Accessibility */
.cart-btn1:focus,
.cart-btn2:focus {
  outline: 2px dashed var(--focus-outline-color);
  outline-offset: 3px;
}

/* Message Box Styles */
.message {
  position: sticky;
  top: 0;
  margin: 0 auto;
  width: var(--message-width);
  background-color: var(--message-bg-color);
  padding: var(--message-padding);
  display: flex;
  align-items: center;
  justify-content: space-between;
  z-index: 100;
  gap: 0.5rem;
  border: 2px solid var(--message-border-color);
  border-top-right-radius: var(--message-border-radius-top);
  border-bottom-left-radius: var(--message-border-radius-bottom);
  transition: box-shadow var(--transition-duration) ease, background-color var(--transition-duration) ease;
}

/* Message Box Hover Effect */
.message:hover {
  box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
  background-color: rgba(255, 255, 255, 0.95);
}

.message span {
  font-size: 22px;
  color: var(--message-font-color);
  font-weight: 400;
  transition: color var(--transition-duration) ease;
}

.message i {
  cursor: pointer;
  color: var(--icon-color);
  font-size: 20px;
  transition: color var(--transition-duration) ease, transform 0.2s ease;
}

.message i:hover {
  color: var(--message-font-color);
  transform: scale(1.2);
}

/* Focus for Icons */
.message i:focus {
  outline: 2px dashed var(--focus-outline-color);
  outline-offset: 2px;
}

/* Responsive Design */
@media (max-width: 768px) {
  .cart-btn1,
  .cart-btn2 {
    font-size: 14px;
    padding: 0.6rem 1rem;
    margin: 0.5rem 0;
  }

  .message {
    width: 90%;
    padding: 8px;
  }

  .message span {
    font-size: 18px;
  }

  .message i {
    font-size: 18px;
  }
}

/* Hover Animations with Keyframes */
@keyframes buttonHover {
  0% { transform: translateY(0); }
  50% { transform: translateY(-2px); }
  100% { transform: translateY(0); }
}

/* Apply Animation */
.cart-btn1:hover,
.cart-btn2:hover {
  animation: buttonHover 0.5s ease-in-out;
}



    </style>
</head>

<body>
    <?php
    include 'index_header.php';
    ?>
    <div class="cart_form">
    <?php
    if(isset($message)){
      foreach($message as $message){
        echo '
        <div class="message" id="messages"><span>'.$message.'</span>
        </div>
        ';
      }
    }
    ?>
        <table style="width: 70%; align-items:center; margin:10px auto;" >
            <thead>
                <th>Image</th>
                <th>Name</th>
                <th>price</th>
                <th>Quatity</th>
                <th>Total (₹)</th>
            </thead>
            <tbody>
                
                <?php
                $total = 0;
                $select_book = $conn->query("SELECT id, name,price, image ,quantity,total  FROM cart Where user_id= $user_id");
                if ($select_book->num_rows  > 0) {

                    while ($row = $select_book->fetch_assoc()) {
                ?>
                        <tr>
                            <td><img style="height: 90px;" src="./added_books/<?php echo $row['image']; ?>" alt=""></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['price']; ?></td>
                            <td>
                                <form action="" method="POST">
                                    <input type="number" name="update_quantity" min="1" max="10" value="<?php echo $row['quantity']; ?>">
                                    <input type="hidden" name="cart_id" value="<?php echo $row['id']; ?>">
                                    <input class="hidden_input" type="hidden" name="book_price" value="<?php echo $row['price'] ?>">
                                
                                <button style="background:transparent ;" name="update"><img style="height: 26px; cursor:pointer;" src="./images/update1.png" alt="update"></button> | 
                                <a style="color: red;" href="cart.php?remove=<?php echo $row['id'];?>"> Remove</a>
                                </form>
                           
                            
                        </td>
                            <td><?php $sub_total=$row['price']*$row['quantity']; echo $subtotal=number_format($row['price']*$row['quantity']); ?></td>
                            </tr>

                <?php
                $total += $sub_total;
                    }
                } else {
                    echo '<p class="empty">There is nothing in cart yet !!!!!!!!</p>';
                }
                ?>
                <tr>
                    <th style="text-align:center;" colspan="3">Total</th>
                    <th colspan="2">₹ <?php echo $total; ?>/- </th>

                </tr>
                
                
            </tbody>
        </table>
        <a href="checkout.php" class="btn cart-btn1" style="display:<?php if($total>1){ echo 'inline-block'; }else{ echo 'none'; };?>" > &nbsp; Proceed to Checkout</a> <a class="cart-btn2" href="index.php">Continue Shoping</a>
    </div>
    <?php include'index_footer.php'; ?>
    
    <script>
setTimeout(() => {
  const box = document.getElementById('messages');

  box.style.display = 'none';
}, 5000);
</script>

</body>

</html>