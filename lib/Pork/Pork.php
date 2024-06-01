<?php 

	/**
	 * 
	 * Carga la vista y la retorna como un string
	 * @param string $tpl es el nombre de la vista
	 * @return string es la vista
	 * 
	 * */
	function loadTPL($tpl){
		return file_get_contents('views/'.$tpl.'View.html');
	}

	/**
	 * 
	 * Reemplaza las variables dentro de la plantilla
	 * @param array $var es un vector asociativo nombre variable y valor
	 * @param string $haystack es la vista
	 * @return string es la vista modificada
	 * 
	 * */
	function setVarsTPL($var, $haystack){
		
		foreach ($var as $needle => $value) {
			$haystack = str_replace("{{".$needle."}}", $value, $haystack);
		}

		return $haystack;
	}

	/**
	 * 
	 * Imprime la vista en pantalla
	 * @param string $buffer es la vista
	 * 
	 * */
	function printTPL($buffer){
		echo $buffer;
	}


 ?>