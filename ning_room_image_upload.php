<?php

header('Content-Type: application/json');

$upload_folder = __DIR__.'/room-uploaded';

$output = [
    'success' => false,
    'error' => '',
];

if(!empty($_FILES['myfile'])){
    $target = $upload_folder.'/'.$_FILES['myfile']['name'];
    if(move_uploaded_file($_FILES['myfile']['tmp_name'],$target)){

        $output['success'] = true;
        
    }else{
        $output['error'] = '無法移動檔案';
    }
}else{
    $output['error'] = '沒有上傳檔案';
}
//tmp_name：圖片暫存位置
echo json_encode($output,JSON_UNESCAPED_UNICODE);

