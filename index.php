<?php 

	# index es un Router el cual redirecciona a las distintas secciones
	
	# el router tiene ahora autocarga de controladores
	

	$seccion = "landing";

	if(isset($_GET['slug']))
		$seccion = $_GET['slug'];


	if(!file_exists('controllers/'.$seccion.'Controller.php')){
		$seccion = "error404";
	}


	include_once 'controllers/'.$seccion.'Controller.php';

 ?>