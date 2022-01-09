<?php
require __DIR__ . '/parts/__connect_db.php';


$cardItem_sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;
unset($_SESSION['cart'][$cardItem_sid]);


$come_from = $_SERVER['HTTP_REFERER'] ?? 'stan_cart.php';

header("Location: $come_from");
