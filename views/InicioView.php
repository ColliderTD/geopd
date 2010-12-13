<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?=$TitlePage;?></title>
<?
require_once("config.php");
echo lCss;
echo lJs;
echo $Ajax;
?>
</head>
<body background="include/images/fndPrincipal.png">
<table width="950" align="center" >
	<tr>
		<td></td>
	</tr>
	<tr>
		<td>

		<form name="proyecto" id="proyecto" action="index.php" method="post" onsubmit='javascript:return valLogin(this);'>
		<table width="100%">
			<tr>
				<td align="center" valign="middle" height="400">

				<table width="558px" border="0" border="0" cellspacing="0"
					cellpadding="0">
					<tr>
						<td colspan="2"><img src="include/images/pLogin1.png" /></td>
					</tr>
					<tr>
						<td width="228px"><img src="include/images/pLogin2.png" /></td>
						<td width="330px" background="include/images/pLogin3.png">
						<table width="95%" align="center">
							<tr class="lblLogin">
								<td width="30%">Usuario</td>
								<td><?=$edtUsuario;?></td>
							</tr>
							<tr class="lblLogin">
								<td>Contrase&ntilde;a</td>
								<td><?=$edtContrasena;?></td>
							</tr>
							<tr>
								<td colspan="1" align="center"><?=$btnIngresar;?></td>
                                                                <td colspan="1" align="center"><?=$btnRegistrar;?></td>
							</tr>
							<tr>
								<td colspan="2"><?=$Mensaje;?></td>
							</tr>
							<tr>
								<td colspan="2"><?=$Page;?><?=$Action?></td>
							</tr>
						</table>
						</td>
					</tr>
					<tr>
						<td colspan="2"><img src="include/images/pLogin4.png" /></td>
					</tr>
				</table>
				</td>
			</tr>
		</table>
		</form></td></tr>
		<tr>
			<td></td>
		</tr>

</table>
</body>
</html>
