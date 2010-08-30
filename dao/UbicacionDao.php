<?php
define("InsUbicacion","insert into ubicacion(Longitud,Latitud,CelularBBID,Fecha) values(%s,%s,%s,NOW())");

define("ListUbicacion","SELECT * FROM ubicacion WHERE ubicacion.CelularBBID = %s AND ubicacion.Fecha <= '%s' AND ubicacion.Fecha >= '%s'");

?>
