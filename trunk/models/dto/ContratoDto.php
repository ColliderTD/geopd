<?php
require_once("config.php");
require_once(ModFol."ContratoMod.php");

class ContratoDTO extends ModelLib
{
	var $ContratoID;
	var $UsuarioID;
	var $Descripcion;
	var $Fecha;
	var $Fecha_Inicio;
	var $Fecha_Fin;
	var $Vistas_Contradas;
	var $Vistas_Utiles;
	var $ContratoPadre;

	function __construct() {}

	public function Persistencia()
	{	}

	public function Disminuir()
	{
		$oContrato = new ContratoMod();
		$oContrato->UpdVistas($this->ContratoID);
		$this->Vistas_Utiles--;
	}

}

?>