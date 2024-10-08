<?php
session_start();

// Kết nối đến cơ sở dữ liệu
include('db_connection.php');

// Xử lý khi người dùng nhấn nút đăng ký
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';
    $fullname = isset($_POST['fullname']) ? trim($_POST['fullname']) : '';
var_dump($_POST['username']);
exit();
    // Kiểm tra các trường dữ liệu
    if (empty($username) || empty($password) || empty($fullname)) {
        $_SESSION['error'] = "Vui lòng điền đầy đủ thông tin.";
        header("Location: ../index.php?quanly=dangki");
        exit();
    }

    // Kiểm tra xem tên đăng nhập đã tồn tại chưa
    $check_sql = "SELECT * FROM accounts WHERE username = ?";
    $stmt = $conn->prepare($check_sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $check_result = $stmt->get_result();

    if ($check_result->num_rows > 0) {
        $_SESSION['error'] = "Tên đăng nhập đã tồn tại. Vui lòng chọn tên khác.";
        header("Location: ../index.php?quanly=dangki");
        exit();
    }

    // Mã hóa mật khẩu trước khi lưu vào cơ sở dữ liệu
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Thêm người dùng mới vào cơ sở dữ liệu
    $insert_sql = "INSERT INTO accounts (username, password, fullname, role_id, update_at) VALUES (?, ?, ?, ?, NOW())";
    $stmt = $conn->prepare($insert_sql);
    $role_id = 2; // Giả sử role_id là 2 cho người dùng thông thường
    $stmt->bind_param("sssi", $username, $hashed_password, $fullname, $role_id);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Đăng ký thành công. Bạn có thể đăng nhập.";
        header("Location: ../login.php");
    } else {
        $_SESSION['error'] = "Đã có lỗi xảy ra. Vui lòng thử lại.";
        header("Location: ../register.php");
    }

    // Đóng kết nối
    $stmt->close();
    $conn->close();
    exit();
}
?>
