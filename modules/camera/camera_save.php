<?php

    if(isset($_GET['makeno'])){
        $makeno = $_GET['makeno'];
    }else{
        exit;
    }

    if(isset($_GET['cameraposition'])){
        if($_GET['cameraposition'] == 'front'){
            $cameraPosition = 'rear';
        }else{
            $cameraPosition = 'front';
        }     
    }else{
        $cameraPosition = 'front';        
    }

    include('../../modules/datasarch/datasarch.php');
    $ds = new CodeSearch;

    $sql = "SELECT `photo1`,`photo2`,`photo3`,`photo4`,`photo5`,`photo6`,
                    `photo1_at`,`photo2_at`,`photo3_at`,`photo4_at`,`photo5_at`,`photo6_at` 
            FROM `photodata` WHERE `製造No` = ?;";

    $res = $ds->Almighty($sql,array($makeno));

    $base64_1 = '';
    $base64_2 = '';
    $base64_3 = '';
    $base64_4 = '';
    $base64_5 = '';
    $base64_6 = '';

    $photo1_at = '';
    $photo2_at = '';
    $photo3_at = '';
    $photo4_at = '';
    $photo5_at = '';
    $photo6_at = '';

    if(!empty($res[0]['photo1'])){
        $base64_1 = $res[0]['photo1'];
    }
    if(!empty($res[0]['photo2'])){
        $base64_2 = $res[0]['photo2'];
    }
    if(!empty($res[0]['photo3'])){
        $base64_3 = $res[0]['photo3'];
    }
    if(!empty($res[0]['photo4'])){
        $base64_4 = $res[0]['photo4'];
    }
    if(!empty($res[0]['photo5'])){
        $base64_5 = $res[0]['photo5'];
    }
    if(!empty($res[0]['photo6'])){
        $base64_6 = $res[0]['photo6'];
    }

    if(!empty($res[0]['photo1_at'])){
        $photo1_at = $res[0]['photo1_at'];
    }
    if(!empty($res[0]['photo2_at'])){
        $photo2_at = $res[0]['photo2_at'];
    }
    if(!empty($res[0]['photo3_at'])){
        $photo3_at = $res[0]['photo3_at'];
    }
    if(!empty($res[0]['photo4_at'])){
        $photo4_at = $res[0]['photo4_at'];
    }
    if(!empty($res[0]['photo5_at'])){
        $photo5_at = $res[0]['photo5_at'];
    }
    if(!empty($res[0]['photo6_at'])){
        $photo6_at = $res[0]['photo6_at'];
    }

    $canvas_width = 800;
    $canvas_height = 800;

?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="shortcut icon" href="../../icon.png">
        
        <script src="https://use.fontawesome.com/releases/v5.3.1/js/all.js" defer ></script>
        <link rel="stylesheet" href="../../css/bulma/css/bulma.min.css" />

        <link rel="stylesheet" href="../../css/mainstyle/style.css">
        <link rel="stylesheet" href="./camera.css">
        <script src="../../modules/jquery/3.6.1/jquery-3.6.1.min.js"></script>
        <script src="./camera.js"></script>

        <title>Camera Save</title>
    </head>
    <body>
        <div id="pagemain"> 
            <input type="hidden" id="makeno" value="<?=$makeno?>">
            <input type="hidden" id="camera_position" value="<?=$cameraPosition?>">

            <input type="hidden" id="base64_data_1" value="<?=$base64_1?>">
            <input type="hidden" id="base64_data_2" value="<?=$base64_2?>">
            <input type="hidden" id="base64_data_3" value="<?=$base64_3?>">     
            <input type="hidden" id="base64_data_4" value="<?=$base64_4?>">
            <input type="hidden" id="base64_data_5" value="<?=$base64_5?>">
            <input type="hidden" id="base64_data_6" value="<?=$base64_6?>">  

            <input type="hidden" id="photono" value="1">  
            <div class="image_field">
                撮影画像を保存します。(3枚まで登録可)既に登録されている画像は上書きされます。<br>
                           
                <video id="camera" class="photo" width="<?=$canvas_width?>" height="<?=$canvas_height?>"></video>
                <canvas id="picture" class="photo" width="<?=$canvas_width?>" height="<?=$canvas_height?>" style="display:none;"></canvas> 
                
                <button type="button" id="shutter" class="button is-success">シャッター</button>
                <input type="button" class="button is-info is-small" value="カメラ切替_<?=$cameraPosition?>" onclick="location.href='camera_save?cameraposition=<?=$cameraPosition?>&makeno=<?=$makeno?>';"> <br>     

                ▼保存したい枠を下の3つの中から選び、タッチして保存先を選択してから「シャッター」を押して下さい。<br>    
                写真を削除する場合は番号を選択して「削除」ボタンを押して下さい(上から1,2,3番です)

                <select id="delete_no" style="width:50px;font-size:30px;">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                </select>

                <button type="button" id="delete" class="button is-info">削除</button>
                <br>
                [1]
                <canvas id="photo_1" class="photo selectphoto" width="<?=$canvas_width?>" height="<?=$canvas_height?>" title="<?=$photo1_at?>"></canvas><br>
                [2]
                <canvas id="photo_2" class="photo selectphoto" width="<?=$canvas_width?>" height="<?=$canvas_height?>" title="<?=$photo2_at?>"></canvas><br>
                [3]
                <canvas id="photo_3" class="photo selectphoto" width="<?=$canvas_width?>" height="<?=$canvas_height?>" title="<?=$photo3_at?>"></canvas><br>
                [4]
                <canvas id="photo_4" class="photo selectphoto" width="<?=$canvas_width?>" height="<?=$canvas_height?>" title="<?=$photo4_at?>"></canvas><br>
                [5]
                <canvas id="photo_5" class="photo selectphoto" width="<?=$canvas_width?>" height="<?=$canvas_height?>" title="<?=$photo5_at?>"></canvas><br>
                [6]
                <canvas id="photo_6" class="photo selectphoto" width="<?=$canvas_width?>" height="<?=$canvas_height?>" title="<?=$photo6_at?>"></canvas><br>

            </div>       

        </div>
    </body>
</html>
