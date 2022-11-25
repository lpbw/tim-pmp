<?
session_start();
//include "checar_sesion_admin.php";
include "coneccion_i.php";

if($_POST['button']=="Confirmar"){
	$id=$_GET['id'];
	$contra=$_POST['pass'];
	$query="UPDATE usuarios SET contra='$contra' where id=$id";
	$consulta=mysqli_query($enlace,$query)or die("Error al actualizar password: ".mysqli_error($enlace));
	//if(mysqli_affected_rows()>0)
		echo"<script>alert(\"Password actualizado!\");window.parent.location=\"menu.php\";</script>";
	//else
		//echo"<script>alert(\"Error al actualizar password, intentelo nuevamente!\")</script>";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Bell</title>
<script>
	function validar(){
		if(document.form1.pass.value!=document.form1.pass_conf.value){
			alert("No coincide las contraseñas!\nFavor de ingresar nuevamente los datos.");
			document.form1.reset();
			document.form1.pass.focus;
		}else
			document.form1.submit();
	}
</script>
<style type="text/css">
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
</head>

<body onLoad="document.form1.pass.focus();">
<form id="form1" name="form1" method="post" action="">

<table width="400" height="250" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td colspan="3"><img src="images/cuadro_arriba.png" width="385" height="15" /></td>
        </tr>
      <tr>
        <td width="10%"><img src="images/cuadro_izq.png" width="35" height="100%" /></td>
        <td width="80%" bgcolor="#FFFFFF"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="4">
          <tr>
		  	<td colspan="3" width="100%">
			  <div align="center" class="text_mediano">CAMBIO DE PASSWORD</div>
			</td>
		  </tr>
		  <tr>
            <td width="60%"><div align="right" class="usuario">Password:</div></td>
            <td width="40%"><font color="#000000">
              <input name="pass" class="forma" value="" type="password" required id="pass" size="10" maxlength="15" />
            </font></td>
            <td width="37">&nbsp;</td>
          </tr>
		  <tr>
            <td width="60%"><div align="right" class="usuario">Confirma Password:</div></td>
            <td width="40%"><font color="#000000">
              <input name="pass_conf" class="forma" value="" type="password" id="pass_conf" required size="10" maxlength="15" />
            </font></td>
            <td width="37">&nbsp;</td>
          </tr>
		  <tr>
            <td>&nbsp;</td>
            <td><label>
                  <div align="center">
                    <input name="button" type="submit" onclick="javascript:validar();" class="boton" id="button" value="Confirmar" />
                  </div>
            </label></td>
            <td>&nbsp;</td>
          </tr>
        </table></td>
        <td width="9%"><img src="images/cuadro_der.png" width="35" height="100%" /></td>
      </tr>
      <tr>
        <td colspan="3"><img src="images/cuadro_abajo.png" width="385" height="30" /></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td><div align="center" class="texto_chico"><hr />Recursos Humanos  -  Desarrollo Organizacional</div></td>
  </tr>
</table>
</form>
</body>
</html>