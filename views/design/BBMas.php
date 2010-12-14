<form name="buscarubicaciones" id="buscarubicaciones" action="" method="post">

<table width="95%" class="tblBusqueda">
	<tr class="tilPagina">
		<td colspan="5">MAPA</td>
	</tr>

	<tr class="menBarra">
                <td width="20%">Fecha Inicio</td>
                <td width="20%"><?=$edtFecInicio;?></td>
                <td width="20%">Hora  Inicio</td>
                <td width="20%"><?=$edtHoraInicio;?></td>
                <td width="20%"><?=$btnVerHoy;?></td>
	</tr>
        <tr class="menBarra">
                <td width="20%">Fecha Fin</td>
                <td width="20%"><?=$edtFecFin;?></td>
                <td width="20%">Hora  Fin</td>
                <td width="20%"><?=$edtHoraFin;?></td>
                <td width="20%"><?=$btnBuscar;?></td>
	</tr>
        <tr class="menBarra">
		<td width="20%"></td>

	</tr>
	<tr>
		<td colspan="5">
                    <div id="divResultados" style="z-index:-1">
                        <div id="map" style="width: 1000px; height: 400px"></div>
                    </div>
                    <div id="divSalida" style="z-index:-1">

                    </div>
		</td>
	</tr>
	<tr class="menBarra">
                <td width="20%"><?=$btnImprimir;?></td>
                <td width="20%"><?=$btnAmpliar;?></td>
		<td width="20%"></td>
		<td width="20%"></td>
                <td width="20%"><?=$btnRegresar;?></td>
	</tr>
</table>
</form>
<div id="blanket" style="display: none;"></div>