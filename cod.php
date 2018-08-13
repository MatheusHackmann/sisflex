<?php
require_once('classes/Sql.class.php');

$sql = new Sql();

$results = $sql->select("SELECT * FROM alimentos;");

foreach ($results as $r) {
	$alimento = utf8_encode($r['descricao']);
	$carb = $r['carb'];
	$prot = $r['prot'];
	$gord = $r['gord'];
	$porcao = $r['porcao'];

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

	$novaPorcao = 1;

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
?>