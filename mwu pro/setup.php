<?php
// Start a session
session_start();

// Initialize the message variable
$message = "";

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get and sanitize inputs
    $input_username = $_POST['username'];
    $input_password = $_POST['password'];

    // Hardcoded credentials
    $correct_username = 'firakoo';
    $correct_password = '199595fira';

    // Check for correct username and password
    if ($input_username === $correct_username && $input_password === $correct_password) {
        // Set session variable for user
        $_SESSION['username'] = $input_username;

        // Redirect to the desired page
        header("Location: Admind.php"); // Change this to your desired file
        exit(); // Ensure no further code is executed after redirect
    } else {
        $message = "Invalid username or password.";
    }
}
?>

<!-- Admin Login Page (login.php) -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        form {
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: 0 auto; 
        }
        input[type="text"],
        input[type="password"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="submit"] {
            background-color: #28a745;
            color: white;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #218838;
        }
        .message {
            background-color: #e9ecef;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            margin: 10px auto;
            max-width: 400px;
            text-align: center;
            color: #333;
        }
        .success {
            border-color: #28a745; /* Green for success */
        }
        .error {
            border-color: #dc3545; /* Red for error */
        }
        button {
            padding: 10px 185px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Admin Login</h1>

    <form method="POST" action="">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="submit" value="Login">
        <button onclick="window.location.href='Admind.php'">Back</button>

    </form>

    <?php if (!empty($message)): ?>
        <div class="message <?php echo strpos($message, 'Invalid') === false ? 'success' : 'error'; ?>">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>
</body>
</html>