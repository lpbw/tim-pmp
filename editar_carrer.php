<?
	session_start();
	include "checar_sesion_admin.php";
	include "coneccion_i.php";
	$id=$_GET["id"];
	
	if($_POST['edit']=="Actualizar"){
		
		$nombre=$_POST['nombre'];
		
		$query="update carrer_highlights set  to_date='".$_POST['yearCH']."', job_title='".$_POST['jobTitleCH']."', company='".$_POST['companyCH']."', achievement= '".$_POST['achievementCH']."' WHERE id=$id";
		$consulta=mysqli_query($enlace,$query)or die("Fallo al actualizar: $query ".mysqli_error($enlace));
		echo"<script>alert(\"Infromacion Actualizada\"); parent.location=\"career_profile.php\";</script>";
	}

	$query="SELECT * FROM carrer_highlights where id=$id";
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
<style type="text/css">
<!--
.column {  	text-align: right;
  	float:left;
    width:28%;
    margin: 5px;
}
-->
</style>
</head>

<body>
	<table width="447" border="0" align="center">
		<tr align="center">
			<td bgcolor="#00475c" class="text_mediano_blanco style1">Edit Carrer Highlight</td>
		</tr>
		<tr>
			<td>
				<form name="form1" id="form1" action="" method="post">
					<table width="100%" border="1" cellpadding="1" cellspacing="0" bordercolor="#CCCCCC">
						<tr>
							<th width="26%" align="right" valign="middle" class="tit_1" scope="row">Year</th>
							<td width="74%">
								<input name="yearCH" type="text" id="yearCH" value="<? echo "$usuario[3]";?>" />
								<input name="id" type="hidden" id="id" value="<? echo "$id";?>" />							</td>
						</tr>
						<tr>
						  <th align="right" valign="middle" class="tit_1" scope="row">Job Title </th>
						  <td>
						    <input name="jobTitleCH" type="text" id="jobTitleCH" value="<? echo "$usuario[4]";?>" />
						  </td>
					  </tr>
						<tr>
						  <th align="right" valign="middle" class="tit_1" scope="row">Company Name </th>
						  <td><input name="companyCH" type="text" id="companyCH" value="<? echo "$usuario[5]";?>" /></td>
					  </tr>
						<tr>
						  <th align="right" valign="middle" class="tit_1" scope="row"><strong>Career Highlight</strong></th>
						  <td>
						    <textarea name="achievementCH" cols="30" rows="5" id="achievementCH" style="width:100%"><? echo "$usuario[6]";?></textarea>
						  </td>
					  </tr>
						
					
						<tr>
							<th colspan="2" valign="middle" class="tit_1" scope="row">&nbsp;</th>
						</tr>
						<tr>
							<td colspan="2">
								<div align="center"><input  name="edit" id="edit" type="submit" align="middle" class="boton" value="Actualizar" /></div>							</td>
						</tr>
					</table>
				</form>
			</td>
		</tr>
</table>
</body>
</html>
