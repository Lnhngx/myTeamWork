<?php

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$cardItem_sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;
$cardItem_qty = isset($_GET['qty']) ? intval($_GET['qty']) : 0;

if(! empty($cardItem_sid)){
    // TODO: 判斷有沒有那個商品

    if(! empty($cardItem_qty)){
        // 用來新增及修改
        $_SESSION['cart'][$cardItem_sid] = $cardItem_qty;
    } else {
        // 若此商品在購物車數量為0，就從購物車中移除
        unset($_SESSION['cart'][$cardItem_sid]);
    }
}
header('Content-Type: application/json');
echo json_encode($_SESSION['cart']);
