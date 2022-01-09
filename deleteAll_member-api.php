<?php
require __DIR__.'/parts/__connect_db.php';

// TODO:沒有登入的話...


foreach($_POST['checkbox'] as $v){
    $pdo->query("DELETE FROM `members` WHERE sid=$v");
}

$come_from = $_SERVER['HTTP_REFERER'] ?? 'memberList.php';

header("Location: $come_from");