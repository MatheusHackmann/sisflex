<?php
require_once('Sql.class.php');

class Alimentos {
	public function cadastrarAlimento($descricaoAlimento, $marcaAlimento, $carb, $prot, $gord, $porcao, $unidade){
		$sql = new Sql();

		//Calculo das calorias com base nas quantidades dos macronutrientes
		$kcals = ($carb*4) + ($prot*4) + ($gord*9);

		//Inserindo no banco
		$sql->query("
			INSERT INTO alimentos (descricao, marca, carb, prot, gord, porcao, unidade, kcals)
			VALUES (:DESCRICAO, :MARCA, :CARB, :PROT, :GORD, :PORCAO, :UNIDADE, :KCALS);", array(
				":DESCRICAO" => utf8_decode($descricaoAlimento),
				":MARCA" => utf8_decode($marcaAlimento),
				":CARB" => $carb,
				":PROT" => $prot,
				":GORD" => $gord,
				":PORCAO" => $porcao,
				":UNIDADE" => $unidade,
				":KCALS" => number_format($kcals, 1, '.', '')
			));
	}

	public function trazerAlimentosRefeicao(){
		$sql = new Sql();
		$results = $sql->select("SELECT * FROM alimentos;");
		return $results;
	}

}
?>