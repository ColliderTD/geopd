<?php
require_once("config.php");
require_once(Dao."UbicacionDao.php");
require_once(Dto."UbicacionDto.php");
require_once(Dto."CelularBBDTO.php");

class UbicacionMod extends ModelLib
{

    public function RegistrarNuevaUbicacion($IMEI,$Longitud,$Latitud)
    {
        $oCelularBBMod = new CelularBBMod();
        $oCelularBBDTO = new CelularBBDTO();
        $oCelularBBDTO = $oCelularBBMod->GetCelularID($IMEI);

	$qInsertar = sprintf(InsUbicacion,$Longitud,$Latitud, $oCelularBBDTO->CelularBBID);
        $this->db->ExecuteQuery($qInsertar);

        return true;

    }

    public function XMLUbicacion($CeluarID,$FechaMax,$FechaMin)
    {
        $dom = new DOMDocument("1.0");
        $node = $dom->createElement("ubicaciones");
        $parnode = $dom->appendChild($node);

        $qListar = sprintf(ListUbicacion,$CeluarID,$FechaMin,$FechaMax);
        $lResult=$this->db->ExecuteQuery($qListar);

        $cont = 1;
        while ($row = @mysql_fetch_assoc($lResult))
        {
            $node = $dom->createElement("ubicacion");
            $newnode = $parnode->appendChild($node);

            $newnode->setAttribute("CelularBBID", $cont);
            $newnode->setAttribute("Fecha", $row['Fecha']);
            $newnode->setAttribute("Latitud", $row['Latitud']);
            $newnode->setAttribute("Longitud", $row['Longitud']);
            $newnode->setAttribute("type", $row['type']);

            $cont+=1;
        }

        return $dom->saveXML();

    }
}?>
