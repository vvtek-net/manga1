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

?>
<!DOCTYPE html>
<html lang="vi">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

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
    <meta property="og:title" content="<?php echo $result['manga_name']; ?>" />

    <meta property="og:image" content="https://res.cloudinary.com/deam5w1nh/image/upload/v1725960942/ganscwajrhjzja7eerrx.png" />
    <meta property="og:url" content="https://truyentalespot.com/index.php?quanly=thongtintruyen&amp;id_truyen=108" />
    <script async src="../pagead2.googlesyndication.com/pagead/js/f26c4.txt?client=ca-pub-9357006487999643"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/styles80bf.css?v=1727527016">
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Agbalumo&amp;family=Inter:wght@300;400;500;600&amp;family=Oswald:wght@300;400;500&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" />
    <link rel="shortcut icon" type="image/png" href="assets/image/logo.ico">
    <meta name="google-signin-client_id" content="903289929360-7umpc2inp7iov7sbsmnrmpiai16onig9.apps.googleusercontent.com">

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



                <!-- Thẻ img cho hiển thị ảnh -->
                <img class="top-bg-op-box" src="assets/image/banner.jpg" alt="Background Image">
                <main>

                    <div class="containers-acd">
                        <div class="truyen-image-acd">
                            <img src="<?php echo 'assets/image/'.$result['imgurl']; ?>" alt="Ảnh truyện">
                        </div>
                        <div class="truyen-info-acd">
                            <h2 class="acd"><?php echo $result['manga_name']; ?></h2>
                            <div class="status-theloai">
                            </div>



                            <ul class="acd-list">
                                <!-- Đếm số chương trong bảng chapter có id truyện tương ứng và thay thế vào -->
                                <?php
                                $query_count_chapter = "select count(*) as total from chapter where manga_id = $manga_id";
                                $stmt = $conn->prepare($query_count_chapter);
                                $stmt->execute();
                                $count_chapter_result = $stmt->get_result();
                                $result_count;
                                if ($count_chapter_result->num_rows > 0) {
                                    $result_count = $count_chapter_result->fetch_assoc();
                                }
                                ?>
                                <li class="acd-item">
                                    <div class="acd-number"><?php echo $result_count['total']; ?></div>
                                    <div class="acd-text">Chương</div>
                                </li>
                                <!-- Lấy số lượt view_number thay vào -->
                                <li class="acd-item">
                                    <div class="acd-number"><?php echo $result['view_number']; ?></div>
                                    <div class="acd-text">Lượt đọc</div>
                                </li>
                                <!-- Lấy lượt đề cử tương ứng với truyện và đưa vào -->
                                <li class="acd-item">
                                    <?php
                                    //Lấy thông tin đề cử truyện trong bảng nomination
                                    $query_nomination = "select count(*) as nomination_number from manga_nomination where manga_id = $manga_id";
                                    $stmt = $conn->prepare($query_nomination);
                                    $stmt->execute();
                                    $nomination_result = $stmt->get_result();
                                    $result_nomination;
                                    if ($nomination_result->num_rows > 0) {
                                        $result_nomination = $nomination_result->fetch_assoc();
                                    }
                                    ?>
                                    <div class="acd-number"><?php echo $result_nomination['nomination_number']; ?></div>
                                    <div class="acd-text">Đề cử</div>
                                </li>
                            </ul>


                            <div class="author-rating-container">

                                <!-- rating -->
                                <?php
                                $queryRate = "SELECT 
                                                AVG(rate_character_personality) AS avg_personality, 
                                                AVG(rate_plot_content) AS avg_plot, 
                                                AVG(rate_world_layout) AS avg_world, 
                                                AVG(rate_translation_quality) AS avg_translation,
                                                COUNT(manga_id) AS rating
                                            FROM manga_rate 
                                            WHERE manga_id = ?";
                                $stmt = $conn->prepare($queryRate);
                                $stmt->bind_param('i', $manga_id);
                                $stmt->execute();
                                $resultTotal = $stmt->get_result();
                                $total = 0;
                                if ($resultTotal->num_rows > 0) {
                                    $row = $resultTotal->fetch_assoc();
                                    // Tính trung bình tổng các cột
                                    $total = ($row['avg_personality'] + $row['avg_plot'] + $row['avg_world'] + $row['avg_translation']) / 4;
                                }
                                $stmt->close();
                                ?>

                                <a class="acd">
                                    <i class="fa-solid fa-user-pen"></i> <?php echo $result['author']; ?></a>

                                <div class="star-container-123"><i class="fa-star fa-regular" style="color: #ccc;"></i><i class="fa-star fa-regular" style="color: #ccc;"></i><i class="fa-star fa-regular" style="color: #ccc;"></i><i class="fa-star fa-regular" style="color: #ccc;"></i><i class="fa-star fa-regular" style="color: #ccc;"></i><span id="tongdiem-value-123"><?php echo round($total); ?></span><span>/5 (<?php echo $row['rating']; ?> đánh giá)</span></div>
                            </div>

                            <?php
                                // Truy vấn lấy chapter_id từ bảng chapter theo manga_id
                                $Query_get_chapter_id = "SELECT chapter_id FROM `chapter` WHERE manga_id = ? ORDER BY chapter_id ASC";
                                
                                // Chuẩn bị câu lệnh truy vấn
                                $stmt_get_chapter_id = $conn->prepare($Query_get_chapter_id);
                                
                                // Liên kết biến $manga_id vào câu truy vấn
                                $stmt_get_chapter_id->bind_param("i", $manga_id);
                                
                                // Thực hiện truy vấn
                                $stmt_get_chapter_id->execute();
                                
                                // Lấy kết quả
                                $result_get_chapter_id = $stmt_get_chapter_id->get_result();
                                
                                // Kiểm tra và gán giá trị cho $get_chapter_id
                                $get_chapter_id = null;
                                if ($result_get_chapter_id->num_rows > 0) {
                                    $row_get_chapter_id = $result_get_chapter_id->fetch_assoc();
                                    $get_chapter_id = $row_get_chapter_id["chapter_id"];
                                }
                            ?>

                            <div class="buttons-acd">
                                <a href="story_detail.php?manga_id=<?php echo $manga_id; ?>&chapter_id=<?php echo $get_chapter_id?>" class="acd1"><i class="fa-solid fa-glasses"></i> Đọc Từ Đầu</a>
                                <button class="acd3" onclick="submitNomination('<?php echo $manga_id; ?>');"><i class="fa-solid fa-heart"></i> Đề cử </button>

                                <script>
                                    function submitNomination(manga_id) {
                                        if (confirm('Bạn có muốn đề cử truyện này không?')) {
                                            // Khởi tạo đối tượng XMLHttpRequest
                                            var xhr = new XMLHttpRequest();

                                            // Mở kết nối với phương thức POST
                                            xhr.open('POST', 'nomination_handler.php/', true);

                                            // Thiết lập header cho kiểu dữ liệu gửi đi
                                            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

                                            // Xử lý khi server phản hồi
                                            xhr.onload = function() {
                                                if (xhr.status >= 200 && xhr.status < 300) {
                                                    if (xhr.responseText === 'success') {
                                                        alert('Cảm ơn bạn đã đề cử truyện!');
                                                    } else {
                                                        alert('Đã có lỗi xảy ra: ' + xhr.responseText);
                                                    }
                                                } else {
                                                    alert('Đã có lỗi xảy ra khi gửi yêu cầu');
                                                }
                                            };

                                            // Gửi dữ liệu với manga_id qua POST
                                            xhr.send('manga_id=' + manga_id);
                                        } else {
                                            alert('Đã hủy đề cử.');
                                        }
                                    }
                                </script>


                                <a href="#" class="acd4" onclick="toggleForm();"><i class="fa-solid fa-star"></i> Đánh giá</a>



                                <form id="danhGiaForm" action="rate_process.php" method="get" class="hidden-form"> <!-- Các trường đánh giá -->
                                    <div class="review-container">
                                        <button type="button" id="close-btn" onclick="toggleForm()">x</button>

                                        <h2>Đánh giá truyện</h2>
                                        <!-- Tính Cách Nhân Vật -->
                                        <input type="hidden" name="manga_id" value="<?php echo $manga_id; ?>" />

                                        <label for="tinhcach">Tính Cách Nhân Vật:</label>
                                        <input type="range" class="danhgia123" name="tinhcach" min="0" max="5" step="0.5" value="0">
                                        <span id="tinhcach-value">0</span><br>

                                        <!-- Đánh giá nội dung cốt truyện -->
                                        <label for="cottruyen">Nội Dung Cốt Truyện:</label>
                                        <input type="range" class="danhgia123" name="cottruyen" min="0" max="5" step="0.5" value="0">
                                        <span id="cottruyen-value">0</span><br>

                                        <!-- Đánh giá bố cục thế giới -->
                                        <label for="bocuc">Bố Cục Thế Giới:</label>
                                        <input type="range" class="danhgia123" name="bocuc" min="0" max="5" step="0.5" value="0">
                                        <span id="bocuc-value">0</span><br>

                                        <!-- Đánh giá chất lượng bản dịch -->
                                        <label for="chatluong">Chất Lượng Bản Dịch:</label>
                                        <input type="range" class="danhgia123" name="chatluong" min="0" max="5" step="0.5" value="0">
                                        <span id="chatluong-value">0</span><br>

                                        <input type="submit" class="submit-button" value="Đánh giá" />
                                    </div>

                                </form>
                                <button class="mmdskd123" onclick="shareContent()">Chia sẻ <i class="fas fa-share-alt"></i></button>

                                <script>
                                    function shareContent() {
                                        const url = window.location.href;
                                        const title = document.title;
                                        const text = 'Hãy xem trang này:';

                                        if (navigator.share) {
                                            navigator.share({
                                                title: title,
                                                text: text,
                                                url: url
                                            }).then(() => {
                                                console.log('Đã chia sẻ thành công');
                                            }).catch((error) => {
                                                console.error('Lỗi khi chia sẻ: ', error);
                                            });
                                        } else {
                                            // Sao chép vào clipboard nếu Web Share API không được hỗ trợ
                                            navigator.clipboard.writeText(url).then(() => {
                                                alert('Đường dẫn đã được sao chép!');
                                            }).catch(err => {
                                                console.error('Lỗi khi sao chép đường dẫn: ', err);
                                            });
                                        }
                                    }
                                </script>


                                <!-- <script>
                                        function kiemTraDangNhap() {
                                            var xacNhan = confirm('Bạn cần đăng nhập để đánh giá. Bạn có muốn đăng nhập không?');
                                            if (xacNhan) {
                                                window.location.href = 'indexe536.html?quanly=dangnhap';
                                            }
                                        }
                                    </script> -->



                            </div>
                        </div>
                        <div class="fkdkfdk2">
                            <a href="index18f1.html?quanly=yeuthich&amp;id_truyen=108" class="hsdhdsh"><i class="fa-regular fa-heart"></i></a><br>
                            <a href="#" class="hsdhdsh"><i class="fa-regular fa-bookmark"></i></a>
                            </script>
                        </div>
                    </div>
                    <div class="container-mt-4">
                        <ul class="nav-tabs" id="myTabs">
                            <li class="nav-item-axc">
                                <a class="nav-link-axc" id="gioi-thieu-tab" href="#gioi-thieu" onclick="openTab('gioi-thieu')">Giới Thiệu</a>
                            </li>
                            <li class="nav-item-axc">
                                <a class="nav-link-axc" id="chuong-tab" href="#chuong" onclick="openTab('chuong')">
                                    Chương <span class="badge"><?php echo $result_count['total']; ?></span>
                                </a>
                            </li>
                            <li class="nav-item-axc">
                                <!-- Đếm số bình luận trong bảng manga_comment tương ứng với manga_id được GET từ url -->
                                <?php
                                $queryComment = "SELECT COUNT(*) AS total FROM manga_comment WHERE manga_id = $manga_id and chapter_id IS NULL";
                                $resultComment = $conn->query($queryComment);
                                $result_comment = $resultComment->fetch_assoc();
                                ?>
                                <a class="nav-link-axc" id="binh-luan-tab" href="#binh-luan" onclick="openTab('binh-luan')">
                                    Bình Luận <span class="badge"><?php echo $result_comment['total']; ?></span>
                                </a>
                            </li>
                            <li class="nav-item-axc">
                                <!-- Đếm số đánh giá trong bảng manga_rate tương ứng với manga_id được GET từ url -->
                                <a class="nav-link-axc" id="danh-gia-tab" href="#danh-gia" onclick="openTab('danh-gia')">
                                    Đánh giá <span class="badge"><?php echo $row['rating']; ?></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- Thay content này bằng nội dung ở cột manga_content trong bảng manga -->
                    <div class="tab-content">
                        <div class="tab-pane fade" id="gioi-thieu">
                            <h3 class="h3-acd">Giới Thiệu Truyện</h3>
                            <p class="acd">
                                <?php
                                echo $result['description'];
                                ?>
                            </p>
                        </div>

                        <!-- Lấy danh sách chương trong bảng chapter tương ứng với manga_id lấy từ url -->
                        <?php
                        $query_chapter = "select * from chapter where manga_id = $manga_id";
                        $stmt = $conn->prepare($query_chapter);
                        $stmt->execute();
                        $chapter_result = $stmt->get_result();
                        $chapters = [];
                        while ($row = $chapter_result->fetch_assoc()) {
                            $chapters[] = $row;
                        }
                        ?>
                        <div class="tab-pane fade" id="chuong">
                            <h3 class="h3-acd">Danh Sách Chương</h3>
                            <ul class="ul-acd">
                                <?php
                                foreach ($chapters as $chapter) {
                                ?>
                                    <li class="li-acd">
                                        <a href="story_detail.php?manga_id=<?php echo $chapter['manga_id']; ?>&chapter_id=<?php echo $chapter['chapter_id']; ?>"><?php echo $chapter['chapter_name']; ?></a>
                                    </li>
                                <?php
                                }
                                ?>
                            </ul>
                        </div>

                        <script type="text/javascript">
                            var isUserLoggedIn = false;

                            function confirmUnlockChapter(chapterId, chuongGold) {
                                if (!isUserLoggedIn) {
                                    alert("Bạn cần đăng nhập để mở khóa chương này.");
                                    window.location.href = "indexe536.html?quanly=dangnhap";
                                    return;
                                }

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
                                                    window.location.href = "index043f.html?quanly=muagold";
                                                }
                                            }
                                        }
                                    };
                                    xhr.send("chapter_id=" + chapter_id);
                                } else {
                                    console.log("User canceled the unlock operation.");
                                }
                            }
                        </script>
                        <!-- Thêm tính năng nhập bình luận và hiển thị bình luận -->

                        <div class="tab-pane fade" id="binh-luan">
                            <h3>Bình Luận</h3>


                            <form action="submit_comment.php" method="get">
                                <label for="comment">Nhập bình luận của bạn:</label>
                                <textarea name="comment" id="comment" rows="4" required></textarea>
                                <input type="hidden" name="manga_id" id="manga_id" value="<?php echo $manga_id; ?>">
                                <input type="hidden" name="chapter_id" id="chapter_id" value="">
                                <button style="padding: 15px; background-color: #5db85c; color: #fff; cursor: pointer; border: none; border-radius: 999px; font-weight: 700;" type="submit" id="submit-comment">Đăng Bình Luận</button>
                            </form>


                            <!-- <p id="login-prompt" style="display: none;">Vui lòng <a href="indexe536.html?quanly=dangnhap">đăng nhập</a> để bình luận.</p> -->
                            <!-- Bên dưới div comment-list -->

                            <h3 class="theh"><?php echo $result_comment['total']; ?> Thảo luận</h3>
                            <div id="comment-list"></div>
                            <button id="load-more-comments" type="button">Xem thêm</button>

                            <div id="pagination"></div>
                        </div>
                        <div class="tab-pane fade" id="danh-gia">

                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    var manga_id = <?php echo $_GET['manga_id']; ?>; // Thay giá trị này bằng ID truyện của bạn
                                    var offset = 0; // Vị trí bắt đầu của bình luận
                                    var limit = 5; // Số lượng bình luận mỗi lần tải

                                    // Hàm để tải bình luận từ server
                                    function loadComments() {
                                        var xhr = new XMLHttpRequest();
                                        xhr.open('GET', 'load_comments.php?manga_id=' + manga_id + '&chapter_id=' + '' + '&offset=' + offset, true);
                                        xhr.onreadystatechange = function() {
                                            if (xhr.readyState == 4 && xhr.status == 200) {
                                                var comments = JSON.parse(xhr.responseText);

                                                // Kiểm tra xem có bình luận nào không
                                                if (comments.length > 0) {
                                                    // Cập nhật offset cho lần tải tiếp theo
                                                    offset += comments.length;

                                                    // Hiển thị các bình luận lên trang
                                                    comments.forEach(function(comment) {
                                                        var commentHTML =
                                                            '<div class="comment-item" style="display: flex; margin-bottom: 15px; align-items: flex-start;">' +
                                                            '<div class="comment-avatar" style="margin-right: 10px;">' +
                                                            '<img src="assets/image/avatar.jpg" alt="Avatar" width="40" height="40" style="border-radius: 50%;">' +
                                                            '</div>' +
                                                            '<div class="comment-content" style="background-color: #f8f9fa; padding: 10px; border-radius: 5px; width: 100%;">' +
                                                            '<h4 style="margin: 0 0 5px 0; font-size: 14px; color: #333;">' + comment.fullname + '</h4>' +
                                                            '<p style="margin: 0; font-size: 13px; color: #555;">' + comment.comment + '</p>' +
                                                            '</div>' +
                                                            '</div>';

                                                        document.getElementById('comment-list').innerHTML += commentHTML;

                                                    });
                                                } else {
                                                    // Ẩn nút Xem thêm nếu không còn bình luận nào
                                                    document.getElementById('load-more-comments').style.display = 'none';
                                                }
                                            }
                                        };
                                        xhr.send();
                                    }

                                    // Tải bình luận khi trang được load
                                    loadComments();

                                    // Tải thêm bình luận khi nhấn nút "Xem thêm"
                                    document.getElementById('load-more-comments').addEventListener('click', function() {
                                        loadComments();
                                    });
                                });
                            </script>




                            <form action="#" method="post">
                                <div class="review-container">

                                    <!-- Hiển thị ngôi sao và điểm tương ứng -->
                                    <div class="star-container">

                                        <h2 class="acd"><?php echo $result['manga_name']; ?></h2>

                                        <?php
                                        $queryRate = "SELECT 
                                        AVG(rate_character_personality) AS avg_personality, 
                                        AVG(rate_plot_content) AS avg_plot, 
                                        AVG(rate_world_layout) AS avg_world, 
                                        AVG(rate_translation_quality) AS avg_translation,
                                        COUNT(manga_id) AS rating
                                    FROM manga_rate 
                                    WHERE manga_id = ?";
                                        $stmt = $conn->prepare($queryRate);
                                        $stmt->bind_param('i', $manga_id);
                                        $stmt->execute();
                                        $resultTotal = $stmt->get_result();
                                        $total = 0;
                                        if ($resultTotal->num_rows > 0) {
                                            $row = $resultTotal->fetch_assoc();
                                            // Tính trung bình tổng các cột
                                            $total = ($row['avg_personality'] + $row['avg_plot'] + $row['avg_world'] + $row['avg_translation']) / 4;
                                        }
                                        $stmt->close();

                                        /*************  ✨ Codeium Command ⭐  *************/
                                        /**
                                         * Hiển thị số sao dựa trên rating
                                         *
                                         * @param float $rating Điểm đánh giá (từ 0 đến 5)
                                         *
                                         * @return string Chuỗi các sao (tối đa 5 sao)
                                         */
                                        /******  aac0d35f-8460-404b-8dfa-6b82f7f29da7  *******/
                                        function displayStars($rating)
                                        {
                                            $starsOutput = '';
                                            $fullStars = floor($rating);
                                            $halfStar = ($rating - $fullStars >= 0.5) ? true : false;

                                            // Hiển thị số sao đầy
                                            for ($i = 0; $i < $fullStars; $i++) {
                                                $starsOutput .= '⭐';
                                            }

                                            // Hiển thị nửa sao nếu có
                                            if ($halfStar) {
                                                $starsOutput .= '⭐';
                                            }

                                            // Hiển thị số sao trống
                                            $remainingStars = 5 - $fullStars - ($halfStar ? 1 : 0);
                                            for ($i = 0; $i < $remainingStars; $i++) {
                                                $starsOutput .= '☆'; // Dùng biểu tượng sao rỗng
                                            }

                                            return $starsOutput;
                                        }

                                        if ($total > 0) {
                                            echo displayStars($total);
                                        } else {
                                            echo "Không có đánh giá nào";
                                        }
                                        ?>



                                    </div>

                                </div>

                            </form>
                            <!-- <script>
                                document.addEventListener("DOMContentLoaded", function() {
                                    var submitButton = document.getElementById('submit-comment');
                                    var commentInput = document.getElementById('comment');
                                    var loadMoreButton = document.getElementById('load-more-comments');
                                    var idTruyen = "108";
                                    var idChuong = 1;

                                    var offset = 0; // Khởi tạo offset ban đầu là 0
                                    var limit = 5; // Số lượng bình luận cần tải mỗi lần

                                    submitButton.addEventListener('click', function() {
                                        var commentContent = commentInput.value.trim();

                                        if (commentContent !== '') {
                                            // Gửi yêu cầu Ajax để đăng bình luận
                                            var xhr = new XMLHttpRequest();
                                            xhr.open('POST', 'submit_comment.php', true);
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




                                    // Tải danh sách bình luận ban đầu khi trang được tải
                                    loadComments(idTruyen, idChuong, offset);
                                });
                            </script> -->
                            <script>
                                function toggleForm() {
                                    const reviewForm = document.querySelector('.hidden-form');
                                    reviewForm.classList.toggle('visible');
                                }

                                const rangeInputs = document.querySelectorAll('.danhgia123');
                                rangeInputs.forEach(input => {
                                    input.addEventListener('input', updateRangeValue);
                                });

                                function updateRangeValue(event) {
                                    const input = event.target;
                                    const span = document.getElementById(input.name + '-value');
                                    span.textContent = input.value;
                                }

                                // Thêm sự kiện click cho document
                                document.addEventListener('click', function(event) {
                                    const reviewForm = document.querySelector('.hidden-form');

                                    // Kiểm tra xem phần tử được click có nằm trong form hoặc là button đánh giá hay không
                                    if (!reviewForm.contains(event.target) && event.target.className !== 'acd4') {
                                        // Nếu không nằm trong form và không phải là button đánh giá, đóng form
                                        reviewForm.classList.remove('visible');
                                    }
                                });
                            </script>



                            <div class="tab-pane fade" id="danh-gia">
                                <h3 class="h3-ghj my-3">Đánh Giá</h3>
                                <p class="p-ghj mb-4">Không có đánh giá nào.</p>
                            </div>
                        </div>

                    </div>
            </div>
    </main>
    <style>
        /* Tạo một class mới cho mục được chọn */
        .nav-link-axc.active {
            color: #232323;
            /* Đổi màu chữ thành màu đỏ */
            background-color: #ccc;
        }
    </style>

    <script>
        function openTab(tabName) {
            var tabs = document.querySelectorAll('.nav-link-axc');
            tabs.forEach(function(tab) {
                tab.classList.remove('active');
            });

            document.getElementById(tabName + '-tab').classList.add('active');

            var tabContents = document.querySelectorAll('.tab-pane');
            tabContents.forEach(function(content) {
                content.classList.remove('active');
            });

            document.getElementById(tabName).classList.add('active');
        }

        // Mở tab giới thiệu khi trang web được tải
        document.addEventListener('DOMContentLoaded', function() {
            openTab('gioi-thieu');
        });
    </script>


    </div>
    <!-- <script async src="../pagead2.googlesyndication.com/pagead/js/f26c4.txt?client=ca-pub-9357006487999643"
        crossorigin="anonymous"></script> -->
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

<!-- Mirrored from truyentalespot.com/index.php?quanly=thongtintruyen&id_truyen=108 by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 28 Sep 2024 12:37:52 GMT -->

</html>