<? include("HeadView.php");?>
<form name="proyecto" id="proyecto" action="" method="post">
<table width="95%" class="tblBusqueda">
	<tr class="linEspacioQ">
		<td colspan="5"></td>
	</tr>
	<tr class="tilPagina">
		<td colspan="5">DETALLE DE EMPRESAS</td>
	</tr>
	<tr class="linEspacioQ">
		<td colspan="5"></td>
	</tr>
	<tr class="menBarra">
		<td width="20%"><?=$btnDatos;?></td>
		<td width="20%"><?=$btnLaboral?></td>
		<td width="20%"><?=$btnLblReporte;?></td>
		<td width="20%"><?=$btnHistorico?></td>
		<td width="20%"><?=$btnGrafica?></td>
	</tr>
	<tr class="linEspacioC">
		<td colspan="4"></td>
	</tr>
	<tr>
		<td colspan="5">
		<div id="divResultados"><?include("design/datEmpresa.php");?></div>
		</td>
	</tr>
	<tr class="menBarra">
		<td colspan="5" align="right"><?=$btnRegresar;?></td>
	</tr>
</table>
</form>
<? include("FootView.php");?>