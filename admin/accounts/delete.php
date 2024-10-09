<?php
include '../config/db_connection.php';

if (isset($_GET['id'])) {
    $acc_id = $_GET['id'];
    $query = "DELETE FROM accounts WHERE acc_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $acc_id);
    $stmt->execute();
}

header('Location: index.php');
exit();
