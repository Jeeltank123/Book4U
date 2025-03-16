<?php
include 'config.php';
session_start();

$admin_id = $_SESSION['admin_id'];
if (!isset($admin_id)) {
    header('location:login.php');
}

if (isset($_POST['add_books'])) {
    $bname = mysqli_real_escape_string($conn, $_POST['bname']);
    $btitle = mysqli_real_escape_string($conn, $_POST['btitle']);
    $category = mysqli_real_escape_string($conn, $_POST['Category']);
    $price = $_POST['price'];
    $desc = mysqli_real_escape_string($conn, ($_POST['bdesc']));
    $img = $_FILES["image"]["name"];
    $img_temp_name = $_FILES["image"]["tmp_name"];
    $img_file = "./added_books/" . $img;

    if (empty($bname) || empty($btitle) || empty($price) || empty($category) || empty($desc) || empty($img)) {
        $message[] = 'Please fill in all fields';
    } else {
        $add_book = mysqli_query($conn, "INSERT INTO book_info(`name`, `title`, `price`, `category`, `description`, `image`) VALUES('$bname','$btitle','$price','$category','$desc','$img')") or die('Query failed');
        if ($add_book) {
            move_uploaded_file($img_temp_name, $img_file);
            $message[] = 'New Book Added Successfully';
        } else {
            $message[] = 'Book Not Added Successfully';
        }
    }
}

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `book_info` WHERE bid = '$delete_id'") or die('query failed');
    header('location:add_books.php');
}

if (isset($_POST['update_product'])) {
    $update_p_id = $_POST['update_p_id'];
    $update_name = $_POST['update_name'];
    $update_title = $_POST['update_title'];
    $update_description = $_POST['update_description'];
    $update_price = $_POST['update_price'];
    $update_category = $_POST['update_category'];

    mysqli_query($conn, "UPDATE `book_info` SET name = '$update_name', title='$update_title', description ='$update_description', price = '$update_price', category='$update_category' WHERE bid = '$update_p_id'") or die('query failed');

    $update_image = $_FILES['update_image']['name'];
    $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
    $update_image_size = $_FILES['update_image']['size'];
    $update_folder = './added_books/' . $update_image;
    $update_old_image = $_POST['update_old_image'];

    if (!empty($update_image)) {
        if ($update_image_size > 2000000) {
            $message[] = 'Image file size is too large';
        } else {
            mysqli_query($conn, "UPDATE `book_info` SET image = '$update_image' WHERE bid = '$update_p_id'") or die('query failed');
            move_uploaded_file($update_image_tmp_name, $update_folder);
            unlink('added_books/' . $update_old_image);
        }
    }

    header('location:./add_books.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/register.css">
  <title>Add Books</title>
</head>
<body>
  <?php include './admin_header.php'; ?>
  <?php if (isset($message)): foreach ($message as $msg): ?>
      <div class="message" id="messages"><span><?= $msg ?></span></div>
  <?php endforeach; endif; ?>

  <a class="update_btn" style="position: fixed ; z-index:100;" href="total_books.php">See All Books</a>
  <div class="container_box">
    <form action="" method="POST" enctype="multipart/form-data">
      <h3>Add Books To <a href="index.php"><span>Book</span><span>4U</span></a></h3>
      <input type="text" name="bname" placeholder="Enter book Name" class="text_field ">
      <input type="text" name="btitle" placeholder="Enter Author name" class="text_field">
      <input type="number" min="0" name="price" class="text_field" placeholder="Enter product price">
      <input type="text" name="Category" class="text_field" placeholder="Enter Category">
      <textarea name="bdesc" placeholder="Enter book description" class="text_field" cols="18" rows="5"></textarea>
      <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" class="text_field">
      <input type="submit" value="Add Book" name="add_books" class="btn text_field">
    </form>
  </div>

  <section class="show-products">
    <div class="box-container">
      <?php
      $select_book = mysqli_query($conn, "SELECT * FROM book_info ORDER BY date DESC LIMIT 2;") or die('query failed');
      if (mysqli_num_rows($select_book) > 0):
          while ($fetch_book = mysqli_fetch_assoc($select_book)): ?>
              <div class="box">
                <img class="books_images" src="added_books/<?= $fetch_book['image'] ?>" alt="">
                <div class="name">Author: <?= $fetch_book['title'] ?></div>
                <div class="name">Name: <?= $fetch_book['name'] ?></div>
                <div class="price">Price: ₹ <?= $fetch_book['price'] ?>/-</div>
                <a href="add_books.php?update=<?= $fetch_book['bid'] ?>" class="update_btn">Update</a>
                <a href="add_books.php?delete=<?= $fetch_book['bid'] ?>" class="delete_btn" onclick="return confirm('Delete this product?');">Delete</a>
              </div>
          <?php endwhile;
      else: ?>
          <p class="empty">No books added yet!</p>
      <?php endif; ?>
    </div>
  </section>

  <?php if (isset($_GET['update'])): ?>
    <section class="edit-product-form">
      <?php
      $update_id = $_GET['update'];
      $update_query = mysqli_query($conn, "SELECT * FROM `book_info` WHERE bid = '$update_id'") or die('query failed');
      if (mysqli_num_rows($update_query) > 0):
          while ($fetch_update = mysqli_fetch_assoc($update_query)): ?>
              <form action="" method="post" enctype="multipart/form-data">
                  <input type="hidden" name="update_p_id" value="<?= $fetch_update['bid'] ?>">
                  <input type="hidden" name="update_old_image" value="<?= $fetch_update['image'] ?>">
                  <img src="./added_books/<?= $fetch_update['image'] ?>" width="350px" height="500px" alt="">
                  <input type="text" name="update_name" value="<?= $fetch_update['name'] ?>" class="box" required placeholder="Enter Book Name">
                  <input type="text" name="update_title" value="<?= $fetch_update['title'] ?>" class="box" required placeholder="Enter Author Name">
                  <select name="update_category" class="box">
                      <option value="Adventure" <?= $fetch_update['category'] == 'Adventure' ? 'selected' : '' ?>>Adventure</option>
                      <option value="Magic" <?= $fetch_update['category'] == 'Magic' ? 'selected' : '' ?>>Magic</option>
                      <option value="Knowledge" <?= $fetch_update['category'] == 'Knowledge' ? 'selected' : '' ?>>Knowledge</option>
                  </select>
                  <input type="text" name="update_description" value="<?= $fetch_update['description'] ?>" class="box" required placeholder="Enter Product Description">
                  <input type="number" name="update_price" value="<?= $fetch_update['price'] ?>" min="0" class="box" required placeholder="Enter Product Price">
                  <input type="file" class="box" name="update_image" accept="image/jpg, image/jpeg, image/png">
                  <input type="submit" value="Update" name="update_product" class="delete_btn">
                  <input type="reset" value="Cancel" id="close-update" class="update_btn">
              </form>
          <?php endwhile;
      else: ?>
          <script>document.querySelector(".edit-product-form").style.display = "none";</script>
      <?php endif; ?>
    </section>
  <?php endif; ?>

  <script src="./js/admin.js"></script>
  <script>
    setTimeout(() => {
      const box = document.getElementById('messages');
      if (box) box.style.display = 'none';
    }, 8000);
  </script>
</body>
</html>
