<?php
    include('../../modules/datasarch/datasarch.php');
    $ds = new CodeSearch;//SQL実行のインスタンス  

    require('./pagenation.php');
    $pagenation = new Pagenation;
    $cureent = 1;//現在のページ位置 デフォルトは1にすること
    $tablename = '金型マスタ';//表示するDBのテーブル名
    $countclumn = 'id';//auto_incrementの列を指定する maxrowと編集のIDに使用する
    $selectcolumn = '*';//SQLのSELECT文で指定するカラム
    $splitrow = 24;//レコードを何行で区切るか
    $sql = '';//指定するSQLがあれば指定※セミコロンは外すこと

    $getpage = $pagenation->pagenation_fullmake($ds,$cureent,$tablename,$countclumn,$selectcolumn,$splitrow,$sql);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<link rel="shortcut icon" href="../../icon.png">
<link rel="stylesheet" href="../../css/mainstyle/style.css">

<script src="https://use.fontawesome.com/releases/v5.3.1/js/all.js" defer ></script>
<link rel="stylesheet" href="../../css/bulma/css/bulma.min.css" />
<script src="../../modules/jquery/3.6.1/jquery-3.6.1.min.js"></script>

<title>ページングテスト</title>
</head>
<body>
<?php include('../../root/header_footer/header_nk.php'); ?><!--hedder-->

    <div id="pagemain">
        <?=$getpage?>
    </div>

</body>
</html>