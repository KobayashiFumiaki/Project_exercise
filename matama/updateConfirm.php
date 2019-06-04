<?php
// 直接ページにアクセスされたときの対処
if (! isset ( $_POST ["number"] )) {
	header ( "Location: updateIndex.php" );
}else{
	// 送信データの取得
	$number = $_POST ["number"];

	// データベースへ接続
	$dsn = "mysql:dbname=project2019db;host=localhost;port=3306;charset=utf8";
    $user = "project2019";
    $password = "prg05";

	$dbInfo = new PDO ( $dsn, $user, $password );

	// SQL（検索）の実行
	$sql = "SELECT * FROM alarm WHERE number=" . $number;
	$result = $dbInfo->query ( $sql );
	$record = $result->fetch ( PDO::FETCH_ASSOC );

	$hour = $record ["hour"];
	$minute = $record ["minute"];
	$switch = $record ["switch"];

	// データベースの切断
	$dbInfo = null;
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>テーブルのデータを更新しよう</title>
	<link rel="stylesheet" type="text/css" href="skyblue.css">
</head>
<body>
<?php
require_once ("header.php");
?>
<div class="bg-success padding-y-5">
	<div class="container padding-y-5">
		<strong>データ更新</strong>
	</div>
</div>
<div class="padding-y-5">
	<div class="container padding-y-5">
		<strong class="color-main">データを変更してください</strong>
	</div>
</div>
<div class="padding-y-5">
	<div class="container padding-y-5">
		<form action="updateResult.php" method="post">
			<table style="width:100%" class="table">
				<thead>
				<tr>
					<th style="width:20%" class="color-main text-center">番号</th>
					<th style="width:25%" class="color-main text-center">時間(時)</th>
					<th style="width:25%" class="color-main text-center">時間(分)</th>
					<th style="width:30%" class="color-main text-center">入/切</th>
				</tr>
				</thead>
				<tbody>
				<tr>
					<?php
					echo "<td><div class='color-main text-right margin-top-10'>" . $number . "</div></td>" ;
					echo "<input type='hidden' name='number' value='" . $number . "'>";
					?>
					<td>
						<select name="hour" class="form-control">
						<?php
						// データの数だけ繰り返し
                        $var = $hour;
                        $hour = array(0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23);
						foreach ( $hour as $m) {
							if ($m == $var) {
								echo "<option value='" . $m . "' selected>" . $m . "</option>";
							} else {
								echo "<option value='" . $m . "'>" . $m . "</option>";
							}
						}
						?>
						</select>
					</td>
					<td>
						<select name="minute" class="form-control">
						<?php
                        $var = $minute;
						$minute = array(0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59);
						foreach ( $minute as $h ) {
							if ($h == $var) {
								echo "<option value='" . $h . "' selected>" . $h . "</option>";
							} else {
								echo "<option value='" . $h . "'>" . $h . "</option>";
							}
						}
						?>
						</select>
					</td>
					<td>
                        <select name="switch" class="form-control">
						<?php
						$switch = array("切","入");
						foreach ( $switch as $h ) {
							if ($h == $switch) {
								echo "<option value='" . $h . "' selected>" . $h . "</option>";
							} else {
								echo "<option value='" . $h . "'>" . $h . "</option>";
							}
						}
						?>
						</select>
					</td>
				</tr>
				<tr>
					<td colspan="4" style="text-align: right">
						<input type="submit" value="更新する" class="btn">
					</td>
				</tr>
				</tbody>
			</table>
		</form>
	</div>
</div>
<?php
require_once ("footer.php");
?>
</body>
</html>
