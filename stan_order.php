<?php
require __DIR__ . '/parts/__connect_db.php';

$addcartKeys = array_keys($_SESSION['cart']);
// 抓購物車的產品SID

$rows = [];
$data_ar = []; // dict
$total = 0;

// 有登入才能結帳
if (!isset($_SESSION['users'])) {
    header('Location: stan_temp_product.php');
    exit;
}

if (!empty($addcartKeys)) {
    $sql = sprintf("SELECT * FROM product_item  
        where sid IN(%s)", implode(',', $addcartKeys));
    $rows = $pdo->query($sql)->fetchAll();

    foreach ($rows as $r) {
        $r['quantity'] = $_SESSION['cart'][$r['sid']];
        $data_ar[$r['sid']] = $r;
        $total += $r['quantity'] * $r['price'];
    }
} else {
    header('Location: stan_temp_product.php');
    exit;
}

$users_email =$_SESSION['users']['email'];
$users_sid = $pdo->query("SELECT `sid` FROM `users` WHERE  email= '$users_email' ")->fetch();

$o_sql = "INSERT INTO `orders`(`users_sid`, `amount`, `order_date`) VALUES (?, ?, NOW())";
$o_stmt = $pdo->prepare($o_sql);
$o_stmt->execute([
    $users_sid['sid'],
    $total,
]);

$order_sid = $pdo->lastInsertId(); // 最近新增資料的 PK

$od_sql = "INSERT INTO `order_details_products`(`order_sid`, `product_sid`, `product_price`, `product_quantity`) VALUES (?, ?, ?, ?)";
$od_stmt = $pdo->prepare($od_sql);

foreach ($_SESSION['cart'] as $sid => $qty) {
    $od_stmt->execute([
        $order_sid,
        $sid,
        $data_ar[$sid]['price'],
        $qty,
    ]);
}
unset($_SESSION['cart']); // 清除購物車內容
?>
<?php include __DIR__ . '/parts/__html_head.php' ?>
<?php include __DIR__ . '/parts/__sidebar.php' ?>
<style>
    .wrap {
        width: calc(100% - 250px);
        position: absolute;
        left: 250px;
        text-align: center;
    }

    .row {
        justify-content: space-between;
        padding: 0 20px;
    }

    .search,
    .insert,
    .editBtn,
    .orderBtn {
        background-color: #2f4f4f;
        color: white
    }

    .search:hover,
    .insert:hover,
    .editBtn:hover,
    .orderBtn:hover {
        color: white;
        background-color: #908a70;
    }

    .searchIp:focus {
        border: 1px solid #908a70;
        box-shadow: 0 0 5px 0 #908a70;
    }

    .editBtn,
    .delBtn,
    .orderBtn {
        color: white;
    }

    .orderBtn {
        right: 0;
    }

    .delBtn {
        background-color: #C82C2C;
    }

    .delBtn:hover {
        background-color: #9A572D;
        color: white;
    }

    .tables td,
    th {
        /* text-align: center; */
        vertical-align: middle;
    }


    #test {
        width: 20%;
        background-size: cover;
    }

    .smallimg {
        width: 100%;
    }

    .quantitybox {
        box-sizing: border-box;
        height: 35px;
        width: 60px;
        text-align: center;
    }
</style>
<div class="wrap">
    <div class="container my-3">
        <div class="row">
            <div class="col-3 d-flex" style="justify-content: flex-start;"></div>
            <div class="col-3 d-flex" style="justify-content: flex-end;">
            </div>
            <div class="bd-example my-5">
                <img src="./uploaded/stan.png" alt="">
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/parts/__scripts.php' ?>

<?php include __DIR__ . '/parts/__html_foot.php' ?>