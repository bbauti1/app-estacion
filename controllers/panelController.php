<?php 

	// variables para la vista
	$vars = ["USER_NAME" => $_SESSION['huertaenred']["user"]->first_name]; 
	
	// Carga la vista
	$tpl = new Pork("panel");

	// carga las variables en la vista
	$tpl->setVars($vars);

	// imprime la vista en la página
	$tpl->print();
 ?>