<?php
define("GetPaginasbyUsuario",
"Select p.PaginaNom,p.PaginaUrl,m.ModuloNom
from  usuario u, Rol r, Rol_accion ra, accion a, pagina p, modulo m
where u.UsuarioId='%s' and u.RolId = r.RolID and
      r.RolId = ra.RolID and ra.AccionId=a.AccionId and
      a.PaginaId=p.PaginaId and p.ModuloId=m.ModuloId
group by p.PaginaNom,m.ModuloNom, p.PaginaUrl
order by m.Orden, p.Orden ");

define("GetUsuariobyLogin",
"SELECT u.UsuarioID, u.RolID, u.Usuario, u.Contrasenia, u.Apellidos, u.Nombres
FROM usuario AS u
where u.Usuario='%s' and u.Contrasenia='%s'");

define("InsAcceso",
"insert into acceso(UsuarioDes,IP,Estado,Fecha)
values('%s','%s',%s, CURRENT_TIMESTAMP)");

define("InsVista",
"insert into vista_persona(UsuarioId,Documento,PersonaDes,IP,Fecha,Estado,ContratoID)
values(%s,'%s','%s','%s',CURRENT_TIMESTAMP,%s,%s)");

define("InsUsuario",
"insert into usuario(Usuario,Nombres,Apellidos,RolID,Contrasenia)
values('%s','%s','%s',%s,'%s')");

define("GetUsuario",
"SELECT u.UsuarioID, u.RolID, u.Usuario, u.Contrasenia, u.Apellidos, u.Nombres
FROM usuario AS u
where u.Usuario='%s'");

define("GetUsuarios",
"SELECT u.UsuarioID, u.RolID, u.Usuario, u.Contrasenia, concat(u.Apellidos,' , ', u.Nombres) as Nombres, r.RolNom
FROM usuario AS u, rol r
where u.RolID=r.RolID and u.Usuario like '%s%%'");

define("GetUsuarioByID",
"SELECT * FROM usuario where UsuarioID = %s")

?>