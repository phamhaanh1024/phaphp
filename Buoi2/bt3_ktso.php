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

    h1 {
        text-align: center;
        margin-bottom: 20px;
    }

    label {
        margin-right: 10px;
        font-weight: bold;
    }

    input[type="number"],
    input[type="submit"] {
        margin-bottom: 10px;
        padding: 5px;
    }


    input[type="number"] {
        padding: 8px;
        font-size: 16px;
    }


    .radio-group label {
        display: block;
        margin-bottom: 10px;
        font-weight: normal;
        text-align: left;
    }

    .radio-group input {
        margin-right: 10px;
    }

    form {
        width: 100%;
        margin: 0 auto;
    }

    .full-width {
        width: 100%;
    }
    </style>
</head>

<body>
    <div class="container">
        <h1>KIỂM TRA SỐ</h1>
        <form action="bt3_kqkt.php" method="post">
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
    </div>
</body>

</html>