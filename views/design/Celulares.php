<form name="buscarubicaciones" id="buscarubicaciones" action="" method="post">

<table width="95%" class="tblBusqueda">
	<tr class="tilPagina">
		<td colspan="5">MAPA</td>
	</tr>

	<tr class="menBarra">

	</tr>

        <tr class="menBarra">
		<td width="20%"></td>

	</tr>
	<tr>
		<td colspan="5">
                    <div id="divResultados" style="z-index:-1">
                        <?=$dgCelular;?>
                    </div>
                    <div id="divSalida" style="z-index:-1">

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
</form>
<div id="blanket" style="display: none;"></div>