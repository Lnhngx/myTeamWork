<html>

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <meta http-equiv="Content-Style-Type" content="text/css" />
    <title>產品管理</title>
    <link rel="stylesheet" href="../css/style.css" type="text/css" media="screen" />

</head>
<style>
    ul {
        width: 500px;
        height: 500px;
    }

    li {
        width: 150px;
        height: 150px;
        background-color: yellow;
    }
</style>

<body>
    <script src="/myTeamWork/Sortable/modular/sortable.complete.esm.js">
        Sortable.mount(new AutoScroll());
    </script>


<div id="simpleList" class="list-group">
    <div class="list-group-item"><li><a href="http://rubaxa.github.io/Sortable/">Sortable</a></div>
    <div class="list-group-item">It works with Bootstrap...</div>
    <div class="list-group-item">...out of the box.</div>
    <div class="list-group-item">It has support for touch devices.</div>
    <div class="list-group-item">Just drag some elements around.</div>
  </div>

    <script>
      Sortable.create(simpleList, { /* options */ });
    </script>

</body>

</html>