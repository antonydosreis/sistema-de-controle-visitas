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
include("_include/crud.php");

$infoResult = $pdo->query("SELECT * FROM visits ORDER BY `date` ASC")->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Sistema de controle de visitas | O Diário</title>
	<meta charset='utf-8'>
	<meta http-equiv='Content-Language' content='pt-br'>
	<meta name='viewport' content='width=device-width, initial-scale=1.0'>
	<meta name='author' content='Antony dos Reis'>
	<link rel="stylesheet" type="text/css" href="_templates/css/style.css">
</head>
<body>
	<header class="no-print">
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
		<nav class="opcoes no-print">
			<div class="content">
				<a onclick="window.print()">Imprimir</a>
			</div>
		</nav>
		<div class="content">
			<h2 class="no-print">Relatório</h2>
			<div class="responsive_table">
				<table>
					<tr>
						<th>Data</th>
						<th>Vendedor</th>
						<th>Cliente</th>
						<th>Página/Caderno</th>
						<th>Tipo</th>
						<th>Resultado</th>
					</tr>
					<?php foreach ($infoResult as $valueResult) {
						if(empty($_POST['result']) || in_array($valueResult['result'], $_POST['result'])){
							if(empty($_POST['type']) || in_array($valueResult['type'], $_POST['type'])){
								if(empty($_POST['page']) || in_array($valueResult['page'], $_POST['page'])){
									if(empty($_POST['client']) || in_array($valueResult['client'], $_POST['client'])){
										if(empty($_POST['seller']) || in_array($valueResult['seller'], $_POST['seller'])){
											if ((empty($_POST['start_date']) && empty($_POST['end_date'])) || ((date('Y-m-d',strtotime($valueResult['date'])) >= $_POST['start_date']) && (date('Y-m-d',strtotime($valueResult['date'])) <= $_POST['end_date']))){ ?>
												<tr>
													<td><?= date('d/m/Y',strtotime($valueResult['date'])) ?></td>
													<td><?= $valueResult['seller'] ?></td>
													<td><?= $valueResult['client'] ?></td>
													<td><?= $valueResult['page'] ?></td>
													<td><?= $valueResult['type'] ?></td>
													<td><?= $valueResult['result'] ?></td>
												</tr>
											<?php }
										}
									}
								}
							}
						}
					} ?>
				</table>
			</div>
		</div>
	</main>
	<footer class="no-print">
		<div class="content">
			<p>Sistema de controle de visitas</p>
		</div>
	</footer>
	<script src="_templates/js/script.js"></script>
</body>