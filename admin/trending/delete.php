<?php
include '../config/db_connection.php';

if (isset($_GET['id'])) {
    $trending_id = $_GET['id'];
    $query = "DELETE FROM trending WHERE trending_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $trending_id);
    $stmt->execute();
}

header('Location: index.php');
exit();
