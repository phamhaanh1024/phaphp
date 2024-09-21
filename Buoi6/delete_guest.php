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

// Xóa nhân viên có ID là 3
$sql = "DELETE FROM myGuests WHERE id=3";
if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully<br>";
} else {
    echo "Error deleting record: " . $conn->error . "<br>";
}

// Hiển thị danh sách cập nhật
$sql = "SELECT id, firstname, lastname, reg_date FROM myGuests";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'><tr><th>ID</th><th>Firstname</th><th>Lastname</th><th>Registration Date</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["id"] . "</td><td>" . $row["firstname"] . "</td><td>" . $row["lastname"] . "</td><td>" . $row["reg_date"] . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
$conn->close();
