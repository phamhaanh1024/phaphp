<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Kết quả kiểm tra số</title>
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
            margin-bottom: 20px;
        }

        .result {
            margin: 20px 0;
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }

        .back-link {
            display: block;
            margin-top: 20px;
            text-align: center;
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }

        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>KẾT QUẢ KIỂM TRA SỐ</h2>
        <?php
        require 'functions.php';

        if (isset($_POST['kiemTraSo'])) {
            $soKiemTra = $_POST['soKiemTra'];
            $phepKiemTra = $_POST['kiemTra'];
            $ketQua = '';

            if ($phepKiemTra == 'nguyenTo') {
                $ketQua = kiemTraNguyenTo($soKiemTra) ? "Số $soKiemTra là số nguyên tố" : "Số $soKiemTra không phải là số nguyên tố";
            } elseif ($phepKiemTra == 'chanLe') {
                $ketQua = kiemTraChan($soKiemTra) ? "Số $soKiemTra là số chẵn" : "Số $soKiemTra là số lẻ";
            }
        ?>
            <div class="result">
                <p><?php echo htmlspecialchars($ketQua); ?></p>
            </div>
        <?php
        }
        ?>
        <a class="back-link" href="bt3_ktso.php">Quay lại trang kiểm tra</a>
    </div>
</body>

</html>