<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Madda Walbu University Student Portal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-image: url('madda.jpg'); /* Set background image */
            background-size: cover;
            background-position: center;
            color: white; /* Text color */
        }

        header {
            background-color: rgba(63, 81, 181, 0.8); /* Semi-transparent header */
            padding: 20px;
            text-align: center;
        }

        h1 {
            margin: 0;
            font-size: 2.5em;
        }

        nav {
            margin: 20px 0;
        }

        nav a {
            color: #fff;
            margin: 0 15px;
            text-decoration: none;
            font-size: 1.2em;
        }

        nav a:hover {
            text-decoration: underline;
        }

        /* Dropdown Styles */
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropbtn {
            background-color: #3f51b5;
            color: white;
            padding: 10px;
            font-size: 1.2em;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: white;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .container {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            margin: 20px;
        }

        .card {
            background-color: rgba(255, 255, 255, 0.9); /* White background with transparency */
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            width: 300px;
            margin: 20px;
            overflow: hidden;
            transition: transform 0.2s;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card-header {
            background-color: #3f51b5;
            color: white;
            padding: 20px;
            text-align: center;
        }

        .card-content {
            padding: 20px;
        }

        .card-content h3 {
            margin: 0 0 10px;
        }

        .card-content p {
            color: #555;
        }

        .footer {
            text-align: center;
            padding: 20px;
            background-color: rgba(63, 81, 181, 0.8);
            color: white;
            position: relative;
            bottom: 0;
            width: 100%;
        }

        .image-slider {
            position: relative;
            margin: 20px auto; /* Make it center aligned */
            width: 80%;
            overflow: hidden;
            border-radius: 10px;
        }

        .slides {
            display: flex;
            transition: transform 0.5s ease;
        }

        .slide {
            min-width: 100%;
            box-sizing: border-box;
        }

        img {
            width: 100%;
            height: auto;
        }

        .button {
            width: 30px;
            height: 30px;
            background-color: rgba(63, 81, 181, 0.8);
            border: none;
            border-radius: 50%;
            color: white;
            cursor: pointer;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            z-index: 10; /* Ensure buttons are above images */
        }

        .button.prev {
            left: 10px;
        }

        .button.next {
            right: 10px;
        }
    </style>
</head>

<body>
    <header>
        <img src="logo.jpg" alt="Madda Walbu University Logo" style="width: 150px; height: auto;">
        <h1>Madda Walbu University</h1>
        <nav>
            <a href="login.php">Courses</a>
            <a href="login.php">Announcements</a>
            <a href="login.php">Profile</a>
            <div class="dropdown">
                <button class="dropbtn">Login</button>
                <div class="dropdown-content">
                    <a href="login.php">As Student</a>
                    <a href="setup.php">As Admin</a>
                </div>
            </div>
        </nav>
    </header>

    <div class="container" id="welcome">
        <div class="card">
            <div class="card-header">
                <h2>Welcome</h2>
            </div>
            <div class="card-content">
                <h3>Student Portal</h3>
                <p>Access your courses, view announcements, and manage your profile in one place.</p>
                <a href="login.php" style="color: #3f51b5;">Get Started <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>

        <div class="card" id="courses">
            <div class="card-header">
                <h2>Courses</h2>
            </div>
            <div class="card-content">
                <h3>Your Classes</h3>
                <p>Check your enrolled courses and class schedules.</p>
                <a href="login.php" style="color: #3f51b5;">View Courses <i class="fas fa-book"></i></a>
            </div>
        </div>

        <div class="card" id="announcements">
            <div class="card-header">
                <h2>Announcements</h2>
            </div>
            <div class="card-content">
                <h3>Stay Updated</h3>
                <p>View the latest announcements from the university.</p>
                <a href="anc.php" style="color: #3f51b5;">View Announcements <i class="fas fa-bullhorn"></i></a>
            </div>
        </div>

        <div class="card" id="profile">
            <div class="card-header">
                <h2>Your Profile</h2>
            </div>
            <div class="card-content">
                <h3>Manage Your Profile</h3>
                <p>Update your personal information and settings.</p>
                <a href="login.php" style="color: #3f51b5;">Edit Profile <i class="fas fa-user-edit"></i></a>
            </div>
        </div>
    </div>

    <div class="image-slider" id="slider">
        <button class="button prev" onclick="changeSlide(-1)"><i class="fas fa-chevron-left"></i></button>
        <button class="button next" onclick="changeSlide(1)"><i class="fas fa-chevron-right"></i></button>
        <div class="slides">
            <div class="slide"><img src="ma.jpg" alt="Image 1"></div>
            <div class="slide"><img src="as.jpg" alt="Image 2"></div>
            <div class="slide"><img src="se.jpg" alt="Image 3"></div>
            <div class="slide"><img src="pr.jpg" alt="Image 4"></div>
        </div>
    </div>
    
    <footer class="footer">
        <p>© 2023 Madda Walbu University. All rights reserved.</p>
    </footer>

    <script>
        let currentIndex = 0;

        function changeSlide(direction) {
            const slides = document.querySelectorAll('.slide');
            currentIndex += direction;

            if (currentIndex < 0) {
                currentIndex = slides.length - 1;
            }
            if (currentIndex >= slides.length) {
                currentIndex = 0;
            }
            updateSlidePosition();
        }

        function updateSlidePosition() {
            const slideContainer = document.querySelector('.slides');
            const slideWidth = document.querySelector('.slide').clientWidth;
            slideContainer.style.transform = 'translateX(' + (-currentIndex * slideWidth) + 'px)';
        }

        // Automatically change slides every 5 seconds
        setInterval(() => {
            changeSlide(1);
        }, 5000);
    </script>
</body>

</html>