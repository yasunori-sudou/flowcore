<?php
    $root = 'order_show';
    $root = 'order_entry';


    if($root === 'order_show'){

        /*----------サイドバー---------*/
        require_once('../../view/flow/3_order/sideber/sideber.php');
 
        /*-------受注照会-------*/
        require_once('../../view/flow/3_order/show/order_show.php');

    }else if($root === 'order_entry'){
                
        /*----------サイドバー---------*/
        require_once('../../view/flow/3_order/sideber/sideber.php');
 
        /*-------受注エントリ-------*/
        require_once('../../view/flow/3_order/entry/order_entry.php');

    }


    $sideber = sideber($ds) ?? ''; //サイドバーの内容htmlを取得
    $mainfield = mainfield($ds) ?? ''; //メインブロックの内容htmlを取得

?>