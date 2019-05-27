<?php
// 直接ページにアクセスされたときの対処
if (! isset ( $_POST ["number"] )) {
	header ( "Location: deleteIndex.php" );
}else{
	// 送信データの取得
	$number = $_POST ["number"];

	// データベースへ接続
	$dsn = "mysql:dbname=tool;host=localhost;port=3306;charset=utf8";
	$user = "root";
	$password = "";

	$dbInfo = new PDO ( $dsn, $user, $password );

	// SQL（削除）の実行
	$sql = "DELETE FROM alarm WHERE number=:number";
	$stmt = $dbInfo->prepare ( $sql );
	$stmt->bindParam ( ":number", $number, PDO::PARAM_INT );
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
		<strong>削除結果</strong>
	</div>
</div>
<div class="padding-y-5">
	<div class="container padding-y-5">
		<strong>
			<?php
			if ($result > 0) {
				echo "<div class='color-error'>データを削除しました</div>";
			} else {
				echo "<div class='color-error'>データを削除できませんでした</div>";
			}
			?>
		</strong>
	</div>
</div>
</body>
</html>
