<?
session_start();
include "checar_sesion_admin.php";
include "coneccion_i.php";
$idU=$_SESSION['idU'];
$grados_n[0]="1";
$grados_n[1]="3";
$grados_n[2]="5";

	$consulta  = "select id,ingles AS nombre from tex_expectativas  order by id limit 0,1";
	$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1:$consulta ". mysqli_error($enlace) );//. mysqli_error($enlace)
	if(@mysqli_num_rows($resultado)>=1)
	{
		$res=mysqli_fetch_row($resultado);
		$expectativa=$res[1];
		$id_exp=$res[0];

	}
	$consulta  = "SELECT revision, etapa, etapa_360 from etapa where id=1";
	$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1:$consulta ". mysqli_error($enlace) );//. mysqli_error($enlace)
	if(@mysqli_num_rows($resultado)>=1)
	{
		$res=mysqli_fetch_row($resultado);
		$revision=$res[0];
		$etapa=$res[1];
		$etapa360=$res[2];
	}
	$consulta  = "SELECT id from planes where id_empleado=$idU and revision=$revision";
	$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1:$consulta ". mysqli_error($enlace) );//
	if(@mysqli_num_rows($resultado)>=1)
	{
		$res=mysqli_fetch_row($resultado);
		$plan=$res[0];

	}
	$consulta  = "select id,nombre, uno, tres, cinco,descripcion from tex_competencias_ing  where id_expectativa=$id_exp limit 0,1";
	$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1:$consulta ". mysqli_error($enlace) );//. mysqli_error($enlace)
	if(@mysqli_num_rows($resultado)>=1)
	{
		$res=mysqli_fetch_row($resultado);
		$competencia=$res[1];
		$descripcion=$res[5];
		$id_comp=$res[0];
		$grados[0]=$res[2];
		$grados[1]=$res[3];
		$grados[2]=$res[4];

	}

?>
<!DOCTYPE html
  PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Bell</title>
  <link rel="stylesheet" href="colorbox.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
  <script src="colorbox/jquery.colorbox-min.js"></script>
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
  <script>
    $(document).ready(function () {
      $(".iframe2").colorbox({
        iframe: true,
        width: "450",
        height: "320",
        transition: "fade",
        scrolling: false,
        opacity: 0.1
      });
      $("#click").click(function () {
        $('#click').css({
          "background-color": "#f00",
          "color": "#fff",
          "cursor": "inherit"
        }).text("Open this window again and this message will still be here.");
        return false;
      });
    });
  </script>
  <script type="text/javascript">
    function MM_swapImgRestore() { //v3.0
      var i, x, a = document.MM_sr;
      for (i = 0; a && i < a.length && (x = a[i]) && x.oSrc; i++) x.src = x.oSrc;
    }

    function MM_preloadImages() { //v3.0
      var d = document;
      if (d.images) {
        if (!d.MM_p) d.MM_p = new Array();
        var i, j = d.MM_p.length,
          a = MM_preloadImages.arguments;
        for (i = 0; i < a.length; i++)
          if (a[i].indexOf("#") != 0) {
            d.MM_p[j] = new Image;
            d.MM_p[j++].src = a[i];
          }
      }
    }

    function MM_findObj(n, d) { //v4.01
      var p, i, x;
      if (!d) d = document;
      if ((p = n.indexOf("?")) > 0 && parent.frames.length) {
        d = parent.frames[n.substring(p + 1)].document;
        n = n.substring(0, p);
      }
      if (!(x = d[n]) && d.all) x = d.all[n];
      for (i = 0; !x && i < d.forms.length; i++) x = d.forms[i][n];
      for (i = 0; !x && d.layers && i < d.layers.length; i++) x = MM_findObj(n, d.layers[i].document);
      if (!x && d.getElementById) x = d.getElementById(n);
      return x;
    }

    function verobjetivos(dato) {
      document.form1.verobjetivos.value = dato;
      document.form1.action = "objetivos.php";
      document.form1.target = "blank";
      document.form1.submit();
    }

    function evaluar(valor) {
      document.form1.id_evaluado.value = valor;
      document.form1.submit();
    }



    function MM_swapImage() { //v3.0
      var i, j = 0,
        x, a = MM_swapImage.arguments;
      document.MM_sr = new Array;
      for (i = 0; i < (a.length - 2); i += 3)
        if ((x = MM_findObj(a[i])) != null) {
          document.MM_sr[j++] = x;
          if (!x.oSrc) x.oSrc = x.src;
          x.src = a[i + 2];
        }
    }
  </script>
  <style type="text/css">
    .style1 {
      font-size: 24px
    }

    .style10 {
      font-family: Geneva, Arial, Helvetica, sans-serif;
      font-size: 16px;
      color: #104352;
    }

    .style5 {
      font-family: Arial, Helvetica, sans-serif;
      font-size: 12px;
      color: #000000;
    }

    .style11 {
      font-size: large
    }

    .style9 {
      font-size: x-large
    }
    .boton {
      font-family: "Helvetica LT Std";
      font-size: 15px;
      font-weight: normal;
      color: #fff;
      text-decoration: none;
      background:  rgb(0,71,92);
      padding: 1%;
    }
  </style>
</head>

<body onload="MM_preloadImages('images/b_administracion_r.png','images/b_log_out_r.png','images/icono_borrar_r.png')">
  <form id="form1" name="form1" method="post" action="preguntas_360_new_eng.php">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
            <?
      include_once("header.php");
    ?>
      </tr>
      <tr>
        <td>
          <table width="900" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
              <td>
          <a href="evaluacion_360_new.php" class="boton">
Version Español</a>
</td>
            </tr>

          </table>
        </td>
      </tr>
      <tr>
        <td height="698" valign="top" background="">
          <table width="900" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
              <td><img src="images/spacer.gif" width="10" height="20" /></td>
            </tr>
            <tr>
              <td>
                <div align="center">
                  <table width="850" border="0" cellspacing="7" cellpadding="0">
                    <tr>
                      <td>
                        <div align="center" class="text_grande style1" style="color:#f00; !important">Welcome to the 360 ​​° evaluation </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div align="center" class="text_mediano"><span class="texto_contenido2">In the following survey you will have the opportunity to identify and evaluate the behaviors of your colleagues (Collaterals, Clients, Collaborators and Direct Boss) as well as yourself.</span></div>
                      </td>
                    </tr>
                  </table>
                </div>
              </td>
            </tr>
            <tr>
              <td><img src="images/spacer.gif" width="10" height="20" /></td>
            </tr>
            <tr>
              <td><img src="images/spacer.gif" width="10" height="10" /></td>
            </tr>
            <tr>
              <td>
                <table width="844" border="0" align="center" cellpadding="0" cellspacing="0">
                  <tr>
                    <td height="250" valign="top" bgcolor="#eeeeee">
                      <table width="920" border="0" align="center" cellspacing="0">
                        <tr>
                          <td width="556" valign="top">
                            <table width="356" border="0" align="center" cellspacing="0">
                              <tr>
                                <td height="27" class="texto_contenido">
                                  <p>Evaluated:</p>
                                </td>
                                <td class="texto_contenido">&nbsp;</td>
                              </tr>
                              <?
		$consulta  = "select usuarios.nombre, usuarios.id, evaluadores.evaluado from  usuarios inner join evaluadores on  usuarios.id=evaluadores.id_evaluado  where evaluadores.id_evaluador=$idU and evaluadores.revision=$revision order by nombre"; //
		$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1:$consulta ". mysqli_error($enlace) );//. mysqli_error($enlace)
		$count=1;
		while(@mysqli_num_rows($resultado)>=$count)
		{
			$res=mysqli_fetch_row($resultado);

		?>
                              <tr>
                                <td width="67%" class="text_mediano">
                                  <? echo"$res[0]"?>
                                </td>

                                <td width="33%" bgcolor="#FFFFFF" class="text_mediano">
                                  <div align="center">
                                    <? if($res[2]=="0"){?>
                                    <a href="javascript:evaluar(<?echo $res[1];?>);"><img src="images/evaluar.jpg"
                                        alt="Por Evaluar" width="23" height="27" border="0" /></a>
                                    <? }else{?><img src="images/evaluado.jpg" alt="Evaluado" width="23" height="27" />
                                    <? }?>
                                  </div>
                                </td>
                              </tr>
                              <?
		$count++;
		}
		?>
                            </table>
                          </td>
                          <td width="360" valign="middle">
                            <div align="center"><span class="style5">
                                <input name="siguiente" type="hidden" id="siguiente" value="1" />

                              </span><span class="style5">
                                <input name="id_evaluado" type="hidden" id="id_evaluado" />
                              </span></div>
                          </td>
                        </tr>
                        <tr>
                          <td colspan="2" valign="top">
                            <div align="center">
                              <p align="left" class="texto_contenido2">The evaluation is based on the competencies that make up each of our Bell values ​​that applies to all people.</p>
                              <p align="left" class="texto_contenido2">A competence is the set of knowledge, skills and attitudes expected in the people who collaborate in the organization.</p>
                              <table width="94%" border="0" cellspacing="3" cellpadding="0">
                                <tr>
                                  <td width="59%">
                                    <table width="85%" border="0" align="center" cellpadding="0">
                                     <tr>
                                        <td width="41%"><img src="images/valore_y_competencias_timpmp_eng.png" height="400" /></td>
                                      </tr>
                                    </table>
                                  </td>
                                  <!-- <td width="41%"><img src="images/modelo.png" height="400" /></td> -->
                                </tr>
                              </table>
                              <!-- <p align="center" class="texto_contenido2"><br />
                                Eval&uacute;a de manera l&oacute;gica y bas&aacute;ndose en comportamientos actuales, no
                                en experiencias pasadas. </p> -->
                            </div>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td><img src="images/spacer.gif" width="10" height="50" /></td>
            </tr>
            <tr>
              <td>
                <table width="350" border="0" align="center" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="145"></td>
                    <td><img src="images/spacer.gif" width="16" height="20" /></td>
                    <td width="114"></td>
                    <td><img src="images/spacer.gif" width="17" height="20" /></td>
                    <td><a href="logout.php" onmouseout="MM_swapImgRestore()"
                        onmouseover="MM_swapImage('Image25','','images/b_log_out_r.png',1)"><img
                          src="images/b_log_out.png" name="Image25" width="71" height="23" border="0"
                          id="Image25" /></a></td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>

  </form>
</body>

</html>
