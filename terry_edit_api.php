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

$sid = isset($_POST['sid']) ? intval($_POST['sid']) : 0;
if(empty($sid)) {
    $output['code'] = 400;
    $output['error'] = '沒有 sid';
    echo json_encode($output, JSON_UNESCAPED_UNICODE); exit;
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
    $output['error'] = '請輸入正確的活動名稱';
    echo json_encode($output, JSON_UNESCAPED_UNICODE); 
    exit;
}
if(empty($actTime_end)) {
    $output['code'] = 401;
    $output['error'] = '請輸入正確的活動名稱';
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




$sql = "UPDATE `animal_touch` SET 
                          `actName`=?,
                          `actTime_start`=?,
                          `actTime_end`=?,
                          `reserPeop`=?,
                          `introduce`=?,
                          `location`=?
WHERE `sid`=?";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    $actName,
    $actTime_start,
    $actTime_end,
    $reserPeop,
    $introduce,
    $location,
    $sid
]);

// 判斷新資料與原資料要無差別 差別? 1 : 0
if($stmt->rowCount()==0){
    $output['error'] = '資料沒有修改';
} else {
    $output['success'] = true;
}

echo json_encode($output, JSON_UNESCAPED_UNICODE);




