<nav class="opcoes">
	<div class="content">
		<a href="index.php?tab=editar_perfil&subtab=editar_usuario">Editar perfil</a>
	</div>
</nav>
</nav>
<div class="content">
	<h2><?= ucfirst(str_replace('_', ' ', $current_subtab))?></h2>
	<?php if($current_subtab == "editar_usuario"){ ?>
		<?php $sqlUsersToEdit = $pdo->query("SELECT * FROM users WHERE name = '$_SESSION[name]'");
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
					<input type="hidden" name="id" value="<?= $valueUsersToEdit['id'] ?>">
				</fieldset>
				<div class="actions">
					<a href="<?= $previous ?>">Cancelar</a>
					<input type="submit" name="editar_usuario_perfil" value="Editar usuário">
				</div>
			</form>
		<?php } ?>
	<?php } ?>
</div>