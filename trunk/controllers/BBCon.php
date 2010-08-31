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

            $this->oAjax->AgrJsPage("iconos",null);
            $this->oAjax->AgrJsPage("loadgmaps",null);
            $this->oAjax->AgrJsPage("createmarkergmaps",null);

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

            $lVars["btnListar"] = $this->oHtml->button("btnListar","btnPrincipal","Listar","");
            $lVars["btnVerHoy"] = $this->oHtml->button("btnVerHoy","btnPrincipal","Hoy",array('onclick','loadMap(2008-12-30,2006-11-15)'));
            $lVars["btnVerAyer"] = $this->oHtml->button("btnVerAyer","btnPrincipal","Ayer","Ayer();");
            $lVars["btnVerSemana"] = $this->oHtml->button("btnVerSemana","btnPrincipal","Semana","");
            $lVars["btnBuscar"] = $this->oHtml->button("btnBuscar","btnPrincipal","Buscar","");

            $lVars["btnRegresar"] = $this->oHtml->button("btnVerSemana","btnPrincipal","Regresar","");
            $lVars["btnImprimir"] = $this->oHtml->button("btnBuscar","btnPrincipal","Imprimir","");



            $this->lView->replacePage("BBMas",$lVars);

        }

        public function Ayer()
        {
            echo "Jojoo!";
            echo "<SCRIPT LANGUAGE=\"javascript\"><!--n";
            echo " alert (\"message\");n";
            echo "// --></SCRIPT>n";
        }
}?>