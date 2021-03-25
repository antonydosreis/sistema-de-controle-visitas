<?php
session_start();
include("_include/db_connect.inc.php");

if(isset($_POST['login'])){
	$user = $_POST['user'];
	$password = $_POST['password'];
	$sql = $pdo->prepare("SELECT * FROM users WHERE user = ?");
	$sql->execute([$user]);

	if($sql->rowCount() == 1){
		$info = $sql->fetch();
		if(password_verify($password, $info['password'])){
			$_SESSION['login'] = true;
			$_SESSION['name'] = $info['name'];
			$_SESSION['level'] = $info['level'];
			header("Location: index.php");
			die();
		}else{
			echo '<p class="warning error">Usuário ou Senha incorretos!</p>';
		}
	}else{
		echo '<p class="warning error">Usuário ou Senha incorretos!</p>';
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login - Sistema de controle de visitas | O Diário</title>
	<meta charset='utf-8'>
	<meta http-equiv='Content-Language' content='pt-br'>
	<meta name='viewport' content='width=device-width, initial-scale=1.0'>
	<meta name='author' content='Antony dos Reis'>
	<link rel="stylesheet" type="text/css" href="_templates/css/style.css">
</head>
<body>
	<header>
		<img src="_templates/img/logo.png">
	</header>
	<main>
	<form method="post" class="login">
		<h1>Entrar</h1>
		<fieldset>
			<label>Usuário</label>
			<input type="text" name="user" autofocus>

			<label>Senha</label>
			<input type="password" name="password">
		</fieldset>
		<input type="submit" name="login" value="Entrar">
	</form>
	</main>
	<footer>
		<div class="content">
			<p>Sistema de controle de visitas</p>
		</div>
	</footer>
</body>
</html>