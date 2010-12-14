<?php
require_once("config.php");
require_once(ModFol."UsuarioMod.php");
require_once(ModFol."RolMod.php");
require_once(ModFol."UbicacionMod.php");
require_once(ModFol."CelularBBMod.php");

require_once(Res."menu.php");

class BBAmpliarCon extends ControllerLib
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

            $sPage="index.php?Page=BBAmpliar&Action=";

            $this->oAjax->AgrJsPage("iconos",null);
            $this->oAjax->AgrJsPage("loadgmaps",null);
            $this->oAjax->AgrJsPage("createmarkergmaps",null);
            $this->oAjax->AgrJsPage("busqueda",null);

            $load = "loadMap('".$_GET["max"]."','".$_GET["min"]."');";

            $lVars['load']=$load;
            $lVars['Ajax']=$this->oAjax->ImprimirJs();
      
            $this->lView->show($this->lPage,$lVars);
        }

        
}
?>