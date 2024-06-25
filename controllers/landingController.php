<?php 

	// carga la vista
	$tpl = new Pork("landing");

	// creamos un usuario
	$usuario = new Users();

	// variables a reemplazar en la plantilla con sus valores
	$var = ["CANT_HUERTAS" => 1, "CANT_USERS" => $usuario->cant()];

	// reemplaza las variables de la vista con los valores del vector
	$tpl->setVars($var);

	// imprime la vista en la página
	$tpl->print();

 ?>