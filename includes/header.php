<?php
// session_start(); // Bắt đầu phiên làm việc
include('config/db_connection.php');

// Truy vấn lấy các thể loại và danh sách thịnh hành
$query_type = "SELECT * FROM manga_type";
$query_trending = "SELECT * FROM trending";

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Thực hiện truy vấn trực tiếp và kiểm tra kết quả
$result_type = $conn->query($query_type);
$result_trending = $conn->query($query_trending);

$types = [];
$trendings = [];

if ($result_type && $result_type->num_rows > 0) {
    while ($row = $result_type->fetch_assoc()) {
        $types[] = $row;
    }
} else {
    // echo "Không tìm thấy dữ liệu cho bảng manga_type hoặc lỗi truy vấn: " . $conn->error;
}

if ($result_trending && $result_trending->num_rows > 0) {
    while ($row = $result_trending->fetch_assoc()) {
        $trendings[] = $row;
    }
} else {
    // echo "Không tìm thấy dữ liệu cho bảng trending hoặc lỗi truy vấn: " . $conn->error;
}
?>

<header class="site-header">
    <nav class="main-nav">
        <div class="nav-mobile123">
            <div class="nav-mobile">
                <button class="button-timkiem search-button" onclick="toggleSearch()" type="button">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
                <div class="nav-item logo">
                    <a class="logo" href="index.php">
                        <img alt="Logo" src="assets/image/logo.png" />
                    </a>
                </div>
                <div class="nav-items">
                    <button class="nav-button" onclick="toggleNav()" type="button">
                        <i class="fa-solid fa-bars"></i>
                    </button>
                </div>
            </div>
            <div class="nav-lists" id="navList" style="display: none;">
                <button class="close-nav" onclick="closeNav()" type="button"></button>
                <ul class="nav-menu">
                    <!-- Logo -->
                    <li class="nav-item logo">
                        <a class="nav-link123" href="index.php">
                            <img alt="Logo" class="logo-img" src="assets/image/logo.png" />
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <input class="timkiem search-input" id="searchContainer" onkeypress="handleKeyPress(event)" placeholder="Tìm kiếm..." style="display: none;" type="text" />
        <ul class="nav-list">
            <li class="nav-item logo">
                <a class="logo" href="index.php">
                    <img alt="Logo" src="assets/image/logo.png" />
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="filter.php">
                    <i class="fa-solid fa-bars"></i> Thể Loại
                </a>
                <!-- Thể loại dropdown -->
                <ul class="dropdown">
                    <?php if (!empty($types)): ?>
                        <?php foreach ($types as $type): ?>
                            <li>
                                <a href="filter.php?type_id=<?= urlencode($type['type_id']); ?>&type_name=<?= htmlspecialchars($type['type_name']); ?>">
                                    <?= htmlspecialchars($type['type_name']); ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Thịnh Hành</a>
                <ul class="dropdowns">
                    <?php if (!empty($trendings)): ?>
                        <?php foreach ($trendings as $trending): ?>
                            <li>
                                <a href="filter.php?trending_id=<?= urlencode($trending['trending_id']); ?>">
                                    <?= htmlspecialchars($trending['trending_name']); ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </ul>
            </li>
            <li class="nav-item-search-box">
                <input class="timkiem search-input" id="searchInput" onkeypress="handleKeyPress(event)" placeholder="Tìm kiếm..." type="text" />
                <button class="button-timkiem search-button" onclick="search()" type="button">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </li>

            <!-- Kiểm tra trạng thái đăng nhập -->
            <?php if (isset($_SESSION['fullname'])): ?>
                <li class="nav-item">
                    <?php
                    if ($_SESSION['role_id'] == 1) {
                        echo '<span class="nav-link"><a href="admin/index.php">Xin chào ' . $_SESSION['fullname'] . '</a></span>';
                    } else {
                        echo '<span class="nav-link">Xin chào ' . $_SESSION['fullname'] . '</span>';
                    }
                    ?>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="config/logout.php">Đăng Xuất</a>
                </li>
            <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Đăng Nhập</a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
</header>