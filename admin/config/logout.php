<?php
// Bắt đầu session
session_start();

// Hủy tất cả các session
session_unset();

// Hủy session hiện tại
session_destroy();

// Chuyển hướng người dùng về trang đăng nhập hoặc trang chủ
header("Location: ../login.php"); // Bạn có thể chuyển hướng tới bất kỳ trang nào mong muốn
exit();
