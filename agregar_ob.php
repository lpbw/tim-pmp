<?
	session_start();
	include "checar_sesion_admin.php";
	include "coneccion_i.php";

	if($_POST['edit']=="Agregar"){
		
		$nombre=$_POST['nombre'];
		$revision=$_POST['revision'];
		$nombre = mysqli_real_escape_string($enlace,$nombre);
		
		$query="INSERT INTO io_principies(nombre, revision) VALUES('$nombre', '$revision')";
		$consulta=mysqli_query($enlace,$query)or die("Fallo al agregar dep: ".mysqli_error($enlace));
		echo"<script>alert(\"Objetivo agregado \");</script>";
		echo"<script> parent.location=parent.location; parent.cerrarV();</script>";
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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

</style>
<link href="images/textos.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style1 {font-size: 24px}
-->
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<link type="text/css" href="css/smoothness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />	
	
	<script type="text/javascript" src="js/jquery-ui-1.8.16.custom.min.js"></script>
<SCRIPT>
	$(function() {
		$( "#fecha" ).datepicker({ dateFormat: 'yy-mm-dd' });
		$( "#fecha_nacimiento" ).datepicker({ dateFormat: 'yy-mm-dd' });
		
	});
</SCRIPT>
<script>
	function validar(){
		if(document.form1.contra.value==document.form1.v_contra.value)
			document.form1.submit();
		else{
			alert("El password no coincide");
			document.form1.contra.focus();
			return false;
		}
	}
</script>
<title>Untitled Document</title>
</head>

<body>
	<table width="450" border="0" align="center">
		<tr align="center">
			<td bgcolor="#00475c" class="text_mediano_blanco style1">Agregar Objetivos</td>
		</tr>
		<tr>
			<td>
				<form name="form1" id="form1" action="" method="post">
					<table width="100%" border="1" cellpadding="1" cellspacing="0" bordercolor="#CCCCCC">
						
						
						<tr>
							<th width="35%" align="right" valign="middle" class="tit_1" scope="row">Nombre</th>
							<td>
								<input required name="nombre" type="text" id="nombre" placeholder="Nombre" size="30"  />							</td>
						</tr>
					<tr>
						  <th align="right" valign="middle" class="tit_1" scope="row">Revisi&oacute;n</th>
						  <td><select name="revision" id="revision">
                        
					  <?
	$consulta  = "SELECT revision, revision+1 as rev FROM etapa where id=1";
	$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1:$consulta ". mysqli_error($enlace) );//. mysqli_error($enlace)	
	
		$res=mysqli_fetch_row($resultado);
		?>
		<option value="<? echo $res[0];?>"><? echo $res[0]?></option>
		<option value="<? echo $res[1];?>"><? echo $res[1]?></option>
		 </select></td>
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
