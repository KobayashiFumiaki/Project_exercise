<?php
// 直接ページにアクセスされたときの対処
if (! isset ( $_POST ["number"] )) {
	header ( "Location: updateIndex.php" );
}else{
	// 送信データの取得
	$pNumber = $_POST ["number"];
	$pHour = $_POST ["hour"];
	$pMinute = $_POST ["minute"];
	$pSwitch = $_POST ["switch"];

	// データベースへ接続
	$dsn = "mysql:dbname=project2019db;host=localhost;port=3306;charset=utf8";
    $user = "project2019";
    $password = "prg05";

	$dbInfo = new PDO ( $dsn, $user, $password );

	// SQL（更新）の実行
	$sql = "UPDATE alarm SET hour=:hour, minute=:minute, switch=:switch WHERE number=:number";
	$stmt = $dbInfo->prepare ( $sql );
	$stmt->bindParam ( ":hour", $pHour, PDO::PARAM_INT );
	$stmt->bindParam ( ":minute", $pMinute, PDO::PARAM_INT );
	$stmt->bindParam ( ":switch", $pSwitch, PDO::PARAM_STR );
	$stmt->bindParam ( ":number", $pNumber, PDO::PARAM_INT );
	$stmt->execute ();

	// 更新行の取得
	$result = $stmt->rowCount ();

	// データベースの切断
	$dbInfo = null;
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>アラーム</title>
	<link rel="stylesheet" type="text/css" href="skyblue.css">
</head>
<body>
<?php
require_once ("header.php");
?>
<div class="bg-success padding-y-5">
	<div class="container padding-y-5">
		<strong>更新結果</strong>
	</div>
</div>
<div class="padding-y-5">
	<div class="container padding-y-5">
		<strong>
			<?php
			if ($result > 0) {
				echo "<div style='color:#ff0000'>データを更新しました</div>";
			} else {
				echo "<div style='color:#ff0000'>データを更新できませんでした</div>";
			}
			?>
		</strong>
	</div>
</div>
</body>
</html>
