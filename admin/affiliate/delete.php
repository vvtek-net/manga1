<?php
include '../config/db_connection.php';

// Kiểm tra xem có 'id' trong GET request không
if (isset($_GET['id'])) {
    $aff_id = $_GET['id'];

    // Truy vấn để xóa bản ghi
    $query = "DELETE FROM manga_affiliate WHERE aff_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $aff_id);

    if ($stmt->execute()) {
        // Nếu xóa thành công, chuyển hướng về trang index
        header('Location: index.php?message=delete_success');
    } else {
        // Nếu có lỗi, có thể xử lý ở đây
        header('Location: index.php?message=delete_error');
    }
    exit();
} else {
    // Nếu không có 'id', chuyển hướng về trang index với thông báo lỗi
    header('Location: index.php?message=invalid_id');
    exit();
}
