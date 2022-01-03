<?php

require __DIR__ . '/parts/__connect_db.php';


$sql = "INSERT INTO `商品規格`(`包裝長(cm)`, `包裝寬(cm)`, `包裝高(cm)`,`包裝重量(克)`
    ) VALUES (?, ?, ?, ?)";

//要塞值的地方習慣要塞問號,對應欄位,一個對一個

$pdo->beginTransaction();
//會更快,過萬筆以上用這個會很迅速

$stmt = $pdo->prepare($sql);
for ($i = 0; $i < 1000; $i++) {

    $stmt->execute([
        rand(1,99),
        rand(1,99),
        rand(1,99),
        rand(1,1000),
    ]);
}



$pdo->commit();
echo 'ok';
