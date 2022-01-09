<?php

require __DIR__ . '/parts/__connect_db.php';


$output = [
    'success' => false,
    'code' => 0,
    'error' => '',
];

$name = $_POST['name'] ?? '';
$type = $_POST['type'] ?? '';
$spec = $_POST['spec'] ?? '';
$supp = $_POST['supp'] ?? '';
$reser = $_POST['reser'] ?? '';
$money = $_POST['money'] ?? '';
$ddate= $_POST['d-date'] ?? '';
$pictures = $_FILES['myfiles']['name'];
$pictureName = implode(",", $pictures);



if (empty($name)) {
    $output['code'] = 999;
    $output['error'] = '請輸入商品名稱';
    echo json_encode($output,JSON_UNESCAPED_UNICODE);
    exit;
}

if (empty($ddate)) {
    $output['code'] = 999;
    $output['error'] = '請輸入商品名稱';
    echo json_encode($output,JSON_UNESCAPED_UNICODE);
    exit;
}

if (empty($money)) {
    $output['code'] = 999;
    $output['error'] = '請輸入商品名稱';
    echo json_encode($output,JSON_UNESCAPED_UNICODE);
    exit;
}

if (empty($pictureName)) {
    $output['code'] = 999;
    $output['error'] = '請輸入商品名稱';
    echo json_encode($output,JSON_UNESCAPED_UNICODE);
    exit;
}



$sql = "INSERT INTO `product_item` (`name`, `type`, `specification`, `information`, `supplier`, `price`, `picture`, `create_at`) VALUES (?, ?, ?, ?, ?, ?, ?, ?);";


$stmt = $pdo->prepare($sql);

$stmt->execute([
    $_POST['name'] ?? '',
    $_POST['type'] ?? '',
    $_POST['spec'] ?? '',
    $_POST['reser'] ?? '',
    $_POST['supp'] ?? '',
    $_POST['money'] ?? '',
    $pictureName,
    $_POST['d-date'] ?? ''
]);


$output['success'] = $stmt->rowCount() == 1;
$output['rowCount'] = $stmt->rowCount();

echo json_encode($output);