<?php

require __DIR__ . '/parts/__connect_db.php';
$pageName = 'Cart';
$title = '購物車';
?>

<?php include __DIR__ . '/parts/__html_head.php' ?>
<?php include __DIR__ . '/parts/__sidebar.php' ?>
<?php

$sql = sprintf('SELECT `product_sid`,`product_src`,`product`,`price`,`quantity` FROM `temp_cart` WHERE 1');
$rows = $pdo->query($sql)->fetchAll();



?>
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

    #quantity {
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
                    <input class="searchIp form-control" type="search" placeholder="Search" aria-label="Search">
                    <button class="search btn btn-outline" type="submit">Search</button>
                </form>
            </div>
            <div class="bd-example my-5">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">產品</th>
                            <th scope="col">產品名稱</th>
                            <th scope="col">單價</th>
                            <th scope="col">數量</th>
                            <th scope="col">小計</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rows as $r) : ?>
                            <tr class="tables">
                                <th scope="row"><?= $r['product_sid'] ?></th>
                                <td><?= $r['product_src'] ?>
                                    <!-- <img class="smallimg" src="./pic/<?= $r['product_src'] ?>.png" ?> -->
                                </td>
                                <td><?= $r['product'] ?></td>
                                <td><?= $r['price'] ?></td>
                                <td>
                                    <button class="btn btn-outline editBtn" onclick="btnminus()">-</button>
                                    <input id="quantity" value="<?= $r['quantity'] ?>">
                                    <button class="btn btn-outline editBtn" onclick="btnadd()">+</button>
                                </td>
                                <td>
                                    <a href="javascript: removeCartItem(<?= $r['product_sid'] ?>)">
                                        <button type="button" class="delBtn btn btn-outline">刪除</button>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach;  ?>
                    </tbody>
                </table>
                <a href="">
                    <button type="button" class="orderBtn btn btn-outline">下一步</button>
                </a>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/parts/__scripts.php' ?>

<script>
    function removeCartItem(product_sid) {
        if (confirm(`確定要刪除編號為 ${product_sid} 的資料嗎?`)) {
            location.href = `stan_delete_cart_api.php?product_sid=${product_sid}`;
        }
    }
</script>
<?php include __DIR__ . '/parts/__html_foot.php' ?>