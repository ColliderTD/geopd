<?php

/**
 * @author Carlos Candela
 * @copyright 2009
 */

require_once("config.php");
require_once(ModFol."UsuarioMod.php");
require_once(ModFol."RolMod.php");

require_once(Res."menu.php");
class UsuarioCon extends ControllerLib
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

	public function Validar()
	{
		$sUsuario = $_POST['edtUsuario'];
		$sContrasenia = $_POST['edtContrasena'];

		//TicketCon::InsUsuario($sUsuario);
		$oUsuario = new UsuarioMod();
		$eUsuario = $oUsuario->GetUsuariobyLogin($sUsuario,$sContrasenia);

		if($eUsuario!=null)
		{
			$oUsuario->InsAcceso($sUsuario,1);
			$eUsuario->Persistencia();
			$_SESSION['eUsuario']=serialize($eUsuario);
			$_SESSION['popUpIni']=true;
			header("Location:index.php?Page=Usuario");
		}
		else
		{
			$oUsuario->InsAcceso($sUsuario,0);
			$_SESSION['Mensaje']="El Usuario y/o clave es incorrecto";
			header("Location:index.php");
		}
	}

	public function Load()
	{
		$eUsuario = unserialize($_SESSION['eUsuario']);
		if($eUsuario==null) { die(); }

		$sPage="index.php?Page=Usuario&Action=";
		$this->oAjax->AgrFuncion($sPage."lsUsuarios",'lsUsuarios','','divResultados','innerHTML','GET',1,1);
		$this->oAjax->AgrFuncion($sPage."vinUsuario",'vinUsuario','','divResultados','innerHTML','GET',1,1);
		$this->oAjax->AgrFuncion($sPage."insUsuario",'insUsuario',array('proyecto'),'divMensaje','innerHTML','POST',1,2);
		$this->oAjax->AgrFuncion($sPage."verContrato",'verContrato',array('UsuarioID'),'popUpDiv','innerHTML','GET',3,1);
		$this->oAjax->AgrFuncion($sPage."insContrato",'insContrato',array('contrato'),'divContrato','innerHTML','POST',1,1);

		$this->oAjax->AgrJsPage("ginsUsuario",array('proyecto'));
		$this->oAjax->AgrJsPage("calendario",array('cal1x','fdiv1'));
		$this->oAjax->AgrJsPage("calendario",array('cal2x','fdiv2'));

		$lVars['btnListar']= $this->oHtml->imgbutton('lsUsuarios();','pDetalle.png','Listar Usuarios');
		$lVars['btnUsuario']= $this->oHtml->imgbutton('vinUsuario();','pIUsuario.png','Insertar Usuario');

		$lVars['Menu']=$eUsuario->get('objRol')->get('lMenu');
		$lVars['Ajax']=$this->oAjax->ImprimirJs();

		$this->lsUsuarios(true,$lVars);
		$this->lView->show($this->lPage,$lVars);
	}

	public function lsUsuarios($ret=false,&$lVar=null)
	{
		$oUsuario=new UsuarioMod();
		$dsPersonas=$oUsuario->GetUsuarios('');

		$popUd= $this->oHtml->lPopUp('popUpDiv','verContrato(%s)','Contrato');

		$dgView=new DataGrid($dsPersonas,'','DataGridA');
		$dgView->lCabecera=array(array('12%','USUARIO'),array('52%','APELLIDOS y NOMBRES'),array('12%','ROL'),array('12%',''),array('12%',''));
		$dgView->lCampos=array(array('d','Usuario'),array('d','Nombres'),array('d','RolNom'),array('l',$popUd,array('UsuarioID')));
		$lVars['dgUsuario']=$dgView->Imprimir();

		if(!$ret)
		echo $lVars['dgUsuario'];
		else
		$lVar=$lVar+$lVars;
	}

	public function vinUsuario()
	{
		$oRol = new RolMod();
		$dtRol = $oRol->GetRoles();

		$lVars['edtUsuario']= $this->oHtml->textbox('edtUsuario','edtDos','',10,'');
		$lVars['edtNombres']= $this->oHtml->textbox('edtNombres','edtCuatro','',10,'');
		$lVars['edtApellidos']= $this->oHtml->textbox('edtApellidos','edtCuatro','',10,'');
		$lVars['cmbRol']= $this->oHtml->combo($dtRol,'cmbRol','RolID','RolNom','','','','');
		$lVars['edtContrasenaU']=	$this->oHtml->pass('edtContrasenaU','edtUno','',10);
		$lVars['edtContrasenaD']=	$this->oHtml->pass('edtContrasenaD','edtUno','',10);
		$lVars['btnGuardarU']= $this->oHtml->button('btnConsultar','btnPrincipal','Guardar',array("onClick","insUsuario(this.form);"));

		$this->lView->replacePage("insUsuario",$lVars);
	}

	public function insUsuario()
	{
		$sUsuario =  $_POST["edtUsuario"];
		$sNombres = $_POST["edtNombres"];
		$sApellidos = $_POST["edtApellidos"];
		$iRol = $_POST["cmbRol"];
		$sContrasena = md5($_POST["edtContrasenaU"]);

		$oUsuario=new UsuarioMod();

		if($oUsuario->ExtUsuario($sUsuario))
		{	echo "false;Usuario Repetido";die();}

		$oUsuario->InsUsuario($sUsuario,$sNombres,$sApellidos,$iRol,$sContrasena);
		echo "true;Usuario Registrado";
	}

	private function dgContrato($data)
	{
		$dgView=new DataGrid($data,'','DataGridA');
		$dgView->lCabecera=array(array('25%','FEC. INICIO'),array('25%','FEC. FIN'),array('25%','VISTAS'),array('25%','VISTAS DISP'));
		$dgView->lCampos=array(array('d','Fecha_Inicio'),array('d','Fecha_Fin'),array('d','Vistas_Contratadas'),array('d','Vistas_Utiles'));
		return $dgView->Imprimir();
	}


	public function verContrato()
	{
		$_SESSION['UsuarioID']=$iUsuarioID=$_GET['UsuarioID'];
		$oContrato = new ContratoMod();
		$lVars['Ajax']=$this->oAjax->ImprimirJs();
		$lVars['dgContrato']=$this->dgContrato($oContrato->GetContratos($iUsuarioID));
		$lVars['edtFecInicio']= $this->oHtml->textfecha("fdiv1",'edtFec1','edt','',10,array("onclick","cal1x.select(this,'edtFec1','yyyy-MM-dd'); return false;"));
		$lVars['edtFecFin']= $this->oHtml->textfecha('fdiv2','edtFec2','edt','',10,array("onclick","cal2x.select(this,'edtFec2','yyyy-MM-dd'); return false;"));
		$lVars['edtVisitas']= $this->oHtml->textbox('edtVistas','edtNumber','',3,'');
		$lVars['btnCancelar']= $this->oHtml->button('btnCancelar','btnPrincipal','Cancelar',array("onClick","popup('popUpDiv');"));
		$lVars['btnGuardarC']= $this->oHtml->button('btnConsultarC','btnPrincipal','Guardar',array("onClick","insContrato('contrato');"));
		$this->lView->replacePage("pnContrato",$lVars);
	}

	public function insContrato()
	{
		$iUsuarioID=$_SESSION['UsuarioID'];
		$sFecIni=  $_POST["edtFec1"];
		$sFecFin= $_POST["edtFec2"];
		$iVisitas = $_POST["edtVistas"];

		$oContrato = new ContratoMod();
		$oContrato->InsContrato($iUsuarioID,$sFecIni,$sFecFin,$iVisitas);
		echo $this->dgContrato($oContrato->GetContratos($iUsuarioID));
	}
}

?>