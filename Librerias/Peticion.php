<?php
class Peticion
{
//propiedades utilizadas en los metodos
	protected $url;
	protected $controlador;
	protected $controladorDefecto="Home";
	protected $accion;
	protected $accionDefecto="index";
	protected $parms= array();
//funcion que se ejecuta inmediatamente de que se crea un objeto peticion	
	public function __construct ($url)
	{
		$this -> url =$url;
		//controlador/accion/parametros
		//divide un string en array
		$segmentos= explode('/', $this->obtenerDireccion());
		$this -> resolverControlador($segmentos);
		$this -> resolverAccion($segmentos);
		$this -> resolverParametros($segmentos);
	}
	
	//pasamos la variable por referencia no por valor
	public function resolverControlador(&$segmentos)
	{
		//obtenemos el primer elemento de un array
		$this->controlador=array_shift($segmentos);
		if (empty($this->controlador)) {
			$this -> controlador = $this -> controladorDefecto;
		}
	}
	public function resolverAccion(&$segmentos)
	{
		//obtenemos el primer elemento de un array
		$this->accion=array_shift($segmentos);
		if (empty($this->accion)) {
			$this -> accion = $this -> accionDefecto;
		}
	}
	public function resolverParametros(&$segmentos)
	{
		$this -> parms=$segmentos;
	}
	public function getControlador()
	{
		//home
		return $this ->controlador;
	}

	public function obtenerDireccion()
	{
		return $this->url;
	}

	public function getNombreControlador()
	{
		//ControladorHome
		return 'Controlador'.Inflector::camello($this->getControlador());
	}

	public function getArchivoControlador()
	{
		//controladores/
		return "controladores/".$this->getNombreControlador().".php";
	}
	public function getAccion()
	{
		return $this->accion;
	}
	public function obtenerNombreAccion()
	{
		return Inflector::minuscula($this->getAccion())."Accion";	
	}
	public function obtenerParametros()
	{
		return $this->parms;
	}
	public function execute()
	{
			//ControladorHome
		$nombreControlador = $this -> getNombreControlador();
			//controladores/ControladorHome.php
		$archivoControlador = $this -> getArchivoControlador();
			//saludo.Accion
		$nombreAccion = $this -> obtenerNombreAccion();
		
		$parametros = $this -> obtenerParametros();
		if (!file_exists($archivoControlador)) {
			exit("El controlador no existe");
		}
		require $archivoControlador;
		$controlador= new $nombreControlador();
		//$controlador->$nombreAccion();
		call_user_func_array([$controlador,$nombreAccion], $parametros);
	}
}