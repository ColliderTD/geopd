<?php
define("InsUbicacion","insert into ubicacion(Longitud,Latitud,CelularBBID,Fecha,Direccion) values(%s,%s,%s,NOW(),'%s')");

define("ListUbicacion","SELECT * FROM ubicacion WHERE ubicacion.CelularBBID = %s AND ubicacion.Fecha >= '%s' AND ubicacion.Fecha <= '%s' ");

define("ListUbicacionTodo","SELECT * FROM ubicacion WHERE Direccion = 'N/A' AND CelularBBID = 3 ");

define("Actualizar","UPDATE ubicacion SET Direccion = '%s' WHERE UbicacionID = %s ");

?>
