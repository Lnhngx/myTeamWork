<?php

require __DIR__ . '/parts/__connect_db.php';
$title = '修改資料';
if (! isset($_GET['sid'])) {
    header("Location: memberList.php");
    exit;
}
// 沒有此會員sid就回到列表

$sid = intval($_GET['sid']);
$row = $pdo->query("SELECT * FROM `members` WHERE sid=$sid")->fetch();
if (empty($row)) {
    header("Location: memberList.php");
    exit;
}
?>

<?php include __DIR__ . '/parts/__html_head.php' ?>
<?php include __DIR__ . '/parts/__sidebar.php' ?>
<?php include __DIR__ . '/parts/__navbar.php' ?>
<div class="container">
    <div class="row">
        <div class="col-6 mx-auto mt-3">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title text-center">修改會員基本資料</h3>

                    <form name="form_member" onsubmit="sendData(); return false;">
                        <input type="hidden" name="sid" value="<?= $row['sid'] ?>">
                        <div class="mb-3">
                            <label for="email" class="form-label">Account (Email)</label>
                            <input type="text" class="form-control" id="email" name="email" value="<?= $row['email'] ?>">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?= htmlentities($row['name']) ?>">
                            <div class="form-text"></div>
                            <!-- 將所有適用的字符轉換為 HTML 實體 -->
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="text" class="form-control" id="password" name="password" value="<?= htmlentities($row['password']) ?>">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="mobile" class="form-label">Mobile</label>
                            <input type="text" class="form-control" id="mobile" name="mobile" data-pattern="09\d{2}-?\d{3}-?\d{3}" value="<?= $row['mobile'] ?>">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="birthday" class="form-label">Birthday</label>
                            <input type="date" class="form-control" id="birthday" name="birthday" value="<?= $row['birthday'] ?>">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <textarea name="address" id="address" cols="30" rows="3"><?= htmlentities($row['address']) ?></textarea>
                            <div class="form-text"></div>
                        </div>
                        <?php /*
                        <div class="mb-3">
                            <label for="grade_sid" class="form-label">Grade</label>
                            <br>
                            <input type="radio" name="grade_sid" value="<?= $row['grade_sid'] ?>">一般
                            <input type="radio" name="grade_sid" value="<?= $row['grade_sid'] ?>">黃金
                            <input type="radio" name="grade_sid" value="<?= $row['grade_sid'] ?>">白金
                            <input type="radio" name="grade_sid" value="<?= $row['grade_sid'] ?>">鑽石
                            <div class="form-text"></div>
                        </div>
                        */ ?>

                        <button type="submit" class="btn btn-primary">修改</button>
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
    const email = document.querySelector('#email');
    const name = document.querySelector('#name');
    const mobile = document.querySelector('#mobile');
    const password = document.querySelector('#password');

    const modal = new bootstrap.Modal(document.querySelector('#exampleModal'));

    const email_re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
    const mobile_re = /^09\d{2}-?\d{3}-?\d{3}$/;

    function sendData() {
        email.nextElementSibling.innerHTML = '';
        name.nextElementSibling.innerHTML = '';
        mobile.nextElementSibling.innerHTML = '';
        password.nextElementSibling.innerHTML = '';

        let isPass = true;
        // 檢查
        if (email.value && !email_re.test(email.value)) {
            isPass = false;
            email.nextElementSibling.innerHTML = '請輸入正確的email';
        }
        if (name.value.length < 2) {
            isPass = false;
            name.nextElementSibling.innerHTML = '請輸入正確的姓名';
        }
        if (mobile.value && !mobile_re.test(mobile.value)) {
            isPass = false;
            mobile.nextElementSibling.innerHTML = '請輸入正確的手機號碼';
        }
        if (password.value.length < 5) {
            isPass = false;
            password.nextElementSibling.innerHTML = '請輸入密碼';
        }


        if (isPass) {
            const fd = new FormData(document.form_member);

            fetch('editMember-api.php', {
                    method: 'POST',
                    body: fd,
                }).then(r => r.json())
                .then(obj => {
                    if (obj.success) {
                        alert('修改成功');
                        location.href = 'memberList.php';
                    } else {
                        document.querySelector('.modal-body').innerHTML = obj.error || '資料修改發生錯誤';
                        modal.show();
                    }
                })
        }

    }
</script>

<?php include __DIR__ . '/parts/__html_foot.php' ?>