<?php
session_start();
include 'config/db_connection.php';  // Đảm bảo rằng tệp kết nối cơ sở dữ liệu được đưa vào

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['acc_id'])) {
    echo "error: Bạn phải đăng nhập để bình luận";
    echo '<script type="text/javascript">
        window.history.back();
      </script>';
    exit;
}

// Kiểm tra xem dữ liệu GET có được gửi hay không
if (isset($_GET['comment'], $_GET['manga_id'])) {
    $comment = $_GET['comment'];
    $manga_id = $_GET['manga_id'];
    $acc_id = $_SESSION['acc_id'];  // Giả sử acc_id được lưu trong session

    // Kiểm tra nếu chapter_id không có, đặt giá trị mặc định là ''
    $chapter_id = isset($_GET['chapter_id']) ? $_GET['chapter_id'] : '';  // Nếu không có chapter_id thì dùng giá trị rỗng ''

    // Chuẩn bị câu truy vấn SQL, chú ý loại bỏ kiểu 'i' nếu chapter_id là chuỗi rỗng
    $query = "INSERT INTO manga_comment (comment, manga_id, chapter_id, acc_id) VALUES (?, ?, ?, ?)";
    if ($chapter_id === '') {
        // Nếu chapter_id rỗng, chuyển nó thành null hoặc giá trị hợp lệ tùy theo cấu trúc database
        $chapter_id = null; // Hoặc '' nếu cột này chấp nhận chuỗi rỗng.
        $stmt = $conn->prepare($query);
        $stmt->bind_param('sisi', $comment, $manga_id, $chapter_id, $acc_id); // Sử dụng kiểu 'i' nếu chapter_id là số
    } else {
        // Nếu chapter_id tồn tại, sử dụng kiểu số nguyên 'i'
        $stmt = $conn->prepare($query);
        $stmt->bind_param('siii', $comment, $manga_id, $chapter_id, $acc_id);
    }

    // Thực thi truy vấn
    if ($stmt->execute()) {
        // Sau khi thành công, sử dụng JavaScript để quay lại trang trước đó với alert
        echo '<script type="text/javascript">
            alert("Bình luận thành công!");
          </script>';
        if ($chapter_id === null) {
            header("Location: story.php?manga_id=$manga_id");
        } else {
            header("Location: story_detail.php?manga_id=$manga_id&chapter_id=$chapter_id");
        }
    } else {
        echo "error: " . $stmt->error;  // Phản hồi lỗi nếu có
    }
} else {
    echo "error: missing data";
}
