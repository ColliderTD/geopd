<?php
require_once("config.php");
require_once(Dao."UbicacionDao.php");
require_once(Dto."UbicacionDto.php");
require_once(Dto."CelularBBDTO.php");

class UbicacionMod extends ModelLib
{

    public function RegistrarNuevaUbicacion($IMEI,$Longitud,$Latitud,$Direccion)
    {
        $qLog = "insert into log (IMEI) values('".$IMEI."')";
        $this->db->ExecuteQuery($qLog);

        $oCelularBBMod = new CelularBBMod();
        $oCelularBBDTO = new CelularBBDTO();
        $oCelularBBDTO = $oCelularBBMod->GetCelularID($IMEI);

//        if($oCelularBBDTO->CelularBBID > 0)
//        {
         $qInsertar = sprintf(InsUbicacion,$Longitud,$Latitud, $oCelularBBDTO->CelularBBID,$Direccion);
            $this->db->ExecuteQuery($qInsertar);

            return true;
//        }
//        else
//            return false;
    }

    private function ObtenerDireccion($lat,$lon)
    {
            $url = "http://maps.google.com/maps/geo?q=".$lat.",".$lon."&output=xml";

            $xml_document = file_get_contents($url);

            $xml = simplexml_load_string($xml_document);

            $direccion = $xml->Response->Placemark->address;

            return $direccion;
    }


    public function ActualizarDireccion($UbicacionID,$Direccion)
    {
        $oCelularBBMod = new CelularBBMod();
        $oCelularBBDTO = new CelularBBDTO();

        $qActualizar = sprintf(Actualizar,$Direccion,$UbicacionID);
        $this->db->ExecuteQuery($qActualizar);
    }

    public function ActualizarTodo()
    {
        $qListar = sprintf(ListUbicacionTodo);
        $lResult=$this->db->ExecuteQuery($qListar);

        $cont = 1;
        while ($row = @mysql_fetch_assoc($lResult))
        {
            $UbicacionID = $row['UbicacionID'];
            $Latitud = $row['Latitud'];
            $Longitud = $row['Longitud'];

            $Direccion = $this->ObtenerDireccion($Latitud,$Longitud);

            $this->ActualizarDireccion($UbicacionID,$Direccion);
        }
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
            $newnode->setAttribute("Direccion", $row['Direccion']);

            $cont+=1;
        }

        return $dom->saveXML();

    }
}?>
