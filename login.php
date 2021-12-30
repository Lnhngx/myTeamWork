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

    .ALAN-button:hover{
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
    .form-control:focus{
        border-color:#daa520;
        box-shadow: 0 0 1px 0.25rem #9a572d;
    }


</style>
<link href="./bootstrap-5.1.1-examples/sign-in/signin.css" rel="stylesheet">

<div class="ALAN-login text-center m-auto">
    <main class="form-signin">
        <form>
            <img class="mb-4" src="./pic/alpha-lion-3.png" alt="" width="300" height="280">
            <h1 class="ALAN-title  mb-1">Wild Jungle</h1>
            <h2 class="AlAN-title2 h3 mb-5 fw-normal fs-6 text-white-50">welcome</h2>

            <div class="form-floating">
                <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">請輸入管理者帳號</label>
            </div>

            <div class="form-floating">
                <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">請輸入管理者密碼</label>
            </div>
            <button class="ALAN-button w-100 btn btn-lg btn-primary" type="submit">登入</button>
            <p class="mt-5 mb-3 text-black-50">&copy;2021-2022</p>
        </form>
    </main>
</div>



<?php include __DIR__ . '/parts/__scripts.php' ?>
<?php include __DIR__ . '/parts/__html_foot.php' ?>