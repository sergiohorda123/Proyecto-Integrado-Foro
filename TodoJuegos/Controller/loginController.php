<?php

require_once("Model/login.php");

if (isset($_GET['action'])) {
	if(isset($_GET['sesion'])){
		session_destroy();
        header("Location:index.php");
	}
	if(!isset($_SESSION["usuario"])){
		if ($_GET['action'] == 'index') {
			require_once('View/Login/index.phtml');
			if (isset($_GET['registrado'])) {
				$nombreUsuario = htmlentities(addslashes($_POST['usuario']));
				$pass = htmlentities(addslashes($_POST['pass']));
				$email = $_POST['email'];
				$registros = new Login($enlaceBD,0, $nombreUsuario, $pass, "usuario.jpg",null,$email);
				$registros->Seleccionar("nombre_usuario = '" . $nombreUsuario . "' OR email = '" . $email . "'");
				if($registros->TotalFilasConsulta() != 0) {
					echo "<h1 class='text-center text-white'>Ya existe un usuario con ese nombre o ese email</h1>";
				} else {
					$registros->Insertar();
					echo "<h1 class='text-center text-white'>Usuario Creado</h1>";
				}
			}
			if (isset($_GET['logeado'])){
				$nombreUsuario = htmlentities(addslashes($_POST['usuario']));
				$pass = htmlentities(addslashes($_POST['pass']));
				$logeo = new Login($enlaceBD,$nombreUsuario, $pass);
				$logeo->Seleccionar("nombre_usuario='" . $nombreUsuario . "'");
				if($logeo->TotalFilasConsulta() == 0){
					echo "<h2 class='text-center text-white'>Introduzca correctamente el nombre y la contraseña</h2>";
				}else{
					$logeo->CargarDatos(0);
					$pass_encryptada = $logeo->getPass();
					if(password_verify($pass,$pass_encryptada)){
						$_SESSION["usuario"] = $logeo->getNombre_usuario();
						$_SESSION["rol"] = $logeo->getRol();
						header("Location:index.php?controller=portada&action=index");
					}
				}
			}
		}
	
		if ($_GET['action'] == 'registro') {
			require_once('View/Login/registro.phtml');
		}
	}
}else{
	header("Location:index.php");
}
