<?php
require __DIR__ . '/parts/__connect_db.php';

$output = [
    'success' => false,
    'code' => 0,
    'error' => '',
];

// $name = $_POST['name'] ?? '';
// $English_name = $_POST['English_name']?? '';
// $species = $_POST['species'] ?? '';
// $origin = $_POST['origin'] ?? '';
// $birthday = $_POST['birthday'] ?? '';
// $remark = $_POST['remark'] ??'';


$sql = "INSERT INTO `address_1`( 
                        `name`,
                        `English_name`,
                        `species`,
                        `origin`, 
                        `birthday`,
                        `remark`
                        ) VALUES (?, ?, ?, ?, ?,?)";

$stmt = $pdo->prepare($sql);
$stmt->execute([
    $_POST['name'] ?? '',   //非必填 必填寫$name,
    $_POST['English_name']?? '',
    $_POST['species'] ?? '', 
    $_POST['origin'] ?? '', 
    empty($_POST['birthday']) ? NULL : $_POST['birthday'],
    $_POST['remark'] ?? '',
]);

    $output['success'] = $stmt->rowCount()==1;
    //$output['rowCount'] = $stmt->rowCount();


echo json_encode($output, JSON_UNESCAPED_UNICODE);


//`animal_sid`, `name`, `English_name`, `species`, `origin`, `birthday`, `remark`