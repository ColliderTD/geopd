<?php

/**
 * @author Carlos Candela
 * @copyright 2009
 */

require_once("config.php");
class InicioCon extends ControllerLib
{
	var $lPage;

	function __construct($page)
	{
		parent::__construct();
		$this->lPage = $page;

	}

	public function Load()
	{
		$lHtml=HtmlLib::singleton();
		$oAjax=new AjaxLib();

		$lVars['TitlePage']="GEOPD -  Sistema de Ubicacion OnLine ";

		$lVars['edtUsuario']=$lHtml->textbox('edtUsuario','edtUno','',10,'');
		$lVars['edtContrasena']=$lHtml->pass('edtContrasena','edtUno','',10);
		//array("onClick","valLogin(this.form)");
		$lVars['btnIngresar']= $lHtml->submit('btnIngresar','btnPrincipal','Ingresar','');
		$lVars['Page']=$lHtml->hidden('Page','Usuario');
		$lVars['Action']=$lHtml->hidden('Action','Validar');

		$lVars['Ajax']=$oAjax->ImprimirJs();

		$lVars['Mensaje']=$lHtml->label("lblError","msjError",$_SESSION['Mensaje']);
		$_SESSION['Mensaje']="";

		$this->lView->show($this->lPage,$lVars);
	}
}

?>