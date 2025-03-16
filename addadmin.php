<?php
    include 'config.php';
    if(isset($_POST['submit'])) {
        $name = mysqli_real_escape_string($conn, $_POST['Name']);
        $Sname = mysqli_real_escape_string($conn, $_POST['Sname']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, ($_POST['password']));
        $cpassword = mysqli_real_escape_string($conn, ($_POST['cpassword']));
        
        $select_users = $conn->query("SELECT * FROM users_info WHERE email = '$email'") or die('query failed');

        if(mysqli_num_rows($select_users)!=0){
            $message[]='User Already exists!';
        } else {
            if($password !=$cpassword){
                $message[] = 'Confirm password not matched.';
            } else {
                mysqli_query($conn, "INSERT INTO users_info(`name`, `surname`, `email`, `password`, `user_type`) VALUES('$name','$Sname','$email','$password','Admin')") or die('Query failed');
                $message[]='Added Successfully';
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Add</title>
    <style>
* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; /* Updated font for a more modern look */
}

body {
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
    background: linear-gradient(135deg, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.9)), url('bgimg/1.jpg') no-repeat center center/cover;
    color: #fff;
    animation: fadeIn 1s ease-in; /* Fade-in animation */
}

@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

.container {
    max-width: 400px;
    width: 100%;
    padding: 2rem;
    background-color: rgba(255, 255, 255, 0.15); /* Slightly more opaque for better visibility */
    border-radius: 15px; /* Increased border radius for a softer look */
    box-shadow: 0px 8px 30px rgba(0, 0, 0, 0.5); /* Stronger shadow for depth */
    text-align: center;
    backdrop-filter: blur(10px); /* Blur effect for background */
}

.container h3 {
    font-size: 2rem; /* Increased font size */
    margin-bottom: 1rem;
    font-weight: bold; /* Bold title */
    text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.7); /* Shadow effect for better readability */
}

.text_field {
    width: 100%;
    padding: 1rem; /* Increased padding for better usability */
    margin: 0.5rem 0;
    border: none;
    border-radius: 8px;
    background: rgba(255, 255, 255, 0.2);
    color: #fff;
    font-size: 1rem;
    transition: background-color 0.3s ease; /* Smooth transition */
}

.text_field::placeholder {
    color: #ddd;
}

.text_field:focus {
    background: rgba(255, 255, 255, 0.3); /* Highlight on focus */
    outline: none; /* Remove default outline */
}

.btn {
    width: 100%;
    padding: 0.8rem;
    background-color: #007bff;
    color: #fff;
    font-size: 1rem;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.2s ease; /* Added transform for button press effect */
}

.btn:hover {
    background-color: #0056b3;
    transform: translateY(-2px); /* Slight lift on hover */
}

.btn:active {
    transform: translateY(0); /* Return to normal on click */
}

.link {
    display: inline-block;
    margin: 1rem 0.5rem;
    padding: 0.5rem 1rem;
    background-color: #000;
    color: #fff;
    border-radius: 5px;
    text-decoration: none;
    font-size: 1rem;
    transition: background-color 0.3s ease, transform 0.2s ease; /* Added transition for link effect */
}

.link:hover {
    background-color: #00a7f5;
    transform: scale(1.05); /* Slight scale on hover */
}

.message {
    background: rgba(255, 0, 0, 0.9);
    color: #fff;
    padding: 1rem;
    margin: 0.5rem 0;
    text-align: center;
    border-radius: 5px;
    animation: slideIn 0.5s ease; /* Animation for messages */
}
.admin {
            color: red; /* This will make the text red */
        }

@keyframes slideIn {
    from {
        transform: translateY(-20px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

    </style>
</head>
<body>
<?php
    if(isset($message)){
        foreach($message as $message){
            echo '<div class="message" id="messages"><span>'.$message.'</span></div>';
        }
    }
?>
<div class="container">
    <form action="" method="post">
        <h3>Add New <span class="admin">Admin</span></h3>
        <input type="text" name="Name" placeholder="Enter Name" required class="text_field">
        <input type="text" name="Sname" placeholder="Enter Surname" required class="text_field">
        <input type="email" name="email" placeholder="Enter Email Id" required class="text_field">
        <input type="password" name="password" placeholder="Enter Password" required class="text_field">
        <input type="password" name="cpassword" placeholder="Confirm Password" required class="text_field">
        <!-- <select name="user_type" id="" required class="text_field" default="User">
           <option value="User">User</option>
           <option value="Admin">Admin</option>
        </select> -->
        <input type="submit" value="Add" name="submit" class="btn">
        <!-- <p>Already have an account? <br><a class="link" href="login.php">Login</a><a class="link" href="index.php">Back</a></p> -->
    </form>
</div>`

<script>
    setTimeout(() => {
        const box = document.getElementById('messages');
        box.style.display = 'none';
    }, 8000);
</script>
</body>
</html>
