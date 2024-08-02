<?php 
	
	// cargo lo que esta adentro de la sesion
	$usuario = $_SESSION['huertaenred']["user"];

	// se hace soft delete del usuario
	$usuario->leaveOut();

	// limpia las variables de la sesión
	session_unset();

	// destruye toda la información asociada con la sesión actual.
	session_destroy();

	// redirecciona a la landind
	header("Location: landing");
 ?>