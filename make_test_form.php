<?php
session_start();
if(empty($_SESSION["login"])){
	header("Location: login.php?err=3");
}
if(empty($_SESSION["u_id"])){
	header("Location: login.php?err=3");
}
require_once("config.php");
$sql = "SELECT * FROM cats";
$rs = $pdo->query($sql);
?>
<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<title>試験登録</title>
		<link rel="stylesheet" href="css/form.css">
		<meta name="viewport" content="width=device-width">
	<head>
	<body>
		<div id="container">
				<p><h1>試験登録フォーム</h1><p>
			<form action="make_test.php" method="post">
				<dl>
					<dt><label for="t_name">試験名</label></dt>
					<dd><input type="text" name="t_name" id="t_name"></dd>
					<dt><label for="v_name">年度</label></dt>
					<dd><input type="text" name="v_name" id="v_name"></dd>
					<dt><label for="c_id">カテゴリー</label></dt>
					<dd>		
						<select id="c_id" name="c_id">
						<?php while($row = $rs->fetch(PDO::FETCH_ASSOC)): ?>
							<option value="<?php echo $row["c_id"] ?>"><?php echo $row["c_name"]; ?></option>
						<?php endwhile; ?>
						</select>
					</dd>
				</dl>
				<div id="btns">
					<button id="l-btn" type="submit"><span>登録</span></button>
					<button id="r-btn" type="submit" name="ongoing" value="1"><span>点数追加</span></button>
				</div>
			</form>
		</div>
	</body>
</html>	