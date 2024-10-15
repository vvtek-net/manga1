<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mở trong trình duyệt mặc định</title>
    <style>
        /* Style cho popup tùy chỉnh */
        #popup {
            display: flex;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        #popup-content {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            width: 80%;
            max-width: 400px;
        }

        #popup h2 {
            margin-bottom: 20px;
        }

        #popup button {
            margin: 10px;
            padding: 10px 20px;
            border: none;
            background-color: #4CAF50;
            color: white;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
        }

        #popup button.stay {
            background-color: #555;
        }
    </style>
</head>
<body>

<?php
    // Lấy URL từ POST data
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['redirect'])) {
        $redirectUrl = $_GET['redirect']; // Đảm bảo URL an toàn
    } else {
        $redirectUrl = "https://defaulturl.com"; // URL mặc định nếu không có dữ liệu
    }
?>

    <!-- Popup tùy chỉnh -->
    <div id="popup">
        <div id="popup-content">
            <h2>Bạn có muốn đọc truyện với trải nghiệm tốt nhất?</h2>
            <button onclick="openInDefaultBrowser()">Có</button>
            <button class="stay" onclick="stayOnPage()">Không</button>
        </div>
    </div>

    <script>
        // URL được nhận từ PHP
        const redirectUrl = "<?php echo $redirectUrl; ?>";

        // Hàm để mở link trong trình duyệt mặc định (hoặc Chrome trên Android)
        function openInDefaultBrowser() {
            const isAndroid = /android/i.test(navigator.userAgent);
            if (isAndroid) {
                // Intent URI cho Android để mở trong Chrome với URL hiện tại
                window.location.href = `intent://${redirectUrl.replace(/^https?:\/\//, '')}#Intent;scheme=https;package=com.android.chrome;end`;
            } else {
                // Đối với iOS hoặc các thiết bị khác, mở URL hiện tại trong Safari hoặc trình duyệt mặc định
                window.location.href = redirectUrl;
            }
        }

        // Hàm đóng popup và tiếp tục ở lại trang hiện tại
        function stayOnPage() {
            document.getElementById('popup').style.display = 'none';
        }
    </script>
</body>
</html>
