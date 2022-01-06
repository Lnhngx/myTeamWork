<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= !empty($title) ? "$title - 我的網站" : '我的網站';
            // isset（有沒有設定）會跑出空字串,可以用empty,要測試這個是不是空的內容？,結果是布林值(如果不是空的話要....) 
            ?></title>
    <link rel="stylesheet" href="/myTeamWork/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="/myTeamWork/bootstrap-5.1.1-examples/sidebars/sidebars.css">
    <link rel="stylesheet" href="/myTeamWork/fontawesome/css/all.css">
    <link href="//db.onlinewebfonts.com/c/537002c20f6d3b0765eee34c71fc8062?family=GT+America+Condensed" rel="stylesheet" type="text/css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+TC:wght@200;300;400;500;600;700;900&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
    <script>
        $(function() {
            $("#sortable").sortable();
        });
    </script>

</head>

<body>
    <script src="https://raw.githack.com/SortableJS/Sortable/master/Sortable.js"></script>