<?php 

	$buffer = file_get_contents('views/landingView.html');
		
	// modificacion de la plantilla

	$cantHuerta = 5000;

	$buffer = str_replace("{{CANT_HUERTAS}}", $cantHuerta, $buffer);


	// imprimir en pantalla la plantilla
	echo $buffer;
 ?>