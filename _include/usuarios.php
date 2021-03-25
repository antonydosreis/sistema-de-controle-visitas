<?php
if($_SESSION['level'] != 3){
	header('Location: login.php');
	die();
}
?>
<nav class="opcoes">
	<div class="content">
		<a href="index.php?tab=usuarios&subtab=gerenciamento_de_usuarios">Gerenciar usuarios</a>
		<a href="index.php?tab=usuarios&subtab=cadastrar_usuario">Cadastrar usuário</a>
	</div>
</nav>
</nav>
<div class="content">
	<h2><?= ucfirst(str_replace('_', ' ', $current_subtab))?></h2>
	<?php if($current_subtab == "gerenciamento_de_usuarios"){ ?>
		<input type="text" id="search" onkeyup="filter()">
		<div class="responsive_table">
			<table class="table_to_filter">
				<tr>
					<th>Nome</th>
					<th>usuario</th>
					<th>Nível de acesso</th>
					<th></th>
				</tr>
				<?php foreach($infoUsers as $valueUsers){ ?>
					<tr>
						<td><?= $valueUsers['name'] ?></td>
						<td><?= $valueUsers['user'] ?></td>
						<td><?php if($valueUsers['level'] == 1){echo "visualizador";}elseif($valueUsers['level'] == 2){echo "Moderador";}else{echo "Administrador";} ?></td>
						<td><a href="index.php?tab=usuarios&subtab=editar_usuario&id=<?= $valueUsers['id'] ?>" class="edit"></a></td>
					</tr>
				<?php } ?>
			</table>
		</div>
	<?php } ?>
	<?php if($current_subtab == "cadastrar_usuario"){ ?>
		<form method="post">
			<fieldset>
				<label>Nome</label>
				<input type="text" name="name" required>

				<label>Usuario</label>
				<input type="text" name="user" required>

				<label>Senha</label>
				<input type="password" name="password" required>

				<label>Nível de acesso</label>
				<select name="level" required>
					<option value="1" selected>Visualizador</option>
					<option value="2">Moderador</option>
					<option value="3">Administrador</option>
				</select>
			</fieldset>
			<div class="actions">
				<a href="<?= $previous ?>">Cancelar</a>
				<input type="submit" name="cadastrar_usuario" value="Cadastrar usuário">
			</div>
		</form>
	<?php } ?>
	<?php if($current_subtab == "editar_usuario"){ ?>
		<?php $sqlUsersToEdit = $pdo->query("SELECT * FROM users WHERE id = '$_GET[id]'");
		$infoUsersToEdit = $sqlUsersToEdit->fetchAll();
		foreach($infoUsersToEdit as $valueUsersToEdit){ ?>
			<form method="post">
				<fieldset>
					<label>Nome</label>
					<input type="text" name="name" required value="<?= $valueUsersToEdit['name'] ?>">

					<label>Usuario</label>
					<input type="text" name="user" required value="<?= $valueUsersToEdit['user'] ?>">

					<label>Alterar senha</label>
					<input type="password" name="password">
					<small>Para manter a mesma, apenas deixe em branco</small>
					<input type="hidden" name="old_password" value="<?= $valueUsersToEdit['password'] ?>">

					<label>Nível de acesso</label>
					<select name="level" required>
						<option value="1" <?php echo ($valueUsersToEdit['level'] == 1?"selected":"") ?>>Visualizador</option>
						<option value="2" <?php echo ($valueUsersToEdit['level'] == 2?"selected":"") ?>>Moderador</option>
						<option value="3" <?php echo ($valueUsersToEdit['level'] == 3?"selected":"") ?>>Administrador</option>
					</select>
					<input type="hidden" name="id" value="<?= $valueUsersToEdit['id'] ?>">
				</fieldset>
				<div class="actions">
					<a href="<?= $previous ?>">Cancelar</a>
					<a onclick="open_div('prevent_delete_<?= $valueUsersToEdit['id'] ?>')" class="exclude_button">Excluir</a>
					<input type="submit" name="editar_usuario" value="Editar usuário">
				</div>
			</form>
			<form class="modal" method="post" id="prevent_delete_<?= $valueUsersToEdit['id'] ?>">
				<p>Tem certeza?</p>
				<input type="hidden" name="id" value="<?= $valueUsersToEdit['id'] ?>">
				<input type="submit" name="excluir_usuario" value="Sim">
				<input type="button" value="Não" onclick="close_div('prevent_delete_<?= $valueUsersToEdit['id'] ?>')">
			</form>
		<?php } ?>
	<?php } ?>
</div>