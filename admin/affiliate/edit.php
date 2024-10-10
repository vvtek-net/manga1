<?php
include '../config/db_connection.php';

if (isset($_GET['id'])) {
    $aff_id = $_GET['id'];
    $query = "SELECT * FROM manga_affiliate WHERE aff_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $aff_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $affiliate = $result->fetch_assoc();
    $manga_id = $affiliate['manga_id']; // Lưu manga_id
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $aff_id = $_POST['aff_id'];
    $product = $_POST['product_name'];

    $query = "UPDATE manga_affiliate SET product_name = ? WHERE aff_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('si', $product, $aff_id);
    $stmt->execute();

    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Trending</title>
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

    <h1>Sửa Affiliate</h1>
    <form action="" method="post">
        <label for="manga_id">Tên truyện:</label>
        <select name="manga_id" id="manga_id">
            <?php
            $query = "SELECT * FROM manga";
            $stmt = $conn->prepare($query);
            $stmt->execute();
            $result = $stmt->get_result();

            ?>
            <option value="">-- Chọn truyện --</option>
            <?php
            while ($row = $result->fetch_assoc()) {
                // Kiểm tra nếu manga_id tương ứng với affiliate
                $selected = ($row['manga_id'] == $manga_id) ? 'selected' : '';
                echo '<option value="' . $row['manga_id'] . '" ' . $selected . '>' . $row['manga_name'] . '</option>';
            }
            ?>
        </select>

        <label for="aff_name">Link Affiliate:</label>
        <input type="text" id="aff_name" name="aff_name" required value="<?= $affiliate['aff_link'] ?>">

        <label for="product">Tên sản phẩm:</label>
        <input type="text" id="product" name="product" required value="<?= $affiliate['product_name'] ?>">

        <input type="submit" value="Cập nhật">
    </form>

</body>

</html>