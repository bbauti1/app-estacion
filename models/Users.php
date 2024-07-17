<?php
	
	// Incluimos la clase que conecta a la base de datos
	include_once 'DBAbstract.php';
	
	/**
	 * 
	 * Clase para trabajar con la tabla de usuarios
	 * 
	 * */
	class Users extends DBAbstract{

		/**
		 * 
		 * ejectuta el constructor de DBAbstract
		 * Realiza auto creación de atributos en la clase en base a la tabla
		 * 
		 * */
		function __construct(){
			parent::__construct();

		 	$request = $this->query("DESCRIBE users");

		 	$request = $request->fetch_all(MYSQLI_ASSOC);

			foreach ($request as $key => $value) {

				$var = $value["Field"];

				$this->$var = "";
			}
		}

		/**
		 * 
		 * Desloguea al usuario
		 * 
		 * */
		function logout(){

		}


		/**
		 * 
		 * soft delete sobre el usuario
		 * 
		 * 
		 * */
		function leaveOut(){

			$fecha_hora = date("Y-m-d H:i:s");
			$id = $this->id;

			$ssql = "UPDATE users SET delete_at='$fecha_hora' WHERE id=$id";

			$this->query($ssql);

		}

		/**
		 * 
		 * Valida el usuario y contraseña
		 * @param array $form formulario de logueo sin el botón
		 * @return array errno and error
		 * 
		 * */
		function login($form){
			
			$email = $form["txt_email"];
			// encripta la contraseña con md5
			$pass = md5($form["txt_contraseña"]);

			// averigua si el email existe en la tabla de users
			$result = $this->query("CALL `login`('$email')");

			$result = $result->fetch_all(MYSQLI_ASSOC);

			// si no hay filas
			if(count($result)==0){
				return ["errno" => 404, "error" => "Email no registrado"];
			}

			// si la contraseña no coincide
			if($result[0]["pass"]!=$pass){
				return ["errno" => 400, "error" => "Contraseña invalida"];
			}

			// carga los atributos con los datos del usuario
			$this->first_name = $result[0]["first_name"];
			$this->last_name = $result[0]["last_name"];
			$this->email = $result[0]["email"];
			$this->id = $result[0]["id"];

			// retorna un mensaje de logueo satisfactorio
			return ["errno" => 200, "error" => "Usuario logueado"];
		}

		/**
		 * 
		 * Actualiza los datos del usuario
		 * @param array $form formulario sin el botón
		 * @return array errno and error
		 * 
		 * */
		function update($form){

			$nombre = $form["txt_nombre"];
			$apellido = $form["txt_apellido"];
			$id = $this->id;

			// actualiza el nombre
			$sql = "CALL `users_update`('$nombre','$apellido','$id')";

			// ejecuta la consulta
			$this->query($sql);

			// reemplaza el atributo nombre con el valor nuevo
			$this->first_name = $nombre;
			$this->last_name = $apellido;

			// var_dump($this);

			// exit();

			// retorna el mensaje de que esta todo bien
			return ["errno" => 200, "error" => "Se actualizaron los datos"];
		}

		/**
		 * 
		 * Agrega un nuevo usuario si no existe en la tabla de usuarios el correo
		 * @param array $form formulario sin el botón
		 * @return array errno and error
		 * 
		 * */
		function register($form){

			$email = $form["txt_email"];
			// encripta la contraseña
			$pass = md5($form["txt_contraseña"]);

			// Averigua si el email ya esta en la tabla de users
			$result = $this->query("SELECT * FROM users WHERE email = '$email'");

			$result = $result->fetch_all(MYSQLI_ASSOC);

			// si no hay resultado entonces podemos agregar el usuario
			if(count($result)==0){

				// inserta el nuevo usuario
				$sql = "INSERT INTO users (email, pass) VALUES ('$email', '$pass')";

				$this->query($sql);

				// id del nuevo usuario
				$this->id = $this->db->insert_id;

				// mensaje de exito al agregar
				return ["errno" => 200, "error" => "Usuario agregado"];
			}

			// Es alguien que volvio arrastrandose?
			if($result[0]["delete_at"]!='0000-00-00 00:00:00'){
				$fecha_hora = date("0000-00-00 00:00:00");
				$id = $result[0]["id"];
				$this->id = $id;

				$ssql = "UPDATE users SET delete_at='$fecha_hora', first_name='', last_name='' WHERE id=$id";

				$this->query($ssql);

				// mensaje del email ya esta registrado
				return ["errno" => 201, "error" => "Usuario vuelve arrastrandose"];
			}

			// mensaje del email ya esta registrado
			return ["errno" => 400, "error" => "Email ya registrado"];
		}

		/**
		 * 
		 * Busca un usuario por medio de su email
		 * @param string $email correo electrónico del usuario
		 * @return array datos con datos del usuario
		 * 
		 * */
		function getByEmail($email){

			// Busca el email
			$result = $this->query("SELECT * FROM users WHERE email = '$email'");

			$result = $result->fetch_all(MYSQLI_ASSOC);

			// carca el atributo nombre con el nombre del usuario
			$this->nombre = $result[0]["first_name"];

			return $result;
		}

		/**
		 * 
		 * Cantidad total de usuarios
		 * @return int cantidad de usuarios
		 * 
		 * */
		function cant(){
			$this->query("SELECT * FROM users");
			return $this->db->affected_rows;
		}
	}

 ?>