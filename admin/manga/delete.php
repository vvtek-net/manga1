<?php
include '../config/db_connection.php';

if (isset($_GET['id'])) {
    $manga_id = $_GET['id'];
    $query = "DELETE FROM manga WHERE manga_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $manga_id);
    $stmt->execute();
}

header('Location: index.php');
exit();
