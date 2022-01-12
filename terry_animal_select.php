<?php
require __DIR__ . '/parts/__connect_db.php';

$title = '搜尋';


// $sql = sprintf("SELECT * FROM `animal_touch` ORDER BY `actTime_start` WHERE `actName` LIKE '牛%'");

$var = "LIKE '". '%' . $_GET['keyword'] . "%'";

$rows = $pdo->query("SELECT * FROM `animal_touch`  WHERE `actName` $var ORDER BY `actTime_start`")->fetchAll();

?>



<?php include __DIR__ . '/parts/__html_head.php' ?>
<?php include __DIR__ . '/parts/__sidebar.php' ?>

<style>
    .items {
        display: flex;
        flex-direction: column;
    }


    .fa-angle-double-right,
    .fa-angle-right,
    .fa-angle-left,
    .fa-angle-double-left {
        color: #2f4f4f;
    }


    .page-item>a {
        color: #2f4f4f;
    }


    .page-item.active .page-link {
        z-index: 999;
        color: #fff;
        background-color: #2f4f4f;
        border-color: #2f4f4f;
    }

    .page-link:focus {
        z-index: 999;
        border-color: #2f4f4f;
        background-color: #dee2e6;
        color: #2f4f4f;
    }

    .page-link:hover {
        z-index: 999;
        border-color: #fff;
        background-color: #dee2e6;
        color: #2f4f4f;
    }

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

    a{
        text-decoration: none;
    }
</style>
<div class="wrap">
    <div class="container my-3">
        <div class="row">
            <div class="col-3 d-flex" style="justify-content: flex-start;">
                <a href="terry_insert.php">
                    <button type="button" class="insert btn btn-outline" id="btn">新增</button>
                </a>
            </div>
            <div class="col-3 d-flex" style="justify-content: flex-end;">
                <form class="d-flex">
                    <input id="testInput" class="searchIp form-control" type="search" placeholder="Search" aria-label="Search">
                    <button class="submitBtn search btn btn-outline" type="submit" style="width: 5rem;">搜尋</button>
                </form>
            </div>
            <div class="bd-example my-5">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <!-- <th scope="col">#</th> -->
                            <th scope="col">活動名稱</th>
                            <th scope="col">開始時間</th>
                            <th scope="col">結束時間</th>
                            <th scope="col" style="width: 8%">預約人數</th>
                            <th scope="col">活動簡介</th>
                            <th scope="col">活動位置</th>
                            <th scope="col" style="width: 8.6rem;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rows as $r) : ?>
                            <tr class="tables">
                                <th scope="row" style="display:none;"><?= $r['sid'] ?></th>
                                <td><?= $r['actName'] ?></td>
                                <td><?= $r['actTime_start'] ?></td>
                                <td><?= $r['actTime_end'] ?></td>
                                <td><?= $r['reserPeop'] ?></td>
                                <td><?= $r['introduce'] ?></td>
                                <td><?= $r['location'] ?></td>
                                <td>
                                    <a href="terry_edit.php?sid=<?= $r['sid'] ?>">
                                        <button type="button" class="editBtn btn btn-outline">修改</button>
                                    </a>
                                    <a href="javascript: removeCartItem(<?= $r['sid'] ?>)">
                                        <button type="button" class="delBtn btn btn-outline">刪除</button>
                                    </a>
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

</script>
<?php include __DIR__ . '/parts/__html_foot.php' ?>