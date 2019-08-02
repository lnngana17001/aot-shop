<?php
// Include file cấu hình ban đầu của `Twig`
require_once __DIR__.'/../../bootstrap.php';

// Truy vấn database để lấy danh sách
// 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn
include_once('../../dbconnect.php');
include_once('../../model/KhuyenMai.php');
$conn = OpenCon();

// lấy mã km
$kmMa = $_GET['kmMa'];

// query CSDL tạo object để truyền vào template hiển thị
$sqlQuery = <<<EOT
    SELECT * FROM `khuyenmai` where `km_ma` = $kmMa;
EOT;
$result = mysqli_query($conn, $sqlQuery);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
{
    $object = new KhuyenMai($row['km_ma'], $row['km_ten'], $row['km_noidung'], $row['km_tungay'], $row['km_denngay']);
}


if(isset($_POST['btnCapNhat'])) 
{
    // Lấy dữ liệu người dùng hiệu chỉnh gởi từ REQUEST POST
    $kmTenMoi = $_POST['km_ten'];
    $kmNoiDungMoi = $_POST['km_noidung'];
    $kmTuNgayMoi = $_POST['km_tungay'];
    $kmDenNgayMoi = $_POST['km_denngay'];

    //Chuẩn bị câu update $sql
$sqlQuery2 = <<<EOT
UPDATE `khuyenmai` SET km_ten='$kmTenMoi', km_noidung='$kmNoiDungMoi', km_tungay='$kmTuNgayMoi', km_denngay='$kmDenNgayMoi' WHERE km_ma=$kmMa;
EOT;

    // Thực thi INSERT
    mysqli_query($conn, $sqlQuery2);

    // Đóng kết nối
    CloseCon($conn);

    // Sau khi cập nhật dữ liệu, tự động điều hướng về trang Danh sách
    header('location:index.php');
}

echo $twig->render('/trangAdmin/layouts/khuyenMai/sua.html.twig', ['khuyenmaicancapnhat' => $object]);