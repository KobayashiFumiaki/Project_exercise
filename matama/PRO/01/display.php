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
		<strong>アラームリスト</strong>
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
			$dsn = "mysql:dbname=tool;host=localhost;port=3306;charset=utf8";
			$user = "root";
			$password = "";

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
    
    <div class="bg-success padding-y-5">
	<div class="container padding-y-5">
		<strong>アラームリスト(作動中)</strong>
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
			$dsn = "mysql:dbname=tool;host=localhost;port=3306;charset=utf8";
			$user = "root";
			$password = "";

			$dbInfo = new PDO ( $dsn, $user, $password );

			// SQL（検索）の実行
			$sql = "SELECT * FROM alarm";

			// データの数だけ繰り返し
			foreach ( $dbInfo->query ( $sql ) as $record ) {
                if($record["switch"] == "入"){
				echo "<tr>" ;
				echo "<td>" . $record ["number"] . "</td>";
				echo "<td>" . $record ["hour"] . "</td>";
				echo "<td>" . $record ["minute"] . "</td>";
				echo "<td>" . $record ["switch"] . "</td>";
				echo "</tr>";
                }
			}
			?>
			</tbody>
		</table>
	</div>
</div>
    
    
	<div id="alarm_dialog" style="display: none;">
            セットした時刻になりました
            <input type="button" value="アラームを止める" onclick="alarm_stop()">
        </div>
    
    <audio src="sound.mp3" id="sound"></audio>
    
    <?php
        $count=0;
        foreach( $dbInfo->query ($sql) as $record) {
            if($record["switch"] == "入"){
                $count =1;
                $list_hour = $record["hour"];
                $list_minute = $record["minute"];
            }
        }
    
        $count1 =0;
        $count2 =0;
        $count1 = $count;
        $count2 = $count;
        ?>
    
    <script>
        
    
        
    
    var hour = "<?php echo $list_hour ?>";
    var minute = "<?php echo $list_minute ?>";
    var alarm_set = false;
    var alarm_set2 = false;
    var alarm_hour = 0;
    var alarm_minute = 0;
    var alarm_dialog = document.getElementById("alarm_dialog");
    var sound = document.getElementById("sound");
        
    var time = new Date;
        
        
        
    //音楽ファイルセット
        if ("<?php echo $count1; ?>;" != 0) {
                alarm_hour = hour;
                alarm_minute = minute;
                    sound.load();
                };
    //音楽停止
        function alarm_stop() {
                alarm_dialog.style.display = "none";
                sound.pause();
                sound.currentTime = 0;
            }
        
    sound.onended = function() {
                alarm_stop();
            };
        
        function main() {
                var time = new Date;

                if (0 != "<?php echo $count1 ?>" && alarm_hour == time.getHours() && alarm_minute == time.getMinutes()) {
                    "<?php echo $count1 = 0; ?>";
                    sound.play();
                    alarm_dialog.style.display = "block";
                } else if (0 != "<?php echo $count2 ?>" && alarm_minute != time.getMinutes()) {
                    "<?php echo $count1; ?>";
                    alert("11");
                }

                setTimeout(main, 1000-time.getMilliseconds());
            }
    main();
    </script>
    <?php
    // データベースの切断
    $dbInfo = null;
		?>
</body>
</html>
