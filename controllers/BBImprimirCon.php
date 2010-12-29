<?php
require_once("config.php");
require_once(ModFol."UsuarioMod.php");
require_once(ModFol."RolMod.php");
require_once(ModFol."UbicacionMod.php");
require_once(ModFol."CelularBBMod.php");

require_once(Res."menu.php");

class BBImprimirCon extends ControllerLib
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

            $sPage="index.php?Page=BBImprimirr&Action=";

            $lVars['usuario'] = $eUsuario->Apellidos.', '.$eUsuario->Nombres;

            $oCelularBBMod = new CelularBBMod();
            $oUbicacionMod = new UbicacionMod();

            $CelID = $_SESSION["sCelID"];
            $FechaMax = $_GET["max"];
            $FechaMin = $_GET["min"];

            $oCelular = $oCelularBBMod->GetCelulaByrID($CelID);

            $lVars['persona'] = $oCelular->Apellidos.', '.$oCelular->Nombres;
            $lVars['celular'] = $oCelular->Numero;
            $lVars['imei'] = $oCelular->IMEI;

            $lVars["btnImprimir"] = $this->oHtml->button("btnImprimir","btnPrincipal","Imprimir",array('onclick',"window.print();"));
            
            $dsUbicaciones = $oUbicacionMod->ListarUbicaciones($CelID , $FechaMax, $FechaMin);

            $dgView=new DataGrid($dsUbicaciones,'','DataGridA');
            $dgView->lCabecera=array(array('12%','Fecha'),array('40%','Direccion'),array('12%','Distrito'),array('12%','Ciudad'),array('12%','Departamento'),array('12%','Pais'));
            $dgView->lCampos=array(array('d','Fecha'),array('d','Calle'),array('d','Distrito'),array('d','Ciudad'),array('d','Departamento'),array('d','Pais'));
            $lVars['dgUbicaciones']=$dgView->Imprimir();

            $lVars['Ajax']=$this->oAjax->ImprimirJs();
            $this->lView->show($this->lPage,$lVars);
        }

       

        
}
?>