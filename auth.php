<?php
session_start();
if(empty($_POST["token"]) || $_POST["token"] != $_SESSION["token"]){
	exit();
}
if(empty($_POST["u_name"]) || empty($_POST["pass"])){
	header("Location: login.php?err=1");
	exit();
}
require_once("config.php");
$sql = "SELECT * FROM users WHERE u_name=:u_name";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(":u_name",h($_POST["u_name"]),PDO::PARAM_STR);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
	//認証結果
if(password_verify($_POST["pass"], $row["pass"])){
	//認証成功     //session idを作る。session登録をする前に生成する
	$_SESSION["login"] = true;
	$_SESSION["u_id"] = h($row["u_id"]);
	header("Location: all_list.php");
	exit();	
}else{
	//認証失敗
	header("Location: login.php?err=2");
	exit();
}
?>