<?php
session_start();
if(empty($_SESSION["login"])){
	header("Location: login.php?err=2");
}
$u_id = intval($_SESSION["u_id"]);
//最初の処理
require_once("config.php");
?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title>試験詳細</title>
	<link rel="stylesheet" href="css/detail.css">
	<meta name="viewport" content="width=device-width">
	<script src="js/jquery-3.6.0.min.js"></script>
</head>
<body>
	<h1>
		<select id="test">

		</select>
	</h1>
	<div id="head">
		<select id="version">

		</select>
		<a href="all_list.php">戻る</a>
	</div>

<!-- css bar graph -->
<div class="css_bar_graph">
	<!-- y_axis labels -->
	<ul class="y_axis">
		<li>100%</li>
		<li>80%</li>
		<li>60%</li>
		<li>40%</li>
		<li>20%</li>
		<li>0%</li>
	</ul>
	<!-- x_axis labels -->
	<ul class="x_axis"></ul>

	<!-- graph -->
	<div class="graph">
		<!-- grid -->
		<ul class="grid">
			<li><!-- 100 --></li>
			<li><!-- 80 --></li>
			<li><!-- 60 --></li>
			<li><!-- 40 --></li>
			<li><!-- 20 --></li>
			<li class="bottom"><!-- 0 --></li>
		</ul>
		<!-- bars -->
		<ul id="bars">
			<!-- <li class="bar nr_1 blue"><div class="top"></div><div class="bottom"></div><span>50%</span></li> -->
		</ul>	
	</div>
</div>
	<script src="js/detail.js"></script>
</body>
</html>