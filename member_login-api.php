<?php
require __DIR__. '/parts/__connect_db.php';
$output = [
    'success' => false,
    // 'code' => '',
    'error' => '帳號或密碼錯誤',
];

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if (empty($email) or empty($password)) {
    $output['error'] = '欄位資料不足';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}
// 如果沒有填寫資料
            
$sql = sprintf( "SELECT * FROM `users` WHERE `email`=%s", $pdo->quote($email) );
$row = $pdo->query($sql)->fetch();
if (empty($row)) {
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}
// 如果不是users
	

if ( $password==$row['password'] ) {
    $output['success'] = true;
    $output['error'] = '';
    $_SESSION['users'] = [
        'email' => $row['email'],
        'nickname' => $row['nickname'],
    ];
}
// 如果有此筆會員資料就存入$_SESSION並設定變數為users

echo json_encode($output, JSON_UNESCAPED_UNICODE);
