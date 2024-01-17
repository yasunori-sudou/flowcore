<?php

    if(!isset($ds)){
        require_once(dirname(__FILE__).'/../../../../db/db_operation/db_operation.php');
        $ds = new CodeSearch;
    }


    if(isset($_GET['execute'])){

        //INSERT処理
        $next_id = $ds->NextAutoIncrement('注文データ','flowcore');
        $dbarray = json_decode($_GET['json_text'],true);

        $sqlval = '';
        $sql_question = '';
        $sqlval_arr = [];

        //追加する項目があれば配列に入れる
        $dbarray['注文No'] = $next_id;
        $dbarray['見積フラグ'] = 1;
        $dbarray['未読フラグ'] = 1;
        $dbarray['履歴'] = '新規登録:'.date('Y-m-d H:i:s').'<br>';
        $dbarray['create_at'] = date('Y-m-d H:i:s');

        foreach($dbarray as $key => $value){
            if(empty($sqlval)){ $sqlval = '`'.$key.'`'; }else{ $sqlval .= ', `'.$key.'`'; }
            if(empty($sql_question)){ $sql_question = '?'; }else{ $sql_question .= ', ?'; }
            array_push($sqlval_arr,$value);
        }

        $sql = "INSERT INTO `注文データ`( ".$sqlval." ) VALUES ( ".$sql_question." );";

        $ds->Almighty($sql,$sqlval_arr,'flowcore');

        //問い合わせ未回答の数を取得
        $sql = "SELECT COUNT(`注文No`) AS cnt FROM `注文データ` WHERE `見積回答フラグ` = 0 AND `未読フラグ` = 1;";
        $no_answer_cnt = $ds->Almighty($sql,[],'flowcore')[0]['cnt'] ?? -1;

        echo json_encode([$next_id,$no_answer_cnt]);
        
    }else{
        echo [];
    }


?>