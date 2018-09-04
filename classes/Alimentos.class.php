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

	public function calcularNovaPorcao($alimento = 'Iogurte', $carb = 9.1, $prot = 6.8, $gord = 7, $porcao = 170, $novaPorcao = 400){

	//Calculando as calorias que cada macro possui no alimento
		$kcalCarb = $carb*4;
		$kcalProt = $prot*4;
		$kcalGord = $gord*9;

	//Calculando as calorias totais, somando as calorias de cada macro
		$kcals = number_format(($kcalCarb + $kcalProt + $kcalGord), 1, '.', '');

	//Calculando as calorais por 1 g da porcao
		$kcalPorcao = number_format(($kcals / $porcao), 2, '.', '');

	//Calcula a porcentagem de cada macro na porção
		$porcentagemCarb = number_format(($kcalCarb/$kcals)*100, 2, '.', '');
		$porcentagemProt = number_format(($kcalProt/$kcals)*100, 2, '.', '');
		$porcentagemGord = number_format(($kcalGord/$kcals)*100, 2, '.', '');	

		echo "
		<pre>
		Informações do alimento por porção

		<b>Alimento:</b> $alimento
		<b>Carboidrato:</b> $kcalCarb"." kcal / $carb"."g / $porcentagemCarb"."%
		<b>Proteína:</b> $kcalProt"." kcal / $prot"."g / $porcentagemProt"."%
		<b>Gordura:</b> $kcalGord"." kcal  / $gord"."g / $porcentagemGord"."%

		<b>KCALS:</b> $kcals
		<b>KCALS/g:</b> $kcalPorcao
		-------------------------------------------------
		</pre>";

	//Calcula as novas calorias multiplicando a Nova Porção pela Kcal/Porção
		$novaKcal = $kcalPorcao*$novaPorcao;

	//Porcentagem das novas calorias
		$porcentagemNovaKcal = number_format(($novaKcal/$kcals)*100, 2, '.', '');

		if ($porcentagemNovaKcal > 100) {
		//Calcula a porcentagem de adição de kcal
			$porcentagemPorcao = $porcentagemNovaKcal - 100;

			$carb = number_format((($porcentagemPorcao/100)*$carb) + $carb, 1, '.', '');
			$prot = number_format((($porcentagemPorcao/100)*$prot) + $prot, 1, '.', '');
			$gord = number_format((($porcentagemPorcao/100)*$gord) + $gord, 1, '.', '');

			$kcalCarb = $carb*4;
			$kcalProt = $prot*4;
			$kcalGord = $gord*9;		

			echo "<pre> 	
			Novas informações do alimento por porção

			<b>Alimento:</b> $alimento
			<b>Carboidrato:</b> $kcalCarb"." kcal / $carb"."g
			<b>Proteína:</b> $kcalProt"." kcal / $prot"."g
			<b>Gordura:</b> $kcalGord"." kcal  / $gord"."g

			<b>KCALS:</b> $novaKcal
			-------------------------------------------------------------
			</pre>";		
		}
		else if ($porcentagemNovaKcal < 100){
		//Calcula a porcentagem de adição de kcal
			$porcentagemPorcao = abs($porcentagemNovaKcal - 100);

			echo $porcentagemPorcao;

			$carb = abs(number_format((($porcentagemPorcao/100)*$carb) - $carb, 1, '.', ''));
			$prot = abs(number_format((($porcentagemPorcao/100)*$prot) - $prot, 1, '.', ''));
			$gord = abs(number_format((($porcentagemPorcao/100)*$gord) - $gord, 1, '.', ''));

			$kcalCarb = $carb*4;
			$kcalProt = $prot*4;
			$kcalGord = $gord*9;		

			echo "<pre> 	
			Novas informações do alimento por porção

			<b>Alimento:</b> $alimento
			<b>Carboidrato:</b> $kcalCarb"." kcal / $carb"."g
			<b>Proteína:</b> $kcalProt"." kcal / $prot"."g
			<b>Gordura:</b> $kcalGord"." kcal  / $gord"."g

			<b>KCALS:</b> $novaKcal
			-------------------------------------------------------------
			</pre>";		
		}		
	}

}
?>