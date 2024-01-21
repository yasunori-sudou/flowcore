<?php

    /*----------見積未回答の照会ページ----------*/

    function mainfield($ds){

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
            <h3 class="maintitle">請求一覧</h3>
            
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" type="button" aria-selected="true">
                        全ての請求
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" type="button"  aria-selected="false">
                        未払の請求
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="contact-tab" type="button" aria-selected="false">
                        支払済の請求
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="disabled-tab" type="button" ria-selected="false">
                        請求書の検索
                    </button>
                </li>
            </ul>

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

    function already_read_process(){
        //未読かどうかチェックする

        //未読を既読に変更
        
    }

?>