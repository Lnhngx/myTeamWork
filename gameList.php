<?php
require __DIR__. '/parts/__connect_db.php';
$title = '遊戲選項列表';
$pageName = 'gamelist';

$sql = "SELECT `answer`.`sid`,`name`,`qcontent`,`acontent`,`yesno`,`question_sid`,`image`FROM `question` JOIN `answer` on `question`.`sid` = `answer`.`question_sid`";
$rows = $pdo -> query($sql) ->fetchAll();
// $rows 由 fetchAll()全部取出來，目前是47筆
$t_sql = "SELECT COUNT(1) FROM answer";
$totalRows = $pdo -> query($t_sql) ->fetch(PDO::FETCH_NUM)[0];
// $totalRows是總筆數
$perPage = 5; 
//一頁目前顯示5筆
$totalPages = ceil($totalRows/$perPage);




?>
<?php include __DIR__ . '/parts/__html_head.php' ?>
<?php include __DIR__ . '/parts/__sidebar.php' ?>
<style>
    .wrap{
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

    .tables td, th {
        /* text-align: center; */
        vertical-align: middle;
    }
</style>
<div class="wrap">   
    <div class="container my-3">
        <div class="row">
            <div class="col-3 d-flex" style="justify-content: flex-start;">

                <a href="insertAlist.php">
                    <button type="button" class="insert btn btn-outline" id="btn">新增</button>
                </a>

            </div>
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
                            <th scope="col">#</th>
                            <th scope="col">name</th>
                            <th scope="col">qcontent</th>
                            <th scope="col">acontent</th>
                            <th scope="col">yesno</th>
                            <th scope="col">question_sid</th>
                            <th scope="col">image</th>
                            <th scope="col"></th>     
                        </tr>
                    </thead>
                    <tbody>

                    <?php $count = -1; ?> 
                    <?php foreach($rows as $r): ?>
                        <?php $count++; ?>
                    
                    
                        <tr class="tables">
                            <th scope="row"><?= $r['sid'] ?></th>
                            <td><?= htmlentities($r['name']) ?></td>
                            <td><?= htmlentities($r['qcontent']) ?></td>
                            <td><?= htmlentities($r['acontent']) ?></td>
                            <td><?= $r['yesno'] ?></td>
                            <td><?= $r['question_sid'] ?></td>
                            <td><?= $r['image'] ?></td>
                                
                                <?php if($count % 4 == 0): ?>            
                                    <td rowspan="4" style="border:1px solid #E0E0E0;">

                                    <a href="editGamelist.php?question_sid=<?= $r['question_sid'] ?>">
                                    <button type="button" class="editBtn btn btn-outline">修改</button>
                                    </a>
                                    <a href="javascript: delete_Alist(<?= $r['question_sid'] ?>)">
                                    <button type="button" class="delBtn btn btn-outline">刪除</button>
                                    </a>

                                    </td>
                                <?php endif; ?>
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
<script>
    function delete_Alist(question_sid) {
        if (confirm(`確定要刪除第 ${question_sid} 題的資料嗎?`)) {
            location.href = `delete_Alist.php?question_sid=${question_sid}`;
        }
    }
</script>
<?php include __DIR__ . '/parts/__html_foot.php' ?>