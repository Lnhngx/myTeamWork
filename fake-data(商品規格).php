<?php

require __DIR__ . '/parts/__connect_db.php';


$sql = "INSERT INTO `商品訊息`(`商品名稱`, `商品類型`, `商品規格`, `供應商`, `庫存訊息`,`商品價格`,`商品圖片`,`更新時間`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

//要塞值的地方習慣要塞問號,對應欄位,一個對一個

$pdo->beginTransaction();
//會更快,過萬筆以上用這個會很迅速

$stmt = $pdo->prepare($sql);
for ($i = 0; $i < 20; $i++) {

    $stmt->execute([
        'test'.$i,
        rand(1, 6),
        rand(1000, 2000),
        rand(1, 60),
        rand(1, 60),
        rand(250, 700),
        rand(100000, 1640570263).'.jpg',
        date("Y-m-d", rand(100000, 1640570263)),
    ]);
}



$pdo->commit();
echo 'ok';
