<?php
// Include file cấu hình ban đầu của `Twig`
require_once __DIR__.'/../../bootstrap.php';

// Truy vấn database để lấy danh sách
// 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn
include_once('../../dbconnect.php');
include_once('../../model/NhaSanXuat.php');
$conn = OpenCon();

// 2. Chuẩn bị câu truy vấn $sql
$sqlQuery = "select * from `nhasanxuat`";


// 3. Thực thi câu truy vấn SQL để lấy về dữ liệu
$result = mysqli_query($conn, $sqlQuery);

// 4. Khi thực thi các truy vấn dạng SELECT, dữ liệu lấy về cần phải phân tích để sử dụng
// Thông thường, chúng ta sẽ sử dụng vòng lặp while để duyệt danh sách các dòng dữ liệu được SELECT
// Ta sẽ tạo 1 mảng array để chứa các dữ liệu được trả về
$datas = [];
$count = 0;
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
{
    $object = new NhaSanXuat($row['nsx_ma'], $row['nsx_ten']);
    array_push($datas, $object);
    $count++;
}

// foreach($datas as $dataKey => $dataValue) {
//     echo $dataValue->lspMa . " " . $dataValue->lspTen . " " . $dataValue->lspMoTa . "<br/>";
// }
CloseCon($conn);

// Yêu cầu `Twig` vẽ giao diện được viết trong file `backend/loaisanpham/loaisanpham.html.twig`

echo $twig->render('/trangAdmin/layouts/nhasanxuat/index.html.twig',  ['ds_nhasanxuat' => $datas]);