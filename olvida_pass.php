<?
session_start();
//include "checar_sesion_admin.php";
include "coneccion_i.php";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Bell</title>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-image: url();
}
-->
</style>
<link href="images/textos.css" rel="stylesheet" type="text/css" />
</head>
<?
if($_POST['button']=="Recuperar"){
	$login=$_POST["login"];
	$consulta  = "select  id, contra, email from usuarios where id=$login";
	$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1:$consulta " . mysqli_error($enlace));
	if(@mysqli_num_rows($resultado)>0)
	{
		$res=mysqli_fetch_row($resultado);
			$pass=$res[1];
			$email=$res[2];
	$EmailFrom = "notificaciones@tim-pmp.com";	//mail
	
	$Subject = "Recuperacion de password - Textron TIM-PMP - ";
	$Body = "";
	$Body .= "<html>";
	$Body .= "<head><style type=\"text/css\">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.style1 {
	color: #1419EF;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 18px;
}
.style5 {font-size: 14px; }
-->
</style>";
				$Body .= "<title>Bell</title>";
				$Body .= "</head>";
	$Body .= "
<body>
<table width=\"600\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
  <tr>
    <td width=\"90\"></td>
    <td width=\"510\"> </td>
  </tr>
  <tr>
    <td colspan=\"2\"><p>$nombre $app $apm</p>
    <p> <br>
<br><br>Para ingresar usa los siguientes datos:</p>
    <table width=\"50%\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\">
     
	  
	  <tr>
        <td width=\"22%\" bgcolor=\"#CCCCCC\" class=\"style1\"><div align=\"center\" class=\"style5\">USR:</div></td>
        <td width=\"78%\">$login</td>
      </tr>
	  <tr>
        <td width=\"22%\" bgcolor=\"#CCCCCC\" class=\"style1\"><div align=\"center\" class=\"style5\">PSW:</div></td>
        <td width=\"78%\">$pass</td>
      </tr>
     
	 
	 ";
		
   $Body .= " </table>
	<p>Este mensaje fue generado automaticamente por la aplicacion de registro por favor no contestar.</p>
    
    <p><br>
      <br>
    </p></td>
  </tr>
</table>";
	
				$Body .= "</body>";
				$Body .= "</html>";
				$email="mgarciavarela@gmail.com";
				if($login!="")
				$success = mail($email, $Subject, $Body, "From: tim-pmp.com <$EmailFrom>\nContent-type: text/html; charset=utf-8\n");
				$success = mail($email2, $Subject, $Body, "From: tim-pmp.com <$EmailFrom>\nContent-type: text/html; charset=utf-8\n");
				echo"<script>alert(\"Tu contraseña ha sido enviada.\");</script>";
				echo"<script>window.location='index.php'; </script>";
}
else
{					
		
			
		echo"<script>alert(\"ERROR: usuario $login no se encuentra registrado.\"); </script>";
	}
}

?>

<body onLoad="document.form1.login.focus();">
<form id="form1" name="form1" method="post" action="">

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
  <td background="images/Header_bkg.png">
            <table width="300" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td>
                  <div align="center"><img src="images/header_logo.png" width="210" height="175" /></div>
                </td>
              </tr>
            </table>
          </td>
  </tr>
  <tr>
    <td><img src="images/spacer.gif" width="10" height="70" /></td>
  </tr>
  <tr>
    <td><table width="385" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td colspan="3"><img src="images/cuadro_arriba.png" width="385" height="30" /></td>
        </tr>
      <tr>
        <td width="35"><img src="images/cuadro_izq.png" width="35" height="110" /></td>
        <td width="315" bgcolor="#FFFFFF"><table width="300" border="0" align="center" cellpadding="0" cellspacing="4">
          <tr>
		  	<td colspan="3" width="100%">
			  <div align="center" class="text_mediano">Para Recuperar Password escriba su numero de usuario y el password sera enviado a su email.</div>
			</td>
		  </tr>
		  <tr>
            <td width="75"><div align="right" class="usuario">Usuario:</div></td>
            <td width="100"><font color="#000000">
              <input name="login" class="forma" id="login" size="15" maxlength="50" />
            </font></td>
            <td width="37">&nbsp;</td>
          </tr>
          <tr>            </tr>
          <tr>
            <td>&nbsp;</td>
            <td><label>
              
                  <div align="center">
                    <input name="button" type="submit" class="boton" id="button" value="Recuperar" />
                  </div>
            </label></td>
            <td>&nbsp;</td>
          </tr>
        </table></td>
        <td width="35"><img src="images/cuadro_der.png" width="35" height="110" /></td>
      </tr>
      <tr>
        <td colspan="3"><img src="images/cuadro_abajo.png" width="385" height="30" /></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td><div align="center"></div></td>
  </tr>
  <tr>
    <td><div align="center" class="olvido">
      <div align="left"><img src="images/spacer.gif" width="10" height="240" /></div>
    </div></td>
  </tr>
  <tr>
    <td><div align="center" class="texto_chico">Recursos Humanos  -  Desarrollo Organizacional</div></td>
  </tr>
  <tr>
    <td><img src="images/spacer.gif" width="10" height="20" /></td>
  </tr>
</table>
</form>
</body>
</html>
