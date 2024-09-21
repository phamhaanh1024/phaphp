<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "b5_mydb";

// Tạo kết nối
$conn = new mysqli($servername, $username, $password);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Tạo cơ sở dữ liệu
$sql = "CREATE DATABASE IF NOT EXISTS b5_mydb";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully<br>";
} else {
    echo "Error creating database: " . $conn->error;
}

// Chọn cơ sở dữ liệu
$conn->select_db("b5_mydb");

// Tạo bảng myGuests
$sql = "CREATE TABLE IF NOT EXISTS myGuests (
id INT(11) AUTO_INCREMENT PRIMARY KEY,
firstname VARCHAR(50) NOT NULL,
lastname VARCHAR(50) NOT NULL,
email VARCHAR(100),
reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Table myGuests created successfully<br>";
} else {
    echo "Error creating table: " . $conn->error;
}

// Hiển thị bảng
$sql = "SELECT id, firstname, lastname, email, reg_date FROM myGuests";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'><tr><th>ID</th><th>Firstname</th><th>Lastname</th><th>Email</th><th>Registration Date</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["id"] . "</td><td>" . $row["firstname"] . "</td><td>" . $row["lastname"] . "</td><td>" . $row["email"] . "</td><td>" . $row["reg_date"] . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
$conn->close();
