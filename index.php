<?php
include 'config.php';

error_reporting(0);
session_start();

$user_id = $_SESSION['user_id'];

if (isset($_POST['add_to_cart'])) {
    if (!isset($user_id)) {
        $message[] = 'Please Login to get your books';
    } else {
        $book_name = $_POST['book_name'];
        $book_id = $_POST['book_id'];
        $book_image = $_POST['book_image'];
        $book_price = $_POST['book_price'];
        $book_quantity = '1';

        $total_price = number_format($book_price * $book_quantity);

        $select_book = $conn->query("SELECT * FROM cart WHERE book_id= '$book_id' AND user_id='$user_id' ") or die('query failed');

        if (mysqli_num_rows($select_book) > 0) {
            $message[] = 'This Book is alredy in your cart';
        } else {
            $conn->query("INSERT INTO cart (`user_id`,`book_id`,`name`, `price`, `image`,`quantity` ,`total`) VALUES('$user_id','$book_id','$book_name','$book_price','$book_image','$book_quantity', '$total_price')") or die('Add to cart Query failed');
            $message[] = 'Book Added To Cart Successfully';
            header('location:index.php');
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
    <link rel="stylesheet" href="css/hello.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet" />
    <title>Book4U</title>

    <style>
       /* Global Reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    background-color: #f4f4f4; /* Light background for contrast */
    font-family: 'Arial', sans-serif;
    color: #333; /* Default text color */
}

/* Image Styling */
img {
    border: none; /* Remove default border */
    max-width: 100%; /* Ensure responsive images */
    height: auto; /* Maintain aspect ratio */
}

/* Message Box Styling */
.message {
    position: sticky;
    top: 0;
    margin: 20px auto; /* Centering the message box */
    width: 60%; /* Responsive width */
    background-color: #ffffff; /* White background */
    padding: 10px 15px; /* More padding for comfort */
    display: flex; /* Flexbox for alignment */
    align-items: center;
    justify-content: space-between; /* Space between items */
    z-index: 100;
    gap: 10px; /* Space between icon and text */
    border: 2px solid rgb(68, 203, 236); /* Border color */
    border-radius: 10px; /* Rounded corners for modern look */
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); /* Soft shadow for depth */
    transition: transform 0.3s ease, box-shadow 0.3s ease; /* Smooth transition */
}

.message:hover {
    transform: translateY(-2px); /* Slight lift on hover */
    box-shadow: 0 6px 30px rgba(0, 0, 0, 0.15); /* Enhanced shadow */
}

.message span {
    font-size: 18px; /* Smaller font size for readability */
    color: rgb(240, 18, 18); /* Message color */
    font-weight: 500; /* Medium weight for emphasis */
}

.message i {
    cursor: pointer; /* Pointer cursor for clickable icon */
    color: rgb(3, 227, 235); /* Icon color */
    font-size: 20px; /* Slightly larger icon */
    transition: color 0.3s ease; /* Smooth color transition */
}

.message i:hover {
    color: rgb(0, 200, 220); /* Change color on hover for feedback */
}

/* Carousel Styling */
.carousel-item, .active {
    width: 100%; /* Full width for responsive design */
    height: 70vh; /* Set height for consistent display */
    background-position: center; /* Center background images */
    background-size: cover; /* Cover to maintain aspect ratio */
    border-radius: 10px; /* Round corners for carousel items */
}

/* Responsive Design */
@media (max-width: 768px) {
    .message {
        width: 90%; /* Full width on smaller screens */
        padding: 8px 12px; /* Adjust padding for smaller screens */
    }
    
    .message span {
        font-size: 16px; /* Reduce font size for better readability */
    }

    .message i {
        font-size: 18px; /* Adjust icon size for mobile */
    }

    .carousel-item, .active {
        height: 50vh; /* Reduce height for mobile */
    }
}

    </style>
</head>

<body>
    <?php include 'index_header.php' ?>
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


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
    <div class="carousel-item active">
        <img class="d-block w-100 small-carousel-image" src="added_books\deadpool-vs-thanos-uhdpaper.com-4K-119.jpg" alt="First slide">
    </div>

    <div class="carousel-item">
        <img class="d-block w-100 small-carousel-image" src="added_books/joker2.jpg" alt="Second slide">
    </div>
    
    <div class="carousel-item">
        <img class="d-block w-100 small-carousel-image" src="added_books/joker.jpg" alt="Third slide">
    </div>
       </div>

        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <section id="New">

        <div class="container px-5 mx-auto">
            <h2 class="m-8 font-extrabold text-4xl text-center border-t-2 " style="color: rgb(0, 167, 245);">
                New Arrived
            </h2>
        </div>
    </section>
    <section class="show-products">
        <div class="box-container">

            <?php
            $select_book = mysqli_query($conn, "SELECT * FROM `book_info` ORDER BY date DESC LIMIT 8") or die('query failed');
            if (mysqli_num_rows($select_book) > 0) {
                while ($fetch_book = mysqli_fetch_assoc($select_book)) {
            ?>

                    <div class="box" style="width: 255px; height:355px;">
                        <a href="book_details.php?details=<?php echo $fetch_book['bid'];
                                                            echo '-name=', $fetch_book['name']; ?>"> <img style="height: 200px;width: 125px;margin: auto;" class="books_images" src="added_books/<?php echo $fetch_book['image']; ?>" alt=""></a>
                        <div style="text-align:left ;">

                            <div style="font-weight: 500; font-size:18px; text-align: center; " class="name"> <?php echo $fetch_book['name']; ?></div>
                        </div>
                        <div class="price">Price: ₹ <?php echo $fetch_book['price']; ?>/-</div>
                        <!-- <button name="add_cart"><img src="./images/cart2.png" alt=""></button> -->
                        <form action="" method="POST">
                            <input class="hidden_input" type="hidden" name="book_name" value="<?php echo $fetch_book['name'] ?>">
                            <input class="hidden_input" type="hidden" name="book_id" value="<?php echo $fetch_book['bid'] ?>">
                            <input class="hidden_input" type="hidden" name="book_image" value="<?php echo $fetch_book['image'] ?>">
                            <input class="hidden_input" type="hidden" name="book_price" value="<?php echo $fetch_book['price'] ?>">
                            <button onclick="myFunction()" name="add_to_cart"><img src="./images/cart2.png" alt="Add to cart">
                                <a href="book_details.php?details=<?php echo $fetch_book['bid'];
                                                                    echo '-name=', $fetch_book['name']; ?>" class="update_btn">Add to cart</a>
                        </form>
                        <!-- <button name="add_to_cart" ><img src="./images/cart2.png" alt="Add to cart"></button> -->
                        <!-- <input type="submit" name="add_cart" value="cart"> -->
                    </div>
            <?php
                }
            } else {
                echo '<p class="empty">no products added yet!</p>';
            }
            ?>
        </div>
    </section>
    <section id="Adventure">
        </div>

        <div class="container px-5 mx-auto">
            <h2 class="text-gray-400 m-8 font-extrabold text-4xl text-center border-t-2 text-red-800" style="color: rgb(0, 167, 245);" >
                Adventure
            </h2>
        </div>
    </section>
    <section class="show-products">
        <div class="box-container">

            <?php
            $select_book = mysqli_query($conn, "SELECT * FROM `book_info` where category='Adventure'") or die('query failed');
            if (mysqli_num_rows($select_book) > 0) {
                while ($fetch_book = mysqli_fetch_assoc($select_book)) {
            ?>

                    <div class="box" style="width: 255px;height: 355px;">
                        <a href="book_details.php?details=<?php echo $fetch_book['bid'];
                                                            echo '-name=', $fetch_book['name']; ?>"> <img style="height: 200px;width: 125px;margin: auto;" class="books_images" src="added_books/<?php echo $fetch_book['image']; ?>" alt=""></a>
                        <div style="text-align:left ;">

                            <div style="font-weight: 500; font-size:18px; text-align: center; " class="name"> <?php echo $fetch_book['name']; ?></div>
                        </div>
                        <div class="price">Price: ₹ <?php echo $fetch_book['price']; ?>/-</div>
                        <form action="" method="POST">
                            <input class="hidden_input" type="hidden" name="book_name" value="<?php echo $fetch_book['name'] ?>">
                            <input class="hidden_input" type="hidden" name="book_image" value="<?php echo $fetch_book['image'] ?>">
                            <input class="hidden_input" type="hidden" name="book_price" value="<?php echo $fetch_book['price'] ?>">
                            <button name="add_to_cart"><img src="./images/cart2.png" alt="Add to cart">
                                <a href="book_details.php?details=<?php echo $fetch_book['bid'];
                                                                    echo '-name=', $fetch_book['name']; ?>" class="update_btn">Add to cart</a>
                        </form>
                    </div>
            <?php
                }
            } else {
                echo '<p class="empty">no products added yet!</p>';
            }
            ?>
        </div>
    </section>
    <hr style="color: black; width:5px;">
    <section id="Magical">

        <div class="container px-5 mx-auto">
            <h2 class="text-gray-400 m-8 font-extrabold text-4xl text-center border-t-2 text-red-800"style="color: rgb(0, 167, 245);">
                Magical
            </h2>
        </div>
    </section>
    <section class="show-products">
        <div class="box-container">

            <?php
            $select_book = mysqli_query($conn, "SELECT * FROM `book_info` where category='Magic'") or die('query failed');
            if (mysqli_num_rows($select_book) > 0) {
                while ($fetch_book = mysqli_fetch_assoc($select_book)) {
            ?>

                    <div class="box" style="width: 255px;height: 355px;">
                        <a href="book_details.php?details=<?php echo $fetch_book['bid'];
                                                            echo '-name=', $fetch_book['name']; ?>"> <img style="height: 200px;width: 125px;margin: auto;" class="books_images" src="added_books/<?php echo $fetch_book['image']; ?>" alt=""></a>
                        <div style="text-align:left ;">

                            <div style="font-weight: 500; font-size:18px; text-align: center;" class="name"> <?php echo $fetch_book['name']; ?></div>
                        </div>
                        <div class="price">Price: ₹ <?php echo $fetch_book['price']; ?>/-</div>
                        <form action="" method="POST">
                            <input class="hidden_input" type="hidden" name="book_name" value="<?php echo $fetch_book['name'] ?>">
                            <input class="hidden_input" type="hidden" name="book_image" value="<?php echo $fetch_book['image'] ?>">
                            <input class="hidden_input" type="hidden" name="book_price" value="<?php echo $fetch_book['price'] ?>">
                            <button name="add_to_cart"><img src="./images/cart2.png" alt="Add to cart">
                                <a href="book_details.php?details=<?php echo $fetch_book['bid'];
                                                                    echo '-name=', $fetch_book['name']; ?>" class="update_btn">Add to cart</a>
                        </form>
                    </div>
            <?php
                }
            } else {
                echo '<p class="empty">no products added yet!</p>';
            }
            ?>
        </div>
    </section>
    <section id="Knowledge">

        <div class="container px-5 mx-auto">
            <h2 class="text-gray-400 m-8 font-extrabold text-4xl text-center border-t-2 text-red-800" style="color: rgb(0, 167, 245);">
                Knowledge
            </h2>
        </div>
    </section>
    <section class="show-products">
        <div class="box-container">

            <?php
            $select_book = mysqli_query($conn, "SELECT * FROM `book_info` Where category='knowledge'") or die('query failed');
            if (mysqli_num_rows($select_book) > 0) {
                while ($fetch_book = mysqli_fetch_assoc($select_book)) {
            ?>

                    <div class="box" style="width: 255px;height: 355px;">
                        <a href="book_details.php?details=<?php echo $fetch_book['bid'];
                                                            echo '-name=', $fetch_book['name']; ?>"> <img style="height: 200px;width: 125px;margin: auto;" class="books_images" src="added_books/<?php echo $fetch_book['image']; ?>" alt=""></a>
                        <div style="text-align:left ;">

                            <div style="font-weight: 500; font-size:18px; text-align: center;" class="name"> <?php echo $fetch_book['name']; ?></div>
                        </div>
                        <div class="price">Price: ₹ <?php echo $fetch_book['price']; ?>/-</div>
                        <form action="" method="POST">
                            <input class="hidden_input" type="hidden" name="book_name" value="<?php echo $fetch_book['name'] ?>">
                            <input class="hidden_input" type="hidden" name="book_image" value="<?php echo $fetch_book['image'] ?>">
                            <input class="hidden_input" type="hidden" name="book_price" value="<?php echo $fetch_book['price'] ?>">
                            <button name="add_to_cart"><img src="./images/cart2.png" alt="Add to cart">
                                <a href="book_details.php?details=<?php echo $fetch_book['bid'];
                                                                    echo '-name=', $fetch_book['name']; ?>" class="update_btn">Add to cart</a>
                        </form>
                    </div>
            <?php
                }
            } else {
                echo '<p class="empty">no products added yet!</p>';
            }
            ?>
        </div>
    </section>
    <?php include 'index_footer.php'; ?>

    <script>
        setTimeout(() => {
            const box = document.getElementById('messages');

            box.style.display = 'none';
        }, 8000);
    </script>


</body>
</html>