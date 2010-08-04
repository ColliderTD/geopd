<? include("HeadView.php");?>
<form name="proyecto" id="proyecto" action="" method="post" onsubmit='javascript:CnsEmpresa(this);return false;'>
<table width="80%"   class="tblBusqueda" align="center">
	<tr class="linEspacioC">
		<td colspan="4"></td>
	</tr>
	<tr class="tilPagina">
		<td colspan="4">BUSQUEDA DE EMPRESAS</td>
	</tr>
	<tr class="linEspacioQ">
		<td colspan="4"></td>
	</tr>
	<tr class="lblPrincipal">
		<td width="20%">Ruc :</td>
		<td colspan="3" align="left"><?=$edtRUC;?></td>
	</tr>
	<tr class="lblPrincipal">
		<td>Razon Social :</td>
		<td colspan="3" align="left"><?=$edtRazon;?></td>
	</tr>
	<tr class="lblPrincipal">
		<td>Nombre Comercial :</td>
		<td colspan="3" align="left"><?=$edtComercial;?></td>
	</tr>
	<tr class="linEspacioQ">
		<td colspan="4"></td>
	</tr>
	<tr>
		<td colspan="4" align="center"><?=$btnBuscar;?></td>
	</tr>
</table>
<table width="80%" class="tblBusqueda">
	<tr class="linEspacioD">
		<td colspan="2"></td>
	</tr>
	<tr class="linColor">
		<td colspan="2"></td>
	</tr>
	<tr class="linEspacioD">
		<td colspan="2"></td>
	</tr>
	<tr>
		<td colspan="2">
		<div id="divDataGrid"></div>
		</td>
	</tr>
</table>
</form>
<? include("FootView.php");?>