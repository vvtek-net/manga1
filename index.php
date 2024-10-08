<!DOCTYPE html>
<html lang="vi">
 <!-- Mirrored from truyentalespot.com/ by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 28 Sep 2024 12:36:35 GMT -->
 <!-- Added by HTTrack -->
 <meta content="text/html;charset=utf-8" http-equiv="content-type"/>
 <!-- /Added by HTTrack -->
 <head>
  <!-- Google tag (gtag.js) -->
  <script async="" src="https://www.googletagmanager.com/gtag/js?id=G-JTT7JZT6DT">
  </script>
  <script>
   window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-JTT7JZT6DT');
  </script>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <title>
  </title>
  <meta content="Truyentalespot" property="og:title"/>
  <meta content="Truyentalespot nền tảng đọc truyện miễn phí" property="og:description"/>
  <meta content="assets/image/logo.ico" property="og:image">
   <meta content="https://truyentalespot.com/index.php" property="og:url">
    <script async="" crossorigin="anonymous" src="cdn/pagead2.googlesyndication.com/pagead/js/f26c4.txt?client=ca-pub-9357006487999643">
    </script>
    <link href="assets/css/styles18f7.css?v=1727526996" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com/" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Agbalumo&amp;family=Inter:wght@300;400;500;600&amp;family=Oswald:wght@300;400;500&amp;display=swap" rel="stylesheet"/>
    <link crossorigin="anonymous" href="cdn/cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-..." rel="stylesheet"/>
    <link href="assets/image/logo.ico" rel="shortcut icon" type="image/png">
     <meta content="903289929360-7umpc2inp7iov7sbsmnrmpiai16onig9.apps.googleusercontent.com" name="google-signin-client_id"/>
    </link>
   </meta>
  </meta>
 </head>
 <body>
  <?php include('includes/header.php'); ?>
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

  <?php include('includes/main.php'); ?>
  <!-- Trong file HTML của bạn -->

  <?php include('includes/footer.php'); ?>
  <button id="btnTop" title="Go to top">
   <i class="fa-solid fa-chevron-up">
   </i>
  </button>
  <script>
   // Khi người dùng cuộn trang, hiển thị nút
window.onscroll = function() {scrollFunction()};

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
   document.addEventListener('DOMContentLoaded', function () {
        const cookieBanner = document.getElementById('cookie-consent-banner');
        const acceptButton = document.getElementById('accept-cookie');

        if (!getCookie('cookie_consent')) {
            cookieBanner.style.display = 'block';
        }

        acceptButton.addEventListener('click', function () {
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
 <!-- Mirrored from truyentalespot.com/ by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 28 Sep 2024 12:37:09 GMT -->
</html>
