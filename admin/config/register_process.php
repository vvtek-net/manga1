<?php
session_start();

// Kết nối đến cơ sở dữ liệu
include('db_connection.php');

// Xử lý khi người dùng nhấn nút đăng ký
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $username = isset($_GET['username']) ? trim($_GET['username']) : '';
    $password = isset($_GET['password']) ? trim($_GET['password']) : '';
    $fullname = isset($_GET['fullname']) ? trim($_GET['fullname']) : '';

    // Kiểm tra các trường dữ liệu
    if (empty($username) || empty($password) || empty($fullname)) {
        $_SESSION['error'] = "Vui lòng điền đầy đủ thông tin.";
        header("Location: ../register.php");
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
        header("Location: ../register.php");
        exit();
    }


    // Thêm người dùng mới vào cơ sở dữ liệu
    $insert_sql = "INSERT INTO accounts (username, password, fullname, role_id, update_at) VALUES (?, ?, ?, ?, NOW())";
    $stmt = $conn->prepare($insert_sql);
    $role_id = 2; // Giả sử role_id là 2 cho người dùng thông thường
    $stmt->bind_param("sssi", $username, $password, $fullname, $role_id);

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
