<?
	session_start();
	include "checar_sesion_admin.php";
	include "coneccion_i.php";
	$id=$_GET["id"];
	
	if($_POST['edit']=="Actualizar"){
		
		/*$nombre=$_POST['nombre'];
		
		$query="UPDATE puestos SET nombre='$nombre' WHERE id=$id";
		$consulta=mysqli_query($enlace,$query)or die("Fallo al actualizar: $query ".mysqli_error($enlace));*/
		if ($_FILES["file"]["error"] > 0)
	    {
				echo "<script>alert('error archivo');</script>";
	    }
		else
		{
		
	$allowedExtensions = array("doc","docx","pdf","gif","jpg","xlsx","key","ppt","pptx","xls");
	$varr=explode(".", strtolower($_FILES['file']['name']));
	$ext=$varr[1];
	//echo"$ext ".$_FILES['file']['name'];
	if(in_array($ext, $allowedExtensions))
	{
		$nombreA=$_FILES['file']['name'];
		if(move_uploaded_file($_FILES['file']['tmp_name'],"docs_filosofia/$nombreA"))
		{
			//$enlace = mysql_connect("localhost:3306", "bluewolf_app", "MyConsulting01")or die("No pudo conectarse : ");
			//mysql_select_db("bluewolf_bluewolf") or die("No pudo seleccionarse la BD.");
		//Consulta texto del correo
			$consulta  = "update filosofia set archivo='$nombreA', actualizacion=now()  where id=$id";
			$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1: $consulta" );
			
			/*echo "<script>alert(\"El archivo adjuntado.\");</script>";*/
			
		}
	}else
	{
	echo"Tipo de archivo no permitido";
	}
	}
		echo"<script>alert(\"Archivo actualizado exitosamente\");</script>";
	}

	$query="SELECT * FROM filosofia where id=$id";
	$result=mysqli_query($enlace,$query) or die("Falla la consulta 1: ". mysqli_error($enlace));
	$usuario=mysqli_fetch_row($result);
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
-->
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
		if(document.form1.jefe.selectedIndex==0 || document.form1.depto.selectedIndex==0 || document.form1.jefe_360.selectedIndex==0){
			alert("Debes llenar todos los campos");
			return false;
		}
		return true;
	}
</script>
</head>

<body>
	<table width="447" border="0" align="center">
		<tr align="center">
			<td bgcolor="#00475c" class="text_mediano_blanco style1">Editar <? echo $usuario[1];?> </td>
		</tr>
		<tr>
			<td>
				<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
					<table width="100%" border="1" cellpadding="1" cellspacing="0" bordercolor="#CCCCCC">
						<!--<tr>
							<th width="35%" align="right" valign="middle" class="tit_1" scope="row">Nombre</th>
							<td>
								<input required name="nombre" type="text" id="nombre" value="<? echo "$usuario[1]";?>" size="30" maxlength="100" />
								<input name="id" type="hidden" id="id" value="<? echo "$id";?>" />							</td>
						</tr>-->
						<tr>
						  <th align="right" valign="middle" class="tit_1" scope="row">Archivo</th>
						  <td>	<input name="id" type="hidden" id="id" value="<? echo "$id";?>" /> <input type="file" name="file" /></td>
					  </tr>
						
					
						<tr>
							<th colspan="2" valign="middle" class="tit_1" scope="row"><? if($usuario[2]!=""){?><a href="docs_filosofia/<? echo "$usuario[2]";?>" target="_blank">Ver archivo </a><? }?></th>
						</tr>
						<tr>
							<td colspan="2">
								<div align="center"><input onclick="javascript:valdar();" name="edit" id="edit" type="submit" align="middle" class="boton" value="Actualizar" /></div>							</td>
						</tr>
					</table>
				</form>
			</td>
		</tr>
</table>
</body>
</html>

