<?php
// Load các thư viện (packages) do Composer quản lý vào chương trình
require_once __DIR__.'/vendor/autoload.php';

// Chỉ định thư mục `templates` (nơi Twig sẽ biên dịch cú pháp Twig thành các đoạn code PHP)
$loader = new Twig_Loader_Filesystem(__DIR__.'/templates');

 // Khởi tạo Twig
$twig = new Twig_Environment($loader);

$twig->addFilter( new Twig_SimpleFilter('cast_to_array', function ($stdClassObject) {
    $response = array();
    foreach ($stdClassObject as $key => $value) {
        $response[] = array($key, $value);
    }
    return $response;
}));