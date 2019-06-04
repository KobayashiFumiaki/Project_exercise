<?php
class Alarm {
	private $number;    // ID
	private $hour; // 時間（時）
	private $minute; // 時間（分）
	private $switch; // ON・OFF

	// コンストラクタ
	public function __construct($number, $hour, $minute, $switch) {
		$this->number = $number;
		$this->hour = $hour;
		$this->minute = $mimute;
		$this->switch = $switch;
	}

	// プロパティのデータを表示するメソッド
	public function printData() {
		echo "<tr>";
		echo "<td>". $this->number. "</td>";
		echo "<td>". $this->hour. "</td>";
		echo "<td>". $this->minute. "</td>";
		echo "<td>". $this->switch. "</td>";
		echo "</tr>";
	}
}
?>
