<?php
// Include file cấu hình ban đầu của `Twig`
require_once __DIR__.'/../../bootstrap.php';

// Truy vấn database để lấy danh sách
// 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn
include_once('../../dbconnect.php');
include_once('../../model/HinhThucThanhToan.php');
$conn = OpenCon();

// lấy mã httt
$htttMa = $_GET['htttMa'];

// 2. Chuẩn bị câu xóa $sql
$sqlQuery = <<<EOT
    DELETE FROM `hinhthucthanhtoan` WHERE `httt_ma` = $htttMa;
EOT;

// 3. Thực thi câu lệnh DELETE
$result = mysqli_query($conn, $sqlQuery);

// 4. Đóng kết nối
CloseCon($conn);
    
// Sau khi cập nhật dữ liệu, tự động điều hướng về trang Danh sách
header('location:index.php');

