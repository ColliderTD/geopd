<?php

/**
 * @author Carlos Candela
 * @copyright 2009
 */

define("InsTicket","insert into Ticket(UsuarioId,Actividad) values('%s',CURRENT_TIMESTAMP)");

define("DelTicketbyUser","delete from Ticket where UsuarioId='%s'");

define("GetTicketbyUser","select TicketId,UsuarioId from Ticket where TicketId='%s' and UsuarioId='%s'");


?>