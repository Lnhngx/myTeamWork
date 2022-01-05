<?php

require __DIR__ . '/parts/__connect_db.php';


$output = [
    'success' => false,
    'code' => 0,
    'error' => '',
];

$name = $_POST['name'] ?? '';
$type = $_POST['type'] ?? '';
$spec = $_POST['spec'] ?? '';
$supp = $_POST['supp'] ?? '';
$reser = $_POST['reser'] ?? '';
$money = $_POST['money'] ?? '';
$ddate= $_POST['d-date'] ?? '';


if (empty($name)) {
    $output['code'] = 999;
    $output['error'] = '請輸入商品名稱';
    echo json_encode($output,JSON_UNESCAPED_UNICODE);
    exit;
}



$sql = "INSERT INTO `商品訊息` (`商品名稱`, `商品類型`, `商品規格`, `供應商`, `庫存訊息`, `商品價格`, `商品圖片`, `更新時間`) VALUES (?, ?, ?, ?, ?, ?, ?, ?);";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    $_POST['name'] ?? '',
    $_POST['type'] ?? '',
    $_POST['spec'] ?? '',
    $_POST['supp'] ?? '',
    $_POST['reser'] ?? '',
    $_POST['money'] ?? '',
    null,
    $_POST['d-date'] ?? '',
]);

$output['success'] = $stmt->rowCount() == 1;
$output['rowCount'] = $stmt->rowCount();

echo json_encode($output);
//檢查工具的console->設定裡的preserve log,兩個都要勾


//POSTMAN,GET不會送HTTP的BODY,記得調成POST
//form-data or urlencoded
//上傳檔案用前者,單傳資料後者就可以