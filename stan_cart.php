<?php
error_reporting(0);
require __DIR__ . '/parts/__connect_db.php';
$pageName = 'Cart';
$title = '奇怪的購物車';

$addcartKeys = array_keys($_SESSION['cart']);
// 抓購物車的產品SID

$rows = [];
$data_ar = [];

if (!empty($addcartKeys)) {
    $sql = sprintf("SELECT * FROM product_item  
        where sid IN(%s)", implode(',', $addcartKeys));
    $rows = $pdo->query($sql)->fetchAll();

    foreach ($rows as $r) {
        $r['quantity'] = $_SESSION['cart'][$r['sid']];
        $data_ar[$r['sid']] = $r;
    }
}
?>


<?php include __DIR__ . '/parts/__html_head.php' ?>

<?php include __DIR__ . '/parts/__sidebar.php' ?>
<?php

$num = 0;
$subtotal = 0;
$total = 0;

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
                <!-- <form class="d-flex">
                    <input class="searchIp form-control" type="search" placeholder="Search" aria-label="Search">
                    <button class="search btn btn-outline" type="submit">搜尋</button>
                </form> -->
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
                        <?php foreach ($_SESSION['cart'] as $sid => $qty) :
                            $items = $data_ar[$sid]; ?>
                            <tr class="tables">
                                <?php $num++ ?>
                                <th scope="row"><?= $num ?></th>
                                <td class="sid" data-sid="<?= $items['sid'] ?>" style="display:none;"><?= $items['sid'] ?></td>
                                <td><img src="./uploaded/<?= $items['picture'] ?> " alt="" height="80px" xq_big="true" setting='{"pwidth":550,"pheight":550,"margin_top":-80,"margin_left":-100}'></td>
                                <td><?= $items['name'] ?></td>
                                <td class="price" data-price="<?= $items['price'] ?>"></td>
                                <td>
                                    <button type="submit" class="btn btn-outline editBtn minusBtn">-</button>
                                    <input type="text" class="quantitybox" data-qty="<?= $items['quantity'] ?>">
                                    <button type="submit" class="btn btn-outline editBtn addBtn">+</button>
                                </td>
                                <td class="subtotal"></td>
                                <td>
                                    <a href="javascript:removeCartItem(<?= $items['sid'] ?>,<?= $num ?> )">
                                        <button type="button" class="delBtn btn btn-outline Joincart">刪除</button>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach;  ?>
                    </tbody>
                </table>
                <div id="total">
                    總計：<?= $total ?>
                </div>
                <?php if (isset($_SESSION['users'])) : ?>
                    <a href="stan_order.php" class="btn btn-success">結帳</a>
                <?php else : ?>
                    <div class="alert alert-danger" role="alert">
                        請先登入會員再結帳
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/parts/__scripts.php' ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    function removeCartItem(sid, num) {
        if (confirm(`確定要刪除編號 ${num} 的資料嗎?`)) {
            location.href = `stan_delete_cart_api.php?sid=${sid}`;
        }
    }

    function priceCommas(n) {
        return n.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
    };


    document.querySelectorAll('.minusBtn').forEach((el) => {
        el.addEventListener('click', btnminus);
    })

    function btnminus(event) {
        // let input = event.currentTarget.nextElementSibling;

        // if (input.value <= 1) {
        //     input.value = 1;
        // } else {
        //     input.value -= 1;
        // }

        let sid = $(this).closest('.tables').find('.sid').text();
        let qty = $(this).closest('.tables').find('.quantitybox').val();

        if (qty <= 1) {
            qty = 1;
        } else {
            qty -= 1;
        }

        $.get('stan_add_to_cart_api.php', {
            sid,
            qty
        }, function() {
            calPrices(function() {
                location.reload();
            });
        }, 'json');
    }

    document.querySelectorAll('.addBtn').forEach((el) => {
        el.addEventListener('click', btnadd);
    })

    function btnadd(event) {
        // let input = event.currentTarget.previousElementSibling;
        // input.value = parseInt(input.value) + 1;
        // // 直接寫 input.value+=1; 系統會判斷成字串相加，故需使用 parseInt 轉換後在相加

        let sid = $(this).closest('.tables').find('.sid').text();
        let qty = $(this).closest('.tables').find('.quantitybox').val();
        qty = parseInt(qty) + 1;

        $.get('stan_add_to_cart_api.php', {
            sid,
            qty
        }, function() {
            calPrices(function() {
                location.reload();
            });
        }, 'json');
    };

    function calPrices(cb) {
        let total = 0;
        const table = $('.tables');
        if (!table.length) {
            alert('請先將商品加入購物車');
            location.href = 'stan_temp_product.php';
            return;
        }

        table.each(function(i, el) {
            let price = $(this).closest('.tables').find('.price');
            price.text('$' + price.attr('data-price'));

            let qty = $(this).closest('.tables').find('.quantitybox');
            qty.val(qty.attr('data-qty'));

            let subtotal = $(this).closest('.tables').find('.subtotal');
            subtotal.text('$' + priceCommas(price.attr('data-price') * qty.val()));

            total += price.attr('data-price') * qty.val();
        });
        $('#total').text('$' + priceCommas(total));
        if (cb) cb();
    }
    calPrices();
</script>
<?php include __DIR__ . '/parts/__html_foot.php' ?>