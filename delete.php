<?php
// delete.php
include 'db.php';

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];

    $delete_sql = "DELETE FROM tasks WHERE id = $id";
    $conn->query($delete_sql);
}

// delete ke baad list par wapas
header("Location: index.php");
exit();
?>
