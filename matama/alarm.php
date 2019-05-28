<?php
class Pencil {
	private $id;    // 商品ID
	private $maker; // メーカー
	private $hardness; // 硬度（HかB）
	private $price; // 価格

	// コンストラクタ
	public function __construct($id, $maker, $hardness, $price) {
		$this->id = $id;
		$this->maker = $maker;
		$this->hardness = $hardness;
		$this->price = $price;
	}

	// プロパティのデータを表示するメソッド
	public function printData() {
		echo "<tr>";
		echo "<td>". $this->id. "</td>";
		echo "<td>". $this->maker. "</td>";
		echo "<td>". $this->hardness. "</td>";
		echo "<td>". $this->price. "</td>";
		echo "</tr>";
	}
}
?>
