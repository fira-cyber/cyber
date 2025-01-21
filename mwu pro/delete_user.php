<?php
include 'db.php';

$id = $_GET['id'] ?? '';

if ($id) {
    $sql = "DELETE FROM users WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        echo "User deleted successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
    
    $stmt->close();
}

header("Location: manage_users.php");
$conn->close();
exit;
?>