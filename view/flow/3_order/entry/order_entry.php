<?php

    function mainfield($orderid = ''){

        $mainfield = '
            <input type="text" class="form-control execute_subject empty_check" id="件名" placeholder="件名" value="">

            <textarea class="form-control execute_subject empty_check" id="受領内容" rows="3"></textarea>

            <div class="d-grid gap-2 d-md-block">
                <button type="button" class="btn btn-primary" id="execute_button" >登録</button>
            </div>

            <!--JSファイルの読み込み-->
            <script src="../../view/flow/3_order/root/order_entry_root.js"></script>
            <script src="../../view/flow/3_order/entry/order_entry.js"></script>';



        return $mainfield;
    }


?>