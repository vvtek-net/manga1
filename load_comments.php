<?php
session_start();
include 'config/db_connection.php';  // Đảm bảo rằng tệp kết nối cơ sở dữ liệu được đưa vào

// Lấy manga_id từ yêu cầu AJAX
if (isset($_GET['manga_id'])) {
    $manga_id = $_GET['manga_id'];
    $chapter_id = $_GET['chapter_id'] == '' ? null : $_GET['chapter_id'];
    $offset = isset($_GET['offset']) ? intval($_GET['offset']) : 0; // Bắt đầu từ bình luận thứ mấy (để hỗ trợ load more)
    $limit = 5; // Số lượng bình luận tải mỗi lần

    // Truy vấn lấy bình luận từ bảng accounts và manga_comment dựa trên manga_id
    $query = "SELECT accounts.fullname, manga_comment.comment, manga_comment.update_at 
              FROM accounts 
              INNER JOIN manga_comment ON accounts.acc_id = manga_comment.acc_id 
              WHERE manga_comment.manga_id = ? AND manga_comment.chapter_id IS NULL
              LIMIT ?, ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('iii', $manga_id, $offset, $limit);
    $stmt->execute();
    $result = $stmt->get_result();

    // Lưu các bình luận vào một mảng
    $comments = array();
    while ($row = $result->fetch_assoc()) {
        $comments[] = $row;
    }

    // Trả về dữ liệu dưới dạng JSON
    echo json_encode($comments);
} else {
    echo json_encode(array("error" => "Missing manga_id"));
}
