<?php
	ob_start();
	set_time_limit(0);
	session_start();
	require_once('Include/conexionBD.php');

	if (isset($_GET['controller']))
	{
		$controller=$_GET['controller'];
		if(isset($_GET['action'])){
			$action=$_GET['action'];
		}else{
			$action ='index';
		} 

	} else {
		$controller='login';
		$_GET["action"]='index';
		$action='index';
	}
	
	require_once('View/Public_html/mainLayout.phtml');

	ob_end_flush();
?>