<?php

require __DIR__ . '/parts/__connect_db.php';


$output = [
    'success' => false,
    'code' => 0,
    'error' => '',
];


$sid = isset($_POST['sid']) ? intval($_POST['sid']) : 0;
if(empty($sid)) {
    $output['code'] = 400;
    $output['error'] = '沒有 sid';
    echo json_encode($output, JSON_UNESCAPED_UNICODE); exit;
}

$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$mobile = $_POST['mobile'] ?? '';

// TODO:檢查欄位資料
//有沒有定義成功
//輸出json格式

if (empty($name)) {
    $output['code'] = 401;
    $output['error'] = '請輸入正確姓名';

    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
    //exit,下面都不做
}


if (empty($email) or !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    //常數是過慮email
    $output['code'] = 405;
    $output['error'] = '請輸入正確email';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}
//code用意是走到哪裡哪裡出錯


if (empty($mobile) or !preg_match("/^09\d{2}-?\d{3}-?\d{3}$/", $mobile)) {
    $output['code'] = 407;
    $output['error'] = '請輸入正確的手機號碼';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}


$sql = "UPDATE `商品訊息` SET 
                          `name`=?,
                          `email`=?,
                          `mobile`=?,
                          `birthday`=?,
                          `address`=?
WHERE `sid`=?";

$stmt = $pdo->prepare($sql);


$stmt->execute([
    $name,
    $email,
    $mobile,
    empty($_POST['birthday']) ? NULL : $_POST['birthday'],
    $_POST['address'] ?? '',
    $sid
]);

//phpmysql要去結構那邊改成可以是空值
//如果birthday是沒填,給空值,有填就正常顯示



//$stmt = $pdo->query($sql);
//sql語法出錯這邊就錯
if($stmt->rowCount()==0){
    $output['error'] = '資料沒有修改';
} else {
    $output['success'] = true;
}

// $output['success'] = $stmt->rowCount() == 1;
// $output['rowCount'] = $stmt->rowCount();
//rowCount是函式

echo json_encode($output, JSON_UNESCAPED_UNICODE);
//檢查工具的console->設定裡的preserve log,兩個都要勾


//POSTMAN,GET不會送HTTP的BODY,記得調成POST
//form-data or urlencoded
//上傳檔案用前者,單傳資料後者就可以