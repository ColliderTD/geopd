<?php
require_once("config.php");
require_once(ModFol."UsuarioMod.php");
require_once(ModFol."RolMod.php");
require_once(ModFol."UbicacionMod.php");
require_once(ModFol."CelularBBMod.php");

require_once(Res."menu.php");

class BBCon extends ControllerLib
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

	public function RegUbicacion()
	{
            $IMEI = $_GET["imei"];
            $Longitud = $_GET["longitud"];
            $Latitud = $_GET["latitud"];

            $oUbicacionMod = new UbicacionMod();
            $oUbicacionMod->RegistrarNuevaUbicacion($IMEI, $Longitud, $Latitud);

	}

        public function Load()
        {
            $eUsuario = unserialize($_SESSION['eUsuario']);
            if($eUsuario==null) { die(); }

            $sPage="index.php?Page=BB&Action=";

            $this->oAjax->AgrFuncion($sPage."lsUsuarios",'lsUsuarios','','divResultados','innerHTML','GET',1,1);
            $this->oAjax->AgrFuncion($sPage."lsCelulares",'lsCelulares',array('SelUserID'),'divResultados','innerHTML','GET',1,1);
            $this->oAjax->AgrFuncion($sPage."CelDetalles",'CelDetalles',array('CelID'),'divResultados','innerHTML','GET',1,1);
            $this->oAjax->AgrFuncion($sPage."Buscar",'Buscar',array('buscarubicaciones'),'divSalida','innerHTML','POST',1,1);
            $this->oAjax->AgrFuncion($sPage."Ampliar",'Ampliar',array('buscarubicaciones'),'divResultados','innerHTML','POST',1,1);

            $this->oAjax->AgrJsPage("iconos",null);
            $this->oAjax->AgrJsPage("loadgmaps",null);
            $this->oAjax->AgrJsPage("createmarkergmaps",null);
            $this->oAjax->AgrJsPage("busqueda",null);
            $this->oAjax->AgrJsPage("popupfullscreen",null);
            $this->oAjax->AgrJsPage("ampliar",null);
            
            $this->oAjax->AgrJsPage("calendario",array('cal1x','fdiv1'));
            $this->oAjax->AgrJsPage("calendario",array('cal2x','fdiv2'));

            if($eUsuario->RolID == 1)//Si es admin
            {
                $lVars['btnUsuario']= $this->oHtml->imgbutton('vinUsuario();','pIUsuario.png','Insertar Usuario');
                $lVars['btnLista']= $this->oHtml->imgbutton('lsUsuarios();','pIUsuario.png','Listar Usuarios');

                $this->oAjax->AgrFuncion($sPage."vinUsuario",'vinUsuario','','divResultados','innerHTML','GET',1,1);
                $this->oAjax->AgrFuncion($sPage."insUsuario",'insUsuario',array('proyecto'),'divMensaje','innerHTML','POST',1,2);
                $this->oAjax->AgrFuncion($sPage."vinCelular",'vinCelular','','divResultados','innerHTML','GET',1,1);
                $this->oAjax->AgrFuncion($sPage."insCelular",'insCelular','','divMensaje','innerHTML','POST',1,2);

                $this->oAjax->AgrFuncion($sPage."verCelular",'verCelular',array('UsuarioID'),'divResultados','innerHTML','GET',3,1);
                //  $this->lsUsuarios(true, $lVars);
            }
            else//Si es usuario normal
            {
                $lVars['btnListar']= $this->oHtml->imgbutton('lsCelulares();','pDetalle.png','Listar Celulares');
                $this->lsCelulares(true,$lVars);
            }

            $lVars['Menu']=$eUsuario->get('objRol')->get('lMenu');
            $lVars['Ajax']=$this->oAjax->ImprimirJs();

            
            $this->lView->show($this->lPage,$lVars);
        }

        public function verCelular()
        {
		$UserID = $iUsuarioID=$_GET['UsuarioID'];

                $_SESSION['UsuarioID'] = $UserID;

                $oUsuarioMod =  new UsuarioMod();

                $oUsuarioDTO = $oUsuarioMod->GetUsuarioByID($UserID);

                $duenio = "Usuario: ".$oUsuarioDTO->Apellidos.", ".$oUsuarioDTO->Nombres;

                $lVars['lblDuenio']=  $this->oHtml->label('lblDuenio','lblPrincipal',$duenio);
		$lVars['Ajax']=$this->oAjax->ImprimirJs();
                $lVars['edtNombres']= $this->oHtml->textbox('edtNombres','.edtTres','',3,'');
                $lVars['edtApellidos']= $this->oHtml->textbox('edtApellidos','.edtTres','',3,'');
                $lVars['edtNumCel']= $this->oHtml->textbox('edtNumCel','.edtTres','',3,'');
                $lVars['edtIMEI']= $this->oHtml->textbox('edtIMEI','.edtTres','',3,'');

		$lVars['btnCancelar']= $this->oHtml->button('btnCancelar','btnPrincipal','Cancelar',array("onClick","popup('popUpDiv');"));
		$lVars['btnGuardar']= $this->oHtml->button('btnGuardar','btnPrincipal','Guardar',array("onClick","insCelular(this.form);"));
		$this->lView->replacePage("addCel",$lVars);
        }
        
        public function insCelular()
        {
            echo "sddasdas";
		$iUsuarioID = $_SESSION['UsuarioID'];
                $sNombres = $_POST['edtNombres'];
                $sApellidos = $_POST['edtApellidos'];
                $sIMEI = $_POST['edtIMEI'];
                $sNumero = $_POST['edtNumCel'];

		$oCelular = new CelularBBMod();
		$oCelular->InsCelularBB($iIDUsuario, $sNombres, $sApellidos, $sIMEI, $sNumero);
                echo "true;Celular Registrado";
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


	public function lsUsuarios($ret=false,&$lVar=null)
	{
		$oUsuario=new UsuarioMod();
		$dsPersonas=$oUsuario->GetUsuarios('');

		$lnkVerCelulares = $this->oHtml->lnkbutton("lsCelulares(%s);",'Ver celulares');

		$dgView=new DataGrid($dsPersonas,'','DataGridA');
		$dgView->lCabecera=array(array('12%','USUARIO'),array('52%','APELLIDOS y NOMBRES'),array('12%','ROL'),array('12%',''),array('12%',''));
		$dgView->lCampos=array(array('d','Usuario'),array('d','Nombres'),array('d','RolNom'),array('l',$lnkVerCelulares,array('UsuarioID')));
		$lVars['dgUsuario']=$dgView->Imprimir();

		if(!$ret)
		echo $lVars['dgUsuario'];
		else
		$lVar=$lVar+$lVars;
	}

        public function lsCelulares($ret=false,&$lVar=null)
	{
            $oCelularBBMod = new CelularBBMod();
//            $eUsuario = new UsuarioDTO();
            $eUsuario = unserialize($_SESSION['eUsuario']);

            $sSelUserID = $_GET["SelUserID"];
   
            $hoy = date("Y-m-d", time());
            $funcion = "loadMap('".$hoy." 23:59:59"."','".$hoy." 00:00:00"."')";


            if($eUsuario->RolID == 2)
                $dsCelulares = $oCelularBBMod->GetCelulares($eUsuario->UsuarioID);
            else
            {
                $dsCelulares = $oCelularBBMod->GetCelulares($sSelUserID);
                $add = "verCelular(".$sSelUserID.");";
                $lVars["btnCelular"] = $this->oHtml->button("btnAgregarCelular","btnPrincipal","Agregar Celular",array('onclick',$add));
            //$dsCelulares = $oCelularBBMod->GetCelularesAll();
            }

            $lnkVerMas = $this->oHtml->lnkbutton("CelDetalles(%s);",'Ver mas');

            $dgView=new DataGrid($dsCelulares,'','DataGridA');
            $dgView->lCabecera=array(array('12%','CELULAR'),array('52%','APELLIDOS y NOMBRES'),array('12%',''));
            $dgView->lCampos=array(array('d','Numero'),array('d','Apellidos'),array('l',$lnkVerMas,array('CelularBBID')));
            $lVars['dgCelular']=$dgView->Imprimir();

            if(!$ret)
            {
                echo $lVars['dgCelular'];
                echo $lVars["btnCelular"];;
            }
            else
                $lVar=$lVar+$lVars;
	}

        public function Genxml()
        {
            $oUbicacionMod = new UbicacionMod();
            $CelularBBID = $_SESSION["sCelID"];
            $FechaMax = '9999-99-99';
            $FechaMin = '0000-00-00';
            
            //if(isset($_GET["FechaMax"]))
                    $FechaMax = $_GET["FechaMax"];
            //if(isset($_GET["FechaMin"]))
                    $FechaMin = $_GET["FechaMin"];
            
            header('Content-type: text/xml; charset=iso-8859-1');
            echo $oUbicacionMod->XMLUbicacion($CelularBBID,$FechaMax,$FechaMin);
        }

        public function CelDetalles()
        {
            $lVars=null;

            $hoy = date("Y-m-d", time());
            $funcion = "loadMap('".$hoy." 23:59:59"."','".$hoy." 00:00:00"."')";

            $_SESSION["sCelID"] = $_GET["CelID"];

            $lVars["btnVerHoy"] = $this->oHtml->button("btnVerHoy","btnPrincipal","Hoy",array('onclick',$funcion));
            $lVars["btnBuscar"] = $this->oHtml->button("btnBuscar","btnPrincipal","Buscar",array("onClick","Consulta()"));

            //$lVars["btnRegresar"] = $this->oHtml->button("btnRegresar","btnPrincipal","Regresar","");
            $lVars['btnRegresar']= $this->oHtml->imgbutton("window.open('index.php?Page=BB','_parent')",'pRegresar.png','Regresar');
            $lVars["btnImprimir"] = $this->oHtml->button("btnImprimir","btnPrincipal","Imprimir",array('onclick',"window.print();return false"));
            
            $lVars["btnAmpliar"] = $this->oHtml->button("btnAmpliar","btnPrincipal","Ampliar",array('onclick','Ampliar();'));

            $lVars['edtFecInicio']= $this->oHtml->textfecha("fdiv1",'edtFec1','edt','',10,array("onclick","cal1x.select(this,'edtFec1','yyyy-MM-dd'); return false;"));
            $lVars['edtFecFin']= $this->oHtml->textfecha('fdiv2','edtFec2','edt','',10,array("onclick","cal2x.select(this,'edtFec2','yyyy-MM-dd'); return false;"));

            $lVars['edtHoraInicio']=$this->oHtml->textbox('edtHoraInicio','edtDos','10:00',5,'');
            $lVars['edtHoraFin']=$this->oHtml->textbox('edtHoraFin','edtDos','24:00',5,'');


            $this->lView->replacePage("BBMas",$lVars);

        }
}
?>