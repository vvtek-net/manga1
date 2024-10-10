<?php
session_start();
include '../config/db_connection.php';

// Kiểm tra xem form có được submit không
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $manga_id = $_POST['manga_id'];

    // Kiểm tra xem manga_id đã tồn tại trong bảng manga_completed hay chưa
    $check_query = "SELECT * FROM manga_completed WHERE manga_id = ?";
    $stmt = $conn->prepare($check_query);
    $stmt->bind_param("i", $manga_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Nếu truyện đã tồn tại
        $_SESSION['warning'] = "Truyện này đã được thêm, vui lòng chọn truyện khác.";
    } else {
        // Nếu truyện chưa tồn tại, tiến hành thêm mới
        $body = "INSERT INTO manga_completed (manga_id, update_at) VALUES (?, NOW())";
        $stmt = $conn->prepare($body);
        $stmt->bind_param("i", $manga_id);
        if ($stmt->execute()) {
            header('Location: index.php');
            exit();
        } else {
            $_SESSION['warning'] = "Đã xảy ra lỗi khi thêm truyện.";
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

        select#manga_id {
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            width: 100%;
            box-sizing: border-box;
        }
    </style>

</head>

<body>

    <h1>Tạo Manga Mới</h1>
    <form action="" method="post" enctype="multipart/form-data">

        <label for="manga_id">Tên Manga:</label>
        <!-- <input type="text" id="manga_name" name="manga_name" required> -->
        <select name="manga_id" id="manga_id">
            <option value="">-- Chọn truyện --</option>
            <?php
            $query = "SELECT * FROM manga";
            $result = $conn->query($query);
            while ($row = $result->fetch_assoc()) {
                echo '<option value="' . $row['manga_id'] . '">' . $row['manga_name'] . '</option>';
            }
            ?>
        </select>
        <?php
        if (isset($_SESSION['warning'])) {
            echo '<div class="warning" style="color: red;">' . $_SESSION['warning'] . '</div>';
            unset($_SESSION['warning']);
        }
        ?>
        <input type="submit" value="Tạo">
    </form>

</body>

</html>