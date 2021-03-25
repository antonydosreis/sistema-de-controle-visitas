<nav class="opcoes">
	<div class="content">
		<a href="index.php?tab=paginascadernos&subtab=cadastrar_paginas_e_cadernos">Cadastrar página eu caderno</a>
		<a href="index.php?tab=paginascadernos&subtab=lista_de_pagina_e_caderno">Listar página e caderno</a>
	</div>
</nav>
</nav>
<div class="content">
	<h2><?= ucfirst(str_replace('_', ' ', $current_subtab))?></h2>
	<?php if($current_subtab == "lista_de_pagina_e_caderno"){ ?>
		<input type="text" id="search" onkeyup="filter()">
		<div class="responsive_table">
			<table class="table_to_filter">
				<tr>
					<th>Tipo de página / Caderno</th>
					<th></th>
				</tr>
				<?php foreach($infoPages as $valuePages){ ?>
					<tr>
						<td><?= $valuePages['name'] ?></td>
						<td><a href="index.php?tab=paginascadernos&subtab=editar_pagina_ou_caderno&id=<?= $valuePages['id'] ?>" class="edit"></a></td>
					</tr>
				<?php } ?>
			</table>
		</div>
	<?php } ?>
	<?php if($current_subtab == "editar_pagina_ou_caderno"){ ?>
		<?php $sqlPagesToEdit = $pdo->query("SELECT * FROM pages WHERE id = '$_GET[id]'");
		$infoPagesToEdit = $sqlPagesToEdit->fetchAll();
		foreach($infoPagesToEdit as $valuePagesToEdit){ ?>
			<form method="post">
				<fieldset>
					<label>Nome</label>
					<input type="text" name="name" value="<?= $valuePagesToEdit['name'] ?>" required>
					<input type="hidden" name="id" value="<?= $valuePagesToEdit['id'] ?>">
				</fieldset>
				<div class="actions">
					<a href="<?= $previous ?>">Cancelar</a>
					<a onclick="open_div('prevent_delete_<?= $valuePagesToEdit['id'] ?>')" class="exclude_button">Excluir</a>
					<input type="submit" name="editar_paginacaderno" value="Editar Página / Caderno">
				</div>
			</form>
			<form class="modal" method="post" id="prevent_delete_<?= $valuePagesToEdit['id'] ?>">
				<p>Tem certeza?</p>
				<input type="hidden" name="id" value="<?= $valuePagesToEdit['id'] ?>">
				<input type="submit" name="excluir_paginacaderno" value="Sim">
				<input type="button" value="Não" onclick="close_div('prevent_delete_<?= $valuePagesToEdit['id'] ?>')">
			</form>
		<?php } ?>
	<?php } ?>
	<?php if($current_subtab == "cadastrar_paginas_e_cadernos"){ ?>
		<form method="post">
			<fieldset>
				<label>Nome</label>
				<input type="text" name="name" required>
			</fieldset>
			<div class="actions">
				<a href="<?= $previous ?>">Cancelar</a>
				<input type="submit" name="cadastrar_paginacaderno" value="Cadastrar Página / Caderno">
			</div>
		</form>
	<?php } ?>
</div>