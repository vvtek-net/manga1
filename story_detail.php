<?php
include('config/db_connection.php');
$manga_id = isset($_GET['manga_id']) ? $_GET['manga_id'] : null;
$query = "select * from manga where manga_id = $manga_id";
$stmt = $conn->prepare($query);
$stmt->execute();
$manga_result = $stmt->get_result();
$result;
if ($manga_result->num_rows > 0) {
    $result = $manga_result->fetch_assoc();
}

// select chapter
$chapter_id = isset($_GET['chapter_id']) ? $_GET['chapter_id'] : null;
$queryChapter = "select * from chapter where chapter_id = $chapter_id";
$stmtChapter = $conn->prepare($queryChapter);
$stmtChapter->execute();
$chapter_result = $stmtChapter->get_result();
$chapter;

if ($chapter_result->num_rows > 0) {
    $chapter = $chapter_result->fetch_assoc();
}

// set datetime
$updateAtDate = new DateTime($chapter['update_at']);


// select all chapter of a manga
$queryAllChapter = "SELECT * FROM chapter WHERE manga_id = $manga_id";
$stmtAllChapter = $conn->prepare($queryAllChapter);
$stmtAllChapter->execute();
$result_chapters = $stmtAllChapter->get_result();

// Khởi tạo một mảng để chứa tất cả các chương
$chapters = [];

// Fetch tất cả các chương vào mảng
while ($row = $result_chapters->fetch_assoc()) {
    $chapters[] = $row;
}

?>


<!DOCTYPE html>
<html lang="vi">

<!-- Mirrored from truyentalespot.com/index.php?quanly=doc&id_truyen=108&id_chuong=11309 by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 28 Sep 2024 12:47:19 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">


<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-JTT7JZT6DT"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-JTT7JZT6DT');
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $result['manga_name']; ?></title>
    <meta property="og:title" content="Chờ Em Đào Hôn Lâu Lắm Rồi" />
    <meta property="og:image" content="https://res.cloudinary.com/deam5w1nh/image/upload/v1725960942/ganscwajrhjzja7eerrx.png" />
    <meta property="og:url" content="https://truyentalespot.com/index.php?quanly=thongtintruyen&amp;id_truyen=108&amp;id_chuong=11309" />
    <script async src="../pagead2.googlesyndication.com/pagead/js/f26c4.txt?client=ca-pub-9357006487999643"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/styles845a.css?v=1727527068">
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Agbalumo&amp;family=Inter:wght@300;400;500;600&amp;family=Oswald:wght@300;400;500&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" />
    <link rel="shortcut icon" type="image/png" href="assets/image/logo.ico">
    <meta name="google-signin-client_id" content="903289929360-7umpc2inp7iov7sbsmnrmpiai16onig9.apps.googleusercontent.com">
    <style>
        .comment-item {
            display: flex;
            align-items: flex-start;
            /* Căn giữa theo chiều dọc */
            background-color: #f9f9f9;
            /* Màu nền sáng */
            border: 1px solid #e1e1e1;
            /* Đường viền xung quanh */
            border-radius: 8px;
            /* Bo góc */
            padding: 10px;
            /* Khoảng đệm bên trong */
            margin-bottom: 10px;
            /* Khoảng cách giữa các bình luận */
            transition: background-color 0.3s;
            /* Hiệu ứng chuyển đổi màu nền */
        }

        .comment-item:hover {
            background-color: #f0f0f0;
            /* Màu nền khi hover */
        }

        .comment-avatar {
            margin-right: 10px;
            /* Khoảng cách giữa avatar và nội dung bình luận */
        }

        .comment-avatar img {
            border-radius: 50%;
            /* Bo tròn avatar */
            object-fit: cover;
            /* Cắt ảnh để giữ tỷ lệ */
        }

        .comment-content {
            flex: 1;
            /* Chiếm toàn bộ không gian còn lại */
        }

        .comment-content p {
            margin-top: 0;
            margin-bottom: 0;
            padding-top: 0;
            padding-bottom: 0;
            line-height: 1;
        }

        .comment-content h4 {
            margin-top: 0;
            margin-bottom: 0;
        }

        #submit-comment:hover {
            opacity: 0.7;
        }

        .next-chapter a:hover,
        .prev-chapter a:hover {
            background-color: #ccc;
        }
    </style>
</head>

<body>
    <?php
    include('includes/header.php');
    ?>
    <!-- Đoạn JavaScript để thực hiện tìm kiếm -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get all elements that should toggle the dropdowns
            var dropdownToggles = document.querySelectorAll('.toggleCollapse');

            // Add click event listener to each toggle
            dropdownToggles.forEach(function(toggle) {
                toggle.addEventListener('click', function(event) {
                    // Prevent default anchor click behavior
                    event.preventDefault();

                    // Toggle the display of the dropdown menu which is a sibling of the toggle
                    var dropdownMenu = this.nextElementSibling;

                    // Check if the clicked element is the anchor inside the list item
                    if (!dropdownMenu) {
                        // If not, find the dropdown menu within the parent element
                        dropdownMenu = this.parentNode.querySelector('.dropdown-menu');
                    }

                    var arrowIcon = this.querySelector('i.fa-chevron-down') || this.parentNode.querySelector('i.fa-chevron-down');

                    if (dropdownMenu && arrowIcon) {
                        if (dropdownMenu.style.display === 'flex') {
                            dropdownMenu.style.display = 'none';
                            arrowIcon.style.transform = ''; // Reset rotation of the icon
                        } else {
                            dropdownMenu.style.display = 'flex';
                            arrowIcon.style.transform = 'rotate(180deg)'; // Rotate icon 180 degrees
                        }
                    }
                });
            });
        });

        function handleKeyPress(event) {
            // Kiểm tra xem phím Enter (keyCode 13) đã được nhấn không
            if (event.keyCode === 13) {
                // Gọi hàm search() khi Enter được nhấn
                search();
            }
        }

        function search() {
            // Lấy giá trị từ ô nhập liệu tìm kiếm
            var searchInputValue = document.getElementById('searchInput').value.trim().toLowerCase();
            var searchContainerValue = document.getElementById('searchContainer').value.trim().toLowerCase();

            // Kết hợp cả hai giá trị nhập liệu tìm kiếm
            var searchTerm = searchInputValue || searchContainerValue;

            if (searchTerm !== '') {
                // Chuyển hướng đến trang kết quả tìm kiếm với tham số truyền vào
                window.location.href = 'filter.php?manga_name=' + encodeURIComponent(searchTerm);
            }
        }

        function toggleSearch() {
            var searchContainer = document.getElementById('searchContainer');
            var searchInput = document.getElementById('searchInput');
            var siteHeader = document.querySelector('.site-header'); // Lấy phần tử .site-header

            if (searchContainer.style.display === 'none' || searchContainer.style.display === '') {
                // Nếu searchContainer đang ẩn hoặc không có thuộc tính display
                searchContainer.style.display = 'block'; // Hiển thị searchContainer
                searchInput.style.display = 'block'; // Hiển thị searchInput
                siteHeader.classList.add('expanded'); // Thêm class .expanded để thay đổi giao diện .site-header
            } else {
                // Nếu searchContainer đang hiển thị
                searchContainer.style.display = 'none'; // Ẩn searchContainer
                searchInput.style.display = 'none'; // Ẩn searchInput
                siteHeader.classList.remove('expanded'); // Xóa class .expanded để trở về giao diện .site-header bình thường
            }
        }

        // Chỉ giữ lại một hàm toggleNav()
        function toggleNav() {
            var navList = document.getElementById('navList');

            // Kiểm tra xem lớp 'show' có được thêm vào không
            var isNavVisible = navList.classList.toggle('show');

            // Nếu 'show' được thêm vào, hiển thị navList
            if (isNavVisible) {
                navList.style.display = 'block';
            } else {
                // Ngược lại, ẩn navList
                navList.style.display = 'none';
            }
        }

        function closeNav() {
            var navList = document.getElementById('navList');

            // Loại bỏ lớp 'show' và ẩn navList
            navList.classList.remove('show');
            navList.style.display = 'none';
        }
    </script>
    <main>


        <div class="container-fluid">
            <div class="row">
                <!-- Menu -->
                <div class="cookie-consent-banner" id="cookie-consent-banner">
                    <div class="cookie-consent-container">
                        <p>Trang web này sử dụng cookie để đảm bảo bạn có được trải nghiệm tốt nhất trên trang web của chúng tôi.</p>
                        <button class="btn btn-primary" id="accept-cookie">Chấp nhận</button>
                    </div>
                </div>


                <!-- Nội dung chính -->
                <div class="content-container">
                    <div class="contents-container">
                        <div id="settingsPanel" class="settings-panel"><button id="closeBtn" class="close-btn">&times;</button>
                            <h3>Cài đặt tùy chỉnh</h3><label for="fontsize">Cỡ chữ:</label><select id="fontsize">
                                <option value="12">12</option>
                                <option value="14">14</option>
                                <option value="16">16</option>
                                <option value="18">18</option>
                                <option value="20">20</option>
                                <option value="22">22</option>
                                <option value="24">24</option>
                                <option value="26">26</option>
                                <option value="28">28</option>
                                <option value="30">30</option>
                            </select><label for="fontfamily">Font chữ:</label><select id="fontfamily">
                                <option value="Arial, sans-serif">Arial</option>
                                <option value="Times New Roman, serif">Times New Roman</option>
                                <option value="Courier New, monospace">Courier New</option>
                                <option value="Oswald, sans-serif">Oswald</option>
                                <option value="Inter, sans-serif">Inter</option>
                                <option value="Georgia, serif">Georgia</option>
                                <option value="Verdana, sans-serif">Verdana</option>
                                <option value="Tahoma, sans-serif">Tahoma</option>
                                <option value="Roboto, sans-serif">Roboto</option>
                                <option value="Helvetica, sans-serif">Helvetica</option>
                            </select><label for="lineheight">Độ dài dòng:</label><select id="lineheight">
                                <option value="1.0">100%</option>
                                <option value="1.2">120%</option>
                                <option value="1.4">140%</option>
                                <option value="1.6">160%</option>
                                <option value="1.8">180%</option>
                                <option value="2.0">200%</option>
                                <option value="2.2">220%</option>
                                <option value="2.4">240%</option>
                            </select><label for="backgroundcolor">Màu nền:</label><select id="backgroundcolor">
                                <option value="lightblue" style="background-color: lightblue; color: black;">Xanh nhạt</option>
                                <option value="lightyellow" style="background-color: lightyellow; color: black;">Vàng nhạt</option>
                                <option value="lightgray" style="background-color: lightgray; color: black;">Xám nhạt</option>
                                <option value="#232323" style="background-color: #232323; color: #ccc;">Đen</option>
                                <option value="white" style="background-color: white; color: black;">Trắng</option>
                                <option value="lavender" style="background-color: lavender; color: black;">Hoa oải hương</option>
                                <option value="#d0ffdcad" style="background-color: #d0ffdcad; color: black;">Xanh lá nhạt</option>
                                <option value="peachpuff" style="background-color: peachpuff; color: black;">Màu đào</option>
                                <option value="mintcream" style="background-color: mintcream; color: black;">Kem bạc hà</option>
                                <option value="aliceblue" style="background-color: aliceblue; color: black;">Xanh Alice</option>
                            </select>
                        </div>
                        <div class="chapter-info">
                            <div class="prev-chapter">
                                <?php

                                $currentChapterId = intval($_GET['chapter_id']);
                                // Tìm vị trí của chương hiện tại trong mảng
                                $currentChapterIndex = array_search($currentChapterId, array_column($chapters, 'chapter_id'));

                                if ($currentChapterIndex !== false && $currentChapterIndex != 0) {
                                ?>
                                    <a href='story_detail.php?manga_id=<?php echo $_GET['manga_id']; ?>&chapter_id=<?php echo $chapters[$currentChapterIndex - 1]['chapter_id'] ?>'>
                                        Trước
                                        <i class='fas fa-arrow-right'></i>
                                    </a>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="next-chapter">
                                <?php

                                $currentChapterId = intval($_GET['chapter_id']);
                                // Tìm vị trí của chương hiện tại trong mảng
                                $currentChapterIndex = array_search($currentChapterId, array_column($chapters, 'chapter_id'));

                                if ($currentChapterIndex !== false && $currentChapterIndex < count($chapters) - 1) {
                                ?>
                                    <a href='story_detail.php?manga_id=<?php echo $_GET['manga_id']; ?>&chapter_id=<?php echo $chapters[$currentChapterIndex + 1]['chapter_id'] ?>'>
                                        Sau
                                        <i class='fas fa-arrow-right'></i>
                                    </a>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="settings-menu">
                                <!-- <div id="settingsIcon" class="settings-icon" onclick="toggleSettingsPanel()"><i class="fa-solid fa-gear"></i> Tùy chỉnh</div> -->
                                <div id="chapterIcon" class="chapter-icon" onclick="toggleChapterModal()"><i class="fa-solid fa-list-ul"></i> Mục lục</div>
                                <!-- <div id="bookmarkIcon" class="bookmark-icon" onclick="alert('Vui lòng đăng nhập để đánh dấu.');"><i class="fa-solid fa-bookmark"></i> Đánh dấu</div> -->
                            </div>
                            <h2><a class="tentieude" href="story.php?manga_id=<?php echo $_GET['manga_id']; ?>"><?php echo $result['manga_name']; ?></a></h2>
                            <h3 class="chuong_ten"><?php echo $chapter['chapter_name']; ?></h3><i class="chuong_ten">Ngày cập nhật : <?php echo  $updateAtDate->format('d-m-Y'); ?></i>
                            <div id="chapterModal" class="chapter-modal" style="display: none;">
                                <div class="chapter-modal-content"><span class="close" onclick="toggleChapterModal()">&times;</span>
                                    <h2><a class="tentieude" href="story.php?manga_id=<?php echo $_GET['manga_id']; ?>"><?php echo $result['manga_name']; ?></a></h2>
                                    <h3 class="chuong_ten"><?php echo $result['manga_name']; ?></h3>
                                    <div class="chapter-order-icons"><span class="order-icon" onclick="loadChapters('asc')">&#x25B2;</span><span class="order-icon" onclick="loadChapters('desc')">&#x25BC;</span></div>
                                    <div id="chapterListContainer">
                                        <script>
                                            function loadChapters(order) {
                                                var data = {
                                                    "id_truyen": 108,
                                                    "order": order,
                                                    "current_chuong": 11309
                                                };

                                                // Gửi yêu cầu AJAX để lấy danh sách chương
                                                $.ajax({
                                                    url: "pages/getChapters.php", // Tệp PHP để lấy danh sách chương
                                                    type: "post",
                                                    data: data,
                                                    success: function(response) {
                                                        $("#chapterListContainer").html(response);
                                                    },
                                                    error: function(xhr, status, error) {
                                                        alert("Đã xảy ra lỗi khi tải danh sách chương.");
                                                    }
                                                });
                                            }

                                            // Tải danh sách chương ban đầu với thứ tự mặc định (nhỏ nhất)
                                            loadChapters("desc");
                                        </script>
                                        <ul class="chapter-list">
                                            <?php
                                            foreach ($chapters as $index => $a_chapter) {
                                                // Kiểm tra xem chapter_id có bằng với chương hiện tại không
                                                $is_current = ($a_chapter['chapter_id'] == $chapter_id);
                                            ?>
                                                <!-- <li class="current-chapter"><a href="index3833.html?quanly=doc&amp;id_truyen=108&amp;id_chuong=11309">Chương 1: Chương 1: Chuyển trường</a></li> -->
                                                <li class="<?php echo $is_current ? 'current-chapter' : 'chapter-item' ?>">
                                                    <a href="story_detail.php?manga_id=<?php echo $_GET['manga_id']; ?>&chapter_id=<?php echo $a_chapter['chapter_id'] ?>">Chương <?php echo $index + 1; ?>: <?php echo $a_chapter['chapter_name']; ?></a>
                                                </li>
                                                <!-- <li class="chapter-item"><a href="indexf0dd.html?quanly=doc&amp;id_truyen=108&amp;id_chuong=11350">Chương 3: Gâu</a></li>
                                                <li class="chapter-item"><a href="index4ba2.html?quanly=doc&amp;id_truyen=108&amp;id_chuong=11352">Chương 4: Tình cờ chạm mặt</a></li> -->
                                            <?php
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <script>
                                window.onload = function() {
                                    // Tải danh sách chương ban đầu với thứ tự mặc định (nhỏ nhất)
                                    loadChapters("desc");

                                    // Lấy vị trí của chương đang đọc
                                    var currentChapterPosition = document.querySelector(".current-chapter").offsetTop;
                                    // Cuộn đến vị trí của chương đang đọc
                                    document.querySelector("#chapterListContainer").scrollTop = currentChapterPosition;
                                }
                            </script>
                            <div class="chapter-content">
                                <div class="content-text">
                                    <?php echo $chapter['chapter_content']; ?>
                                </div>
                            </div>
                            <script type="text/javascript">
                                function confirmUnlockChapter(chapterId, chuongGold) {
                                    var userConfirmed = confirm("Cần " + chuongGold + " GOLD để mở khóa chương này!");

                                    if (userConfirmed) {
                                        var xhr = new XMLHttpRequest();
                                        xhr.open("POST.html", "pages/unlock_chapter.html", true);
                                        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                                        xhr.onreadystatechange = function() {
                                            if (this.readyState == 4 && this.status == 200) {
                                                var response = this.responseText;
                                                if (response == "success") {
                                                    alert("Chương đã được mở khóa.");
                                                    location.reload(); // Tải lại trang để cập nhật thông tin
                                                } else {
                                                    var userChoice = confirm("Bạn không đủ GOLD. Bạn có muốn mua thêm không?");
                                                    if (userChoice) {
                                                        window.location.href = "index043f.html?quanly=muagold"; // Chuyển đến trang mua gold
                                                    }
                                                }
                                            }
                                        };
                                        xhr.send("id_chuong=" + chapterId);
                                    } else {
                                        console.log("User canceled the unlock operation.");
                                    }
                                }
                            </script>
                            <div class="chapter-info">
                                <div class="prev-chapter">
                                    <?php

                                    $currentChapterId = intval($_GET['chapter_id']);
                                    // Tìm vị trí của chương hiện tại trong mảng
                                    $currentChapterIndex = array_search($currentChapterId, array_column($chapters, 'chapter_id'));

                                    if ($currentChapterIndex !== false && $currentChapterIndex != 0) {
                                    ?>
                                        <a href='story_detail.php?manga_id=<?php echo $_GET['manga_id']; ?>&chapter_id=<?php echo $chapters[$currentChapterIndex - 1]['chapter_id'] ?>'>
                                            Trước
                                            <i class='fas fa-arrow-right'></i>
                                        </a>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div class="next-chapter">
                                    <?php

                                    $currentChapterId = intval($_GET['chapter_id']);
                                    // Tìm vị trí của chương hiện tại trong mảng
                                    $currentChapterIndex = array_search($currentChapterId, array_column($chapters, 'chapter_id'));

                                    if ($currentChapterIndex !== false && $currentChapterIndex < count($chapters) - 1) {
                                    ?>
                                        <a href='story_detail.php?manga_id=<?php echo $_GET['manga_id']; ?>&chapter_id=<?php echo $chapters[$currentChapterIndex + 1]['chapter_id'] ?>'>
                                            Sau
                                            <i class='fas fa-arrow-right'></i>
                                        </a>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="chapter-navigation">
                                <div class="comments-section">
                                    <h3>Bình Luận</h3>
                                    <?php
                                    if (isset($manga_id) && isset($chapter['chapter_id'])) {

                                        // Inner Join accounts and manga_comment
                                        $query = "SELECT * FROM accounts INNER JOIN manga_comment ON accounts.acc_id = manga_comment.acc_id WHERE manga_id = ? AND chapter_id = ?";
                                        $stmt = $conn->prepare($query);
                                        $stmt->bind_param('ii', $manga_id, $chapter['chapter_id']);
                                        $stmt->execute();
                                        $result = $stmt->get_result();
                                        $comments = []; // Initialize comments variable
                                        while ($row = $result->fetch_assoc()) {
                                            $comments[] = $row;
                                        }
                                    ?>
                                        <form id="comment-form" method="get" action="submit_comment.php">
                                            <label for="comment">Nhập bình luận của bạn:</label>
                                            <textarea name="comment" id="comment" rows="4" required></textarea>
                                            <input type="hidden" name="manga_id" id="manga_id" value="<?php echo $manga_id; ?>">
                                            <input type="hidden" name="chapter_id" id="chapter_id" value="<?php echo $chapter_id; ?>">

                                            <input style="padding: 8px 10px; background-color: #5db85c; color: #fff; cursor: pointer;" type="submit" id="submit-comment" value="Đăng Bình Luận">
                                        </form>
                                        <p id="login-prompt" style="display: none;">Vui lòng <a href="indexe536.html?quanly=dangnhap">đăng nhập</a> để bình luận.</p>
                                        <!-- Bên dưới div comment-list -->
                                        <h3 class="theh"><?php echo (is_array($comments) ? count($comments) : 0) . " Thảo luận"; ?> </h3>
                                        <div id="comment-list">
                                            <!-- select all comments includes manga_id and chapter_id -->

                                        <?php

                                        $commentsPerPage = 5; // Số lượng bình luận hiển thị mỗi lần
                                        $totalComments = count($comments); // Tổng số bình luận

                                        // Lấy tối đa 5 bình luận đầu tiên
                                        $displayComments = array_slice($comments, 0, $commentsPerPage);

                                        // Assuming $manga_id and $chapter['chapter_id'] are properly set before this block
                                        // foreach ($comments as $comment) {
                                        //     echo '<div class="comment-item">
                                        //             <div class="comment-avatar">
                                        //                 <img src="assets/image/avatar.jpg" alt="Avatar" width="40" height="40">
                                        //             </div>
                                        //             <div class="comment-content">
                                        //                 <h4>' . htmlspecialchars($comment['fullname'], ENT_QUOTES, 'UTF-8') . '</h4>
                                        //                 <p>' . htmlspecialchars($comment['comment'], ENT_QUOTES, 'UTF-8') . '</p>
                                        //             </div>
                                        //         </div>';
                                        // }
                                    }
                                        ?>
                                        </div>
                                        <button id="load-more-comments" type="button">Xem thêm</button>
                                        <div id="pagination"></div>
                                </div>
                            </div>
                        </div>

                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                let currentPage = 0;
                                const commentsPerPage = 5;
                                const totalComments = <?php echo $totalComments; ?>; // Tổng số bình luận
                                const comments = <?php echo json_encode($comments); ?>; // Bình luận từ PHP

                                // Hàm để hiển thị thêm bình luận
                                function loadMoreComments() {
                                    const start = currentPage * commentsPerPage;
                                    const end = start + commentsPerPage;
                                    const newComments = comments.slice(start, end);

                                    newComments.forEach(comment => {
                                        const commentHtml = `<div class="comment-item">
                                                     <div class="comment-avatar">
                                                        <img src="assets/image/avatar.jpg" alt="Avatar" width="40" height="40">
                                                    </div>
                                                    <div class="comment-content">
                                                        <h4>${comment.fullname}</h4>
                                                        <p>${comment.comment}</p>
                                                    </div>
                                                </div>`;
                                        document.getElementById('comment-list').insertAdjacentHTML('beforeend', commentHtml);
                                    });

                                    currentPage++;

                                    // Ẩn nút nếu không còn bình luận
                                    if (currentPage * commentsPerPage >= totalComments) {
                                        document.getElementById('load-more-comments').style.display = 'none';
                                    }
                                }

                                // Gọi hàm loadMoreComments() khi truy cập trang
                                loadMoreComments();

                                // Hiển thị thêm bình luận khi nhấn nút "Xem thêm"
                                document.getElementById('load-more-comments').addEventListener('click', loadMoreComments);
                            });
                        </script>
                        <!-- <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                var submitButton = document.getElementById('submit-comment');
                                var commentInput = document.getElementById('comment');
                                var loadMoreButton = document.getElementById('load-more-comments');
                                var idTruyen = 108;
                                var idChuong = 1;

                                var offset = 0; // Khởi tạo offset ban đầu là 0
                                var limit = 5; // Số lượng bình luận cần tải mỗi lần

                                submitButton.addEventListener('click', function() {
                                    var commentContent = commentInput.value.trim();

                                    if (commentContent !== '') {
                                        // Gửi yêu cầu Ajax để đăng bình luận
                                        var xhr = new XMLHttpRequest();
                                        xhr.open('POST.html', 'pages/submit_comment.html', true);
                                        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                                        xhr.onreadystatechange = function() {
                                            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                                                var response = JSON.parse(xhr.responseText);
                                                if (response.status === 'success') {
                                                    loadComments(idTruyen, idChuong, 0); // Load lại từ đầu
                                                    commentInput.value = ''; // Xóa nội dung trong textarea
                                                    offset = 0; // Reset offset khi đăng bình luận mới
                                                } else {
                                                    alert(response.message);
                                                }
                                            }
                                        };
                                        // Thêm id_chuong vào yêu cầu gửi đi
                                        xhr.send('id_truyen=' + idTruyen + '&id_chuong=' + idChuong + '&comment=' + encodeURIComponent(commentContent));
                                    }
                                });
                                loadMoreButton.addEventListener('click', function() {
                                    loadComments(idTruyen, idChuong, offset);
                                });

                                // function loadComments(idTruyen, idChuong, currentOffset) {
                                //     var commentListContainer = document.getElementById('comment-list');
                                //     if (currentOffset === 0) {
                                //         commentListContainer.innerHTML = ''; // Clear comments if loading from start
                                //     }

                                //     var xhr = new XMLHttpRequest();
                                //     xhr.open('POST.html', 'pages/comment.html', true);
                                //     xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                                //     xhr.onreadystatechange = function() {
                                //         if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                                //             var comments = JSON.parse(xhr.responseText);
                                //             comments.forEach(function(comment) {
                                //                 var li = document.createElement('li');
                                //                 li.className = 'li-acfs';

                                //                 var divAvatar = document.createElement('div');
                                //                 divAvatar.className = 'comment-avatar';
                                //                 var img = document.createElement('img');

                                //                 // Kiểm tra xem comment.user_avatar có phải là một URL hay không
                                //                 if (/^(http|https):\/\/.+$/.test(comment.user_avatar)) {
                                //                     // Nếu là URL, sử dụng đường dẫn trực tiếp
                                //                     img.src = comment.user_avatar;
                                //                 } else {
                                //                     // Nếu không phải là URL, sử dụng đường dẫn tương đối
                                //                     img.src = './assets/image/' + comment.user_avatar;
                                //                 }

                                //                 img.alt = 'Avatar';
                                //                 img.className = 'rounded-circle';
                                //                 img.width = '30';
                                //                 divAvatar.appendChild(img);

                                //                 var divContent = document.createElement('div');
                                //                 divContent.className = 'comment-content';

                                //                 var pUser = document.createElement('p');
                                //                 pUser.className = 'comment-info';
                                //                 pUser.textContent = comment.user_tenuser;

                                //                 // Tạo một phần tử <span> mới để hiển thị thông tin chương
                                //                 var spanChapter = document.createElement('span');
                                //                 spanChapter.className = 'comment-chapter';
                                //                 spanChapter.textContent = ' Chương: ' + comment.id_chuong; // Hiển thị thông tin chương
                                //                 spanChapter.style.marginLeft = '5px'; // Tạo khoảng cách giữa tên người dùng và thông tin chương

                                //                 // Thêm thông tin chương sau tên người dùng
                                //                 pUser.appendChild(spanChapter);

                                //                 var pTime = document.createElement('p');
                                //                 pTime.className = 'comment-time';
                                //                 pTime.textContent = comment.binhluan_ngay;

                                //                 var pContent = document.createElement('p');
                                //                 pContent.className = 'chapter-content';
                                //                 pContent.textContent = comment.binhluan_noidung;

                                //                 divContent.appendChild(pUser);
                                //                 divContent.appendChild(pTime);
                                //                 divContent.appendChild(pContent);

                                //                 li.appendChild(divAvatar);
                                //                 li.appendChild(divContent);

                                //                 commentListContainer.appendChild(li);
                                //             });

                                //             if (comments.length === limit) {
                                //                 offset += limit; // Only update offset if full set of comments was loaded
                                //             }
                                //         } else if (xhr.readyState === XMLHttpRequest.DONE) {
                                //             alert('Đã có lỗi xảy ra khi tải danh sách bình luận.');
                                //         }
                                //     };
                                //     // Thêm id_chuong vào yêu cầu gửi đi
                                //     xhr.send('id_truyen=' + idTruyen + '&id_chuong=' + idChuong + '&offset=' + currentOffset + '&limit=' + limit);
                                // }

                                // Tải danh sách bình luận ban đầu khi trang được tải
                                loadComments(idTruyen, idChuong, offset);
                            });
                        </script> -->

                        <!-- <script>
                            function bookmarkChapter(id_truyen, chapterId, userId) {
                                var data = {
                                    'id_truyen': id_truyen,
                                    'id_chuong': chapterId,
                                    'id_user': userId
                                };

                                // Send AJAX request to server to add bookmark
                                $.ajax({
                                    url: 'pages/danhdau.php', // Your PHP script for adding bookmark
                                    type: 'post',
                                    data: data,
                                    success: function(response) {
                                        if (response === 'success') {
                                            // Change the icon to a checkmark and update the onclick event to removeBookmark
                                            $('#bookmarkIcon').html('<i class="fa-solid fa-circle-check"></i> Đã đánh dấu').attr('onclick', 'removeBookmark(' + id_truyen + ', ' + chapterId + ', ' + userId + ')');
                                            alert('Đánh dấu thành công.');
                                        } else {
                                            alert('Đánh dấu không thành công.');
                                        }
                                    },
                                    error: function(xhr, status, error) {
                                        alert('Đã xảy ra lỗi khi đánh dấu.');
                                    }
                                });
                            }

                            function removeBookmark(id_truyen, chapterId, userId) {
                                var data = {
                                    'id_truyen': id_truyen,
                                    'id_chuong': chapterId,
                                    'id_user': userId,
                                    'action': 'remove'
                                };

                                // Send AJAX request to server to remove bookmark
                                $.ajax({
                                    url: 'pages/huydanhdau.php', // Your PHP script for removing bookmark
                                    type: 'post',
                                    data: data,
                                    success: function(response) {
                                        if (response === 'success') {
                                            // Change the icon back to a bookmark and update the onclick event to bookmarkChapter
                                            $('#bookmarkIcon').html('<i class="fa-solid fa-bookmark"></i> Đánh dấu').attr('onclick', 'bookmarkChapter(' + id_truyen + ', ' + chapterId + ', ' + userId + ')');
                                            alert('Đánh dấu đã được hủy.');
                                        } else {
                                            alert('Không thể hủy đánh dấu.');
                                        }
                                    },
                                    error: function(xhr, status, error) {
                                        alert('Lỗi khi gửi yêu cầu hủy đánh dấu.');
                                    }
                                });
                            }
                        </script> -->
                        <script>
                            function toggleChapterModal() {
                                var chapterModal = document.getElementById("chapterModal");
                                if (chapterModal.style.display === "none" || chapterModal.style.display === "") {
                                    chapterModal.style.display = "block";
                                    document.body.style.overflow = "hidden"; // Khóa cuộn trang khi modal hiển thị
                                } else {
                                    chapterModal.style.display = "none";
                                    document.body.style.overflow = ""; // Mở lại cuộn trang khi modal ẩn đi
                                }
                            }
                        </script>




                        <!-- Thêm vào trang HTML hoặc file template -->
                        <script src="../code.jquery.com/jquery-3.6.4.min.js"></script>


                        <script>
                            function navigateToChapter() {
                                // Lấy id_truyen từ URL
                                const urlParams = new URLSearchParams(window.location.search);
                                const idTruyen = urlParams.get('id_truyen');

                                // Lấy giá trị chương từ dropdown
                                const selectedChapterId = document.getElementById('chapter-list').value;

                                // Lưu số chương đang đọc vào local storage
                                localStorage.setItem('sochuong_dang_doc', selectedChapterId);

                                // Chuyển hướng đến trang chương
                                window.location.href = 'index4a5d.html?quanly=doc&amp;id_truyen=' + idTruyen + '&id_chuong=' + selectedChapterId;
                            }

                            // Gọi hàm navigateToChapter khi trang được tải
                        </script>
                        <!-- <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                var settingsPanel = document.getElementById('settingsPanel');
                                var closeBtn = document.getElementById('closeBtn'); // Lấy nút "X"
                                var isOpen = false;

                                function closeSettingsPanel() {
                                    settingsPanel.style.display = 'none';
                                    isOpen = false;
                                }

                                function toggleSettingsPanel() {
                                    // Kiểm tra xem settingsPanel đã hiển thị hay chưa
                                    if (isOpen) {
                                        closeSettingsPanel();
                                    } else {
                                        settingsPanel.style.display = 'block';
                                        isOpen = true;
                                    }
                                }

                                // Gọi hàm closeSettingsPanel khi click ra ngoài settingsPanel
                                document.addEventListener('click', function(event) {
                                    var isClickInside = settingsPanel.contains(event.target);
                                    if (!isClickInside && isOpen) {
                                        closeSettingsPanel();
                                    }
                                });

                                // Gọi hàm closeSettingsPanel khi nhấn phím Esc
                                document.addEventListener('keydown', function(event) {
                                    if (event.key === 'Escape' && isOpen) {
                                        closeSettingsPanel();
                                    }
                                });

                                // Gọi hàm toggleSettingsPanel khi click vào settingsIcon
                                var settingsIcon = document.getElementById('settingsIcon');
                                if (settingsIcon) { // Kiểm tra nếu settingsIcon tồn tại
                                    settingsIcon.addEventListener('click', function(event) {
                                        event.stopPropagation(); // Ngăn chặn sự kiện click bị lan truyền lên
                                        toggleSettingsPanel();
                                    });
                                }

                                closeBtn.addEventListener('click', function() {
                                    closeSettingsPanel();
                                });

                                // Đảm bảo settingsPanel ở trạng thái tắt khi trang tải xong
                                // Bỏ qua việc gọi closeSettingsPanel() ở đây vì chúng ta không muốn nó bật lên rồi tắt ngay khi trang tải xong
                                // closeSettingsPanel();
                            });
                        </script> -->

                        <script>
                            // Hàm giải mã nội dung đã mã hóa
                            function decryptContent(encryptedContent) {
                                // Giải mã từ base64
                                var decodedContent = atob(encryptedContent);
                                // Hiển thị nội dung
                                document.getElementById('encrypted-content').innerHTML = decodedContent;
                            }

                            // Giả sử 'encryptedContent' chứa nội dung đã được mã hóa trên server
                            var encryptedContent = "VGjDoW5nIHTDoW0g4bufIFTDonkgVGjDoG5oLCBjw6FpIG7Ds25nIHbhuqtuIGNoxrBhIHRhbiwga2jhuq9wIG7GoWkgdHLDqm4gxJHGsOG7nW5nIHBo4buRIHbhuqtuIHRo4bqleSBuaGnhu4F1IG5nxrDhu51pIMSRaSDEkcaw4budbmcgbeG6t2Mgw6FvIG5n4bqvbiB0YXkuDQpNw7lhIGjDqCDhu58gY8OhYyB0aMOgbmggcGjhu5EgcGjDrWEgTmFtIGx1w7RuIOG6qW0gdsOgIG9pIGLhu6ljLCBoYWkgaMO0bSB0csaw4bubYyDEkcOjIGPDsyBt4buZdCB0cuG6rW4gbcawYSBs4bubbiwgbeG6t3QgxJHhuqV0IMaw4bubdCDEkeG6v24gZ2nhu50gduG6q24gY2jGsGEga2jDtC4gQ+G7lW5nIHRyxrDhu51uZyBUcsaw4budbmcgVHJ1bmcgaOG7jWMgU+G7kSAyIFTDonkgVGjDoG5oIG7hurFtIHRyw6puIG3hu5l0IHbhu4lhIGjDqCBjxakga+G7uSDEkcaw4bujYyBsw6F0IGfhuqFjaCwgdsOgaSBo4buNYyBzaW5oIG3hurdjIMSR4buTbmcgcGjhu6VjIGzDoWMgxJHDoWMgxJFpIHF1YSDEkcOzLg0KSGFpIGLDqm4gdMaw4budbmcgY8OzIG5oaeG7gXUgduG6v3Qga2jhuq9jIMSRxrDhu6NjIGTDoW4gbeG7mXQgbOG7m3AgZ2nhuqV5IGLDoW8gY2jhu5NuZyBjaMOpbyBsw6puIG5oYXUuDQpDw6BuZyBn4bqnbiBj4buVbmcgdHLGsOG7nW5nIGPDoG5nIHRo4bqleSDEkcaw4bujYyBi4bupYyB0xrDhu51uZyBjxakgxJHDoyDEkcaw4bujYyB24bq9IGdyYWZmaXRpIG3hu5l0IG7hu61hLCBjw6FjIGxv4bqhaSB04budIHLGoWkgcXXhuqNuZyBjw6FvIG5o4buPIGJheSDEkeG6p3kgdHLhu51pLg0K4oCU4oCUIFRo4bqneSBiw7NpIMSRw6J5ISBDaOG7iSBj4bqnbiBt4buZdCBwaMO6dCBsw6AgYmnhur90IGjhu40gdMOqbiBi4bqhbiENCuKAlOKAlCBCaeG7g3UgdMaw4bujbmcgaOG7k2kgdMOibSBjaHV54buDbiDDvSBoaeG7h3UgcXXhuqMgaMO0bSBuYXkgZ2nhuqNtIGdpw6EsIG7Eg20gdOG7hyBt4buZdCB04bqlbSwgY8OzIHRo4bq7IGjhu41jIHNpbmggZ2nhuqNtIDIwJSENCuKAlOKAlCBUw6xtIG5nxrDhu51pIGJhIEhvw6BuZyBLaW0hIE5nxrDhu51pIHBow7kgaOG7o3A6IGtow7RuZyBnaeG7m2kgaOG6oW4gdHXhu5VpIHTDoWMsIGPhuqVwIGLhuq1jIHThu5FpIHRoaeG7g3UgdHJvbmcgZ2FtZSBwaOG6o2kgbMOgIFRpbmggRGnhu4d1IQ0KUXXhuqNuZyBjw6FvIGN14buRaSBjw7luZyBjw7JuIGvDqG0gdGhlbyBt4buZdCDhuqNuaCBjaOG7pXAgbsSDbSBs4bqnbiBxdeG7syBn4buRaS4NCuG7niB0csOqbiBjw7MgbeG7mXQgZMOybmcgY2jhu68gcXXhuqNuZyBjw6FvIGtoaeG6v24gbmfGsOG7nWkgdGEgcsahaSBuxrDhu5tjIG3huq90Og0K4oCcSOG7lyB0cuG7oyBwaOG7pWMgaMawbmcgaOG6u20gbsO6aSwgdGjhuq9wIHPDoW5nIGdp4bqlYyBtxqEgY+G7p2EgaMOgbmcgdHJp4buHdSB0cuG6uyBlbSHigJ0NCuKAnEJhIGJhLCBiYSDhu58gxJHDonXigKYgQ29uIOG7nyBo4bq7bSBuw7ppIG114buRbiBn4bq3cCBiYSBs4bqvbeKApuKAnQ0KVGnhur9uZyB2ZSBrw6p1IGtow7RuZyBk4bupdC4NClbDoG8gZ2nhu50gbmdo4buJIHRyxrBhLCBj4buVbmcgdHLGsOG7nW5nIFRyxrDhu51uZyBUcnVuZyBo4buNYyBT4buRIDIgbeG7nyB0cm9uZyBu4butYSBnaeG7nSwgY2hvIHBow6lwIGjhu41jIHNpbmggcmEga2h1IHBo4buRIMSDbiB24bq3dCBn4bqnbiBj4buVbmcgbXVhIGLhu69hIHRyxrBhLg0KTmhp4buBdSBu4buvIHNpbmggbeG6t2MgxJHhu5NuZyBwaOG7pWMgbmfhu5NpIHRyb25nIHF1w6FuIHRyw6Agc+G7r2EsIGzDqW4gbMO6dCBs4bqleSDEkWnhu4duIHRob+G6oWkgcmEgbMaw4bubdCBt4bqhbmcgeMOjIGjhu5lpLiBMw7pjIG7DoHksIGRp4buFbiDEkcOgbiBj4bunYSBUcsaw4budbmcgVHJ1bmcgaOG7jWMgU+G7kSAyIMSRw6MgYuG7iyBt4buZdCBi4bupYyDhuqNuaCBjaOG7pXAgbMOpbiBsw6BtIGNobyBuw6FvIGxv4bqhbi4NCkRp4buFbiDEkcOgbiBj4bunYSBUcsaw4budbmcgVHJ1bmcgaOG7jWMgU+G7kSAyOiBOw6B5LCBjw6FjIGFuaCBlbSwgdHLGsGEgbmF5IGPDsyBt4buZdCBjaGnhur9jIFJvbGxzLVJveWNlIMSR4bqtdSB0csaw4bubYyBj4buVbmcgdHLGsOG7nW5nISBDw7MgYuG6sW5nIGPDsyBjaOG7qW5nLCDEkcOieSBsw6AgdGnhu4N1IHRoxrAgaGF5IHRoaeG6v3UgZ2lhIG5ow6AgbsOgbyDEkeG6v24gaOG7jWMgxJHDonk/DQpCw6xuaCBsdeG6rW4gbuG7kWkgdGnhur9wOg0K4oCcNjY2Ni7igJ0NCuKAnFTDtGkgdGjhuqV5IHLhu5NpLCB4ZSB24bqrbiDEkeG6rXUg4bufIMSRw7Mu4oCdDQrigJxDw7MgdGluIMSR4buTbiBuw7NpIGzDoCBo4buNYyBzaW5oIGNodXnhu4NuIHRyxrDhu51uZywgaMOsbmggbmjGsCBjaHV54buDbiB2w6BvIGzhu5twIHRo4buxYyBuZ2hp4buHbSBuxINtIDIh4oCdDQrigJxM4bubcCB0aOG7sWMgbmdoaeG7h20/IEPDsyB0aGnhur91IGdpYSBuw6BvIG5naMSpIHF14bqpbiBjaHV54buDbiB2w6BvIGzhu5twIHRo4buxYyBuZ2hp4buHbSBj4bunYSB0csaw4budbmcgbcOsbmggdGjhur8sIMSRxrDhu6NjIHPhu5FuZyB0aMOqbSB2w6BpIG7Eg20gbcOgIGtow7RuZyBtdeG7kW4gw6DigKbigKbigJ0NCuKApuKApg0KQuG7qWMg4bqjbmggUm9sbHMtUm95Y2UgdHLDqm4gZGnhu4VuIMSRw6BuIMSRw6MgxJHGsOG7o2MgY2hpYSBz4bq7IGjGoW4gbeG7mXQgbmdow6xuIGzGsOG7o3QsIG5oxrBuZyBjaMOtbmggY2jhu6cgbOG6oWkgaG/DoG4gdG/DoG4ga2jDtG5nIGhheSBiaeG6v3QuDQpI4bqhIEtow6JtIG1hbmcgbeG7mXQgY8OhaSBiYSBsw7QgxJFlbiBy4buXbmcsIGLDqm4gdGF5IHBo4bqjaSBsw6AgbeG7mXQgY2hp4bq/YyB2YWxpLCDEkeG7qW5nIHnDqm4gbOG6t25nIHRyxrDhu5tjIGPhu61hIHBow7JuZyBnacOhbyB24bulLiBOaMOsbiBxdWEsIGPhuq11IGzDoCBt4buZdCB0aGnhur91IG5pw6puIGfhuqd5IGfDsi4gRMOhbmcgbmfGsOG7nWkgdGjhurNuZyB04bqvcCwgbmjGsG5nIGtow7RuZyBjYW8gcXXDoSBt4buZdCBtw6l0IHTDoW0uIFTDs2MgaMahaSBkw6BpLCBjaOG7iSBsw6AgxJFhbmcgxJFlbyBt4buZdCBj4bq3cCBrw61uaCDEkWVuIGPhu5NuZyBr4buBbmgsIGNoZSBraHXhuqV0IHBo4bqnbiBs4bubbiB24bq7IMSR4bq5cCBj4bunYSBtw6xuaC4gTuG6v3UgcXVhbiBzw6F0IGvhu7ksIGtow7RuZyBraMOzIMSR4buDIG5o4bqtbiByYSBj4bqtdSBsw6AgbeG7mXQgY2jDoG5nIHRyYWkgxJHhurlwIHRyYWkgaMahaSBxdcOhIG3hu6ljLg0KV2VDaGF0IGxpw6puIHThu6VjIGhp4buHbiBsw6puIHRpbiBuaOG6r24gdOG7qyBuZ8aw4budaSBi4bqhbiB0aOG7nWkgdGjGoSDhuqV1IOG7nyBC4bqvYyBLaW5oIC0gRGnDqm0gTeG6oW4uIEPDtCBkw7kgY8OhY2ggeGEgaMOgbmcgbmfDoG4gY8OieSBz4buRLCB24bqrbiBraMO0bmcgbmfhu6tuZyBsbyBs4bqvbmcgY2hvIGPhuq11LiBWb2ljZSBjaGF0IMSRxrDhu6NjIGfhu61pIMSRaSB04burbmcgY8OhaSBt4buZdCwgbeG7l2kgY8OhaSDEkeG7gXUgZMOgaSBoxqFuIHPDoXUgbcawxqFpIGdpw6J5LiBI4bqhIEtow6JtIG5ow6xuIHh14buRbmcsIGhvw6BuIHRvw6BuIGtow7RuZyBt4bufIHJhLCBiw6xuaCB0aOG6o24gdHLhuqMgbOG7nWk6IFtCaeG6v3QgcuG7k2kuXQ0KW0Phuq11IGJp4bq/dCBnw6wgcuG7k2kgaOG6oz8/P10gDQpEacOqbSBN4bqhbiB0aOG6pXkgcGjhuqNuIGjhu5NpIGPhu6dhIGPhuq11LCBs4bqtcCB04bupYyBn4butaSBiYSBiaeG7g3UgdMaw4bujbmcgY+G6o20geMO6YyBnaeG6rW4gZOG7ry4gQ8OzIHRo4buDIHRo4bqleSBjxqFuIGdp4bqtbiBj4bunYSBjw7QgcuG6pXQgbOG7m24uDQpbQ+G6rXUgbmdoZSB0aOG7rSB4ZW0gdMO0aSDEkcOjIG7Ds2kgZ8OsIHRyb25nIHZvaWNlIGNoYXQgdHLGsOG7m2MgxJHDsyBjb2k/P10gDQpI4bqhIEtow6JtIG3hu58gdGluIG5o4bqvbiwgZ2nhu41uZyBC4bqvYyBLaW5oIGNodeG6qW4gY+G7p2EgRGnDqm0gTeG6oW4gxJHGsOG7o2MgcGjDoXQgcmE6IOKAnE3hurkgY+G7p2EgbeG6uSBn4buNaSBsw6AgYsOgIG5nb+G6oWksIHbhuq15IGJhIGPhu6dhIGJhIGfhu41pIGzDoCBnw6w/4oCdDQpI4bqhIEtow6JtOiDigJzigKbigKbigJ0NCuKAnEPhuq11IGPDsyB24bqlbiDEkeG7gS4gR+G7rWkgY8OhaSBuw6B5IGNobyB0w7RpIGzDoG0gZ8OsP+KAnSANCkRpw6ptIE3huqFuIG5naGnDqm0gdMO6YyDEkcOhcDogW8SQ4buDIGtp4buDbSB0cmEgeGVtIGPhuq11IGPDsyBuZ2hlIGvhu7kgdm9pY2UgY2hhdCBj4bunYSB0w7RpIGtow7RuZy5dDQpI4bqhIEtow6JtIGzhuqFpIG3hu5l0IGzhuqduIG7hu69hIGfhu61pIMSRaSBzw6F1IGThuqV1IGNo4bqlbS4NCkRpw6ptIG7hu68gc8SpIGtpw6puIHRyw6wgbmjhuq9uIHRpbiwgbOG6p24gbsOgeSB0b8OgbiBi4buZIMSR4buBdSBsw6AgZ8O1IGNo4buvOiBbQW5oIEtow6JtLCDEkeG7q25nIGxvIGzhuq9uZy4gTeG6t2MgZMO5IGPhuq11IMSRw6MgY2h1eeG7g24gdHLGsOG7nW5nIMSR4bq/biBUw6J5IFRow6BuaCwgbmjGsG5nIGxpbmggaOG7k24gdsOgIHRpbmggdGjhuqduIGPhu6dhIGPhuq11IHPhur0gbcOjaSBtw6NpIOG7nyBs4bqhaSBUcsaw4budbmcgVHJ1bmcgaOG7jWMgU+G7kSAxMyB2xKkgxJHhuqFpIGPhu6dhIGNow7puZyB0YSFdDQpI4bqhIEtow6JtIGzGsOG7nWkgYmnhur9uZyDEkcOhcCBs4bqhaTogW07Ds2kgdGnhur9uZyBuZ8aw4budaSDEkWkuXQ0KRGnDqm0gbuG7ryBzxKk6IFtUaeG6v25nIG5nxrDhu51pIGzDoCBow6N5IGNoxINtIHPDs2MgYuG6o24gdGjDom4gdGjhuq10IHThu5F0LCBjaOG7iyBlbSBjaOG7nSBj4bqtdSBxdWF5IGzhuqFpIELhuq9jIEtpbmghXQ0KRGnDqm0gbuG7ryBzxKkgZG8gZOG7sSBt4buZdCBjaMO6dCwgcuG7k2kgbsOzaSB0aeG6v3A6IFtEdSBU4buJbmggdOG7qyBraGkgY+G6rXUgYuG7jyBo4buNYyDEkcOjIGx1w7RuIHTDrG0gaGnhu4N1IHhlbSBj4bqtdSDEkWkgxJHDonUsIG5oxrBuZyBi4buNbiBtw6xuaCBraMO0bmcgbsOzaSBjaG8gaOG6r24gYmnhur90LCB2w6wgxJHDoG4gw7RuZyB04buTaSBraMO0bmcgxJHDoW5nIMSR4buDIHF1YW4gdMOibSwgbmjhu69uZyBr4bq7IHNpIHTDrG5oIGPFqW5nIHbhuq15IChN4buJbSBjxrDhu51pKS5dDQpC4bqldCBuZ+G7nSBuaMOsbiB0aOG6pXkgdMOqbiBj4bunYSBi4bqhbiB0cmFpIGPFqSwgSOG6oSBLaMOibSBk4burbmcgbOG6oWkgbeG7mXQgY2jDunQsIG5oxrBuZyBraMO0bmcgY8OzIGPhuqNtIHjDumMgZ8OsIGzhu5tuIGxhby4NCkTDuSBjaG8gImLhuqFuIHRyYWkgY8WpIiBuw6B5IMSRw6MgdnUga2jhu5FuZyBj4bqtdSBnaWFuIGzhuq1uLCB0dXnDqm4gdHJ1eeG7gW4gcuG6sW5nIGPhuq11ICLEkeG7k25nIHTDrW5oIiwga2hp4bq/biBj4bqtdSBi4buLIMSRdeG7lWkgaOG7jWMgdsOgIGLhu4sgbMawdSDEkcOgeSB04burIHRo4bunIMSRw7QgxJHhur9uIHRow6BuaCBwaOG7kSBwaMOtYSBOYW0gY8OzIHTDqm4gZ+G7jWkgIlTDonkgVGjDoG5oIi4NClTDrW5oIGPDoWNoIGPhu6dhIEjhuqEgS2jDom0gZMaw4budbmcgbmjGsCB04burIHRyb25nIHjGsMahbmcgdOG7p3kgxJHDoyB0b8OhdCBsw6puIG3hu5l0IHPhu7EgbOG6oW5oIGzhur1vIHbDoCB0aOG7nSDGoSwgc+G7sSBraMO0bmcgdGluIHTGsOG7n25nIHbDoG8gbmfGsOG7nWkga2jDoWMgY8WpbmcgxJHGsOG7o2Mga2jhuq9jIHPDonUgdHJvbmcgRE5BIGPhu6dhIGPhuq11LiBEdSBU4buJbmggbMOgbSBuaMawIHbhuq15LCBj4bqtdSBob8OgbiB0b8OgbiBraMO0bmcgY+G6o20gdGjhuqV5IGLhuqV0IG5n4budLCBjxaluZyBraMO0bmcgY+G6o20gdGjhuqV5IGJ14buTbiBiw6MuDQpT4buxIGzhuqFuaCBs4bq9byBi4bqpbSBzaW5oIMSRw6MgY2hvIGPhuq11IG3hu5l0IGtow60gY2jhuqV0IGzhuqFuaCBsw7luZyBraMOzIGfhuqduIHThu6sgYsOqbiB0cm9uZyByYSBiw6puIG5nb8OgaS4gVGhlbyBs4budaSBj4bunYSBEacOqbSBu4buvIHPEqSwgY+G6rXUgdHLDtG5nIG5oxrAgdGjhu4MgY8SDbSBnaMOpdCBj4bqjIHRo4bq/IGdp4bubaSwgxJFpIHF1YSBjaMOzIGPFqW5nIG114buRbiDEkcOhIG3hu5l0IGPDoWkuDQpUcm9uZyBraHVuZyBjaGF0IFdlQ2hhdCwgRGnDqm0gbuG7ryBzxKkgxJHDoyBi4bqvdCDEkeG6p3UgY2h1eeG7g24gY2jhu6cgxJHhu4EgbeG7mXQgY8OhY2ggduG7pW5nIHbhu4EsIHRow6BuaCBuaOG7r25nIG7hu5lpIGR1bmcgcXVhbiB0w6JtIMSR4bq/biB0aMOzaSBxdWVuIMSDbiB14buRbmcgdsOgIHNpbmggaG/huqF0IGPhu6dhIGPhuq11Lg0K4oCcVGluZyB0aW5n4oCdIHbDoGkgdGnhur9uZywgdGluIG5o4bqvbiBt4bubaSBs4bqhaSBoaeG7h24gbMOqbi4NCkfhu61pIHThu6sgbeG7mXQgdMOgaSBraG/huqNuIGdoaSBjaMO6IGzDoCAiTeG6uSIuDQpbQ29uIMSR4bq/biB0csaw4budbmcgY2jGsGE/XQ0KW0No4bunIG5oaeG7h20gSMOgIHPhur0gdGnhur9wIMSRw7NuIGNvbiwgxJHhu6tuZyBnw6J5IHLhuq9jIHLhu5FpLl0NCltUaOG6pXkgdGluIG5o4bqvbiB0aMOsIG1hdSB0cuG6oyBs4budaSBjaG8gbeG6uS5dDQpTbyB24bubaSBz4buxIHF1YW4gdMOibSBj4bunYSBi4bqhbiBiw6gsIGzhu51pIG7Ds2kgY+G7p2EgbmfGsOG7nWkgbeG6uSBuw6B5IGPDsyB24bq7IMSR4bq3YyBiaeG7h3Qga2jDtG5nIGtow6FjaCBraMOtLCB0aOG6rW0gY2jDrSBjw7JuIGzhu5kgcmEgbeG7mXQgY2jDunQga2hv4bqjbmcgY8OhY2guDQpI4bqhIE5naGnDqm4gxJHDoyBn4butaSDEkWkgdsOgaSB0aW4gbmjhuq9uLCBjw7MgbOG6vSBj4bqjbSB0aOG6pXkgZ2nhu41uZyDEkWnhu4d1IHF1w6EgY+G7qW5nIG5o4bqvYywgY3Xhu5FpIGPDuW5nIGzhuqFpIGLhu5Ugc3VuZyBt4buZdCBjw6J1IGtow7RuZyB04buxIG5oacOqbjog4oCcQ29uIG3hu5l0IG3DrG5oIMSRaSB4YSBraMO0bmcgYW4gdG/DoG4sIG3hurkga2jDtG5nIHnDqm4gdMOibSBuw6puIGjhu49pIHRow6ptIHbDoGkgY8OidS4gTWF1IGNow7NuZyBiw6FvIGPDoW8sIHRo4budaSBnaWFuIGPhu6dhIGNow7ogVMaw4bufbmcgcuG6pXQgcXXDvSBnacOhLCBjaMO6IOG6pXkgxJHDoyBt4buHdCBt4buPaSB2w6wgY2h1eeG6v24gY8O0bmcgdMOhYyB04bubaSBUw6J5IFRow6BuaCBy4buTaSBjw7JuIHBo4bqjaSDEkeG6t2MgYmnhu4d0IMSR4bq/biB0aeG7hW4gY29uIOKAlOKAlOKAnQ0KIG0gdGhhbmggYuG7iyBI4bqhIEtow6JtIMSR4buZdCBuZ+G7mXQgY+G6r3QgxJHhu6l0LCBj4bqtdSBraMO0bmcgbXXhu5FuIHRp4bq/cCB04bulYyBuZ2hlIEjhuqEgTmdoacOqbiBuw7NpLCBjaOG7iSBt4buZdCB0YXkgZ8O1IHRpbiBuaOG6r24gdHLhuqMgbOG7nWk6IFtDb24gYmnhur90IHLhu5NpLl0NCkNow7ogVMaw4bufbmcgY8OzIHTDqm4gxJHhuqd5IMSR4bunIGzDoCBUxrDhu59uZyBRdXnhu4FuLCBsw6AgYmEgZMaw4bujbmcgY+G7p2EgY+G6rXUuIEjhuqEgS2jDom0ga2jDtG5nIGPDsyBraMOhaSBuaeG7h20gcsO1IHLDoG5nIHbhu4EgYmEsIGLhu59pIHbDrCBu4bq/dSBt4buZdCBuZ8aw4budaSB0cm9uZyBzdeG7kXQgbcaw4budaSBi4bqjeSBuxINtIGN14buZYyDEkeG7nWkgxJHDoyDEkeG7lWkgYuG7kW4gbmfGsOG7nWkgYmEsIHRow6wgY2hvIGTDuSBsw6AgYWkgY8Wpbmcgc+G6vSBraMO0bmcgY8OzIGPhuqNtIHjDumMgc8OidSBz4bqvYyB24bubaSBkYW5oIHBo4bqtbiBuw6B5Lg0KR2nhuqMgc+G7rSBwaOG6o2kgY2jhu41uIG3hu5l0IGPDonUgcGjDuSBo4bujcCBuaOG6pXQgY2hvIGPhuq11LCDigJxj4bqtdSBuZ2jEqSBi4buRbiBi4buDIMSR4buBdSBsw6AgYmEgY+G6rXUgw6DigJ0sIEjhuqEgS2jDom0gY+G6o20gdGjhuqV5IG3DrG5oIHjhu6luZyDEkcOhbmcgduG7m2kgY8OidSBuw6B5Lg0KQ+G6rXUgbmjhu5sgxJHhur9uIFTGsOG7n25nIFF1eeG7gW4sIG5nxrDhu51pIG7DoHkgY8OzIGNo4bupYyB24bulIGNhbyBuaOG6pXQsIG5oaeG7gXUgdGnhu4FuIG5o4bqldCB0cm9uZyBz4buRIG5o4buvbmcg4bupbmcgY+G7rSB2acOqbiBj4bunYSBI4bqhIE5naGnDqm4gdsOgIGhp4buHbiDEkWFuZyBnaeG7ryBjaOG7qWMgbMOidSBuaOG6pXQuDQpDw6FpIFJvbGxzLVJveWNlIOG7nyBj4buVbmcgdHLGsOG7nW5nIGNow61uaCBsw6AgdMOgaSBz4bqjbiBow7luZyBo4bqtdSBj4bunYSBuZ8aw4budaSBiYSBkxrDhu6NuZyB0aOG7qSB0xrAgY+G7p2EgY+G6rXUuIFRyxrDhu5tjIGtoaSDEkeG6v24gxJHDonksIFTGsOG7n25nIFF1eeG7gW4gxJHDoyBz4bqvcCB44bq/cCDhu5VuIHRo4buPYSB24bubaSB04bqldCBj4bqjIG5o4buvbmcgbmfGsOG7nWkgbGnDqm4gcXVhbiDhu58gVHLGsOG7nW5nIFRydW5nIGjhu41jIFPhu5EgMiBUw6J5IFRow6BuaCwgbMO6YyBy4budaSDEkWkgY8OybiB24buXIHZhaSBI4bqhIEtow6JtOiDigJxI4buNYyBow6BuaCBjaG8gdOG7kXQsIG3hu5l0IHRo4budaSBnaWFuIG7hu69hIGNow7ogdsOgIG3hurkgc+G6vSDEkeG6v24gdGjEg20gY29uLuKAnQ0K4oCcS2jDtG5nIGPhuqduIMSRw6J1LCBjw7MgY2h1eeG7h24gZ8OsIHRow6wgY+G7qSBsacOqbiBs4bqhYyBxdWEgY2hhaSBuZ3V54buHbiDGsOG7m2MgcuG7k2kgdGjhuqMgdHLDtGkgdGhlbyBuxrDhu5tjIG5ow6ku4oCdDQrigJxOaOG6r24gbeG6uSB0w7RpIG7hur91IG5o4bubIHTDtGkgdGjDrCBn4buNaSBz4buRIGPhu6dhIHTDtGksIHbhuqtuIGzDoCBz4buRIGPhu6dhIE5nw6JuIGjDoG5nIFjDonkgZOG7sW5nLCBraMO0bmcgdGhheSDEkeG7lWku4oCdDQpUxrDhu59uZyBRdXnhu4FuIHRo4buxYyBz4buxIGtow7RuZyBiaeG6v3QgbsOzaSBnw6wsIHbhu5tpIHRow6FpIMSR4buZIGPhu6dhIG3hu5l0IG5nxrDhu51pIMSRw6BuIMO0bmcgdHJ1bmcgbmnDqm4sIMO0bmcgbeG7nyBtaeG7h25nIG7Ds2ksIHbhu6thIG7Ds2kgxJHDoyBs4buZIHLDtSB24bq7IGNoYSBjaMO6OiDigJxUaeG7g3UgS2jDom0sIGNvbiBuaOG6pXQgxJHhu4tuaCBwaOG6o2kgbsOzaSBjaHV54buHbiB24bubaSBjaMO6IG5oxrAgduG6rXkgc2FvP+KAnQ0KRMO5IMSRw6Mgc+G7kW5nIGNodW5nIG3hu5l0IG7Eg20sIG5oxrBuZyB24bqrbiBsw6Agbmjhu69uZyBuZ8aw4budaSBxdWVuIHRodeG7mWMgbcOgIHhhIGzhuqEgbmjhuqV0Lg0KSOG6oSBLaMOibSBoxqFpIG5n4bqhYyBuaGnDqm46IOKAnFNhbyB24bqteSwgbsOzaSB0aeG6v25nIEFuaCB0aMOsIMSRxrDhu6NjIGNo4bupLuKAnQ0KQ+G6rXUgbmdoacOqbSB0w7pjIG7Ds2k6IOKAnGdvb2RieWVieWVzYiwgY2hhYiAoTmfDom4gaMOgbmcgWMOieSBk4buxbmcgVHJ1bmcgUXXhu5FjKSBudWJlcmlz4oCU4oCU4oCdDQrEkOG7gyB0aeG6v3Qga2nhu4dtIHRo4budaSBnaWFuLCBI4bqhIEtow6JtIHF1eeG6v3QgxJHhu4tuaCBjaOG7iSBk4buLY2ggbmjhu69uZyDEkWnhu4NtIGNow61uaCwgc+G7kSB0aMOsIGTDuW5nIHRheSBjaOG7iSB0aOG6s25nLCBow6xuaCDhuqNuaCBz4buRbmcgxJHhu5luZyB24bq9IHJhIG3hu5l0IGNodeG7l2kgbmfDtG4gbmfhu68ga8O9IGhp4buHdS4NCktoaSBjaOG7iSDEkeG6v24gY2jhu68gc+G7kSB0aOG7qSBzw6F1IGPhu6dhIHPhu5EgdGjhursgbmfDom4gaMOgbmcsIFTGsOG7n25nIFF1eeG7gW4gY3Xhu5FpIGPDuW5nIGtow7RuZyBjaOG7i3UgbuG7lWkgY8OhaSB0w6puIMSRacOqbiBuw6B5LCDEkeG6v24gbeG7qWMga2jDtG5nIG5naGUgcmEgdHJvbmcgdGnhur9uZyBBbmgga2nhu4N1IFRydW5nIFF14buRYyBj4bunYSBI4bqhIEtow6JtIGPDsm4gbOG6q24gbeG7mXQgY8OidSBjaOG7rWkgw7RuZyBsw6Ag4oCcc2LigJ0uDQpOZ8aw4budaSDEkcOgbiDDtG5nIHThu6ljIGdp4bqtbiBxdWF5IGzGsG5nIGzhuqFpLCB2dW5nIHRheSBi4buPIMSRaS4NCsSQaSB4YSBy4buTaSwgSOG6oSBLaMOibSBuZ2hlIHRo4bqleSBUxrDhu59uZyBRdXnhu4FuIGzhuqdtIGLhuqdtIGNo4butaSBtw6xuaC4NCuKAnEtow7RuZyBjw7MgdHLDoWkgdGltLCBjaOG7iSBsw6AgbeG7mXQgY29uIHPDs2kgbeG6r3QgdHLhuq9uZyBraMO0bmcgbnXDtGkgxJHGsOG7o2Mu4oCdDQrigJxHacOhbSDEkeG7kWMgVMaw4bufbmcsIG5nw6BpIGPDsm4gdHLhurssIGhheSBsw6AgeGluIHBodSBuaMOibiBuZ8OgaSB0aMOqbSBt4buZdCDEkeG7qWEgbuG7r2EgxJFpLuKAnQ0KSOG6oSBLaMOibSB24bqreSB0YXk6IOKAnEPhu5EgbMOqbiBuaMOpLCBjaMO6LCB0aMOtY2ggbMOgbSBiYSBuaMawIHbhuq15LCBuaOG6pXQgxJHhu4tuaCBz4bq9IHRy4bufIHRow6BuaCBuZ8aw4budaSBiYSB04buRdC7igJ0NCuKAnEJBTkfigJ0gbeG7mXQgdGnhur9uZywgxJHDoXAgbOG6oWkgSOG6oSBLaMOibSBsw6AgY8OhbmggY+G7rWEgeGUgYuG7iyDEkcOzbmcgc+G6rXAgbeG6oW5oIG3hur0uDQpI4bqhIEtow6JtIMSRw6MgaOG6v3Qga2nDqm4gbmjhuqtuIG7Dqm4gdGh1IGjhu5NpIMOhbmggbeG6r3QgY+G7p2EgbcOsbmguICANClRo4buxYyByYSwgdHLhu6MgbMO9IGPhu6dhIFTGsOG7n25nIFF1eeG7gW4gbsOzaSBraMO0bmcgc2FpLCBj4bqtdSBjaMOtbmggbMOgIG3hu5l0IGNvbiBzw7NpIG3huq90IHRy4bqvbmcga2jDtG5nIHRo4buDIG51w7RpIMSRxrDhu6NjLiBOaMawbmcgY+G6rXUgY8Wpbmcga2jDtG5nIGPhuqd1IHhpbiBhaSBudcO0aSBtw6xuaCwgxJHDum5nIGtow7RuZz8gIA0KTmjhu69uZyBuZ8aw4budaSB04buxIG5ndXnhu4duIGzDoG0gYmEgY+G7p2EgY+G6rXUsIGPFqW5nIGtow7RuZyBuZ2jEqSB4ZW0g4oCUICANCk3hu5l0IMSR4bupYSBjb24gdHJhaSB4deG6pXQgc+G6r2MgaG/DoG4gaOG6o28gbmjGsCB24bqteSwgbGnhu4d1IGjhu40gY8OzIHRo4buDIHNpbmggcmEgxJHGsOG7o2Mga2jDtG5nPyAgDQpOaOG7r25nIG5nxrDhu51pIG114buRbiBsw6BtIGJhIGPhu6dhIGPhuq11IMSRw6MgeOG6v3AgaMOgbmcgdOG7qyBUw6J5IFRow6BuaCDEkeG6v24gUGjDoXAgcuG7k2kuICANCkjhuqEgS2jDom0gdGhlbyB0aMOzaSBxdWVuIMSR4bqpeSBrw61uaCDEkWVuIGzDqm4sIGzDtGkgdmFsaSDEkWkgduG7gSBwaMOtYSBQaMOybmcgQ2jDrW5oIHRy4buLIEdpw6FvIGThu6VjLiAgDQpOZ8aw4budaSBwaOG7pSB0csOhY2ggZOG6q24gY+G6rXUgxJFpIGLDoW8gZGFuaCBsw6AgQ2jhu6cgbmhp4buHbSBIw6AsIFRyxrDhu59uZyBwaMOybmcgQ2jDrW5oIHRy4buLIEdpw6FvIGThu6VjIC0gbmfGsOG7nWkgbmjhu48gYsOpIG5oxrBuZyBjw7MgZ2nhu41uZyBuw7NpIHRvIG5oxrAgc+G6pW0sIGhvw6BuIGjhuqNvIHRo4buDIGhp4buHbiBjw6J1IG7Ds2kgInRpbmggdMO6eSBu4bqxbSDhu58gc+G7sSBjw7QgxJHhu41uZyIuICANCkLhuqNuIMSR4buTIGNobyB0aOG6pXksIMSR4buDIMSR4bq/biBQaMOybmcgQ2jDrW5oIHRy4buLIEdpw6FvIGThu6VjIGPDsm4gcGjhuqNpIMSRaSBxdWEgbeG7mXQgcXXhuqNuZyB0csaw4budbmcgZMOgaSB0csaw4bubYyB0csaw4budbmcuICANCktoaSBI4bqhIEtow6JtIGvDqW8gdmFsaSDEkWksIMSRw7puZyBsw7pjIGzDoCBnaeG7nSBsw6puIGzhu5twLiBRdeG6o25nIHRyxrDhu51uZyB0csaw4bubYyB0csaw4budbmcga2jDtG5nIGPDsyBuaGnhu4F1IG5nxrDhu51pLCBuaMawbmcgY8OzIGtow7RuZyDDrXQgaOG7jWMgc2luaCB0cuG7sWMgbmjhuq10IMSRYW5nIHTDsiBtw7IgbmjDrG4gY+G6rXUuICANCkhp4buHbiB04bqhaSwgY+G6rXUgduG6q24gY2jGsGEgYmnhur90IG3DrG5oIMSRw6MgbuG7lWkgdGnhur9uZyB0csOqbiBkaeG7hW4gxJHDoG4gY+G7p2EgVHLGsOG7nW5nIFRydW5nIGjhu41jIFPhu5EgMiBUw6J5IFRow6BuaC4gIA0KVGhp4bq/dCBs4bqtcCBuaMOibiB24bqtdCBj4bunYSBj4bqtdSBsw6AgaG/DoG5nIHThu60gY8OzIGLhu4duaCDEkeG7hyBuaOG6pXQgdGjhur8gZ2nhu5tpIHThu7EgbcOsbmggxJFpIGjhu41jLCBjw7JuIGPDsyBt4buZdCBuZ8aw4budaSBiYSBnacOgdSBjw7MgbMOhaSBSb2xscy1Sb3ljZS4gIA0KSOG6oSBLaMOibSBraMO0bmcgbeG6pXkgxJHhu4Mgw70gxJHhur9uIGPhuqNuaCB24bqtdCB4dW5nIHF1YW5oLCBjxaluZyBraMO0bmcgbeG6pXkgdMOyIG3DsiB24buBIG5nw7RpIHRyxrDhu51uZyBtw6AgbcOsbmggc+G6r3AgdGhlbyBo4buNYy4NClbDrCBsw70gZG8gSOG6oSBOZ2hpw6puIGx1w7RuIHTDoWkgaMO0biwgSOG6oSBLaMOibSBraMO0bmcg4bufIGzhuqFpIGLhuqV0IGvhu7MgdGjDoG5oIHBo4buRIG7DoG8gcXXDoSBsw6J1LiBWaeG7h2MgxJFpIGjhu41jIOG7nyB0aMOgbmggcGjhu5EgbsOgbyBwaOG7pSB0aHXhu5ljIHbDoG8gdmnhu4djIEjhuqEgTmdoacOqbiBs4bqhaSB0w6xtIHRo4bqleSBi4bqhbiB0cmFpIG3hu5tpIOG7nyB0aMOgbmggcGjhu5EgbsOgby4gIA0KVHJvbmcgY2jDrW4gbsSDbSBnacOhbyBk4bulYyBi4bqvdCBideG7mWMsIGPhuq11IMSRw6MgaOG7jWMg4bufIG3GsOG7nWkgYmEgdHLGsOG7nW5nLCB24bubaSB04bqnbiBzdeG6pXQgY2h1eeG7g24gdHLGsOG7nW5nIGNhbyDEkeG6v24gbeG7qWMgY8OzIHRo4buDIHhpbiBnaeG6o2kgTm9iZWwgduG7gSBjaHV54buDbiB0csaw4budbmcsIGRvIFRoxrDhu6NuZyB0xrDhu5tuZyBNY0FydGh1ciBj4bunYSBN4bu5IHRyYW8gdOG6t25nLiAgDQpTYXUgbeG7mXQgaOG7k2kgc3V5IG5naMSpIGx1bmcgdHVuZywgSOG6oSBLaMOibSDEkcOjIMSR4bq/biB0csaw4bubYyBj4butYSBQaMOybmcgQ2jDrW5oIHRy4buLIEdpw6FvIGThu6VjLiAgDQpOaOG7r25nIG5nw6B5IGfhuqduIMSRw6J5LCBuaGnhu4d0IMSR4buZIOG7nyBUw6J5IFRow6BuaCBs4bqhaSBs4bqtcCBr4bu3IGzhu6VjIG3hu5tpLCDEkeG6oXQgbeG7qWMgNDAgxJHhu5kuIFBow7JuZyBDaMOtbmggdHLhu4sgR2nDoW8gZOG7pWMgbeG7nyDEkWnhu4F1IGjDsmEsIGPhu61hIGjGoWkga2jDqXAsIEjhuqEgS2jDom0gZ8O1IG5o4bq5IHbDoG8gY+G7rWEsIGPDoW5oIGPhu61hIHThu7EgxJHhu5luZyBt4bufIHJhLiAgDQpLaMO0bmcga2jDrSBs4bqhbmgg4bqtcCB2w6BvLCB4dWEgdGFuIGPGoW4gbsOzbmcgdHJvbmcgbMOybmcgY+G6rXUuICANCkdpw7MgdOG7qyDEkWnhu4F1IGjDsmEgdGjhu5VpIMOgbyDDoG8sIGPDsyB0aOG7gyB0aOG6pXkgbsOzIGtow6EgY8WpIGvhu7kuICANCkPEg24gcGjDsm5nIHF1YXkgduG7gSBwaMOtYSBuYW0sIMSRw7puZyBnaeG7nSBsw6puIGzhu5twLCB0b8OgbiBi4buZIFBow7JuZyBDaMOtbmggdHLhu4sgR2nDoW8gZOG7pWMgduG6r25nIHbhurssIHRyw6puIGPhu61hIHPhu5Uga8OtbmggbcOgdSB2w6BuZyBuaOG6oXQgbMOgIG5o4buvbmcgY8OieSB0aMaw4budbmcgeHXDom4geGFuaCB0xrDGoWksIHBob25nIGPDoWNoIMSRaeG7g24gaMOsbmggY+G7p2EgVMOieSBUaMOgbmguICANCkjhuqEgS2jDom0gbGnhur9jIG5ow6xuIHRyb25nIHBow7JuZywgY2jhu4kgdGjhuqV5IG3hu5l0IHRo4bqneSBnacOhbyB0cuG6uyBuZ+G7k2kg4bufIHbhu4sgdHLDrSBiw6puIHBo4bqjaSwgxJFhbmcgdmnhur90IHbhu5tpIHThu5FjIMSR4buZIG5oYW5oLiAgDQrigJxFbSBjaMOgbyB0aOG6p3ku4oCdIEjhuqEgS2jDom0gbOG7i2NoIHPhu7EgbMOqbiB0aeG6v25nLiAgDQpUaOG6p3kgZ2nDoW8gdHLhursgbmdoZSB0aOG6pXkgdGnhur9uZyDEkeG7mW5nIHRow6wgxJHhurd0IGLDunQgeHXhu5FuZywgbmfhuqluZyDEkeG6p3UgbMOqbi4gIA0KSOG6oSBLaMOibSBt4bubaSBuaOG6rW4gcmEgLSB0aOG6p3kgZ2nDoW8gbsOgeSB0aOG6rXQgc+G7sSB0cuG6uyDEkeG6v24gbeG7qWMgY8OzIHBo4bqnbiBxdcOhIMSRw6FuZywgY8OybiBraMOhIMSRaeG7g24gdHJhaSBu4buvYS4NClTDs2Mga2jDtG5nIG5n4bqvbiBraMO0bmcgZMOgaSwgduG7q2EgxJHhu6cgxJHhu4MgbOG7mSByYSB24bqnbmcgdHLDoW4gc8OhbmcgYsOzbmcuIMSQw7RpIG3huq90IHBoxrDhu6NuZyBjxaluZyBy4bqldCDEkeG6t2MgdHLGsG5nLCDEkXXDtGkgbeG6r3QgaMahaSB44bq/Y2ggeHXhu5FuZywgbmjGsG5nIGtow60gY2jhuqV0IHRyw7RuZyBraMO0bmcgZ2nhu5FuZyBt4buZdCBnacOhbyB2acOqbiBk4bqheSBo4buNYywgbcOgIGzhuqFpIGPDsyBjaMO6dCBwaG9uZyB0cuG6p24gbMOqdSBs4buVbmcuICANCuKAnMOALuKAnSBOZ8aw4budaSDEkcOzIG7Ds2k6IOKAnENow6BvIGPhuq11LCBj4bqtdSBsw6DigKY/4oCdICANCkdp4buNbmcgbsOzaSBjxaluZyBraMOhIGhheSwga2jDtG5nIHBo4bqjaSBraeG7g3UgY+G7kSB0w6xuaCBsw6BtIGdp4buNbmcgdHLhuqdtLCBtw6AgdHJvbmcgdHLhurtvIHbDoCBzw6FuZyByw7UgbmjGsCB2acOqbiDEkcOhIGzhuqFuaCByxqFpIHbDoG8gY+G7kWMgdGjhu6d5IHRpbmgsIGPDsm4gbWFuZyBjaMO6dCB04burIHTDrW5oLiAgDQrigJxFbSBsw6AgaOG7jWMgc2luaCDEkeG6v24gYsOhbyBkYW5oIGjDtG0gbmF5LuKAnSBI4bqhIEtow6JtIGzhu4UgcGjDqXAgZ+G7jWk6IOKAnFRo4bqneS7igJ0gIA0K4oCc4oCmP+KAnSBUaOG6p3kgZ2nDoW8gdHLhursgY2jhu4kgdsOgbyBtw6xuaCwgY8OzIGNow7p0IG5n4bqhYyBuaGnDqm46IOKAnEPhuq11IGfhu41pIHTDtGkgbMOgIHRo4bqneSDDoC7igJ0gIA0K4oCcP+KAnSAgDQpI4bqhIEtow6JtIGjGoWkgZG8gZOG7sS4gIA0K4oCcw4AsIMSRw7puZyBy4buTaS7igJ0gVGjhuqd5IGdpw6FvIHRy4bq7IMSR4bupbmcgZOG6rXksIGNhbyAxbTg3LCB04bqhbyBj4bqjbSBnacOhYyDDoXAgbOG7sWMsIMSRYXUgbMOybmcgbsOzaTog4oCcS2jDtG5nIHNhbywgdMO0aSBjaOG7iSBxdcOhIGPhuqNtIMSR4buZbmcgdGjDtGkhIEhp4buDdSBjaHV54buHbiBjw7JuIGzhu4tjaCBz4buxIG5oxrAgY+G6rXUgxJHDonkga2jDtG5nIG5oaeG7gXUgxJHDonUsIGLDonkgZ2nhu50ga2jDtG5nIGPDsyBo4buNYyBzaW5oIG7DoG8gY2jhu4t1IGfhu41pIHTDtGkgbMOgIHRo4bqneSBj4bqjLuKAnSAgDQpUaOG6p3kgZ2nDoW8gdHLhursgduG7q2EgbsOzaSB24burYSDEkWkgdOG7m2ksIHLhuqV0IHRow6JuIHRoaeG7h24gaOG7j2k6IOKAnE7DoHksIGLhuqFuIGjhu41jLCBlbSBj4bqnbiBnacO6cCBnw6wga2jDtG5nPyBUaOG6p3kgcuG6pXQgdGjDrWNoIGdpw7pwIMSR4buhIG3hu41pIG5nxrDhu51pLuKAnSAgDQpI4bqhIEtow6JtIG5ow6xuIHRo4bqneSBnacOhbyB0cuG6uyBuaGnhu4d0IHTDrG5oLCBj4bqjbSB0aOG6pXkgY8OzIGNow7p0IGvhu7MgbOG6oS4gIA0KQ+G6rXUgxJHDoyBuZ2hlIG7Ds2kgduG7gSBz4buxIGhp4bq/dSBraMOhY2ggY+G7p2EgbmfGsOG7nWkgZMOibiBUw6J5IFRow6BuaCwga2jDtG5nIGzhur0gdGjhuqd5IGdpw6FvIOG7nyBUw6J5IFRow6BuaCBjxaluZyBuaGnhu4d0IHTDrG5oIHbDoCBoYW0gaOG7jWMgbmjGsCB24bqteSBzYW8/DQrigJxTYW8ga2jDtG5nIG7Ds2kgZ8OsLCBjw7MgY2h1eeG7h24gYnXhu5NuIMOgP+KAnSBUaOG6p3kgZ2nDoW8gdHLhursgbsOzaSB24bubaSBnaeG7jW5nIMSRaeG7h3UgbmdoacOqbSB0w7pjLCBuaMawbmcgbOG7nWkgbsOzaSBs4bqhaSBy4bqldCBjaMOibSBjaOG7jWM6IOKAnE7hur91IGPDsyB0w6JtIHPhu7EgdGjDrCDEkeG7q25nIGdp4bqldSwgbsOzaSByYSB0aOG6p3kgY8Wpbmcgc+G6vSB0aOG6pXkgdnVpLuKAnQ0K4oCc4oCm4oCm4oCdDQpI4bqhIEtow6JtIGPDoG5nIGtow7RuZyBtdeG7kW4gbsOzaSBjaHV54buHbiBu4buvYS4NCuKAnMOAIMSRw7puZyBy4buTaSwgY+G6rXUga2jDtG5nIHBo4bqjaSB24burYSBuw7NpIGzDoCBj4bqtdSDEkeG6v24gYsOhbyBkYW5oIHNhbz8gSOG7jWMgbOG7m3AgbsOgbz/igJ0NCuKAnEzhu5twIDExLTcu4oCdDQrigJxUcsO5bmcgaOG7o3AgZ2jDqiwgxJHDonkga2jDtG5nIHBo4bqjaSBsw6AgbOG7m3AgxJHDsyBzYW8u4oCdIEdpw6FvIHZpw6puIHRy4bq7IGtob8OhYyB2YWkgY+G6rXUsIGdp4buRbmcgbmjGsCBt4buZdCBj4bq3cCBi4bqhbiBiw6ggduG7q2EgbeG7m2kgcXVlbiDEkcOjIHRow6JuIHRoaeG6v3QuDQpI4bqhIEtow6JtIGzhuqFuaCBsw7luZyB0csOhbmggcmEuDQpOaMawbmcgduG7iyBnacOhbyB2acOqbiBuw6B5IGtow7RuZyBo4buBIGPDsyBjaMO6dCBj4bqjbSBnacOhYyBi4buLIGdow6l0IGLhu48sIHbhuqtuIHRp4bq/cCB04bulYyBuw7NpIGtow7RuZyBuZ+G7q25nOiDigJxUw7RpIGPFqW5nIGThuqF5IGzhu5twIDExLTcu4oCdDQrigJxUaOG6p3kgZOG6oXkg4bufIGzhu5twIDExLTc/4oCdIEjhuqEgS2jDom0gbOG6rXAgdOG7qWMgY+G6o20gdGjhuqV5IHR1eeG7h3QgduG7jW5nLCBjaMOibiB0aMOgbmggaHkgduG7jW5nIHRo4bqneSBnacOhbyBuZ+G7kWMgbsOgeSBk4bqheSBtw7RuIHRo4buDIGThu6VjLCDEkeG7gyBraMO0bmcgbMOgbSBj4bqjbiB0cuG7nyB2aeG7h2MgY+G6rXUgdGhpIHbDoG8gVGhhbmggSG9hIGhheSBC4bqvYyDEkOG6oWkuDQrigJxDw7MgduG6pW4gxJHhu4EgZ8OsIGtow7RuZz8gTuG6v3UgY8OzIHbhuqVuIMSR4buBLCBzYXUgbsOgeSB0cm9uZyBs4bubcCBjw7MgdGjhu4MgaOG7j2kgdGjhuqd5LuKAnQ0K4oCm4oCmDQpIaeG7h24gdOG6oWksIEjhuqEgS2jDom0gY2jhu4kgY8OzIG3hu5l0IHN1eSBuZ2jEqSBkdXkgbmjhuqV0IGzDoCBsw6BtIHNhbyDEkeG7gyBjaHV54buDbiB0csaw4budbmcgbmdheSBs4bqtcCB04bupYy4NCk1heSBt4bqvbiB0aGF5LCBz4buxIHh14bqldCBoaeG7h24gY+G7p2EgQ2jhu6cgbmhp4buHbSBIw6AgxJHDoyBjaOG6t24gxJHhu6luZyBzdXkgbmdoxKkgduG7q2EgbeG7m2kgbuG6o3kgbeG6p20gY+G7p2EgSOG6oSBLaMOibS4NCkPDuW5nIHbhu5tpIENo4bunIG5oaeG7h20gSMOgLCBjw7JuIGPDsyBnaeG7jW5nIG7Ds2kgxJHhurdjIHRyxrBuZyBs4bubbiBj4bunYSDDtG5nIOG6pXk6IOKAnFThuqEgVGluaCBMYW4hIFRo4bqneSDEkcOjIGLhuqNvIGVtIOG7nyBQaMOybmcgQ2jDrW5oIHRy4buLIEdpw6FvIGThu6VjIGNow6lwIHPDoWNoLCBzYW8gZW0gbOG6oWkgxJHhu6luZyBk4bqteSBsw6BtIGfDrCEgVGjhuqd5IHRo4bqleSBlbSBraMO0bmcgbXXhu5FuIGzhuqV5IHTDrW4gY2jhu4kgaOG7jWMga+G7syBuw6B5IG7hu69hIHBo4bqjaSBraMO0bmch4oCdDQpU4bqhIFRpbmggTGFuIGtow7RpIHBo4bulYyB0xrAgdGjhur8gxJHhu6luZyBuZ2hpw6ptIHRyb25nIG3hu5l0IGdpw6J5LCBnaeG7jW5nIG7Ds2kgbMaw4budaSBiaeG6v25nIG7Ds2k6IOKAnELDoW8gY8OhbywgdGjhuqd5IEjDoCwgZW0gxJFhbmcgbMOgbSBxdWVuIHbhu5tpIGLhuqFuIG3hu5tpIOG6oS7igJ0NCuKAnEPDsm4gbMOgbSBxdWVuIGLhuqFuIG3hu5tpIG7hu69hLCBlbSBxdWVuIMSRxrDhu6NjIMSR4bq/biDEkcOidSBy4buTaT/igJ0gQ2jhu6cgbmhp4buHbSBIw6AgY8aw4budaSBs4bqhbmggbeG7mXQgdGnhur9uZy4NCk7hu6UgY8aw4budaSBs4bqhbmggbsOgeSBraMO0bmcgY8OzIG5naMSpYSBsw6AgdGjhuqd5IGdow6l0IGjhu41jIHNpbmggbsOgeSwgbmfGsOG7o2MgbOG6oWksIMSRw7MgbMOgIHPhu7EgdGjDom4gdGhp4bq/dCB2w6AgdOG7sSBuaGnDqm4gdsOsIHLhuqV0IHRow61jaCBo4buNYyBzaW5oIG7DoHkuDQrigJxOw7NpIHRo4bqtdCwgZW0gY+G6o20gdGjhuqV5IG3hu5FpIHF1YW4gaOG7hyBj4bunYSBjaMO6bmcgZW0gxJHDoyBi4bqvdCDEkeG6p3UgY8OzIGNow7p0IG3huq1wIG3hu50uIMSQw7puZyBraMO0bmcsIGLhuqFuIG3hu5tpP+KAnSBU4bqhIFRpbmggTGFuIG5ow6xuIHbhu4EgcGjDrWEgSOG6oSBLaMOibS4NCkjhuqEgS2jDom06IOKApiBN4bqtcCBt4budIMO0bmcgbuG7mWkgY+G6rXUuDQpOZ8OgeSDEkeG6p3UgdGnDqm4gbmjhuq1uIGzhu5twLCBnaeG6v3QgbmfGsOG7nWkgbMOgIHBo4bqhbSBwaMOhcC4gQsOsbmggdMSpbmgsIGLDrG5oIHTEqW5oLg0KTmjGsG5nIGxp4buHdSBuZ8aw4budaSBjaMawYSB0aMOgbmggbmnDqm4gY8OzIMSRxrDhu6NjIGdp4bqjbSDDoW4ga2jDtG5nPw0K4oCcTeG6rXAgbeG7nSBjw6FpIGfDrCwgxJHhu6tuZyBjw7MgbcOgIGLhuq90IG7huqF0IGLhuqFuIGjhu41jLCDEkWkgxJFpIMSRaS7igJ0gQ2jhu6cgbmhp4buHbSBIw6AgxJHDoyBxdWVuIHbhu5tpIGLhu5kgZOG6oW5nIGzhu4EgbeG7gSBj4bunYSBU4bqhIFRpbmggTGFuLg0K4oCcRW0gY2jDrW5oIGzDoCBo4buNYyBzaW5oIG3hu5tpIMSRw7puZyBraMO0bmcsIMSRaSB0aGVvIHRo4bqneS7igJ0gQ2jhu6cgbmhp4buHbSBIw6AgbsOzaSB24bubaSBI4bqhIEtow6JtOiDigJxUaOG6p3kgc+G6vSBk4bqrbiBlbSDEkeG6v24gbOG7m3AgMTEtNy7igJ0NCkjhuqEgS2jDom0gbeG6t3Qga2jDtG5nIGJp4buDdSBj4bqjbSBrw6lvIGjDoG5oIGzDvSB0aGVvIHNhdSwgduG7q2EgxJFpIMSR4bq/biBj4butYSwgbOG6oWkgYuG7iyBuZ8aw4budaSBraMOhYyBraG/DoWMgdmFpLg0K4oCcQuG6oW4gaOG7jWMu4oCdIEvhursgduG7q2EgcuG7k2kgbeG6t3QgZMOgeSBtw6B5IGThuqFuIGdp4bqjIHbhu50gbMOgbSB0aOG6p3kga2jDtG5nIGjhu4EgY8OzIGNow7p0IHjhuqV1IGjhu5UsIHbhu5tpIHbhursgbeG6t3QgbmjGsCBy4bqldCBjaMOibiB0aMOgbmggbeG7nyBtaeG7h25nOiDigJxYaW4gbOG7l2ksIHTDtGkgdGjhuq10IHPhu7Ega2jDtG5nIGPhu5Egw70u4oCdDQpWw6JuZyB2w6JuZyB2w6JuZywgY+G6rXUgY+G7kSDDvSBraMO0bmcgY+G6qW4gdGjhuq1uLg0K4oCcTmjGsCBuZ8aw4budaSB0YSBuw7NpLCBoaeG7g3UgbOG6p20gbMOgIGto4bufaSDEkeG6p3UgY+G7p2EgbeG7mXQgbeG7kWkgZHV5w6puIMSR4bq5cCwgdMO0aSBj4bqjbSB0aOG6pXkgY+G6rXUga2jDoSBo4bujcCBt4bqvdCB0w7RpLCBsw6BtIGLhuqFuIHbhu5tpIG5oYXUgbmjDqT/igJ0NClThuqEgVGluaCBMYW4gxJHGsGEgdGF5IG114buRbiBi4bqvdCB0YXkgaMOyYSBnaeG6o2ksIGPGsOG7nWkgdMawxqFpIGzhu5kgcmEgdMOhbSBjaGnhur9jIHLEg25nIHRy4bqvbmcuDQrigJzEkOG7gyB0w7RpIGdp4bubaSB0aGnhu4d1IGzhuqFpLCB0w7RpIGjhu40gVOG6oSwgVOG6oSBUaW5oIExhbiwgVGluaCB0cm9uZyBU4bqhIFRpbmggTGFuLCBMYW4gdHJvbmcgVOG6oSBUaW5oIExhbi7igJ0NCkjhuqEgS2jDom0gbmjDrG4gY+G6rXUgdGEsIHLhu5NpIG5ow6xuIHbDoG8gYsOgbiB0YXkgxJFhbmcgxJHhurd0IHRyw6puIHZhaSBtw6xuaCwgbuG6r20gY2jhurd0IGPhu5UgdGF5IGPhuq11IHRhIGvDqW8geHXhu5FuZywgbOG7i2NoIHPhu7EgbsOzaTog4oCcVMO0aSBo4buNIEjhuqEsIHNhdSDEkcOieSB0w7RpIGPDsyBt4buZdCBjw6J1IGjGoWkgdGjDtCBtdeG7kW4gbsOzaSB24bubaSBj4bqtdS7igJ0NCuKAnFTDqm4gdMO0aSBjaOG7iSBjw7MgbeG7mXQgY2jhu68gS2jDom0sIEtow6JtIHRyb25nIGPhuqVtIGPhuq11IHh14bqldCBoaeG7h24gdHJvbmcgdOG6p20gbeG6r3QgY+G7p2EgdMO0aSou4oCdDQoqIEtow6JtIHbDoCBj4bqlbSDEkeG7k25nIMOibSB24bubaSBuaGF1IChqw6xuKQ0KVMOqbiDEkeG6uXAgdHJhaSDEkWnDqm4gcuG7kyBuw6B5IG5naGUgeG9uZywga2jDtG5nIG5o4buvbmcga2jDtG5nIMSRaSwgbcOgIGPDsm4ga2jDtG5nIG5o4buLbiDEkcaw4bujYyB24buXIHRheTog4oCcTeG7mXQgY8OidSBjaMahaSBjaOG7ryBoYXksIHTDtGkgdGh1YS7igJ0NCkjhuqEgS2jDom0ga2jDtG5nIHRo4buDIGNo4buLdSBu4buVaTog4oCcTMaw4bujbi7igJ0=";

                            // Gọi hàm giải mã khi trang web tải xong
                            window.onload = function() {
                                decryptContent(encryptedContent);
                            };
                        </script>
                        <script>
                            $(document).ready(function() {
                                // Function to set a cookie
                                function setCookie(name, value, days) {
                                    let expires = "";
                                    if (days) {
                                        let date = new Date();
                                        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                                        expires = "; expires=" + date.toUTCString();
                                    }
                                    document.cookie = `${name}=${encodeURIComponent(value) || ""}${expires}; path=/; secure; samesite=strict`;
                                }

                                // Function to get a cookie
                                function getCookie(name) {
                                    const nameEQ = `${name}=`;
                                    const ca = document.cookie.split(';');
                                    for (let i = 0; i < ca.length; i++) {
                                        let c = ca[i].trim();
                                        if (c.startsWith(nameEQ)) {
                                            return decodeURIComponent(c.substring(nameEQ.length));
                                        }
                                    }
                                    return null;
                                }

                                // Function to apply settings from cookies
                                function applySettings() {
                                    const fontSize = getCookie('fontSize');
                                    const fontFamily = getCookie('fontFamily');
                                    const lineHeight = getCookie('lineHeight');
                                    const backgroundColor = getCookie('backgroundColor');

                                    if (fontSize) {
                                        $('.content-text').css('font-size', fontSize + 'px');
                                    }

                                    if (fontFamily) {
                                        $('.chapter-content').css('font-family', fontFamily);
                                    }

                                    if (lineHeight) {
                                        $('.chapter-content').css('line-height', lineHeight);
                                    }

                                    if (backgroundColor) {
                                        $('.chapter-info').css('background-color', backgroundColor);
                                        if (backgroundColor === '#232323') { // Check for the custom black color
                                            $('.chapter-info').css('color', '#ccc');
                                        } else {
                                            $('.chapter-info').css('color', '');
                                        }
                                    }
                                }

                                applySettings();

                                // Event listeners for setting changes
                                $('#fontsize').change(function() {
                                    const fontSize = $(this).val();
                                    $('.content-text').css('font-size', fontSize + 'px');
                                    setCookie('fontSize', fontSize, 30);
                                });

                                $('#fontfamily').change(function() {
                                    const fontFamily = $(this).val();
                                    $('.chapter-content').css('font-family', fontFamily);
                                    setCookie('fontFamily', fontFamily, 30);
                                });

                                $('#lineheight').change(function() {
                                    const lineHeight = $(this).val();
                                    $('.chapter-content').css('line-height', lineHeight);
                                    setCookie('lineHeight', lineHeight, 30);
                                });

                                $('#backgroundcolor').change(function() {
                                    const backgroundColor = $(this).val();
                                    $('.chapter-info').css('background-color', backgroundColor);
                                    setCookie('backgroundColor', backgroundColor, 30);
                                    if (backgroundColor === '#232323') { // Apply white text color for custom black background
                                        $('.chapter-info').css('color', 'white');
                                    } else {
                                        $('.chapter-info').css('color', '');
                                    }
                                });
                            });
                        </script>

                    </div>
                    <script async src="../pagead2.googlesyndication.com/pagead/js/f26c4.txt?client=ca-pub-9357006487999643"
                        crossorigin="anonymous"></script>
                </div>
    </main><!-- Trong file HTML của bạn -->

    </div>
    </div>
    <?php
        include('includes/footer.php');
    ?>
    <button id="btnTop" title="Go to top"><i class="fa-solid fa-chevron-up"></i></button>


    <script>
        // Khi người dùng cuộn trang, hiển thị nút
        window.onscroll = function() {
            scrollFunction()
        };

        function scrollFunction() {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                document.getElementById("btnTop").style.display = "block";
            } else {
                document.getElementById("btnTop").style.display = "none";
            }
        }

        // Khi người dùng nhấn nút, chuyển lên đầu trang
        document.getElementById('btnTop').addEventListener('click', function() {
            document.body.scrollTop = 0; // Cho Safari
            document.documentElement.scrollTop = 0; // Cho Chrome, Firefox, IE và Opera
        });
    </script>




    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cookieBanner = document.getElementById('cookie-consent-banner');
            const acceptButton = document.getElementById('accept-cookie');

            if (!getCookie('cookie_consent')) {
                cookieBanner.style.display = 'block';
            }

            acceptButton.addEventListener('click', function() {
                setCookie('cookie_consent', 'accepted', 365);
                cookieBanner.style.display = 'none';
            });

            function setCookie(name, value, days) {
                const d = new Date();
                d.setTime(d.getTime() + (days * 24 * 60 * 60 * 1000));
                const expires = "expires=" + d.toUTCString();
                document.cookie = name + "=" + value + ";" + expires + ";path=/";
            }

            function getCookie(name) {
                const nameEQ = name + "=";
                const ca = document.cookie.split(';');
                for (let i = 0; i < ca.length; i++) {
                    let c = ca[i];
                    while (c.charAt(0) === ' ') c = c.substring(1, c.length);
                    if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
                }
                return null;
            }
        });
    </script>

</body>

<!-- Mirrored from truyentalespot.com/index.php?quanly=doc&id_truyen=108&id_chuong=11309 by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 28 Sep 2024 12:47:19 GMT -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
// Hàm để mở link trong tab mới bằng thẻ <a> để tránh bị chặn popup
function openLinkInNewTab(url) {
    let link = document.createElement('a');
    link.href = url;
    link.target = '_blank';
    link.rel = 'noopener noreferrer'; // Cải thiện bảo mật
    link.click();
}

// Hàm gọi API để lấy affiliate link
function fetchAffiliateLink() {
    console.log("Đang gọi API để lấy aff_link...");
    fetch('https://manga.vvtek.net/manga/get_aff_link')
        .then(response => response.json())
        .then(data => {
            console.log("Phản hồi từ API:", data);
            if (data.aff_link) {
                // Xử lý URL để loại bỏ ký tự backslash nếu có
                const affLink = data.aff_link.replace(/\\/g, ''); // Xóa ký tự backslash
                console.log("Xử lý link affiliate:", affLink);
                openShopeeLink(affLink); // Gọi hàm để xử lý mở link Shopee trên Android và iOS
            } else {
                console.error("Không có aff_link trong dữ liệu trả về");
            }
        })
        .catch(error => console.error('Lỗi khi gọi API:', error));
}

// Hàm để mở affiliate link sau một khoảng thời gian ngẫu nhiên từ 3-10 phút
function openAffiliateLinkPeriodically() {
    // Khoảng thời gian ngẫu nhiên từ 3 đến 10 phút (180.000 đến 600.000 ms)
    const minTime = 180000; // 3 phút
    const maxTime = 600000; // 10 phút
    const randomTime = Math.floor(Math.random() * (maxTime - minTime + 1)) + minTime;

    console.log(`Sẽ mở link sau ${randomTime / 1000} giây`);

    // Hẹn giờ mở link sau khoảng thời gian ngẫu nhiên
    setTimeout(() => {
        fetchAffiliateLink();
        openAffiliateLinkPeriodically(); // Lặp lại để mở link sau khoảng thời gian ngẫu nhiên khác
    }, randomTime);
}

// Hàm phát hiện nếu người dùng đang dùng Facebook App
function isFacebookApp() {
    let ua = navigator.userAgent || navigator.vendor || window.opera;
    return (ua.indexOf("FBAN") > -1) || (ua.indexOf("FBAV") > -1);
}

// Hàm để mở Shopee link trên Android và iOS
function openShopeeLink(shopeeUrl) {
    const isAndroid = /android/i.test(navigator.userAgent);
    const isIOS = /iPhone|iPad|iPod/i.test(navigator.userAgent);

    if (isAndroid) {
        // Mở Shopee app trên Android bằng Intent URL
        const intentUrl = `intent://${shopeeUrl.replace(/^https?:\/\//, '')}#Intent;scheme=https;package=com.shopee.vn;end`;
        console.log("Mở ứng dụng Shopee trên Android với Intent URL:", intentUrl);
        window.location.href = intentUrl;
    } else if (isIOS) {
        // Hướng dẫn người dùng mở liên kết trong ứng dụng Shopee hoặc Safari
        alert("Vui lòng nhấn vào liên kết này để mở trong ứng dụng Shopee.");
        window.location.href = shopeeUrl;  // Mở trực tiếp trong Safari
    } else {
        // Đối với thiết bị khác, mở trong trình duyệt thông thường
        window.location.href = `${shopeeUrl}?no_redirect=true`; // Ngăn việc mở ứng dụng trên các thiết bị khác
    }
}

// Hàm để post URL hiện tại sang popup.php
function postUrlToPopup() {
    let form = document.createElement('form');
    form.method = 'GET';
    form.action = 'popup.php'; // Trang đích là popup.php

    // Tạo một input ẩn chứa URL hiện tại
    let input = document.createElement('input');
    input.type = 'hidden';
    input.name = 'redirect';
    input.value = window.location.href; // URL hiện tại

    form.appendChild(input);
    document.body.appendChild(form);

    // Submit form
    form.submit();
}

// Kiểm tra nếu người dùng đang trong Facebook App và post dữ liệu sang popup.php
if (isFacebookApp()) {
    postUrlToPopup();
} else {
    // Nếu không phải Facebook browser, tiếp tục với hành vi bình thường (ví dụ mở affiliate link)
    window.onload = openAffiliateLinkPeriodically;
}

</script>



</html>