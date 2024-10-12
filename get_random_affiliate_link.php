<?php
    // Kết nối tới cơ sở dữ liệu
    include('config/db_connection.php');
    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }

    // Truy vấn lấy một dòng ngẫu nhiên từ bảng manga_affiliate
    $query = "SELECT aff_link FROM manga_affiliate ORDER BY RAND() LIMIT 1";
    $result = $conn->query($query);

    // Kiểm tra kết quả và trả về link
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode($row['aff_link']); // Trả về link dưới dạng JSON
    } else {
        echo json_encode(null); // Trả về null nếu không có dữ liệu
    }

    $conn->close();
?>
