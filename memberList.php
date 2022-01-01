<?php

require __DIR__ . '/parts/__connect_db.php';
$pageName = 'index';
$title = '會員資料列表';
$pageName = 'memberList';

$perpage = 5;
// 每頁幾筆
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
if($page < 1){
    header('Location: memberList.php');
    exit;
}
// 頁數不能為負數
$t_sql = "SELECT COUNT(1) FROM members";
// 資料筆數
$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];
$totalPages = ceil($totalRows/$perpage);
if($page > $totalPages){
    header('Location: memberList.php?page='. $totalPages);
    exit;
}

$sql = sprintf("SELECT * FROM members ORDER BY sid DESC LIMIT %s, %s", ($page-1)*$perpage, $perpage);
$rows = $pdo->query($sql)->fetchAll();






?>

<?php include __DIR__ . '/parts/__html_head.php' ?>
<?php include __DIR__ . '/parts/__sidebar.php' ?>
<?php include __DIR__ . '/parts/__navbar.php' ?>
<style>
    th{
        text-align: left;
    }
    .ty_col{
        margin-left: 12rem;
    }
</style>
<div class="container">
    <div class="row">
        <!-- <div class="col">
            
        </div> -->
        <!-- 空的 -->
        <div class="col ty_col">
            <div class="bd-example">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Account (Email)</th>
                            <th scope="col">Name</th>
                            <th scope="col">Password</th>
                            <th scope="col">Mobile</th>
                            <th scope="col">Birthday</th>
                            <th scope="col">Address</th>
                            <th scope="col">Grade</th>
                            <th scope="col">編輯</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rows as $r): ?>
                            <tr>
                                <td><?= $r['sid'] ?></td>
                                <td><?= $r['email'] ?></td>
                                <td><?= $r['name'] ?></td>
                                <td><?= $r['password'] ?></td>
                                <td><?= $r['mobile'] ?></td>
                                <td><?= $r['birthday'] ?></td>
                                <td><?= $r['address'] ?></td>
                                <td><?= $r['grade_sid'] ?></td>
                                <td>
                                    <a href="">
                                        
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
<?php include __DIR__ . '/parts/__html_foot.php' ?>