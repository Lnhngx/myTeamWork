<?php require __DIR__ . '/parts/__connect_db.php';
$title = '新增住宿資訊';
$pageName = 'room-insert';

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

    .card-title {
        color: #2f4f4f;
    }

    .form-text {
        color: #f00;
    }
</style>


<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">新增房間資訊</h4>
                    <form name="form1" onsubmit="sendData();return false;">
                        <div class="mb-3">
                            <label for="room-name" class="form-label">房間類別</label>
                            <br>
                            <select name="room-name">
                                <option value="海洋房">海洋房</option>
                                <option value="熱帶雨林房">熱帶雨林房</option>
                                <option value="夜行房">夜行房</option>
                                <option value="冰原房">冰原房</option>
                            </select>
                            <!-- <input type="text" class="form-control" id="room-name" name="room-name" required> -->
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="people" class="form-label">房間人數</label>
                            <br>
                            <select name="people">
                                <option value="2">2</option>
                                <option value="4">4</option>
                                <option value="6">6</option>
                            </select>
                            <!-- <input type="text" class="form-control" id="people" name="people"> -->
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">房間價錢</label>
                            <br>
                            <select name="price">
                                <option value="2200">2200</option>
                                <option value="3800">3800</option>
                                <option value="5800">5800</option>
                            </select>
                            <!-- <input type="text" class="form-control" id="price" name="price"> -->
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="check-in-data" class="form-label">入住時間</label>
                            <input type="date" class="form-control" id="check-in-data" name="check-in-data">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <div class="mb-3">
                                <label for="check-out-data" class="form-label">退房時間</label>
                                <input type="date" class="form-control" id="check-out-data" name="check-out-data">
                                <div class="form-text"></div>
                            </div>
                            <div class="mb-3">
                                <label for="check-in-status" class="form-label">房間狀態</label>
                                <br>
                                <select name="check-in-status">
                                    <option value="未入住未付款">未入住未付款</option>
                                    <option value="已付款未入住">已付款未入住</option>
                                    <option value="已入住已付款">已入住已付款</option>
                                </select>
                                <div class="form-text"></div>
                            </div>
                            <div class="mb-3">
                                <label for="room-introduction" class="form-label">房型資訊</label>
                                <textarea class="form-control" name="room-introduction" id="room-introduction" cols="30" rows="3"></textarea>
                                <div class="form-text"></div>
                            </div>
                            <!-- <input type="submit" class="subbtn btn btn-primary" value="確認送出"> -->
                    </form>
                    <div class="mb-3">
                        <form action="ning_room_image_upload.php" method="post" enctype="multipart/form-data">
                            <input type="file" name="myfile" accept="image/*">
                            <!-- multiple -->
                            <input type="submit">
                        </form>
                        <!-- <label for="room-image" class="form-label">房間照片</label>
                        <button type="button" onclick="">上傳</button>
                        <br>
                        <img src="./pic/alpha-lion-3.png" class="card-img-top" alt="..." style="width:200px"> -->

                    </div>

                    <button type="submit" class="subbtn btn btn-primary">確認送出</button>
                    <!-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    </div> -->

                </div>
            </div>
        </div>
    </div>

    <?php include __DIR__ . '/parts/__scripts.php' ?>

    <script>
        const room_introduction = document.querySelector('#room-introduction');
        const check_in_data = document.querySelector('#check-in-data');
        const check_out_data = document.querySelector('#check-out-data');
        // const modal = new bootstrap.Model(document.querySelector('#exampleModal'));

        function sendData() {

            room_introduction.nextElementSibling.innerHTML = "";
            check_in_data.nextElementSibling.innerHTML = "";
            check_out_data.nextElementSibling.innerHTML = "";

            //檢查表單的資料
            let isPass = true;
            if (room_introduction.value.length < 1) {
                isPass = false;
                room_introduction.nextElementSibling.innerHTML = "請輸入資訊";
            }
            if (check_in_data.value.length == 0) {
                isPass = false;
                check_in_data.nextElementSibling.innerHTML = "請選擇入住日期";
            }
            if (check_out_data.value.length == 0) {
                isPass = false;
                check_out_data.nextElementSibling.innerHTML = "請選擇退房日期";
            }

            if (isPass) {
                const fd = new FormData(document.form1)

                fetch('ning_room_insert-api.php', {
                        method: 'POST',
                        body: fd,
                    }).then(r => r.json())
                    .then(obj => {
                        if (obj.success) {
                            alert('新增住宿資訊成功!');
                            location.href = 'room_list.php';
                        } else {
                            // const msg = obj.error;
                            // document.querySelector('.modal-body').innerHTML = msg;
                            // modal.show();
                            alert(obj.error);
                        }
                    })
            }
        }
    </script>

    <?php include __DIR__ . '/parts/__html_foot.php' ?>