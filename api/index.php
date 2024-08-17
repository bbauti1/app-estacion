<?php

	/**
	* @file index.php
	* @brief API Restful para el proyecto HuertaEnRed
	* @author Matias Leonardo Baez
	* @date 2024
	* @contact elmattprofe@gmail.com
	*/

	/*< la respuesta es un JSON*/
	header("Content-Type: application/json");

	// si no enviaron la variable modelo
	if(!isset($_GET["modelo"])){
		echo json_encode(["errno" => 404, "error" => "Falta especificar el modelo al cual acceder"]);
		exit();
	}

	/*< Normalización del valor de modelo, todo a minúscula y la primer letra en mayúscula */
	$modelo = ucfirst((strtolower($_GET['modelo'])));

	/*< valida que exista el archivo correspondiente al modelo */
	if(!file_exists('../models/'.$modelo.'.php')){
		echo json_encode(["errno" => 404, "error" => "Modelo no existente"]);
		exit();
	}
	
	/*< incluye el modelo*/
	include_once '../models/'.$modelo.'.php';

	/*< Instancia la clase en un objeto */
	$object = new $modelo();

	/*< Valida que se haya enviado la variable method*/
	if(!isset($_GET["method"])){
		echo json_encode(["errno" => 404, "error" => "Falta especificar el metodo a utilizar"]);
		exit();
	}
	
	/*< valida que exista el metodo dentro del objeto*/
	if(!method_exists($object, $_GET['method'])){
		echo json_encode(["errno" => 404, "error" => "No existe el metodo"]);
		exit();
	}

	/*< se pasa metodo del vector de GET a una variable para que sea más comodo */
	$method = $_GET['method'];

	/*< valida que exista la variable params */
	if(!isset($_GET["params"])){
		echo json_encode(["errno" => 404, "error" => "Falta especificar parametros"]);
		exit();
	}

	/*< se pasa params del vector de GET a una variable para que sea más comodo */
	$params = $_GET['params'];

	/*< ejecuta el método de la clase con los parámetros */
	$response = $object->$method($params);

	/*< transforma la respuesta en un JSON y la pinta en el cuerpo de la página */
	echo json_encode($response);