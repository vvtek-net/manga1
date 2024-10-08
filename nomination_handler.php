<?php
include('config/db_connection.php');

// Kiểm tra xem manga_id có được gửi qua POST hay không
if (isset($_POST['manga_id'])) {
    $manga_id = intval($_POST['manga_id']);

    // Chuẩn bị truy vấn để thêm vào bảng nomination
    $stmt = $conn->prepare("INSERT INTO manga_nomination (manga_id, update_at) VALUES (?, NOW())");
    $stmt->bind_param("i", $manga_id);

    // Thực thi câu truy vấn và kiểm tra kết quả
    if ($stmt->execute()) {
        echo 'success';
    } else {
        echo 'error';
    }

    // Đóng câu truy vấn và kết nối
    $stmt->close();
    $conn->close();
} else {
    echo 'invalid'; // Trả về lỗi nếu không có manga_id
}
