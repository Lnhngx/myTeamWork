<?php
require __DIR__ . '/parts/__connect_db.php';


if(isset($_GET['sid'])){
    $sid=intval($_GET['sid']);
    $pdo->query("DELETE FROM `animal_touch` WHERE sid=$sid");
}

$come_from = $_SERVER['HTTP_REFERER'] ?? 'terry_animal_touch.php';

header("Location: $come_from");
