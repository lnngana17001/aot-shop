<?php
// Include file cấu hình ban đầu của `Twig`
require_once __DIR__.'/../../bootstrap.php';

// Truy vấn database để lấy danh sách
// 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn
include_once('../../dbconnect.php');
include_once('../../model/loaiSanPham.php');
$conn = OpenCon();

// lấy mã lsp
$lspMa = $_GET['lspMa'];

// query CSDL tạo object để truyền vào template hiển thị
$sqlQuery = <<<EOT
    SELECT * FROM `loaisanpham` where `lsp_ma` = $lspMa;
EOT;
$result = mysqli_query($conn, $sqlQuery);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
{
    $object = new loaiSanPham($row['lsp_ma'], $row['lsp_ten'], $row['lsp_mota']);
}


if(isset($_POST['btnCapNhat'])) 
{
    // Lấy dữ liệu người dùng hiệu chỉnh gởi từ REQUEST POST
    $lspTenMoi = $_POST['lsp_ten'];
    $lspMotaMoi = $_POST['lsp_mota'];
    preg_replace('([\s]+)', ' ', $lspTenMoi);
    preg_replace('([\s]+)', ' ', $lspMotaMoi);
    echo $lspMa . " " . $lspTenMoi . " " . $lspMotaMoi;

    //Chuẩn bị câu update $sql
    $sqlQuery2 = "UPDATE `loaisanpham` SET lsp_ten='$lspTenMoi', lsp_mota='$lspMotaMoi' WHERE lsp_ma=$lspMa;";

    // Thực thi INSERT
    mysqli_query($conn, $sqlQuery2);


    // Đóng kết nối
    CloseCon($conn);

    // Sau khi cập nhật dữ liệu, tự động điều hướng về trang Danh sách
    header('location:index.php');
}

echo $twig->render('/trangAdmin/layouts/loaiSanPham/sua.html.twig', ['loaisanphamcancapnhat' => $object]);