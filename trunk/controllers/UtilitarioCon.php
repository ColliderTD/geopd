<?php

/**
 * @author Carlos Candela
 * @copyright 2009
 */

require_once("config.php");
require_once(Dao."UtilitarioDao.php");
require_once(ModFol."UsuarioMod.php");

class UtilitarioCon extends ControllerLib
{
	var $lPage;

	function __construct($page)
	{
		parent::__construct();
		$this->lPage = $page;

	}

	public function Salir()
	{
		session_destroy();
		header("Location:index.php");
	}

	public function Mensaje()
	{
		$Mensaje=$_GET['Codigo'];
		$eUsuario = unserialize($_SESSION['eUsuario']);
		$oHtml=HtmlLib::singleton();
		$lVars['btnRegresar']= $oHtml->imgbutton("window.open('index.php?Page=BsqPersona','_parent')",'pRegresar.png','Regresar');
		$lVars['Menu']=$eUsuario->get('objRol')->get('lMenu');
		$lVars['Mensaje']=constant($Mensaje);
		$this->lView->show($this->lPage,$lVars);
	}

	public function Paginacion()
	{
	  $Pagina=$_GET['Pagina'];
	  $Nombre=$_GET['Nombre'];

      $dgView = unserialize($_SESSION[$Nombre]);
      $dgView->Page=$Pagina;
      echo $dgView->Imprimir();
	}

	public function Ordenar()
	{
	  $Campo=$_GET['Campo'];
	  $Orden=$_GET['Orden'];
	  $Nombre=$_GET['Nombre'];

      $dgView = unserialize($_SESSION[$Nombre]);
      $dgView->Campo=$Campo;
      $dgView->Orden=$Orden;
      $dgView->ordenar();
      echo $dgView->Imprimir();
	}

}

?>