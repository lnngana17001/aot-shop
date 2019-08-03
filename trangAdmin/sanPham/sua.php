<?php
// Include file cấu hình ban đầu của `Twig`
require_once __DIR__.'/../../bootstrap.php';

// Truy vấn database để lấy danh sách
// 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn
include_once('../../dbconnect.php');
include_once('../../model/SanPham.php');
$conn = OpenCon();

// truy vấn danh sách tên lsp
$result = mysqli_query($conn, "SELECT lsp_ten FROM `loaisanpham`");
$dsten_lsp = [];
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
{
    array_push($dsten_lsp, $row['lsp_ten']);
}

// truy vấn danh sách tên nsx
$result = mysqli_query($conn, "SELECT nsx_ten FROM `nhasanxuat`");
$dsten_nsx = [];
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
{
    array_push($dsten_nsx, $row['nsx_ten']);
}

// truy vấn danh sách tên km
$result = mysqli_query($conn, "SELECT km_ten FROM `khuyenmai`");
$dsten_km = [];
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
{
    array_push($dsten_km, $row['km_ten']);
}

// lấy mã spMa
$spMa = $_GET['spMa'];

// query CSDL tạo object để truyền vào template hiển thị
$sqlQuery = <<<EOT
select sp_ma, sp_ten, sp_gia, sp_mota_ngan, sp_mota_chitiet, sp_ngaycapnhat, sp_soluong, lsp.lsp_ten, nsx.nsx_ten, km.km_ten
from sanpham as sp 
join aotshop.loaisanpham as lsp on sp.lsp_ma = lsp.lsp_ma
join aotshop.nhasanxuat as nsx on sp.nsx_ma = nsx.nsx_ma
join aotshop.khuyenmai as km on sp.km_ma = km.km_ma
where sp.sp_ma = $spMa;
EOT;
$result = mysqli_query($conn, $sqlQuery);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
{
    $object = new SanPham($row['sp_ma'], $row['sp_ten'], $row['sp_gia'],$row['sp_mota_ngan'], $row['sp_mota_chitiet'], $row['sp_ngaycapnhat'],$row['sp_soluong'], $row['lsp_ten'], $row['nsx_ten'], $row['km_ten']);
}


if(isset($_POST['btnCapNhat'])) 
{
    // Lấy dữ liệu người dùng hiệu chỉnh gởi từ REQUEST POST
    $tenspmoi = $_POST['sp_ten'];
    $giaspmoi = $_POST['sp_gia'];
    $motaspmoi = $_POST['sp_motangan'];
    $chitietspmoi = $_POST['sp_motachitiet'];
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $ngaycapnhatspmoi = date('Y/m/d H:i:s');
    $soluongspmoi = $_POST['sp_soluong'];
    $tenloaisanpham = $_POST['lsp_ten'];
    $tennhasanxuat = $_POST['nsx_ten'];
    $tenkhuyenmai = $_POST['km_ten'];

    // Câu lệnh INSERT
    $result = mysqli_query($conn, "SELECT lsp_ma FROM `loaisanpham` WHERE lsp_ten = '$tenloaisanpham';");
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
    {
        $maloaisanpham = $row['lsp_ma'];
    }
    $result = mysqli_query($conn, "SELECT nsx_ma FROM `nhasanxuat` WHERE nsx_ten = '$tennhasanxuat';");
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
    {
        $manhasanxuat = $row['nsx_ma'];
    }
    $result = mysqli_query($conn, "SELECT km_ma FROM `khuyenmai` WHERE km_ten = '$tenkhuyenmai';");
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
    {
        $makhuyenmai = $row['km_ma'];
    }
    
$sqlQuery2 = <<<EOT
UPDATE `sanpham`
SET `sp_ten` = '$tenspmoi', `sp_gia` = $giaspmoi, `sp_mota_ngan` = '$motaspmoi'
, `sp_mota_chitiet` = '$chitietspmoi', `sp_ngaycapnhat` = '$ngaycapnhatspmoi', 
`sp_soluong` = $soluongspmoi, `lsp_ma` = $maloaisanpham, `nsx_ma` = $manhasanxuat,  `km_ma` = $makhuyenmai
WHERE sp_ma = $spMa;
EOT;

    // Thực thi INSERT
    mysqli_query($conn, $sqlQuery2);


    // Đóng kết nối
    CloseCon($conn);

    // Sau khi cập nhật dữ liệu, tự động điều hướng về trang Danh sách
    header('location:index.php');
}

echo $twig->render('/trangAdmin/layouts/sanPham/sua.html.twig', ['sanphamcancapnhat' => $object, 'danhsachtenloaisanpham' => $dsten_lsp, 'danhsachtennhasanxuat' => $dsten_nsx, 'danhsachtenkhuyenmai' => $dsten_km]);