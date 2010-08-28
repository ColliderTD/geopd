<?php
require_once("config.php");
require_once(ModFol."RolMod.php");

class RolDTO extends ModelLib
{
	var $RolID;
	var $RolNom;
	var $RolDes;
	var $Visita;
	private $lPermisos=array();
	protected $lMenu;

	function __construct() {}

	public function Persistencia()
	{
		$this->Menu();
	}

	private function Menu()
	{
		$oRol = new RolMod();
		$dtPaginas = $oRol->GetPaginasbyRol($this->RolID);
		$Menu = IniMenu; $sModName=""; $flag=false;

		while($dtRow=mysql_fetch_array($dtPaginas))
		{
			if($sModName!=$dtRow["ModuloNom"])
			{  $sModName=$dtRow["ModuloNom"];
			if($flag==true)$Menu=$Menu.FinModulo; else $flag=true;
			$Menu = $Menu.sprintf(IniModulo,$sModName,$sModName);
			}
			$Menu=$Menu.sprintf(Pagina,$dtRow["PaginaNom"],$dtRow["PaginaUrl"],$dtRow["PaginaNom"]);
		}

		$Menu=$Menu.FinModulo.FinMenu.MenuJS;
		$this->lMenu= $Menu;
	}
}?>