<?php
require __DIR__ . '/__connect_db.php';
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

$sql = sprintf("SELECT * FROM `room-detail` LIMIT %s,%s", ($page - 1) * $perPage, $perPage);

$rows = $pdo->query($sql)->fetchAll();
?>
<?php include __DIR__ . '/__html_head.php' ?>
<?php include __DIR__ . '/__sidebar.php' ?>
<?php include __DIR__ . '/__html_navbar.php' ?>
<div class="wrap">
    <div class="container my-3">
        <div class="row">
            <div class="col-6 d-flex" style="justify-content:flex-start;"><button type="button" class="insert btn btn-outline active" id="btn">新增</button></div>
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
                            <?php endif;?>
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
                            <th scope="col">sid</th>
                            <th scope="col">room-name</th>
                            <th scope="col">room-image</th>
                            <th scope="col">room-introduction</th>
                            <th scope="col">people</th>
                            <th scope="col">price</th>
                            <!-- <th scope="col">check-in-data</th>
                        <th scope="col">check-out-data</th>
                        <th scope="col">check-in-status</th> -->
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rows as $r) : ?>
                            <tr class="tables">
                                <th scope="row"><?= $r['sid'] ?></th>
                                <td><?= $r['room-name'] ?></td>
                                <td><?= $r['room-image'] ?></td>
                                <td><?= $r['room-introduction'] ?></td>
                                <td><?= $r['people'] ?></td>
                                <td><?= $r['price'] ?></td>
                                <?php /*
                            <td><?= $r['check-in-data'] ?></td>
                            <td><?= $r['check-out-data'] ?></td>
                            <td><?= $r['check-in-status'] ?></td>
                            */ ?>
                                <td>
                                    <button type="button" class="editBtn btn btn-outline">修改</button>
                                    <button type="button" class="delBtn btn btn-outline">刪除</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                    </tbody>

                </table>
            </div>
        </div>

    </div>

</div>

<?php include __DIR__ . '/__html_script.php' ?>
<?php include __DIR__ . '/__html_foot.php' ?>