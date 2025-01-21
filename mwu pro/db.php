<?php
$servername = "localhost";  // or your database server IP
$username = "root"; // database username
$password = ""; // database password
$dbname = "mwup";            // your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>