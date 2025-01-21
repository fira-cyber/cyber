<?php
include 'db.php'; // Include your database connection file

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['post_result'])) {
        $user_id = $_POST['user_id'];
        $subject = $_POST['subject'];
        $grade = $_POST['grade'];

        // Prepare the SQL statement to insert the result
        $stmt = $conn->prepare("INSERT INTO results (user_id, subject, grade) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $user_id, $subject, $grade); // Change to match your actual field types
        $stmt->execute();
        $stmt->close();
    }
}

// Retrieve all users for the dropdown
$users = [];
$result = $conn->query("SELECT * FROM users");
while ($row = $result->fetch_assoc()) {
    $users[] = $row;
}

// Optionally retrieve existing results if needed
$results = [];
$results_query = $conn->query("SELECT r.*, u.fullname FROM results r JOIN users u ON r.user_id = u.id");
while ($row = $results_query->fetch_assoc()) {
    $results[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post User Results and Grades</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f6f8;
            color: #333;
        }
        h1 {
            text-align: center;
            color: #4CAF50;
        }
        .container {
            margin: 20px auto;
            max-width: 800px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        button {
            padding: 10px;
            margin: 5px;
            border: none;
            border-radius: 5px;
            color: white;
            cursor: pointer;
        }
        .add-button {
            background-color: #4CAF50;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Post User Results and Grades</h1>

        <!-- Form to Post a User Result -->
        <h2>Add Result</h2>
        <form method="POST" action="">
            <label for="user_id">Select User:</label>
            <select name="user_id" required>
                <option value="">--Select User--</option>
                <?php foreach ($users as $user): ?>
                    <option value="<?php echo $user['id']; ?>"><?php echo htmlspecialchars($user['fullname']); ?></option>
                <?php endforeach; ?>
            </select>
            <br><br>
            <input type="text" name="subject" placeholder="Subject" required>
            <input type="text" name="grade" placeholder="Grade" required>
            <button type="submit" name="post_result" class="add-button">Post Result</button>
        </form>

        <!-- Display Existing Results -->
        <h2>Existing Results</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User Fullname</th>
                    <th>Subject</th>
                    <th>Grade</th>
                    <th>Date Posted</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($results as $result): ?>
                    <tr>
                        <td><?php echo $result['id']; ?></td>
                        <td><?php echo htmlspecialchars($result['fullname']); ?></td>
                        <td><?php echo htmlspecialchars($result['subject']); ?></td>
                        <td><?php echo htmlspecialchars($result['grade']); ?></td>
                        <td><?php echo $result['created_at']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
$conn->close();
?>