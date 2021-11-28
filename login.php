<?php
session_start();
$token = bin2hex(random_bytes(32));
$_SESSION["token"] = $token;
?>
<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<title>ログイン</title>
		<link rel="stylesheet" href="css/form.css">
		<meta name="viewport" content="width=device-width">
	<head>
	<body>
		<div id= "container">
			<h1>ログイン</h1>
				<form action="auth.php" method="post">
					<dl>
						<dd>ユーザー名：<input type="text" name="u_name" id="u_name"  value="neo" required></dd>
						<dd>パスワード：<input type="password" name="pass" id="pass" value="1234" required></dd>
						<input type="hidden" name="token" value="<?php echo $token; ?>">
					</dl>
					<section>
						<button type="submit" class="login_btn"><span>ログイン</span></button>
					</section>
				</form>
			<p id="makeuser">
				アカウントをお持ちでない場合　<a href="make_user_form.php">登録はこちら</a>
			</p>
		</div>
	</body>
</html>	