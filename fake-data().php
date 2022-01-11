<?php

require __DIR__ . '/parts/__connect_db.php';

$sql = "INSERT INTO `product_item` (`sid`, `name`, `type`, `specification`, `information`, `supplier`, `price`, `picture`, `create_at`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, now())";




//要塞值的地方習慣要塞問號,對應欄位,一個對一個

$pdo->beginTransaction();
//會更快,過萬筆以上用這個會很迅速

$stmt = $pdo->prepare($sql);
for ($i = 11; $i < 70; $i++) {

    $stmt->execute([
        $i,
        'test'.$i,
        rand(1, 6),
        rand(1, 100),
        rand(1, 100),
        rand(1, 60),
        rand(50, 1500),
        '圖'.$i.'.jpg',
    ]);}


$pdo->commit();
echo 'ok';