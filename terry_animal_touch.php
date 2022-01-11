<?php
require __DIR__ . '/parts/__connect_db.php';

$title = '動物接觸';
$pageName = 'animal_touch';



$perpage = 5;

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
if ($page < 1) {
    header('Location: animal_touch.php');
    exit;
};

$t_sql = 'SELECT COUNT(1) FROM animal_touch';
$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];

$totalPages = ceil($totalRows / $perpage);
if ($page > $totalPages) {
    header('Location: animal_touch.php?page=' . $totalPages);
    exit;
};

$sql = sprintf('SELECT `sid`,`actName`,`actTime_start`,`actTime_end`,`reserPeop`,`introduce`,`location` FROM animal_touch ORDER BY `actTime_start` LIMIT %s , %s', ($page - 1) * $perpage, $perpage);

$rows = $pdo->query($sql)->fetchAll();

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
                            <th scope="col">已預約人數</th>
                            <th scope="col">活動簡介</th>
                            <th scope="col">活動位置</th>
                            <th scope="col"></th>
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



                <div class="row">
                    <div class="col">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <li class="page-item <?= 1 == $page ? 'disabled' : ''; ?>"><a class="page-link" href="?page=1"><i class="fas fa-angle-double-left"></i></a></li>
                                <li class="page-item <?= 1 == $page ? 'disabled' : ''; ?>"><a class="page-link" href="?page=<?= $page - 1 ?>"><i class="fas fa-angle-left"></i></a></li>
                                <?php for ($i = $page - 2; $i <= $page + 2; $i++)
                                    if ($i >= 1 && $i <= $totalPages) :
                                ?>
                                    <li class="page-item <?= $i == $page ? 'active' : '' ?>"><a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a></li>
                                <?php endif; ?>

                                <li class="page-item <?= $totalPages == $page ? 'disabled' : ''; ?>"><a class="page-link" href="?page=<?= $page + 1 ?>"><i class="fas fa-angle-right"></i></a></li>
                                <li class="page-item <?= $totalPages == $page ? 'disabled' : ''; ?>"><a class="page-link" href="?page=<?= $totalPages ?>"><i class="fas fa-angle-double-right"></i></a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
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

    var testInput = document.getElementById("testInput");
    var submitBtn = document.querySelector(".submitBtn");

    function FuncSubmitBtn(value) {
        event.preventDefault();
        var str = "";
        var submitValue = testInput.value;
        str = submitValue;
        // alert(str);
        window.location.href = `http://localhost/myTeamWork/terry_animal_select.php?keyword=${str}`;
    }
    submitBtn.addEventListener("click", FuncSubmitBtn);
</script>
<?php include __DIR__ . '/parts/__html_foot.php' ?>