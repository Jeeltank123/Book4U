<?php
session_start();
include('config.php'); // Include database connection file

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch user data from the database
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM `users_info` WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Update profile details
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_profile'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    
    // Update user data without profile picture (if needed, uncomment below for file upload)
    $updateQuery = "UPDATE users_info SET name = ?, email = ? WHERE id = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("ssi", $username, $email, $user_id);
    
    if ($stmt->execute()) {
        $_SESSION['message'] = "Profile updated successfully!";
        header("Location: profile.php");
        exit();
    } else {
        $error = "Failed to update profile.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <style>
       /* Container styling */
.container {
    max-width: 600px;
    margin: 50px auto;
    padding: 30px;
    background: linear-gradient(135deg, #f9f9f9, #e8e8e8);
    border-radius: 10px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
    transition: transform 0.3s ease;
}
.container:hover {
    transform: translateY(-5px);
}

h2, h3 {
    text-align: center;
    color: #333;
    margin-bottom: 20px;
    font-family: 'Roboto', sans-serif;
    letter-spacing: 1px;
    text-transform: uppercase;
    font-weight: bold;
}

.message, .error {
    padding: 15px;
    margin-bottom: 15px;
    border-radius: 4px;
    font-size: 1rem;
    text-align: center;
    font-family: 'Roboto', sans-serif;
    font-weight: 500;
    transition: all 0.3s ease;
}

.message {
    color: #28a745;
    background-color: #d4edda;
    border: 1px solid #c3e6cb;
}
.message:hover {
    background-color: #c3e6cb;
}

.error {
    color: #dc3545;
    background-color: #f8d7da;
    border: 1px solid #f5c6cb;
}
.error:hover {
    background-color: #f5c6cb;
}

/* Profile form styling */
.profile form, .change-password form {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

label {
    font-weight: bold;
    color: #555;
    font-family: 'Roboto', sans-serif;
    letter-spacing: 0.5px;
    font-size: 1.1rem;
}

input[type="text"], input[type="email"], input[type="password"], input[type="file"] {
    width: 100%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 1rem;
    font-family: 'Roboto', sans-serif;
    background-color: #fff;
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
}
input[type="text"]:focus, input[type="email"]:focus, input[type="password"]:focus {
    border-color: #007bff;
    box-shadow: 0 4px 8px rgba(0, 123, 255, 0.1);
    outline: none;
}

/* Placeholder styling */
input::placeholder {
    color: #aaa;
    opacity: 0.8;
    font-style: italic;
}

/* Button styling */
button {
    padding: 12px;
    font-size: 1rem;
    font-weight: 600;
    color: #fff;
    background: linear-gradient(135deg, #007bff, #0056b3);
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: background 0.3s ease, transform 0.3s ease;
    font-family: 'Roboto', sans-serif;
    letter-spacing: 0.5px;
}
button:hover {
    background: linear-gradient(135deg, #0056b3, #004080);
    transform: translateY(-3px);
}
button:active {
    transform: translateY(1px);
}

/* Responsive Design */
@media (max-width: 768px) {
    .container {
        padding: 20px;
        max-width: 90%;
    }
    h2, h3 {
        font-size: 1.5rem;
    }
    button {
        font-size: 0.9rem;
    }
}

    </style>
</head>
<body>

<div class="container">
    <h2>User Profile</h2>

    <?php if(isset($_SESSION['message'])): ?>
        <div class="message"><?php echo $_SESSION['message']; unset($_SESSION['message']); ?></div>
    <?php endif; ?>
    <?php if(isset($error)): ?>
        <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>

    <div class="profile">
        <form action="profile.php" method="post">
            <label>name</label>
            <input type="text" name="username" value="<?php echo $user['name']; ?>" required>

            <label>surname</label>
            <input type="text" name="surname" value="<?php echo $user['surname']; ?>" required>
            
            <label>Email</label>
            <input type="email" name="email" value="<?php echo $user['email']; ?>" required>

            <button type="submit" name="update_profile">Update Profile</button>
        </form>
    </div>
    <a href="change_password.php" class="sub-menu-link">
      <p>Change Password</p>
    </a>
