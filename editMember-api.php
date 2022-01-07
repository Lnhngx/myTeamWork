<?php
require __DIR__.'/parts/__connect_db.php';

$output = [
    'success' => false,
    'code' => 0,
    'error' => '',
];

// TODO:沒有登入...

$sid = isset($_POST['sid']) ? intval($_POST['sid']) : 0;
if(empty($sid)){
    $output['code'] = 400;
    $output['error'] = '沒有此會員';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$mobile = $_POST['mobile'] ?? '';
$password = $_POST['password'] ?? '';

if(empty($name)){
    $output['code'] = 403;
    $output['error'] = '請輸入正確的姓名';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}
if(empty($email) or !filter_var($email, FILTER_VALIDATE_EMAIL)){
    $output['code'] = 401;
    $output['error'] = '請輸入正確的email';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}
if(empty($mobile) or !preg_match("/^09\d{2}-?\d{3}-?\d{3}$/", $mobile)){
    $output['code'] = 405;
    $output['error'] = '請輸入正確的手機號碼';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}
if(empty($password)){
    $output['code'] = 407;
    $output['error'] = '請輸入密碼';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
}


$sql = "UPDATE `members` SET
                     `email`=?,
                     `name`=?,
                     `password`=?,
                     `mobile`=?,
                     `birthday`=?,
                     `address`=? 
        WHERE `sid`=?";

$stmt = $pdo->prepare($sql);
$stmt->execute([
    $email,
    $name,
    $password,
    $mobile,
    empty($_POST['birthday']) ? NULL : $_POST['birthday'],
    $_POST['address'] ?? '',
    $sid
]);

if($stmt->rowCount()==0){
    $output['error'] = '資料沒有修改';
}else{
    $output['success'] = true;
}

echo json_encode($output, JSON_UNESCAPED_UNICODE);