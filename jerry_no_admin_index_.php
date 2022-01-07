<?php

require __DIR__ . '/parts/__connect_db.php';
// if(! isset($_SESSION['admin'])){
//     header('Location: jerry_no_admin_index_.php');
//     exit;
//  }

$pageName = 'index';
// 沒有登入管理帳號,就轉向

$title = '通訊錄列表';
$pageName = 'list';

$sql = sprintf("SELECT *  FROM `address_1` WHERE 1");

$rows = $pdo->query($sql)->fetchAll();
?>

<?php include __DIR__ . '/parts/__html_head.php' ?>
<?php include __DIR__ . '/parts/__sidebar.php' ?>
<?php include __DIR__ . '/parts/__navbar.php' ?>
<div class="container my-3">
    <div class="row">
        <div class="col-6">
       <!--     <button type="button" onclick="location.href='jerry_insert.php'" class="insert btn btn-outline" id="btn">新增</button> -->
        </div>
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
          <!--     `animal_sid`, `name`, `English_name`, `password`, `origin`, `birthday`, `remark` -->  
                        <th scope="col">#</th>
                        <th scope="col">Account (Name)</th>
                        <th scope="col">English_Name</th>
                        <th scope="col">species</th>
                        <th scope="col">origin</th>
                        <th scope="col">Birthday</th>
                        <th scope="col">remark</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                        <?php foreach ($rows as $r) : ?>
                            <tr>
                                <td><?= $r['sid'] ?></td>
                                <td><?= $r['name'] ?></td>
                                <td><?= $r['English_name'] ?></td>
                                <td><?= $r['species'] ?></td>
                                <td><?= $r['origin'] ?></td>
                                <td><?= $r['birthday'] ?></td>
                                <td><?= $r['remark'] ?></td>
                                <td>
                                <!--  <a href="edit.php?sid=<?= $r['sid'] ?>"><button type="button" class="editBtn btn btn-outline">修改</button></a>  
                                  <a href="delete.php?sid=<?= $r['sid'] ?>"><button type="button" class="delBtn btn btn-outline">刪除</button></a>  -->
                                </td>
                            </tr>
                        <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>




<?php include __DIR__ . '/parts/__scripts.php' ?>
<?php include __DIR__ . '/parts/__html_foot.php' ?>