<?php
session_start();
/*
if(empty($_POST["f_name"])||empty($_POST["c_id"])||empty($_POST["price"])){
	header("Location: list.php?err=1");
	exit();
}
*/
require_once("config.php");
$sql = "INSERT INTO foods(f_name, c_id, price) VALUES(:f_name, :c_id, :price)";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(":f_name", $_POST["f_name"], PDO::PARAM_STR);
$stmt->bindValue(":c_id", $_POST["c_id"], PDO::PARAM_INT);
$stmt->bindValue(":price", $_POST["price"], PDO::PARAM_INT);
$stmt->execute();
header("Location: list.php");
?>
