<?php
session_start();
if(empty($_SESSION["login"])){
	header("Location: login.php?err=3");
}

if(empty($_GET["t_id"])){
	header("Location: all_list.php?err=3");
}
require_once("config.php");
$sql = "SELECT s_id, t_name, score, created";
$sql .= " FROM scores, tests";
$sql .= " WHERE scores.t_id=tests.t_id";
$rs = $pdo->query($sql);


//カテゴリー情報の取得
$sql2 = "SELECT * FROM tests";
$rs2 = $pdo->query($sql2);

?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title>メニュー一覧</title>
	<link rel="stylesheet" href="style.css">
	<meta name="viewport" content="width=device-width">
</head>
<body>
	<div id="container">
	<p>ようこそ、 さん</P>
		<h1>試験一覧</h1>
		<table>
		<tr>
			<th>試験回数</th></th><th>試験名</th><th>点数</th><th>試験日</th><th>編集</th>
		</tr>  
		<?php while($row = $rs->fetch(PDO::FETCH_ASSOC)): ?> 
		<tr>
			<td><?php echo h($row["s_id"]); ?></td>
			<td><?php echo h($row["t_name"]); ?></td>
			<td><?php echo $row["score"]; ?></td>
			<td><?php echo $row["created"]; ?></td>
			<td><a href="form.php?s_id=<?php echo $row["s_id"]; ?>">編集</a></td>
		</tr>
		<?php endwhile; ?>
		</table>
	</div>
</body>
</html>