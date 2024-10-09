<?php
session_start();

// Kiểm tra nếu người dùng chưa đăng nhập hoặc không phải là admin
if (!isset($_SESSION['acc_id']) || $_SESSION['role_id'] !== 1) {
    header("Location: ../login.php");
    exit();
}

// Kết nối cơ sở dữ liệu
include '../config/db_connection.php';

// Truy vấn thống kê từ cơ sở dữ liệu
$query_accounts = "SELECT COUNT(*) as total_accounts FROM accounts";
$result_accounts = $conn->query($query_accounts);
$row_accounts = $result_accounts->fetch_assoc();

$query_manga = "SELECT COUNT(*) as total_manga FROM manga";
$result_manga = $conn->query($query_manga);
$row_manga = $result_manga->fetch_assoc();

// Lấy dữ liệu cho biểu đồ
$query_manga_views = "SELECT manga_name, view_number FROM manga ORDER BY view_number DESC LIMIT 5";
$result_manga_views = $conn->query($query_manga_views);

$manga_names = [];
$view_numbers = [];

while ($row = $result_manga_views->fetch_assoc()) {
    $manga_names[] = $row['manga_name'];
    $view_numbers[] = $row['view_number'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
        }

        .sidebar ul.expanded {
            display: block;
        }

        .content {
            margin-left: 270px;
            padding: 30px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            flex-grow: 1;
        }

        .stat-box {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            margin-bottom: 20px;
        }

        .stat-box h3 {
            font-size: 24px;
            color: #333;
        }

        .stat-box p {
            font-size: 18px;
            margin: 0;
        }

        .chart-container {
            width: 100%;
            height: 400px;
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
        <a href="index.php"><h2>Dashboard</h2></a>
        <!-- Accounts Section -->
        <div class="toggle-btn" onclick="toggleMenu('accounts-menu')">
            <span>Accounts</span>
            <span>&#9660;</span>
        </div>
        <ul id="accounts-menu">
            <li><a href="accounts/index.php">View Accounts</a></li>
            <li><a href="accounts/create.php">Create Account</a></li>
        </ul>

        <!-- Manga Section -->
        <div class="toggle-btn" onclick="toggleMenu('manga-menu')">
            <span>Manga</span>
            <span>&#9660;</span>
        </div>
        <ul id="manga-menu">
            <li><a href="manga/index.php">View Manga</a></li>
            <li><a href="manga/create.php">Create Manga</a></li>
        </ul>

        <!-- Manga Type Section -->
        <div class="toggle-btn" onclick="toggleMenu('manga-type-menu')">
            <span>Manga Type</span>
            <span>&#9660;</span>
        </div>
        <ul id="manga-type-menu">
            <li><a href="manga_type/index.php">View Manga Types</a></li>
            <li><a href="manga_type/create.php">Create Manga Type</a></li>
        </ul>

        <!-- Trending Section -->
        <div class="toggle-btn" onclick="toggleMenu('trending-menu')">
            <span>Trending</span>
            <span>&#9660;</span>
        </div>
        <ul id="trending-menu">
            <li><a href="trending/index.php">View Trending</a></li>
            <li><a href="trending/create.php">Create Trending</a></li>
        </ul>
    </div>

    <!-- Main content -->
    <div class="content">
        <h1>Admin Dashboard</h1>

        <div class="row">
            <div class="col-md-6">
                <div class="stat-box">
                    <h3>Total Accounts</h3>
                    <p><?= $row_accounts['total_accounts'] ?> Accounts</p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="stat-box">
                    <h3>Total Manga</h3>
                    <p><?= $row_manga['total_manga'] ?> Manga</p>
                </div>
            </div>
        </div>

        <div class="row">
            <h2 class="text-center my-4">Top 5 Manga by Views</h2>
            <div class="col-12">
                <div class="chart-container">
                    <canvas id="mangaChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleMenu(menuId) {
            const menu = document.getElementById(menuId);
            menu.classList.toggle('expanded');
        }

        // Chart.js for bar chart
        var ctx = document.getElementById('mangaChart').getContext('2d');
        var mangaChart = new Chart(ctx, {
            type: 'bar', // Type of chart: 'bar', 'line', 'pie', etc.
            data: {
                labels: <?= json_encode($manga_names) ?>, // Manga names
                datasets: [{
                    label: 'Views',
                    data: <?= json_encode($view_numbers) ?>, // Views count
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

</body>

</html>
