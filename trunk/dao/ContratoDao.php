<?php

/**
 * @author Carlos Candela
 * @copyright 2009
 */

define("GetContratobyUsuario",
"SELECT c.ContratoID, c.UsuarioID, c.Descripcion, c.Fecha, c.Fecha_Inicio,c.Fecha_Fin,c.Vistas_Contratadas,
c.Vistas_Utiles, c.ContradoPadre, c.Repeticiones
from  contrato c
where c.UsuarioID='%s' and c.Vistas_Utiles>0 and CURRENT_DATE BETWEEN  c.Fecha_Inicio  and  c.Fecha_Fin
order by Fecha_Inicio desc
limit 0,1");

define("GetContratosbyUsuario",
"SELECT c.ContratoID, c.UsuarioID, c.Descripcion, c.Fecha, c.Fecha_Inicio,c.Fecha_Fin,c.Vistas_Contratadas,
c.Vistas_Utiles, c.ContradoPadre, c.Repeticiones
from  contrato c
where c.UsuarioID='%s'
order by Fecha_Inicio desc
limit 0,5");

define("UpdVistas",
"update contrato c
set c.Vistas_Utiles = c.Vistas_Utiles - 1
where c.ContratoID='%s' and c.Vistas_Utiles>0");

define("InsContrato",
"insert into contrato(UsuarioID,Fecha,Fecha_Inicio,Fecha_Fin,Vistas_Contratadas,Vistas_Utiles)
values(%s,CURDATE(),'%s','%s',%s,%s)");

?>