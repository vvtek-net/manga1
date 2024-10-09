<?php
session_start();

// Kết nối đến cơ sở dữ liệu
include('db_connection.php');

// Xử lý khi người dùng nhấn nút đăng nhập
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $username = isset($_GET['username']) ? trim($_GET['username']) : '';
    $password = isset($_GET['matkhau']) ? trim($_GET['matkhau']) : '';

    // Mã hóa mật khẩu để kiểm tra với cơ sở dữ liệu (nếu đã mã hóa)
    // $password = md5($password);

    // Truy vấn kiểm tra thông tin tài khoản
    $sql = "SELECT * FROM accounts WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Đăng nhập thành công
        $user = $result->fetch_assoc();
        $_SESSION['acc_id'] = $user['acc_id'];
        $_SESSION['fullname'] = $user['fullname'];
        $_SESSION['role_id'] = $user['role_id'];

        // Điều hướng người dùng đến trang chính sau khi đăng nhập thành công
        header("Location: ../index.php");
        exit();
    } else {
        // Sai tên đăng nhập hoặc mật khẩu
        $_SESSION['error'] = "Sai tên đăng nhập hoặc mật khẩu.";
        header("Location: ../login.php");
        exit();
    }
}

// Đóng kết nối
$conn->close();
