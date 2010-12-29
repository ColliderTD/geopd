<?php
require_once("config.php");
require_once(ModFol."CelularBBMod.php");
require_once(Dto."CelularBBDto.php");

class UbicacionDTO extends ModelLib
{
    var $UbicacionID;
    var $Longitud;
    var $Latitud;
    var $Fecha;
    var $IMEI;
    var $CelularID;

    var $Direccion;
    var $Pais;
    var $Departamento;
    var $Ciudad;
    var $Distrito;
    var $Calle;


    function __construct() {}

    public function Persistencia()
    {
        $oCelularBBMod = new CelularBBMod();
        $oCelularBBDto = $oCelularBBMod->GetCelularID($IMEI);
        $this->CelularID = $oCelularBBDto->CelularBBID;
    }

}?>