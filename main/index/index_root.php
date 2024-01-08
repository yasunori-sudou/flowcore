<?php

    if($root === 'order'){
        require_once('../../view/flow/3_order/show/order_show.php');
        /*----------サイドバーとメイン画面の表示内容を取得---------*/
        $cardval = cardval();
        $sideber = sideber();
    }

?>