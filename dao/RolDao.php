<?php
define("GetPaginasbyRol",
"Select p.PaginaNom,p.PaginaUrl,m.ModuloNom
from  Rol r, Rol_accion ra, accion a, pagina p, modulo m
where r.RolID=%s and r.RolId = ra.RolID and ra.AccionId=a.AccionId and
      a.PaginaId=p.PaginaId and p.ModuloId=m.ModuloId
group by p.PaginaNom,m.ModuloNom, p.PaginaUrl
order by m.Orden, p.Orden ");

define("GetRol",
"Select r.RolID, r.RolNom, r.RolDes, r.Visita
from rol AS r
where r.RolID=%s ");

define("GetRoles",
"Select r.RolID, r.RolNom, r.RolDes, r.Visita
from rol AS r");
?>