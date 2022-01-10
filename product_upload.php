<?php

header('Cnotent-Type: application/json');

$upload_folder = __DIR__ . '/uploaded';
// 用相對路徑的寫法

$exts = [
    'image/jpeg' => '.jpg',
    'image/png' => '.png',
    'image/gif' => '.gif',

];
// 可以接受的檔案類型



$output = [
    'success' => 0,
    'error' => [],
    'files' => [],
];
// 判斷有沒有上傳這個欄位的檔案


if (!empty($_FILES['myfiles']) and !empty($_FILES['myfiles']['name'])) {
    foreach ($_FILES['myfiles']['name'] as $i => $name) {
        $ext = $exts[$_FILES['myfiles']['type'][$i]] ?? ''; //拿到對應的副檔名
        if (!empty($ext)) {
            $filename = $name;
            $target = $upload_folder . '/' . $filename;
            if (move_uploaded_file($_FILES['myfiles']['tmp_name'][$i], $target)) {
                // 這邊是專門用來移動上傳的檔案
                $output['success']++;
                $output['files'][] = $filename; //push檔名
                //TODO:可以將檔名寫入資料表
            } else {
                //$output['error'] = '無法移動檔案';
            }
        } else {
            //$output['error'] = '不合法的檔案類型';
        }
    }
} else {
    $output['error'] = '沒有上傳檔案';
}



echo json_encode($output, JSON_UNESCAPED_UNICODE);
//公開的做法,安全性比較差