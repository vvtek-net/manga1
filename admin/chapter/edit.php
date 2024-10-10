<?php
include '../config/db_connection.php';

// Lấy danh sách manga để hiển thị trong dropdown
$manga_query = "SELECT manga_id, manga_name FROM manga";
$manga_result = $conn->query($manga_query);

// Kiểm tra nếu có ID của chapter được truyền vào URL
if (isset($_GET['id'])) {
    $chapter_id = $_GET['id'];
    $query = "SELECT * FROM chapter WHERE chapter_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $chapter_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $chapter = $result->fetch_assoc();
}

// Kiểm tra nếu form được submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $chapter_id = $_POST['chapter_id'];
    $chapter_name = $_POST['chapter_name'];
    $manga_id = $_POST['manga_id'];
    $chapter_content = $_POST['chapter_content'];

    // Cập nhật dữ liệu
    $query = "UPDATE chapter SET chapter_name = ?, manga_id = ?, chapter_content = ?, update_at = NOW() WHERE chapter_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('sisi', $chapter_name, $manga_id, $chapter_content, $chapter_id);
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
    <title>Sửa Chương</title>
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
        select,
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
    </style>
</head>

<body>

    <h1>Sửa Chương</h1>
    <form action="" method="post">
        <input type="hidden" name="chapter_id" value="<?= $chapter['chapter_id'] ?>">

        <label for="chapter_name">Tên Chương:</label>
        <input type="text" id="chapter_name" name="chapter_name" value="<?= $chapter['chapter_name'] ?>" required><br>

        <label for="manga_id">Chọn Manga:</label>
        <select id="manga_id" name="manga_id" required>
            <?php while ($row = $manga_result->fetch_assoc()): ?>
                <option value="<?= $row['manga_id'] ?>" <?= ($row['manga_id'] == $chapter['manga_id']) ? 'selected' : '' ?>>
                    <?= $row['manga_name'] ?>
                </option>
            <?php endwhile; ?>
        </select><br>

        <label for="chapter_content">Nội Dung Chương:</label>
        <textarea name="chapter_content" id="chapter_content"><?= $chapter['chapter_content'] ?></textarea>
        <script>
            CKEDITOR.replace('chapter_content');
        </script><br>

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
