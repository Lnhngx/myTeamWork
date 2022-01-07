<?php 
require __DIR__ . '/parts/__connect_db.php';

if(isset($_GET['sid'])){
$sid = intval($_GET['sid']);

$pdo -> query("DELETE FROM `room-detail` WHERE sid = $sid");

};

$come_from = $_SERVER['HTTP_REFERER'] ?? 'list.php';

header("Location: $come_from");