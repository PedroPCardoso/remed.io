<?php

$conto="Alprazolam, Bromazepam, Clobazam, Clonazepam, Clordiazepóxido, Cloxazolam, Diazepam, Estazolam, Flunitrazepam, Flurazepam, Lorazepam, Midazolam, Nitrazepam.";
	
$arr = explode(',',$conto);

$i=0;
while( $i <= count($arr) ){
	echo "'$arr[$i]'";
	echo ": 'Em geral, os benzodiazepínicos aumentam o risco de comprometimento cognitivo, delirium, quedas, fraturas e acidentes automobilísticos. Evitar todos os benzodiazepínicos para tratar insônia, agitação ou delirium.',\n";
	$i++;	
}
