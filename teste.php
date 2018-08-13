<?php

$kcal = 2000;

$carb = number_format((($kcal/100)*45)/4, 1, '.', '');
$prot = number_format((($kcal/100)*30)/4, 1, '.', '');
$gord = number_format((($kcal/100)*25)/9, 1, '.', '');

$carbRef = number_format($carb/5, 1, '.', '');
$protRef = number_format($prot/5, 1, '.', '');
$gordRef = number_format($gord/3, 1, '.', '');



echo "
<pre>
<b>Café da manhã</b>: ".(($carbRef*4)+($protRef*4))." kcals
<b>Almoço</b>: ".(($carbRef*4)+($protRef*4)+($gordRef*9))." kcals
<b>Café da tarde</b>: ".(($carbRef*4)+($protRef*4))." kcals
<b>Janta</b>: ".(($carbRef*4)+($protRef*4)+($gordRef*9))." kcals
<b>Ceia</b>: ".(($carbRef*4)+($protRef*4)+($gordRef*9))." kcals

<b>Carb por dia</b>: $carb g
<b>Prot por dia</b>: $prot g
<b>Gord por dia</b>: $gord g

<b>Café da manhã</b>: 
$carbRef carb
$protRef prot
0 gord

<b>Almoço</b>: 
$carbRef carb
$protRef prot
$gordRef gord

<b>Café da tarde</b>: 
$carbRef carb
$protRef prot
0 gord

<b>Janta</b>: 
$carbRef carb
$protRef prot
$gordRef gord

<b>Ceia</b>: 
$carbRef carb
$protRef prot
$gordRef gord
</pre>";


// ULTIMA IDÉIA, SEPARAR AS KCALS POR REFEIÇÃO SEPARANDO A QUANTIDADE DE MACRO PRA CADA REFEIÇÃO
