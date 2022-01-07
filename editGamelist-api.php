<?php
require __DIR__. '/parts/__connect_db.php';

$output = [
    'success' => false,
    'code' => 0,
    'error' => '',
];
$sid = isset($_POST['question_sid']) ? intval($_POST['question_sid']) : 0;
if(empty($sid)){
    $output['code'] = 400;
    $output['error'] = '沒有這個題目sid';
    echo json_encode($output,JSON_UNESCAPED_UNICODE);
    exit;
}

$sql = "SELECT `answer`.`sid`,`acontent`FROM `question` JOIN `answer` ON `question`.`sid`=`question_sid` WHERE `question`.`sid`= $sid ";
$rows = $pdo -> query($sql) -> fetchAll();



$name = $_POST['name'];
$qcontent = $_POST['qcontent'];
$acontent1 = $_POST['acontent1'];
$acontent2 = $_POST['acontent2'];
$acontent3 = $_POST['acontent3'];
$acontent4 = $_POST['acontent4'];


if(empty($name)){
    $output['code'] = 403;
    $output['error'] = '請輸入正確的動物名稱';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

$sql_1="UPDATE `question` SET 
                        `name` = ?,
                        `qcontent` = ?
                WHERE `sid`= ? ";

$stmt = $pdo->prepare($sql_1);
$stmt->execute([
    $name,
    $qcontent,
    $sid,
]);
$sql_2 ="UPDATE `answer` SET 
                    `acontent`= ?
                WHERE `sid` = ?";
$stmt2 = $pdo->prepare($sql_2);
$stmt2 -> execute([
    $acontent1,
    $rows[0]['sid'],
 ]);
$sql_3 ="UPDATE `answer` SET 
                    `acontent`= ?
                WHERE `sid` = ? ";
$stmt3 = $pdo->prepare($sql_3);
$stmt3 -> execute([
    $acontent2,
    $rows[1]['sid'],
 ]);
$sql_4 ="UPDATE `answer` SET 
                    `acontent`= ?
                WHERE `sid` = ? ";
$stmt4 = $pdo->prepare($sql_4);
$stmt4 -> execute([
    $acontent3,
    $rows[2]['sid'],
]);
$sql_5 ="UPDATE `answer` SET 
                    `acontent`= ?
                WHERE `sid` = ? ";
$stmt5 = $pdo->prepare($sql_5);
$stmt5 -> execute([
    $acontent4,
    $rows[3]['sid'],
 ]);

if($stmt -> rowCount() ==0 && $stmt2 -> rowCount() ==0 && $stmt3 -> rowCount() ==0 && $stmt4 -> rowCount() ==0 && $stmt5 -> rowCount() ==0){
    $output['code'] = 450;
    $output['error'] = "資料尚未修改到";
}else{
    $output['success'] = true;
}
$output['rowCount'] = $stmt->rowCount();
echo json_encode($output, JSON_UNESCAPED_UNICODE);

?>

