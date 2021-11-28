<?php
session_start();

if(empty($_SESSION["login"])){
	header("Location: login.php?errr=3");
}

require_once("config.php");
$t_name = h($_GET["t_name"]);
$v_name = h($_GET["v_name"]);
$sql = "SELECT DISTINCT t_name  FROM tests WHERE t_name = :t_name";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(":t_name", $t_name, PDO::PARAM_STR);
$stmt->execute();
$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<title>スコア登録</title>
		<link rel="stylesheet" href="css/form.css">
		<meta name="viewport" content="width=device-width">
	<head>
	<body>
		<div id="container">
				<h1>点数登録フォーム</h1>
			<form action="make_score.php" method="post">
				<dl>
					<dt><label for="t_name">試験名</label></dt>
					<dd><input type="text" name="t_name" id="t_name" value="<?php echo $t_name ?>"></dd>
					<dt><label for="v_name">年度</label></dt>
					<dd><input type="text" name="v_name" id="v_name" value="<?php echo $v_name ?>"></dd>
					<dt><label for="score">正答率(%)</label></dt>
					<dd><input type="number" name="score" id="score"></dd>
				</dl>
				<p><button class="login_btn" type="submit"><span>登録</span></button></p>
			</form>
		</div>
	</body>
</html>	