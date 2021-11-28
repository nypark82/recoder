<?php
//関数の定義
//サニタイズ用関数
function h($tar){
	$tmp = htmlspecialchars($tar, ENT_QUOTES);
	return $tmp;
}
//------接続情報--------
$host = "localhost";
$dbname = "recoder";
$dbuser = "root";
$dbpass= "root";
//----------------------
$dsn = "mysql:host={$host};dbname={$dbname};charset=utf8";
$pdo = new PDO($dsn, $dbuser, $dbpass);
?>