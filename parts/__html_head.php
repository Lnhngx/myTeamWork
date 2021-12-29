<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= !empty($title) ? "$title - 我的網站" :'我的網站'; 
    // isset（有沒有設定）會跑出空字串,可以用empty,要測試這個是不是空的內容？,結果是布林值(如果不是空的話要....) ?></title>
    <link rel="stylesheet" href="/myTeamWork/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="/myTeamWork/bootstrap-5.1.1-examples/sidebars/sidebars.css">
    <link rel="stylesheet" href="/myTeamWork/font-awesome/css/font-awesome.css">
    <link href="sidebars.css" rel="stylesheet">
    <link href="//db.onlinewebfonts.com/c/537002c20f6d3b0765eee34c71fc8062?family=GT+America+Condensed" rel="stylesheet" type="text/css"/>
</head>
<body>