<?

session_start();

//include "checar_sesion_admin.php";

include "coneccion.php";

$consulta  = "SELECT revision, etapa, etapa_360 from etapa where id=1";
	$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1:$consulta ". mysql_error() );//. mysql_error()	
	if(@mysql_num_rows($resultado)>=1)
	{
		$res=mysql_fetch_row($resultado);
		$revision=$res[0];
		$etapa=$res[1];
		$etapa360=$res[2];
	}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link rel="stylesheet" href="colorbox.css" />

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>

<script src="colorbox/jquery.colorbox-min.js"></script>

<title>Textron</title>

<style type="text/css">

<!--

body {

	margin-left: 0px;

	margin-top: 0px;

	margin-right: 0px;

	margin-bottom: 0px;

	background-image: url(images/bkg_fondo.jpg);

}

-->

</style>

<link href="images/textos.css" rel="stylesheet" type="text/css" />

<script>

	function passwd(id){

		$.colorbox({iframe:true,href:"cambia_pass.php?id="+ir,width:"400", height:"250",transition:"fade", scrolling:false, opacity:0.5});

	}

</script>

</head>

<?

$login=$_POST["login"];

if($login!="")

{



		$consulta  = "SELECT id, admin, nombre, email, id_jefe, puesto, tipo from usuarios where id='$login' and tipo=2  ";
		
		$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1: " );//. mysql_error()

		

		if(@mysql_num_rows($resultado)>=1)
		{

			$res=mysql_fetch_row($resultado);

			$id=$res[0];

			$tipo=$res[1];
			$externo=$res[6];

 $_SESSION['usuario']=array('id'=>$res[0], 'admin'=>$res[1], 'nombre'=>$res[2], 'email'=>$res[3], 'id_jefe'=>$res[4], 'puesto'=>$res[5], 'tipo'=>$res[6]);

			

			if($id==TRUE){

				$_SESSION['idSup']=$id;
				
				$consulta22  = "INSERT INTO externos_360 (id_evaluador, revision, tipo) VALUES (0, $revision, 2)";
				$resultado22 = mysql_query($consulta22) or die("La consulta $consulta22 ". mysql_error() );
				$idEV=  mysql_insert_id();
		
				$query2= "update externos_360 set id_evaluador=$idEV where id=$idEV";  
				$resul2 = mysql_query($query2) or die("Error en operacion1: $query " . mysql_error());
		
				$_SESSION['idEV']=$idEV;
	
				$consulta3  = "INSERT INTO evaluadores (id_evaluado, id_evaluador, relacion, revision) VALUES (".$_SESSION['idSup'].", $idEV, 2, $revision)";
				$resultado3 = mysql_query($consulta3) or die("La consulta $consulta ". mysql_error() );
	
				echo"<script>window.location=\"preguntas_360_n.php\"</script>";

			}
		}
echo"<script>alert(\"Supervisor invalido\");</script>";
}




?>



<body onLoad="document.form1.login.focus();">

<form id="form1" name="form1" method="post" action="index.php">



<table width="557" border="0" align="center" cellpadding="0" cellspacing="0">

  <tr>

    <td><img src="images/spacer.gif" width="10" height="70" /></td>

  </tr>

  <tr>

    <td><img src="images/logo_textron.png" width="557" height="96" /></td>

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

            <td width="64"><div align="right" class="usuario">No. del Supervisor:</div></td>

            <td width="209"><font color="#000000">

              <input name="login" class="forma" id="login" value="" size="15" maxlength="38" />

            </font></td>

            <td width="11">&nbsp;</td>

          </tr>

          <tr>            </tr>

          <tr>

           
          </tr>

          <tr>

            <td>&nbsp;</td>

            <td><label>

              

                  <div align="center">

                    <input name="button" type="submit" class="boton" id="button" value="Entrar" />

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

    <td></td>

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

