<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/admin.css">
    <title>Delivery Partner</title>
    <style>
        /* General Styles */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f4f4f4; /* Light background color */
            line-height: 1.6; /* Improve readability */
        }

        /* Header Styles */
        header {
            background-color: #007bff; /* Header background color */
            color: white;
            padding: 1rem 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
            position: sticky; /* Make header sticky */
            top: 0; /* Stick to the top */
            z-index: 1000; /* Ensure it stays above other elements */
        }

        .mainlogo {
            display: flex;
            align-items: center;
            justify-content: space-between; /* Space between logo and title */
            padding: 0 2rem; /* Padding for the container */
        }

        .logo {
            font-size: 2rem; /* Logo font size */
        }

        .logo span.me {
            color: black; /* Highlight color for '4U' */
        }
        .J{
            color: red;
        }

        p {
            font-size: 1.2rem; /* Font size for Delivery Partner */
            margin-left: 1rem; /* Space between logo and text */
        }

        .nav {
            display: flex; /* Display navigation links in a row */
            justify-content: center; /* Center the nav items */
            padding: 0 2rem; /* Padding for the navigation */
        }

        .nav a {
            color: white; /* Link color */
            text-decoration: none; /* Remove underline */
            padding: 0.5rem 1rem; /* Padding for links */
            margin: 0 1rem; /* Space between links */
            transition: background-color 0.3s, transform 0.3s; /* Smooth transitions */
        }

        .nav a:hover {
            background-color: rgba(255, 255, 255, 0.2); /* Hover effect */
            transform: scale(1.05); /* Slight lift effect */
            border-radius: 5px; /* Rounded corners on hover */
        }

        .right {
            display: flex; /* Align user info and logout button */
            align-items: center; /* Center vertically */
            padding: 0 2rem; /* Padding for the right section */
        }

        .log_info {
            margin-right: 1rem; /* Space between user info and logout button */
            color: white; /* User info color */
            font-size: 1rem; /* Font size for user info */
        }

        .Btn {
            background-color: #ff4d4d; /* Red background for logout button */
            color: white; /* Text color */
            padding: 0.5rem 1rem; /* Padding */
            border: none; /* No border */
            border-radius: 5px; /* Rounded corners */
            cursor: pointer; /* Pointer cursor on hover */
            transition: background-color 0.3s, transform 0.3s; /* Smooth transitions */
            text-decoration: none; /* Remove underline */
        }

        .Btn:hover {
            background-color: #e60000; /* Darker red on hover */
            transform: scale(1.05); /* Slightly enlarge on hover */
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .mainlogo {
                flex-direction: column; /* Stack logo and title */
                align-items: flex-start; /* Align to start */
            }

            .nav {
                flex-direction: column; /* Stack navigation vertically */
                align-items: flex-start; /* Align links to the start */
                padding: 1rem 0; /* Space above nav */
            }

            .nav a {
                margin: 0.5rem 0; /* Space between vertical links */
            }

            .right {
                flex-direction: column; /* Stack user info and button */
                align-items: flex-start; /* Align items to the start */
            }

            .log_info {
                margin-right: 0; /* Reset margin */
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="mainlogo">
            <div class="logo">
                <a href="dp_index.php"><span class='j'>Book</span>
                <span class="me">4U</span></a>
            </div>
            <p>Delivery Partner</p>
        </div>
        <div class="nav">
            <a href="dp_index.php">Home</a>
            <a href="dp_orders.php">Total Orders</a>
            <a href="dp_p_orders.php">Pending Orders</a>
            <a href="dp_c_orders.php">Completed Orders</a>
        </div>
        <div class="right">
            <div class="log_info">
                <p>Hello</p> <!-- Placeholder for the username -->
            </div>
            <a class="Btn" href="logout.php?logout=<?php ?>">Logout</a>
        </div>
    </header>
</body>
</html>
