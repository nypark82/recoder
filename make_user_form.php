
<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<title>ユーザ登録</title>
		<link rel="stylesheet" href="css/form.css">
		<meta name="viewport" content="width=device-width">
	<head>
	<body>
		<div id="container">
				<h1>ユーザー登録フォーム</h1>
			<form action="make_user.php" method="post">
				<dl>
					<dt><label for="u_name">ユーザー名</label></dt>
					<dd><input type="text" name="u_name" id="u_name"></dd>
					<dt><label for="pass">パスワード</label></dt>
					<dd><input type="text" name="pass" id="pass"></dd>
				</dl>
				<p><button class="login_btn" type="submit"><span>登録</span></button></p>
			</form>
		</div>
	</body>
</html>	