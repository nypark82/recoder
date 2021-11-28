<?php
//ログアウトの処理
session_start();
$_SESSION = []; //サーバー側のデータを初期化
setcookie(session_name(), "", time() - 3600); //クライアントサイドのクッキーを削除
session_destroy();
unset($_SESSION["token"]); //部分的に配列を消す
header("Location: login.php");
?>