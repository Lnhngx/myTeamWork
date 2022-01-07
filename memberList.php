<?php

require __DIR__ . '/parts/__connect_db.php';
$pageName = 'index';
$title = '會員資料列表';
$pageName = 'memberList';

if(! isset($_SESSION['users'])){
    header("Location: member_login.php");
    exit;
}

$perpage = 5;
// 每頁幾筆
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
if ($page < 1) {
    header('Location: memberList.php');
    exit;
}
// 頁數不能為負數
$t_sql = "SELECT COUNT(1) FROM members";
// 資料筆數
$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];
$totalPages = ceil($totalRows / $perpage);
if ($page > $totalPages) {
    header('Location: memberList.php?page=' . $totalPages);
    exit;
}

// $sql = sprintf("SELECT * FROM members ORDER BY sid DESC LIMIT %s, %s", ($page - 1) * $perpage, $perpage);
$sql = sprintf("SELECT * 
                    FROM `members` m
                    LEFT JOIN `grade` g
                    ON m.`grade_sid`=g.`grade_sid`
                    ORDER BY m.`sid` DESC 
                    LIMIT %s, %s", ($page - 1) * $perpage, $perpage);
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
            <div class="col-3 d-flex" style="justify-content: flex-start;"><button onclick="insertMember()" type="button" class="insert btn btn-outline" id="btn">新增</button></div>
            <div class="col-3 d-flex" style="justify-content: flex-start;">
                <form class="d-flex">
                    <input class="searchIp form-control" type="search" placeholder="Search" aria-label="Search">
                    <button class="search btn btn-outline" type="submit">Search</button>
                </form>
            </div>
            <div class="col-12">
                <div class="col ty_col">
                    <nav aria-label="...">
                        <ul class="pagination">
                            <li class="page-item <?= 1 == $page ? 'disabled' : '' ?>">
                                <a class="page-link" href="?page=<?= $page == 1 ?>">
                                    <i class="fas fa-angle-double-left"></i>
                                </a>
                            </li>
                            <!-- 最前面 -->
                            <li class="page-item <?= 1 == $page ? 'disabled' : '' ?>">
                                <a class="page-link" href="?page=<?= $page - 1 ?>">
                                    <i class="fas fa-angle-left"></i>
                                </a>
                            </li>
                            <!-- 上一頁 -->
                            <?php for ($i = $page - 2; $i <= $page + 2; $i++)
                                if ($i >= 1 && $i <= $totalPages) : ?>
                                <li class="page-item <?= $i == $page ? 'active' : '' ?>" aria-current="page">
                                    <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                                </li>
                            <?php endif; ?>
                            <!-- 頁數 -->
                            <li class="page-item <?= $totalPages == $page ? 'disabled' : '' ?>">
                                <a class="page-link" href="?page=<?= $page + 1 ?>">
                                    <i class="fas fa-angle-right"></i>
                                </a>
                            </li>
                            <!-- 下一頁 -->
                            <li class="page-item <?= $totalPages == $page ? 'disabled' : '' ?>">
                                <a class="page-link" href="?page=<?= $totalPages ?>">
                                    <i class="fas fa-angle-double-right"></i>
                                </a>
                            </li>
                            <!-- 最後面 -->
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- row 分頁按鈕 -->

            <div class="bd-example my-5">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <?php /*<th>
                                    <input class="del" type="checkbox" name="checkbox" value="<?= $r['sid'] ?>">
                                </th> */ ?>
                            <!-- 勾選 -->
                            <th scope="col">#</th>
                            <th scope="col">Account (Email)</th>
                            <th scope="col">Name</th>
                            <th scope="col">Password</th>
                            <th scope="col">Mobile</th>
                            <th scope="col">Birthday</th>
                            <th scope="col">Address</th>
                            <th scope="col">Grade</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rows as $r) : ?>
                            <tr class="tables">
                                <?php /*<td>
                                    <input class="del" type="checkbox" name="checkbox" value="<?= $r['sid'] ?>">
                                </td> */ ?>
                                <!-- 勾選 -->
                                <th scope="row"><?= $r['sid'] ?></th>
                                <td><?= $r['email'] ?></td>
                                <td><?= $r['name'] ?></td>
                                <td><?= $r['password'] ?></td>
                                <td><?= $r['mobile'] ?></td>
                                <td><?= $r['birthday'] ?></td>
                                <td><?= $r['address'] ?></td>
                                <td><?= $r['grade_name'] ?></td>
                                <td>
                                    <a href="editMember.php?sid=<?= $r['sid'] ?>">
                                        <button type="button" class="editBtn btn btn-outline">修改</button>
                                    </a>
                                    <!-- 修改 -->

                                    <button onclick="delete_member(<?= $r['sid'] ?>)" type="button" class="delBtn btn btn-outline">刪除</button>
                                    <!-- 刪除 -->
                                </td>
                            </tr>
                        <?php endforeach; ?>

                    </tbody>

                </table>
            </div>
        </div>
        <!-- row 會員資料 -->
    </div>
</div>



<?php include __DIR__ . '/parts/__scripts.php' ?>
<script>
    function delete_member(sid) {
        if (confirm(`確定要刪除 ${sid} 這筆資料嗎?`)) {
            location.href = `delete_member.php?sid=${sid}`;
        }
    }

    function insertMember(){
        location.href=`insertMember.php`;
    }
</script>
<?php include __DIR__ . '/parts/__html_foot.php' ?>