<?php require __DIR__ . '/parts/__connect_db.php' ;

$output = [
    'success' => false,
    'code' => 0,
    'error' => '',
];

$introduction = $_POST['room-introduction'] ?? '';
$check_in_data = $_POST['check-in-data'] ?? '';
$check_out_data = $_POST['check-out-data'] ?? '';


if(empty($introduction)){
    $output['code']= 401;
    $output['error']= '請輸入正確的資訊';
    echo json_encode($output);exit;
}

if(empty($check_in_data)){
    $output['code']= 402;
    $output['error']= '請輸入正確的入住日期';
    echo json_encode($output);exit;
}

if(empty($check_out_data)){
    $output['code']= 403;
    $output['error']= '請輸入正確的退房日期';
    echo json_encode($output);exit;
}

// TODO:檢查欄位資料
// 錯誤的做法
$sql = "INSERT INTO `room-detail`(`room-name`, `room-image`,`room-introduction`, `people`, `price`,`check-in-data`, `check-out-data`, `check-in-status`) VALUES (?,?,?,?,?,?,?,?)";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    $_POST['room-name'] ?? '',
    $_POST['room-image'] ?? '',
    $introduction,
    $_POST['people'] ?? '',
    $_POST['price'] ?? '',
    $check_in_data,
    $check_out_data,
    $_POST['check-in-status'] ?? '',


]);
// $_POST['room-name'] ?? '',
// $_POST['room-image'] ?? '',
// $_POST['room-introduction'] ?? '',
// $_POST['people'] ?? '',
// $_POST['price'] ?? '',
// $_POST['check-in-data'] ?? '',
// $_POST['check-out-data'] ?? '',
// $_POST['check-in-status'] ?? '',

// $stmt = $pdo->query($sql);

$output['success'] = $stmt->rowCount()==1;
$output['rowCount'] = $stmt->rowCount();

echo json_encode($output,JSON_UNESCAPED_UNICODE);