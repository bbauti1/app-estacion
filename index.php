<?php 

	// carga de modelos para que esten disponibles en todos los controladores
	include_once 'models/Users.php';

	// inicia o continua la sesión
	session_start();

	# index es un Router el cual redirecciona a las distintas secciones
	
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

	// === firewall

	// listas de acceso por tipo de usuario
	$seccion_anonimo = ["landing", "login", "register"];
	$seccion_usuario = ["panel", "logout", "perfil"];	

	// si el usuario esta logueado
	if(isset($_SESSION['huertaenred'])){
		// recorro la lista de secciones no permitidas
		foreach ($seccion_anonimo as $key => $value) {
			if($value==$seccion){
				$seccion = "panel";
				break;
			}
		}
	}else{ // si no hay usuario logueado

		// recorro la lista de secciones no permitidas
		foreach ($seccion_usuario as $key => $value) {
			if($value==$seccion){
				$seccion = "landing";
				break;
			}
		}
	}

	// === fin firewall


	// Carga del controlador
	include_once 'controllers/'.$seccion.'Controller.php';

 ?>