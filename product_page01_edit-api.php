<?php

require __DIR__ . '/parts/__connect_db.php';


$output = [
    'success' => false,
    'error' => '',
];


$sid = isset($_POST['sid']) ? intval($_POST['sid']) : 0;
if (empty($sid)) {
    $output['error'] = '沒有 sid';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

$name = $_POST['name'] ?? '';
$type = $_POST['type'] ?? '';
$spec = $_POST['spec'] ?? '';
$supp = $_POST['supp'] ?? '';
$reser = $_POST['reser'] ?? '';
$money = $_POST['money'] ?? '';
$ddate = $_POST['d-date'] ?? '';
$pictures = $_FILES['myfiles']['name'];
$pictureName = implode(",", $pictures);




$sql = "UPDATE `product_item` SET 
                          `name`=?,
                          `type`=?,
                          `specification`=?,
                          `information`=?,
                          `supplier`=?,
                          `price`=?,
                          `picture`=?,
                          `create_at`=?
WHERE `sid`=?";

$sql2 = "UPDATE `product_item` SET 
                          `name`=?,
                          `type`=?,
                          `specification`=?,
                          `information`=?,
                          `supplier`=?,
                          `price`=?,
                          `create_at`=?
WHERE `sid`=?";

// $sqlArray = [$name, $type, $spec, $reser, $supp, $money, isset($pictureName) ? $pictureName : '', $ddate, $sid];
// isset($pictureName) ? '' : array_splice($sqlArray, 6, 1);


$stmt = $pdo->prepare($sql);
$stmt2 = $pdo->prepare($sql2);

// $stmt->execute($sqlArray);

if (empty($pictureName)) {
    $stmt2->execute([
        $name,
        $type,
        $spec,
        $reser,
        $supp,
        $money,
        $ddate,
        $sid
    ]);
} else {
    $stmt->execute([
        $name,
        $type,
        $spec,
        $reser,
        $supp,
        $money,
        $pictureName,
        $ddate,
        $sid
    ]);
};


if ($stmt->rowCount() == 1 || $stmt2->rowCount() == 1) {
    $output['success'] = true;
} else {
    $output['error'] = '資料沒有修改';
};

// if ($stmt->rowCount() == 0) {
//     $output['error'] = '資料沒有修改';
// } else {
//     $output['success'] = true;
// };

// $output['success'] = $stmt->rowCount() == 1;
// $output['rowCount'] = $stmt->rowCount();
//rowCount是函式

echo json_encode($output, JSON_UNESCAPED_UNICODE);
