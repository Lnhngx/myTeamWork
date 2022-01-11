<?php
require __DIR__. '/parts/__connect_db.php';

//沒有登入管理帳號,就轉向
// if(! isset($_SESSION['admin'])){
//    header('Location: jerry_no_admin_index_.php');
//    exit;
// }

$title = '修改資料';

if(! isset($_GET['sid'])) {
    header('Location: insertMember.php');
    exit;
}

$sid = intval($_GET['sid']);
$row = $pdo->query("SELECT * FROM `address_1` WHERE sid=$sid")->fetch();
if(empty($row)){
    header('Location: insertMember.php');
    exit;
}



?>
<?php include __DIR__. '/parts/__html_head.php' ?>
<?php include __DIR__ . '/parts/__sidebar.php' ?>

<style>
    .container1 {
        width: calc(100% - 250px);
        position: relative;
        left: 250px;
        margin-top: 10px;
        margin-bottom: 20px;
    }
    .card-title{ 
        text-align: center;
        top: 0;
        position: absolute;
        padding: 10px 0;
        width: 100%;
        background-color:  #2f4f4f;
        color: white;
        left: 0;
        border-radius: 5px 5px 0 0;
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

    .subbtn:active {
        background-color: #2f4f4f;
        border-color: #2f4f4f;
        box-shadow:0 0 0 2px #daa520;
    }
    .subbtn:focus {
        background-color: #2f4f4f;
        border-color: #2f4f4f;
        box-shadow:0 0 0 2px #daa520;
    }
    form .form-text {
        color: red;
    }
</style>
<div class="container1 d-flex justify-content-center">
    <!-- <div class="row"> -->
        <div class="col-md-5">
            <div class="card" >
                <div class="card-body">
                    <h5 class="card-title">修改資料</h5>

                    <form name="form1" onsubmit="sendData(); return false;">
                        <input type="hidden" name="sid" value="<?= $row['sid'] ?>">
                        <div class="mb-3">
                            <label for="name" class="form-label">名稱 *</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?= htmlentities($row['name']) ?>">
                            <div class="form-text"></div>
                        </div>
                       <!--     `sid`, `name`, `English_name`, `species`, `	origin`, `birthday`, `remark` -->
                        <div class="mb-3">
                            <label for="English_name" class="form-label">學名</label>
                            <input type="text" class="form-control" id="English_name" name="English_name"
                                   value="<?= $row['English_name'] ?>">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="species" class="form-label">科目</label>
                            <input type="text" class="form-control" id="species" name="species"
                            value="<?= $row['species'] ?>">  <!--data-pattern="09\d{2}-?\d{3}-?\d{3}" -->  
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="origin" class="form-label">分佈</label>
                            <input type="text" class="form-control" id="origin" name="origin"
                                   value="<?= $row['origin'] ?>">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="birthday" class="form-label">生日</label>
                            <input type="date" class="form-control" id="birthday" name="birthday"
                                   value="<?= $row['birthday'] ?>">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="remark" class="form-label">備註</label>
                            <textarea class="form-control" name="remark" id="remark"
                                      cols="30"
                                      rows="3"><?= $row['remark'] ?></textarea>

                            <div class="form-text"></div>
                        </div>

                        <button type="submit" class="subbtn btn btn-primary">修改</button>

                    </form>

                </div>
            </div>

        <!-- </div> -->
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
<!--     `sid`, `name`, `English_name`, `species`, `	origin`, `birthday`, `remark` -->
<?php include __DIR__. '/parts/__scripts.php' ?>
<script>
    const name = document.querySelector('#name');
    const English_name = document.querySelector('#English_name');
    const species = document.querySelector('#species');
    const origin = document.querySelector('#origin');
    const birthday= document.querySelector('#birthday');
    const remark = document.querySelector('#remark');

    const modal = new bootstrap.Modal(document.querySelector('#exampleModal'));

   // const email_re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
   // const mobile_re = /^09\d{2}-?\d{3}-?\d{3}$/;

    function sendData(){

        name.nextElementSibling.innerHTML = '';
        // English_name.nextElementSibling.innerHTML = '';
        // species.nextElementSibling.innerHTML = '';
        // origin.nextElementSibling.innerHTML = '';
        // birthday.nextElementSibling.innerHTML = '';
        // remark.nextElementSibling.innerHTML = '';

        let isPass = true;
        // 檢查表單的資料
        if(name.value.length < 2){
            isPass = false;
            name.nextElementSibling.innerHTML = '請輸入正確的姓名';

        }
        // if(English_name.value && !English_name_re.test(English_name.value)){
        //     isPass = false;
        //     English_name.nextElementSibling.innerHTML = '請輸入正確的email';
        // }
        // if(species.value && !species_re.test(species.value)){
        //     isPass = false;
        //     species.nextElementSibling.innerHTML = '請輸入正確的手機號碼';
        // }






        if(isPass) {
            const fd = new FormData(document.form1);

            fetch('jerry_edit-api.php', {
                method: 'POST',
                body: fd,
            }).then(r => r.json())
                .then(obj => {
                    console.log(obj);
                    if(obj.success){
                        alert('修改成功');
                        location.href = 'jerry_index_.php';
                    } else {

                        document.querySelector('.modal-body').innerHTML = obj.error || '資料修改發生錯誤';
                        modal.show();
                    }
                })
        }

    }



</script>
<?php include __DIR__. '/parts/__html_foot.php' ?>



