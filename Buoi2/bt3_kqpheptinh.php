<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Kết quả phép tính</title>
    <style>
        .container {
            width: 50%;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h2 {
            text-align: center;
        }

        .result {
            margin: 20px 0;
        }

        .result div {
            margin-bottom: 10px;
        }

        label {
            font-weight: bold;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>KẾT QUẢ PHÉP TÍNH</h2>

        <?php
        require_once 'functions.php'; // Bao gồm tập tin chứa các hàm tính toán chỉ một lần

        if (isset($_POST['tinhToan'])) {
            $so1 = $_POST['so1'];
            $so2 = $_POST['so2'];
            $phepTinh = $_POST['phepTinh'];
            $ketQua = '';
            $kyHieu = '';

            switch ($phepTinh) {
                case 'Cộng':
                    $ketQua = tinhTong($so1, $so2);
                    $kyHieu = '+';
                    break;
                case 'Trừ':
                    $ketQua = tinhHieu($so1, $so2);
                    $kyHieu = '-';
                    break;
                case 'Nhân':
                    $ketQua = tinhTich($so1, $so2);
                    $kyHieu = '*';
                    break;
                case 'Chia':
                    $ketQua = tinhThuong($so1, $so2);
                    $kyHieu = '/';
                    break;
            }
        ?>
            <div class="result">
                <div><label>Chọn phép tính:</label> <?php echo htmlspecialchars($phepTinh); ?></div>
                <div><label>Số 1:</label> <?php echo htmlspecialchars($so1); ?></div>
                <div><label>Số 2:</label> <?php echo htmlspecialchars($so2); ?></div>
                <div><label>Kết quả:</label> <?php echo htmlspecialchars("$so1 $kyHieu $so2 = $ketQua"); ?></div>
            </div>
        <?php
        }
        ?>

        <a class="back-link" href="./bt3_pheptinh.php">Quay lại trang trước</a>
    </div>
</body>

</html>