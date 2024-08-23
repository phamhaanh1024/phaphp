<?php
include 'bt4_1.php';

$mang = [];
$maxValue = $minValue = $tongMang = $isValueInArray = $checkValue = $mangSapXep = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Tách mảng từ chuỗi nhập vào và chuyển đổi các phần tử thành số nguyên
    $mang = array_map('intval', explode(',', $_POST['mang']));
    $checkValue = intval($_POST['checkValue']);

    // Xử lý mảng
    $maxValue = timGiaTriLonNhat($mang);
    $minValue = timGiaTriNhoNhat($mang);
    $tongMang = tinhTongMang($mang);
    $isValueInArray = kiemTraPhanTuCoThuocMang($mang, $checkValue);
    $mangSapXep = sapXepMangTangDan($mang);
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Array Functions</title>
    <link rel="stylesheet" href="bt4.css">
</head>

<body>
    <div class="container">
        <h2>Array Functions</h2>
        <form method="post">
            <label for="mang">Nhập mảng (các phần tử cách nhau bởi dấu phẩy):</label><br>
            <input type="text" id="mang" name="mang"
                value="<?php echo isset($_POST['mang']) ? htmlspecialchars($_POST['mang']) : ''; ?>" required><br><br>

            <label for="checkValue">Nhập giá trị cần kiểm tra:</label><br>
            <input type="text" id="checkValue" name="checkValue"
                value="<?php echo isset($_POST['checkValue']) ? htmlspecialchars($_POST['checkValue']) : ''; ?>"
                required><br><br>

            <input type="submit" value="Xử lý">
        </form>

        <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
            <div class="result">
                <p>Mảng ban đầu: <?php echo implode(", ", $mang); ?></p>
                <p>Giá trị lớn nhất trong mảng: <?php echo $maxValue; ?></p>
                <p>Giá trị nhỏ nhất trong mảng: <?php echo $minValue; ?></p>
                <p>Tổng các phần tử trong mảng: <?php echo $tongMang; ?></p>
                <p>Mảng sau khi sắp xếp: <?php echo implode(", ", $mangSapXep); ?></p>
                <p><?php echo $checkValue; ?> <?php echo $isValueInArray ? "có" : "không"; ?> trong mảng</p>
            </div>
        <?php endif; ?>
    </div>
</body>

</html>