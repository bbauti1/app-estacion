<?php 

	# index es un Router el cual redirecciona a las distintas secciones
	
	# el router tiene ahora autocarga de controladores
	
	// Carga del motor de plantillas
	include_once 'lib/Pork/Pork.php';

	// por defecto seccion es landing
	$seccion = "landing";

	// si existe slug entonces la sección es su contenido
	if(isset($_GET['slug']))
		$seccion = $_GET['slug'];

	// verificamos que exista el controlador
	if(!file_exists('controllers/'.$seccion.'Controller.php')){
		// si no existe el controlador lo llevamos al controlador de error 404
		$seccion = "error404";
	}

	// Carga del controlador
	include_once 'controllers/'.$seccion.'Controller.php';

 ?>