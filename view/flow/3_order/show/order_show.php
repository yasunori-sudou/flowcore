<?php

    function sideber(){
        $sideber = '

            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                <span>問い合わせ</span>
            </h6>

            <ul class="nav flex-column">

                <li class="nav-item">
                    <a class="nav-link" href="#">
                        下書き中
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">
                        未回答
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">
                        回答済
                    </a>
                </li>

            </ul>

            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                <span>契約情報</span>
            </h6>

            <ul class="nav flex-column">

                <li class="nav-item">
                    <a class="nav-link" href="#">
                        御見積一覧
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">
                        契約済案件
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">
                        契約終了案件
                    </a>
                </li>

            </ul>

            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                <span>請求情報</span>
            </h6>
            <ul class="nav flex-column mb-2">
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        請求書の確認
                    </a>
                </li>
            </ul>

            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                <span>ユーザー情報</span>
            </h6>
            <ul class="nav flex-column mb-2">
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        ユーザー一覧
                    </a>
                </li>
            </ul>
        ';



        return $sideber;
    }

    function cardval(){

        $card_td = '';

        for($i=0;$i<20;$i++){
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

        $cardval = '
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

        return $cardval;
    }


?>