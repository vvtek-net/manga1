<?php
include '../config/db_connection.php';

if (isset($_GET['id'])) {
    $type_id = $_GET['id'];
    $query = "DELETE FROM manga_type WHERE type_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $type_id);
    $stmt->execute();
}

header('Location: index.php');
exit();
