<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Nhập liệu</title>
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

    label {
        margin-right: 10px;
    }

    input[type="number"],
    input[type="submit"] {
        margin-bottom: 10px;
        padding: 5px;
    }

    form {
        width: 100%;
        margin: 0 auto;
    }
    </style>
</head>

<body>
    <div class="container">
        <h2>PHÉP TÍNH TRÊN HAI SỐ</h2>
        <form action="bt3_kqpheptinh.php" method="post">
            <label>Chọn phép tính:</label>
            <input type="radio" name="phepTinh" value="Cộng" required> Cộng
            <input type="radio" name="phepTinh" value="Trừ"> Trừ
            <input type="radio" name="phepTinh" value="Nhân"> Nhân
            <input type="radio" name="phepTinh" value="Chia"> Chia
            <br><br>
            <label>Số thứ nhất:</label>
            <input type="number" name="so1" required>
            <br><br>
            <label>Số thứ hai:</label>
            <input type="number" name="so2" required>
            <br><br>
            <input type="submit" name="tinhToan" value="Tính">
        </form>
    </div>
</body>

</html>