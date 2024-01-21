<?php

    function mainfield($orderid = ''){



        $mainfield = '
            <h3 class="maintitle">問い合わせ</h3>
            <input type="text" class="form-control execute_subject empty_check" id="件名" placeholder="標題">

            <div class="col-md-2 mb-3">
                希望納期 : <input type="date" class="form-control execute_subject" id="希望納期">
            </div>
            
            <div class="col-md-12 mb-3">
                見積内容 : 
                <textarea class="form-control execute_subject empty_check" id="見積内容" rows="3"></textarea>
            </div>

            <div class="col-md-12 mb-3">
                <form action="" method="post" enctype="multipart/form-data">
                    <div id="drag-drop-area">
                        <div class="drag-drop-inside">
                            <p class="drag-drop-info">ここにファイルをドロップ</p>
                            <p>または</p>
                            <input type="file" value="ファイルを選択" name="image">
                        </div>
                    </div>
                </form>            
            </div>

            <div class="d-grid gap-2 d-md-block">
                <button type="button" class="btn btn-primary" id="execute_button" >登録</button>
            </div>
            ';

        /*--------JavaScriptファイルのリンクを指定--------*/
        $jsfile_link = '<script src="../../view/flow/3_order/entry/order_entry.js"></script>';

        return $mainfield . $jsfile_link;
    }


?>