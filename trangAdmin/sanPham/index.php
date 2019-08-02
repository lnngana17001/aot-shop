<?php
// Include file cấu hình ban đầu của `Twig`
require_once __DIR__.'/../../bootstrap.php';

// Truy vấn database để lấy danh sách
// 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn
include_once('../../dbconnect.php');
include_once('../../model/SanPham.php');
$conn = OpenCon();

// 2. Chuẩn bị câu truy vấn $sql
$sqlQuery = <<<EOT
select sp_ma, sp_ten, sp_gia, sp_mota_ngan, sp_mota_chitiet, sp_ngaycapnhat, sp_soluong, lsp.lsp_ten, nsx.nsx_ten, km.km_ten
from sanpham as sp 
join aotshop.loaisanpham as lsp on sp.lsp_ma = lsp.lsp_ma
join aotshop.nhasanxuat as nsx on sp.nsx_ma = nsx.nsx_ma
join aotshop.khuyenmai as km on sp.km_ma = km.km_ma
EOT;


// 3. Thực thi câu truy vấn SQL để lấy về dữ liệu
$result = mysqli_query($conn, $sqlQuery);

// 4. Khi thực thi các truy vấn dạng SELECT, dữ liệu lấy về cần phải phân tích để sử dụng
// Thông thường, chúng ta sẽ sử dụng vòng lặp while để duyệt danh sách các dòng dữ liệu được SELECT
// Ta sẽ tạo 1 mảng array để chứa các dữ liệu được trả về
$datas = [];
$count = 0;
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
{
    $object = new SanPham($row['sp_ma'], $row['sp_ten'], $row['sp_gia'],$row['sp_mota_ngan'], $row['sp_mota_chitiet'], $row['sp_ngaycapnhat'],$row['sp_soluong'], $row['lsp_ten'], $row['nsx_ten'], $row['km_ten']);
    array_push($datas, $object);
    $count++;
}

// foreach($datas as $dataKey => $dataValue) {
//     echo $dataValue->lspMa . " " . $dataValue->lspTen . " " . $dataValue->lspMoTa . "<br/>";
// }
CloseCon($conn);

// Yêu cầu `Twig` vẽ giao diện được viết trong file `backend/loaisanpham/loaisanpham.html.twig`

echo $twig->render('/trangAdmin/layouts/sanPham/index.html.twig',  ['ds_sanpham' => $datas]);