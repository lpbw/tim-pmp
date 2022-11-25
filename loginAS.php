<?

session_start();
//
//include "checar_sesion_admin.php";
//
//if($_SESSION['usuario']['email']!='miguel.hidrogo@gmail.com' && $_SESSION['usuario']['email']!='mario.garcia@bluewolf.com')
//    die("NO TIENES ACCESO A ESTA PAGINA");

include "coneccion_i.php";
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<?
// print_r($_REQUEST);
if(isset($_POST['login'])){
    
		$consulta  = "SELECT id, admin, nombre, email, id_jefe, puesto, tipo from usuarios where id='{$_POST["login"]}'  and activo=1";
        // echo $consulta;
        $resultado = mysqli_query($enlace, $consulta) or die("La consulta fall&oacute;P1: " );//. mysqli_error()

        if(@mysqli_num_rows($resultado)>=1)
        {
          	$res=mysqli_fetch_row($resultado);
			$id=$res[0];
			$tipo=$res[1];
			$externo=$res[6];
			$_SESSION['usuario']=array('id'=>$res[0], 'admin'=>$res[1], 'nombre'=>$res[2], 'email'=>$res[3], 'id_jefe'=>$res[4], 'puesto'=>$res[5], 'tipo'=>$res[6]);

			if($id==$contra and $externo!="4"){

				$_SESSION['idU']=$id;
				$_SESSION['idA']=$tipo;
				$_SESSION['idEXTERNO']=$externo;

				echo"<script>alert(\"Es necesaro realizar el cambio de tu password\");</script>";
				echo "<script> 
					$(document).ready(function() {
						$.colorbox({iframe:true, inline:true, width:450,height:320, scrolling:false, href:\"cambia_pass.php?id=$id\"});
					});
					</script>";

			}else{

				$_SESSION['idU']=$id;

				$_SESSION['idA']=$tipo;
				$_SESSION['idEXTERNO']=$externo;
				//session_register('nombreU');
					if($externo=="4"){
						echo"<script>window.location=\"evaluacion_360_new_eng.php\"</script>";
					}else{

						echo"<script>window.location=\"menu.php\"</script>";
						}

				}
				

        }else{
                echo"<script>alert('el usuario no existe')</script>";
        }
}
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link rel="stylesheet" href="colorbox.css" />

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>

<script src="colorbox/jquery.colorbox-min.js"></script>

<title>Bell</title>

<style type="text/css">

<!--

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
    <link href="images/textos2.css" rel="stylesheet" type="text/css" />

</head>




<body onLoad="document.form1.login.focus();">

    <form id="form1" name="form1" method="post">



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

            <td width="75"><div align="right" class="usuario">Usuario:</div></td>

            <td width="188"><font color="#000000">

              <input name="login" class="forma" id="login" value="" size="15" maxlength="38" />

            </font></td>

            <td width="37">&nbsp;</td>

          </tr>

          <tr>            </tr>

          <tr>

            <td><div align="right" class="usuario">Password:</div></td>

            <td><font color="#000000">

            </font></td>

            <td>&nbsp;</td>

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

    <td><div align="center"><span class="olvido"><a href="olvida_pass.php" target="_blank">¿Olvidó su nombre de Usuario o su Password?</a></span></div></td>

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

