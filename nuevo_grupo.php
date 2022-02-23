<?
	session_start();
	include "checar_sesion_admin.php";
	include "coneccion_i.php";
	$revision=$_GET['revision'];
	if($_POST['edit']=="Agregar"){
		
		$nombre=$_POST['nombre'];
		$revision=$_POST['revision'];
		
		$query="INSERT INTO grupos_calibracion(nombre, revision) VALUES('$nombre','$revision')";
		$consulta=mysqli_query($enlace,$query)or die("Fallo al agregar usuario: ".mysqli_error($enlace));
		$id_grupo=  mysqli_insert_id($enlace);
		
		echo"<script> parent.location=\"cambia_grupo.php?id=$id_grupo\";</script>";
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-image: url();
	background-color: #E5E5E5;
}
-->
</style>
<link href="images/textos.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style1 {font-size: 24px}
-->
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script>
	function validar(){
		if(document.form1.nombre.value=="")
		{
			alert("No escribio nombre");
			document.form1.nombre.focus();
			return false;
		}
	}
</script>
<title>Untitled Document</title>
</head>

<body>
	<table width="450" border="0" align="center">
		<tr align="center">
			<td bgcolor="#00475c" class="text_mediano_blanco style1">Agregar Grupo </td>
		</tr>
		<tr>
			<td>
				<form name="form1" id="form1" action="" method="post">
					<table width="100%" border="1" cellpadding="1" cellspacing="0" bordercolor="#CCCCCC">
						<tr>
							<th width="35%" align="right" valign="middle" class="tit_1" scope="row">Nombre</th>
							<td>
								<input required name="nombre" type="text" id="nombre"  size="30" maxlength="100" />
								<input name="revision" type="hidden" id="revision" value="<?echo"$revision";?>" /></td>
						</tr>
						<tr>
							<td colspan="2">
								<div align="center"><input onclick="javascript:valdar();" name="edit" id="edit" type="submit" align="middle" value="Agregar" /></div>							</td>
						</tr>
					</table>
				</form>
			</td>
		</tr>
	</table>
</body>
</html>
