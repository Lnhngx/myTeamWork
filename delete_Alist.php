<?php
require __DIR__. '/parts/__connect_db.php';

if(isset($_GET['question_sid'])){
    $sid = intval($_GET['question_sid']);
    $pdo -> query("DELETE FROM `question` WHERE sid=$sid");
    $pdo -> query("DELETE FROM `answer` WHERE question_sid=$sid");

}

$come_from = $_SERVER['HTTP_REFERER'] ?? 'game-Alist.php';

header("Location: $come_from");