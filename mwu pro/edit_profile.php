<?php
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // Redirect if not logged in
    exit();
}

// Assuming previously stored user data from a database or session
$username = $_SESSION['username'] ?? 'Student';
$email = ''; // Fetch from the database or session if required
$firstName = ''; // Placeholder for first name
$lastName = '';  // Placeholder for last name
$age = '';       // Placeholder for age
$yearAcademia = '';  // Placeholder for year of academia
$department = ''; // Placeholder for department
$studentImage = $_SESSION['student_image'] ?? 'default.jpg'; // Fallback image

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get each posted field, sanitize, trim
    $firstName = htmlspecialchars(trim($_POST['first_name']));
    $lastName = htmlspecialchars(trim($_POST['last_name']));
    $age = htmlspecialchars(trim($_POST['age']));
    $city = htmlspecialchars(trim($_POST['city']));
    $yearAcademia = htmlspecialchars(trim($_POST['year_academia']));
    $department = htmlspecialchars(trim($_POST['department']));

    // Handle image upload
    if (isset($_FILES['user_image']) && $_FILES['user_image']['error'] == UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/'; // Ensure this folder exists and is writable
        $uploadFile = $uploadDir . basename($_FILES['user_image']['name']);
        move_uploaded_file($_FILES['user_image']['tmp_name'], $uploadFile);
        $_SESSION['student_image'] = $uploadFile; // Storing image path in session
    }

    // Path to store the profile information
    $filePath = "C:\\Users\\firao\\OneDrive\\student_profiles.txt";

    // Prepare the data to write
    $profileData = "First Name: $firstName\nLast Name: $lastName\nAge: $age\nCity: $city\nYear of Academia: $yearAcademia\nDepartment: $department\nImage: $uploadFile\n---\n";
    
    // Store the data in the specified file
    file_put_contents($filePath, $profileData, FILE_APPEND | LOCK_EX);

    // Optionally, update session data
    $_SESSION['username'] = $username;

    // Redirect to a confirmation or profile page
    header("Location: welcome.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #f4f4f4;
            max-width: 600px;
            margin: auto;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            background-color: white;
        }
        h2 {
            text-align: center;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="number"],
        select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="submit"] {
            background-color: #3f51b5;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }
        input[type="submit"]:hover {
            background-color: #5b6bd5;
        }
        input[type="file"] {
            margin: 10px 0;
        }
    </style>
</head>
<body>

    <h2>Edit Profile</h2>
    <form method="POST" enctype="multipart/form-data">
        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" name="first_name" value="<?php echo htmlspecialchars($firstName); ?>" required>

        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" name="last_name" value="<?php echo htmlspecialchars($lastName); ?>" required>

        <label for="age">Age:</label>
        <input type="number" id="age" name="age" value="<?php echo htmlspecialchars($age); ?>" required>

        <label for="city">City:</label>
        <select id="city" name="city" required>
            <option value="">Select City</option>
            <option value="Addis Ababa">Addis Ababa</option>
            <option value="Dire Dawa">Dire Dawa</option>
            <option value="Mekelle">Mekelle</option>
            <option value="Gondar">Gondar</option>
            <option value="Hawassa">Hawassa</option>
            <option value="Jimma">Jimma</option>
            <option value="Arba Minch">Arba Minch</option>
            <option value="Bahir Dar">Bahir Dar</option>
            <!-- Add more cities as needed -->
        </select>

        <label for="year_academia">Year of Academia:</label>
        <input type="text" id="year_academia" name="year_academia" value="<?php echo htmlspecialchars($yearAcademia); ?>" required>

        <label for="department">Department:</label>
        <input type="text" id="department" name="department" value="<?php echo htmlspecialchars($department); ?>" required>

        <label for="user_image">Upload User Image:</label>
        <input type="file" id="user_image" name="user_image" accept="image/*" required>
        <input type="submit" value="Update Profile">
    </form>
</body>
</html>