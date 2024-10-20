<?php

// Đặt header cho phép yêu cầu từ bất kỳ nguồn gốc nào (có thể thay thế '*' bằng một domain cụ thể)
header("Access-Control-Allow-Origin: *");

// Nếu cần chấp nhận các phương thức HTTP cụ thể
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

// Nếu bạn cần chấp nhận các header cụ thể từ client
header("Access-Control-Allow-Headers: Content-Type, Authorization");

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
