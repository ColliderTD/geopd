<?php
define("GetCelularBBByIMEI","SELECT * FROM  CelularBB c WHERE c.IMEI='%s'");

define("GetCelularBBListByIDUsuario","SELECT cbb.CelularBBID, cbb.Nombres, cbb.Apellidos, cbb.IMEI, cbb.Numero FROM celularbb cbb JOIN usuario_celularbb ucbb ON (cbb.CelularBBID = ucbb.CelularBBID) WHERE ucbb.UsuarioID = %s");

?>
