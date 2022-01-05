<?php

require __DIR__ . '/parts/__connect_db.php';


$sql = "INSERT INTO `庫存表`(`庫存類別`, `倉庫數量`,`現場數量`,`現場位置`,`更新時間`) VALUES (?, ?, ?, ?, ?,)";

//要塞值的地方習慣要塞問號,對應欄位,一個對一個

$pdo->beginTransaction();
//會更快,過萬筆以上用這個會很迅速

$stmt = $pdo->prepare($sql);
for ($i = 0; $i < 1000; $i++) {

    $stmt->execute([
        rand(1, 3),
        rand(10, 999),
        rand(10, 999),
        rand(10, 999),
        '2001-12-29'
    ]);
}

$pdo->commit();
echo 'ok';
