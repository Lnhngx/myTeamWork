<?php
require __DIR__ . '/parts/__connect_db.php';
$title = '住宿資訊';
$pageName = 'room-list';

$perPage = 7;

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
if ($page < 1) {
    header('Location: room_list.php');
    exit;
}
$t_sql = "SELECT COUNT(1) FROM `room-detail`";

if (isset($_GET['keyword'])) {
    $t_sql = $t_sql . " WHERE `room-name` LIKE '%" . $keyword . "%' OR `room-introduction` LIKE '%" . $keyword . "%' OR `people` LIKE '%" . $keyword . "%' OR `price` LIKE '%" . $keyword . "%' OR `check-in-data` LIKE '%" . $keyword . "%' OR `check-out-data` LIKE '%" . $keyword . "%' OR `check-in-status` LIKE '%" . $keyword . "%' ";
}

$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];
$totalPages = ceil($totalRows / $perPage);
if ($page > $totalPages) {
    header('Location: room_list.php?page=' . $totalPages);
    exit;
}
$mySqlVar = isset($_GET['keyword']) ? " WHERE `room-name` LIKE '%" . $keyword . "%' OR `room-introduction` LIKE '%" . $keyword . "%' OR `people` LIKE '%" . $keyword . "%' OR `price` LIKE '%" . $keyword . "%' OR `check-in-data` LIKE '%" . $keyword . "%' OR `check-out-data` LIKE '%" . $keyword . "%' OR `check-in-status` LIKE '%" . $keyword . "%'" : "";

$sql = sprintf("SELECT * FROM `room-detail` %s LIMIT %s , %s", $mySqlVar, ($page - 1) * $perPage, $perPage);


$sql = sprintf("SELECT * FROM `room-detail` ORDER BY sid DESC LIMIT %s,%s", ($page - 1) * $perPage, $perPage);

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
    .myimg {
        width: 100px;
    }
</style>
<div class="wrap">
    <div class="container my-3">
        <div class="row">
            <div class="col-6 d-flex" style="justify-content:flex-start;"><a href="./ning_room_insert.php" class="<?= $pageName == 'room-insert' ? 'active disable' : '' ?>"><button type="button" class="insert btn btn-outline active" id="btn">新增</button></a></div>
            <div class="col-3 d-flex" style="justify-content:flex-end;">
                <form class="d-flex">
                    <input class="light-table-filter" type="search" placeholder="請輸入關鍵字" aria-label="Search" data-table="order-table">

                    <button class="search btn btn-outline" type="submit">Search</button>
                </form>
            </div>
            <div class="bd-example my-5">
                <form action="">
                <table class="table table-hover order-table">
                    <thead>
                        <tr>
                            <th scope="col">
                                <input type="checkbox" class="checkAll">
                            </th>
                            <th scope="col">sid</th>
                            <th scope="col">房型</th>
                            <th scope="col">房間照片</th>
                            <th scope="col">房間資訊</th>
                            <th scope="col">人數</th>
                            <th scope="col">價錢</th>
                            <th scope="col">入住時間</th>
                            <th scope="col">退房時間</th>
                            <th scope="col">房間狀態</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rows as $r) : ?>
                            <tr class="tables">
                                <th scope="col">
                                    <input class="check" type="checkbox" value="<?= $r['sid'] ?>" name="checkbox[]">
                                </th>
                                <th scope="row"><?= $r['sid'] ?></th>
                                <td><?= $r['room-name'] ?></td>
                                <td><img src="room-uploaded/<?= $r['room-image'] ?>" alt="" id="myimg" class="myimg"></td>
                                <td><?= htmlentities($r['room-introduction']) ?></td>
                                <td><?= $r['people'] ?></td>
                                <td><?= $r['price'] ?></td>
                                <td><?= $r['check-in-data'] ?></td>
                                <td><?= $r['check-out-data'] ?></td>
                                <td><?= $r['check-in-status'] ?></td>
                                <?php /*
                            <td><?= $r['check-in-data'] ?></td>
                            <td><?= $r['check-out-data'] ?></td>
                            <td><?= $r['check-in-status'] ?></td>
                            */ ?>
                                <td>
                                    <a href="ning_room_edit.php?sid=<?= $r['sid'] ?>"><button type="button" class="editBtn btn btn-outline">修改</button></a>
                                    <a href="ning_delete.php?sid=<?= $r['sid'] ?>" onclick="return confirm('確定要刪除這筆編號<?= $r['sid'] ?>的資料嗎？')">
                                        <!-- <a href="javascript: delete_sid(<?= $r['sid'] ?>)"> -->
                                        <button type="button" class="delBtn btn btn-outline">刪除</button>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                    </tbody>

                </table>
                <button type="button" class="delBtn btn btn-outline">刪除</button>
                </form>
                <div class="col">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item <?= 1 == $page ? 'disabled' : ''; ?>"><a class="page-link" href="?page=1"><i class="fas fa-angle-double-left"></i></a></li>
                            <li class="page-item <?= 1 == $page ? 'disabled' : ''; ?>"><a class="page-link" href="?page=<?= $page - 1 ?>"><i class="fas fa-angle-left"></i></a></li>

                            <?php for ($i = $page - 2; $i <= $page + 2; $i++)
                                if ($i >= 1 && $i <= $totalPages) :
                            ?>
                                <li class="page-item <?= $i == $page ? 'active' : '' ?>"><a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a></li>
                                <!-- 連結用變數去帶 -->
                            <?php endif; ?>
                            <!-- for迴圈 -->
                            <li class="page-item <?= $totalPages == $page ? 'disabled' : ''; ?>"><a class="page-link" href="?page=<?= $page + 1 ?>"><i class="fas fa-angle-right"></i></a></li>
                            <li class="page-item <?= $totalPages == $page ? 'disabled' : ''; ?>"><a class="page-link" href="?page=9999"><i class="fas fa-angle-double-right"></i></a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

    </div>

</div>

<?php include __DIR__ . '/parts/__scripts.php' ?>
<!-- <script>
    function delete_sid(sid){
        if(confirm(`確定要刪除這筆編號 ${sid} 的資料嗎？`)){
            location.href = `ning_delete.php?sid=${sid}`;
        }
    }
</script> -->

<script>
    const checkAll = document.querySelector('.checkAll');
    const check = document.querySelectorAll('.check');
    checkAll.addEventListener('change', function() {
        if (checkAll.checked == true) {
            check.forEach(el => el.checked = true);
        } else {
            check.forEach(el => el.checked = false)
        }
    })

    const searchIp = document.getElementById('searchIp');
    const searchIpButton = document.querySelector('.searchIpButton');
    let str = '';

    function searchTest(value) {
        event.preventDefault();
        const searchIpValue = searchIp.value;
        str = searchIpValue;
        window.location.href = "http://localhost/myTeamWork/room_list.php?keyword=" + str;
    }
    searchIpButton.addEventListener('click', searchTest);



    //     (function (document) {
    //     'use strict';

    //     // 建立 LightTableFilter
    //     var LightTableFilter = (function (Arr) {

    //         var _input;

    //         // 資料輸入事件處理函數
    //         function _onInputEvent(e) {
    //             _input = e.target;
    //             var tables = document.getElementsByClassName(_input.getAttribute('data-table'));
    //             Arr.forEach.call(tables, function (table) {
    //                 Arr.forEach.call(table.tBodies, function (tbody) {
    //                     Arr.forEach.call(tbody.rows, _filter);
    //                 });
    //             });
    //         }

    //         // 資料篩選函數，顯示包含關鍵字的列，其餘隱藏
    //         function _filter(row) {
    //             var text = row.textContent.toLowerCase(), val = _input.value.toLowerCase();
    //             row.style.display = text.indexOf(val) === -1 ? 'none' : 'table-row';
    //         }
    //         return {
    //             // 初始化函數
    //             init: function () {
    //                 var inputs = document.getElementsByClassName('light-table-filter');
    //                 Arr.forEach.call(inputs, function (input) {
    //                     input.oninput = _onInputEvent;
    //                 });
    //             }
    //         };
    //     })(Array.prototype);

    //     // 網頁載入完成後，啟動 LightTableFilter
    //     document.addEventListener('readystatechange', function () {
    //         if (document.readyState === 'complete') {
    //             LightTableFilter.init();
    //         }
    //     });

    // })(document);
    (function(document) {

        'use strict';
        // 建立 LightTableFilter
        var LightTableFilter = (function(Arr) {

            var _input;

            // 資料輸入事件處理函數
            function _onInputEvent(e) {
                _input = e.target;
                var tables = document.getElementsByClassName(_input.getAttribute('data-table'));
                Arr.forEach.call(tables, function(table) {
                    Arr.forEach.call(table.tBodies, function(tbody) {
                        Arr.forEach.call(tbody.rows, _filter);
                    });
                });
            }

            // 資料篩選函數，顯示包含關鍵字的列，其餘隱藏
            function _filter(row) {
                var text = row.textContent.toLowerCase(),
                    val = _input.value.toLowerCase();
                row.style.display = text.indexOf(val) === -1 ? 'none' : 'table-row';
            }

            return {
                // 初始化函數
                init: function() {
                    var inputs = document.getElementsByClassName('light-table-filter');
                    Arr.forEach.call(inputs, function(input) {
                        input.oninput = _onInputEvent;
                    });
                }
            };
        })(Array.prototype);

        // 網頁載入完成後，啟動 LightTableFilter
        document.addEventListener('readystatechange', function() {
            if (document.readyState === 'complete') {
                LightTableFilter.init();
            }
        });

    })(document);
</script>
<?php include __DIR__ . '/parts/__html_foot.php' ?>