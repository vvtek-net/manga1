<?php
include '../config/db_connection.php';
$query = "SELECT * FROM manga_type";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Manga Types</title>
    <link rel="stylesheet" href="../../assets/css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


    <style>
        body {
            display: flex;
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        .sidebar {
            width: 250px;
            background: linear-gradient(135deg, #ff7e5f, #feb47b);
            padding: 20px;
            color: white;
            box-shadow: 3px 0 5px rgba(0, 0, 0, 0.1);
            height: 100vh;
            position: fixed;
        }

        .sidebar h2 {
            color: #fff;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.4);
        }

        .sidebar a {
            display: block;
            padding: 10px;
            text-decoration: none;
            color: white;
            font-weight: bold;
            transition: background 0.3s ease, color 0.3s ease;
        }

        .sidebar a:hover {
            background-color: #ff5722;
            color: #fff;
            border-radius: 5px;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
        }

        .sidebar ul {
            padding-left: 15px;
            list-style-type: none;
            display: none;
            /* Ban đầu các sidebar con được ẩn đi */
        }

        .sidebar ul.expanded {
            display: block;
            /* Hiện ra khi người dùng nhấp vào */
        }

        .content {
            flex-grow: 1;
            padding: 30px;
            margin-left: 270px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .toggle-btn {
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            padding: 10px;
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 5px;
        }

        .toggle-btn:hover {
            background-color: rgba(255, 255, 255, 0.3);
        }
    </style>

</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <a href="../index.php">
            <h2>Dashboard</h2>
        </a>
        <!-- Accounts Section -->
        <div class="toggle-btn" onclick="toggleMenu('accounts-menu')">
            <span>Tài Khoản</span>
            <span>&#9660;</span>
        </div>
        <ul id="accounts-menu">
            <li><a href="../accounts/index.php">Quản Lý Tài Khoản</a></li>
            <li><a href="../accounts/create.php">Tạo Tài Khoản</a></li>
        </ul>

        <!-- Manga Section -->
        <div class="toggle-btn" onclick="toggleMenu('manga-menu')">
            <span>Truyện</span>
            <span>&#9660;</span>
        </div>
        <ul id="manga-menu">
            <li><a href="../manga/index.php">Danh Sách Truyện</a></li>
            <li><a href="../manga/create.php">Thêm Mới Truyện</a></li>
        </ul>

        <!-- Manga Type Section -->
        <div class="toggle-btn" onclick="toggleMenu('manga-type-menu')">
            <span>Thể Loại Truyện</span>
            <span>&#9660;</span>
        </div>
        <ul id="manga-type-menu">
            <li><a href="../manga_type/index.php">Loại Truyện</a></li>
            <li><a href="../manga_type/create.php">Thêm Mới</a></li>
        </ul>

        <!-- Trending Section -->
        <div class="toggle-btn" onclick="toggleMenu('trending-menu')">
            <span>Danh Mục Trending</span>
            <span>&#9660;</span>
        </div>
        <ul id="trending-menu">
            <li><a href="../trending/index.php">Loại Trending</a></li>
            <li><a href="../trending/create.php">Thêm Mới</a></li>
        </ul>

        <!-- Affiliate Section -->
        <div class="toggle-btn" onclick="toggleMenu('aff-menu')">
            <span>Affiliate</span>
            <span>&#9660;</span>
        </div>
        <ul id="aff-menu">
            <li><a href="index.php">Danh Sách Link Aff</a></li>
            <li><a href="create.php">Tạo Link Aff</a></li>
        </ul>

        <a href="../logout.php">Đăng Xuất</a>
    </div>

    <div class="content">
        <h1>Danh Mục Loại Truyện</h1>
        <a class="btn btn-success" href="create.php">Thêm Mới Loại Truyện</a>

        <table class="table" border="1">
            <thead>
                <tr>
                    <th>Tên Loại Truyện</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['type_name'] ?></td>
                        <td>
                            <a href="edit.php?id=<?= $row['type_id'] ?>" class="btn btn-warning">Sửa</a>
                            <a href="delete.php?id=<?= $row['type_id'] ?>" onclick="return confirm('Are you sure?')" class="btn btn-danger">Xóa</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <script>
        function toggleMenu(menuId) {
            const menu = document.getElementById(menuId);
            if (menu.classList.contains('expanded')) {
                menu.classList.remove('expanded');
            } else {
                menu.classList.add('expanded');
            }
        }
    </script>

</body>

</html>