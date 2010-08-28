<?php
require_once("config.php");
require_once(ModFol."PersonaMod.php");
require_once(ModFol."UsuarioMod.php");
require_once(ModFol."BDMod.php");

class DetPersonaCon extends ControllerLib
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
		if($this->eUsuario==null) { die(); }
	}

	public function Load()
	{
		if($_POST['TipoPersona']!=NULL)
		{
		 $_SESSION['sCodigo']=$_POST['Codigo'];
		 $_SESSION['sTipoPersona']=$_POST['TipoPersona'];
		}

		$sPage="index.php?Page=DetPersona&Action=";
		$this->oAjax->AgrFuncion($sPage."Datos",'Datos',array('proyecto'),'divResultados','innerHTML','POST',1,1);
		$this->oAjax->AgrFuncion($sPage."Financiera",'Financiera',array('proyecto'),'divResultados','innerHTML','POST',1,1);
		$this->oAjax->AgrFuncion($sPage."Historico",'Historico',array('proyecto'),'divResultados','innerHTML','POST',1,1);
		$this->oAjax->AgrFuncion($sPage."Resumen",'Resumen',array('proyecto'),'divResultados','innerHTML','POST',1,1);
		$this->oAjax->AgrFuncion($sPage."Laboral",'Laboral',array('proyecto'),'divResultados','innerHTML','POST',1,1);

		$this->oAjax->AgrFuncion($sPage."ReporteRCC",'ReporteRCC',array('Tabla'),'divRCC','innerHTML','GET',1,1);

		$sPage="index.php?Page=Utilitario&Action=";
		$this->oAjax->AgrFuncion($sPage."Paginacion",'aPaginacion',array('Pagina','Nombre'),'','innerHTML','GET',3,1);
		$this->oAjax->AgrFuncion($sPage."Ordenar",'aOrdenar',array('Nombre','Campo','Orden'),'divRCC','innerHTML','GET',3,1);

		$lVars['TitlePage']="Quest - Detalle de Persona";
		$lVars['btnDatos']= $this->oHtml->imgbutton('Datos(this.form);','pDetalle.png',' Datos Personales');
		$lVars['btnFinanciero']= $this->oHtml->imgbutton('Financiera(this.form);','pFinanciero.png','Detalle Financiero');
		$lVars['btnHistorico']= $this->oHtml->imgbutton('Historico(this.form);','pHistorico.png','Historico');
		$lVars['btnResumen']= $this->oHtml->imgbutton('Resumen(this.form);','pResumen.png','Resumen');
		$lVars['btnLaboral']= $this->oHtml->imgbutton('Laboral(this.form);','pLaboral.png','Record Laboral');
		$lVars['btnRegresar']= $this->oHtml->imgbutton("window.open('index.php?Page=BsqPersona','_parent')",'pRegresar.png','Regresar');

		$lVars['Ajax']=$this->oAjax->ImprimirJs();
		$lVars['Menu']=$this->eUsuario->get('objRol')->get('lMenu');

		$this->Datos(true,$lVars);
		$this->lView->show($this->lPage,$lVars);
	}

	public function Datos($ret=false,&$lVar=null)
	{
		$sDocumento=$_SESSION['sDocumento'];

		$lVars['Documento']=$sDocumento;

		$oPersona=new PersonaMod();
		$dtPersona = $oPersona->GetPersona($sDocumento);

		while($dtRow=mysql_fetch_assoc($dtPersona))
		{foreach ($dtRow as $lKey => $lValue)
		{$lVars[$lKey]=$lValue;}}

		$dtCargos=$oPersona->GetCargos($sDocumento);
		$dtAutos=$oPersona->GetAutos($sDocumento);
		$dtFamilia=$oPersona->GetFamilia($sDocumento);

		$dgView=new DataGrid($dtFamilia,'','DataGridA');
		$dgView->lCabecera=array(array('10%','DOCUMENTO'),array('70%','NOMBRES'),array('10%','SEXO'),array('10%','NACIMIENTO'));
		$dgView->lCampos=array(array('d','DOCUMENTOT'),array('d','NOMBRECOMP'),array('d','SEXOT'),array('d','NACIMIENTO'));

		$lVars['dtCargos']=$dtCargos;
		$lVars['dtAutos']=$dtAutos;
		$lVars['dgFamiliares']=$dgView->Imprimir();

		if(!$ret)
		$this->lView->replacePage("datPersona",$lVars);
		else
		{
			$lVar=$lVar+$lVars;
			$sPersona = $lVar['NOMBRE'];
			$Documento=$lVar['Documento'];

			$oContrato= $this->eUsuario->get('objContrato');
			$this->eUsuario->InsVista($Documento,$sPersona,0);
		}
	}

	public function Valida()
	{
		$sDocumento = $_SESSION['sDocumento']=$_POST['Documento'];
		$_SESSION['sCodigo']= $_SESSION['sTipoPersona']=null;

		$oPersona=new PersonaMod();
		$dtValPersona = $oPersona->GetValPersona($sDocumento);
		$lVars['dtValPersona'] =$dtValPersona;

		$this->oAjax->AgrJsPage("verPersona");
		$lVars['Menu']=$this->eUsuario->get('objRol')->get('lMenu');
		$lVars['Ajax']=$this->oAjax->ImprimirJs();

		if(mysql_num_rows($dtValPersona)>1)
		{
			$this->lView->show("ValPersona",$lVars);
		}
		else
		{   if($row=mysql_fetch_array($dtValPersona))
		{
			$_SESSION['sCodigo']=$row['CODIGO'];
			$_SESSION['sTipoPersona']=$row['CTIPOPERSONA'];
		}
		header("Location:index.php?Page=DetPersona");
		}
	}

	public function Financiera()
	{
		$oBD= new  BDMod();
		$dtRccMeses = $oBD->GetMesReporte();
		$lVars['cmbMeses']= $this->oHtml->combo($dtRccMeses,'cmbMes','TABLA','DETALLE','InputTextTres',array('onChange',"ReporteRCC(this.value)"),'',array('ALL','-- SELECCIONAR --'));
		$this->lView->replacePage("datFinPersona",$lVars);
	}

	public function ReporteRCC()
	{

		$sCodigo = $_SESSION['sCodigo'];
		$sTable = $_GET['Tabla'];

		if($sCodigo!='')
		{
		 $oPersona = new PersonaMod();
		 $dsReporte=$oPersona->GetRepPersona($sCodigo,$sTable);

		$dgView=new DataGrid($dsReporte,'','DataGridA');
		$dgView->lOrdenar=array(3=>"DESCRIPCION",4=>"CLASIFICACION",5=>"SALDO",6=>"MONEDA");
		$dgView->lCabecera=array(array('20%','ENTIDAD'),array('8%','TC'),array('4%','PR'),array('42%','DETALLE'),array('4%','CLASIF'),array('10%','SALDO'),array('4%','MON'),array('4%','CON'),array('4%','ES'));
		$dgView->lCampos=array(array('d','ENTIDAD'),array('d','TC'),array('d','PRODUCTO'),array('d','DESCRIPCION'),array('d','CLASIFICACION'),array('m','SALDO'),array('d','MONEDA'),array('d','CONDICION'),array('d','ESTADO'));
		$dgView->leTd=array(0=>"left",3=>"left",5=>"right");
		//$dgView->bPage=true;
		$dgView->pName="pr".$sCodigo;
		echo $dgView->Imprimir();
		// $this->lView->replacePage("repPersona",$lVars);
		}
	}

	public function Resumen()
	{
		$sCodigo = $_SESSION['sCodigo'];
		if($sCodigo!='')
		{
		 $oPersona = new PersonaMod();
		 $lVars['dsResumen']=$oPersona->GetResPersona($sCodigo);

		 $this->lView->replacePage("resPersona",$lVars);
		}
	}

	public function Historico()
	{
		$sCodigo = $_SESSION['sCodigo'];
		$sTipoPersona=$_SESSION['sTipoPersona'];
		$sDocumento = $_SESSION['sDocumento'];

		if($sCodigo!='')
		{
		 $oPersona = new PersonaMod();
		 $lVars['dsHistorico']=$oPersona->GetHisPersona($sDocumento,$sCodigo,$sTipoPersona);

		 $this->lView->replacePage("hisPersona",$lVars);
		}
	}

	public function Laboral()
	{
		$sDocumento = $_SESSION['sDocumento'];

		$oPersona = new PersonaMod();
		$lVars['dsLaboral']=$oPersona->GetLabPersona($sDocumento);

		$this->lView->replacePage("labPersona",$lVars);

	}
}?>