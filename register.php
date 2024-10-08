
<!DOCTYPE html>
<html lang="vi">

<!-- Mirrored from truyentalespot.com/index.php?quanly=dangki by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 28 Sep 2024 12:37:11 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-JTT7JZT6DT"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-JTT7JZT6DT');
</script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
            <meta property="og:title" content="Truyentalespot" />
        <meta property="og:description" content="Truyentalespot nền tảng đọc truyện miễn phí" />
        <meta property="og:image" content="assets/image/logo.ico" />
        <meta property="og:url" content="https://truyentalespot.com/index.php" />
    <script async src="../pagead2.googlesyndication.com/pagead/js/f26c4.txt?client=ca-pub-9357006487999643"
     crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/styles8931.css?v=1727526998">
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

</script><main>


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
            

    <div class="container-mt-5">
        <div class="row-justify-content-center">
            <div class="col-md-6-123">
                <h2>Đăng Ký</h2>
                                <form method="post" action="config/register_process.php">
                    <div class="form-group-123">
                        <label for="username">username:</label>
                        <input type="text" class="form-control-123" id="username" name="username" required>
                    </div>
                    
                    <div class="form-group-123">
                        <label for="password">password:</label>
                        <input type="password" class="form-control-123" id="password" name="password" required>
                    </div>

                    <div class="form-group-123">
                        <label for="fullname">fullname:</label>
                        <input type="fullname" class="form-control-123" id="fullname" name="fullname" required>
                    </div>
                    <button type="submit" class="btn-btn-primary123">Đăng Ký</button>
                </form>
                <div class="mt-3">
                <p>Đã có tài khoản? <a href="indexe536.html?quanly=dangnhap">Đăng nhập</a></p>
            </div>
            </div>
        </div>
    </div>

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