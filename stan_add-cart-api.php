<?php
require __DIR__ . '/parts/__connect_db.php';

$output = [
    'success' => false,
    'code' => 0,
    'error' => '',
];

if (!isset($_SESSION)) {
    session_start();
}
// 偵測session是否開啟

if (!empty($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}


// $product_sid = isset($_GET['$product_sid']) ? intval($_GET['$product_sid']) : 0;
// $product_qty = isset($_GET['$product_qty']) ? intval($_GET['$product_qty']) : 0;

// $ticket_sid = isset($_GET['ticket_sid']) ? intval($_GET['ticket_sid']) : 0;
// $ticket_qty = isset($_GET['ticket_qty']) ? intval($_GET['ticket_qty']) : 0;

// $activity_sid = isset($_GET['$activity_sid']) ? intval($_GET['$activity_sid']) : 0;
// $activity_qty = isset($_GET['$activity_qty']) ? intval($_GET['$activity_qty']) : 0;

// $hotel_sid = isset($_GET['$hotel_sid']) ? intval($_GET['$hotel_sid']) : 0;
// $hotel_qty = isset($_GET['$hotel_qty']) ? intval($_GET['$hotel_qty']) : 0;
// $hotel_start = isset($_GET['$hotel_start']) ? intval($_GET['$hotel_start']) : 0;
// $hotel_end = isset($_GET['$hotel_end']) ? intval($_GET['$hotel_end']) : 0;



// if (!empty($product_sid)) {
//     if (!empty($product_qty)) {
//         $_SESSION['cart'][$product_sid] = $product_qty;
//         // 新增或修改
//     } else {
//         unset($_SESSION['cart'][$product_sid]);
//         // 移除
//     }
// }
// 產品

// if (!empty($ticket_sid)) {
//     if (!empty($ticket_qty)) {
//         $_SESSION['cart'][$ticket_sid] = $ticket_qty;
//     } else {
//         unset($_SESSION['cart'][$ticket_sid]);
//     }
// }
// // 門票

// if (!empty($activity_sid)) {
//     if (!empty($activity_qty)) {
//         $_SESSION['cart'][$activity_sid] = $activity_qty;
//     } else {
//         unset($_SESSION['cart'][$activity_sid]);
//     }
// }
// // 活動

// if (!empty($hotel_sid)) {
//     if (!empty($hotel_qty)) {
//         $_SESSION['cart'][$hotel_sid] = $hotel_qty;
//     } else {
//         unset($_SESSION['cart'][$hotel_sid]);
//     }
// }
// // 飯店



header('Content-Type: application/json');
json_encode($_SESSION['cart']);
