<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phép tính trên hai số</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            padding: 20px;
        }

        .container {
            max-width: 700px;
            width: 100%;
            margin: 0 auto;
        }

        h1 {
            margin-bottom: 10px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 150px auto;
            grid-gap: 10px;
            margin-bottom: 20px;
        }

        .form-grid .full-width {
            grid-column: span 2;
        }

        .form-grid label {
            align-self: center;
        }

        .form-grid input[type="number"],
        .form-grid input[type="submit"] {
            padding: 5px;
            width: 100%;
            box-sizing: border-box;
        }

        .form-grid input[type="submit"] {
            margin-top: 10px;
        }

        .radio-group {
            display: flex;
            gap: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>PHÉP TÍNH TRÊN HAI SỐ</h1>
        <form method="post">
            <div class="form-grid">
                <label for="phepTinh" class="full-width"><strong>Chọn phép tính:</strong></label>
                <div class="radio-group full-width">
                    <label><input type="radio" name="phepTinh" value="Cộng" required> Cộng</label>
                    <label><input type="radio" name="phepTinh" value="Trừ"> Trừ</label>
                    <label><input type="radio" name="phepTinh" value="Nhân"> Nhân</label>
                    <label><input type="radio" name="phepTinh" value="Chia"> Chia</label>
                </div>
                <label for="so1">Số thứ nhất:</label>
                <input type="number" name="so1" id="so1" required>
                <label for="so2">Số thứ hai (nếu cần):</label>
                <input type="number" name="so2" id="so2">
                <input type="submit" name="tinhToan" value="Tính" class="full-width">
            </div>
        </form>

        <?php
        function tinhTong($a, $b)
        {
            return $a + $b;
        }
        function tinhHieu($a, $b)
        {
            return $a - $b;
        }
        function tinhTich($a, $b)
        {
            return $a * $b;
        }
        function tinhThuong($a, $b)
        {
            if ($b == 0) {
                return "Không thể chia cho 0";
            } else {
                return $a / $b;
            }
        }

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

            echo "<h2>Kết quả: $so1 $kyHieu $so2 = $ketQua</h2>";
        }
        ?>

        <h1>KIỂM TRA SỐ</h1>
        <form method="post">
            <div class="form-grid">
                <label for="kiemTra" class="full-width"><strong>Chọn phép kiểm tra:</strong></label>
                <div class="radio-group full-width">
                    <label><input type="radio" name="kiemTra" value="nguyenTo" required> Kiểm tra số nguyên tố</label>
                    <label><input type="radio" name="kiemTra" value="chanLe"> Kiểm tra số chẵn lẻ</label>
                </div>
                <label for="soKiemTra">Số cần kiểm tra:</label>
                <input type="number" name="soKiemTra" id="soKiemTra" required>
                <input type="submit" name="kiemTraSo" value="Kiểm tra" class="full-width">
            </div>
        </form>

        <?php
        function kiemTraNguyenTo($n)
        {
            if ($n <= 1) {
                return false;
            }
            for ($i = 2; $i <= sqrt($n); $i++) {
                if ($n % $i == 0) {
                    return false;
                }
            }
            return true;
        }

        function kiemTraChan($n)
        {
            return $n % 2 == 0;
        }

        if (isset($_POST['kiemTraSo'])) {
            $soKiemTra = $_POST['soKiemTra'];
            $kiemTra = $_POST['kiemTra'];

            if ($kiemTra == 'nguyenTo') {
                echo "<p>Số $soKiemTra " . (kiemTraNguyenTo($soKiemTra) ? "là" : "không phải là") . " số nguyên tố.</p>";
            } else if ($kiemTra == 'chanLe') {
                echo "<p>Số $soKiemTra " . (kiemTraChan($soKiemTra) ? "là" : "không phải là") . " số chẵn.</p>";
            }
        }
        ?>
    </div>
</body>

</html>