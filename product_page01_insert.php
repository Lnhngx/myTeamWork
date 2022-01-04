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
</style>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">新增商品資料</h5>
                    <form name="form1" onsubmit="sendData();return false;">
                        <input type="hidden" name="sid" value="<?= $row['sid'] ?>" />
                        <div class="mb-3">
                            <label for="name" class="form-label">商品名稱</label>
                            <input type="text" class="form-control" id="name" name="name">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">商品類型</label>
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
                            <label for="name" class="form-label">商品規格</label>
                            <input type="text" class="form-control" id="spec" name="spec">
                            <!-- <select class="form-select" aria-label="Default select example">
                                <option selected>選擇商品規格</option>
                                <option value="<?= $r['sid']?>"><?= $r['sid']?></option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select> -->
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">供應商</label>
                            <input type="text" class="form-control" id="supp" name="supp" >
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">庫存訊息</label>
                            <input type="text" class="form-control" id="reserve" name="reserve">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">商品價格</label>
                            <input type="text" class="form-control" id="money" name="money">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="birthday" class="form-label">更新時間</label>
                            <input type="date" class="form-control" id="date" name="date">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="picture" class="form-label">商品圖片</label>
                            <button onclick="upLoad()">上傳</button>
                            <br>
                            <img src="./pic/alpha-lion-3.png" class="card-img-top" alt="..." style="width:200px">
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

</div>
<?php include __DIR__ . '/parts/__scripts.php' ?>
<script>
    const modal = new bootstrap.Modal(document.querySelector('#exampleModal'));

    function sendData() {

        let isPass = true;
    
        if (isPass) {
            const fd = new FormData(document.form1);
            fetch('product_page01_insert-api.php', {
                    method: 'POST',
                    body: fd,
                }).then(r => r.json())
                .then(obj => {
                    console.log(obj);
                    if (obj.success) {
                        alert('新增成功');
                        location.href = 'product_page01.php';
                    } else {
                        document.querySelector('.modal-body').innerHTML = obj.error || '資料新增發生錯誤';
                        modal.show();
                    }
                })
        };
    }
</script>
<?php include __DIR__ . '/parts/__html_foot.php' ?>