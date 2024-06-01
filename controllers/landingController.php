<?php 

	// incluye el modelo que conecta con la tabla de usuarios
	include_once 'models/Users.php';

	// carga la plantilla
	$tpl = loadTPL("landing");
		
	// variables a reemplazar en la plantilla con sus valores
	$var = ["CANT_HUERTAS" => getCantHuertas(), "CANT_USERS" => 30];

	// reemplazo de variables en la plantilla
	$tpl =setVarsTPL($var,$tpl);

	// imprimir en pantalla la plantilla
	printTPL($tpl);
 ?>