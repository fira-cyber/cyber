<?php
session_start(); // Start the session

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