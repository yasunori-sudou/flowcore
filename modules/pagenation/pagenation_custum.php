<?php

    /*---------------------------------------------------------------*/
    /*----------------------テーブルヘッダーの生成---------------------*/
    /*---------------------------------------------------------------*/
    $tablehtml_th = '
            <tr>    
                <th scope="col">id</th>
                <th scope="col">devno</th>
                <th scope="col">temp</th>
                <th scope="col">humi</th>
                <th scope="col">power</th>
                <th scope="col">ip</th>
                <th scope="col">time</th>
            </tr>';

    /*---------------------------------------------------------------*/
    /*----------------------テーブルボディーの生成---------------------*/
    /*---------------------------------------------------------------*/
    $tablehtml_td = '';


    /*---------------------------------------------------------------*/
    /*-------------------------tableの生成----------------------------*/
    /*---------------------------------------------------------------*/
    $tablehtml = '  <div id="pagenation_tablefield">
                        <table class="table table-bordered table-responsive">
                            <thead>
                                '.$tablehtml_th.'
                            </thead>
                            <tbody>
                                '.$tablehtml_td.'
                            </tbody>
                        </table>
                    <div>';    

?>