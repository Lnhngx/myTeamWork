<?php
require __DIR__. '/parts/__connect_db.php';
foreach($_POST['checkbox'] as $value){
    $sid = $value;
    $pdo -> query("DELETE FROM `question` WHERE sid=$sid");
    $pdo -> query("DELETE FROM `answer` WHERE question_sid=$sid");
}

// $come_from = $_SERVER['HTTP_REFERER'] ?? 'gameList.php';
// header("Location: $come_from");

$output['success'] = true;
echo json_encode($output,JSON_UNESCAPED_UNICODE);
?>

