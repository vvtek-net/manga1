<?php
include '../config/db_connection.php';

// Kiểm tra xem form có được submit không
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $manga_name = $_POST['manga_name'];
    $author = $_POST['author'];
    $description = $_POST['description'];

    // Xử lý upload ảnh
    $target_dir = "../../assets/image/";
    $target_file = $target_dir . basename($_FILES["imgurl"]["name"]);
    $upload_ok = 1;
    $image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Kiểm tra xem tệp có phải là ảnh không
    $check = getimagesize($_FILES["imgurl"]["tmp_name"]);
    if ($check !== false) {
        $upload_ok = 1;
    } else {
        echo "Tệp không phải là ảnh.";
        $upload_ok = 0;
    }

    // Kiểm tra kích thước tệp
    if ($_FILES["imgurl"]["size"] > 5000000) { // 5MB
        echo "Xin lỗi, tệp quá lớn.";
        $upload_ok = 0;
    }

    // Cho phép các định dạng ảnh nhất định
    if ($image_file_type != "jpg" && $image_file_type != "png" && $image_file_type != "jpeg") {
        echo "Chỉ cho phép các tệp JPG, JPEG, PNG.";
        $upload_ok = 0;
    }

    // Kiểm tra upload_ok trước khi upload
    if ($upload_ok == 1) {
        if (move_uploaded_file($_FILES["imgurl"]["tmp_name"], $target_file)) {
            // Upload thành công, thêm dữ liệu vào database
            $imgurl = basename($_FILES["imgurl"]["name"]);

            // Thêm dữ liệu vào database
            $query = "INSERT INTO manga (manga_name, author, description, imgurl) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('ssss', $manga_name, $author, $description, $imgurl);
            $stmt->execute();

            header('Location: index.php');
            exit();
        } else {
            echo "Xin lỗi, có lỗi khi upload tệp của bạn.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tạo Manga Mới</title>
    <script src="../resources/ckeditor/ckeditor.js"></script> <!-- CKEditor -->
    <link rel="stylesheet" href="../../assets/css/styles.css">

    <style>
        body {
            display: flex;
            justify-content: center;
            flex-direction: column;
            align-items: center;
            height: 100vh;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #ffecd2, #fcb69f);
            /* padding: 20px; */
        }

        .container {
            background-color: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
        }

        h1 {
            text-align: center;
            color: #333;
            font-size: 24px;
            margin-bottom: 20px;
            /* margin-top: 100px; */
        }

        form {
            display: flex;
            flex-direction: column;
            width: 100%;
        }

        label {
            font-weight: bold;
            color: #555;
            margin-top: 10px;
        }

        input[type="text"],
        textarea,
        input[type="file"] {
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
            width: 100%;
            box-sizing: border-box;
            font-size: 16px;
        }

        input[type="file"] {
            padding: 5px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 12px;
            margin-top: 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            font-size: 16px;
            transition: background 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        img {
            margin-top: 10px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .form-field {
            margin-bottom: 15px;
        }
    </style>

</head>

<body>

    <h1>Tạo Manga Mới</h1>
    <form action="create.php" method="post" enctype="multipart/form-data">
        <label for="manga_name">Tên Manga:</label>
        <input type="text" id="manga_name" name="manga_name" required>

        <label for="author">Tác Giả:</label>
        <input type="text" id="author" name="author" required>

        <label for="description">Mô Tả:</label>
        <textarea name="description" id="description"></textarea>
        <script>
            CKEDITOR.replace('description');
        </script>

        <label for="imgurl">Chọn Ảnh Bìa:</label>
        <input type="file" id="imgurl" name="imgurl" required><br>

        <input type="submit" value="Tạo">
    </form>

</body>

</html>