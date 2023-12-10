<?php

    /*   
        ----------CodeSearchクラス　関数概要--------
        インスタンス作成
        require('../../modules/datasarch/datasarch.php');
        $dataget = new CodeSearch;
        
        :::::::::::::::::::使用例:::::::::::::::::::
        $orderarray = $dataget->Almighty($sql,$parameterArray);

    */

    //use JetBrains\PhpStorm\Internal\ReturnTypeContract;

    class CodeSearch{

        /**
         * 受け取ったSQLに対してオールマイティーな処理をする
         *
         * @param string $sql SQL
         * @param array $parameterArray SQLに渡す配列
         * @return array SQLの結果の2次元配列
         */
        function Almighty($sql,$parameterArray,$dbname = ''){

            include(dirname(__FILE__)."/../mysqlpath/mysqlpath.php");
            try {
                $stmt = $pdo->prepare($sql);

                if(empty($parameterArray)){
                    $stmt->execute(); 
                }else{
                    $stmt->execute($parameterArray); 
                }

                $RetuenArray = array();

                while(1){
                    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
                    if($rec==false){break;}         

                    array_push($RetuenArray,$rec);
                }
                $pdo = null;
            } catch (PDOException $e) {
                echo 'データベースでエラーが発生しました。';
                echo $e->getMessage();
                exit;
            }	
            return $RetuenArray;
        }

        /**
         * Auto Incrementの次回値を取得
         *
         * @param string $tabelName
         * @return int $nextAI AutoIncrementの次回値
         */
        function NextAutoIncrement($tabelName,$dbname = ''){
            include(dirname(__FILE__)."/../mysqlpath/mysqlpath.php");
            try {	
                $stmt = $pdo->prepare("SHOW TABLE STATUS LIKE '".$tabelName."';");
                $stmt->execute(array()); 
                $nextAI = '';

                while(1){
                    $rec = $stmt->fetch(PDO::FETCH_ASSOC);if($rec==false){break;}   
                    $nextAI = $rec['Auto_increment'];  
                }
                
                $pdo = null;
            } catch (PDOException $e) {
                echo 'Auto_Incrementが取得出来ません。<br>データベースでエラーが発生しました。';
                echo $e->getMessage();
                exit;
            }

            return $nextAI;
        }
        
        /**
         * テーブルの見出し行一覧を取得
         *
         * @param string $tableName
         * @return テーブル名一覧の配列
         */
        function TableHeaderGet($tableName){
            include(dirname(__FILE__)."/../mysqlpath/mysqlpath.php");
            try {   

                $stmt = $pdo->prepare("SELECT COLUMN_NAME,COLUMN_TYPE FROM INFORMATION_SCHEMA.COLUMNS 
                WHERE TABLE_SCHEMA= 'nfsystem_dia' AND TABLE_NAME= ?");
                $stmt->execute(array($tableName)); 

                $heddarArray = array();  

                while(1){
                    $rec = $stmt->fetch(PDO::FETCH_ASSOC);if($rec==false){break;} 
                    //mb_convert_variables("sjis","utf8",$rec['COLUMN_NAME']);
                    array_push($heddarArray,$rec);
                }
                $pdo = null;

            } catch (PDOException $e) {
                echo 'データベースでエラーが発生しました。<br>';
                echo $e->getMessage();
                exit;
            }
            return $heddarArray;

        }

        /**
         * テーブル名一覧を取得する
         *
         * @return テーブル一覧の配列
         */
        function TableNameGet(){
            include(dirname(__FILE__)."/../mysqlpath/mysqlpath.php");
            try {   

                $stmt = $pdo->prepare("SELECT TABLE_NAME FROM INFORMATION_SCHEMA.COLUMNS 
                WHERE TABLE_SCHEMA= 'nfsystem_dia'");
                $stmt->execute(); 

                $heddarArray = array();  

                while(1){
                    $rec = $stmt->fetch(PDO::FETCH_ASSOC);if($rec==false){break;} 
                    array_push($heddarArray,$rec['TABLE_NAME']);
                }

                $pdo = null;

            } catch (PDOException $e) {
                echo 'データベースでエラーが発生しました。<br>';
                echo $e->getMessage();
                exit;
            }
            return $heddarArray;

        }


        /**
         * 引数$strをハッシュ値に変換する
         *
         * @param string $str
         * @return string 変換されたハッシュ値
         */
        function Hash_Make($str){
            $cost= 10;
            $char = "./0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
            $salt = "";

            for($i = 0; $i < 22; $i++){
                $r = mt_rand(0, strlen($char) - 1);
                $salt .= substr($char, $r, 1);
            }

            if($cost < 4){
                $cost = 4;
            }else if($cost > 31){
                $cost = 31;
            }
            return crypt($str, "$2y$" . sprintf("%02d", $cost) . "$" . $salt);
        }

        /**
         * 引数$strが正しいかチェック
         *
         * @param string $str
         * @return boolean trueならパスワード合致、falseならパスワード非合致
         */
        function Hash_test($str){

            $makePass = $this->Hash_Make($str);

            if(crypt($str, $makePass) == $makePass){
                return true;
            }else{
                return false;
            }        
        }


        /**
         * ユーザーログイン処理を行う
         *
         * @param string $user_id ユーザーID 空白は無効
         * @param string $password パスワード 空白は無効
         * @return array
         */
        function login_collation($user_id,$password){

            //セッションが開始していなければ開始する
            if (session_status() == PHP_SESSION_NONE) {
                session_start ();
                session_regenerate_id(true);	
            }

            $collation = false;//trueならLogin成功
            $iderrorMessage = '';
            $passerrorMessage = '';

            if(empty($user_id)) {  
                $iderrorMessage = 'ユーザーIDが未入力です。';

            }else if(empty($password)) {
                $passerrorMessage = 'パスワードが未入力です。';

            }
            /*-----------データ検索------------*/
            $sql = "SELECT `ユーザーNo`,`ユーザー名1`,`パスワード` FROM `ユーザーマスタ` WHERE `ユーザーID` = ?";
            $user_res = $this->Almighty($sql,array($user_id));

            if(empty($user_res)){
                $iderrorMessage = '指定のIDが見つかりません。';

            }else{
                $dbpass = $user_res[0]['パスワード'];
                /*----------パスワード照合----------*/
                if(crypt($password, $dbpass) == $dbpass){
                    $id = $user_res[0]['ユーザーNo'];
                    $name = $user_res[0]['ユーザー名1'];

                    /*-----------ログイン時刻の更新------------*/
                    $sql = "UPDATE `ユーザーマスタ` SET `login_at`= ? WHERE `ユーザーNo` = ?;";
                    $this->Almighty($sql,array(date("Y-m-d H:i:s"),$id));

                    /*-----------次のページに受け渡す情報をセット------------*/
                    $_SESSION["user_id"] = $id;//userid
                    $_SESSION["id_name"] = $user_id;//ID名
                    $_SESSION["name"] = $name;//ユーザー名
                    
                    $collation = true;
                }else{
                    $passerrorMessage = 'パスワードが正しくありません。';
                }

            }
            
            session_write_close();

            return array(
                'collation' => $collation,
                'iderrorMessage' => $iderrorMessage,
                'passerrorMessage' => $passerrorMessage
            );
        }


        /**
         * アップロードファイルをバイナリデータに変換してデータベースに保存する
         *
         * @param [string] $sql
         * @param [string] $val
         * @return void
         */
        function DataUploar_blob($sql,$val){
            include(dirname(__FILE__)."/../mysqlpath/mysqlpath.php");

            if ($_FILES['upfile']['name'] !== ''){
                //ここにバリデーションチェックが入る（省略）
                
                //バイナリデータ変換処理
                $raw_data = file_get_contents($_FILES['upfile']['tmp_name']);
                $paramarray = array($raw_data);

                try {
                    $stmt = $pdo->prepare($sql);

                    $stmt->execute($paramarray); 
                    $pdo = null;
                } catch (PDOException $e) {
                    echo 'データベースでエラーが発生しました。';
                    echo $e->getMessage();
                    exit;
                }	

            }
        }

    /*******Class___End*******/
    }

?>