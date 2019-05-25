<html lang="ja">
    <head>
        <title>連絡帳[削除確認画面]</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
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
        $GET = filter_input(INPUT_GET, 'id');
//        if(($GET["action"]) && $GET['action'] == 'delete' && $GET['id'] > 0){
            try {

//                $pdo = new PDO($dsn, $db_user, $db_pass);
                $pdo->beginTransaction();
                $id = $GET;
                $sql = "DELETE FROM book WHERE id = id";
                $stmh = $pdo->prepare($sql);
                $stmh ->bindValue(':id', $id , PDO::PARAM_INT);
                $stmh->execute();
                $pdo->commit();
                print "データを" .$stmh->rowCount()."件、削除しました。<br>";
                
            } catch (PDOException $Exception) {
                die('エラー:' .$Exception->getMessage());
            }
            ?>
        <a href="search.html" type="bottun">戻る</a> 
        
   
        