<?php
include 'db.php'; // Include your database connection file

// Handle form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add_announcement'])) {
        // Add new announcement
        $title = $_POST['title'];
        $content = $_POST['content'];

        $stmt = $conn->prepare("INSERT INTO announcements (title, content) VALUES (?, ?)");
        $stmt->bind_param("ss", $title, $content);
        $stmt->execute();
        $stmt->close();
    } elseif (isset($_POST['edit_announcement'])) {
        // Edit existing announcement
        $announcement_id = $_POST['announcement_id'];
        $title = $_POST['title'];
        $content = $_POST['content'];

        $stmt = $conn->prepare("UPDATE announcements SET title=?, content=? WHERE id=?");
        $stmt->bind_param("ssi", $title, $content, $announcement_id);
        $stmt->execute();
        $stmt->close();
    } elseif (isset($_POST['delete_announcement'])) {
        // Delete announcement
        $announcement_id = $_POST['announcement_id'];

        $stmt = $conn->prepare("DELETE FROM announcements WHERE id=?");
        $stmt->bind_param("i", $announcement_id);
        $stmt->execute();
        $stmt->close();
    }
}

// Retrieve existing announcements for display
$announcements = [];
$result = $conn->query("SELECT * FROM announcements ORDER BY created_at DESC");
while ($row = $result->fetch_assoc()) {
    $announcements[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Announcements</title>
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
        button {
            padding: 10px 15px;
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
    <div class="container">
    <button onclick="window.location.href='Admind.php'">Back</button>
        <h1>Manage Announcements</h1>

        <!-- Form to Add a New Announcement -->
        <h2>Add New Announcement</h2>
        <form method="POST" action="">
            <input type="text" name="title" placeholder="Title" required>
            <textarea name="content" placeholder="Content" required></textarea>
            <button type="submit" name="add_announcement" class="add-button">Add Announcement</button>
        </form>

        <!-- Display Existing Announcements -->
        <h2>Existing Announcements</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($announcements as $announcement): ?>
                    <tr>
                        <td><?php echo $announcement['id']; ?></td>
                        <td><?php echo htmlspecialchars($announcement['title']); ?></td>
                        <td><?php echo htmlspecialchars($announcement['content']); ?></td>
                        <td>
                            <form method="POST" action="" style="display:inline;">
                                <input type="hidden" name="announcement_id" value="<?php echo $announcement['id']; ?>">
                                <input type="text" name="title" placeholder="New Title" required>
                                <textarea name="content" placeholder="New Content" required></textarea>
                                <button type="submit" name="edit_announcement" class="add-button">Edit</button>
                                <button type="submit" name="delete_announcement" class="delete-button">Delete</button>


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