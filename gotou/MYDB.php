<!DOCTYPE html>
<html>
    <head>
        <title>PHPのテスト</title>
    </head>
    <body>
    <?php

        //db_connect関数(接続機能)
        function db_connect(){
            $db_user = "project2019";    //ユーザー名
            $db_pass = "prg05";          //パスワード
            $db_host = "localhost";      //ホスト名
            $db_name = "project2019db";  //データベース名
            $db_type = "mysql";          //データベースの種類
        
            $dsn = "$db_type:host=$db_host;dbname=$db_name;charset=utf8";
        
            try {
                $pdo = new PDO($dsn, $db_user, $db_pass);
                $pdo->setAttribute(PDO::ATTR_ERRMODE,
                                   PDO::ERRMODE_EXCEPTION);
                $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            } catch (PDOException $Exception) {
                die('エラー:' .$Exception->getMessage());
            }
            return $pdo;
        }
        
    ?>
        
    </body>
</html>
