<?php
include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
}

// Update User Details
if (isset($_POST['update_user'])) {
    $update_id = $_POST['update_id'];
    $update_name = $_POST['update_name'];
    $update_sname = $_POST['update_sname'];
    $update_email = $_POST['update_email'];
    $update_password = $_POST['update_password'];
    $update_user_type = $_POST['update_user_type'];

    mysqli_query($conn, "UPDATE `users_info` SET name = '$update_name', surname='$update_sname', email ='$update_email', password = '$update_password', user_type='$update_user_type' WHERE Id = '$update_id'") or die('query failed');

    header('location:./users_detail.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/register.css">
    <link rel="stylesheet" href="./css/index_book.css">
    <title>Admin User Data</title>
</head>

<body>
    <?php include 'admin_header.php'; ?>
    <center>
  <div class="card" style="width: 12rem;height: 220px; padding: 10px; margin: 5px;">
  <img class="card-img-top" src="./images/userspm.png" alt="Card image cap" style="height: 100px; object-fit: cover;" />
  <div class="card-body" style="padding: 8px;">
    <h6 class="card-title" style="font-size: 1rem;">Add New Admin</h6>
    <a href="addadmin.php" class="btn btn-primary btn-sm">Add >></a>
  </div>
</div>
</center>

    <section class="show-products">
        <div class="box-container">
            <?php
            $select_user = mysqli_query($conn, "SELECT Id, name, surname, email, password, user_type FROM users_info WHERE user_type = 'Admin'") or die('query failed');
            if (mysqli_num_rows($select_user) > 0) {
                while ($fetch_user = mysqli_fetch_assoc($select_user)) {
            ?>
                <div class="box">
                    <div class="name">User ID: <?php echo $fetch_user['Id']; ?></div>
                    <div class="name">Name: <?php echo $fetch_user['name']; ?> <?php echo $fetch_user['surname']; ?></div>
                    <div class="name">Email ID: <?php echo $fetch_user['email']; ?></div>
                    <div class="password">Password: <?php echo $fetch_user['password']; ?></div>
                    <div class="price" style="color: red;">User type: <?php echo $fetch_user['user_type']; ?></div>
                    <?php $admin_no = $conn->query("SELECT * FROM users_info WHERE user_type='Admin' ") or die('query failed');
$admin_count = mysqli_num_rows( $admin_no ); if ($admin_count > 1){ ?>
                    <a href="users_detail.php?delete_user=<?php echo $fetch_user['Id']; ?>" onclick="return confirm('Are you sure you want to delete this admin?');">Delete</a>
                    <a style="color:rgb(255, 187, 0);" href="users_detail2.php?update_user=<?php echo $fetch_user['Id']; ?>">Update</a>

                    <?php } ?>
                </div>
            <?php
                }
            } else {
                echo '<p class="empty">No Admin users found!</p>';
            }
            ?>
        </div>
    </section>

    <section class="edit_user-form">
        <div class="edit-product-form">
            <?php
            if (isset($_GET['update_user'])) {
                $update_id = $_GET['update_user'];
                $update_query = mysqli_query($conn, "SELECT * FROM `users_info` WHERE Id = '$update_id' AND user_type = 'Admin'") or die('query failed');
                if (mysqli_num_rows($update_query) > 0) {
                    while ($fetch_update = mysqli_fetch_assoc($update_query)) {
            ?>
                        <form action="" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="update_id" value="<?php echo $fetch_update['Id']; ?>">
                            <input type="text" value="<?php echo $fetch_update['name'] ?>" name="update_name" placeholder="Enter Name" required class="box">
                            <input type="text" value="<?php echo $fetch_update['surname'] ?>" name="update_sname" placeholder="Enter Surname" required class="box">
                            <input type="email" value="<?php echo $fetch_update['email'] ?>" name="update_email" placeholder="Enter Email Id" required class="box">
                            <input type="password" value="<?php echo $fetch_update['password'] ?>" name="update_password" placeholder="Enter Password" required class="box">
                            <select name="update_user_type" required class="box">
                                <option value="Admin" selected>Admin</option>
                                <option value="User" selected>User</option>

                            </select>
                            <input type="submit" value="Update" name="update_user" class="delete_btn">
                            <input type="reset" value="Cancel" id="close-update_user" class="update_btn">
                        </form>
            <?php
                    }
                }
            } else {
                echo '<script>document.querySelector(".edit-product-form").style.display = "none";</script>';
            }
            ?>
        </div>
    </section>

    <script>
        document.querySelector('#close-update_user').onclick = () => {
            document.querySelector('.edit-product-form').style.display = 'none';
            window.location.href = 'users_detail.php';
        }
    </script>
</body>

</html>
