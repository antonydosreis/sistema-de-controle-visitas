<nav class="opcoes">
	<div class="content">
		<a href="index.php?tab=clientes&subtab=lista_de_clientes">Lista de clientes</a>
		<a href="index.php?tab=clientes&subtab=cadastrar_cliente">Cadastrar cliente</a>
	</div>
</nav>
</nav>
<div class="content">
	<h2><?= ucfirst(str_replace('_', ' ', $current_subtab))?></h2>
	<?php if($current_subtab == "lista_de_clientes"){ ?>
		<input type="text" id="search" onkeyup="filter()">
		<div class="responsive_table">
			<table class="table_to_filter">
				<tr>
					<th>Cliente</th>
					<th>Cidade</th>
					<th></th>
				</tr>
				<?php foreach($infoClients as $valueClients){ ?>
					<tr>
						<td><?= $valueClients['name'] ?></td>
						<td><?= $valueClients['city'] ?></td>
						<td><a href="index.php?tab=clientes&subtab=editar_cliente&id=<?= $valueClients['id'] ?>" class="edit"></a></td>
					</tr>
				<?php } ?>
			</table>
		</div>
	<?php } ?>
	<?php if($current_subtab == "cadastrar_cliente"){ ?>
		<form method="post">
			<fieldset>
				<label>Nome do cliente</label>
				<input type="text" name="client" required>

				<label>Cidade</label>
				<input type="text" name="city" required>

				<label>Endereço</label>
				<input type="text" name="address">

				<label>Telefones</label>
				<input type="tel" name="phone">
				<small>Separe cada telefone por uma vírgula. Exemplo: (51) 999998888,(51) 999998888,(51) 999998888</small>

				<label>Contatos</label>
				<input type="text" name="contact">
				<small>Separe cada contato por uma vírgula. Exemplo: João,José,Paulo</small>
			</fieldset>
			<div class="actions">
				<a href="<?= $previous ?>">Cancelar</a>
				<input type="submit" name="cadastrar_cliente" value="Cadastrar cliente">
			</div>
		</form>
	<?php } ?>
	<?php if($current_subtab == "editar_cliente"){ ?>
		<?php $sqlClientsToEdit = $pdo->query("SELECT * FROM clients WHERE id = '$_GET[id]'");
		$infoClientsToEdit = $sqlClientsToEdit->fetchAll();
		foreach($infoClientsToEdit as $valueClientsToEdit){ ?>
			<form method="post">
				<fieldset>
					<label>Nome do cliente</label>
					<input type="text" name="client" value="<?= $valueClientsToEdit['name'] ?>" required>

					<label>Cidade</label>
					<input type="text" name="city" value="<?= $valueClientsToEdit['city'] ?>" required>

					<label>Endereço</label>
					<input type="text" name="address" value="<?= $valueClientsToEdit['address'] ?>">

					<label>Telefones</label>
					<input type="tel" name="phone" value="<?= $valueClientsToEdit['phone'] ?>">
					<small>Separe cada telefone por uma vírgula. Exemplo: (51) 999998888,(51) 999998888,(51) 999998888</small>

					<label>Contatos</label>
					<input type="text" name="contact" value="<?= $valueClientsToEdit['contact'] ?>">
					<small>Separe cada contato por uma vírgula. Exemplo: João,José,Paulo</small>
					<input type="hidden" name="id" value="<?= $valueClientsToEdit['id'] ?>">
				</fieldset>
				<div class="actions">
					<a href="<?= $previous ?>">Cancelar</a>
					<a onclick="open_div('prevent_delete_<?= $valueClientsToEdit['id'] ?>')" class="exclude_button">Excluir</a>
					<input type="submit" name="editar_cliente" value="Editar cliente">
				</div>
			</form>
			<form class="modal" method="post" id="prevent_delete_<?= $valueClientsToEdit['id'] ?>">
				<p>Tem certeza?</p>
				<input type="hidden" name="id" value="<?= $valueClientsToEdit['id'] ?>">
				<input type="submit" name="excluir_cliente" value="Sim">
				<input type="button" value="Não" onclick="close_div('prevent_delete_<?= $valueClientsToEdit['id'] ?>')">
			</form>
		<?php } ?>
	<?php } ?>
</div>