<?php

    class Pagenation{
        /**
         * JSとCSSのリンクを含めたHTMLを返す
         *
         * @param object $ds データベースのオブジェクト
         * @param int $cureent 現在のページ位置
         * @param string $countsql ページ総数を計算させるのに用いるsql ※COUNT名はcntにすること 例:SELECT COUNT('countclumn') AS cnt FROM tablename where";
         * @param int $splitrow レコードを何行で区切るか
         * @param string $flontsql データ内容のSQL※LIMIT句を足すので最後のセミコロンは抜く事
         * @param bool $show_result trueならリザルトを計算して返す
         * @return array array[0] テーブル内容 array[1] maxrow
         */
        function pagenation_fullmake($ds,$cureent,$countsql,$splitrow,$flontsql,$show_result = false){
            
            $val = $this->pagenation_make($ds,$cureent,$countsql,$splitrow,$flontsql,$show_result);
            //<script src="../../modules/pagenation/pagenation.js"></script>
            $link = '   
                        <link rel="stylesheet" href="../../modules/pagenation/pagenation.css?var=1.0.5">
                        <div id="pagenation_field">
                            '.$val[0].'
                        </div>';
            return array($link,$val[1]);
        }

        /**
         * 受け取ったSQLに対してテーブルとページネーションの中身だけを返す
         * JqueryとBlumaを参照していること
         * <script src="https://use.fontawesome.com/releases/v5.3.1/js/all.js" defer ></script>
         * <link rel="stylesheet" href="../../css/bulma/css/bulma.min.css" />
         * <script src="../../modules/jquery/3.6.1/jquery-3.6.1.min.js"></script>
         * 
         * ◆戻り値arrayの中身
         * array[0] str テーブル内容html
         *
         * @param object $ds データベースのオブジェクト
         * @param int $cureent 現在のページ位置
         * @param string $countsql ページ総数を計算させるのに用いるsql ※COUNT名はcntにすること 例:SELECT COUNT('countclumn') AS cnt FROM tablename where";
         * @param int $splitrow レコードを何行で区切るか
         * @param string $flontsql データ内容のSQL※LIMIT句を足すので最後のセミコロンは抜く事
         * @param bool $show_result trueならリザルトを計算して返す
         * @return array 詳細は概要欄
         */
        function pagenation_make($ds,$cureent,$countsql,$splitrow,$flontsql,$show_result = false){
            /*---------------------------------------------------------------*/
            /*------------------------ページ数の生成--------------------------*/
            /*---------------------------------------------------------------*/
            $rowcnt = $ds->Almighty($countsql,array());
            if(!empty($rowcnt)){
                $totaldata = $rowcnt[0]['cnt'];
            }else{
                $totaldata = 0;
            }
            
            if(is_float($totaldata / $splitrow)){
                //端数ありは1ページ足す
                $totalpage = intval($totaldata / $splitrow) + 1;
            }else{
                $totalpage = intval($totaldata / $splitrow);
            }
            
            /*----------------------何レコード目のデータを表示するか-------------------------*/
            $nextlimitstart = $cureent * $splitrow - $splitrow;

            /*---------------------------------------------------------------*/
            /*--------------------JSに渡すhiddenの生成------------------------*/
            /*---------------------------------------------------------------*/
            $hiddenhtml = '<input type="hidden" id="pagenation_splitrow" value="'.$splitrow.'">';    
                                    
            /*---------------------------------------------------------------*/
            /*----------------------タイルの中身を生成-------------------------*/
            /*---------------------------------------------------------------*/
            $tilehtml = '<div id="pagenationfield_tile" style="display:flex;">';

            if(($cureent - 1) > 0){
                $tilehtml .= '  <div id="pagenation_1" class="pagenation_tile pagenation_toplast pagenation_firstlast">First</div>
                                <div id="pagenation_'.($cureent-1).'" class="pagenation_tile pagenation_toplast"><<</div>';
            }else{
                $tilehtml .= '  <div class="pagenation_firstlast pagenation_tile_dummy">First</div>
                                <div class="pagenation_tile_dummy"><<</div>';
            }
            
            $tilecount = 0;
            for($i=1;$i<=$totalpage;$i++){
                if($i == $cureent){
                    /*------------始点～currentの処理---------------*/
                    for($j = 5;$j > 0;$j--){
                        if(($i - $j) > 0){
                            $tilehtml .= '<div id="pagenation_'.($i - $j).'" class="pagenation_tile pagenation_notcurrent">'.($i - $j).'</div>';
                            $tilecount++;                            
                        }
                    }
                    /*------------current---------------*/
                    $tilehtml .= '<div id="pagenation_'.$i.'" class="pagenation_tile pagenation_current">'.$i.'</div>';
                    
                    /*------------current～終点の処理---------------*/
                    for($j = 1;$j < (10-$tilecount);$j++){
                        if(($i + $j) <= $totalpage){
                            $tilehtml .= '<div id="pagenation_'.($i + $j).'" class="pagenation_tile pagenation_notcurrent">'.($i + $j).'</div>';
                        }
                    }
                }               
            }

            if(($cureent + 1) < $totalpage){
                $tilehtml .= '  <div id="pagenation_'.($cureent+1).'" class="pagenation_tile pagenation_toplast">>></div>
                                <div id="pagenation_'.$totalpage.'" class="pagenation_tile pagenation_toplast pagenation_firstlast">Last</div>';
            }else{
                $tilehtml .= '  <div class="pagenation_tile_dummy">>></div>
                                <div class="pagenation_firstlast pagenation_tile_dummy">Last</div>';
            }
            /*---------------------------------------------------------------*/
            /*--------------ページ数指定のセレクトボックスを生成----------------*/
            /*---------------------------------------------------------------*/
            $pageselect = '<select id="pagenation_select">';
            for($i=1;$i<=$totalpage;$i++){
                if($i == $cureent){
                    $pageselect .= '<option value="'.$i.'" selected>'.$i.'</option>';
                }else{
                    $pageselect .= '<option value="'.$i.'">'.$i.'</option>';
                }
            }
            $pageselect .= '</select>';

            /*--------------結合----------------*/
            $tilehtml .= '  
                        '.$pageselect.'
                        </div>';

            /*---------------------------------------------------------------*/
            /*--------------------テーブルデータの中身の定義-------------------*/
            /*---------------------------------------------------------------*/   

            /*------------------tableに表示するデータの取得--------------------*/
            $sql = $flontsql." LIMIT ".$nextlimitstart.",".$splitrow.";";
            
            $getdata = $ds->Almighty($sql,array());

            include('../../modules/pagenation/pagenation_custum.php');

            /*---------------------------------------------------------------*/
            /*--------------------------出力結果を返す------------------------*/
            /*---------------------------------------------------------------*/   
            $tilehtml = '<div class="noprint">'.$tilehtml.'</div>';
            $result_html = $tilehtml.$tablehtml.$hiddenhtml;
            /*
                戻り値の中身
                array[0] str $result_html テーブル内容html
            */
            return array(
                        $result_html
                    );
        }
  
    }

?>