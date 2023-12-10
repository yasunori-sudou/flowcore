<?php
    
    if(isset($_POST['makeno'])){

        include('../../modules/datasarch/datasarch.php');
        $ds = new CodeSearch;

        $makeno = $_POST['makeno'];
        $base64 = $_POST['base64'];
        $photono = intval($_POST['photono']);
        $photo_at = date('Y-m-d H:i:s');

        $sql = "SELECT COUNT(`製造No`) AS cnt FROM `photodata` WHERE `製造No` = ?;";
        $check = $ds->Almighty($sql,array($makeno));

        if(empty($check[0]['cnt'])){
            //新規登録
            $sql = "INSERT INTO `photodata`(`製造No`,`photo".$photono."`,`photo".$photono."_at`) VALUES(?,?,?);";
            $ds->Almighty($sql,array($makeno,$base64,$photo_at));

        }else{
            //更新
            $sql = "UPDATE `photodata` SET `photo".$photono."` = ?,`photo".$photono."_at` = ? WHERE `製造No` = ?;";
            $ds->Almighty($sql,array($base64,$photo_at,$makeno));     

        }

        echo json_encode($photo_at);

    }else if(isset($_GET['delete'])){

        include('../../modules/datasarch/datasarch.php');
        $ds = new CodeSearch;

        $makeno = $_GET['makeno'];
        $photono = intval($_GET['photono']);

        $sql = "UPDATE `photodata` SET `photo".$photono."` = '',`photo".$photono."_at` = null WHERE `製造No` = ?;";
        $ds->Almighty($sql,array($makeno));

        echo json_encode($makeno); 
    }else{   
        echo [];
    }

?>