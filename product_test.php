<html>

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <meta http-equiv="Content-Style-Type" content="text/css" />
    <title>產品管理</title>
    <link rel="stylesheet" href="../css/style.css" type="text/css" media="screen" />
</head>

<body>
    <table align="center">

        <tr>
            <td width="10%">
                <label>
                    <select name="show" id="show" onchange="showChang(<?php echo $row_product['id']; ?>,options[this.selectedIndex].value)">
                        <option value="Y" <?php if (!(strcmp("Y", $row_product['show']))) {
                                                echo "selected=\"selected\"";
                                            } ?>>已上架</option>
                        <option value="N" <?php if (!(strcmp("N", $row_product['show']))) {
                                                echo "selected=\"selected\"";
                                            } ?>>尚未上架</option>
                    </select>
                </label>
            </td>
        </tr>
    </table>

    <?php

    require __DIR__ . '/parts/__connect_db.php';

    $title = '新增商品資訊';
    $pageName = 'insert';
    ?>


    <?php
    $searchValue = ($_POST["searchValue"]);
    $filterValue = $_POST["filterValue"] ? ($_POST["filterValue"]) : 0;
    $sq = "select * from xxx where col1='$searchValue'";
    if ($filterValue > 0) $sq .= " AND col2 = '$filterValue'";
    //查詢$sql
    ?>
    <form method="post">
        <input type="hidden" name="searchValue" value="<?= $searchValue ?>" />
        <select name="filterValue" onchange="this.form.submit()">
            <option value="0" <?php if ($filterValue == 0) echo 'selected'; ?>>請選擇</option>
            <option value="1" <?php if ($filterValue == 1) echo 'selected'; ?>>行政</option>
            <option value="2" <?php if ($filterValue == 2) echo 'selected'; ?>>人資</option>
            ...
        </select>
    </form>
    <div>顯示結果</div>


    <script type="text/javascript">
        function showChang(id, selectShow) {
            location = '../require/update.php?id=' + id + '&amp;page=<?php echo $page; ?>&amp;show=' + selectShow;
        }
    </script>
</body>

</html>