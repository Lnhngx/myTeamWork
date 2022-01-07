<?php
session_start();
require __DIR__ . '/parts/__connect_db.php';
// $pageName = 'index';


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
                    <h5 class="card-title">登入</h5>
                    <form name="form_login" onsubmit="doLogin(); return false;">
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">password</label>
                            <input type="password" class="form-control" id="password" name="password">
                            <div class="form-text"></div>
                        </div>
                        


                        <input type="submit" class="subbtn btn btn-primary" value="登入">
                    </form>
                </div>
            </div>
        </div>
    </div>




<?php include __DIR__ . '/parts/__scripts.php' ?>
<script>
    function doLogin(){
        const fd = new FormData(document.form_login);

        fetch('member_login-api.php', {
            method: 'POST',
            body: fd,
        }).then(r=>r.json()).then(obj=>{
            console.log(obj);
            if(obj.success){
                location.href = 'memberList.php';
            } else {
                alert(obj.error);
            }

        });
    }
</script>
<?php include __DIR__ . '/parts/__html_foot.php' ?>