<?php

require __DIR__ . '/parts/__connect_db.php';


if(isset($_GET['sid'])){
    $sid = intval($_GET['sid']);
    $pdo->query("DELETE FROM `product_item` WHERE sid =$sid");
}

$come_from = $SERVER['HTTP_PEFERER']??'product_page01.php';

header("Location: $come_from");