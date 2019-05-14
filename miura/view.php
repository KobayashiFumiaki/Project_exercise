<!DOCTYPE html>
<html lang="ja">
    <head>
        <title>連絡帳</title>
    </head>
    <body>
        <?php
        $db_user = "root";    //ユーザー名
        $db_pass = "";  //パスワード
        $db_host = "localhost"; //ホスト名
        $db_name = "contact";  //データベース名
        $db_type = "mysql";     //データベースの種類
        
        $dsn = "$db_type:host=$db_host;dbname=$db_name;charset=utf8";
        
        try {
            $pdo = new PDO($dsn, $db_user, $db_pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE,
                               PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            print "接続しました...<br>";
        } catch (PDOException $Exception) {
            die('エラー:' .$Exception->getMessage());
        }
        
        try {
            $pdo->beginTransaction();
            $sql="INSERT INTO book (name, email_address, phone_number) VALUES (:name, :email_address, :phone_number)";
            $stmh = $pdo->prepare($sql);
     
            $stmh->bindValue(':name', $_POST['name'], PDO::PARAM_STR);
            $stmh->bindValue(':email_address', $_POST['email_address'], PDO::PARAM_STR);
            $stmh->bindValue(':phone_number', $_POST['phone_number'], PDO::PARAM_INT);   
            
            $stmh->execute();
            
            $pdo->commit();
            print "データを".$stmh->rowCount(). "件、挿入しました。<br>";
        } catch (PDOException $Exception) {
            $pdo->rollBack();
            print "エラー:".$Exception->getMessage();
        }
        
        ?>
      
    </body>
</html>
