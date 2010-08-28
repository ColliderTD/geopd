<?php
require_once("config.php");
require_once(ModFol."PersonaMod.php");
require_once(ModFol."UsuarioMod.php");

class BsqPersonaCon extends ControllerLib
{
	var $lPage;
	var $oHtml;
	var $oAjax;

	function __construct($page)
	{
		parent::__construct();
		$this->lPage = $page;
		$this->oHtml=HtmlLib::singleton();
		$this->oAjax=new AjaxLib();
	}

	public function Load()
	{
		$eUsuario = unserialize($_SESSION['eUsuario']);

		if($eUsuario==null){ die(); }

		$lVars['TitlePage']="Quest - Busqueda de Persona";

		$sPage="index.php?Page=BsqPersona&Action=";
		$this->oAjax->AgrFuncion($sPage."CnsPersona",'CnsPersona',array('proyecto'),'divResultados','innerHTML','POST',1,1);
		$this->oAjax->AgrJsPage("valBsqPersona");
		$this->oAjax->AgrJsPage("chgDatos");
		$this->oAjax->AgrJsPage("chgDocumento");
		$this->oAjax->AgrJsPage("valPersona");

		$lVars['Ajax']=$this->oAjax->ImprimirJs();

		$lVars['edtDocumento']= $this->oHtml->textbox('edtDocumento','edtDos','',10,array("onkeyup","chgDocumento(this.form)"));
		$lVars['edtNombres']= $this->oHtml->textbox('edtNombres','edtTres','',10,array("onkeyup","chgDatos(this.form)"));
		$lVars['edtPaterno']= $this->oHtml->textbox('edtPaterno','edtTres','',10,array("onkeyup","chgDatos(this.form)"));
		$lVars['edtMaterno']= $this->oHtml->textbox('edtMaterno','edtTres','',10,array("onkeyup","chgDatos(this.form)"));
		$lVars['btnBuscar']= $this->oHtml->submit('btnConsultar','btnPrincipal','Buscar','');
		$lVars['Menu']=$eUsuario->get('objRol')->get('lMenu');
		$this->lView->show($this->lPage,$lVars);
	}

	public function CnsPersona()
	{
		$sDocumento = $_POST["edtDocumento"];
		$sNombres = $_POST["edtNombres"];
		$sPaterno = $_POST["edtPaterno"];
		$sMaterno = $_POST["edtMaterno"];

		$oPersona=new PersonaMod();
		$dsPersonas=$oPersona->GetBsqBasica($sDocumento,$sPaterno,$sMaterno,$sNombres);


		$lVars['nroRows']=mysql_num_rows($dsPersonas);
		$lVars['lblMensaje']=$this->oHtml->label("lblError","msjError","No existen Datos para la Busqueda Efectuada");
		$lVars['dsPersonas']=$dsPersonas;

		$image=$this->oHtml->image('iDetalle.gif','18','18');
		$dgView=new DataGrid($dsPersonas,'#FFFF75');
		$dgView->lCabecera=$lCabecera=array(array('10%','VER'),array('12%','DI'),array('63%','NOMBRES'),array('5%','BN'),array('5%','ES'),array('5%','AF'));
		$dgView->lCampos=array(array('i',$image),array('d','DOCUMENTO'),array('d','NOMBRE'),array('i','BN'),array('i','ES'),array('i','AFP'));
		$dgView->lTr=array('hvalPersona',array('DOCUMENTO'));

		echo $dgView->Imprimir();
	}
}?>