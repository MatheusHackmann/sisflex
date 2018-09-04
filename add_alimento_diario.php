<?php

$sql = new Sql();

$results = $sql->select("SELECT * FROM alimentos;");

foreach ($results as $r) {
	$alimento = utf8_encode($r['descricao']);
	$marca = utf8_encode($r['marca']);
	$carb = $r['carb'];
	$prot = $r['prot'];
	$gord = $r['gord'];
	$porcao = $r['porcao'];
	$unidade = $r['unidade'];
}
?>
<div class="container">
	<div class="row">
		<div class="offset-2 col-8">
			
			<!-- FORMULÁRIO PARA CADASTRO DE ALIMENTO -->
			<form method="POST" class="form-cadastro-alimento">
				<div class="row">
					<div class="col-12">
						<p><span class="fas fa-info-circle"></span> Forneça todas as informações corretamente para maior precisão nos cálculos.</p>
					</div>
				</div>

				<!-- NOME DO ALIMENTO -->
				<div class="row">
					<!-- TITULO -->
					<div class="col-12">
						<div class="alert alert-primary text-center">
							CADASTRO DE ALIMENTO
						</div>
					</div>

					<div class="col-12 col-md-6 form-group">
						<label for="descricao_alimento">Descrição do alimento: </label>
						<input type="text" class="form-control" name="descricao_alimento" id="descricao_alimento" placeholder="Ex: Arroz Branco Cozido">
					</div>
					<div class="col-12 col-md-6 form-group">
						<label for="marca_alimento">Marca: </label>
						<input type="text" class="form-control" name="marca_alimento" id="marca_alimento" placeholder="Ex: Prato Fino">
					</div>					
				</div>

				<!-- MACROS DO ALIMENTO -->
				<div class="row">
					<!-- TITULO -->
					<div class="col-12">
						<div class="alert alert-secondary text-center">
							MACRONUTRIENTES
						</div>						
					</div>

					<div class="col-12 col-md-4 form-group">						
						<label for="qntd_carboidratos">Carboidratos: </label>
						<input type="number" class="form-control" name="qntd_carboidratos" id="qntd_carboidratos" placeholder="g">
					</div>
					<div class="col-12 col-md-4 form-group">
						<label for="qntd_proteinas">Proteínas: </label>
						<input type="number" class="form-control" name="qntd_proteinas" id="qntd_proteinas" placeholder="g">
					</div>					
					<div class="col-12 col-md-4 form-group">
						<label for="qntd_gorduras">Gorduras: </label>
						<input type="number" class="form-control" name="qntd_gorduras" id="qntd_gorduras" placeholder="g">
					</div>					
				</div>

				<!-- INFORMAÇÕES DE PORÇÃO -->
				<div class="row">
					<!-- TITULO -->
					<div class="col-12">
						<div class="alert alert-secondary text-center">
							PORÇÃO
						</div>							
					</div>

					<div class="col-12 col-md-8 form-group">
						<label for="tamanho_porcao">Tamanho da porção:</label>
						<input type="number" class="form-control" name="tamanho_porcao" id="tamanho_porcao">
					</div>
					<div class="col-12 col-md-4 form-group">
						<label for="unidade_medida">Unicade de medida:</label>
						<input type="text" class="form-control" name="unidade_medida" id="unidade_medida" placeholder="Ex: g, scoop...">
					</div>					
				</div>

				<!-- BOTÃO SUBMIT -->
				<div class="row">
					<div class="col-12 col-md-6 form-group">
						<button class="btn btn-success">Cadastrar alimento</button>
					</div>
					<div class="col-12 col-md-6 form-group text-right">
						<a href="#" class="btn btn-danger">Cancelar</a>
					</div>					
				</div>
			</form>
		</div> 
		<!-- FIM DA DIV DE FORMULÁRIO DE CADASTRO -->
	</div>
</div>