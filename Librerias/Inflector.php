<?php 
class Inflector{

	public static function camello($valor)
	{
		$segmentos= explode("-", $valor);
		//recorremos el arreglo, y en cada item ejecutamos la funcion
		array_walk($segmentos, function(&$item){
			//convertimos el primer caracter en MAYUSCULAS
			$item= ucfirst($item);
		});
		//Convertimos en array en un string
		return implode("",$segmentos);
	}

	public static function minuscula($valor)
	{
		return lcfirst( static::camello($valor));
	}
}