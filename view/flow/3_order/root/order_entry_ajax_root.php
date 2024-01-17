<?php

    if(!isset($ds)){
        require_once(dirname(__FILE__).'/../../../../db/db_operation/db_operation.php');
        $ds = new CodeSearch;
    }


    if(isset($_GET['thisid'])){
        $thisid = $_GET['thisid'];

        if($thisid == "nav-link1"){
            //新規登録
            require_once(dirname(__FILE__).'/../entry/order_entry.php');

        }else if($thisid == "nav-link2"){
            //下書き中

        }else if($thisid == "nav-link3"){
            //未回答
            require_once(dirname(__FILE__).'/../show/order_show.php');
        }else if($thisid == "nav-link4"){
            //回答済

        }


        $html = mainfield();

        echo json_encode($html);

    }else{
        echo [];
    }


?>