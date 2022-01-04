<?php

require __DIR__ . '/parts/__connect_db.php';

$title = '修改商品訊息';

if (!isset($_GET['sid'])) {
    header('Location: product_page01.php');
    exit;
}

$sid = intval($_GET['sid']);
$row = $pdo->query("SELECT * FROM `商品訊息` WHERE sid=$sid")->fetch();
if (empty($row)) {
    header('Location: product_page01.php');
    exit;
}





?>
<?php include __DIR__ . '/parts/__html_head.php' ?>
<?php include __DIR__ . '/parts/__sidebar.php' ?>
<style>
    .container {
        position: absolute;
        right: 0;
        width: calc(100% - 250px);
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
                    <h5 class="card-title">修改通訊資料</h5>
                    <!-- `name`,`email`,`mobile`,`birthday`,`address` -->
                    <form name="form1" onsubmit="sendData();return false;">
                        <input type="hidden" name="sid" value="<?= $row['sid'] ?>" />
                        <div class="mb-3">
                            <label for="name" class="form-label">name *</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?= htmlentities($row['name']) ?>">
                            <!-- required必填 -->
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?= $row['email'] ?>">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="mobile" class="form-label">mobile</label>
                            <input type="text" class="form-control" id="mobile" name="mobile" value="<?= $row['mobile'] ?>">
                            <!-- 有下patten要符合格式 -->
                            <!-- data-開頭的不會有效果,是自定的,所以保留沒問題 data-pattern="09\d{2}-?\d{3}-?\d{3}"-->
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="birthday" class="form-label">birthday</label>
                            <input type="date" class="form-control" id="birthday" name="birthday" value="<?= $row['birthday'] ?>">
                            <!-- datetime-local會包含時間 -->
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">address</label>
                            <textarea class="form-control" name="address" id="address" cols="30" rows="3"><?= $row['address'] ?></textarea>
                            <div class="form-text"></div>
                        </div>
                        <!-- 表單裡面的button預設是submit,記得要下type="button",才不會送出資料,表單外不會影響 -->
                        <input type="submit" class="btn btn-primary" value="送出">
                    </form>
                </div>
            </div>
        </div>
    </div>





    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">修改通訊資料</h5>
                        <form name="form1" onsubmit="sendData();return false;">
                            <input type="hidden" name="sid" value="<?= $row['sid'] ?>" />
                            <div class="mb-3">
                                <label for="name" class="form-label">name *</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?= htmlentities($row['name']) ?>">
                                <div class="form-text"></div>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?= $row['email'] ?>">
                                <div class="form-text"></div>
                            </div>
                            <div class="mb-3">
                                <label for="mobile" class="form-label">mobile</label>
                                <input type="text" class="form-control" id="mobile" name="mobile" value="<?= $row['mobile'] ?>">
                                <div class="form-text"></div>
                            </div>
                            <div class="mb-3">
                                <label for="birthday" class="form-label">birthday</label>
                                <input type="date" class="form-control" id="birthday" name="birthday" value="<?= $row['birthday'] ?>">
                                <div class="form-text"></div>
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">address</label>
                                <textarea class="form-control" name="address" id="address" cols="30" rows="3"><?= $row['address'] ?></textarea>
                                <div class="form-text"></div>
                            </div>
                            <div class="mb-3">
                                <label for="picture" class="form-label">picture</label>
                                <button onclick="">上傳</button>
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


    <?php include __DIR__ . '/parts/__scripts.php' ?>
    <script>
        const name = document.querySelector('#name');
        const email = document.querySelector('#email');
        const mobile = document.querySelector('#mobile');

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

                fetch('product_page01_edit-api.php', {
                        //資料發送到這裡
                        method: 'POST',
                        // 預設是GET（沒有body,因為會未給檔頭）所以POST要給body
                        body: fd,
                    }).then(r => r.json())
                    //回來的資料是json
                    .then(obj => {
                        console.log(obj);
                        if (obj.success) {
                            alert('修改成功');
                            //location.href = 'list copy 8.php';
                        } else {
                            document.querySelector('.modal-body').innerHTML = obj.error || '修改資料發生錯誤';
                            modal.show();
                        }
                    })
            };
        }
    </script>
    <?php include __DIR__ . '/parts/__html_foot.php' ?>