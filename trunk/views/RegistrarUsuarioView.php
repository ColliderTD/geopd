<? include("HeadView.php");?>
<table width="95%" class="tblBusqueda">
	<tr class="linEspacioQ">
		<td colspan="5"></td>
	</tr>
	<tr class="tilPagina">
		<td colspan="5">MANTENIMIENTO DE USUARIOS</td>
	</tr>
	<tr class="linEspacioQ">
		<td colspan="5"></td>
	</tr>
	<tr class="menBarra">
		<td width="20%"><?=$btnListar;?></td>
		<td width="20%"><?=$btnUsuario?></td>
		<td width="20%"></td>
		<td width="20%"></td>
		<td width="20%"></td>
	</tr>
	<tr class="linEspacioQ">
		<td colspan="4"></td>
	</tr>
	<tr>
		<td colspan="5">
		<div id="divResultados"><?=$dgUsuario;?></div>
		</td>
	</tr>
	<tr class="menBarra">
		<td colspan="5" align="right"><?=$btnRegresar;?></td>
	</tr>
</table>

<div id="blanket" style="display: none;"></div>
<div id="popUpDiv" style="display: none; width: 600px; height: 250px"></div>
<? include("FootView.php");?>