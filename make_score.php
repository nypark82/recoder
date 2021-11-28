<?php
session_start();

if(empty($_SESSION["login"])){
	header("Location: login.php?errr=3");
}

if(empty($_SESSION["u_id"]) || empty($_POST["t_name"]) || empty($_POST["score"]) || empty($_POST["v_name"])){
	exit('NG');
}
$u_id = intval($_SESSION["u_id"]);
require_once("config.php");

//$_POST["t_name"]をtestsテーブルと照合
$sql = "SELECT * FROM tests WHERE t_name=:t_name";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(":t_name", h($_POST["t_name"]), PDO::PARAM_STR);
$stmt->execute();
$t_row = $stmt->fetch(PDO::FETCH_ASSOC);
//$_POST["v_name"]をtestsテーブルと照合
$sql = "SELECT * FROM versions WHERE v_name=:v_name";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(":v_name", h($_POST["v_name"]), PDO::PARAM_STR);
$stmt->execute();
$v_row = $stmt->fetch(PDO::FETCH_ASSOC);
if(empty($t_row["t_name"]) && empty($v_row["v_name"])){
	//testsテーブルに試験名を挿入
	$sql = "INSERT INTO tests(t_name) VALUES(:t_name)";
	$stmt->bindValue(":t_name", h($_POST["t_name"]), PDO::PARAM_STR);
	$stmt->execute();
	//testsテーブルからt_id抽出
	$sql = "SELECT * FROM tests WHERE t_name=:t_name";
	$stmt = $pdo->prepare($sql);
	$stmt->bindValue(":t_name", h($_POST["t_name"]), PDO::PARAM_STR);
	$stmt->execute();
	$t_row = $stmt->fetch(PDO::FETCH_ASSOC);
	//versionテーブルに年度を挿入
	$sql = "INSERT INTO versions(v_name) VALUES(:v_name)";
	$stmt->bindValue(":v_name", h($_POST["v_name"]), PDO::PARAM_STR);
	$stmt->execute();
	//versionsテーブルからv_id抽出
	$sql = "SELECT * FROM versions WHERE v_name=:v_name";
	$stmt = $pdo->prepare($sql);
	$stmt->bindValue(":v_name", h($_POST["v_name"]), PDO::PARAM_STR);
	$stmt->execute();
	$v_row = $stmt->fetch(PDO::FETCH_ASSOC);
	//scoresテーブルにスコアを挿入
	$sql = "INSERT INTO scores(u_id,t_id,v_id,score) VALUES(:u_id,:t_id,:v_id,:score)";
	$stmt = $pdo->prepare($sql);
	$stmt->bindValue(":u_id", intval($_SESSION["u_id"]), PDO::PARAM_INT);
	$stmt->bindValue(":t_id", h($t_row["t_id"]), PDO::PARAM_INT);
	$stmt->bindValue(":v_id", h($v_row["v_id"]), PDO::PARAM_INT);
	$stmt->bindValue(":score", intval($_POST["score"]), PDO::PARAM_INT);
	$stmt->execute();
	header("Location: all_list.php?u_id={$u_id}");
	exit();
}else	if(empty($t_row["t_name"]) && !empty($v_row["v_name"])){
	//testsテーブルに試験名を挿入
	$sql = "INSERT INTO tests(t_name) VALUES(:t_name)";
	$stmt->bindValue(":t_name", h($_POST["t_name"]), PDO::PARAM_STR);
	$stmt->execute();
	//testsテーブルからt_id抽出
	$sql = "SELECT * FROM tests WHERE t_name=:t_name";
	$stmt = $pdo->prepare($sql);
	$stmt->bindValue(":t_name", h($_POST["t_name"]), PDO::PARAM_STR);
	$stmt->execute();
	$t_row = $stmt->fetch(PDO::FETCH_ASSOC);
	//scoresテーブルにスコアを挿入
	$sql = "INSERT INTO scores(u_id,t_id,v_id,score) VALUES(:u_id,:t_id,:v_id,:score)";
	$stmt = $pdo->prepare($sql);
	$stmt->bindValue(":u_id", intval($_SESSION["u_id"]), PDO::PARAM_INT);
	$stmt->bindValue(":t_id", h($t_row["t_id"]), PDO::PARAM_INT);
	$stmt->bindValue(":v_id", h($v_row["v_id"]), PDO::PARAM_INT);
	$stmt->bindValue(":score", intval($_POST["score"]), PDO::PARAM_INT);
	$stmt->execute();
	header("Location: all_list.php?u_id={$u_id}");
	exit();
}else	if(!empty($t_row["t_name"]) && empty($v_row["v_name"])){
	//versionテーブルに年度を挿入
	$sql = "INSERT INTO versions(v_name) VALUES(:v_name)";
	$stmt->bindValue(":v_name", h($_POST["v_name"]), PDO::PARAM_STR);
	$stmt->execute();
	//versionsテーブルからv_id抽出
	$sql = "SELECT * FROM versions WHERE v_name=:v_name";
	$stmt = $pdo->prepare($sql);
	$stmt->bindValue(":v_name", h($_POST["v_name"]), PDO::PARAM_STR);
	$stmt->execute();
	$v_row = $stmt->fetch(PDO::FETCH_ASSOC);
	//scoresテーブルにスコアを挿入
	$sql = "INSERT INTO scores(u_id,t_id,v_id,score) VALUES(:u_id,:t_id,:v_id,:score)";
	$stmt = $pdo->prepare($sql);
	$stmt->bindValue(":u_id", intval($_SESSION["u_id"]), PDO::PARAM_INT);
	$stmt->bindValue(":t_id", h($t_row["t_id"]), PDO::PARAM_INT);
	$stmt->bindValue(":v_id", h($v_row["v_id"]), PDO::PARAM_INT);
	$stmt->bindValue(":score", intval($_POST["score"]), PDO::PARAM_INT);
	$stmt->execute();
	header("Location: all_list.php?u_id={$u_id}");
	exit();
}else{
	$sql = "INSERT INTO scores(u_id,t_id,v_id,score) VALUES(:u_id,:t_id,:v_id,:score)";
	$stmt = $pdo->prepare($sql);
	$stmt->bindValue(":u_id", intval($_SESSION["u_id"]), PDO::PARAM_INT);
	$stmt->bindValue(":t_id", h($t_row["t_id"]), PDO::PARAM_INT);
	$stmt->bindValue(":v_id", h($v_row["v_id"]), PDO::PARAM_INT);
	$stmt->bindValue(":score", intval($_POST["score"]), PDO::PARAM_INT);
	$stmt->execute();
	header("Location: all_list.php?u_id={$u_id}");
	exit();
}
?>