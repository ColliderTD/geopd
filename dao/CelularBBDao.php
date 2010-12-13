<?php
define("GetCelularBBByIMEI","SELECT * FROM  CelularBB c WHERE c.IMEI='%s'");
define("GetCelularBBB","SELECT * FROM  CelularBB");

define("GetCelularBBListByIDUsuario","SELECT cbb.CelularBBID, cbb.Nombres, cbb.Apellidos, cbb.IMEI, cbb.Numero FROM celularbb cbb JOIN usuario_celularbb ucbb ON (cbb.CelularBBID = ucbb.CelularBBID) WHERE ucbb.UsuarioID = %s");

define("InsCelularBB",
"insert into celularbb(Nombres,Apellidos,IMEI,Numero)
values('%s','%s','%s','%s')");

define("InsCelUsuario",
"insert into usuario_celularbb(UsuarioID,CelularBBID)
values(%s,%s)");


?>
