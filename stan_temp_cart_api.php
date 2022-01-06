<?php

require __DIR__ . '/parts/__connect_db.php';
$pageName = 'Cart';
$title = '購物車';
?>

<?php include __DIR__ . '/parts/__html_head.php' ?>
<?php include __DIR__ . '/parts/__sidebar.php' ?>
<?php

$sql = sprintf('SELECT * FROM `temp_cart` WHERE 1');
$rows = $pdo->query($sql)->fetchAll();
$num = 0;

// 順序編號


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
                                <?php $num++ ?>
                                <th scope="row"><?= $num ?></th>
                                <td style="display:none;"><?= $r['product_sid'] ?></td>
                                <td><?= $r['product_src'] ?></td>
                                <td><?= $r['product'] ?></td>
                                <td class="price"><?= $r['price'] ?></td>
                                <td>
                                    <button class="btn btn-outline editBtn minusBtn">-</button>
                                    <input class="quantitybox" value="<?= $r['quantity'] ?>">
                                    <button class="btn btn-outline editBtn addBtn">+</button>
                                </td>
                                <td class="sub-total">
                                </td>
                                <td>
                                    <a href="javascript: removeCartItem(<?= $r['product_sid'] ?>,<?= $num ?>)">
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
    function removeCartItem(product_sid, num) {
        if (confirm(`確定要刪除編號 ${num} 的資料嗎?`)) {
            location.href = `stan_delete_cart_api.php?product_sid=${product_sid}`;
        }
    }

    document.querySelectorAll('.minusBtn').forEach((el) => {
        el.addEventListener('click', btnminus());
    })

    function btnminus(event) {
        let input = event.currentTarget.nextElementSibling;
        if (input.value <= 1) {
            input.value = 1;
        } else {
            input.value -= 1;
        }
    }

    document.querySelectorAll('.addBtn').forEach((el) => {
        el.addEventListener('click', btnadd);
    })

    function btnadd(event) {
        let input = event.currentTarget.previousElementSibling;
        input.value = parseInt(input.value) + 1;
        // 直接寫 input.value+=1; 系統會判斷成字串相加，故需使用 parseInt 轉換後在相加
    }
</script>
<?php include __DIR__ . '/parts/__html_foot.php' ?>