<?php

require __DIR__ . '/parts/__connect_db.php';

$title = '新增商品資訊';
$pageName = 'insert';
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



    /* ------- */
    .imgg-unit {
        position: relative;
        display: inline-block;
    }

    .imgg-unit>img {
        width: 200px;
    }

    .imgg-unit>.dell-div {
        position: absolute;
        right: 0;
        top: 0;
        cursor: pointer;
    }
</style>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">新增商品資料</h5>
                    <form name="form1" onsubmit="sendData();return false;">
                        <div class="mb-3">
                            <label for="name" class="form-label">商品名稱</label>
                            <input type="text" class="form-control" id="name" name="name">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="type" class="form-label">商品類型</label>
                            <input type="text" class="form-control" id="type" name="type">
                            <!-- <select class="form-select" aria-label="Default select example">
                                <option selected>選擇商品類型</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select> -->
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="spec" class="form-label">商品規格</label>
                            <input type="text" class="form-control" id="spec" name="spec">
                            <!-- <select class="form-select" aria-label="Default select example">
                                <option selected>選擇商品規格</option>
                                <option value="<?= $r['sid'] ?>"><?= $r['sid'] ?></option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select> -->
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="supp" class="form-label">供應商</label>
                            <input type="text" class="form-control" id="supp" name="supp">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="reserve" class="form-label">庫存訊息</label>
                            <input type="text" class="form-control" id="reserve" name="reserve">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="money" class="form-label">商品價格</label>
                            <input type="text" class="form-control" id="money" name="money">
                            <div class="form-text"></div>
                        </div>

                        <div class="mb-3">
                            <label for="picture" class="form-label">商品圖片預覽</label>
                            <form name="form2" onsubmit="return false;" style="display:none">
                                <input id="sel_file" type="file" name="myfiles[]" multiple accept="image/*">
                            </form>
                            <br>
                            <button type="button" onclick="sel_file.click()">上傳圖片</button>
                            <div id="imgggs">
                            </div>
                            <img src="" id="myimggg">
                        </div>
                        <div class="mb-3">
                            <label for="d-date" class="form-label">更新時間</label>
                            <input type="date" class="form-control" id="d-date" name="d-date">
                            <div class="form-text"></div>
                        </div>
                        <input type="submit" class="subbtn btn btn-primary" value="確認送出">
                    </form>
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
</div>


<?php include __DIR__ . '/parts/__scripts.php' ?>
<script>
    // ----------------------------------------------------------------
    const sel_file = document.querySelector('#sel_file');
    const imgsDiv = document.querySelector('#imgggs');
    sel_file.style.visibility = "hidden";
    // 讓input按鈕消失
    let imgData = [];

    function imgUnitTpl(file) {
        return ` <div class="imgg-unit" data-file="${file}">
            <img src="uploaded/${file}" alt="">
            <div class="dell-div">
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
            const filename = t.closest('.imgg-unit').getAttribute('data-file');
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
        const fd = new FormData(document.form2);
        fetch('product_upload.php', {
            method: 'POST',
            body: fd
        }).then(r => r.json()).then(obj => {
            console.log(obj);
            if (obj.success) {
                imgData.push(...obj.files);
                renderImgs();
            } else {
                alert(obj.error);
            }
        });
    }
</script>
<?php include __DIR__ . '/parts/__html_foot.php' ?>