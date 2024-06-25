<?php

	// variables para la vista
	$vars = ["MSG_ERROR" => ""];

	// se presiono el botón de login en la vista
	if(isset($_POST['btn__login'])){

		// se instancia la clase Users
		$usuario = new Users();

		// borra el botón del vector de POST
		unset($_POST["btn__login"]);

		// Procede a intentar loguear enviando el formulario al metodo login
		$response = $usuario->login($_POST);

		// si la respuesta es que el logueo fue valido
		if($response["errno"]==200){

			// Crea en el vector de sesión una fila que se llama como la app y dentro una columna para guardar el objeto User
			$_SESSION['huertaenred']['user'] = $usuario;

			// redirecciona al panel del usuario
			header("Location: ?slug=panel");
		}

		// la respuesta al logueo es error
		$vars = ["MSG_ERROR" => $response["error"]];
	} 
	
	// Carga la vista
	$tpl = new Pork("login");

	// reemplaza las variables de la vista
	$tpl->setVars($vars);

	// imprime la vista en la página
	$tpl->print();
 ?>