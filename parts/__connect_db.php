<?php
$db_host='localhost';
//主機
$db_name='動物園商品';
//資料庫名稱
$db_user='s88173';
//使用者帳號
$db_pass='55551122';
//使用者密碼

$dsn="mysql:host={$db_host};dbname={$db_name};charset=utf8";
//charset編碼


$db_options=[
    PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC,
    PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8",
];

try{
$pdo = new PDO($dsn,$db_user,$db_pass,$db_options);
}catch (PDOException $ex){
    echo '**** *****'.$ex->getMessage();
};


if(! isset($_SESSION)){
    session_start();
};
//用try catch去處理PDO


//也可以在這邊先設定title
//$title='';
//$pageName='';
//去看__html__head