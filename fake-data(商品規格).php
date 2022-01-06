<?php

require __DIR__ . '/parts/__connect_db.php';


$sql = "INSERT INTO `product_item`(`name`, `type`,`specification`,`information`,`supplier`,`price`,`picture` ,`create_at`) VALUES (?, ?, ?, ?, ?, ?, ?,NOW())";

//要塞值的地方習慣要塞問號,對應欄位,一個對一個

$pdo->beginTransaction();
//會更快,過萬筆以上用這個會很迅速

$stmt = $pdo->prepare($sql);
for ($i = 0; $i < 100; $i++) {

    $stmt->execute([
        'test'.$i,
        rand(10, 999),
        rand(10, 999),
        rand(10, 999),
        rand(10, 999),
        rand(10, 999),
        rand(10, 999),
    ]);
}

$pdo->commit();
echo 'ok';
