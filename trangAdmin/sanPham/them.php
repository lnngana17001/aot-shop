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

// Thêm sản phẩm mới khi bấm nút thêm
if(isset($_POST['btnThem'])) 
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
        
$sql = <<<EOT
INSERT INTO `sanpham` (`sp_ten`, `sp_gia`, `sp_mota_ngan`, `sp_mota_chitiet`, `sp_ngaycapnhat`, `sp_soluong`, `lsp_ma`, `nsx_ma`, `km_ma`)
VALUES('$tenspmoi', $giaspmoi, '$motaspmoi', '$chitietspmoi', '$ngaycapnhatspmoi', $soluongspmoi, '$maloaisanpham', '$manhasanxuat', '$makhuyenmai');
EOT;

        // Thực thi INSERT
        mysqli_query($conn, $sql);

        // Sau khi cập nhật dữ liệu, tự động điều hướng về trang Danh sách
        header('location:index.php'); 
    
}



// Đóng kết nối
CloseCon($conn);
echo $twig->render('/trangAdmin/layouts/sanPham/them.html.twig', ['danhsachtenloaisanpham' => $dsten_lsp, 'danhsachtennhasanxuat' => $dsten_nsx, 'danhsachtenkhuyenmai' => $dsten_km]);