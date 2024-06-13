<?php 

	/**
	 * 
	 * Se coloca aquí las credenciales provisionalmente
	 * Luego se creara un archivo para almacenarlas
	 * 
	 * */
	define("HOST", "localhost");
	define("USER", "huertaenred");
	define("PASS", "huertaenred1234");
	define("DB", "huertaenred");

	// Desactivamos el reporte de errores de mysqli
	mysqli_report(MYSQLI_REPORT_OFF);

	/**
	 * 
	 * Clase para heredar la conexión a la base de datos
	 * 
	 * */
	class DBAbstract{

		public $db;

		/**
		 * 
		 * Genera la conexión a la base de datos
		 * 
		 * */
		function __construct(){
			
			$this->db = @new mysqli(HOST, USER, PASS, DB);
			
			if($this->db->connect_errno){
				
				echo "Hubo un error en la conexion a la base de datos<br>";
				echo "codigo de error (".$this->db->connect_errno.") ".$this->db->connect_error;
				exit();
			}
			
		}


		/**
		 * 
		 * DML -> SELECT
		 * Realiza una consulta a la base de datos
		 * @param string $sql query
		 * @return array matriz con el resultado de la query
		 * 
		 * */
		function query($sql){

			$result = $this->db->query($sql);

			if($this->db->errno){

				echo "Hubo en error en la consulta: (".$this->db->errno.") ".$this->db->error;
				exit();
			}

			return $result->fetch_all(MYSQLI_ASSOC);
		}
	}



 ?>