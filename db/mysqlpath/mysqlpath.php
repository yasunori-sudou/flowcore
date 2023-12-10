<?php

    //MariaDBへのアクセス・記述例

    $db['host'] = "localhost";  // DBサーバのURL
    
    $db['user'] = "root";  // ユーザー名

    $db['pass'] = "";  // ユーザー名のパスワード 
    //$db['pass'] = "nikkifron1896";  // ユーザー名のパスワード VPS用
    //$db['pass'] = "c2085116c";  // ユーザー名のパスワード bkup用

    if(isset($dbname)){
        if(!empty($dbname)){
            $db['dbname'] = $dbname;
        }else{
            $db['dbname'] = "system_template";
        }
    }else{
        $db['dbname'] = "system_template";  // データベース名
    }
    
    
    $dsn = sprintf('mysql: host=%s; dbname=%s; charset=utf8', $db['host'], $db['dbname']);
    $pdo = new PDO($dsn, $db['user'], $db['pass'], array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,PDO::ATTR_EMULATE_PREPARES => false,));

    /*通常のクエリの記述

    include("../../mysql/mysqlpath/mysqlpath.php");
    try {
        $stmt = $pdo->prepare('クエリ');
        $stmt->execute(array('引数',)); 
        $pdo = null;
    } catch (PDOException $e) {
        echo 'データベースでエラーが発生しました。';
        echo $e->getMessage();
        exit;
    }
    $pdo = null;

    */
    /*トランザクション処理の記述

    include("../../mysql/mysqlpath/mysqlpath.php");
    try {	
        $pdo->beginTransaction();

        $stmt = $pdo->prepare('クエリ');
        $stmt->execute(array('引数',)); 

        $stmt = $pdo->prepare('クエリ');
        $stmt->execute(array('引数',)); 

        $pdo->commit();
    } catch(PDOException $e) {
        $pdo->rollBack();
        echo 'データベースでエラーが発生しました。';
        echo $e->getMessage();	die();
    }
    $pdo = null;

    */
?>