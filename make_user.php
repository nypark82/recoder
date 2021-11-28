<?php
session_start();

if(empty($_SESSION["login"])  || $_SESSION["role"] != "admin"){
	header("Location: login.php?errr=3");
}

if(empty($_POST["u_name"]) || empty($_POST["pass"])){
	exit('NG');
}

require_once("config.php");
function makePass($size = 8){
	$base = "ABCDEFGHIJKLMNOPQLSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!#$%&";
	$tmp = " ";
	for($i = 0; $i < $size; $i++){
		$r = rand(0,strlen($base)-1);
		$tmp .= $base[$r];
	}
	return $tmp;
}

$sql = "INSERT INTO users(u_name,pass) VALUES(:u_name, :pass)";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(":u_name", h($_POST["u_name"]), PDO::PARAM_STR);
$stmt->bindValue(":pass", password_hash($_POST["pass"],PASSWORD_DEFAULT), PDO::PARAM_STR);
$stmt->execute();
header("Location: login.php");
?>