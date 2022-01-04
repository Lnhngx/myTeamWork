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
                            <input type="text" class="form-control" id="name" name="name" value="<?= htmlentities($row['商品名稱']) ?>">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">商品類型</label>
                            <input type="text" class="form-control" id="type" name="type" value="<?= htmlentities($row['商品類型']) ?>">
                            <select class="form-select" aria-label="Default select example">
                                <option selected>選擇商品類型</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">商品規格</label>
                            <input type="text" class="form-control" id="spec" name="spec" value="<?= htmlentities($row['商品規格']) ?>">
                            <select class="form-select" aria-label="Default select example">
                                <option selected>選擇商品規格</option>
                                <option value="<?= $r['sid']?>"><?= $r['sid']?></option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">供應商</label>
                            <input type="text" class="form-control" id="supp" name="supp" value="<?= htmlentities($row['供應商']) ?>">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">庫存訊息</label>
                            <input type="text" class="form-control" id="reserve" name="reserve" value="<?= htmlentities($row['庫存訊息']) ?>">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">商品價格</label>
                            <input type="text" class="form-control" id="money" name="money" value="<?= htmlentities($row['商品價格']) ?>">
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
    const name = document.querySelector('#name');
    const type = document.querySelector('#type');
    const spec = document.querySelector('#spec');

    const modal = new bootstrap.Modal(document.querySelector('#exampleModal'));

    const email_re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;

    const mobile_re = /^09\d{2}-?\d{3}-?\d{3}$/;


    function sendData() {


        name.nextElementSibling.innerHTML = '';
        email.nextElementSibling.innerHTML = '';
        mobile.nextElementSibling.innerHTML = '';

        let isPass = true;
        //檢查表單的資料
        if (name.value.length < 2) {
            //如果姓名的value的長度小於2
            isPass = false;
            //如果檢查沒過
            name.nextElementSibling.innerHTML = '請輸入正確姓名';
        }
        if (email.value && !email_re.test(email.value)) {
            //如果有填,而且沒有通過（沒有符合設定的標準）
            isPass = false;
            email.nextElementSibling.innerHTML = '請輸入正確email';
        }

        // if (mobile.value && !mobile_re.test(mobile.value)) {
        //     //如果有填,而且沒有通過
        //     isPass = false;
        //     mobile.nextElementSibling.innerHTML = '請輸入正確手機號碼';
        // }

        // 每個都各自獨立的,所以是單獨的if,沒有else





        if (isPass) {
            const fd = new FormData(document.form1);
            // 會把有效欄位（有下name的）抓進來
            // form標籤有外觀的表單,formdata像是沒有外觀的表單

            fetch('product_page01_insert-api.php', {
                    //資料發送到這裡
                    method: 'POST',
                    // 預設是GET（沒有body,因為會未給檔頭）所以POST要給body
                    body: fd,
                }).then(r => r.json())
                //回來的資料是json
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