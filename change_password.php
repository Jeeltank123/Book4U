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
$query = "SELECT password FROM users_info WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$currentPasswordHash = $user['password'];

// Handle password change request
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['change_password'])) {
    $currentPassword = $_POST['current_password'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    // Check if the current password matches
    if (password_verify($currentPassword, $currentPasswordHash)) {
        // Verify that the new password and confirm password match
        if ($newPassword === $confirmPassword) {
            // Hash the new password and update in database
            $newPasswordHash = password_hash($newPassword, PASSWORD_BCRYPT);
            $updateQuery = "UPDATE users_info SET password = ? WHERE id = ?";
            $stmt = $conn->prepare($updateQuery);
            $stmt->bind_param("si", $newPasswordHash, $user_id);
            
            if ($stmt->execute()) {
                $_SESSION['message'] = "Password updated successfully!";
                header("Location: profile.php");
                exit();
            } else {
                $error = "Failed to update password. Please try again.";
            }
        } else {
            $error = "New password and confirmation do not match.";
        }
    } else {
        $error = "Current password is incorrect.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <style>
        * {
            box-sizing: border-box;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f0f2f5;
        }
        .container {
            max-width: 500px;
            width: 90%;
            padding: 30px;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            animation: fadeIn 1s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        h2 {
            text-align: center;
            color: #333;
            font-size: 1.8rem;
            margin-bottom: 1rem;
        }
        .message, .error {
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 6px;
            font-size: 1rem;
            text-align: center;
        }
        .message {
            color: #155724;
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
        }
        .error {
            color: #721c24;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        label {
            font-weight: bold;
            color: #555;
        }
        input[type="password"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 1rem;
            outline: none;
            transition: border-color 0.3s;
        }
        input[type="password"]:focus {
            border-color: #007bff;
        }
        input[type="password"]::placeholder {
            color: #aaa;
        }
        button {
            padding: 12px;
            font-size: 1.1rem;
            font-weight: bold;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
        }
        button:hover {
            background-color: #0056b3;
            transform: scale(1.03);
        }
        button:active {
            transform: scale(0.98);
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Change Password</h2>

    <?php if(isset($error)): ?>
        <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>

    <form action="change_password.php" method="post">
        <label>Current Password</label>
        <input type="password" name="current_password" placeholder="Enter current password" required>
        
        <label>New Password</label>
        <input type="password" name="new_password" placeholder="Enter new password" required>

        <label>Confirm New Password</label>
        <input type="password" name="confirm_password" placeholder="Confirm new password" required>

        <button type="submit" name="change_password">Change Password</button>
    </form>
</div>

</body>
</html>
