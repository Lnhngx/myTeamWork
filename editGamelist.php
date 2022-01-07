<?php  
require __DIR__. '/parts/__connect_db.php';
$title = '修改遊戲資料';
if ( !isset($_GET['question_sid']) ){
    header("Location:gamelist.php");
    exit;
}
$sid = intval($_GET['question_sid']);
$sql = "SELECT * FROM `question` JOIN `answer` ON `question`.`sid`=`question_sid` WHERE `question`.`sid`= $sid ";
$rows = $pdo -> query($sql) -> fetchAll();

?>

<?php include __DIR__. '/parts/__html_head.php' ?>
<?php include __DIR__ . '/parts/__sidebar.php' ?>

<style>
    .error-hint {
        color: crimson;
    }
    .wrap {
        width: calc(100% - 250px);
        position: absolute;
        left: 250px;
        
    }
  
</style>
<div class="wrap">
    <div class="container">
        <div class="row">
            <div class="col-8 mx-auto mt-3">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title text-center">修改遊戲題目選項</h3>
                        
                        <form name="form_game" onsubmit="sendData(); return false;">
                            <input type="hidden" name="question_sid" value="<?= $rows[0]['question_sid'] ?>">
                            <div class="mb-3">
                                <label for="name" class="form-label">動物名稱</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?=$rows[0]['name']?>">
                                <div class="error-hint"></div>
                            </div>

                            <div class="mb-3">
                                <label for="qcontent" class="form-label">題目內容</label>
                                <input type="text" class="form-control" id="qcontent" name="qcontent"value="<?=$rows[0]['qcontent']?>">
                                <div class="error-hint"></div>
                            </div>

                            
                            <div class="mb-3">
                                <label for="acontent" class="form-label">正確答案內容</label>
                                <input type="text" class="form-control" id="acontent1" name="acontent1" data-sid=<?=$rows[0]['sid']?> value="<?=$rows[0]['acontent']?>">
                                <div class="error-hint"></div>
                            </div>

                            <div class="mb-3">
                                <label for="acontent" class="form-label">錯誤答案內容</label>
                                <input type="text" class="form-control" id="acontent2" name="acontent2" data-sid=<?=$rows[1]['sid']?> value="<?=$rows[1]['acontent']?>">
                                
                                <div class="error-hint"></div>
                            </div>

                            <div class="mb-3">
                                <label for="acontent" class="form-label">錯誤答案內容</label>
                                <input type="text" class="form-control" id="acontent3" name="acontent3" data-sid=<?=$rows[2]['sid']?> value="<?=$rows[2]['acontent']?>">
                                
                                <div class="error-hint"></div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="acontent" class="form-label">錯誤答案內容</label>
                                <input type="text" class="form-control" id="acontent4" name="acontent4" data-sid=<?=$rows[3]['sid']?> value="<?=$rows[3]['acontent']?>">
                                
                                <div class="error-hint"></div>
                            </div>

                                <!-- 將所有適用的字符轉換為 HTML 實體 -->
                            

                            <!-- <div class="mb-3">
                                <label for="image" class="form-label">背景圖片</label>
                                <input type="file" class="form-control" id="image" name="image">
                                <div class="error-hint"></div>
                            </div> -->
                        

                            <button type="submit" class="btn btn-primary">修改</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">資料錯誤</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

</div>




<?php include __DIR__ . '/parts/__scripts.php' ?>
<script>

    const name = document.querySelector('#name');
    const qcontent = document.querySelector('#qcontent');
    const acontent1 = document.querySelector('#acontent1');
    const acontent2 = document.querySelector('#acontent2');
    const acontent3 = document.querySelector('#acontent3');
    const acontent4 = document.querySelector('#acontent4');
    const modal = new bootstrap.Modal(document.querySelector('#exampleModal'));


    function sendData() {
        name.nextElementSibling.innerHTML = '';
        qcontent.nextElementSibling.innerHTML = '';
        acontent1.nextElementSibling.innerHTML = '';
        acontent2.nextElementSibling.innerHTML = '';
        acontent3.nextElementSibling.innerHTML = '';
        acontent4.nextElementSibling.innerHTML = '';
        
        
        let isPass = true;
        
        if (name.value.length < 1) {
            isPass = false;
            name.nextElementSibling.innerHTML = '請輸入正確的動物名稱';
            
        }
        if (qcontent.value.length < 1) {
            isPass = false;
            qcontent.nextElementSibling.innerHTML = '請再次輸入題目';
        }
        if (acontent1.value.length < 1) {
            isPass = false;
            acontent1.nextElementSibling.innerHTML = '請再次輸入選項';
        }

        if (acontent2.value.length < 1) {
            isPass = false;
            acontent2.nextElementSibling.innerHTML = '請再次輸入選項';    
        }
        if (acontent3.value.length < 1) {
            isPass = false;
            acontent3.nextElementSibling.innerHTML = '請再次輸入選項';
        }
        if (acontent4.value.length < 1) {
            isPass = false;
            acontent4.nextElementSibling.innerHTML = '請再次輸入選項';
        }
        if (isPass) {
            const fd = new FormData(document.form_game);

            fetch('editGamelist-api.php', {
                    method: 'POST',
                    body: fd,
                }).then(r => r.json())
                .then(obj => {
                    if (obj.success) {
                        alert('修改成功');
                        location.href = 'gameList.php';
                    } else {
                        document.querySelector('.modal-body').innerHTML = obj.error || '資料修改發生錯誤';
                        modal.show();
                    }
                })
        }

    }
</script>

<?php include __DIR__ . '/parts/__html_foot.php' ?>