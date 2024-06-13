<?php
	
	// Incluimos la clase que conecta a la base de datos
	include_once 'DBAbstract.php';
	
	/**
	 * 
	 * Clase para trabajar con la tabla de usuarios
	 * 
	 * */
	class Users extends DBAbstract{

		public $email;
		public $nombre;
		public $id;

		/**
		 * 
		 * ejectuta el constructor de DBAbstract
		 * 
		 * */
		function __construct(){
			parent::__construct();
		}


		/**
		 * 
		 * Para loguear a un usuario
		 * 
		 * */
		function login(){

		}

		/**
		 * 
		 * Busca un usuario por medio de su email
		 * @param string $email correo electrónico del usuario
		 * @return array datos con datos del usuario
		 * 
		 * */
		function getByEmail($email){

			$result = $this->query("SELECT * FROM users WHERE email = '$email'");

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