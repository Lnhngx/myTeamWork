<?php
require __DIR__. '/parts/__connect_db.php';

$output = [
    'success' => false,
    'code' => 0,
    'error' => '',
];
$sid = isset($_POST['question_sid']) ? intval($_POST['question_sid']) : 0;
echo json_encode($sid);
$sql = "SELECT `answer`.`sid`,`acontent`FROM `question` JOIN `answer` ON `question`.`sid`=`question_sid` WHERE `question`.`sid`= $sid ";
$rows = $pdo -> query($sql) -> fetchAll();

// echo json_encode($rows[0]['sid'],JSON_UNESCAPED_UNICODE); 測試用:

$name = $_POST['name'];
$qcontent = $_POST['qcontent'];
$acontent1 = $_POST['acontent1'];
$acontent2 = $_POST['acontent2'];
$acontent3 = $_POST['acontent3'];
$acontent4 = $_POST['acontent4'];
// if(empty($sid)){
//     $output['code'] = 487;
//     $output['error'] = '沒有這個題目';
//     echo json_encode($output,JSON_UNESCAPED_UNICODE);
//     exit;
// }

// if(empty($name)){
//     $output['code'] = 403;
//     $output['error'] = '請輸入正確的動物名稱';
//     echo json_encode($output, JSON_UNESCAPED_UNICODE);
//     exit;
// }

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
 echo json_encode($rows[0]['sid']);
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


$output['success'] = $stmt->rowCount()==1;
$output['rowCount'] = $stmt->rowCount();
echo json_encode($output, JSON_UNESCAPED_UNICODE);

?>

