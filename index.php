<?php
	require "configuracion.php";
	require "funciones.php";
	require "Librerias/Peticion.php";
	require "Librerias/Inflector.php";
//controlador($_GET['direccion']);	
if (empty($_GET['direccion'])) 
	{
		$dir= "";
	}else
	{
		$dir=$_GET['direccion'];
	}
$nuevaPeticion= new Peticion($dir);
//var_dump($nuevaPeticion->obtenerNombreClaseControlador());
//var_dump($nuevaPeticion->obtenerNombreAccion());
$nuevaPeticion->execute();
