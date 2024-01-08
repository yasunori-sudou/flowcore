<?php
    /*
        http://localhost/indei/flowcore/flow/3_order/entry/order_entry
    */
    if(!isset($ds)){
        require('../../../db/db_operation/db_operation.php');
        $ds = new CodeSearch;
    }

    require('./order_entry_value.php');

?>
<!DOCTYPE html>
<html lang="ja" class="h-100">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.6, minimum-scale=0.4, maximum-scale=1.2">

    <link href="../../../modules/bootstrap-5.3.0-dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="../../../modules/jquery3.7.1.min/jquery3.7.1.min.js"></script>
    <script src="../../../modules/bootstrap-5.3.0-dist/js/bootstrap.min.js"></script>
    <script src="../../../modules/bootstrap-5.3.0-dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="./order_entry.css?ver=1.0.0">
    <script src="./order_entry.js?ver=1.0.0"></script>

    <title>公差外_焼成データ</title>
    
</head>

<body class="mainbody d-flex flex-column h-100">

    <div class="row">
        <!-----------------------メイン------------------------>
        <main class="container-sm">   
            
        </main>
    </div>

</body>
</html>