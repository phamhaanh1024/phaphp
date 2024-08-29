<?php
// Khởi tạo các biến
$tensach = $tacgia = $nhaxuatban = $namxuatban = '';
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Clean input data using test_input()
    $tensach = test_input($_POST['tensach']);
    $tacgia = test_input($_POST['tacgia']);
    $nhaxuatban = test_input($_POST['nhaxuatban']);
    $namxuatban = test_input($_POST['namxuatban']);

    if (empty($tensach)) {
        $errors['tensach'] = "Tên sách là bắt buộc.";
    }

    if (empty($tacgia)) {
        $errors['tacgia'] = "Tác giả là bắt buộc.";
    }

    if (empty($nhaxuatban)) {
        $errors['nhaxuatban'] = "Nhà xuất bản là bắt buộc.";
    }

    if (empty($namxuatban)) {
        $errors['namxuatban'] = "Năm xuất bản là bắt buộc.";
    } elseif (!is_numeric($namxuatban)) {
        $errors['namxuatban'] = "Năm xuất bản phải là một số.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Nhập Liệu</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            height: 100vh;
        }

        form {
            background-color: white;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 20px;
        }

        button:hover {
            background-color: #45a049;
        }

        .error {
            color: red;
            font-size: 12px;
        }

        .submitted-data {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 300px;
            text-align: left;
            margin-top: 20px;
        }

        .submitted-data h3 {
            margin-top: 0;
        }

        .success {
            color: green;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <form name="bookForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="tensach">Tên sách</label>
        <input type="text" name="tensach" id="tensach" value="<?php echo htmlspecialchars($tensach); ?>">
        <span id="tensachError" class="error"><?php echo $errors['tensach'] ?? ''; ?></span>

        <label for="tacgia">Tác giả</label>
        <input type="text" name="tacgia" id="tacgia" value="<?php echo htmlspecialchars($tacgia); ?>">
        <span id="tacgiaError" class="error"><?php echo $errors['tacgia'] ?? ''; ?></span>

        <label for="nhaxuatban">Nhà xuất bản</label>
        <input type="text" name="nhaxuatban" id="nhaxuatban" value="<?php echo htmlspecialchars($nhaxuatban); ?>">
        <span id="nhaxuatbanError" class="error"><?php echo $errors['nhaxuatban'] ?? ''; ?></span>

        <label for="namxuatban">Năm xuất bản</label>
        <input type="text" name="namxuatban" id="namxuatban" value="<?php echo htmlspecialchars($namxuatban); ?>">
        <span id="namxuatbanError" class="error"><?php echo $errors['namxuatban'] ?? ''; ?></span>

        <button type="submit" name="btn" value="gửi">Submit</button>
    </form>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && empty($errors)) { ?>
        <div class="submitted-data">
            <h3>Dữ liệu đã nhập:</h3>
            <p><strong>Tên sách:</strong> <?php echo htmlspecialchars($tensach); ?></p>
            <p><strong>Tác giả:</strong> <?php echo htmlspecialchars($tacgia); ?></p>
            <p><strong>Nhà xuất bản:</strong> <?php echo htmlspecialchars($nhaxuatban); ?></p>
            <p><strong>Năm xuất bản:</strong> <?php echo htmlspecialchars($namxuatban); ?></p>
            <p class="success">Form submitted successfully!</p>
        </div>
    <?php } ?>
</body>

</html>