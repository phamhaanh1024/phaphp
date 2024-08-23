<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách Sách</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 2px solid black;
        }

        th,
        td {
            padding: 5px;
            text-align: left;
        }

        .pagination {
            margin-top: 10px;
            text-align: center;
        }

        .pagination a {
            margin: 0 5px;
            text-decoration: none;
            color: black;
            border: 1px solid black;
            padding: 5px;
        }

        .pagination a.active {
            background-color: #ddd;
            border: 1px solid #ddd;
        }
    </style>
</head>

<body>
    <h1>Danh sách Sách</h1>
    <table>
        <tr>
            <th>STT</th>
            <th>Tên sách</th>
            <th>Nội dung sách</th>
        </tr>
        <?php
        // Dữ liệu giả lập
        $books = array(
            array("Tensach1", "Noidung1"),
            array("Tensach2", "Noidung2"),
            array("Tensach3", "Noidung3"),
            array("Tensach4", "Noidung4"),
            array("Tensach5", "Noidung5"),
            array("Tensach6", "Noidung6"),
            array("Tensach7", "Noidung7"),
            array("Tensach8", "Noidung8"),
            array("Tensach9", "Noidung9"),
            array("Tensach10", "Noidung10"),
            array("Tensach11", "Noidung11"),
            array("Tensach12", "Noidung12"),
            // Thêm dữ liệu để kiểm tra phân trang
            array("Tensach13", "Noidung13"),
            array("Tensach14", "Noidung14"),
            array("Tensach15", "Noidung15"),
            array("Tensach16", "Noidung16"),
            array("Tensach17", "Noidung17"),
            array("Tensach18", "Noidung18"),
            array("Tensach19", "Noidung19"),
            array("Tensach20", "Noidung20"),
            array("Tensach21", "Noidung21"),
            array("Tensach22", "Noidung22"),
            // ...
            array("Tensach100", "Noidung100")
        );

        // Xác định số bản ghi mỗi trang và trang hiện tại
        $records_per_page = 10;
        $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $total_records = count($books);
        $total_pages = ceil($total_records / $records_per_page);

        // Xác định chỉ mục bản ghi cần hiển thị
        $start_index = ($current_page - 1) * $records_per_page;
        $books_to_display = array_slice($books, $start_index, $records_per_page);

        // Hiển thị dữ liệu trong bảng
        foreach ($books_to_display as $index => $book) {
            echo "<tr>";
            echo "<td>" . ($start_index + $index + 1) . "</td>";
            echo "<td>" . htmlspecialchars($book[0]) . "</td>";
            echo "<td>" . htmlspecialchars($book[1]) . "</td>";
            echo "</tr>";
        }
        ?>
    </table>

    <div class="pagination">
        <?php
        // Hiển thị các nút phân trang
        if ($current_page > 1) {
            echo '<a href="?page=' . ($current_page - 1) . '">&laquo; Trang trước</a>';
        }
        for ($i = 1; $i <= $total_pages; $i++) {
            $class = ($i == $current_page) ? 'active' : '';
            echo '<a href="?page=' . $i . '" class="' . $class . '">' . $i . '</a>';
        }
        if ($current_page < $total_pages) {
            echo '<a href="?page=' . ($current_page + 1) . '">Trang sau &raquo;</a>';
        }
        ?>
    </div>
</body>

</html>