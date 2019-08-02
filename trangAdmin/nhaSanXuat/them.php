<?php
// Include file cấu hình ban đầu của `Twig`
require_once __DIR__.'/../../bootstrap.php';

// Truy vấn database để lấy danh sách
// 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn
include_once('../../dbconnect.php');
include_once('../../model/NhaSanXuat.php');
$conn = OpenCon();

// 2. Nếu người dùng có bấm nút Đăng ký thì thực thi câu lệnh UPDATE
if(isset($_POST['btnThem'])) 
{
    // Lấy dữ liệu người dùng hiệu chỉnh gởi từ REQUEST POST
    $tennsx = $_POST['nsx_ten'];

    if(!empty($tennsx))
    {
        // Câu lệnh INSERT
        $sql = "INSERT INTO `nhasanxuat` (nsx_ten) VALUES ('". $tennsx ."');";

        // Thực thi INSERT
        mysqli_query($conn, $sql);

        // Đóng kết nối
        CloseCon($conn);

        // Sau khi cập nhật dữ liệu, tự động điều hướng về trang Danh sách
        header('location:index.php');
    }
    else
    {
        echo '<script type="text/javascript">alert("Thông tin bạn vừa nhập có vẻ có sai sót, mời nhập lại.");</script>';

    } 
    
}
echo $twig->render('/trangAdmin/layouts/nhaSanXuat/them.html.twig');