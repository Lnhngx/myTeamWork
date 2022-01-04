<?php

require __DIR__ . '/parts/__connect_db.php';


$output = [
    'success' => false,
    'code' => 0,
    'error' => '',
];


$name = $_POST['商品名稱'] ?? '';
$type = $_POST['商品規格'] ?? '';
$format = $_POST['庫存訊息'] ?? '';


if (empty($name)) {
    $output['code'] = 401;
    $output['error'] = '請輸入商品資訊';
    echo json_encode($output,JSON_UNESCAPED_UNICODE);
    exit;
}

if (empty($type)) {
    $output['code'] = 402;
    $output['error'] = '請輸入完整規格';
    echo json_encode($output,JSON_UNESCAPED_UNICODE);
    exit;
}

if (empty($format)) {
    $output['code'] = 403;
    $output['error'] = '請輸入正確的手機號碼';
    echo json_encode($output,JSON_UNESCAPED_UNICODE);
    exit;
}

$sql = "INSERT INTO `商品訊息`(
    `商品名稱`, `商品類型`, `商品規格`, `供應商`, `庫存訊息`, `商品價格`
    ) VALUES (?, ?, ?, ?, ?, ? )";

    //要塞值的地方習慣要塞問號,對應欄位,一個對一個

$stmt = $pdo->prepare($sql);


$stmt->execute([
    $name,
    $type,
    $format,
    empty($_POST['birthday']) ? NULL : $_POST['birthday'],
    $_POST['address'] ?? '',
]);

$output['success'] = $stmt->rowCount() == 1;
$output['rowCount'] = $stmt->rowCount();

echo json_encode($output);
//檢查工具的console->設定裡的preserve log,兩個都要勾


//POSTMAN,GET不會送HTTP的BODY,記得調成POST
//form-data or urlencoded
//上傳檔案用前者,單傳資料後者就可以