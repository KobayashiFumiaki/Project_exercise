<!DOCTYPE html>
<html lang="ja">
    <head>
        <title>連絡帳[挿入確認画面]</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    
    <body>
        <?php
        $db_user = "project2019";    //ユーザー名
        $db_pass = "prg05";  //パスワード
        $db_host = "localhost"; //ホスト名
        $db_name = "project2019db";  //データベース名
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
            <a href="from.html" type="bottun">戻る</a> 
    </body>
</html>
