<?php 

	/*< incluimos las variables de entorno */
	include_once 'env.php';

	# index es un Router el cual redirecciona a las distintas secciones
	
	// Carga del motor de plantillas
	include_once 'lib/Pork/Pork.php';

	// por defecto seccion es landing
	$seccion = "landing";

	// slug tiene valor
	if($_GET['slug']!="")
		$seccion = $_GET['slug'];

	// verificamos que exista el controlador
	if(!file_exists('controllers/'.$seccion.'Controller.php')){
		// si no existe el controlador lo llevamos al controlador de error 404
		$seccion = "error404";
	}


	// listas de acceso por tipo de usuario
	$seccion_anonimo = ["landing", "panel", "detalles", "contacto"];
	$seccion_usuario = ["panel", "detalles", "contacto"];	

	// Carga del controlador
	include_once 'controllers/'.$seccion.'Controller.php';

 ?>