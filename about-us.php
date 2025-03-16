<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>About Us - Book4U</title>
    <style>
        /* Reset CSS */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        /* Body and Font Styles */
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            background-color: #f4f4f4;
            color: #333;
            padding: 0 20px;
        }

        /* Header Styles */
        header {
            background: #4CAF50;
            color: white;
            padding: 20px 0;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        /* About Section Styles */
        .about-section {
            padding: 40px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            margin: 20px 0;
        }

        /* Container for Flexbox Layout */
        .container {
            display: flex;
            flex-wrap: wrap; /* Wraps items in smaller screens */
            justify-content: space-between;
            align-items: flex-start; /* Aligns items at the start */
            margin: 20px 0;
        }

        .about-content {
            flex: 1 1 60%; /* Flex-grow, flex-shrink, and base width */
            margin-right: 20px;
        }

        .about-content h2 {
            color: #4CAF50;
            margin-bottom: 15px;
            font-size: 2em; /* Enhanced font size */
        }

        .about-image img {
            width: 100%;
            max-width: 400px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        /* Mission and Team Styles */
        .mission, .team {
            margin: 20px 0;
            padding: 20px;
            background: #e2e2e2;
            border-radius: 8px;
            transition: background 0.3s; /* Smooth background transition */
        }

        .mission:hover, .team:hover {
            background: #d1d1d1; /* Lighten background on hover */
        }

        .team h3 {
            color: #4CAF50;
            margin-bottom: 15px;
        }

        .team-members {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap; /* Wraps items in smaller screens */
        }

        .member {
            text-align: center;
            margin: 10px; /* Spacing around members */
            transition: transform 0.3s; /* Smooth transform transition */
        }

        .member:hover {
            transform: scale(1.05); /* Slightly enlarge on hover */
        }

        .member img {
            border-radius: 50%;
            width: 100px;
            height: 100px;
            transition: transform 0.3s;
        }

        .member img:hover {
            transform: scale(1.1); /* Enlarge image on hover */
        }

        footer {
            text-align: center;
            padding: 20px 0;
            background: #333;
            color: white;
            position: relative;
            bottom: 0;
            width: 100%;
            margin-top: 20px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                flex-direction: column; /* Stack items vertically on small screens */
            }

            .about-content {
                margin-right: 0; /* Remove margin on small screens */
                margin-bottom: 20px; /* Add space below */
            }

            .team-members {
                flex-direction: column; /* Stack team members vertically */
                align-items: center; /* Center align team members */
            }
        }
    </style>
</head>
<body>
    <header>
        <h1>About Us</h1>
    </header>

    <section class="about-section">
        <div class="container">
            <div class="about-content">
                <h2>Welcome to Book4U</h2>
                <p>At Book4U, we believe that books are a window to the world, a source of knowledge, and a bridge to imagination. Our mission is to provide readers with a diverse selection of books, from timeless classics to contemporary bestsellers, all at your fingertips.</p>
                <p>Founded in [Year], we have grown from a small bookstore to a leading online platform, connecting book lovers with their next great read. Our dedicated team is passionate about literature and is always on the lookout for the latest releases and hidden gems to enrich our collection.</p>
            </div>
            <div class="about-image">
                <img src="bgimg\DALL·E 2024-10-17 16.31.19 - A vibrant, modern wide banner image for an online bookselling website named 'Book4U'. The banner should have a clean design with a focus on promoting .jpg" alt="Bookshelf">
            </div>
        </div>
        
        <div class="mission">
            <h3>Our Mission</h3>
            <p>To empower readers through access to a vast collection of books, fostering a love for reading and continuous learning.</p><p>मकसद मत भुलना भाईजान</p>
        </div>

        <div class="team">
            <h3>Meet Our Team</h3>
            <div class="team-members">
                <div class="member">
                    <img src="bgimg/20240229_081842.jpg" alt="Tank Jeel">
                    <h4>Tank Jeel</h4>
                    <p>Developer</p>
                </div>
                <div class="member">
                    <img src="bgimg\WhatsApp Image 2024-10-18 at 5.36.16 PM.jpg" alt="Korat Karan">
                    <h4>Korat Karan</h4>
                    <p>Developer</p>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <p>&copy; 2024 Book4U. All rights reserved.</p>
    </footer>
</body>
</html>
