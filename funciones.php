<?php
function verVista($ver,$datos=array() )
	{
		extract($datos);
		require "vistas/$ver.tpl.php";
	}
function controlador($nombre)
{
	if (empty($nombre)) {
		$nombre="home";
	}
	$archivo = "controladores/$nombre.php";
	if (file_exists($archivo)) 
	{
		require ($archivo);	
	}else
	{
		header("HTTP/1.0 404 Not Found");
		exit("pagina no encontrada");
	}
}