<?php

require __DIR__ . '/parts/__connect_db.php';
$pageName = 'animal_touch';
$title = '動物接觸';
?>

<?php include __DIR__ . '/parts/__html_head.php' ?>
<?php include __DIR__ . '/parts/__sidebar.php' ?>
<?php

$sql = sprintf('SELECT `sid`,`actName`,`actTime_start`,`actTime_end`,`reserPeop`,`introduce`,`location` FROM `animal_touch` WHERE 1');
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
                            <!-- <th scope="col">#</th> -->
                            <th scope="col">活動名稱</th>
                            <th scope="col">開始時間</th>
                            <th scope="col">結束時間</th>
                            <th scope="col">已預約人數</th>
                            <th scope="col">活動簡介</th>
                            <th scope="col">活動位置</th>
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
                                    <a href="terry_edit.php?sid=<?= $r['sid']?>">
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
    function removeCartItem(sid) {
        if (confirm(`確定要刪除這筆資料嗎?`)) {
            location.href = `terry_delete_api.php?sid=${sid}`;
        }
    }
</script>
<?php include __DIR__ . '/parts/__html_foot.php' ?>