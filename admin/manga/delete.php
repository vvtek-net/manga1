<?php
include '../config/db_connection.php';

if (isset($_GET['id'])) {
    $manga_id = $_GET['id'];

    // Bắt đầu transaction để đảm bảo tính toàn vẹn dữ liệu
    $conn->begin_transaction();

    try {
        // Xóa dữ liệu liên quan trong bảng manga_completed
        $completed_query = "DELETE FROM manga_completed WHERE manga_id = ?";
        $completed_stmt = $conn->prepare($completed_query);
        $completed_stmt->bind_param('i', $manga_id);
        $completed_stmt->execute();

        // Xóa dữ liệu liên quan trong bảng manga_nomination
        $nomination_query = "DELETE FROM manga_nomination WHERE manga_id = ?";
        $nomination_stmt = $conn->prepare($nomination_query);
        $nomination_stmt->bind_param('i', $manga_id);
        $nomination_stmt->execute();

        // Xóa dữ liệu liên quan trong bảng manga_affiliate
        $affiliate_query = "DELETE FROM manga_affiliate WHERE manga_id = ?";
        $affiliate_stmt = $conn->prepare($affiliate_query);
        $affiliate_stmt->bind_param('i', $manga_id);
        $affiliate_stmt->execute();

        // Xóa dữ liệu liên quan trong bảng manga_rate
        $rate_query = "DELETE FROM manga_rate WHERE manga_id = ?";
        $rate_stmt = $conn->prepare($rate_query);
        $rate_stmt->bind_param('i', $manga_id);
        $rate_stmt->execute();

        // Xóa dữ liệu trong bảng manga
        $manga_query = "DELETE FROM manga WHERE manga_id = ?";
        $manga_stmt = $conn->prepare($manga_query);
        $manga_stmt->bind_param('i', $manga_id);
        $manga_stmt->execute();

        // Commit transaction nếu tất cả các bước đều thành công
        $conn->commit();

    } catch (Exception $e) {
        // Rollback transaction nếu có lỗi
        $conn->rollback();
        echo "Lỗi: " . $e->getMessage();
    }
}

// Sau khi xóa, chuyển hướng về trang index
header('Location: index.php');
exit();
?>
