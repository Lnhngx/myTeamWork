<?php

require __DIR__ . '/parts/__connect_db.php';
$pageName = 'Cart';
$title = '購物車';
?>

<?php include __DIR__ . '/parts/__html_head.php' ?>
<?php include __DIR__ . '/parts/__sidebar.php' ?>
<?php

$sql = sprintf('SELECT `sid`,`product_name`,`src`,`price`,`quantity` FROM `temp_product` WHERE 1');
$rows = $pdo->query($sql)->fetchAll();
$number = 0;


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
    .editBtn {
        background-color: #2f4f4f;
        color: white
    }

    .search:hover,
    .insert:hover,
    .editBtn:hover {
        color: white;
        background-color: #908a70;
    }

    .searchIp:focus {
        border: 1px solid #908a70;
        box-shadow: 0 0 5px 0 #908a70;
    }

    .editBtn,
    .delBtn {
        color: white;
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
            <div class="col-3 d-flex" style="justify-content: flex-start;"><button type="button" class="insert btn btn-outline" id="btn">新增</button></div>
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
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rows as $r) : ?>
                            <tr class="tables">
                                <?php $number++ ?>
                                <th scope="row"><?= $number ?></th>
                                <td style="display:none;"><?= $r['sid'] ?></td>
                                <td><?= $r['product_name'] ?></td>
                                <td><?= $r['src'] ?>
                                    <!-- <img class="smallimg" src="./pic/<?= $r['src'] ?>.png" ?> -->
                                </td>
                                <td><?= $r['price'] ?></td>
                                <td>
                                    <button class="btn btn-outline editBtn" onclick="btnOperate('-')">-</button>
                                    <input id="quantity" value="<?= $r['quantity'] ?>">
                                    <button class="btn btn-outline editBtn" onclick="btnOperate('+')">+</button>
                                </td>
                                <td>
                                    <button type="button" class="editBtn btn btn-outline">加入購物車</button>
                                </td>
                            </tr>
                        <?php endforeach;  ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/parts/__scripts.php' ?>
<script>
    function btnAdd() {
        //1、獲取#quantity的value
        let value = document.getElementById("quantity").value;
        //2、將取出來的值做+1操作，再賦值給#quantity的value
        value = Number(value) + 1;
        document.getElementById("quantity").value = value;
    }

    function btnReduce() {
        //1、獲取#quantity的值
        let value = Number(document.getElementById("quantity").value);
        //2、判斷#quantity的值是否小於等於1，如果小於等於1的話，則將值改為1
        //3、否則，可以實現 - 1 操作
        if (value <= 1) {
            value = 1;
        } else {
            value -= 1;
        }
        //4、將 value 的值賦值給 #quantity
        document.getElementById("quantity").value = value;
    }

    /**
     * 做 數值的更改操作
     * 引數 op ：表示 符號 
     */
    function btnOperate(op) {
        let value = Number($("quantity").value);
        if (op == '+') {
            value += 1;
        } else if (op == '-') {
            if (value <= 1) {
                value = 1;
            } else {
                value -= 1;
            }
        }
        $("quantity").value = value;
    }
</script>
<?php include __DIR__ . '/parts/__html_foot.php' ?>