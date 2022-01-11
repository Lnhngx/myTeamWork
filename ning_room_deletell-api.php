<?php
require __DIR__ . '/parts/__connect_db.php';


// 沒有登入就轉向
$output = [
    'success' => false,
    'error' => '',
];

foreach ($_POST['checkbox'] as $v) {
    $pdo->query("DELETE FROM `room-detail` WHERE sid=$v");
}

$output['success'] = true;
echo json_encode($output, JSON_UNESCAPED_UNICODE);
?>