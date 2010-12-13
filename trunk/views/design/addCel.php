<form name="contrato" id="contrato" action="" method="post">
<table class="tblBusqueda" align="center" width="600px">
	<tr class="tilPagina">
		<td colspan="6">AGREGAR NUEVO CELULAR</td>
	</tr class="lblPrincipal">
        <tr>
            <td><?=$lblDuenio?></td>

        </tr>
	<tr class="linEspacioQ">
		<td colspan="6"></td>
	</tr>
	<tr class="lblPrincipal">
		<td>Nombres</td>
		<td><?=$edtNombres?></td>
		<td>Numero Celular</td>
		<td><?=$edtNumCel?></td>
	</tr>
        <tr class="lblPrincipal">
		<td>Apellidos</td>
		<td><?=$edtApellidos?></td>
		<td>IMEI</td>
		<td><?=$edtIMEI?></td>
	</tr>
        <tr>
            <td colspan="6"><br /></td>
        </tr>
	<tr>
		<td colspan="6"><?=$btnGuardar?>&nbsp;<?=$btnCancelar?></td>
	</tr>
	<tr>
		<td colspan="6"></td>
	</tr>
	<tr class="menBarra">
		<td colspan="6" align="right"></td>
	</tr>
</table>
</form>