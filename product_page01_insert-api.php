<?php

require __DIR__ . '/parts/__connect_db.php';


$output = [
    'success' => false,
    'error1' => '',
    'error2' => '',
    'error3' => '',
    'error4' => '',
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



if (empty($name).empty($money).empty($ddate).empty($pictureName)) {
    $output['error1'] = '請輸入商品名稱';
    $output['error2'] = '請輸入商品金額';
    $output['error3'] = '請選擇更新日期';
    $output['error4'] = '請選擇商品圖片';
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