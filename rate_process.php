<?php
include('config/db_connection.php');

// Kiểm tra xem tất cả các trường từ form có được gửi không
// var_dump($_GET['tinhcach']);
// var_dump($_GET['cottruyen']);
// var_dump($_GET['bocuc']);
// var_dump($_GET['chatluong']);
// var_dump($_GET['noidung']);
// var_dump($_GET['manga_id']);
// exit();
if (
    isset($_GET['tinhcach']) &&
    isset($_GET['cottruyen']) &&
    isset($_GET['bocuc']) &&
    isset($_GET['chatluong']) &&
    isset($_GET['noidung']) &&
    isset($_GET['manga_id'])  // Bạn cần truyền manga_id từ URL hoặc ẩn trong form
) {
    $tinhcach = intval($_GET['tinhcach']);
    $cottruyen = intval($_GET['cottruyen']);
    $bocuc = intval($_GET['bocuc']);
    $chatluong = intval($_GET['chatluong']);
    $noidung = $_GET['noidung'];
    $manga_id = intval($_GET['manga_id']); // Manga ID nhận từ form hoặc URL

    // Chuẩn bị câu truy vấn để chèn đánh giá vào bảng manga_rate
    $stmt = $conn->prepare("INSERT INTO manga_rate (rate_character_personality, rate_plot_content, rate_world_layout, rate_translation_quality, manga_id, update_at) 
                            VALUES (?, ?, ?, ?, ?, NOW())");
    $stmt->bind_param("iiiii", $tinhcach, $cottruyen, $bocuc, $chatluong, $manga_id);

    // Thực hiện truy vấn và kiểm tra kết quả
    if ($stmt->execute()) {
        echo "success"; // Thông báo thành công
        header("Location: story_detail.php?manga_id=" . $manga_id);
    } else {
        echo "error: " . $stmt->error; // Thông báo lỗi
    }

    // Đóng câu truy vấn và kết nối
    $stmt->close();
    $conn->close();
} else {
    echo "Dữ liệu không hợp lệ";
}
