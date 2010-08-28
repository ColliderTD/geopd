<?php
abstract class PrincipalLib
{
	private function __construct() {  }

	//Con set vamos guardando nuestras variables.
	public function set($name, $value)
	{
		return $this->$name=$value;
	}

	//Con get('nombre_de_la_variable') recuperamos un valor.
	public function get($name)
	{

		if(isset($this->$name))
		{
			return $this->$name;
		}
	}

}
?>