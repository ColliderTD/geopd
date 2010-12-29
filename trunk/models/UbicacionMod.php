<?php
require_once("config.php");
require_once(Dao."UbicacionDao.php");
require_once(Dto."UbicacionDto.php");
require_once(Dto."CelularBBDTO.php");

class UbicacionMod extends ModelLib
{

    public function RegistrarNuevaUbicacion($IMEI,$Longitud,$Latitud,$Direccion,$Pais,$Departamento,$Ciudad,$Distrito,$Calle)
    {
        $qLog = "insert into log (IMEI) values('".$IMEI."')";
        $this->db->ExecuteQuery($qLog);

        $oCelularBBMod = new CelularBBMod();
        $oCelularBBDTO = new CelularBBDTO();
        $oCelularBBDTO = $oCelularBBMod->GetCelularID($IMEI);

//        if($oCelularBBDTO->CelularBBID > 0)
//        {
         $qInsertar = sprintf(InsUbicacion,$Longitud,$Latitud, $oCelularBBDTO->CelularBBID,$Direccion,$Pais,$Departamento,$Ciudad,$Distrito,$Calle);
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

    public function ListarUbicaciones($CelularBBID,$FechaMax,$FechaMin)
    {
        $qListar = sprintf(ListUbicacion,$CelularBBID,$FechaMin,$FechaMax);
        $lResult=$this->db->ExecuteQuery($qListar);

        return $lResult;
        /*$lista = null;
        
        $cont = 1;
        while ($row = @mysql_fetch_assoc($lResult))
        {
            $oUbicacion = new UbicacionDTO();

            $oUbicacion->Fecha = $row['Fecha'];
            $oUbicacion->Latitud = $row['Latitud'];
            $oUbicacion->Longitud = $row['Longitud'];
            $oUbicacion->Direccion = $row['Direccion'];
            $oUbicacion->Pais = $row['Pais'];
            $oUbicacion->Departamento = $row['Departamento'];
            $oUbicacion->Ciudad = $row['Ciudad'];
            $oUbicacion->Distrito = $row['Distrito'];
            $oUbicacion->Calle = $row['Calle'];

            $lista[$cont] = $oUbicacion;

            $cont+=1;
 
        }
            return $lista;*/
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
            $newnode->setAttribute("Pais", $row['Pais']);
            $newnode->setAttribute("Departamento", $row['Departamento']);
            $newnode->setAttribute("Ciudad", $row['Ciudad']);
            $newnode->setAttribute("Distrito", $row['Distrito']);
            $newnode->setAttribute("Calle", $row['Calle']);

            $cont+=1;
        }

        return $dom->saveXML();

    }
}?>
