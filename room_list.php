<?php
require __DIR__ . '/parts/__connect_db.php';
$title = '住宿資訊';
$pageName = 'room-list';

$perPage = 7;

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
if ($page < 1) {
    header('Location: room_list.php');
    exit;
}
$t_sql = "SELECT COUNT(1) FROM `room-detail`";

$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];
$totalPages = ceil($totalRows / $perPage);
if ($page > $totalPages) {
    header('Location: room_list.php?page=' . $totalPages);
    exit;
}

$sql = sprintf("SELECT * FROM `room-detail` ORDER BY sid DESC LIMIT %s,%s", ($page - 1) * $perPage, $perPage);

$rows = $pdo->query($sql)->fetchAll();
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
            <div class="col-6 d-flex" style="justify-content:flex-start;"><a href="./ning_room_insert.php" class="<?= $pageName == 'room-insert' ? 'active disable' : '' ?>"><button type="button" class="insert btn btn-outline active" id="btn">新增</button></a></div>
            <div class="col-3 d-flex" style="justify-content:flex-end;">
                <form class="d-flex">
                    <input class="searchIp form-control" type="search" placeholder="Search" aria-label="Search">
                    <button class="search btn btn-outline" type="submit">Search</button>
                </form>
            </div>
            <div class="row mt-5">
                <div class="col">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item <?= 1 == $page ? 'disabled' : '' ?>">
                                <a class="page-link" href="?page=<?= $page - 1 ?>" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            <?php for ($i = $page - 2; $i <= $page + 2; $i++)
                                if ($i >= 1 && $i <= $totalPages) : ?>
                                <li class="page-item <?= $i == $page ? 'active' : '' ?> "><a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a></li>
                            <?php endif; ?>
                            <li class="page-item <?= $totalPages == $page ? 'disabled' : '' ?>">
                                <a class="page-link" href="?page=<?= $page + 1 ?>" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="bd-example my-5">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <!-- <th scope="col">
                                <input class="del" type="checkbox">
                            </th> -->
                            <th scope="col">sid</th>
                            <th scope="col">房型</th>
                            <th scope="col">房間照片</th>
                            <th scope="col">房間資訊</th>
                            <th scope="col">人數</th>
                            <th scope="col">價錢</th>
                            <th scope="col">入住時間</th>
                            <th scope="col">退房時間</th>
                            <th scope="col">房間狀態</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rows as $r) : ?>
                            <tr class="tables">
                                <!-- <th scope="col">
                                    <input class="del" type="checkbox">
                                </th> -->
                                <th scope="row"><?= $r['sid'] ?></th>
                                <td><?= $r['room-name'] ?></td>
                                <td><?= $r['room-image'] ?></td>
                                <td><?= htmlentities($r['room-introduction']) ?></td>
                                <td><?= $r['people'] ?></td>
                                <td><?= $r['price'] ?></td>
                                <td><?= $r['check-in-data'] ?></td>
                                <td><?= $r['check-out-data'] ?></td>
                                <td><?= $r['check-in-status'] ?></td>
                                <?php /*
                            <td><?= $r['check-in-data'] ?></td>
                            <td><?= $r['check-out-data'] ?></td>
                            <td><?= $r['check-in-status'] ?></td>
                            */ ?>
                                <td>
                                    <a href="ning_room_edit.php?sid=<?= $r['sid'] ?>"><button type="button" class="editBtn btn btn-outline">修改</button></a>
                                    <a href="ning_delete.php?sid=<?= $r['sid'] ?>" onclick="return confirm('確定要刪除這筆編號<?= $r['sid'] ?>的資料嗎？')">
                                        <!-- <a href="javascript: delete_sid(<?= $r['sid'] ?>)"> -->
                                        <button type="button" class="delBtn btn btn-outline">刪除</button>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                    </tbody>

                </table>
            </div>
        </div>

    </div>

</div>

<?php include __DIR__ . '/parts/__scripts.php' ?>
<!-- <script>
    function delete_sid(sid){
        if(confirm(`確定要刪除這筆編號 ${sid} 的資料嗎？`)){
            location.href = `ning_delete.php?sid=${sid}`;
        }
    }
</script> -->
<?php include __DIR__ . '/parts/__html_foot.php' ?>