<?php

    /*----------見積未回答の照会ページ----------*/

    function mainfield($ds){


        $sql = "SELECT * FROM `注文データ` WHERE `見積中フラグ` = 1 AND `見積回答フラグ` = 0 AND `契約終了フラグ` = 0 AND `削除フラグ` = 0;";

        $card_td = '';
        foreach($ds->Almighty($sql,[],'flowcore') as $i){


            if($i['受注先未読フラグ'] === 0){
                //未読

            }else{
                //既読

            }

            $card_td .= '
                <tr>
                    <th scope="row">'.$i['注文No'].'</th>
                    <td>'.$i['見積時刻'].'</td>
                    <td>'.$i['件名'].'</td>
                    <td>'.$i['受領内容'].'</td>
                    <td>'.$i['受領内容'].'</td>
                    <td>'.$i['受領内容'].'</td>
                    <td>
                        請求明細の確認<br>
                        請求書の印刷<br>
                        受領書の印刷
                    </td>
                </tr>' ;    
        }



        $mainfield = '
            <h3 class="maintitle">見積未回答</h3>
            
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">見積No</th>
                        <th scope="col">問い合わせ時刻</th>
                        <th scope="col">件名</th>
                        <th scope="col">受領内容</th>
                        <th scope="col">希望納期</th>
                        <th scope="col">回答納期</th>
                        <th scope="col">手続き</th>
                    </tr>
                </thead>

                <tbody>
                    '.$card_td.'
                </tbody>

            </table>';

        return $mainfield;
    }

    function already_read_process(){
        //未読かどうかチェックする

        //未読を既読に変更
        
    }

?>