<nav class="opcoes">
	<div class="content">
		<a href="index.php?tab=relatorios&subtab=geral_relatorio">Gerar relatório</a>
	</div>
</nav>
</nav>
<div class="content">
	<h2><?= ucfirst(str_replace('_', ' ', $current_subtab))?></h2>
	<form method="post" action="resultado.php">
		<fieldset>
			<label>Data inicial</label>
			<input type="date" name="start_date">

			<label>Data final</label>
			<input type="date" name="end_date">

			<label>Vendedores</label>
			<select multiple class="chosen-select" name="seller[]">
				<option selected disabled></option>
				<?php foreach($infoSellers as $valueSellers){ ?>
					<option value="<?= $valueSellers['name'] ?>"><?= $valueSellers['name'] ?></option>
				<?php } ?>
			</select>

			<label>Clientes</label>
			<select multiple class="chosen-select" name="client[]">
				<option selected disabled></option>
				<?php foreach($infoClients as $valueClients){ ?>
					<option value="<?= $valueClients['name'] ?>"><?= $valueClients['name'] ?></option>
				<?php } ?>
			</select>

			<label>Páginas / Cadernos</label>
			<select multiple class="chosen-select" name="page[]">
				<option selected disabled></option>
				<?php foreach($infoPages as $valuPages){ ?>
					<option value="<?= $valuPages['name'] ?>"><?= $valuPages['name'] ?></option>
				<?php } ?>
			</select>

			<label>Tipo de visita</label>
			<select multiple class="chosen-select" name="type[]">
				<option selected disabled></option>
				<option value="Telefone">Telefone</option>
				<option value="Pessoalmente">Pessoalmente</option>
			</select>

			<label>Resultado</label>
			<select multiple class="chosen-select" name="result[]">
				<option selected disabled></option>
				<option value="Sim">Sim</option>
				<option value="Não">Não</option>
				<option>Nova visita</option>
			</select>
		</fieldset>
		<div class="actions">
			<input type="submit" name="gerar_relatorio" value="Gerar relatório">
		</div>
	</form>
</div>