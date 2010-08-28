<?php
require_once("config.php");
require_once(ModFol."CelularBBMod.php");

class CelularBBDTO extends ModelLib
{
    var $CelularBBID;
    var $Nombres;
    var $Apellidos;
    var $IMEI;
    var $Numero;

    function __construct() {}

    public function Persistencia()
    {

    }
}?>
