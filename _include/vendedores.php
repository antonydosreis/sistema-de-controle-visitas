<nav class="opcoes">
	<div class="content">
		<a href="index.php?tab=vendedores&subtab=lista_de_vendedores">Lista de vendedores</a>
		<a href="index.php?tab=vendedores&subtab=cadastrar_vendedor">Cadastrar vendedor</a>
	</div>
</nav>
</nav>
<div class="content">
	<h2><?= ucfirst(str_replace('_', ' ', $current_subtab))?></h2>
	<?php if($current_subtab == "lista_de_vendedores"){ ?>
		<input type="text" id="search" onkeyup="filter()">
		<div class="responsive_table">
			<table class="table_to_filter">
				<tr>
					<th>Nome do vendedor</th>
					<th>Número do vendedor</th>
					<th></th>
				</tr>
				<?php foreach($infoSellers as $valueSellers){ ?>
					<tr>
						<td><?= $valueSellers['name'] ?></td>
						<td><?= $valueSellers['seller_number'] ?></td>
						<td><a href="index.php?tab=vendedores&subtab=editar_vendedor&id=<?= $valueSellers['id'] ?>" class="edit"></a></td>
					</tr>
				<?php } ?>
			</table>
		</div>
	<?php } ?>
	<?php if($current_subtab == "editar_vendedor"){ ?>
		<?php $sqlSellersToEdit = $pdo->query("SELECT * FROM sellers WHERE id = '$_GET[id]'");
		$infoSellersToEdit = $sqlSellersToEdit->fetchAll();
		foreach($infoSellersToEdit as $valueSellersToEdit){ ?>
			<form method="post">
				<fieldset>
					<label>Nome do vendedor</label>
					<input type="text" name="seller_name" value="<?= $valueSellersToEdit['name'] ?>" required>

					<label>Número do vendedor</label>
					<input type="text" name="seller_number" value="<?= $valueSellersToEdit['seller_number'] ?>">
					<input type="hidden" name="id" value="<?= $valueSellersToEdit['id'] ?>">
				</fieldset>
				<div class="actions">
					<a href="<?= $previous ?>">Cancelar</a>
					<a onclick="open_div('prevent_delete_<?= $valueSellersToEdit['id'] ?>')" class="exclude_button">Excluir</a>
					<input type="submit" name="editar_vendedor" value="Editar Vendedor">
				</div>
			</form>
			<form class="modal" method="post" id="prevent_delete_<?= $valueSellersToEdit['id'] ?>">
				<p>Tem certeza?</p>
				<input type="hidden" name="id" value="<?= $valueSellersToEdit['id'] ?>">
				<input type="submit" name="excluir_vendedor" value="Sim">
				<input type="button" value="Não" onclick="close_div('prevent_delete_<?= $valueSellersToEdit['id'] ?>')">
			</form>
		<?php } ?>
	<?php } ?>
	<?php if($current_subtab == "cadastrar_vendedor"){ ?>
		<form method="post">
			<fieldset>
				<label>Nome do vendedor</label>
				<input type="text" name="seller_name" required>

				<label>Número do vendedor</label>
				<input type="text" name="seller_number">
			</fieldset>
			<div class="actions">
				<a href="<?= $previous ?>">Cancelar</a>
				<input type="submit" name="cadastrar_vendedor" value="Cadastrar Vendedor">
			</div>
		</form>
	<?php } ?>
</div>