<? include("HeadView.php");?>
<form name="proyecto" id="proyecto" action="" method="post">
<table width="95%" class="tblBusqueda">
	<tr class="linEspacioQ">
		<td colspan="5"></td>
	</tr>
	<tr class="tilPagina">
		<td colspan="5">DETALLE DE PERSONAS</td>
	</tr>
	<tr class="linEspacioQ">
		<td colspan="5"></td>
	</tr>
	<tr class="menBarra">
		<td width="20%"><?=$btnDatos;?></td>
		<td width="20%"><?=$btnFinanciero?></td>
		<td width="20%"><?=$btnHistorico;?></td>
		<td width="20%"><?=$btnResumen?></td>
		<td width="20%"><?=$btnLaboral?></td>
	</tr>
	<tr class="linEspacioC">
		<td colspan="4"></td>
	</tr>
	<tr>
		<td colspan="5">
		<div id="divResultados"><?include("design/datPersona.php");?></div>
		</td>
	</tr>
	<tr class="menBarra">
		<td colspan="5" align="right"><?=$btnRegresar;?></td>
	</tr>
</table>
</form>
<? include("FootView.php");?>