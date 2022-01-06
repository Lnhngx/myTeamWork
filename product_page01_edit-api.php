<?php

require __DIR__ . '/parts/__connect_db.php';


$output = [
    'success' => false,
    'code' => 0,
    'error' => '',
];


$sid = isset($_POST['sid']) ? intval($_POST['sid']) : 0;
if (empty($sid)) {
    $output['code'] = 400;
    $output['error'] = '沒有 sid';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

$name = $_POST['name'] ?? '';
$type = $_POST['type'] ?? '';
$spec = $_POST['spec'] ?? '';
$supp = $_POST['supp'] ?? '';
$reser = $_POST['reser'] ?? '';
$money = $_POST['money'] ?? '';
$ddate = $_POST['d-date'] ?? '';
// $picture = isset($_FILES['myfiles']) ? $_FILES['myfiles'] : '';



$sql = "UPDATE `product_item` SET 
                          `name`=?,
                          `type`=?,
                          `specification`=?,
                          `information`=?,
                          `supplier`=?,
                          `price`=?,
                          `picture`=?,
                          `create_at`=?
WHERE `sid`=?";



$stmt = $pdo->prepare($sql);


$stmt->execute([
    $name,
    $type,
    $spec,
    $reser,
    $supp,
    $money,
    null,
    $ddate,
    $sid
]);



if ($stmt->rowCount() == 0) {
    $output['error'] = '資料沒有修改';
} else {
    $output['success'] = true;
}

// $output['success'] = $stmt->rowCount() == 1;
// $output['rowCount'] = $stmt->rowCount();
//rowCount是函式

echo json_encode($output, JSON_UNESCAPED_UNICODE);
