<?php
include '../config/db_connection.php';
// Kiểm tra xem có loại truyện nào chưa được tạo
$type_check_query = "SELECT COUNT(*) as count FROM manga_type";
$type_check_result = $conn->query($type_check_query);
$type_check = $type_check_result->fetch_assoc();

$missing_data = [];
if ($type_check['count'] == 0) {
    $missing_data[] = "Loại Truyện";
}

// Lấy danh sách các loại truyện để hiển thị trong dropdown
$type_query = "SELECT type_id, type_name FROM manga_type";
$type_result = $conn->query($type_query);

// Kiểm tra xem form có được submit không
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $manga_name = $_POST['manga_name'];
    $author = $_POST['author'];
    $description = $_POST['description'];
    $type_id = $_POST['type_id'];

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
            $imgurl = 'assets/image/'.basename($_FILES["imgurl"]["name"]);

            // Thêm dữ liệu vào database với type_id (loại truyện)
            $query = "INSERT INTO manga (manga_name, author, description, imgurl, type_id) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('ssssi', $manga_name, $author, $description, $imgurl, $type_id);
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
    
    <!-- CKEditor -->
    <script src="../resources/ckeditor/ckeditor.js"></script>

    <!-- Showdown.js for Markdown to HTML conversion -->
    <script src="https://cdn.jsdelivr.net/npm/showdown@1.9.1/dist/showdown.min.js"></script>
    
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
        input[type="file"],
        select {
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

        /* Styles for the popup modal */
        .modal {
            display: none; 
            position: fixed; 
            z-index: 1; 
            left: 0;
            top: 0;
            width: 100%; 
            height: 100%; 
            background-color: rgba(0, 0, 0, 0.5); 
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            max-width: 400px;
            width: 100%;
        }

        .close-btn {
            background-color: #f0ad4e;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }

        .close-btn:hover {
            background-color: #ec971f;
        }
    </style>

</head>

<body>

    <h1>Tạo Manga Mới</h1>

    <?php if (!empty($missing_data)): ?>
        <!-- The Modal -->
        <div id="myModal" class="modal">
            <div class="modal-content">
                <p style="color:red"><strong>Bạn chưa tạo thể loại truyện!</strong></p>
                <br>
                <a href="../manga_type/create.php" class="close-btn">Tạo Ngay!!</a>
                    </div>
                    <!-- <button class="close-btn" onclick="closeModal()">Đóng</button> -->
            </div>
        </div>

        <script>
            // Show the modal if there's missing data
            document.getElementById('myModal').style.display = 'flex';

            // Function to close the modal
            function closeModal() {
                document.getElementById('myModal').style.display = 'none';
            }
        </script>
    <?php endif; ?>

    <form action="" method="post" enctype="multipart/form-data">
        <label for="manga_name">Tên Manga:</label>
        <input type="text" id="manga_name" name="manga_name" required>

        <label for="author">Tác Giả:</label>
        <input type="text" id="author" name="author" required>

        <label for="type_id">Chọn Loại Truyện:</label>
        <select id="type_id" name="type_id" required>
            <option value="">Chọn Loại Truyện</option>
            <?php while ($row = $type_result->fetch_assoc()): ?>
                <option value="<?= $row['type_id'] ?>"><?= $row['type_name'] ?></option>
            <?php endwhile; ?>
        </select>
        
        <label for="description">Mô Tả:</label>
        <textarea name="description" id="description"></textarea>
        <script>
            CKEDITOR.replace('description', {
                toolbar: [
                    { name: 'clipboard', items: ['Cut', 'Copy', 'Paste', 'Undo', 'Redo'] },
                    { name: 'editing', items: ['Find', 'Replace', 'SelectAll'] },
                    { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript'] },
                    { name: 'paragraph', items: ['NumberedList', 'BulletedList', 'Outdent', 'Indent', 'Blockquote'] },
                    { name: 'links', items: ['Link', 'Unlink', 'Anchor'] },
                    { name: 'insert', items: ['Image', 'Table', 'HorizontalRule', 'SpecialChar', 'PageBreak'] },
                    { name: 'styles', items: ['Styles', 'Format', 'Font', 'FontSize'] },
                    { name: 'colors', items: ['TextColor', 'BGColor'] },
                    { name: 'tools', items: ['Maximize', 'ShowBlocks'] },
                    { name: 'document', items: ['Source', 'Preview', 'Print'] }
                ],
                height: 300
            });
        </script>

        <label for="imgurl">Chọn Ảnh Bìa:</label>
        <input type="file" id="imgurl" name="imgurl" required><br>

        <input type="submit" value="Tạo">
    </form>

</body>

</html>

