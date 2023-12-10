<?php


    if(isset($_GET['current'])){

        $cureent = $_GET['current'];
        $splitrow = $_GET['splitrow'];

        if(isset($_GET['startdate'])){
            $startdate = $_GET['startdate'];
        }else{
            $startdate = '';
        }

        if(isset($_GET['enddate'])){
            $enddate = $_GET['enddate'];
        }else{
            $enddate = '';
        }

        include('../../modules/datasarch/datasarch.php');
        $ds = new CodeSearch;//SQL実行のインスタンス   
        $getpage = array();

        if($_GET['type'] == 'order_entry'){
            //受注エントリからの操作
            //ページ総数を計算させるのに用いるsql ※COUNT名はcntにすること 例:SELECT COUNT('countclumn') AS cnt FROM tablename where";
            //CAST(`受注登録時刻` AS DATE)
            //※../../order/orderentry_one/order_entry_one.php も同様のSQLにして下さい....
            $countsql = "SELECT COUNT('受注No') AS cnt 
                            FROM `受注データ` 
                        WHERE CAST(`受注登録時刻` AS DATE) >= '".$startdate."' AND CAST(`受注登録時刻` AS DATE) <= '".$enddate."' ;";
                        
            //データ内容のSQL※LIMIT句を足すので最後のセミコロンは抜く事
            $flontsql = "SELECT * FROM `受注データ` 
                            INNER JOIN `製造データ`
                            ON `受注データ`.`受注No` = `製造データ`.`受注No` 
                        WHERE CAST(`受注データ`.`受注登録時刻` AS DATE) >= '".$startdate."' AND CAST(`受注データ`.`受注登録時刻` AS DATE) <= '".$enddate."' 
                        ORDER BY `受注データ`.`受注登録時刻` DESC ";

            require('../../modules/pagenation/pagenation.php');
            $pagenation = new Pagenation;
            $getpage = $pagenation->pagenation_make($ds,$cureent,$countsql,$splitrow,$flontsql);  

        }

        echo json_encode($getpage);

    }else{
        echo [];
    }


?>