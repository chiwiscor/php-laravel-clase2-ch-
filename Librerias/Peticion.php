<?php
class Peticion
{
	protected $url;
	public function __construct ($url)
	{
		$this -> url =$url;
	}
	public function obtenerDireccion()
	{
		return $this->url;
	}
}