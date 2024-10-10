<?php
include '../config/db_connection.php';

// Kiểm tra xem có ID của chapter được truyền vào không
if (isset($_GET['id'])) {
    $chapter_id = $_GET['id'];

    // Bắt đầu transaction để đảm bảo tính toàn vẹn dữ liệu
    $conn->begin_transaction();

    try {
        // Xóa các bình luận liên quan trong bảng manga_comment trước
        $comment_query = "DELETE FROM manga_comment WHERE chapter_id = ?";
        $comment_stmt = $conn->prepare($comment_query);
        $comment_stmt->bind_param('i', $chapter_id);
        $comment_stmt->execute();

        // Sau khi xóa bình luận, xóa chương trong bảng chapter
        $chapter_query = "DELETE FROM chapter WHERE chapter_id = ?";
        $chapter_stmt = $conn->prepare($chapter_query);
        $chapter_stmt->bind_param('i', $chapter_id);
        $chapter_stmt->execute();

        // Kiểm tra xem có xóa thành công hay không
        if ($chapter_stmt->affected_rows > 0) {
            // Commit transaction nếu thành công
            $conn->commit();
            // Chuyển hướng về trang index sau khi xóa thành công
            header('Location: index.php');
            exit();
        } else {
            // Nếu xóa không thành công, rollback transaction
            $conn->rollback();
            echo "Lỗi: Không thể xóa chương.";
        }
    } catch (Exception $e) {
        // Rollback transaction nếu có lỗi xảy ra
        $conn->rollback();
        echo "Lỗi: " . $e->getMessage();
    }
} else {
    echo "Lỗi: Không có ID chương.";
}

?>
