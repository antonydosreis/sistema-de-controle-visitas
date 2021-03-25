<?php
session_start();
include("_include/db_connect.inc.php");
if($_SESSION['login'] != true){
	header('Location: login.php');
	die();
}
if(isset($_GET['get_out'])){
	session_destroy();
	header('Location: login.php');
	die();
}
$current_tab = "";
if(isset($_GET['tab'])){$current_tab = $_GET['tab'];}
$current_subtab = "";
if(isset($_GET['subtab'])){$current_subtab = $_GET['subtab'];}
$current_seller = "";
if(isset($_GET['seller'])){$current_seller = $_GET['seller'];}
$current_client = "";
if(isset($_GET['client'])){$current_client = $_GET['client'];}
$current_visit = "";
if(isset($_GET['visit'])){$current_visit = $_GET['visit'];}

$previous = "javascript:history.go(-1)";
if(isset($_SERVER['HTTP_REFERER'])){$previous = $_SERVER['HTTP_REFERER'];}

include("_include/crud.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Sistema de controle de visitas | O Diário</title>
	<meta charset='utf-8'>
	<meta http-equiv='Content-Language' content='pt-br'>
	<meta name='viewport' content='width=device-width, initial-scale=1.0'>
	<meta name='author' content='Antony dos Reis'>
	<link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet"/>
	<link rel="stylesheet" type="text/css" href="_templates/css/style.css">
</head>
<body>
	<header>
		<div class="content">
			<nav>
				<h1>Sistema de visitas</h1>
				<div class="action">
					<a href="index.php?tab=editar_perfil&subtab=editar_usuario"><?= $_SESSION['name'] ?></a>
					<a href="index.php?get_out">Desconectar</a>
					<a onclick="open_menu('responsive_menu');" id="bars"></a>
				</div>
			</nav>
			<div class="tabs">
				<a href="index.php?tab=visitas&subtab=ultimas_visitas_cadastradas" class="<?php echo ($current_tab == 'visitas'?'active':'') ?>">Visitas</a>
				<a href="index.php?tab=clientes&subtab=lista_de_clientes" class="<?php echo ($current_tab == 'clientes'?'active':'') ?>">Clientes</a>
				<a href="index.php?tab=vendedores&subtab=lista_de_vendedores" class="<?php echo ($current_tab == 'vendedores'?'active':'') ?>">Vendedores</a>
				<a href="index.php?tab=paginascadernos&subtab=lista_de_pagina_e_caderno" class="<?php echo ($current_tab == 'paginascadernos'?'active':'') ?>">Paginas e cadernos</a>
				<a href="index.php?tab=relatorios&subtab=geral_relatorio" class="<?php echo ($current_tab == 'relatorios'?'active':'') ?>">Relatórios</a>
				<?php if ($_SESSION['level'] == 3) { ?>
					<a href="index.php?tab=usuarios&subtab=gerenciamento_de_usuarios" class="<?php echo ($current_tab == 'usuarios'?'active':'') ?>">Usuários</a>
				<?php } ?>
			</div>
			<div id="responsive_menu">
				<a onclick="close_menu('responsive_menu');">x</a>
				<a href="index.php?tab=visitas&subtab=ultimas_visitas_cadastradas" class="<?php echo ($current_tab == 'visitas'?'active':'') ?>">Visitas</a>
				<a href="index.php?tab=clientes&subtab=lista_de_clientes" class="<?php echo ($current_tab == 'clientes'?'active':'') ?>">Clientes</a>
				<a href="index.php?tab=vendedores&subtab=lista_de_vendedores" class="<?php echo ($current_tab == 'vendedores'?'active':'') ?>">Vendedores</a>
				<a href="index.php?tab=paginascadernos&subtab=lista_de_pagina_e_caderno" class="<?php echo ($current_tab == 'paginascadernos'?'active':'') ?>">Paginas e cadernos</a>
				<a href="index.php?tab=relatorios&subtab=geral_relatorio" class="<?php echo ($current_tab == 'relatorios'?'active':'') ?>">Relatórios</a>
				<?php if ($_SESSION['level'] == 3) { ?>
					<a href="index.php?tab=usuarios&subtab=gerenciamento_de_usuarios" class="<?php echo ($current_tab == 'usuarios'?'active':'') ?>">Usuários</a>
				<?php } ?>
				<a href="index.php?tab=editar_perfil&subtab=editar_usuario"><?= $_SESSION['name'] ?></a>
				<a href="index.php?get_out">Desconectar</a>
			</div>
		</div>
	</header>
	<main>
		<?php if($current_tab == 'visitas'){
			include("_include/visitas.php");
		}elseif($current_tab == 'clientes'){
			include("_include/clientes.php");
		}elseif($current_tab == 'vendedores'){
			include("_include/vendedores.php");
		}elseif($current_tab == 'paginascadernos'){
			include("_include/paginascadernos.php");
		}elseif($current_tab == 'relatorios'){
			include("_include/relatorios.php");
		}elseif($current_tab == 'usuarios'){
			include("_include/usuarios.php");
		}elseif($current_tab == 'editar_perfil'){
			include("_include/editar_perfil.php");
		}else{ ?>
			<div class="content">
				<h2>Bem vindo(a) <?= $_SESSION['name'] ?></h2>
			</div>
		<?php } ?>
	</main>
	<footer>
		<div class="content">
			<p>Sistema de controle de visitas - Última atualização: 24 de Março de 2021</p>
		</div>
	</footer>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
	<script src="_templates/js/script.js"></script>
</body>
</html>