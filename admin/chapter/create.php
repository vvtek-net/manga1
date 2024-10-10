<?php
include '../config/db_connection.php';

// Lấy danh sách manga để hiển thị trong dropdown
$manga_query = "SELECT manga_id, manga_name FROM manga";
$manga_result = $conn->query($manga_query);

// Kiểm tra xem form có được submit không
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $chapter_name = $_POST['chapter_name'];
    $manga_id = $_POST['manga_id'];
    $chapter_content = $_POST['chapter_content'];

    // Chuẩn bị câu truy vấn INSERT để thêm dữ liệu vào bảng chapter
    $query = "INSERT INTO chapter (chapter_name, manga_id, chapter_content, update_at) VALUES (?, ?, ?, NOW())";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('sis', $chapter_name, $manga_id, $chapter_content);

    // Thực thi truy vấn
    if ($stmt->execute()) {
        // Chuyển hướng đến trang index.php sau khi thành công
        header('Location: index.php');
        exit();
    } else {
        echo "Lỗi: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tạo Chương Mới</title>

    <!-- CKEditor -->
    <script src="../resources/ckeditor/ckeditor.js"></script>
    
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
        textarea {
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
            width: 100%;
            box-sizing: border-box;
            font-size: 16px;
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
        select {
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
            width: 100%;
            box-sizing: border-box;
            font-size: 16px;
            background-color: white;
            color: #555;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
            appearance: none; /* Ẩn mũi tên mặc định của dropdown */
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 20 20"><polygon points="0,0 10,10 20,0" fill="%23777"/></svg>');
            background-position: right 10px center;
            background-repeat: no-repeat;
            background-size: 12px;
        }

        select:focus {
            border-color: #4CAF50;
            box-shadow: 0 0 5px rgba(76, 175, 80, 0.5);
            outline: none;
        }

        select:hover {
            border-color: #4CAF50;
        }

        option {
            padding: 10px;
        }

    </style>
</head>

<body>

    <h1>Tạo Chương Mới</h1>
    <form action="" method="post">
        <label for="chapter_name">Tên Chương:</label>
        <input type="text" id="chapter_name" name="chapter_name" required>

        <label for="manga_id">Chọn Manga:</label>
        <select id="manga_id" name="manga_id" required>
            <option value="">Chọn Manga</option>
            <?php while ($row = $manga_result->fetch_assoc()): ?>
                <option value="<?= $row['manga_id'] ?>"><?= $row['manga_name'] ?></option>
            <?php endwhile; ?>
        </select>

        <label for="chapter_content">Nội Dung Chương:</label>
        <textarea name="chapter_content" id="chapter_content"></textarea>
        <script>
            CKEDITOR.replace('chapter_content', {
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

        <input type="submit" value="Tạo Chương">
    </form>

</body>
</html>
