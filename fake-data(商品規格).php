<?php

require __DIR__ . '/parts/__connect_db.php';


<<<<<<< HEAD
$sql = "INSERT INTO `product_item` (`sid`, `name`, `type`, `specification`, `information`, `supplier`, `price`, `picture`, `create_at`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, now())";


=======
$sql = "INSERT INTO `庫存表`(`庫存類別`, `倉庫數量`,`現場數量`,`現場位置`,`更新時間`) VALUES (?, ?, ?, ?, ?,)";
>>>>>>> bfc8588b86f35f2e6cc3c9c66212085a954069f1

//要塞值的地方習慣要塞問號,對應欄位,一個對一個

$pdo->beginTransaction();
//會更快,過萬筆以上用這個會很迅速

$stmt = $pdo->prepare($sql);
<<<<<<< HEAD
for ($i = 3; $i < 60; $i++) {

    $stmt->execute([
        $i,
        'test'.$i,
        rand(1, 6),
        rand(1, 100),
        rand(1, 100),
        rand(1, 60),
        rand(50, 1500),
        null,
=======
for ($i = 0; $i < 1000; $i++) {

    $stmt->execute([
        rand(1, 3),
        rand(10, 999),
        rand(10, 999),
        rand(10, 999),
        '2001-12-29'
>>>>>>> bfc8588b86f35f2e6cc3c9c66212085a954069f1
    ]);
}

$pdo->commit();
echo 'ok';
