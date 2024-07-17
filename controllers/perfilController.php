<?php 
	
	// cargo lo que esta adentro de la sesion
	$usuario = $_SESSION['huertaenred']["user"];

	// variables para la vista
	$vars = ["MSG_ERROR" => "",
	 "USER_NAME" => $usuario->first_name,
	 "USER_LAST_NAME" => $usuario->last_name];

	// si se presiono el boton de actualizar
	if(isset($_POST['btn__actualizar'])){

		// elimino el boton de actualizar
		unset($_POST["btn__actualizar"]);

		// actualizo los datos del usuario
		$response = $usuario->update($_POST);

		// en caso de que se haya logrado actualizar 
		if($response["errno"]==200){

			// redirecciona al panel
			header("Location: ?slug=panel");
		}

		// no se logro actualizar muestra el mensaje de error
		$vars = ["MSG_ERROR" => $response["error"]];
	} 
	
	// Carga la vista
	$tpl = new Pork("perfil");

	// carga las variables en la vista
	$tpl->setVars($vars);

	// imprime la vista en la página
	$tpl->print();
 ?>