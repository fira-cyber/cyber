<?php
include 'db.php'; // Include your database connection file

// Handle form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add_course'])) {
        // Add new course
        $course_name = $_POST['course_name'];
        $course_description = $_POST['course_description'];

        $stmt = $conn->prepare("INSERT INTO courses (course_name, course_description) VALUES (?, ?)");
        $stmt->bind_param("ss", $course_name, $course_description);
        $stmt->execute();
        $stmt->close();
    } elseif (isset($_POST['edit_course'])) {
        // Edit existing course
        $course_id = $_POST['course_id'];
        $course_name = $_POST['course_name'];
        $course_description = $_POST['course_description'];

        $stmt = $conn->prepare("UPDATE courses SET course_name=?, course_description=? WHERE id=?");
        $stmt->bind_param("ssi", $course_name, $course_description, $course_id);
        $stmt->execute();
        $stmt->close();
    } elseif (isset($_POST['delete_course'])) {
        // Delete course
        $course_id = $_POST['course_id'];

        $stmt = $conn->prepare("DELETE FROM courses WHERE id=?");
        $stmt->bind_param("i", $course_id);
        $stmt->execute();
        $stmt->close();
    }
}

// Retrieve existing courses for display
$courses = [];
$result = $conn->query("SELECT * FROM courses");
while ($row = $result->fetch_assoc()) {
    $courses[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Courses</title>
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
        .delete-button {
            background-color: #f44336;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Manage Courses</h1>

        <!-- Form to Add a New Course -->
        <h2>Add New Course</h2>
        <form method="POST" action="">
            <input type="text" name="course_name" placeholder="Course Name" required>
            <textarea name="course_description" placeholder="Course Description" required></textarea>
            <button type="submit" name="add_course" class="add-button">Add Course</button>
        </form>

        <!-- Display Existing Courses -->
        <h2>Existing Courses</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Course Name</th>
                    <th>Course Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($courses as $course): ?>
                    <tr>
                        <td><?php echo $course['id']; ?></td>
                        <td><?php echo htmlspecialchars($course['course_name']); ?></td>
                        <td><?php echo htmlspecialchars($course['course_description']); ?></td>
                        <td>
                            <form method="POST" action="" style="display:inline;">
                                <input type="hidden" name="course_id" value="<?php echo $course['id']; ?>">
                                <input type="text" name="course_name" placeholder="New Name" required>
                                <textarea name="course_description" placeholder="New Description" required></textarea>
                                <button type="submit" name="edit_course" class="add-button">Edit</button>
                                <button type="submit" name="delete_course" class="delete-button">Delete</button>
                            </form>
                        </td>
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