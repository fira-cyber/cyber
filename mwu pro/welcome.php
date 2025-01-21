<?php
session_start(); // Start the session

// Database connection
$host = 'localhost'; // Database host
$db = 'mwup'; // Database name
$user = 'root'; // Database username
$password = ''; // Database password

// Create a PDO connection
try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database $db :" . $e->getMessage());
}

// Assuming the user is already logged in and their data is stored in session variables
$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Student';
$studentImage = isset($_SESSION['student_image']) ? $_SESSION['student_image'] : 'default.jpg'; // Fallback image

// Fetch user information from the database
$userQuery = $pdo->prepare("SELECT * FROM users WHERE username = :username");
$userQuery->execute(['username' => $username]);
$userInfo = $userQuery->fetch(PDO::FETCH_ASSOC);

// Fetch courses from the database
$coursesQuery = $pdo->query("SELECT * FROM courses");
$courses = $coursesQuery->fetchAll(PDO::FETCH_ASSOC);

// Fetch announcements from the database
$announcementsQuery = $pdo->query("SELECT * FROM announcements");
$announcements = $announcementsQuery->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <style>
        /* Add your style here */
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4; /* Light grey background */
        }
        .dashboard-container {
            display: flex;
            height: 100vh;
        }
        .sidebar {
            width: 250px;
            background-color: #3f51b5; /* Primary color */
            color: white;
            padding: 20px;
        }
        .sidebar h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .sidebar img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            display: block;
            margin: 0 auto 10px;
        }
        .sidebar button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            background-color: #6f7dff; /* Button color */
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .sidebar button:hover {
            background-color: #5b6bd5; /* Darker shade on hover */
        }
        .content {
            flex-grow: 1;
            padding: 20px;
            background-color: white;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .welcome-message {
            font-size: 24px;
            margin: 20px 0;
            text-align: center;
            color: #4CAF50; /* Green color */
        }
        .user-info, .course-info, .announcement-info {
            margin: 20px 0;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <div class="sidebar">
            <img src="<?php echo htmlspecialchars($studentImage); ?>" alt="Student Image">
            <h2><?php echo htmlspecialchars($username); ?></h2>
            <button onclick="location.href='results.php'">Results</button>
            <button onclick="location.href='edit_profile.php'">Edit Profile</button>
            <button onclick="location.href='gister.php'">Register for Semester</button>
            <button onclick="location.href='login.php'">Logout</button>
        </div>
        <div class="content">
            <h1>Student Dashboard</h1>
            <div class="welcome-message">Welcome, <?php echo htmlspecialchars($username); ?>!</div>

            <div class="user-info">
                <h2>User Information</h2>
                <p><strong>Full Name:</strong> <?php echo htmlspecialchars($userInfo['fullname'] ?? 'N/A'); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($userInfo['email'] ?? 'N/A'); ?></p>
                <p><strong>Username:</strong> <?php echo htmlspecialchars($userInfo['username'] ?? 'N/A'); ?></p>
                <p><strong>Profile Image:</strong> <img src="<?php echo htmlspecialchars($userInfo['profile_image'] ?? 'default.jpg'); ?>" alt="Profile" style="width:50px;height:50px;"></p>
            </div>

            <div class="course-info">
                <h2>Your Courses</h2>
                <ul>
                    <?php if ($courses): ?>
                        <?php foreach ($courses as $course): ?>
                            <li>
                                <strong><?php echo htmlspecialchars($course['course_name']); ?></strong><br>
                                <?php echo htmlspecialchars($course['course_description']); ?>
                            </li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li>No courses found.</li>
                    <?php endif; ?>
                </ul>
            </div>

            <div class="announcement-info">
                <h2>Announcements</h2>
                <ul>
                    <?php if ($announcements): ?>
                        <?php foreach ($announcements as $announcement): ?>
                            <li>
                                <strong><?php echo htmlspecialchars($announcement['title']); ?></strong><br>
                                <?php echo htmlspecialchars($announcement['content']); ?></li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li>No announcements found.</li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>