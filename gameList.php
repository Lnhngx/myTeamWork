<?php
require __DIR__. '/parts/__connect_db.php';
$title = '遊戲選項列表';
$pageName = 'gameList';

if (!isset($_SESSION['users'])) {
    header("Location: member_login.php");
    exit;
}
// t_sql是算出總筆數的SQL指令
$t_sql = "SELECT COUNT(1) FROM `question` JOIN `answer` on `question`.`sid` = `answer`.`question_sid` ";
// 當有使用搜尋功能，JS會產生query string -> $keyword
$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
// 加入篩選的指令
if(isset($_GET['keyword'])){
    $t_sql = $t_sql."WHERE name LIKE '%".$keyword."%' ";
}
$totalRows = $pdo -> query($t_sql) ->fetch(PDO::FETCH_NUM)[0];
// $totalRows是總筆數
$perPage = 12; 
//一頁目前顯示12筆
$totalPages = ceil($totalRows/$perPage);
// 處理分頁，沒有設定統一第一頁顯示出來
$page = isset($_GET['page']) ? intval($_GET['page']):1;


$filter_var = isset($_GET['keyword']) ? "WHERE name LIKE '%" . $keyword . "%'" : '';

// 列印出當下那頁該有的資料
$sql = sprintf("SELECT `answer`.`sid`,`name`,`qcontent`,`acontent`,`yesno`,`question_sid`,`image`FROM `question` JOIN `answer` on `question`.`sid` = `answer`.`question_sid` %s LIMIT %s,%s",$filter_var,($page-1)*$perPage,$perPage);
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
    .delBtn,
    .delAll {
        color: white;
        
    }

    .delBtn,
    .delAll {
        background-color: #C82C2C;
      
    }

    .delBtn:hover
    .delAll:hover {
        background-color: #9A572D;
        color: white;
    }

    .tables td, th {
        /* text-align: center; */
        vertical-align: middle;
    }
    a{
        text-decoration: none;
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
                    <input id="searchIp" class="searchIp form-control" type="search" placeholder="Search" aria-label="Search">
                    <button class="searchIpButton search btn btn-outline" type="submit">Search</button>
                </form>
            </div>
            
            <div class="bd-example my-4">
                <form action="boxDelete-api.php" method="post" name="form1">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">
                                    <input type="checkbox" class="checkAll">
                                </th>
                                <th scope="col">#</th>
                                <th scope="col">動物名稱</th>
                                <th scope="col">題目</th>
                                <th scope="col">答案選項</th>
                                <th scope="col">正確/錯誤</th>
                                <th scope="col">對應的題號</th>
                                <th scope="col">圖片</th>
                                <th scope="col"><button  class="delAll btn btn-danger">勾選 <i class="fas fa-trash-alt"></i></button></th>     
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
                                        <button type="button" class="editBtn btn">修改</button>
                                        </a>
                                        <span></span>
                                        <a href="javascript: delete_Alist(<?= $r['question_sid'] ?>)">
                                        <button type="button" class="delBtn btn">刪除</button>
                                        </a>

                                        </td>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                    
                </form> 
                <!-- 分頁按鈕begin -->
            <div class="col-12 mt-4">
                <nav aria-label="...">
                    <ul class="pagination">
                        <!-- 直接到第一頁 -->
                        <li class="page-item <?= $page == 1 ? 'disabled' : '' ?>">
                            <a class="page-link" href="?page=1">
                                <i class="fas fa-angle-double-left"></i>
                            </a>
                        </li>
                        <!-- 到上一頁 -->
                        <li class="page-item <?= $page == 1 ? 'disabled' : '' ?>">
                            <a class="page-link"href="<?php if(isset($_GET['keyword'])){ ?>?keyword=<?= $keyword ?>&page=<?= $page-1 ;}else{ ?>?page=<?= $page-1;}?>">
                                <i class="fas fa-angle-left"></i>
                            </a>
                        </li>
                        <!-- 每一頁的按鈕 -->
                        <?php for($i=$page-2;$i<=$page+2;$i++)
                            if($i>=1 && $i<=$totalPages): ?>
                            <li class="page-item <?= $i==$page ? 'active' : ''?>">
                                <a class="page-link" href="<?= isset($_GET['keyword'])?"?keyword=$keyword&page=$i":"?page=$i"?>">
                                    <?= $i ?> 
                                </a>
                            </li>
                        <?php endif; ?>
                        <!-- 到下一頁 -->
                        <li class="page-item <?= $totalPages == $page ? 'disabled' : ''?>">
                            <a class="page-link" href="<?php if(isset($_GET['keyword'])){ ?>?keyword=<?= $keyword ?>&page=<?= $page+1 ;}else{ ?>?page=<?= $page+1;}?>">
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
    
// delAl 會先確認是否要刪除，
    function delAl() {
        event.preventDefault();
        if (confirm(`確定刪除已勾選的項目?`)) {
            const fd = new FormData(document.form1);
            fetch('boxDelete-api.php',{
                method:'POST',
                body : fd,
            })
            .then(r=>r.json())
            .then(r=>{
                if(r.success){
                    window.location.reload();
                }
            })
        } 
    }
    delAll.addEventListener('click', delAl);
// 對delAll設監聽器，點擊到就做以上的函式
// 以下為查詢功能
    const searchIp = document.querySelector('#searchIp');
    const searchIpButton = document.querySelector('.searchIpButton');
    let str = "";

    function doSearch(){
        event.preventDefault();
        const searchValue = searchIp.value;
        str = searchValue;
        window.location.href = "http://localhost/myTeamWork/gameList.php?keyword=" + str;
    }
    searchIpButton.addEventListener('click',doSearch);

</script>
<?php include __DIR__ . '/parts/__html_foot.php' ?>