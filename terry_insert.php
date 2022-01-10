<?php
require __DIR__ . '/parts/__connect_db.php';
// require __DIR__ . '/parts/__nolog.php';

$title = '新增活動資料';
$pageName = 'insert';



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
</style>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">新增活動資料</h5>

                    <form name="form1" onsubmit="sendData(); return false;">
                        <input type="hidden" name="sid" value="<?= $row['sid'] ?>">
                        <div class="mb-3">
                            <label for="actName" class="form-label">活動名稱</label>
                            <input type="text" class="form-control" id="actName" name="actName">
                            <div class="form-text"></div>
                        </div>

                        <div class="mb-3">
                            <label for="actTime_start" class="form-label">開始時間</label>
                            <input type="datetime-local" class="form-control" id="actTime_start" name="actTime_start">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="actTime_end" class="form-label">結束時間</label>
                            <input type="datetime-local" class="form-control" id="actTime_end" name="actTime_end">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="reserPeop" class="form-label">已預約人數</label>
                            <input type="text" class="form-control" id="reserPeop" name="reserPeop">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="introduce" class="form-label">活動簡介</label>
                            <textarea class="form-control" name="introduce" id="introduce" cols="30" rows="3"></textarea>

                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="location" class="form-label">活動位置</label>
                            <textarea class="form-control" name="location" id="location" cols="30" rows="1"></textarea>

                            <div class="form-text"></div>
                        </div>

                        <button type="submit" class="btn btn-primary">新增</button>

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
    const actName = document.querySelector('#actName');
    const actTime_start = document.querySelector('#actTime_start');
    const actTime_end = document.querySelector('#actTime_end');
    const reserPeop = document.querySelector('#reserPeop');
    const reserPeop_re = /^\d+$/;
    const introduce = document.querySelector('#introduce');
    const locat = document.querySelector('#location');


    const modal = new bootstrap.Modal(document.querySelector('#exampleModal'));

    function sendData() {

        actName.nextElementSibling.innerHTML = '';
        // actTime_start.nextElementSibling.innerHTML = '';
        // actTime_end.nextElementSibling.innerHTML = '';
        reserPeop.nextElementSibling.innerHTML = '';
        // introduce.nextElementSibling.innerHTML = '';
        // location.nextElementSibling.innerHTML = '';

        let isPass = true;
        // 檢查表單的資料
        if (actName.value.length < 2) {
            isPass = false;
            actName.nextElementSibling.innerHTML = '請輸入正確的資訊';
        }

        if (reserPeop.value && !reserPeop_re.test(reserPeop.value)) {
            isPass = false;
            reserPeop.nextElementSibling.innerHTML = '請輸入正確的人數';
        }




        if (isPass) {
            const fd = new FormData(document.form1);

            fetch('terry_insert_api.php', {
                    method: 'POST',
                    body: fd,
                }).then(r => r.json())
                .then(obj => {
                    console.log(obj);
                    if (obj.success) {
                        alert('新增成功');
                        location.href = 'terry_animal_touch.php';
                    } else {

                        document.querySelector('.modal-body').innerHTML = obj.error || '資料新增發生錯誤';
                        modal.show();
                    }
                })
        }

    }
</script>
<?php include __DIR__ . '/parts/__html_foot.php' ?>