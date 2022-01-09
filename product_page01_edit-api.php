<?php

require __DIR__ . '/parts/__connect_db.php';


$output = [
    'success' => false,
    'error' => '',
];


$sid = isset($_POST['sid']) ? intval($_POST['sid']) : 0;
if (empty($sid)) {
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
$pictures = $_FILES['myfiles']['name'];
$pictureName = implode(",", $pictures);



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
    $pictureName,
    $ddate,
    $sid
]);

if (empty($pictureName)) {
    $output['code'] = 999;
    $output['error'] = '請選擇商品圖片';
    echo json_encode($output,JSON_UNESCAPED_UNICODE);
    exit;
}

if ($stmt->rowCount() == 0) {
    $output['error'] = '資料沒有修改';
} else {
    $output['success'] = true;
}

// $output['success'] = $stmt->rowCount() == 1;
// $output['rowCount'] = $stmt->rowCount();
//rowCount是函式

echo json_encode($output, JSON_UNESCAPED_UNICODE);
