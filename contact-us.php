<?php
include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];

if (!isset($user_id)) {
  header('location:login.php');
  exit;
}

if (isset($_POST['send_msg'])) {
  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $msg = mysqli_real_escape_string($conn, $_POST['msg']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $phone = mysqli_real_escape_string($conn, $_POST['phone']);

  if (!empty($name) && !empty($msg) && !empty($email) && !empty($phone)) {
    mysqli_query($conn, "INSERT INTO msg (`user_id`, `name`, `email`, `number`, `msg`) VALUES('$user_id', '$name', '$email', '$phone', '$msg')") or die('Message send query failed');
    $message[] = 'Message sent successfully';
  } else {
    $message[] = 'Please fill in all fields';
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Contact Us</title>
  <link rel="stylesheet" href="style.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="./css/hello.css">
</head>

<body>

  <?php include 'index_header.php'; ?>

  <?php
  if (isset($message)) {
    foreach ($message as $msg) {
      echo '<div class="message" id="messages"><span>' . htmlspecialchars($msg) . '</span></div>';
    }
  }
  ?>

  <div class="contact-section">
    <h1>Contact Us</h1>
    <h3>Hello, <span><?php echo htmlspecialchars($user_name); ?></span>, how can we help you?</h3>
    <div class="border"></div>
    <form class="contact-form" action="" method="post">
      <!-- <input type="text" class="contact-form-text" name="name" placeholder="Your name" required> -->
      <input type="text" class="contact-form-text" name="name" placeholder="Your name" pattern="[A-Za-z]+" title="Only alphabetic characters (A-Z) are allowed" required>
      <input type="email" class="contact-form-text" name="email" placeholder="Your email" required>
      <input type="text" class="contact-form-text" name="phone" placeholder="Your phone" required pattern="[0-9]{10}">
      <textarea class="contact-form-text" name="msg" placeholder="Your message" required></textarea>
      <input type="submit" class="contact-form-btn" name="send_msg" value="Send">
      <a href="index.php" class="contact-form-btn">Back</a>
    </form>
  </div>

  <?php include 'index_footer.php'; ?>

  <script>
    setTimeout(() => {
      const box = document.getElementById('messages');
      if (box) {
        box.style.display = 'none';
      }
    }, 5000);
  </script>

</body>

</html>
