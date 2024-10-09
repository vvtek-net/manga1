<?php
include '../config/db_connection.php';

$account = null; // Initialize the variable to avoid undefined variable error

// Check if the user ID is passed as a GET parameter
if (isset($_GET['id'])) {
    $acc_id = $_GET['id'];
    // Query to get the current account details
    $query = "SELECT * FROM accounts WHERE acc_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $acc_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $account = $result->fetch_assoc();
}

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $acc_id = $_POST['acc_id'];
    $username = $_POST['username'];
    $fullname = $_POST['fullname'];
    $role_id = $_POST['role_id'];

    // Check if the password field is not empty
    if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the new password
        $query = "UPDATE accounts SET username = ?, fullname = ?, password = ?, role_id = ? WHERE acc_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('sssii', $username, $fullname, $password, $role_id, $acc_id);
    } else {
        $query = "UPDATE accounts SET username = ?, fullname = ?, role_id = ? WHERE acc_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ssii', $username, $fullname, $role_id, $acc_id);
    }

    // Execute the query
    if ($stmt->execute()) {
        // Redirect to the accounts list page after successful update
        header('Location: index.php');
        exit();
    } else {
        echo "Error updating record: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Account</title>
    <link rel="stylesheet" href="../../assets/css/styles.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #84fab0, #8fd3f4);
        }

        .container {
            background-color: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            width: 400px;
        }

        h1 {
            text-align: center;
            color: #333;
            font-size: 24px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-top: 10px;
            font-weight: bold;
            color: #555;
        }

        input[type="text"],
        input[type="password"],
        input[type="number"] {
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
            width: 100%;
            box-sizing: border-box;
            font-size: 16px;
        }

        input[type="submit"] {
            background-color: #2196F3;
            color: white;
            padding: 10px;
            margin-top: 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            font-size: 16px;
            transition: background 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #0b7dda;
        }

        .form-field {
            margin-bottom: 15px;
        }

        .optional-info {
            font-size: 12px;
            color: #999;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>Edit Account</h1>

        <?php if ($account): // Check if the account data exists 
        ?>
            <form action="edit.php" method="post">
                <input type="hidden" name="acc_id" value="<?= $account['acc_id'] ?>">

                <div class="form-field">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" value="<?= $account['username'] ?>" required>
                </div>

                <div class="form-field">
                    <label for="fullname">Fullname:</label>
                    <input type="text" id="fullname" name="fullname" value="<?= $account['fullname'] ?>" required>
                </div>

                <div class="form-field">
                    <label for="password">Password <span class="optional-info">(Leave blank if not changing)</span>:</label>
                    <input type="password" id="password" name="password">
                </div>

                <div class="form-field">
                    <label for="role_id">Role ID:</label>
                    <input type="number" id="role_id" name="role_id" value="<?= $account['role_id'] ?>" required>
                </div>

                <input type="submit" value="Update">
            </form>
        <?php else: ?>
            <p>No account found. Please go back and try again.</p>
        <?php endif; ?>
    </div>

</body>

</html>