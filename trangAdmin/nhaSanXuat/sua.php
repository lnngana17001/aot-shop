<?php
// Include file cấu hình ban đầu của `Twig`
require_once __DIR__.'/../../bootstrap.php';

// Truy vấn database để lấy danh sách
// 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn
include_once('../../dbconnect.php');
include_once('../../model/NhaSanXuat.php');
$conn = OpenCon();

// lấy mã nsx
$nsxMa = $_GET['nsxMa'];

// query CSDL tạo object để truyền vào template hiển thị
$sqlQuery = <<<EOT
    SELECT * FROM `nhasanxuat` where `nsx_ma` = $nsxMa;
EOT;
$result = mysqli_query($conn, $sqlQuery);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
{
    $object = new NhaSanXuat($row['nsx_ma'], $row['nsx_ten']);
}


if(isset($_POST['btnCapNhat'])) 
{
    // Lấy dữ liệu người dùng hiệu chỉnh gởi từ REQUEST POST
    $nsxTenMoi = $_POST['nsx_ten'];
    preg_replace('([\s]+)', ' ', $nsxTenMoi);

    //Chuẩn bị câu update $sql
    $sqlQuery2 = "UPDATE `nhasanxuat` SET nsx_ten='$nsxTenMoi' WHERE nsx_ma=$nsxMa;";

    // Thực thi INSERT
    mysqli_query($conn, $sqlQuery2);

    // Đóng kết nối
    CloseCon($conn);

    // Sau khi cập nhật dữ liệu, tự động điều hướng về trang Danh sách
    header('location:index.php');
}

echo $twig->render('/trangAdmin/layouts/nhaSanXuat/sua.html.twig', ['nhasanxuatcancapnhat' => $object]);