<?php
session_start();

require_once("MYDB.php");
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <title>アップデートフォーム</title>
</head>
<body>
    <hr>
    予定更新画面
    <hr>
    [<a href="list.php">戻る</a>]<br>
    
<?php
    $pdo = db_connect();

    if (isset($_GET['id']) && $_GET['id']>0) {
        $id = $_GET['id'];
        $_SESSION['id'] = $id;
    } else {
        exit('パラメータが不正です。');
    }

    try {
        $sql = "SELECT * FROM cal_sche WHERE id = :id";
        $stmh = $pdo->prepare($sql);
        $stmh->bindValue(':id', $id, PDO::PARAM_INT);
        $stmh->execute();
        $count = $stmh->rowCount();
    } catch (PDOException $Exception) {
        print "エラー：".$Exception->getMessage();  
    }

    if ($count < 1) {
        print "更新データがありません。<br>";
    } else {
        $row = $stmh->fetch(PDO::FETCH_ASSOC);
?>
    <form name="form1" method="post" action="list.php">
        日付：<?=htmlspecialchars($row['id'])?><br>
        予定：<input type="text" name="plan_text" value="<?=htmlspecialchars($row['plan_text'], ENT_QUOTES)?>"><br>  
        <input type="hidden" name="action" value="update">
        <input type="submit" value="更 新">
    </form>
<?php
    }
?> 
</body>
</html>