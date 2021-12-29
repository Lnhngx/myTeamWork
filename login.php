<?php
session_start();
?>

<?php
require __DIR__ . './../teamwork/parts/__connect_db.php';
$pageName = 'index';
?>
<?php include __DIR__ . './../teamwork/parts/__html_head.php' ?>
<style>
    .ALAN-login{
        background-color: #86897E;
        border-radius:50px;
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

    @media (min-width: 768px) {
        .bd-placeholder-img-lg {
            font-size: 3.5rem;
        }
    }
</style>
<link href="./bootstrap-5.1.1-examples/sign-in/signin.css" rel="stylesheet">

<div class="ALAN-login text-center m-auto">
    <main class="form-signin">
        <form>
            <img class="mb-4" src="./pic/alpha-lion-3.png" alt="" width="300" height="280">
            <h1 class="h3 mb-3 fw-normal fs-1">Please LogIn</h1>

            <div class="form-floating">
                <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">請輸入管理者帳號</label>
            </div>

            <div class="form-floating">
                <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">請輸入管理者密碼</label>
            </div>
            <button class="ALAN-button w-100 btn btn-lg btn-primary" type="submit">登入</button>
            <p class="mt-5 mb-3 text-muted">&copy;2021</p>
        </form>
    </main>
</div>



<?php include __DIR__ . './../teamwork/parts/__scripts.php' ?>
<?php include __DIR__ . './../teamwork/parts/__html_foot.php' ?>