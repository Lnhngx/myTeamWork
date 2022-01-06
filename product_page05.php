<?php
require __DIR__ . '/parts/__connect_db.php';

$title = '庫存表';
$pageName = 'products_reserve';
//可以在這邊設定名稱


$perpage = 15;

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
if ($page < 1) {
    header('Location: product_page05.php');
    exit;
};

$t_sql = 'SELECT COUNT(1) FROM product_reserve';

$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];
$totalPages = ceil($totalRows / $perpage);
if ($page > $totalPages) {
    header('Location: product_page05.php?page=' . $totalPages);
    exit;
};



$sql = sprintf("SELECT * FROM product_reserve  LIMIT %s , %s", ($page - 1) * $perpage, $perpage);

$row = $pdo->query($sql)->fetchAll();
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
        text-align: left;
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
            <div class="col-3">
                <form class="d-flex">
                    <input class="searchIp form-control" type="search" placeholder="Search" aria-label="Search">
                    <button class="search btn btn-outline" type="submit">Search</button>
                </form>
            </div>
            <div class="bd-example my-5">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">
                                <input class="checkbox" type="checkbox" onclick="selectAll()">
                            </th>
                            <th scope="col">#</th>
                            <th scope="col"><a href="/myTeamWork/product_page06.php" style="text-decoration:none;color:black">庫存類別</a></th>
                            <th scope="col">倉庫數量</th>
                            <th scope="col">現場數量</th>
                            <th scope="col"><a href="/myTeamWork/product_page07.php" style="text-decoration:none;color:black">現場位置</a></th>
                            <th scope="col">更新時間</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($row as $r) :
                        ?>
                            <tr class="tables">
                                <td>
                                    <input id="check" value="<?= $r['sid'] ?>" name="checkbox[]" class="check" type="checkbox">
                                </td>
                                <td><?= $r['sid'] ?></td>
                                <td><?= $r['reserve_type'] ?></td>
                                <td><?= $r['quantity_ware'] ?></td>
                                <td><?= $r['quantity_location'] ?></td>
                                <td><?= $r['location'] ?></td>
                                <td><?= $r['create_at'] ?></td>
                                <td>
                                    <button type="button" class="editBtn btn btn-outline">修改</button>
                                    <a href="javascript: delete_it(<?= $r['sid'] ?>)"><button type="button" class="delBtn btn btn-outline">刪除</button></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="row">
                    <div class="col">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <li class="page-item <?= 1 == $page ? 'disabled' : ''; ?>"><a class="page-link" href="?page=<?= $page - 1 ?>"><i class="fas fa-arrow-left"></i></a></li>

                                <?php for ($i = $page - 2; $i <= $page + 2; $i++)
                                    if ($i >= 1 && $i <= $totalPages) :
                                ?>
                                    <li class="page-item <?= $i == $page ? 'active' : '' ?>"><a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a></li>
                                    <!-- 連結用變數去帶 -->
                                <?php endif; ?>
                                <!-- for迴圈 -->
                                <li class="page-item <?= $totalPages == $page ? 'disabled' : ''; ?>"><a class="page-link" href="?page=<?= $page + 1 ?>"><i class="fas fa-arrow-right"></i></a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>






        <?php include __DIR__ . '/parts/__scripts.php' ?>
        <script>
            // const rows = <?= json_encode($row) ?>;
            // console.log(rows);

            function delete_it(sid) {
                if (confirm(`確定要刪除編號為${sid}的資料嗎？`)) {
                    location.href = `delete.php?sid=${sid}`;
                }
            }

            const a = document.querySelector(".checkbox");
            const b = document.querySelectorAll("#check");

            function selectAll() {
                a.checked ? b.forEach((arr) => {
                    arr.checked = true
                }) : b.forEach((arr) => {
                    arr.checked = false
                });
            }
        </script>

        <?php include __DIR__ . '/parts/__html_foot.php' ?>