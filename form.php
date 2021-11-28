<?php
require_once("config.php");
$s_id = intval($_GET["s_id"]);
$sql = "SELECT t_name,score,created";
$sql .= " FROM scores,tests";
$sql .= " WHERE s_id=:s_id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(":s_id", $s_id, PDO::PARAM_INT);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if(empty($row)){
	exit();
}
$t_name = h($row["t_name"]);
//$t_id = $row["t_id"];
$score = $row["score"];

//カテゴリのレコード取り出し
?>
<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<title>修正フォーム</title>
		<link rel="stylesheet" href="css/form.css">
		<meta name="viewport" content="width=device-width">
		<script src="js/jquery-3.6.0.min.js"></script>
	<head>
	<body>
		<div id="container">
			<h1>試験の修正</h1>
			<div id="head">
				<a class="right" href="all_list.php">戻る</a>
			</div>
			<form action="mod.php" method="post">
				<dl>
					<dt><label for="t_name">試験名</label></dt>
					<dd><input type="text" name="t_name" id="t_name" value="<?php echo $t_name; ?>"></dd>
					<dt><label for="score">点数</label></dt>
					<dd><input type="number" name="score" id="score" value="<?php echo $score; ?>"></dd>
				</dl>
				<p>
					<button class="edit_btn" type="submit" name="sub" value="編集"><span>編集</span></button>
					<button class="edit_btn" type="submit" name="sub" value="削除" id="s1"><span>削除</span></button>
				</p>
				<input type = "hidden" name="s_id" value="<?php echo $s_id; ?>">
			</form>
		</div>
		<script>
		$(function(){
			$('#s1').on('submit',function(){
				let res = confirm('本当に削除してもいいですか？');
				if(res == false) return false;
			});
		});
		</script>
	</body>
</html>