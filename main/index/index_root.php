<?php
    $root = 'order_show';
    $root = 'order_entry';

    /*----------サイドバーとメイン画面の表示内容を取得---------*/
    require_once('./sideber.php');
    $sideber = sideber();

    if($root === 'order_show'){
        require_once('../../view/flow/3_order/show/order_show.php');
        /*-------受注照会-------*/
        $mainfield = mainfield();

    }else if($root === 'order_entry'){
        require_once('../../view/flow/3_order/entry/order_entry.php');
        /*-------受注エントリ-------*/
        $mainfield = mainfield();

    }

?>