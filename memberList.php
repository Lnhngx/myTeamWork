<?php

require __DIR__ . '/parts/__connect_db.php';
$pageName = 'index';
$title = '會員資料列表';
$pageName = 'memberList';

$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
// 搜尋欄位
if (!isset($_SESSION['users'])) {
    header("Location: login.php");
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
$t_sql = "SELECT COUNT(1) FROM `members` JOIN `grade` ON `members`.`grade_sid`=`grade`.`grade_sid`";
// 資料筆數
// SELECT * FROM `members` LEFT JOIN `grade` ON `grade`.`grade_sid`=`members`.`grade_sid`
if (isset($_GET['keyword'])) {
    $t_sql = $t_sql . "WHERE email LIKE '%" . $keyword . "%' ";
}
// 如果有關鍵字
$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];
$totalPages = ceil($totalRows / $perpage);
if ($page > $totalPages) {
    header('Location: memberList.php?page=' . $totalPages);
    exit;
}

// $sql = sprintf("SELECT * FROM members ORDER BY sid DESC LIMIT %s, %s", ($page - 1) * $perpage, $perpage);
// $sql = sprintf("SELECT * 
//                     FROM `members` m
//                     LEFT JOIN `grade` g
//                     ON m.`grade_sid`=g.`grade_sid`
//                     ORDER BY m.`sid` DESC 
//                     LIMIT %s, %s", ($page - 1) * $perpage, $perpage);
$sqlsch = isset($_GET['keyword']) ? "WHERE `email` LIKE '%" . $keyword . "%'" : '';
// SELECT * FROM `members` LEFT JOIN `grade` ON `grade`.`grade_sid`=`members`.`grade_sid` WHERE `mobile` LIKE '%4%' ORDER BY `sid` DESC LIMIT 5,5
$sql = sprintf("SELECT * FROM `members` LEFT JOIN `grade` ON `grade`.`grade_sid`=`members`.`grade_sid` %s ORDER BY `sid` DESC LIMIT %s,%s", $sqlsch, ($page - 1) * $perpage, $perpage);

$rows = $pdo->query($sql)->fetchAll();


?>

<?php include __DIR__ . '/parts/__html_head.php' ?>
<?php include __DIR__ . '/parts/__sidebar.php' ?>

<style>
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
    .delAllBtn,
    .delBtn {
        color: white;
    }

    .delBtn,
    .delAllBtn {
        background-color: #C82C2C;
    }

    .delAllBtn:hover,
    .delBtn:hover {
        background-color: #9A572D;
        color: white;
    }

    .tables td,
    th {
        /* text-align: center; */
        vertical-align: middle;
    }

    .myimg {
        width: 100px;
    }

    .introduction {
        width: 250px;
    }
</style>
<div class="wrap">
    <div class="container my-3">
        <div class="row">
            <div class="col-3 d-flex" style="justify-content: flex-start;"><button onclick="insertMember()" type="button" class="insert btn btn-outline" id="btn">新增</button></div>
            <div class="col-3 d-flex" style="justify-content:flex-end;">
                <form class="d-flex">
                    <input id="searchIp" class="searchIp light-table-filter" type="search" placeholder="請輸入搜尋關鍵字" aria-label="Search">

                    <button class="searchIpButton search btn btn-outline" type="button">Search</button>
                </form>
            </div>
            <div class="col-12">
                <div class="col">
                    <nav aria-label="...">
                        <ul class="pagination d-flex justify-content-end mb-0 mt-2">
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
                                    <a class="page-link" href="<?= isset($_GET['keyword']) ? "?keyword=$keyword&page=$i" : "?page=$i" ?>"><?= $i ?></a>
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

            <div class="bd-example mb-5 mt-3">
                <form action="deleteAll_member-api.php" method="post" name="form1">
                    <!-- 表單送出會到 deleteAll_member-api -->
                    <table class="table table-hover">
                        <!-- search bar 語法-->
                        <thead>
                            <tr>
                                <th>
                                    <input id="ckbAll" class="ckbAll" type="checkbox" value="<?= $r['sid'] ?>">
                                    <label for="ckbAll">全選</label>
                                </th>
                                <!-- 勾選 -->
                                <th scope="col">#</th>
                                <th scope="col">電子郵件</th>
                                <th scope="col">姓名</th>
                                <th scope="col">密碼</th>
                                <th scope="col">手機</th>
                                <th scope="col">生日</th>
                                <th scope="col">地址</th>
                                <th scope="col">等級</th>

                                <th scope="col">
                                    <button type="submit" class="delAllbtn btn btn-outline-dange">
                                        勾選 <i class="fas fa-trash-alt"></i>
                                    </button>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($rows as $r) : ?>
                                <tr class="tables">
                                    <td>
                                        <input id="del" class="del" type="checkbox" name="checkbox[]" value="<?= $r['sid'] ?>">
                                    </td>
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
                                        <a href="editMember.php?sid=<?= $r['sid'] ?>" style="text-decoration: none;">
                                            <button type="button" class="editBtn btn btn-outline">修改</button>
                                        </a>
                                        <!-- 修改 -->
                                        <a href="javascript: delete_member(<?= $r['sid'] ?>)">
                                            <button type="button" class="delBtn btn btn-outline">刪除</button>
                                        </a>
                                        <!-- <button onclick="delete_member(<?= $r['sid'] ?>)" type="button" class="delBtn btn btn-outline">刪除</button> -->
                                        <!-- 刪除 -->
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                        </tbody>

                    </table>
                </form>
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

    function insertMember() {
        location.href = `insertMember.php`;
    }

    const ckbAll = document.querySelector('.ckbAll');
    const del = document.querySelectorAll('.del');
    ckbAll.addEventListener('click', function() {
        if (ckbAll.checked == true) {
            del.forEach(el => el.checked = true);
        } else {
            del.forEach(el => el.checked = false)
        }
    })
    // 如果第一個checkbox已選，其他全選


    const delAllbtn = document.querySelector('.delAllbtn');
    delAllbtn.addEventListener('click', delAll);

    function delAll() {
        event.preventDefault();
        // 先將表單+按鈕預設的submit關閉，下方再以傳送至後端的方式去執行
        const fd = new FormData(document.form1);
        fetch('deleteAll_member-api.php', {
            method: 'POST',
            body: fd,
        }).then(r => r.json()).then(obj => {
            if (obj.success) {
                if (confirm(`確定刪除已勾選的項目?`)) {
                    window.location.reload();
                }
            }
        });

    }


    const searchIp = document.querySelector('#searchIp');
    const searchIpButton = document.querySelector('.searchIpButton');
    let str = '';


    function searchTest(v) {
        event.preventDefault();
        const searchIpValue = searchIp.value;
        str = searchIpValue;
        window.location.href = "http://localhost/myTeamWork/memberList.php?keyword=" + str;
    }
    searchIpButton.addEventListener('click', searchTest);
</script>
<?php include __DIR__ . '/parts/__html_foot.php' ?>