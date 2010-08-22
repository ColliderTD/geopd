<?php
require_once("config.php");
require_once(ModFol."RolMod.php");
require_once(ModFol."ContratoMod.php");
require_once(ModFol."UsuarioMod.php");

class UsuarioDTO extends ModelLib
{
	var $UsuarioID;
	var $Usuario;
	var $Nombres;
	var $Apellidos;
	var $RolID;
	protected $objRol;
	protected $objContrato;

	function __construct(){}

	public function Persistencia()
	{
		$oRol = new RolMod();
		$objRol = $oRol->GetRol($this->RolID);
		$objRol->Persistencia();
		$this->objRol = $objRol;

		$oContrato = new ContratoMod();
		$this->objContrato = $oContrato->GetContrato($this->UsuarioID);
	}

	public function InsVista($Documento,$sPersona,$iEstado)
	{
		$oUsuario = new UsuarioMod();
		$iEstado=0;$iContrato=0;
		if($this->objContrato!=null && $this->objContrato->get('Vistas_Utiles')>0)
		{
			$iContrato=$this->objContrato->get('ContratoID');
			$this->objContrato->Disminuir();
		}
		else
		{
			if($this->objRol->get('Visita')==1)
			header("Location:index.php?Page=Utilitario&Action=Mensaje&Codigo=1");
		}
		$oUsuario->InsVista($this->UsuarioID,$Documento,$sPersona,$iEstado,$iContrato);
	}
}

?>