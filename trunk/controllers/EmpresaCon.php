<?php
require_once("config.php");
require_once(ModFol."EmpresaMod.php");
require_once(ModFol."UsuarioMod.php");

class EmpresaCon extends ControllerLib
{
	var $lPage;
	var $oHtml;
	var $oAjax;
	var $eUsuario;

	function __construct($page)
	{
		parent::__construct();
		$this->lPage = $page;
		$this->oHtml=HtmlLib::singleton();
		$this->oAjax=new AjaxLib();

		$this->eUsuario = unserialize($_SESSION['eUsuario']);
		if($this->eUsuario==null){ die(); }
	}

	public function Load()
	{

		$lVars['TitlePage']="Quest - Busqueda de Empresas";

		$sPage="index.php?Page=Empresa&Action=";
		$this->oAjax->AgrFuncion($sPage."CnsEmpresa",'CnsEmpresa',array('proyecto'),'divDataGrid','innerHTML','POST',1,1);

		$sPage="index.php?Page=Utilitario&Action=";
		$this->oAjax->AgrFuncion($sPage."Paginacion",'aPaginacion',array('Pagina','Nombre'),'divRCC','innerHTML','GET',3,1);
		$this->oAjax->AgrFuncion($sPage."Ordenar",'aOrdenar',array('Nombre','Campo','Orden'),'divRCC','innerHTML','GET',3,1);

		$this->oAjax->AgrJsPage("verEmpresa");

		$lVars['Ajax']=$this->oAjax->ImprimirJs();

		$lVars['edtRUC']= $this->oHtml->textbox('edtRuc','edtDos','',10,array("onkeyup","chgRuc(this.form)"));
		$lVars['edtRazon']= $this->oHtml->textbox('edtRazon','edtCinco','',100,array("onkeyup","chgDatos(this.form)"));
		$lVars['edtComercial']= $this->oHtml->textbox('edtComercial','edtCinco','',100,array("onkeyup","chgDatos(this.form)"));
		$lVars['btnBuscar']= $this->oHtml->submit('btnConsultar','btnPrincipal','Buscar','');
		$lVars['Menu']=$this->eUsuario->get('objRol')->get('lMenu');
		$this->lView->show("BsqEmpresa",$lVars);
	}

	public function CnsEmpresa()
	{
		$sRuc = $_POST["edtRuc"];
		$sRazon = $_POST["edtRazon"];
		$sComercial= $_POST["edtComercial"];

		$oEmpresa=new EmpresaMod();
		$dsEmpresas=$oEmpresa->GetBsqBasica($sRuc,$sRazon,$sComercial);

		$image=$this->oHtml->image('iDetalle.gif','18','18');
		$dgView=new DataGrid($dsEmpresas,'#FFFF75');
		$dgView->lOrdenar=array(2=>"RUC",3=>"RAZONSOCIAL");
		$dgView->lCabecera=$lCabecera=array(array('4%','VER'),array('10%','RUC'),array('28%','RAZON SOCIAL'),array('28%','NOMBRE COMERCIAL'),array('10%','DEPARTAMENTO'),array('10%','PROVINCIA'),array('10%','DISTRITO'));
		$dgView->lCampos=array(array('i',$image),array('d','RUC'),array('d','RAZONSOCIAL'),array('d','NOMBRECOMERCIAL'),array('d','DEPARTAMENTO'),array('d','PROVINCIA'),array('d','DISTRITO'));
		$dgView->lTr=array('hverEmpresa',array('RUC','CODIGO'));
		$dgView->bPage=true;
		$dgView->pName="BsqEmpresa";
		echo $dgView->Imprimir();
	}

	public function verEmpresa()
	{
		$_SESSION['sRuc']=$_POST['sRuc'];
		$_SESSION['sCodigo']=$_POST['sCodigo'];

		$sPage="index.php?Page=Empresa&Action=";
		$this->oAjax->AgrFuncion($sPage."Datos",'Datos',array('proyecto'),'divResultados','innerHTML','POST',1,1);
		$this->oAjax->AgrFuncion($sPage."Laboral",'Laboral',array('proyecto'),'divResultados','innerHTML','POST',1,1);
		$this->oAjax->AgrFuncion($sPage."LblReporte",'LblReporte',array('proyecto'),'divResultados','innerHTML','POST',1,1);
		$this->oAjax->AgrFuncion($sPage."Agencias",'Agencias',array('proyecto'),'divResultados','innerHTML','POST',1,1);
		$this->oAjax->AgrFuncion($sPage."Grafico",'Grafico',array('proyecto'),'divResultados','innerHTML','POST',1,1);

		$sPage="index.php?Page=Utilitario&Action=";
		$this->oAjax->AgrFuncion($sPage."Paginacion",'aPaginacion',array('Pagina','Nombre'),'divResultados','innerHTML','GET',3,1);
		$this->oAjax->AgrFuncion($sPage."Ordenar",'aOrdenar',array('Nombre','Campo','Orden'),'divResultados','innerHTML','GET',3,1);
		//$this->oAjax->AgrFuncion($sPage."ReporteRCC",'ReporteRCC',array('Tabla'),'divRCC','innerHTML','GET',1,1);

		$lVars['TitlePage']="Quest - Detalle de Empresa";
		$lVars['btnDatos']= $this->oHtml->imgbutton('Datos(this.form);','pLaboral.png',' Datos Personales');
		$lVars['btnLaboral']= $this->oHtml->imgbutton('Laboral(this.form);','pDetalle.png','Personal Planilla');
		$lVars['btnLblReporte']= $this->oHtml->imgbutton('LblReporte(this.form);','pBancarizado.png','Personal Bancarizado');
		$lVars['btnHistorico']= $this->oHtml->imgbutton('Agencias(this.form);','pResumen.png','Agencias');
		$lVars['btnGrafica']= $this->oHtml->imgbutton('Grafico(this.form);','pLaboral.png','Graficas');
		$lVars['btnRegresar']= $this->oHtml->imgbutton("window.open('index.php?Page=Empresa','_parent')",'pRegresar.png','Regresar');

		$lVars['Ajax']=$this->oAjax->ImprimirJs();
		$lVars['Menu']=$this->eUsuario->get('objRol')->get('lMenu');

		$this->Datos(true,$lVars);
		$this->lView->show($this->lPage,$lVars);
	}

	public function Datos($ret=false,&$lVar=null)
	{
		$sRuc=$_SESSION['sRuc'];
		$sCodigo=$_SESSION['sCodigo'];

		$lVars['RUC']=$sRuc;

		$oEmpresa=new EmpresaMod();
		$dtEmpresa = $oEmpresa->GetEmpresa($sRuc);

		while($dtRow=mysql_fetch_assoc($dtEmpresa))
		{foreach ($dtRow as $lKey => $lValue)
		{$lVars[$lKey]=$lValue;}}

		if(!$ret)
		$this->lView->replacePage("datEmpresa",$lVars);
		else
		{
			$lVar=$lVar+$lVars;
			$sEmpresa = $lVar['RAZONSOCIAL'];

			/*$oContrato= $this->eUsuario->get('objContrato');
			$this->eUsuario->InsVista($sRuc,$sPersona,0);*/
		}
	}

	public function Laboral()
	{
		$sRuc=$_SESSION['sRuc'];

		$oEmpresa=new EmpresaMod();
		$dtLaboral = $oEmpresa->GetPlanilla($sRuc);

		$dgView=new DataGrid($dtLaboral,'','DataGridA');
		$dgView->lOrdenar=array(1=>"NOMCOMPETO",3=>"RAM1",5=>"RAM2",7=>"RAM3");
		$dgView->lCabecera=array(array('9%','DI'),array('35%','APELLIDOS Y NOMBRES'),array('9%','DEVENGUE'),array('9%','PUNTAJE'),array('9%','DEVENGUE'),array('9%','PUNTAJE'),array('9%','DEVENGUE'),array('9%','PUNTAJE'));
		$dgView->lCampos=array(array('d','DOCUMENTO'),array('d','NOMCOMPLETO'),array('d','DEVENGUE1'),array('d','RAM1'),array('d','DEVENGUE2'),array('d','RAM2'),array('d','DEVENGUE3'),array('d','RAM3'));
		$dgView->leTd=array(1=>"left");
		$dgView->bPage=true;
		$dgView->pName="pp".$sRuc;
		echo $dgView->Imprimir();
	}

	public function LblReporte()
	{
		$sRuc=$_SESSION['sRuc'];
		$oEmpresa=new EmpresaMod();
		$dtReportados = $oEmpresa->GetReportados($sRuc);

		$dgView=new DataGrid($dtReportados,'','DataGridA');
		$dgView->lOrdenar=array(1=>"NOMCOMPLETO",3=>"RAM",4=>"ENTIDAD",5=>"TC",7=>"SALDO");
		$dgView->lCabecera=array(array('8%','DI'),array('37%','APELLIDOS Y NOMBRES'),array('5%','DEVENGUE'),array('5%','INGRESO'),array('20%','ENTIDAD'),array('10%','TC'),array('5%','PRTO'),array('5%','SALDO'),array('5%','CND'));
		$dgView->lCampos=array(array('d','DOCUMENTO'),array('d','NOMCOMPLETO'),array('d','DEVENGUE1'),array('d','RAM'),array('d','ENTIDAD'),array('d','TC'),array('d','PRODUCTO'),array('m','SALDO'),array('d','CONDICION'));
		$dgView->leTd=array(1=>"left",4=>"left",7=>"right");
		$dgView->bPage=true;
		$dgView->pName="pr".$sRuc;
		echo $dgView->Imprimir();
	}

	public function Agencias()
	{
		$sRuc=$_SESSION['sRuc'];
		$oEmpresa=new EmpresaMod();
		$dtReportados = $oEmpresa->GetAgencias($sRuc);

		$dgView=new DataGrid($dtReportados,'','DataGridA');
		$dgView->lCabecera=array(array('5%','ID'),array('20%','DEPARTAMENTO'),array('25%','PROVINCIA'),array('25%','DISTRITO'),array('20%','TIPO'),array('5%','EMPLEADOS'));
		$dgView->lCampos=array(array('d','NROAGENCIA'),array('d','DEPARTAMENTO'),array('d','PROVINCIA'),array('d','DISTRITO'),array('d','TIPO'),array('d','EMPLEADOS'));
		$dgView->leTd=array(1=>"left",2=>"left",3=>"left",4=>"left");
		$dgView->bPage=true;
		$dgView->pName="ag".$sRuc;
		echo $dgView->Imprimir();

	}
}?>