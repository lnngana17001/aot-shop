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
    $motaspmoi = $_POST['spMoTaNgan'];
    $chitietspmoi = $_POST['spMoTaChiTiet'];
    $ngaycapnhatspmoi = $_POST['spNgayCapNhat'];
    $soluongspmoi = $_POST['spSoLuong'];
    $tenloaisanpham = $_POST['lspTen'];
    $tennhasanxuat = $_POST['nsxTen'];
    $tenkhuyenmai = $_POST['kmTen'];

    if(!empty($tenspmoi) && !empty($giaspmoi) && !empty($motaspmoi) && !empty($chitietspmoi) 
    && !empty($ngaycapnhatspmoi) && !empty($soluongspmoi) && !empty($tenloaisanpham) && !empty($tennhasanxuat) && !empty($tenkhuyenmai))
    {
        // Câu lệnh INSERT
        $maloaisanpham = mysqli_query($conn, "SELECT lsp_ma FROM `loaisanpham` WHERE lsp_ten = '$tenloaisanpham';");
        $manhasanxuat = mysqli_query($conn, "SELECT nsx_ma FROM `nhasanxuat` WHERE nsx_ten = '$tennhasanxuat';");
        $makhuyenmai = mysqli_query($conn, "SELECT km_ma FROM `khuyenmai` WHERE km_ten = '$tenkhuyenmai';");
        $sql = <<<EOT
        INSERT INTO `sanpham` (`sp_ten`, `sp_gia`, `sp_mota_ngan`, `sp_mota_chitiet`, `sp_ngaycapnhat`, `sp_soluong`, `lsp_ma`, `nsx_ma`, `km_ma`) VALUES
	($tenspmoi, $giaspmoi, $motaspmoi, $chitietspmoi, $ngaycapnhatspmoi, $soluongspmoi, $maloaisanpham, $manhasanxuat, $makhuyenmai);
EOT;
        // Thực thi INSERT
        mysqli_query($conn, $sql);

        // Sau khi cập nhật dữ liệu, tự động điều hướng về trang Danh sách
        header('location:index.php');
    }
    else
    {
        echo '<script type="text/javascript">alert("Thông tin bạn vừa nhập có vẻ có sai sót, mời nhập lại.");</script>';

    } 
    
}



// Đóng kết nối
CloseCon($conn);
echo $twig->render('/trangAdmin/layouts/sanPham/them.html.twig', ['danhsachtenloaisanpham' => $dsten_lsp],
 ['danhsachtennhasanxuat' => $dsten_nsx], ['danhsachtenkhuyenmai' => $dsten_km]);