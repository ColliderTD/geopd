<?php
require_once("config.php");
require_once(ModFol."UsuarioMod.php");
require_once(ModFol."RolMod.php");
require_once(ModFol."UbicacionMod.php");
require_once(ModFol."CelularBBMod.php");

require_once(Res."menu.php");

class BBAdminCon extends ControllerLib
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
            if($eUsuario==null) { die(); }

            $sPage="index.php?Page=BB&Action=";
            $this->oAjax->AgrFuncion($sPage."lsCelulares",'lsCelulares','','divResultados','innerHTML','GET',1,1);
            $this->oAjax->AgrFuncion($sPage."CelDetalles",'CelDetalles',array('CelID'),'divResultados','innerHTML','GET',1,1);
            $this->oAjax->AgrFuncion($sPage."Buscar",'Buscar',array('buscarubicaciones'),'divSalida','innerHTML','POST',1,1);

            $this->oAjax->AgrJsPage("iconos",null);
            $this->oAjax->AgrJsPage("loadgmaps",null);
            $this->oAjax->AgrJsPage("createmarkergmaps",null);
            $this->oAjax->AgrJsPage("busqueda",null);

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

            $hoy = date("Y-m-d", time());
            $funcion = "loadMap('".$hoy." 23:59:59"."','".$hoy." 00:00:00"."')";

 

            $dsCelulares = $oCelularBBMod->GetCelularesAll();
            $lnkVerMas = $this->oHtml->lnkbutton("CelDetalles(%s);",'Ver mas');

            $dgView=new DataGrid($dsCelulares,'','DataGridA');
            $dgView->lCabecera=array(array('12%','CELULAR'),array('52%','APELLIDOS y NOMBRES'),array('12%',''));
            $dgView->lCampos=array(array('d','Numero'),array('d','Apellidos'),array('l',$lnkVerMas,array('CelularBBID')));
            $lVars['dgCelular']=$dgView->Imprimir();

            if(!$ret)
                echo $lVars['dgCelular'];
            else
                $lVar=$lVar+$lVars;
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

            $lVars['edtFecInicio']= $this->oHtml->textfecha("fdiv1",'edtFec1','edt','',10,array("onclick","cal1x.select(this,'edtFec1','yyyy-MM-dd'); return false;"));
            $lVars['edtFecFin']= $this->oHtml->textfecha('fdiv2','edtFec2','edt','',10,array("onclick","cal2x.select(this,'edtFec2','yyyy-MM-dd'); return false;"));

            $lVars['edtHoraInicio']=$this->oHtml->textbox('edtHoraInicio','edtDos','10:00',5,'');
            $lVars['edtHoraFin']=$this->oHtml->textbox('edtHoraFin','edtDos','24:00',5,'');


            $this->lView->replacePage("BBMas",$lVars);

        }



}
?>