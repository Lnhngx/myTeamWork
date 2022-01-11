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

$content = (isset($_POST['searchbox']) ? "%" . $_POST['searchbox'] . "%" : '');
if ($content !== '') {
    $sql = sprintf("SELECT *  FROM `address_1` WHERE `name` LIKE '%s' OR `English_name` LIKE '%s' OR `species` LIKE '%s' OR `origin` LIKE '%s'", $content, $content, $content, $content);;
} else {
    $sql = sprintf("SELECT *  FROM `address_1` WHERE 1");
}

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

    .editBtn btn btn-outline {
        width: 200px;
    }
</style>
<div class="wrap">
    <div class="container my-3">
        <div class="row">
            <div class="col-3 d-flex" style="justify-content: flex-start;">
                <button type="button" onclick="location.href='jerry_insert.php'" class="insert btn btn-outline" id="btn">新增</button>
            </div>
            <div class="col-3">
                <form class="d-flex" method="POST" action="">
                    <input class="searchIp form-control" type="text" name="searchbox" id="searchbox">
                    <button class="search btn btn-outline" type="submit">Search</button>
                </form>
            </div>
            <div class="bd-example my-5">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <!--     `animal_sid`, `name`, `English_name`, `password`, `origin`, `birthday`, `remark` -->
                            <th scope="col">#</th>
                            <th scope="col" style="width: 8%">名稱</th>
                            <th scope="col">學名</th>
                            <th scope="col">科目</th>
                            <th scope="col">產地</th>
                            <th scope="col">生日</th>
                            <th scope="col">備註</th>
                            <th scope="col" style="width:200px"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rows as $r) : ?>
                            <tr class="tables ui-state-default">

                                <td><?= $r['sid'] ?></td>
                                <td><?= $r['name'] ?></td>
                                <td><?= $r['English_name'] ?></td>
                                <td><?= $r['species'] ?></td>
                                <td><?= $r['origin'] ?></td>
                                <td><?= $r['birthday'] ?></td>
                                <td><?= $r['remark'] ?></td>
                                <td>
                                    <a href="jerry_edit.php?sid=<?= $r['sid'] ?>"><button type="button" class="editBtn btn btn-outline">修改</button></a>
                                    <a href="jerry_delete.php?sid=<?= $r['sid'] ?>"><button type="button" class="delBtn btn btn-outline">刪除</button></a>

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