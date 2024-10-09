<?php
include '../config/db_connection.php';

if (isset($_GET['id'])) {
    $manga_id = $_GET['id'];
    $query = "SELECT * FROM manga WHERE manga_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $manga_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $manga = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $manga_id = $_POST['manga_id'];
    $manga_name = $_POST['manga_name'];
    $author = $_POST['author'];
    $description = $_POST['description'];
    $view_number = $_POST['view_number'];

    // Xử lý upload ảnh nếu có ảnh mới
    if (!empty($_FILES["imgurl"]["name"])) {
        $target_dir = "../../assets/image/";
        $target_file = $target_dir . basename($_FILES["imgurl"]["name"]);
        $image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["imgurl"]["tmp_name"]);
        if (
            $check !== false && $_FILES["imgurl"]["size"] <= 5000000 &&
            ($image_file_type == "jpg" || $image_file_type == "png" || $image_file_type == "jpeg")
        ) {

            if (move_uploaded_file($_FILES["imgurl"]["tmp_name"], $target_file)) {
                $imgurl = basename($_FILES["imgurl"]["name"]);
            }
        }
    } else {
        // Nếu không thay đổi ảnh, giữ nguyên ảnh cũ
        $imgurl = $_POST['old_imgurl'];
    }

    // Cập nhật dữ liệu
    $query = "UPDATE manga SET manga_name = ?, author = ?, description = ?, imgurl = ?, view_number = ? WHERE manga_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ssssii', $manga_name, $author, $description, $imgurl, $view_number, $manga_id); // Thứ tự đúng
    $stmt->execute();

    if ($stmt->error) {
        echo "Error updating record: " . $stmt->error;
    } else {
        header('Location: index.php');
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Manga</title>
    <script src="../resources/ckeditor/ckeditor.js"></script>
    <link rel="stylesheet" href="../../assets/css/styles.css">

    <style>
        body {
            display: flex;
            justify-content: center;
            flex-direction: column;
            align-items: center;
            height: 100%;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #ffecd2, #fcb69f);
            padding: 20px;
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

    <h1>Sửa Manga</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="manga_id" value="<?= $manga['manga_id'] ?>">
        <input type="hidden" name="old_imgurl" value="<?= $manga['imgurl'] ?>">

        <label for="manga_name">Tên Manga:</label>
        <input type="text" id="manga_name" name="manga_name" value="<?= $manga['manga_name'] ?>" required><br>

        <label for="author">Tác Giả:</label>
        <input type="text" id="author" name="author" value="<?= $manga['author'] ?>" required><br>

        <label for="description">Mô Tả:</label>
        <textarea name="description" id="description"><?= $manga['description'] ?></textarea>
        <script>
            CKEDITOR.replace('description');
        </script><br>

        <label for="view_number">Views:</label>
        <input type="text" id="view_number" name="view_number" value="<?= $manga['view_number'] ?>" required><br>

        <label for="imgurl">Chọn Ảnh Mới (Nếu có):</label>
        <input type="file" id="imgurl" name="imgurl"><br>
        <img src="../../assets/image/<?= $manga['imgurl'] ?>" width="100" height="100"><br><br>

        <input type="submit" value="Cập Nhật">
        <button onclick="goBack()">Quay Lại</button>
    </form>

    <script>
        function goBack() {
            window.history.back();
        }
    </script>

</body>

</html>