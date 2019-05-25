<!DOCTYPE html>
<html lang="ja">
    <head>
        <title>連絡帳[検索結果画面]</title>
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
        
        $search_key = '%' .$_POST['search_key']. '%';
        
        try {
            $sql="SELECT * FROM book WHERE name like :name OR phone_number like :phone_number";
            
            $stmh = $pdo->prepare($sql);
            
            $stmh->bindValue(':name', $search_key, PDO::PARAM_STR);
            $stmh->bindValue(':phone_number', $search_key, PDO::PARAM_STR);
            
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
                    <th>id</th>
                    <th>name</th>
                    <th>email address</th>                    
                    <th>phone number</th> 
                    <th>delete</th>
                </tr>
            <?php
            while($row=$stmh->fetch(PDO::FETCH_ASSOC)){
            ?>
            <tr>
                <td><?=htmlspecialchars($row['id'], ENT_QUOTES)?></td>
                <td><?=htmlspecialchars($row['name'], ENT_QUOTES)?></td>
                <td><?=htmlspecialchars($row['email_address'], ENT_QUOTES)?></td>
                <td><?=htmlspecialchars($row['phone_number'], ENT_QUOTES)?></td>
                <td><a href ="dele.php?&id = $row['id']">[削除]</a></td>
                
            </tr>
            <?php
            }
            ?>
            </tbody>
        </table>
        <?php
        }
        ?>
        <a href="search.html" type="bottun">戻る</a> 
    </body>
</html>

