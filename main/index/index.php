<?php
    /*
        http://localhost/indei/flowcore/main/index/index
    */

    require_once('../../root/session/outsession.php');

    if(!isset($ds)){
        require_once('../../db/db_operation/db_operation.php');
        $ds = new CodeSearch;
    }

    /*--------------ヘッダーの内容を取得--------------*/
    require_once('../header_footer/header.php');
    $headerhtml = gethaderhtml($ds , $sign_in_flug , $administrator_flug , $userid);

    /*-------サイドバーとメイン画面の表示内容を取得------*/
    require_once('./index_root.php');
    

?>

<!DOCTYPE html>
<html lang="ja">
<head>

    <meta charset="UTF-8">

    <link href="../../modules/bootstrap-5.3.0-dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="../../modules/jquery3.7.1.min/jquery3.7.1.min.js"></script>
    <script src="../../modules/bootstrap-5.3.0-dist/js/bootstrap.min.js"></script>
    <script src="../../modules/bootstrap-5.3.0-dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <link href="./index.css" rel="stylesheet">

    <title>flowcore</title>

</head>

<body>
    
    <?=$headerhtml ?? ''?>
    
    <div class="container-fluid">

        <div class="row">

            <nav class="col-md-2 d-none d-md-block bg-light sidebar vh-100">
                <div class="sidebar-sticky">
                    <?=$sideber?>
                </div>
            </nav>
            
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4" >
                <div class="row border border-dark vw-75 overflow-scroll"" style="padding : 1rem;">
                    <?=$cardval ?? ''?>
                </div>
            </main>      

        </div>

    </div>

</body>
</html>