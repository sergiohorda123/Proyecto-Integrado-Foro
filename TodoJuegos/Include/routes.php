<?php
	$controllers= array(
						'login'=>['index','registro'],
						'portada'=>['index','noticia'],
						'juego'=>['index','plataforma','juego'],
						'foro'=>['index','comentario'],
						'admin'=>['index','ver','eliminar'],
						'chat'=>['index']
						//'Controlador'=>['metodo1','metodo2','metodo3','metodo4' ...],
						);

	if (array_key_exists($controller, $controllers)) {

		if (in_array($action, $controllers[$controller])) {

			require_once('Controller/' . $controller . 'Controller.php');

		}else{

			$controlador = $controller;
			$noExisteAction = $action;

			require_once('Controller/errorActionController.php');
		}
	}else{
			$noExisteController = $controller;
			$controller ="error";
			require_once('Controller/' . $controller . 'Controller.php');
	}
?>