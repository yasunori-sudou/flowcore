<?php

    if(!isset($ds)){
        require_once(dirname(__FILE__).'/../../../../db/db_operation/db_operation.php');
        $ds = new CodeSearch;
    }

    /*
        サイドバーの押したリンクによってメインページの表示を変更する
    */
    if(isset($_GET['thisid'])){
        $thisid = $_GET['thisid'];

        if($thisid == "nav-link1"){
            //新規登録
            require_once(dirname(__FILE__).'/../entry/order_entry.php');

        }else if($thisid == "nav-link2"){
            //下書き中
            require_once(dirname(__FILE__).'/../show/order_show_下書き中.php');

        }else if($thisid == "nav-link3"){
            //未回答
            require_once(dirname(__FILE__).'/../show/order_show_未回答.php');

            
        }else if($thisid == "nav-link4"){
            //回答済


        }else if($thisid == "nav-link5"){
            //御見積一覧


        }else if($thisid == "nav-link6"){
            //契約済案件



        }else if($thisid == "nav-link7"){
            //契約終了案件
            

        }else if($thisid == "nav-link8"){
            //請求書の確認
            require_once(dirname(__FILE__).'/../claim/claim_show.php');

        }else if($thisid == "nav-link9"){
            //ユーザー一覧


        }


        $html = mainfield($ds);

        echo json_encode($html);

    }else{
        echo [];
    }


?>