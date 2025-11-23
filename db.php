<?php
// db.php
$host = "localhost";
$user = "root";   // XAMPP default
$pass = "";       // XAMPP default empty
$dbname = "task_manager";

// Create connection
$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Database Connection failed: " . $conn->connect_error);
}
?>
