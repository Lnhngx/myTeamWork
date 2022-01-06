<?php

require __DIR__ . '/parts/__connect_db.php';

$title = '修改商品訊息';

if (!isset($_GET['sid'])) {
    header('Location: product_page01.php');
    exit;
}

$sid = intval($_GET['sid']);
$row = $pdo->query("SELECT * FROM `product_item` WHERE sid = $sid")->fetch();
if (empty($row)) {
    header('Location: product_page01.php');
    exit;
}

$typesql = 'SELECT `sid`,`type_name`  FROM product_type ORDER BY sid ASC';
$totaltype = $pdo->query($typesql)->fetchAll();

$specsql = 'SELECT * FROM product_spec ORDER BY sid ASC';
$totalspec = $pdo->query($specsql)->fetchAll();

$suppsql = 'SELECT `sid`,`supplier_name`  FROM supplier ORDER BY sid ASC';
$totalsupp = $pdo->query($suppsql)->fetchAll();

$resersql = 'SELECT * FROM product_reserve ORDER BY sid ASC';
$totalreser = $pdo->query($resersql)->fetchAll();


?>
<?php include __DIR__ . '/parts/__html_head.php' ?>
<?php include __DIR__ . '/parts/__sidebar.php' ?>
<style>
    .container {
        width: calc(100% - 250px);
        position: absolute;
        left: 250px;
        margin-top: 20px;
        margin-bottom: 20px;
    }

    .row {
        justify-content: center;
    }

    .subbtn {
        background-color: #2f4f4f;
        border-color: #2f4f4f;
    }

    .subbtn:hover {
        background-color: #908a70;
        border-color: #908a70;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">修改商品資料</h5>
                    <form id="form" name="form" onsubmit="sendData();return false;">
                        <input type="hidden" name="sid" value="<?= $row['sid'] ?>" />
                        <div class="mb-3">
                            <label for="name" class="form-label">商品名稱</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?= ($row['name']) ?>">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="type" class="form-label">商品類型</label>
                            <!-- <input type="text" class="form-control" id="type" name="type"> -->
                            <select class="form-select" aria-label="Default select example" id="type" name="type" value="<?= ($row['type']) ?>">
                                <option value="<?= ($row['type']) ?>"><?= ($row['type']) ?></option>
                                <?php foreach ($totaltype as $r) : ?>
                                    <option value="<?= $r['sid']; ?>"><?php echo $r['sid'];
                                                                        echo '-';
                                                                        echo $r['type_name']; ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="spec" class="form-label">商品規格</label>
                            <!-- <input type="text" class="form-control" id="spec" name="spec"> -->
                            <select class="form-select" aria-label="Default select example" name="spec" value="<?= ($row['specification']) ?>">
                                <option value="<?= ($row['specification']) ?>"><?= ($row['specification']) ?></option>
                                <?php foreach ($totalspec as $c) : ?>
                                    <option value="<?= $c['sid']; ?>"><?= $c['sid']; ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="supp" class="form-label">供應商</label>
                            <!-- <input type="text" class="form-control" id="supp" name="supp"> -->
                            <select class="form-select" aria-label="Default select example" name="supp" value="<?= ($row['supplier']) ?>">
                            <option value="<?= ($row['supplier']) ?>"><?= ($row['supplier']) ?></option>
                                <?php foreach ($totalsupp as $sup) : ?>
                                    <option value="<?= $sup['sid']; ?>"><?php echo $sup['sid'];
                                                                        echo '-';
                                                                        echo $sup['supplier_name']; ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="reserve" class="form-label">庫存訊息</label>
                            <!-- <input type="text" class="form-control" id="reserve" name="reserve"> -->
                            <select class="form-select" aria-label="Default select example" name="reser" value="<?= ($row['information']) ?>">
                                <option value="<?= ($row['information']) ?>"><?= ($row['information']) ?></option>
                                <?php foreach ($totalreser as $re) : ?>
                                    <option value="<?= $re['sid']; ?>"><?= $re['sid']; ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="money" class="form-label">商品價格</label>
                            <input type="text" class="form-control" id="money" name="money" value="<?= ($row['price']) ?>">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="d-date" class="form-label">更新時間</label>
                            <input type="date" class="form-control" id="d-date" name="d-date" value="<?= ($row['create_at']) ?>">
                            <div class="form-text"></div>
                        </div>
                        <input id="innput" type="submit" class="subbtn btn btn-primary" value="確認送出" style="display:none">
                    </form>
                    <div class="mb-3">
                        <label for="picture" class="form-label">商品圖片預覽</label>
                        <form name="form1" onsubmit="return false;" style="display:none">
                            <input id="sel_file" type="file" name="myfiles[]" multiple accept="image/*" name="file">
                        </form>
                        <button type="button" onclick="sel_file.click()">上傳圖片</button>
                        <br>
                        <div id="imgs">
                        </div>
                        <!-- 按鈕放在表單外 -->
                        <img src="" id="myimg">
                    </div>
                    <input type="submit" class="subbtn btn btn-primary" onclick="innput.click()" value="確認送出">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">資料錯誤</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<?php include __DIR__ . '/parts/__scripts.php' ?>
<script>
    const innput = document.querySelector('#innput');
    const modal = new bootstrap.Modal(document.querySelector('#exampleModal'));


    const sel_file = document.querySelector('#sel_file');
    const imgsDiv = document.querySelector('#imgs');
    sel_file.style.visibility = 'hidden';
    let imgData = [];

    function imgUnitTpl(file) {
        return ` <div class="img-unit" data-file="${file}">
            <img src="uploaded/${file}" alt="">
            <div class="del-div">
                <i class="fas fa-times-circle del-icon"></i>
            </div>
        </div>`
    }

    function renderImgs() {
        imgsDiv.innerHTML = '';
        for (let i of imgData) {
            imgsDiv.innerHTML += imgUnitTpl(i);
        }
    }
    imgsDiv.addEventListener('click', function(event) {
        const t = event.target;
        if (t.classList.contains('del-icon')) {
            const filename = t.closest('.img-unit').getAttribute('data-file');
            console.log(filename);
            let loc = imgData.indexOf(filename);
            if (loc !== -1) {
                imgData.splice(loc, 1);
                renderImgs();
            }
        }
    });

    sel_file.addEventListener('change', doUpload);

    function doUpload() {
        const fd = new FormData(document.form1);
        // 表單資料包起來
        fetch('product_upload.php', {
                method: 'POST',
                body: fd
            }).then(r => r.json())
            .then(obj => {
                console.log(obj);
                if (obj.success) {
                    imgData.push(...obj.files);
                    renderImgs();
                } else {
                    alert(obj.error);
                }
            });
    };



    function sendData() {
        const fd = new FormData(document.querySelector('#form'));
        fetch('product_page01_edit-api.php', {
                method: 'POST',
                body: fd,
            }).then(r => r.json())
            .then(obj => {
                console.log(obj);
                if (obj.success) {
                    alert('修改成功');
                    location.href = 'product_page01.php';
                } else {
                    document.querySelector('.modal-body').innerHTML = obj.error || '資料修改發生錯誤';
                    modal.show();
                }
            })
    };
</script>
<?php include __DIR__ . '/parts/__html_foot.php' ?>