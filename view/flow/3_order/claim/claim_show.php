<?php

    /*----------請求書の確認ページ----------*/

    function mainfield(){

        $card_td = '';

        for($i = 0;$i < 20;$i++){
            $card_td .= '
                <tr>
                    <th scope="row">10001010</th>
                    <td>23/12/20</td>
                    <td>クレジットカード</td>
                    <td>100,000円</td>
                    <td>支払い済</td>
                    <td>23/12/20</td>
                    <td>
                        請求明細の確認<br>
                        請求書の印刷<br>
                        受領書の印刷
                    </td>
                </tr>';            
        }

        $mainfield = '
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">請求書No</th>
                        <th scope="col">請求日</th>
                        <th scope="col">支払い方法</th>
                        <th scope="col">請求金額</th>
                        <th scope="col">支払状況</th>
                        <th scope="col">各種手続日</th>
                        <th scope="col">手続き</th>
                    </tr>
                </thead>

                <tbody>
                    '.$card_td.'
                </tbody>

            </table>';

        return $mainfield;
    }


?>