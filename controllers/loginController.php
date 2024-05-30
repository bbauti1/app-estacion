<?php 

	// carga de plantilla
	$f_view = fopen('views/loginView.html', "r");

	$buffer = "";

	while (!feof($f_view)) {
	 	$buffer .= fgets($f_view);
	} 
		
	// modificacion de la plantilla


	// imprimir en pantalla la plantilla
	echo $buffer;

 ?>