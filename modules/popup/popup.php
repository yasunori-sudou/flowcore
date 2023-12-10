<?php
    /*
        -----------ポップアップウインドウ-------------
        include('../../modules/popup/popup.php');
        $popupvalue = '
            <h1>ポップアップウインドウ</h1>
            <h2>～お知らせ内容～</h2>
            <p>XXXXXXXXXXXXXXXXXXXXXXXXXXXXX</p>
            <p>XXXXXXXXXXXXXXXXXXXXXXXXXXXXX</p>
            <p>XXXXXXXXXXXXXXXXXXXXXXXXXXXXX</p>
            <p>XXXXXXXXXXXXXXXXXXXXXXXXXXXXX</p>
            <p>XXXXXXXXXXXXXXXXXXXXXXXXXXXXX</p>
        ';
        ----------------------------------------------
    
        <?=popupwindow($popupvalue,'クリックしてね')?>

    */
    function popupwindow($popupvalue,$labelname){

        return '
                <link href="../../modules/popup/popup.css" rel="stylesheet">
                <div class="popup_wrap">
                <input id="trigger" type="checkbox">
                    <div class="popup_overlay">
                        <label for="trigger" class="popup_trigger"></label>
                        <div class="popup_content">
                            <label for="trigger" class="close_btn">×</label>
                            '.$popupvalue.'
                        </div>
                    </div>
                </div>
                
                <label for="trigger" class="open_btn">'.$labelname.'</label>
               
                    ';

    }

?>

