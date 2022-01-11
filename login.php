<?php
session_start();
?>

<?php
require __DIR__ . '/parts/__connect_db.php';
$pageName = 'index';
?>
<?php include __DIR__ . '/parts/__html_head.php' ?>
<style>
    @import url(//db.onlinewebfonts.com/c/537002c20f6d3b0765eee34c71fc8062?family=GT+America+Condensed);

    .ALAN-login {
        background-color: #BBBBB9;
        border-radius: 50px;
        height: 700px;
        width: 500px;
    }

    .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
    }

    .ALAN-button {
        background-color: #daa520;
        border: #daa520;
    }

    .ALAN-button:hover {
        background-color: #9a572d;
    }

    @media (min-width: 768px) {
        .bd-placeholder-img-lg {
            font-size: 3.5rem;
        }
    }

    .ALAN-title {
        font-family: "GT America Condensed";
        src: url("//db.onlinewebfonts.com/t/537002c20f6d3b0765eee34c71fc8062.eot");
        src: url("//db.onlinewebfonts.com/t/537002c20f6d3b0765eee34c71fc8062.eot?#iefix") format("embedded-opentype"), url("//db.onlinewebfonts.com/t/537002c20f6d3b0765eee34c71fc8062.woff2") format("woff2"), url("//db.onlinewebfonts.com/t/537002c20f6d3b0765eee34c71fc8062.woff") format("woff"), url("//db.onlinewebfonts.com/t/537002c20f6d3b0765eee34c71fc8062.ttf") format("truetype"), url("//db.onlinewebfonts.com/t/537002c20f6d3b0765eee34c71fc8062.svg#GT America Condensed") format("svg");
        font-weight: 900;
        font-size: 50px;
        color: #2f4f4f;
    }

    .form-control:focus {
        border-color: #daa520;
        box-shadow: 0 0 1px 0.25rem #9a572d;
    }

    .tit {
        justify-content: flex-start;
        margin-bottom: 4px;
        margin-top: 8px;
        text-align: left;
        font-size: 1rem;
        letter-spacing: .05rem;
        color: #fff;
    }
</style>
<link href="./bootstrap-5.1.1-examples/sign-in/signin.css" rel="stylesheet">


<div class="ALAN-login text-center m-auto">
    <main class="form-signin">
        <form name="form_login" onsubmit="doLogin(); return false;">
            <img class="mb-3" src="uploaded/alpha-lion-3.png" alt="" width="300" height="280">
            <h1 class="ALAN-title  mb-1">Wild Jungle</h1>
            <h2 class="AlAN-title2 h3 mb-3 fw-normal fs-6 text-white">welcome</h2>

            <div class="form-floating">
                <p class="tit" for="email">請輸入帳號</p>
                <!-- <label class="form-label"></label> -->
                <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com">
                <div class="form-text"></div>
            </div>

            <div class="form-floating">
                <p class="tit" for="password">請輸入密碼</p>
                <!-- <label  class="form-label"></label> -->
                <input type="password" class="form-control" id="password" name="password">
                <div class="form-text"></div>
            </div>
            <button class="ALAN-button w-100 btn btn-lg btn-primary" type="submit">登入</button>
            <p class="mt-2 text-black-50"><small>&copy;2021-2022</small></p>
        </form>
    </main>
</div>


<?php include __DIR__ . '/parts/__scripts.php' ?>
<script>
    function doLogin() {
        const fd = new FormData(document.form_login);

        fetch('member_login-api.php', {
            method: 'POST',
            body: fd,
        }).then(r => r.json()).then(obj => {
            console.log(obj);
            if (obj.success) {
                location.href = 'memberList.php';
            } else {
                alert(obj.error);
            }

        });
    }
</script>
<?php include __DIR__ . '/parts/__html_foot.php' ?>