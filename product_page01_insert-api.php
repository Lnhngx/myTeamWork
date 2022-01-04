<?php

require __DIR__ . '/parts/__connect_db.php';


$output = [
    'success' => false,
    'code' => 0,
    'error' => '',
];

$sql = "INSERT INTO `商品訊息`(
    `商品名稱`, `商品類型`, `商品規格`, `供應商`, `庫存訊息`, `商品價格`,`商品圖片`,`更新時間`
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ? )";

$stmt = $pdo->prepare($sql);


$stmt->execute([
    $_POST['商品名稱'] ?? '',
    $_POST['商品規格'] ?? '',
    $_POST['商品規格'] ?? '',
    $_POST['供應商'] ?? '',
    $_POST['庫存訊息'] ?? '',
    $_POST['商品價格'] ?? '',
    $_POST['商品圖片'] ?? '',
    $_POST['更新時間'] ?? '',
]);

$output['success'] = $stmt->rowCount() == 1;
$output['rowCount'] = $stmt->rowCount();

echo json_encode($output);
//檢查工具的console->設定裡的preserve log,兩個都要勾


//POSTMAN,GET不會送HTTP的BODY,記得調成POST
//form-data or urlencoded
//上傳檔案用前者,單傳資料後者就可以