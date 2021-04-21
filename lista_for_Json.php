<?php

$conto="nimesulida";

$resposta = "alto risco de hepatotoxicidade. Não oferece vantagem terapêutica ou melhor segurança gastrointestinal em comparação com outros AINEs, ao passo que expõe os pacientes a um risco maior de distúrbios hepáticos fatais.";
$arr = explode(',',$conto);
$error = "<div> <b > Exceção</b>  
A nimesulida está associada a um risco ligeiramente aumentado de hepatotoxicidade, que aumenta com o tempo de exposição e a dosagem. Recomenda-se a restrição do seu uso ao tratamento da dor aguda, tratamento sintomático da osteoartrite dolorosa e dismenorreia primária.

</div>";
$i=0;
while( $i <= count($arr) ){
	echo "'$arr[$i]'";
    echo ": '$resposta  $error',\n";

// 	echo ":'$resposta',\n";
	$i++;	
}
