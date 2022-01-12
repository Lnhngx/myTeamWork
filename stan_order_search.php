<?php
require __DIR__ . '/parts/__connect_db.php';
$pageName = 'order_search';
$title = '訂單查詢';

$users_email = $_SESSION['users']['email'];
$users_sid = $pdo->query("SELECT `sid` FROM `users` WHERE  email= '$users_email' ")->fetch();
$u_sid = $users_sid['sid'];

// $days = $_GET['days'];

$o_rows = $pdo->query("SELECT * FROM `orders` WHERE users_sid= '$u_sid'")->fetchAll();

// AND order_date > DATE_SUB(CURDATE(), INTERVAL 89 DAY)

$days = isset($_GET['days']) ? $_GET['days'] : '364';

// $detaildays = isset($_GET['days']) ? "AND order_date > DATE_SUB(CURDATE(), INTERVAL '$days' DAY " : '';


// SELECT o.sid,order_date,amount,product_sid,name,product_price,product_quantity
// FROM `orders` AS o
// JOIN `order_details_products` AS odp
// JOIN `product_item` AS pitem
// ON o.sid= odp.order_sid AND odp.product_sid=pitem.sid
// WHERE o.users_sid='$u_sid' AND order_date > DATE_SUB(CURDATE(), INTERVAL 89 DAY)
// ORDER BY order_date DESC, product_sid ASC


$odp_rows = $pdo->query("SELECT o.sid,order_date,amount,product_sid,name,product_price,product_quantity
FROM `orders` AS o
JOIN `order_details_products` AS odp
JOIN `product_item` AS pitem
ON o.sid= odp.order_sid AND odp.product_sid=pitem.sid
WHERE o.users_sid='$u_sid' AND order_date > DATE_SUB(CURDATE(), INTERVAL '$days' DAY)
ORDER BY order_date DESC, product_sid ASC")->fetchAll();

$num = 0;
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
    .orderBtn,
    .dropdownBtn,
    .dropdetailBtn,
    .orderdetailBtn {
        background-color: #2f4f4f;
        color: white
    }

    .search:hover,
    .insert:hover,
    .editBtn:hover,
    .orderBtn:hover,
    .dropdownBtn:hover,
    .orderdetailBtn:hover {
        color: white;
        background-color: #908a70;
    }

    .searchIp:focus {
        border: 1px solid #908a70;
        box-shadow: 0 0 5px 0 #908a70;
    }

    .editBtn,
    .delBtn,
    .orderBtn,
    .dropdownBtn,
    .orderdetailBtn {
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
    tr,
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
                <form class="d-flex">
                    <div class="dropdown">
                        <a class="btn btn-outline dropdown-toggle dropdownBtn" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                            訂單查詢
                        </a>
                        <ul class="dropdown-menu dropdetailBtn" aria-labelledby="dropdownMenuLink">
                            <li><a class="dropdown-item clickthm" href="#">近三個月內訂單</a></li>
                            <li><a class="dropdown-item clickoy" href="#">近一年內訂單</a></li>
                        </ul>
                    </div>
                </form>
            </div>
            <div class="bd-example my-5">
                <table class="table table-hover">
                    <?php foreach ($odp_rows as $odp_r) : ?>
                        <?php if ($num != $odp_r['sid']) { ?>
                            <thead>
                                <tr>
                                    <th scope="row">訂單編號 : <?= $odp_r['sid'] ?></th>
                                    <td>下單日期 : <?= $odp_r['order_date'] ?></td>
                                    <td>總額 : <?= $odp_r['amount'] ?></td>
                                    <td></td>
                                    <!-- <td><button class="btn btn-outline orderdetailBtn">查看訂單明細</button> </td> -->
                                </tr>
                            </thead>
                            <?php  ?>
                            <tr>
                                <th scope="row">產品編號</th>
                                <td>產品名稱</td>
                                <td>單價</td>
                                <td>數量</td>
                            </tr>
                        <?php $num = $odp_r['sid'];
                        }; ?>
                        <tr>
                            <td><?= $odp_r['product_sid'] ?></td>
                            <td><?= $odp_r['name'] ?></td>
                            <td><?= $odp_r['product_price'] ?></td>
                            <td><?= $odp_r['product_quantity'] ?></td>
                        </tr>
                    <?php endforeach;  ?>
                </table>
            </div>
        </div>
    </div>
</div>
<?php include __DIR__ . '/parts/__scripts.php' ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    const clickthm = document.querySelector('.clickthm');
    const clickoy = document.querySelector('.clickoy');

    function detailthm(event) {
        const days = 89;
        window.location.href = "http://localhost/myTeamwork/stan_order_search.php?days=" + days;
    }
    clickthm.addEventListener('click', detailthm);

    function detailoy(event) {
        const days = 364;
        window.location.href = "http://localhost/myTeamwork/stan_order_search.php?days=" + days;
    }
    clickoy.addEventListener('click', detailoy);
</script>
<?php include __DIR__ . '/parts/__html_foot.php' ?>