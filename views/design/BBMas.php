<table width="95%" class="tblBusqueda">
	<tr class="tilPagina">
		<td colspan="5">MAPA</td>
	</tr>

	<tr class="menBarra">
		<td width="20%"><?=$btnVerHoy;?></td>
                <td width="20%">Fecha Inicio</td>
                <td width="20%"><?=$edtFecInicio;?></td>
                <td width="20%">Hora  Inicio</td>
	</tr>
        <tr class="menBarra">
		<td width="20%"></td>
                <td width="20%">Fecha Fin</td>
                <td width="20%"><?=$edtFecFin;?></td>
                <td width="20%">Hora  Fin</td>
	</tr>
        <tr class="menBarra">
		<td width="20%"></td>

	</tr>
	<tr>
		<td colspan="5">
                    <div id="divResultados" style="z-index:-1">
                        <div id="map" style="width: 1000px; height: 400px"></div>
                    </div>
		</td>
	</tr>
	<tr class="menBarra">
                <td width="20%"><?=$btnImprimir;?></td>
		<td width="20%"><?=$btnRegresar;?></td>
                <td width="20%"></td>
		<td width="20%"></td>
		<td width="20%"></td>
	</tr>
</table>
<div id="blanket" style="display: none;"></div>