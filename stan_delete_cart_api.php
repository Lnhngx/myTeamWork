<?php
require __DIR__ . '/parts/__connect_db.php';


if(isset($_GET['product_sid'])){
    $sid=intval($_GET['product_sid']);
    $pdo->query("DELETE FROM `temp_cart` WHERE product_sid=$sid");
}

$come_from = $_SERVER['HTTP_REFERER'] ?? 'cart.php';

header("Location: $come_from");
