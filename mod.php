<?php
session_start();
/*
if(empty($_SESSION["login"])){
	header("Location: login.php?err=3");
	exit();
}
if(empty($_POST["t_name"]) || empty($_POST["c_id"]) || empty($_POST["score"]) || empty($_POST["s_id"])){
	header("Location: form.php?f_id={$_POST["s_id"]}");
	exit();
}
*/
require_once("config.php");
if($_POST["sub"] == "編集") {
	$sql = "UPDATE scores SET score=:score WHERE s_id=:s_id";
	$stmt = $pdo->prepare($sql);
	$stmt->bindValue(":score", $_POST["score"], PDO::PARAM_INT);
	$stmt->bindValue(":s_id", $_POST["s_id"], PDO::PARAM_INT);
} else {
	//削除が押された場合
	$sql = "DELETE FROM scores WHERE s_id=:s_id";
	$stmt = $pdo->prepare($sql);
	$stmt->bindValue(":s_id", $_POST["s_id"], PDO::PARAM_INT);
}
$stmt->execute();
header("Location: all_list.php");
?>