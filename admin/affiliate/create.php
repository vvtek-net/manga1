<?php
include '../config/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $aff_name = $_POST['aff_name'];
    $product = $_POST['product'];
    $manga_id = $_POST['manga_id'];

    $query = "INSERT INTO manga_affiliate (aff_link, product_name, manga_id, update_at) VALUES (?, ?, ?, NOW())";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ssi', $aff_name, $product, $manga_id);
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
    <title>Create Trending</title>
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

    <h1>Tạo link affiliate</h1>
    <form action="" method="post">
        <label for="manga_id">Tên truyện:</label>
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

        <label for="aff_name">Link Affiliate:</label>
        <input type="text" id="aff_name" name="aff_name" required>

        <label for="product">Tên sản phẩm:</label>
        <input type="text" id="product" name="product" required>

        <input type="submit" value="Tạo">
    </form>

</body>

</html>