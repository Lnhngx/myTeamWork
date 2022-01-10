<?php
require __DIR__. '/parts/__connect_db.php';
$title = '遊戲選項列表';
$pageName = 'gameList';


$t_sql = "SELECT COUNT(1) FROM answer";
$totalRows = $pdo -> query($t_sql) ->fetch(PDO::FETCH_NUM)[0];
// $totalRows是總筆數
$perPage = 12; 
//一頁目前顯示12筆
$totalPages = ceil($totalRows/$perPage);
// 處理分頁，沒有設定統一第一頁顯示出來
$page = isset($_GET['page']) ? intval($_GET['page']):1;
// 列印出當下那頁該有的資料
$sql = sprintf("SELECT `answer`.`sid`,`name`,`qcontent`,`acontent`,`yesno`,`question_sid`,`image`FROM `question` JOIN `answer` on `question`.`sid` = `answer`.`question_sid` LIMIT %s,%s",($page-1)*$perPage,$perPage);
// $rows 由 fetchAll()全部取出來，目前是47筆
$rows = $pdo -> query($sql) ->fetchAll();
if($page<1){
    header('Location:gameList.php');
    exit;
}
if($page>$totalPages){
    header('Location:gameList.php?page='.$totalPages);
    exit;
}

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
    .page-item > a {
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
        color: #2f4f4f;
        background-color: #dee2e6;
        border-color: #2f4f4f;
    }.page-link:hover {
        z-index: 999;
        color: #2f4f4f;
        background-color: #dee2e6;
        border-color: #fff;
    }
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
                <form class="d-flex" name="form12">
                    <input class="searchIp form-control" type="search" placeholder="Search" aria-label="Search">
                </form>
            </div>
            <!-- 分頁按鈕begin -->
            <div class="col-12 mt-4">
                <nav aria-label="...">
                    <ul class="pagination justify-content-center">
                        <!-- 直接到第一頁 -->
                        <li class="page-item <?= $page == 1 ? 'disabled' : '' ?>">
                            <a class="page-link" href="?page=1">
                                <i class="fas fa-angle-double-left"></i>
                            </a>
                        </li>
                        <!-- 到上一頁 -->
                        <li class="page-item <?= $page == 1 ? 'disabled' : '' ?>">
                            <a class="page-link" href="?page=<?= $page-1?>">
                                <i class="fas fa-angle-left"></i>
                            </a>
                        </li>
                        <!-- 每一頁的按鈕 -->
                        <?php for($i=$page-2;$i<=$page+2;$i++)
                            if($i>=1 && $i<=$totalPages): ?>
                            <li class="page-item <?= $i==$page ? 'active' : ''?>">
                                <a class="page-link" href="?page=<?= $i ?>">
                                    <?= $i ?> 
                                </a>
                            </li>
                        <?php endif; ?>
                        <!-- 到下一頁 -->
                        <li class="page-item <?= $totalPages == $page ? 'disabled' : ''?>">
                            <a class="page-link" href="?page=<?= $page+1 ?>">
                                <i class="fas fa-angle-right"></i>
                            </a>
                        </li>
                        <!-- 直接到最後一頁 -->
                        <li class="page-item <?= $page == $totalPages ? 'disabled' : '' ?>">
                            <a class="page-link" href="?page=<?= $totalPages ?>">
                                <i class="fas fa-angle-double-right"></i>
                            </a>
                        </li>
                    </ul>
                </nav>   
            </div>
            <!-- 分頁按鈕end -->
            <div class="bd-example my-4">
                <form action="boxDelete-api.php" method="post">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">
                                    <input type="checkbox" class="checkAll">
                                </th>
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
                    
                            <tr class="tables" style="line-height: 2.6rem;">
                                <td>
                                    <input type="checkbox" name="checkbox[]" class="check" value="<?= $r['question_sid'] ?>">
                                </td>
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
                    <button  class="delAll btn btn-danger">刪除</button>
                </form>   
            </div>
        </div>
    </div>
</div> 
<?php include __DIR__ . '/parts/__scripts.php' ?>
<script>
    const checkAll = document.querySelector('.checkAll');
    const check = document.querySelectorAll('.check');
    checkAll.addEventListener('change',function(){
        if(checkAll.checked == true){
            check.forEach(el=>el.checked=true);
        }else{
            check.forEach(el=>el.checked=false)
        }
    })
    function delete_Alist(question_sid) {
        if (confirm(`確定要刪除第 ${question_sid} 題的資料嗎?`)) {
            location.href = `delete_Alist.php?question_sid=${question_sid}`;
        }
    }

    const delAll = document.querySelector('.delAll');
    delAll.addEventListener('click', delAl);

    function delAl() {
        if (confirm(`確定刪除已勾選的項目?`)) {
            delAll.getAttribute('type') = 'submit';
            location.href = `deleteAll_member-api.php`;
        }else{
           det 
        }  
    }

    const search = document.querySelector('.searchIp');
    search.addEventListener('onchange',function(){
        console.log(search.value);
    })
    // function doSearch(){
    //     const fd = new FormData(document.form12);
    //     fetch(filter-api.php,{
    //         method : 'POST',
    //         body : fd,
    //     })
    //  }
    
</script>
<?php include __DIR__ . '/parts/__html_foot.php' ?>