<?php
require __DIR__. '/parts/__connect_db.php';

$output = [
    'success' => false,
    'code' => 0,
    'error' => '',
];

// 沒有登入管理帳號,就轉向
// if(! isset($_SESSION['admin'])){
//     $output['error'] = '請登入管理帳號';
//     echo json_encode($output, JSON_UNESCAPED_UNICODE);
//     exit;
// }

$sid = isset($_POST['sid']) ? intval($_POST['sid']) : 0;
if(empty($sid)) {
    $output['code'] = 400;
    $output['error'] = '沒有 sid';
    echo json_encode($output, JSON_UNESCAPED_UNICODE); exit;
}

$name = $_POST['name'] ?? '';
$English_name = $_POST['English_name'] ?? '';
$species = $_POST['species'] ?? '';
$origin = $_POST['origin'] ?? '';
$sbirthday = $_POST['birthday'] ?? '';
$remark = $_POST['remark'] ?? '';

//<!--     `sid`, `name`, `English_name`, `species`, `	origin`, `birthday`, `remark` -->
// TODO: 檢查欄位資料
if(empty($name)) {
    $output['code'] = 401;
    $output['error'] = '請輸入正確的姓名';
    echo json_encode($output, JSON_UNESCAPED_UNICODE); exit;
}
if(empty($English_name)) {
    $output['code'] = 401;
    $output['error'] = '請輸入正確的學名';
    echo json_encode($output, JSON_UNESCAPED_UNICODE); exit;
}
if(empty($species)) {
    $output['code'] = 401;
    $output['error'] = '請輸入正確的種類';
    echo json_encode($output, JSON_UNESCAPED_UNICODE); exit;
}
if(empty($origin)) {
    $output['code'] = 401;
    $output['error'] = '請輸入正確的產地';
    echo json_encode($output, JSON_UNESCAPED_UNICODE); exit;
}
// if(empty($birthday)) {
//     $output['code'] = 401;
//     $output['error'] = '請輸入正確的生日';
//     echo json_encode($output, JSON_UNESCAPED_UNICODE); exit;
// }
if(empty($remark)) {
    $output['code'] = 401;
    $output['error'] = '請輸入正確的備註';
    echo json_encode($output, JSON_UNESCAPED_UNICODE); exit;
}
// if(empty($English_name) or !filter_var($English_name, FILTER_VALIDATE_EMAIL)) {
//     $output['code'] = 405;
//     $output['error'] = '請輸入正確的English_name';
//     echo json_encode($output, JSON_UNESCAPED_UNICODE); exit;
// }
// if(empty($speciese) or !preg_match("/^09\d{2}-?\d{3}-?\d{3}$/", $species)) {
//     $output['code'] = 407;
//     $output['error'] = '請輸入正確的species';
//     echo json_encode($output, JSON_UNESCAPED_UNICODE); exit;
//}




$sql = "UPDATE `address_1` SET 
                          `name`=?,
                          `English_name`=?,
                          `species`=?,
                          `origin`=?,
                          `birthday`=?,
                          `remark`=?
WHERE `sid`=?";
//<!--     `sid`, `name`, `English_name`, `species`, `	origin`, `birthday`, `remark` -->
$stmt = $pdo->prepare($sql);

$stmt->execute([
    $name,
    $English_name,
    $species,
    $origin,
    empty($_POST['birthday']) ? NULL : $_POST['birthday'],
    $_POST['remark'] ?? '',
    $sid
]);

if($stmt->rowCount()==0){
    $output['error'] = '資料沒有修改';
} else {
    $output['success'] = true;
}

echo json_encode($output, JSON_UNESCAPED_UNICODE);




