<?php
session_start();

// Kiểm tra nếu người dùng chưa đăng nhập hoặc không phải là admin
if (!isset($_SESSION['acc_id']) || $_SESSION['role_id'] !== 1) {
    header("Location: ../login.php");
    exit();
}

// Include kết nối cơ sở dữ liệu
include '../config/db_connection.php';

// Bạn có thể thêm truy vấn để lấy các thông tin thống kê nhanh tại đây (nếu cần)
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../../assets/css/styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        .header {
            background-color: #4CAF50;
            color: white;
            padding: 15px;
            text-align: center;
        }

        .sidebar {
            width: 200px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #333;
            padding-top: 20px;
        }

        .sidebar a {
            padding: 10px 15px;
            text-decoration: none;
            font-size: 18px;
            color: white;
            display: block;
            transition: 0.3s;
        }

        .sidebar a:hover {
            background-color: #4CAF50;
            color: white;
        }

        .content {
            margin-left: 220px;
            padding: 20px;
        }

        h1 {
            color: #333;
        }

        .stats-box {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .stats-box h2 {
            margin: 0;
            color: #4CAF50;
        }

        .stats-box p {
            margin: 10px 0;
            color: #555;
        }

        .stats-container {
            display: flex;
            justify-content: space-between;
            gap: 20px;
        }

        .stats-item {
            width: 48%;
        }
    </style>
</head>

<body>

    <div class="header">
        <h1>Admin Dashboard</h1>
        <p>Welcome to the Admin Panel</p>
    </div>

    <div class="sidebar">
        <a href="index.php">Dashboard</a>
        <a href="accounts/index.php">Manage Accounts</a>
        <a href="manga/index.php">Manage Manga</a>
        <a href="manga_type/index.php">Manage Manga Types</a>
        <a href="trending/index.php">Manage Trending</a>
        <a href="../config/logout.php">Logout</a>
    </div>

    <div class="content">
        <h1>Overview</h1>
        <div class="stats-container">
            <div class="stats-box stats-item">
                <h2>Number of Accounts</h2>
                <p><?php
                    // Example query to get the number of accounts
                    $query = "SELECT COUNT(*) as total_accounts FROM accounts";
                    $result = $conn->query($query);
                    $row = $result->fetch_assoc();
                    echo $row['total_accounts'];
                ?> Accounts</p>
            </div>
            <div class="stats-box stats-item">
                <h2>Number of Manga</h2>
                <p><?php
                    // Example query to get the number of manga
                    $query = "SELECT COUNT(*) as total_manga FROM manga";
                    $result = $conn->query($query);
                    $row = $result->fetch_assoc();
                    echo $row['total_manga'];
                ?> Manga</p>
            </div>
        </div>

        <div class="stats-box">
            <h2>Latest Manga Updates</h2>
            <ul>
                <?php
                // Example query to get the latest manga
                $query = "SELECT manga_name, author FROM manga ORDER BY manga_id DESC LIMIT 5";
                $result = $conn->query($query);
                while ($row = $result->fetch_assoc()) {
                    echo "<li>" . $row['manga_name'] . " by " . $row['author'] . "</li>";
                }
                ?>
            </ul>
        </div>
    </div>

</body>

</html>
