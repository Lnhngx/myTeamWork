<?php
require __DIR__. '/parts/__connect_db.php';

$output = [
    'success' => false,
    'code' => 0,
    'error' => '',
];

// 沒有登入管理帳號,就轉向
if(! isset($_SESSION['admin'])){
    $output['error'] = '請登入管理帳號';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

$actName = $_POST['actName'] ?? '';
$actTime_start = $_POST['actTime_start'] ?? '';
$actTime_end = $_POST['actTime_end'] ?? '';
$reserPeop = $_POST['reserPeop'] ?? '';
$introduce = $_POST['introduce'] ?? '';
$location = $_POST['location'] ?? '';


// TODO: 檢查欄位資料
if(empty($actName)) {
    $output['code'] = 401;
    $output['error'] = '請輸入正確的活動名稱';
    echo json_encode($output, JSON_UNESCAPED_UNICODE); 
    exit;
}
if(empty($actTime_start)) {
    $output['code'] = 401;
    $output['error'] = '請輸入正確的開始時間';
    echo json_encode($output, JSON_UNESCAPED_UNICODE); 
    exit;
}
if(empty($actTime_end)) {
    $output['code'] = 401;
    $output['error'] = '請輸入正確的結束時間';
    echo json_encode($output, JSON_UNESCAPED_UNICODE); 
    exit;
}
if(empty($reserPeop)) {
    $output['code'] = 402;
    $output['error'] = '請輸入正確的預約人數';
    echo json_encode($output, JSON_UNESCAPED_UNICODE); 
    exit;
}
if(empty($introduce)) {
    $output['code'] = 403;
    $output['error'] = '請輸入正確的活動簡介';
    echo json_encode($output, JSON_UNESCAPED_UNICODE); 
    exit;
}
if(empty($location)) {
    $output['code'] = 404;
    $output['error'] = '請輸入正確的活動地點';
    echo json_encode($output, JSON_UNESCAPED_UNICODE); 
    exit;
}

$sql = "INSERT INTO `animal_touch`(`actName`, `actTime_start`, `actTime_end`, `reserPeop`, `introduce`, `location`) VALUES (?, ?, ?, ?, ?, ? )";


$stmt = $pdo->prepare($sql);

$stmt->execute([
    $actName,
    $actTime_start,
    $actTime_end,
    $reserPeop,
    $introduce,
    $location,
]);

$output['success'] = $stmt->rowCount() == 1;
$output['rowCount'] = $stmt->rowCount();

echo json_encode($output, JSON_UNESCAPED_UNICODE);




