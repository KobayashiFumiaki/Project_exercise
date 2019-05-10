<!DOCTYPE html>
<html lang="ja">
    <head>
        <title>PHPのテスト</title>
    </head>
    <body>
        <?php
        $db_user = "sample";    //ユーザー名
        $db_pass = "password";  //パスワード
        $db_host = "localhost"; //ホスト名
        $db_name = "sampledb";  //データベース名
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
        
        $search_key = '%' .$_POST['search_key']. '%';
        
        try {
            $sql="SELECT * FROM member WHERE last_name like :last_name OR first_name like :first_name";
            
            $stmh = $pdo->prepare($sql);
            
            $stmh->bindValue(':last_name', $search_key, PDO::PARAM_STR);
            $stmh->bindValue(':first_name', $search_key, PDO::PARAM_STR);
            
            $stmh->execute();
            $count = $stmh->rowCount();
            print "検索結果は" .$count. "件です。<br>";
        } catch (PDOException $Exception) {
            print "エラー:".$Exception->getMessage();
        }
        
        if($count < 1){
            print "検索結果がありません。<br>";
        }else{
            ?>
        <table border=1;>
            <tbody>
                <tr>
                    <th>番号</th>
                    <th>氏</th>
                    <th>名</th>                    
                    <th>年齢</th> 
                </tr>
            <?php
            while($row=$stmh->fetch(PDO::FETCH_ASSOC)){
            ?>
            <tr>
                <td><?=htmlspecialchars($row['id'], ENT_QUOTES)?></td>
                <td><?=htmlspecialchars($row['last_name'], ENT_QUOTES)?></td>
                <td><?=htmlspecialchars($row['first_name'], ENT_QUOTES)?></td>
                <td><?=htmlspecialchars($row['age'], ENT_QUOTES)?></td>
            </tr>
            <?php
            }
            ?>
            </tbody>
        </table>
        <?php
        }
        ?>
   
    </body>
</html>