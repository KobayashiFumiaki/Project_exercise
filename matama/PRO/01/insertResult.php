<?php
// 直接ページにアクセスされたときの対処
if (! isset ( $_POST ["hour"] )) {
	header ( "Location: insertIndex.php" );
}else{
	// 送信データの取得
	$pHour = $_POST ["hour"];
	$pMinute = $_POST ["minute"];
	$pSwitch = $_POST ["switch"];

	// データベースへ接続
	$dsn = "mysql:dbname=tool;host=localhost;port=3306;charset=utf8";
	$user = "root";
	$password = "";

	$dbInfo = new PDO ( $dsn, $user, $password );

	// SQL（挿入）の実行
	$sql = "INSERT INTO alarm(hour, minute, switch) VALUES (:hour, :minute, :switch)";
	$stmt = $dbInfo->prepare ( $sql );
	$stmt->bindParam ( ":hour", $pHour, PDO::PARAM_INT );
	$stmt->bindParam ( ":minute", $pMinute, PDO::PARAM_INT );
	$stmt->bindParam ( ":switch", $pSwitch, PDO::PARAM_STR );
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
	<link rel="stylesheet" type="text/css" href="/PRO/css/skyblue.css">
</head>
<body>
<?php
require_once ("header.php");
?>
<div class="bg-success padding-y-5">
	<div class="container padding-y-5">
		<strong>追加結果</strong>
	</div>
</div>
<div class="padding-y-5">
	<div class="container padding-y-5">
		<strong>
			<?php
			if ($result > 0) {
				echo "<div style='color:#ff0000'>データを追加しました</div>";
			} else {
				echo "<div style='color:#ff0000'>データを追加できませんでした</div>";
			}
			?>
		</strong>
	</div>
</div>
</body>
</html>
