<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "b5_mydb";

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Truy vấn lấy dữ liệu
$sql = "SELECT id, firstname, lastname, email, reg_date FROM myGuests";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Tạo bảng HTML để hiển thị dữ liệu
    echo "<table border='1'><tr><th>ID</th><th>Firstname</th><th>Lastname</th><th>Email</th><th>Registration Date</th></tr>";
    // Xuất dữ liệu của mỗi hàng
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["id"] . "</td><td>" . $row["firstname"] . "</td><td>" . $row["lastname"] . "</td><td>" . $row["email"] . "</td><td>" . $row["reg_date"] . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

$conn->close();
