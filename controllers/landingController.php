<?php 

	
	// carga de plantilla
	$f_view = fopen('views/landingView.html', "r");

	$buffer = "";

	while (!feof($f_view)) {
	 	$buffer .= fgets($f_view);
	} 
		
	// modificacion de la plantilla

	$cantHuerta = 5000;

	$buffer = str_replace("{{CANT_HUERTAS}}", $cantHuerta, $buffer);


	// imprimir en pantalla la plantilla
	echo $buffer;
 ?>