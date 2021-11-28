<?php
session_start();

if(empty($_SESSION["login"])){
	header("Location: login.php?err=notlogin");
}
if(empty($_POST["t_name"]) || empty($_POST["c_id"]) || empty($_POST["v_name"])){
	exit('NG');
}
require_once("config.php");
$t_name = h($_POST["t_name"]);
$v_name = h($_POST["v_name"]);
$c_id = intval($_POST["c_id"]);
function makePass($size = 8){
	$base = "ABCDEFGHIJKLMNOPQLSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!#$%&";
	$tmp = " ";
	for($i = 0; $i < $size; $i++){
		$r = rand(0,strlen($base)-1);
		$tmp .= $base[$r];
	}
	return $tmp;
}
$sql = "SELECT * FROM tests WHERE t_name=:t_name";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(":t_name", $t_name, PDO::PARAM_STR);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if(empty($row["t_name"])){
	$sql = "INSERT INTO tests(t_name,c_id) VALUES(:t_name,:c_id)";
	$stmt = $pdo->prepare($sql);
	$stmt->bindValue(":t_name", $t_name, PDO::PARAM_STR);
	$stmt->bindValue(":c_id", $c_id, PDO::PARAM_INT);
	$stmt->execute();
}
$sql = "SELECT * FROM versions WHERE v_name=:v_name";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(":v_name", $v_name, PDO::PARAM_STR);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if(empty($row["v_name"])){
	$sql = "INSERT INTO versions(v_name) VALUES(:v_name)";
	$stmt = $pdo->prepare($sql);
	$stmt->bindValue(":v_name", $v_name, PDO::PARAM_STR);
	$stmt->execute();
}
if(isset($_POST["ongoing"])){
	header("Location: make_score_form.php?t_name={$t_name}&v_name={$v_name}");
	exit();
}
header("Location: all_list.php");
exit();
?>