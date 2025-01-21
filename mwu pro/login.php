<?php
session_start(); // Start the session

// Initialize variables
$error = ""; // Variable to hold the error message

// Database connection parameters
$servername = "localhost"; // Change if your server is different
$dbUsername = "root"; // Your database username
$dbPassword = ""; // Your database password
$dbname = "mwup"; // Your database name

// Create connection
$conn = new mysqli($servername, $dbUsername, $dbPassword, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input
    $username = $conn->real_escape_string(trim($_POST['username']));
    $password = trim($_POST['password']);

    // Prepare and execute the SQL statement
    $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    // Check if the username exists
    if ($stmt->num_rows > 0) {
        // Fetch the currently hashed password from the database
        $stmt->bind_result($hashedPassword);
        $stmt->fetch();

        // Verify the password
        if (password_verify($password, $hashedPassword)) {
            // Password is correct; set session variables
            $_SESSION['username'] = $username;

            // Redirect to welcome page
            header("Location: welcome.php");
            exit();
        } else {
            // Incorrect password
            $error = "Invalid password. Please try again.";
        }
    } else {
        // Username does not exist
        $error = "No user found with that username.";
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-image: url('a.jpg'); /* Background image */
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-container {
            background: rgba(255, 255, 255, 0.8); /* White background with transparency */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
            width: 500px;
            height: 500;
            text-align: center;
        }

        h2 {
            margin: 0 0 20px 0;
            color: #333;
        }

        input[type="text"], input[type="password"] {
            width: 50%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            background: url('icon.jpg') no-repeat scroll 10px 10px; /* Username icon */
            background-size: 20px 20px;
            padding-left: 40px; /* Space for the icon */
        }

        button {
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #5cb85c; /* Button color */
            color: white;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
            margin-top: 10px;
        }

        button:hover {
            background-color: #4cae4c; /* Darker shade on hover */
        }

        .error {
            color: red;
            font-weight: bold;
            margin: 10px 0;
        }

        a {
            text-decoration: none;
            color: #337ab7;
        }

        a:hover {
            text-decoration: underline;
        }

        .logo {
            width: 100px; /* Logo width */
            margin-bottom: 20px;
        }
        .back-button {
            display: inline-flex;
            align-items: center;
            padding: 10px 20px;
            border: none;
            border-radius: 30px;
            background: linear-gradient(145deg, #e6e6e6, #f9f9f9);
            box-shadow:  5px 5px 10px #d1d1d1,
                        -5px -5px 10px #ffffff;
            font-size: 16px;
            color: #5B5B5B;
            cursor: pointer;
            transition: 0.3s;
        }

        .back-button:hover {
            background: linear-gradient(145deg, #f9f9f9, #e6e6e6);
            box-shadow:  5px 5px 20px #d1d1d1,
                        -5px -5px 20px #ffffff;
        }
        
        .back-button .icon {
            margin-right: 8px;
        }

    </style>
</head>
<body>
    <div class="login-container">
        <img src="logo.jpg" alt="Logo" class="logo">
        <h2>Login</h2>
        <form method="POST" action="">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
            <p><a href="rig.php">Don't have an account? Register here</a></p>
            <a href="index.php" class="back-button">
    <span class="icon">←</span> Back
</a>
        </form>
        
        <?php
            // Display error message if it exists
            if (!empty($error)) {
                echo "<div class='error'>" . htmlspecialchars($error) . "</div>";
            }
        ?>
    </div>
</body>
</html>