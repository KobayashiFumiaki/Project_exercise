<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <title>予定登録フォーム</title>
         <link href="page_style.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div id="cover"><!--水色部分-->
            <div id="contents"><!--赤色部分-->
                <center>
    
    <?php
    require_once("MYDB.php");
    $pdo = db_connect();
    
    //削除処理
    if(isset($_GET['action']) && $_GET['action']=='delete' && $_GET['id']>0){
        
        try {
            $pdo->beginTransaction();
            $id = $_GET['id'];
            $sql = "DELETE FROM member WHERE id = :id";
            $stmh = $pdo->prepare($sql);
            $stmh->bindValue(':id', $id, PDO::PARAM_INT);
            
            $stmh->execute();
            $pdo->commit();
            print "データを" .$stmh->rowCount(). "件、削除しました。<br>";
        } catch (PDOException $Exception) {
            $pdo->rollBack();
            print "エラー" .$Exception->getMessage();
        }
    }
    
    //挿入処理
    if(isset($_POST['action']) && $_POST['action']=='insert'){
        try {
            $pdo->beginTransaction();
            //$sql="INSERT INTO member (last_name, first_name, age) VALUES (:last_name, :first_name, :age)";
            $sql="INSERT INTO member (plan_text) VALUES (:plan_text)";
            $stmh = $pdo->prepare($sql);
     
            //$stmh->bindValue(':last_name', $_POST['last_name'], PDO::PARAM_STR); 
            $stmh->bindValue(':plan_text', $_POST['plan_text'], PDO::PARAM_STR);   
            
            $stmh->execute();
            
            $pdo->commit();
            print "データを".$stmh->rowCount(). "件、挿入しました。<br>";
            ?>
            <input type="button" value="戻る" onClick="window.open('http://localhost/docs/project2019/Schedule_Calendar/main.html')">
            <?php
            return ;
        } catch (PDOException $Exception) {
            $pdo->rollBack();
            die('エラー:' .$Exception->getMessage());
        }
    }
    
    //更新処理
    if(isset($_POST['action']) && $_POST['action']=='update'){
        //セッション変数よりidを受け取る　
        $id = $_SESSION['id'];
        
        try {
            $pdo->beginTransaction();
            $sql = "UPDATE member SET
                    plan_text = :plan_text
                   
                WHERE id = :id";
            
            $stmh = $pdo->prepare($sql);
            $stmh->bindValue(':plan_text', $_POST['plan_text'], PDO::PARAM_STR);
            $stmh->bindValue(':id', $id, PDO::PARAM_INT);   
           
            $stmh->execute();
            
            $pdo->commit();
            print "データを" .$stmh->rowCount(). "件、更新しました。<br>";
        } catch (PDOException $Exception) {
            $pdo->rollBack();
            print "エラー:" .$Exception->getMessage();
        }
    
    //使用したセッション変数を削除する
    unset($_SESSION['id']);
    }
    
    //全データ表示
    try{
        if(isset($_POST['search_key']) && $_POST['search_key'] != ""){
            $search_key = '%' .$_POST['search_key']. '%';
            //$sql = "SELECT * FROM member WHERE last_name like :last_name OR first_name like :first_name";
            $sql = "SELECT * FROM member WHERE plan_text like :plan_text";
            $stmh = $pdo->prepare($sql);
            
            //$stmh->bindValue(':last_name', $search_key, PDO::PARAM_STR);
            $stmh->bindValue(':plan_text', $search_key, PDO::PARAM_STR);
            
            $stmh->execute();
        }else{
            $sql = "SELECT * FROM member";
            $stmh = $pdo->query($sql);
        }
        $count = $stmh->rowCount();
    } catch (PDOException $Exception) {
        $pdo->rollBack();
        print "エラー:" .$Exception->getMessage();
    }
    ?>
            
    
    <h1>イベント一覧</h1>
    <hr>
    
    <form name="form1" method="post" action="list.php">
        予定：<input type="text" name="search_key"> 
        <input type="submit" value="検索する">
    </form>
      
    <?php
    //検索データを表示する
    try{
        if(isset($_POST['search_key']) && $_POST['search_key'] != ""){
            $search_key = '%' .$_POST['search_key']. '%';
            //$sql = "SELECT * FROM member WHERE last_name like :last_name OR first_name like :first_name";
            $sql = "SELECT * FROM member WHERE plan_text like :plan_text";
            $stmh = $pdo->prepare($sql);
            
            //$stmh->bindValue(':last_name', $search_key, PDO::PARAM_STR);
            $stmh->bindValue(':plan_text', $search_key, PDO::PARAM_STR);
            
            $stmh->execute();
        }else{
            $sql = "SELECT * FROM member";
            $stmh = $pdo->query($sql);
        }
        $count = $stmh->rowCount();
        
        print "<br>検索結果は" .$count. "件です。<br>";
    } catch (PDOException $Exception) {
        $pdo->rollBack();
        print "エラー:" .$Exception->getMessage();
    }
    
    if($count < 1){
            print "検索結果がありません。<br>";
    }else{
    ?>
    <table border=1;>
        <tbody>
            <tr>
                <th>ID</th>
                <th>日付・予定</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
            </tr>
            <?php
            while($row=$stmh->fetch(PDO::FETCH_ASSOC)){
            ?>
            <tr>
                <td><?=htmlspecialchars($row['id'], ENT_QUOTES)?></td>
                <td><?=htmlspecialchars($row['plan_text'], ENT_QUOTES)?></td>
                
                <td><a href=updateform.php?id=<?=htmlspecialchars($row['id'], ENT_QUOTES)?>>更新</a></td>
                <td><a href=list.php?action=delete&id=<?=htmlspecialchars($row['id'], ENT_QUOTES)?>>削除</a></td>
            </tr>
            <?php
            }
            ?>
            </tbody>
        </table>
    <?php
    }
    ?>    
    
    <input type="button" value="戻る" onClick="window.open('http://localhost/docs/project2019/Schedule_Calendar/list.php')">
    <input type="button" value="カレンダーへ" onClick="window.open('http://localhost/docs/project2019/Schedule_Calendar/main.html')">
    <br><br><a href="http://yahoo.co.jp" class="square_btn">メインページへ</a>
                </center>        
            </div>
        </div>
    </body>
</html>
    