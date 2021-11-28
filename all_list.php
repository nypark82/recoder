 <?php
session_start();
if(empty($_SESSION["login"])){
	header("Location: login.php?err=3");
}
$u_id = intval($_SESSION["u_id"]);
require_once("config.php");

$sql="SELECT DISTINCT scores.t_id, t_name FROM scores, tests WHERE u_id=:u_id AND scores.t_id=tests.t_id ORDER BY t_id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(":u_id", $u_id, PDO::PARAM_INT);
$stmt->execute();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title>メニュー一覧</title>
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" href="css/list.css">
	<script src="js/jquery-3.6.0.min.js"></script>
</head>
<body>
	<div id="container">
		<h1>試験一覧</h1>
		<div id="head">
			<a  class="left" href="make_test_form.php">新規追加</a>
			<select id="sort" class="center">
				<option value="99999">すべて</option>
			<?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
				<option value="<?php echo $row["t_id"]; ?>"><?php echo $row["t_name"]; ?></option>
			<?php endwhile; ?>
			</select>
			<a class="right" href="logout.php">ログアウト</a>
		</div>
		<div id="rows"></div>
	</div>
	<script src="js/list.js"></script>
</body>
</html>