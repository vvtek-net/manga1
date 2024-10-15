<?php
include 'config/db_connection.php';

// Lấy ngẫu nhiên một liên kết từ bảng manga_affiliate
$query = "SELECT aff_link FROM manga_affiliate ORDER BY RAND() LIMIT 1";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode(['aff_link' => $row['aff_link']]);
} else {
    echo json_encode(['aff_link' => null]);
}
?>
