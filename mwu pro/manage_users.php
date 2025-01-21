<?php
include 'db.php';

// Fetch users from the database
$sql = "SELECT * FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background-color: white;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
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
    <h1>Manage Users</h1>

    <table>
        <tr>
            <th>ID</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Username</th>
            <th>Profile Image</th>
            <th>Actions</th>
        </tr>
        <?php if ($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row["id"]; ?></td>
                    <td><?php echo $row["fullname"]; ?></td>
                    <td><?php echo $row["email"]; ?></td>
                    <td><?php echo $row["username"]; ?></td>
                    <td>
                        <?php if ($row["profile_image"]): ?>
                            <img src="uploads/<?php echo $row["profile_image"]; ?>" alt="Profile Image" width="50">
                        <?php else: ?>
                            No Image
                        <?php endif; ?>
                    </td>
                    <td>
                        <button onclick="window.location.href='edit_uedti.php?id=<?php echo $row['id']; ?>'">Edit</button>
                        <button onclick="if(confirm('Are you sure you want to delete this user?')) window.location.href='delete_user.php?id=<?php echo $row['id']; ?>'">Delete</button>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="6">No users found</td>
            </tr>
        <?php endif; ?>
    </table>

    <button onclick="window.location.href='add_user.php'">Add New User</button>
    <button onclick="window.location.href='Admind.php'">Back</button>
</body>
</html>

<?php
$conn->close();
?>