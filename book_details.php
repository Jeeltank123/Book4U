<?php
include 'config.php';
error_reporting(0);
session_start();

$user_id = $_SESSION['user_id'];

if (isset($_POST['add_to_cart'])) {
    if(!isset($user_id)){
        $message[]= 'Please Login to get your books';
     }else{
    $book_name = $_POST['book_name'];
    $book_id = $_POST['book_id'];
    $book_image = $_POST['book_image'];
    $book_price = $_POST['book_price'];
    $book_quantity = $_POST['quantity'];
    $total_price =number_format($book_price * $book_quantity);
    $select_book = $conn->query("SELECT * FROM cart WHERE name= '$book_name' AND user_id='$user_id' ") or die('query failed');

    if (mysqli_num_rows($select_book) > 0) {
        $message[] = 'This Book is alredy in your cart';
    } else {
        $conn->query("INSERT INTO cart (`book_id`,`user_id`,`name`, `price`, `image`, `quantity` ,`total`) VALUES('$book_id','$user_id','$book_name','$book_price','$book_image','$book_quantity', '$total_price')") or die('Add to cart Query failed');
        $message[] = 'Book Added To Cart Successfully';
    }
}

}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/index_book.css">
    <title>Selected Products</title>

    <style>
    :root {
  --message-bg-color: #ffffff;
  --border-color: rgb(68, 203, 236);
  --text-color: rgb(240, 18, 18);
  --icon-color: rgb(3, 227, 235);
  --padding: 0.75rem 1rem;
  --border-radius-top: 8px;
  --border-radius-bottom: 8px;
  --transition-speed: 0.3s;
}

.message {
  position: sticky;
  top: 0;
  margin: 0 auto;
  width: 60%;
  background-color: var(--message-bg-color);
  padding: var(--padding);
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 1rem;
  border: 2px solid var(--border-color);
  border-top-right-radius: var(--border-radius-top);
  border-bottom-left-radius: var(--border-radius-bottom);
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
  z-index: 100;
  transition: transform var(--transition-speed), box-shadow var(--transition-speed);
}

.message:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
}

.message span {
  font-size: 1.375rem; /* 22px */
  color: var(--text-color);
  font-weight: 500;
  margin-right: auto;
  transition: color var(--transition-speed);
}

.message span:hover {
  color: rgb(200, 18, 18); /* Slightly darker on hover */
}

.message i {
  cursor: pointer;
  color: var(--icon-color);
  font-size: 1rem; /* 16px */
  padding: 0.25rem;
  transition: color var(--transition-speed), transform var(--transition-speed);
}

.message i:hover {
  color: rgb(0, 190, 200); /* Slightly darker on hover */
  transform: scale(1.1);
}

    </style>
</head>

<body>
    <?php
    include 'index_header.php';
    ?>
        <?php
    if(isset($message)){
      foreach($message as $message){
        echo '
        <div class="message" id= "messages"><span>'.$message.'</span>
        </div>
        ';
      }
    }
    ?>
    <div class="details">
        <?php
        if (isset($_GET['details'])) {
            $get_id = $_GET['details'];
            $get_book = mysqli_query($conn, "SELECT * FROM `book_info` WHERE bid = '$get_id'") or die('query failed');
            if (mysqli_num_rows($get_book) > 0) {
                while ($fetch_book = mysqli_fetch_assoc($get_book)) {
        ?>
                    <div class="row_box">
                        <form style="display: flex ;" action="" method="POST">
                            <div class="col_box">
                                <img src="./added_books/<?php echo $fetch_book['image']; ?>" alt="<?php echo $fetch_book['name']; ?>">
                            </div>
                            <div class="col_box">
                                <h4>Author: <?php echo $fetch_book['title']; ?></h4>
                                <h1>Name: <?php echo $fetch_book['name']; ?></h1>
                                <h3>Price: ₹ <?php echo $fetch_book['price']; ?>/-</h3>
                                <label for="quantity">Quantity:</label>
                                <input type="number" name="quantity" value="1" min="1" max="10" id="quantity">
                                <div class="buttons">


                                    <input class="hidden_input" type="hidden" name="book_name" value="<?php echo $fetch_book['name'] ?>">
                                    <input class="hidden_input" type="hidden" name="book_id" value="<?php echo $fetch_book['bid'] ?>">
                                    <input class="hidden_input" type="hidden" name="book_image" value="<?php echo $fetch_book['image'] ?>">
                                    <input class="hidden_input" type="hidden" name="book_price" value="<?php echo $fetch_book['price'] ?>">
                                    <input type="submit" name="add_to_cart" value="Add To Cart" class="btn">
                                    <button name="add_to_cart" ><img style="height: 40px;" src="./images/cart1.png" alt="Add to cart"></button>
                                </div>
                                <h3>Book Details</h3>
                                <p><?php echo $fetch_book['description']; ?></p>
                            </div>
                        </form>
                    </div>
        <?php
                }
            }
        } else {
            echo '<script>document.querySelector(".edit-product-form").style.display = "none";</script>';
        }
        ?>
    </div>
    <script src="./js/admin.js"></script>
    <script>
setTimeout(() => {
  const box = document.getElementById('messages');

  box.style.display = 'none';
}, 5000);
</script>
</body>

</html>