<?php
require __DIR__.'/parts/__connect_db.php';

$output = [
    'success' => false,
    'code' => 0,
    'error' => '',
    'rowCount' => 0,
];


$name = $_POST['name'] ?? '';
$qcontent = $_POST['qcontent'] ?? '';
$acontent1 = $_POST['acontent1'] ?? '';
$acontent2 = $_POST['acontent2'] ?? '';
$acontent3 = $_POST['acontent3'] ?? '';
$acontent4 = $_POST['acontent4'] ?? '';

if(empty($name)){
    $output['code'] = 403;
    $output['error'] = '請輸入正確的動物名稱';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

$sql_1="INSERT INTO `question`(`name`, `qcontent`) VALUES (?,?)";
$stmt = $pdo->prepare($sql_1);
$stmt->execute([
    $name,
    $qcontent,
]);
$t = $pdo -> lastInsertId();
$sql_2 ="INSERT INTO `answer`(`acontent`, `yesno`, `question_sid`) VALUES (?,'right',?)";
$stmt2 = $pdo->prepare($sql_2);
$stmt2 -> execute([
    $acontent1,
    $t,
 ]);
$sql_3 ="INSERT INTO `answer`(`acontent`, `yesno`, `question_sid`) VALUES (?,'wrong',?)";
$stmt3 = $pdo->prepare($sql_3);
$stmt3 -> execute([
    $acontent2,
    $t,
]);
$sql_4 ="INSERT INTO `answer`(`acontent`, `yesno`, `question_sid`) VALUES (?,'wrong',?)";
$stmt4 = $pdo->prepare($sql_4);
$stmt4 -> execute([
    $acontent3,
    $t,
]);
$sql_5 ="INSERT INTO `answer`(`acontent`, `yesno`, `question_sid`) VALUES (?,'wrong',?)";
$stmt5 = $pdo->prepare($sql_5);
$stmt5 -> execute([
    $acontent4,
    $t,
]);



// if(empty($mobile) or !preg_match("/^09\d{2}-?\d{3}-?\d{3}$/", $mobile)){
//     $output['code'] = 405;
//     $output['error'] = '請輸入正確的手機號碼';
//     echo json_encode($output, JSON_UNESCAPED_UNICODE);
//     exit;
// }

$output['success'] = $stmt->rowCount()==1;
$output['rowCount'] = $stmt->rowCount();
echo json_encode($output, JSON_UNESCAPED_UNICODE);