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

// query CSDL tạo object để truyền vào template hiển thị
$sqlQuery = <<<EOT
    SELECT * FROM `hinhthucthanhtoan` where `httt_ma` = $htttMa;
EOT;
$result = mysqli_query($conn, $sqlQuery);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
{
    $object = new HinhThucThanhToan($row['httt_ma'], $row['httt_ten']);
}


if(isset($_POST['btnCapNhat'])) 
{
    // Lấy dữ liệu người dùng hiệu chỉnh gởi từ REQUEST POST
    $htttTenMoi = $_POST['httt_ten'];
    preg_replace('([\s]+)', ' ', $htttTenMoi);

    //Chuẩn bị câu update $sql
    $sqlQuery2 = "UPDATE `hinhthucthanhtoan` SET httt_ten='$htttTenMoi' WHERE httt_ma=$htttMa;";

    // Thực thi INSERT
    mysqli_query($conn, $sqlQuery2);

    // Đóng kết nối
    CloseCon($conn);

    // Sau khi cập nhật dữ liệu, tự động điều hướng về trang Danh sách
    header('location:index.php');
}

echo $twig->render('/trangAdmin/layouts/hinhThucThanhtoan/sua.html.twig', ['hinhthucthanhtoancancapnhat' => $object]);