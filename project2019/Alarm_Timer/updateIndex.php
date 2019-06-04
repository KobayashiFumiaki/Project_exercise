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
		<strong>データ編集</strong>
	</div>
</div>
<div class="padding-y-5">
	<div class="container padding-y-5">
		<table style="width:100%" class="table table-striped table-bordered">
			<thead>
				<tr>
					<th style="width:25%" class="color-main text-center">番号</th>
					<th style="width:25%" class="color-main text-center">時間(時)</th>
					<th style="width:25%" class="color-main text-center">時間(分)</th>
					<th style="width:25%" class="color-main text-center">入/切</th>
				</tr>
			</thead>
			<tbody>
			<?php
			// データベースへ接続
			$dsn = "mysql:dbname=project2019db;host=localhost;port=3306;charset=utf8";
            $user = "project2019";
            $password = "prg05";

			$dbInfo = new PDO ( $dsn, $user, $password );

			// SQL（検索）の実行
			$sql = "SELECT * FROM alarm";

			// データの数だけ繰り返し
			foreach ( $dbInfo->query ( $sql ) as $record ) {
				echo "<tr>" ;
				echo "<td>" . $record ["number"] . "</td>";
				echo "<td>" . $record ["hour"] . "</td>";
				echo "<td>" . $record ["minute"] . "</td>";
				echo "<td>" . $record ["switch"] . "</td>";
				echo "</tr>";
			}
			?>
			</tbody>
		</table>
	</div>
</div>
<div class="padding-y-5">
	<div class="container padding-y-5">
		<strong class="color-main">編集する番号を選択してください</strong>
	</div>
</div>
<div class="padding-y-5">
	<div class="container padding-y-5">
		<form action="updateConfirm.php" method="post">
			<table style="width:25%" class="table">
				<tr>
					<td>
						<select name="number" class="form-control">
						<?php
						foreach ( $dbInfo->query ( $sql ) as $record ) {
							echo "<option value='" . $record ["number"] . "'>";
							echo $record ["number"] . "</option>";
						}
						// データベースの切断
						$dbInfo = null;
						?>
						</select>
					</td>
					<td><input type="submit" value="更新する" class="btn"></td>
				</tr>
			</table>
		</form>
	</div>
</div>
<?php
require_once ("footer.php");
?>
</body>
</html>
