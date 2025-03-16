<head>
    <style>
        :root {
            --primary-bg: rgba(0, 0, 0, 0.2);
            --link-color: #000;
            --footer-bg: rgba(0, 0, 0, 0.2);
            --dropdown-bg: #CCCCCC;
            --dropdown-hover-bg: #f1f1f1;
            --icon-color: #32CD32; /* Customizable green color */
            --title-color: #333;
            --text-color: #666;
            --shadow-color: rgba(0, 0, 0, 0.1);
            --transition-speed: 0.3s;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            list-style: none;
            text-decoration: none;
            color: var(--link-color);
        }

        footer {
            background-color: var(--footer-bg);
            padding: 2rem 0;
        }

        h2 {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--title-color);
            margin-bottom: 1rem;
        }

        .flex {
            display: flex;
            gap: 2rem;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
        }

        .short_links ul li:not(:first-child) {
            padding: 0.5rem 0;
        }

        .short_links ul {
            margin: 0 2rem;
        }

        .short_links ul li {
            font-size: 1rem;
            color: var(--text-color);
            transition: color var(--transition-speed);
        }

        .short_links ul li:hover {
            color: var(--icon-color);
        }

        .sub_main .dropdown {
            position: relative;
            display: inline-block;
        }

        .sub_main .dropdown .dropbtn {
            border: none;
            cursor: pointer;
            background: none;
            padding: 0.5rem 1rem;
            font-size: 1rem;
            color: var(--link-color);
            transition: color var(--transition-speed);
        }

        .sub_main .dropdown:hover .dropbtn {
            color: var(--icon-color);
        }

        .sub_main .dropdown .dropdown-content {
            display: none;
            position: absolute;
            background-color: var(--dropdown-bg);
            min-width: 160px;
            box-shadow: 0 4px 12px var(--shadow-color);
            border-radius: 0.5rem;
            overflow: hidden;
            z-index: 1;
            transition: opacity var(--transition-speed), transform var(--transition-speed);
            transform: translateY(10px);
            opacity: 0;
        }

        .sub_main .dropdown:hover .dropdown-content {
            display: flex;
            flex-direction: column;
            transform: translateY(0);
            opacity: 1;
        }

        .sub_main .dropdown .dropdown-content a {
            color: var(--link-color);
            padding: 0.75rem 1rem;
            font-size: 1rem;
            transition: background-color var(--transition-speed);
        }

        .sub_main .dropdown .dropdown-content a:hover {
            background-color: var(--dropdown-hover-bg);
        }

        .icons-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(20rem, 1fr));
            gap: 2rem;
            padding: 2rem 0;
        }

        .icons-container .icons {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            background-color: #fff;
            border-radius: 0.5rem;
            box-shadow: 0 4px 12px var(--shadow-color);
            transition: transform var(--transition-speed), box-shadow var(--transition-speed);
        }

        .icons-container .icons:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15);
        }

        .icons-container .icons i {
            font-size: 2.5rem;
            color: var(--icon-color);
            transition: color var(--transition-speed);
        }

        .icons-container .icons i:hover {
            color: darkgreen;
        }

        .icons-container .icons h3 {
            font-size: 1.5rem;
            color: var(--title-color);
            font-weight: 600;
        }

        .icons-container .icons p {
            font-size: 1rem;
            color: var(--text-color);
        }

        .cmsg {
            align-items: center;
            justify-content: center;
            margin: 20px 0 0;
            display: flex;
            flex-direction: column;
            text-align: center;
        }

        .cmsg p {
            font-size: 0.9rem;
            color: var(--text-color);
        }

        .cmsg .logo {
            font-size: 30px;
            color: var(--icon-color);
        }

        .cmsg .logo a {
            font-size: 15px;
        }
    </style>
</head>

<footer style="margin: 30px auto 0;">
    <div class="main" style="align-items:center; padding:40px;">
        <div class="sub_main">
            <div class="short_links flex">
                <ul>
                    <h2>Quick Links</h2>
                    <li><a href="index.php">Home</a></li>
                    <li>
                        <div class="dropdown">
                            <button class="dropbtn"><a> Category 🔻</a> </button>
                            <div class="dropdown-content">
                                <a href="http://localhost/bookflix/index.php#New">New Arrived</a>
                                <a href="http://localhost/bookflix/index.php#Adventure">Adventure</a>
                                <a href="http://localhost/bookflix/index.php#Magical">Magic</a>
                                <a href="http://localhost/bookflix/index.php#Knowledge">Knowledge</a>
                            </div>
                        </div>
                    </li>
                    <li><a href="about-us.php">About Us</a></li>
                </ul>
                <?php if(isset($_SESSION['user_name'])){echo'
                <ul class="account">
                    <h2>Account</h2>
                    <li><a href="profile.php">Profile</a></li>
                    <li><a href="cart.php">Cart</a></li>
                    <li><a href="orders.php">Order History</a></li>
                    <li><a href="logout.php">LogOut</a></li>
                </ul>';}
                ?>
                <ul>
                    <h2>Contact</h2>
                    <li><a href="contact-us.php">Contact Form</a></li>
                    <li>+91 6353647067</li>
                    <li>contact@book4u.com</li>
                    <li>Address: Surat 395010</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="cmsg">
        <p>Designed By Jeel Tank & Karan Korat | Copyright &copy; <script> document.write(new Date().getFullYear()) </script> All Rights are reserved by &nbsp</p>
        <div class="logo">
            <a href="index.php"><span style="font-size: 15px;">Book</span><span style="font-size: 15px;">4U</span></a>
        </div> 
    </div>
</footer>
