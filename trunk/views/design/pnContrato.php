<form name="contrato" id="contrato" action="" method="post">
<table class="tblBusqueda" align="center" width="600px">
	<tr class="tilPagina">
		<td colspan="6">MANTENIMIENTO DE CONTRATOSS</td>
	</tr>
	<tr class="linEspacioQ">
		<td colspan="6"></td>
	</tr>
	<tr class="lblPrincipal">
		<td>Fec. Inicio</td>
		<td><?=$edtFecInicio?></td>
		<td>Fec. Fin</td>
		<td><?=$edtFecFin?></td>
		<td>Visitas</td>
		<td><?=$edtVisitas?></td>
	</tr>
	<tr>
		<td colspan="6" align="center"><?=$btnGuardarC?>&nbsp;<?=$btnCancelar?></td>
	</tr>
	<tr>
		<td colspan="6"></td>
	</tr>
	<tr>
		<td colspan="6">
		<div id="divContrato"><?=$dgContrato;?></div>
		</td>
	</tr>
	<tr class="menBarra">
		<td colspan="6" align="right"></td>
	</tr>
</table>
</form>