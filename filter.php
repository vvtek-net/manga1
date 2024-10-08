<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include('config/db_connection.php');

// Kiểm tra xem GET có tồn tại không
$manga_type = isset($_GET['manga_type']) ? $_GET['manga_type'] : null;
$manga_trending = isset($_GET['manga_trending']) ? $_GET['manga_trending'] : null;

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

try {
    $query = "";
    $stmt = null;

    if ($manga_type !== null) {
        // Truy vấn theo thể loại
        $query = "SELECT * FROM manga WHERE type_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $manga_type);
    } elseif ($manga_trending !== null) {
        // Truy vấn theo thịnh hành
        $query = "SELECT * FROM manga WHERE trending_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $manga_trending);
    } else {
        // Nếu không có gì được truyền vào URL, thực hiện truy vấn toàn bộ manga
        $query = "SELECT * FROM manga";
        $stmt = $conn->prepare($query);
    }

    if ($stmt) {
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Lưu kết quả vào mảng để hiển thị
            $mangas = [];
            while ($row = $result->fetch_assoc()) {
                $mangas[] = $row;
            }

            // Ví dụ: hiển thị tên các manga
            foreach ($mangas as $manga) {
                
            }
        } else {
            echo "<p>Không tìm thấy dữ liệu phù hợp.</p>";
        }
    } else {
        throw new Exception("Lỗi khi chuẩn bị truy vấn.");
    }
} catch (Exception $e) {
    echo "<p>Lỗi: " . $e->getMessage() . "</p>";
}
?>

<!DOCTYPE html>
<html lang="vi">

<!-- Mirrored from truyentalespot.com/index.php?quanly=truyen&moiCapNhat=truyenMoi by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 28 Sep 2024 12:37:37 GMT -->
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
    <script async src="cdn/pagead2.googlesyndication.com/pagead/js/f26c4.txt?client=ca-pub-9357006487999643"
     crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/styles2a97.css?v=1727527012">
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Agbalumo&amp;family=Inter:wght@300;400;500;600&amp;family=Oswald:wght@300;400;500&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="cdn/cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" />
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
            
<!-- Thẻ img cho hiển thị ảnh -->
<img class="top-bg-op-box" src="assets/image/banner.jpg" alt="Background Image">
<main>
<script>
    document.addEventListener('DOMContentLoaded', function () {
    var filterToggle = document.getElementById('mobileFilterToggle');
    var filterModal = document.getElementById('filterModal');
    var closeButton = document.getElementsByClassName("close")[0];

    // Khi người dùng nhấn vào icon, mở modal
    filterToggle.addEventListener('click', function () {
        filterModal.style.display = "block";
    });

    // Khi người dùng nhấn vào nút đóng (x), đóng modal
    closeButton.onclick = function() {
        filterModal.style.display = "none";
    }

    // Khi người dùng nhấn vào bất cứ đâu ngoài modal, đóng modal
    window.onclick = function(event) {
        if (event.target == filterModal) {
            filterModal.style.display = "none";
        }
    }
});
</script>
<!-- Icon để mở form -->

    
  <div class="container">
        <div class="main-content">
        <div class="filter-container-eds">
    <!-- Xử lý với PHP -->
    <?php
        $query_manga_type = "SELECT * FROM manga_type";
        $stmt = $conn->prepare($query_manga_type);
        $stmt->execute();
        $result = $stmt->get_result();
    ?>
    <h4>Thể Loại</h4>
    <ul class="filter-list-eds">
        <?php while ($row = $result->fetch_assoc()): ?>
            <li class='filter-item-eds'>
                <a href='filter.php?manga_type=<?= urlencode($row['type_name']); ?>' class=''>
                    <?= htmlspecialchars($row['type_name']); ?>
                </a>
            </li>
        <?php endwhile; ?>
    </ul>
</div>


            <div class="list-container-eds">
                <div class="additional-info-container-eds">
                    <div class="jfsdjfj">
                <div class="mobile-filter-menu">
    <i class="fa-solid fa-arrow-down-wide-short" id="mobileFilterToggle"></i>
</div>

<!-- Modal Form -->
<div id="filterModal" class="modal">
    <!-- Nội dung của modal -->
    <div class="modal-content">
        
        <span class="close">&times;</span>
        <div class="iljdjld">
        <h2>Bộ lọc</h2>
        <div class="fkdjf432a">
                    <ul class="additional-info-list-eds">

                        
                        <!-- Các mục khác ở đây -->
                    </ul>
                </div>

        
       
                </div>
            </div>

                
                </div>
                </div>
                <div class="search-container">  
                </div>

        <?php
            //lấy thể type_name trong bảng manga_type từ type_id trong bảng manga
        ?>
            <div class="story-row">
                <div class="story-item">
                            <div class="story-thumbnail">
                                <!-- Ảnh truyện (thay thế bằng đường dẫn đến hình ảnh từ cơ sở dữ liệu) -->
                                <img src="cdn/res.cloudinary.com/deam5w1nh/image/upload/v1727195947/q6dzogbhigymhhcht9yl.jpg"
                                    alt="Truyện Sau Khi Xuyên Sách, Ta Nuôi Dạy Vai Ác Lúc Còn Nhỏ">
                            </div>
                            <div class="story-details">
                                <!-- Thông tin truyện -->
                                <a class="tieude" href="story.php?manga_id="> Sau Khi Xuyên Sách, Ta Nuôi Dạy Vai Ác Lúc Còn Nhỏ</a>
                                <p class="tomtat_v1"> </p>
                                <p class="tacgia321"><i class="fa-solid fa-user-pen"></i>
                                    Điềm Nị Tiểu Mễ Chúc                                </p></br>
                                <a href="index5fc9.html?quanly=truyen&amp;category[]=Xuy%c3%aan%20S%c3%a1ch" class="theloai321"> Xuyên Sách</a></br>

                                                            </div>
                        </div>
                                            
                <div class="pagination">
                    <!-- Phân trang -->
            </div>
        </div>
    </div>
</main>
<script>
    
document.getElementById('show-dropdown').addEventListener('click', function() {
    var content = document.getElementById('dropdown-content').cloneNode(true);
    content.style.display = 'block'; // Đảm bảo nội dung được hiển thị

    var dropdownContainer = document.createElement('div');
    dropdownContainer.id = 'dropdown-container';
    dropdownContainer.style.left = '100px'; // Vị trí tùy chỉnh
    dropdownContainer.style.top = '50px'; // Vị trí tùy chỉnh

    dropdownContainer.appendChild(content);
    document.body.appendChild(dropdownContainer);
});
</script>

<script>
    
    // Sử dụng một mảng để lưu trữ các thể loại được chọn
    var selectedCategories = [];

    function toggleCategory(category) {
        // Kiểm tra xem thể loại đã được chọn chưa
        var index = selectedCategories.indexOf(category);

        if (index !== -1) {
            // Nếu đã chọn, hãy loại bỏ khỏi mảng
            selectedCategories.splice(index, 1);
        } else {
            // Nếu chưa chọn, thêm vào mảng
            selectedCategories.push(category);
        }

        // Cập nhật hiển thị
        updateDisplay();
    }

    function updateDisplay() {
        // Lấy thẻ span để hiển thị từ khóa
        var selectedKeywordsList = document.getElementById('selectedKeywordsList');

        // Xóa các từ khóa hiện tại
        selectedKeywordsList.innerHTML = "";

        // Hiển thị các thể loại được chọn
        selectedCategories.forEach(function (category) {
            var keywordSpan = document.createElement('span');
            keywordSpan.textContent = category;
            selectedKeywordsList.appendChild(keywordSpan);
            // Thêm dấu phẩy nếu không phải là từ khóa cuối cùng
            if (selectedCategories.indexOf(category) !== selectedCategories.length - 1) {
                selectedKeywordsList.appendChild(document.createTextNode(', '));
            }
        });
    }
</script>



<script>
document.addEventListener('DOMContentLoaded', function () {
    // Khi toàn bộ nội dung đã được tải, thiết lập các sự kiện cho dropdowns
    setupDropdowns();
});

function setupDropdowns() {
    // Chọn tất cả các phần tử có class 'dropdown-item-eds' và gắn sự kiện onclick
    var dropdownItems = document.querySelectorAll('.dropdown-item-eds');
    dropdownItems.forEach(function (item) {
        item.onclick = function () {
            toggleDropdown(this);
        };
    });
}

var openDropdown = null;

function toggleDropdown(element) {
    // Tìm dropdown content gần nhất với phần tử được click
    var dropdown = element.querySelector('.dropdown-123');

    if (!dropdown) {
        console.error("No dropdown content found for", element);
        return;
    }

    // Kiểm tra xem có dropdown nào đang mở không và không phải là dropdown hiện tại
    if (openDropdown && openDropdown !== dropdown) {
        openDropdown.style.display = 'none';
    }

    // Bật / Tắt hiển thị cho dropdown hiện tại
    if (dropdown.style.display === 'block') {
        dropdown.style.display = 'none';
        openDropdown = null;
    } else {
        dropdown.style.display = 'block';
        openDropdown = dropdown;
    }

    // Đặt class 'active' cho phần tử hiện tại và loại bỏ khỏi các phần tử khác
    setActive(element);
}

function setActive(element) {
    // Xóa class 'active' khỏi tất cả các sibling
    var siblingItems = element.parentNode.children;
    for (var i = 0; i < siblingItems.length; i++) {
        siblingItems[i].classList.remove('active');
    }

    // Thêm class 'active' cho phần tử được click
    element.classList.add('active');
}

</script>
    </div>
    <script async src="cdn/pagead2.googlesyndication.com/pagead/js/f26c4.txt?client=ca-pub-9357006487999643"
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

<!-- Mirrored from truyentalespot.com/index.php?quanly=truyen&moiCapNhat=truyenMoi by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 28 Sep 2024 12:37:37 GMT -->
</html>
