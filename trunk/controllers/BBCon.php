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
            $this->oAjax->AgrFuncion($sPage."lsCelulares",'lsCelulares','','divResultados','innerHTML','GET',1,1);
            $this->oAjax->AgrFuncion($sPage."CelDetalles",'CelDetalles',array('CelID'),'divResultados','innerHTML','GET',1,1);
            $this->oAjax->AgrFuncion($sPage."Buscar",'Buscar',array('buscarubicaciones'),'divSalida','innerHTML','POST',1,1);

            $this->oAjax->AgrJsPage("iconos",null);
            $this->oAjax->AgrJsPage("loadgmaps",null);
            $this->oAjax->AgrJsPage("createmarkergmaps",null);

            $this->oAjax->AgrJsPage("calendario",array('cal1x','fdiv1'));
            $this->oAjax->AgrJsPage("calendario",array('cal2x','fdiv2'));


            $lVars['btnListar']= $this->oHtml->imgbutton('lsCelulares();','pDetalle.png','Listar Celulares');

            $lVars['Menu']=$eUsuario->get('objRol')->get('lMenu');
            $lVars['Ajax']=$this->oAjax->ImprimirJs();

            $this->lsCelulares(true,$lVars);
            $this->lView->show($this->lPage,$lVars);
        }

        public function lsCelulares($ret=false,&$lVar=null)
	{
            $oCelularBBMod = new CelularBBMod();
//            $eUsuario = new UsuarioDTO();
            $eUsuario = unserialize($_SESSION['eUsuario']);

            $dsCelulares = $oCelularBBMod->GetCelulares($eUsuario->UsuarioID);
            $lnkVerMas = $this->oHtml->lnkbutton("CelDetalles(%s);loadMap();",'Ver más');

            $dgView=new DataGrid($dsCelulares,'','DataGridA');
            $dgView->lCabecera=array(array('12%','CELULAR'),array('52%','APELLIDOS y NOMBRES'),array('12%',''));
            $dgView->lCampos=array(array('d','Numero'),array('d','Apellidos'),array('l',$lnkVerMas,array('CelularBBID')));
            $lVars['dgCelular']=$dgView->Imprimir();

            if(!$ret)
                echo $lVars['dgCelular'];
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

            $_SESSION["sCelID"] = $_GET["CelID"];

            $lVars["btnVerHoy"] = $this->oHtml->button("btnVerHoy","btnPrincipal","Hoy",array('onclick','loadMap(\'2008-12-30\',\'2006-11-15\')'));
            $lVars["btnBuscar"] = $this->oHtml->button("btnBuscar","btnPrincipal","Buscar",array("onClick","Buscar(this.form);"));

            $lVars["btnRegresar"] = $this->oHtml->button("btnRegresar","btnPrincipal","Regresar","");
            $lVars["btnImprimir"] = $this->oHtml->button("btnImprimir","btnPrincipal","Imprimir","");

            $lVars['edtFecInicio']= $this->oHtml->textfecha("fdiv1",'edtFec1','edt','',10,array("onclick","cal1x.select(this,'edtFec1','yyyy-MM-dd'); return false;"));
            $lVars['edtFecFin']= $this->oHtml->textfecha('fdiv2','edtFec2','edt','',10,array("onclick","cal2x.select(this,'edtFec2','yyyy-MM-dd'); return false;"));

            $lVars['edtHoraInicio']=$this->oHtml->textbox('edtHoraInicio','edtDos','10:00',5,'');
            $lVars['edtHoraFin']=$this->oHtml->textbox('edtHoraFin','edtDos','24:00',5,'');


            $this->lView->replacePage("BBMas",$lVars);

        }

        public function Buscar()
        {
            $HoraInicio = $_POST['edtHoraInicio'];
            $HoraFin = $_POST['edtHoraFin'];
            $FechaInicio = $_POST['edtFec1'];
            $FechaFin = $_POST['edtFec2'];

            $FechaMax = $FechaFin." ".$HoraFin.":00";
            $FechaMin = $FechaInicio." ".$HoraInicio.":00";

            $_GET["FechaMax"] = $FechaMax;
            $_GET["FechaMin"] = $FechaMin;

            echo "<script language=javascript>alert('Please enter a valid username.')</script>";
            
        }



}
?>