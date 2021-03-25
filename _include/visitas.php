<nav class="opcoes">
	<div class="content">
		<a href="index.php?tab=visitas&subtab=ultimas_visitas_cadastradas">Últimas visitas cadastradas</a>
		<a href="index.php?tab=visitas&subtab=cadastrar_visita">Cadastrar visita</a>
		<a href="index.php?tab=visitas&subtab=visitas_por_vendedor">Visitas por vendedor</a>
	</div>
</nav>
<div class="content">
	<h2><?php
	$h2 = ucfirst(str_replace('_', ' ', $current_subtab))." ".$current_seller;
	echo $h2;
	?></h2>
	<?php if($current_subtab == "ultimas_visitas_cadastradas"){ ?>
		<div class="responsive_table">
			<table>
				<tr>
					<th>Vendedor</th>
					<th>Cliente</th>
					<th>Página</th>
					<th>Contato</th>
					<th>Telefone</th>
					<th></th>
				</tr>
				<?php foreach($infoVisits as $valueVisits){ ?>
					<tr>
						<td><?= $valueVisits['seller'] ?></td>
						<td><?= $valueVisits['client'] ?></td>
						<td><?= $valueVisits['page'] ?></td>
						<td><?= $valueVisits['contact'] ?></td>
						<td><?= $valueVisits['phone'] ?></td>
						<td><a href="index.php?tab=visitas&subtab=editar_visita&visit=<?= $valueVisits['id'] ?>&client=<?= $valueVisits['client'] ?>" class="edit"></a></td>
					</tr>
				<?php } ?>
			</table>
		</div>
	<?php } ?>
	<?php if($current_subtab == "cadastrar_visita"){ ?>
		<form method="post">
			<fieldset>
				<label>Cliente</label>
				<?php for($i=0;$i<sizeof($infoClients);$i++){ ?>
					<?php if ($i == 0) { ?>
						<select name="client" onchange="window.location.replace('index.php?tab=visitas&subtab=cadastrar_visita&client='+this.value)" required>
							<option <?php echo($current_client == "" ? "selected" : ""); ?> disabled>Selecione</option>
						<?php } ?>
						<option <?php echo($current_client == $infoClients[$i]['name'] ? "selected" : ""); ?> value="<?= $infoClients[$i]['name'] ?>"><?= $infoClients[$i]['name'] ?></option>
						<?php if ($i == sizeof($infoClients) - 1) { ?>
						</select>
					<?php } ?>
				<?php } ?>

				<label>Vendedor</label>
				<select name="seller" required>
					<option selected disabled>Selecione</option>
					<?php foreach($infoSellers as $valueSellers){ ?>
						<option value="<?= $valueSellers['name'] ?>"><?= $valueSellers['name'] ?></option>
					<?php } ?>
				</select>

				<label>Data da visita</label>
				<input type="date" name="date" required>

				<label>Contato</label>
				<select name="contact">
					<option selected disabled>Selecione</option>
					<?php foreach($infoClients as $valueClients){ ?>
						<?php if($valueClients['name'] == $current_client){ ?>
							<?php $contacts = explode(",", $valueClients['contact']);
							foreach($contacts as $valueContact){ ?>
								<option value="<?=$valueContact ?>"><?= $valueContact ?></option>
							<?php } ?>
						<?php } ?>
					<?php } ?>
				</select>

				<label>Página / Caderno</label>
				<select name="page">
					<option selected disabled>Selecione</option>
					<?php foreach($infoPages as $valuePages){ ?>
						<option value="<?= $valuePages['name'] ?>"><?= $valuePages['name'] ?></option>
					<?php } ?>
				</select>

				<label>Tipo de contato</label>
				<select name="type">
					<option selected disabled>Selecione</option>
					<option value="Telefone">Telefone</option>
					<option value="Pessoalmente">Pessoalmente</option>
				</select>

				<label>Telefone</label>
				<select name="phone">
					<option selected disabled>Selecione</option>
					<?php foreach($infoClients as $valueClients){ ?>
						<?php if($valueClients['name'] == $current_client){ ?>
							<?php $phones = explode(",", $valueClients['phone']);
							foreach($phones as $valuePhone){ ?>
								<option value="<?=$valuePhone ?>"><?= $valuePhone ?></option>
							<?php } ?>
						<?php } ?>
					<?php } ?>
				</select>

				<label>Resultado</label>
				<select name="result">
					<option selected disabled>Selecione</option>
					<option value="Sim">Sim</option>
					<option value="Não">Não</option>
					<option value="Nova visita">Nova visita</option>
				</select>
			</fieldset>
			<div class="actions">
				<a href="index.php?tab=visitas&subtab=ultimas_visitas_cadastradas">Cancelar</a>
				<input type="submit" name="cadastrar_visita" value="Cadastrar visita">
			</div>
		</form>
	<?php } ?>
	<?php if($current_subtab == "visitas_de"){ ?>
		<div class="responsive_table">
			<table>
				<tr>
					<th>Cliente</th>
					<th>Página</th>
					<th>Contato</th>
					<th>Telefone</th>
					<th>Resultado</th>
					<th></th>
				</tr>
				<?php $sqlVisitsForEdit = $pdo->query("SELECT * FROM visits WHERE seller = '$_GET[seller]'");
				$infoVisitsForEdit = $sqlVisitsForEdit->fetchAll();
				foreach($infoVisitsForEdit as $valueVisitsForEdit){ ?>
					<tr>
						<td><?= $valueVisitsForEdit['client'] ?></td>
						<td><?= $valueVisitsForEdit['page'] ?></td>
						<td><?= $valueVisitsForEdit['contact'] ?></td>
						<td><?= $valueVisitsForEdit['phone'] ?></td>
						<td><?= $valueVisitsForEdit['result'] ?></td>
						<td><a href="index.php?tab=visitas&subtab=editar_visita&visit=<?= $valueVisitsForEdit['id'] ?>&client=<?= $valueVisitsForEdit['client'] ?>" class="edit"></a></td>
					</tr>
				<?php } ?>
			</table>
		</div>
	<?php } ?>
	<?php if($current_subtab == "editar_visita"){ ?>
		<?php $sqlVisitsToEdit = $pdo->query("SELECT * FROM visits WHERE id = '$_GET[visit]'");
		$infoVisitsToEdit = $sqlVisitsToEdit->fetchAll();
		foreach($infoVisitsToEdit as $valueVisitsToEdit){ ?>
			<form method="post">
				<fieldset>
					<label>Cliente</label>
					<?php for($i=0;$i<sizeof($infoClients);$i++){ ?>
						<?php if ($i == 0) { ?>
							<select name="client" onchange="window.location.replace('index.php?tab=visitas&subtab=editar_visita&visit='+<?= $valueVisitsToEdit['id'] ?>+'&client='+this.value)" required>
								<option <?php echo($current_client == "" ? "selected" : ""); ?> disabled>Selecione</option>
							<?php } ?>
							<option <?php echo($current_client == $infoClients[$i]['name'] ? "selected" : ""); ?> value="<?= $infoClients[$i]['name'] ?>"><?= $infoClients[$i]['name'] ?></option>
							<?php if ($i == sizeof($infoClients) - 1) { ?>
							</select>
						<?php } ?>
					<?php } ?>

					<label>Data da visita</label>
					<input type="date" name="date" value="<?= $valueVisitsToEdit['date'] ?>" required>

					<label>Vendedor</label>
					<select name="seller" required>
						<option <?php echo ($valueVisitsToEdit['seller'] == ""?"selected":"") ?> disabled>Selecione</option>
						<?php foreach($infoSellers as $valueSellers){ ?>
							<option <?php echo ($valueVisitsToEdit['seller'] == "$valueSellers[name]"?"selected":"") ?> value="<?= $valueSellers['name'] ?>"><?= $valueSellers['name'] ?></option>
						<?php } ?>
					</select>

					<label>Contato</label>
					<select name="contact">
						<option <?php echo ($current_client == ""?"selected":"") ?> disabled>Selecione</option>
						<?php foreach($infoClients as $valueClients){ ?>
							<?php if($valueClients['name'] == $current_client){ ?>
								<?php $contacts = explode(",", $valueClients['contact']);
								foreach($contacts as $valueContact){ ?>
									<option <?php echo ($current_client == "$valueContact"?"selected":"") ?> value="<?=$valueContact ?>"><?= $valueContact ?></option>
								<?php } ?>
							<?php } ?>
						<?php } ?>
					</select>

					<label>Página / Caderno</label>
					<select name="page">
						<option <?php echo ($valueVisitsToEdit['page'] == ""?"selected":"") ?> disabled>Selecione</option>
						<?php foreach($infoPages as $valuePages){ ?>
							<option <?php echo ($valueVisitsToEdit['page'] == "$valuePages[name]"?"selected":"") ?> value="<?= $valuePages['name'] ?>"><?= $valuePages['name'] ?></option>
						<?php } ?>
					</select>

					<label>Tipo de contato</label>
					<select name="type">
						<option <?php echo ($valueVisitsToEdit['type'] == ""?"selected":"") ?> disabled>Selecione</option>
						<option <?php echo ($valueVisitsToEdit['type'] == "Telefone"?"selected":"") ?> value="Telefone">Telefone</option>
						<option <?php echo ($valueVisitsToEdit['type'] == "Pessoalmente"?"selected":"") ?> value="Pessoalmente">Pessoalmente</option>
					</select>

					<label>Telefone</label>
					<select name="phone">
						<option <?php echo ($current_client == ""?"selected":"") ?> disabled>Selecione</option>
						<?php foreach($infoClients as $valueClients){ ?>
							<?php if($valueClients['name'] == $current_client){ ?>
								<?php $phones = explode(",", $valueClients['phone']);
								foreach($phones as $valuePhone){ ?>
									<option <?php echo ($current_client == "$valuePhone"?"selected":"") ?> value="<?=$valuePhone ?>"><?= $valuePhone ?></option>
								<?php } ?>
							<?php } ?>
						<?php } ?>
					</select>

					<label>Resultado</label>
					<select name="result">
						<option <?php echo ($valueVisitsToEdit['result'] == ""?"selected":"") ?> disabled>Selecione</option>
						<option <?php echo ($valueVisitsToEdit['result'] == "Sim"?"selected":"") ?> value="Sim">Sim</option>
						<option <?php echo ($valueVisitsToEdit['result'] == "Não"?"selected":"") ?> value="Não">Não</option>
						<option <?php echo ($valueVisitsToEdit['result'] == "Nova visita"?"selected":"") ?> value="Nova visita">Nova visita</option>
					</select>
					<input type="hidden" name="id" value="<?= $valueVisitsToEdit['id'] ?>">
				</fieldset>
				<div class="actions">
					<a href="<?= $previous ?>">Voltar</a>
					<a onclick="open_div('prevent_delete_<?= $valueVisitsToEdit['id'] ?>')" class="exclude_button">Excluir</a>
					<input type="submit" name="editar_visita" value="Editar visita">
				</div>
			</form>
			<form class="modal" method="post" id="prevent_delete_<?= $valueVisitsToEdit['id'] ?>">
				<p>Tem certeza?</p>
				<input type="hidden" name="id" value="<?= $valueVisitsToEdit['id'] ?>">
				<input type="submit" name="excluir_visita" value="Sim">
				<input type="button" value="Não" onclick="close_div('prevent_delete_<?= $valueVisitsToEdit['id'] ?>')">
			</form>
		<?php } ?>
	<?php } ?>
	<?php if($current_subtab == "visitas_por_vendedor"){ ?>
		<div class="responsive_table">
			<table>
				<tr>
					<th>Vendedor</th>
					<th>Total de visitas</th>
					<th></th>
				</tr>
				<?php foreach($infoSellers as $valueSellers){ ?>
					<tr>
						<td><?= $valueSellers['name'] ?></td>
						<?php $infoContVisits = $pdo->query("SELECT * FROM visits WHERE seller = '$valueSellers[name]'")->fetchAll(); ?>
						<td><?= sizeof($infoContVisits) ?></td>
						<td><a href="index.php?tab=visitas&subtab=visitas_de&seller=<?= $valueSellers['name'] ?>" class="edit"></a></td>
					</tr>
				<?php } ?>
			</table>
		</div>
	<?php } ?>
</div>