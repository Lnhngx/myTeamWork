<?php
require __DIR__.'/parts/__connect_db.php';

if(! isset($_SESSION['users'])){
    header("Location: member_login.php");
    exit;
}
// 沒有登入就轉向

if(isset($_GET['sid'])){
    $sid = intval($_GET['sid']);
    $pdo->query("DELETE FROM `members` WHERE sid=$sid");
}


$come_from = $_SERVER['HTTP_REFERER'] ?? 'memberList.php';

header("Location: $come_from");