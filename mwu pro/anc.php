<?php
// Database connection parameters
$servername = "localhost"; // Your server name
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "mwup"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch announcements from database
$sql = "SELECT title, content, created_at FROM announcements ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Announcements - Madda Walbu University</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 20px;
        }

        header {
            background-color: #3f51b5;
            color: white;
            text-align: center;
            padding: 20px 0;
        }

        h1 {
            margin: 0;
        }

        .announcement-container {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .announcement {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            padding: 20px;
            transition: transform 0.2s;
        }

        .announcement:hover {
            transform: translateY(-5px);
        }

        .announcement h2 {
            margin: 0 0 10px;
            font-size: 1.5em;
            color: #3f51b5;
        }

        .announcement p {
            margin: 10px 0;
            line-height: 1.6;
        }

        .date {
            font-size: 0.9em;
            color: #666;
        }

        footer {
            text-align: center;
            padding: 15px 0;
            background-color: #3f51b5;
            color: white;
            position: relative;
            width: 100%;
            bottom: 0;
        }
    </style>
</head>
<body>

<header>
    <h1>Madda Walbu University Announcements</h1>
</header>

<div class="announcement-container">
    <?php
    if ($result->num_rows > 0) {
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<div class='announcement'>";
            echo "<h2>" . htmlspecialchars($row["title"]) . "</h2>";
            echo "<p class='date'>" . htmlspecialchars($row["created_at"]) . "</p>";
            echo "<p>" . htmlspecialchars($row["content"]) . "</p>";
            echo "</div>";
        }
    } else {
        echo "<div class='announcement'><p>No announcements available at the moment.</p></div>";
    }
    ?>
</div>

<footer>
    <p>&copy; 2023 Madda Walbu University. All rights reserved.</p>
</footer>
<a href="index.php" class="back-button">
    <span class="icon">←</span> Back
</a>
</body>
</html>

<?php
$conn->close(); // Close the database connection
?>