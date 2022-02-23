<?php
session_start();
date_default_timezone_set("America/Chihuahua");
setlocale(LC_TIME, 'es_MX.UTF-8');
include "checar_sesion_admin.php";
include "coneccion_i.php";
$id_usuario = $_SESSION['idU'];
$mes = date("n");

$consulta_etapa = "SELECT revision, etapa from etapa where id=1";
$resultado_etapa = mysqli_query($enlace,$consulta_etapa) or die("La consulta 1 fall&oacute;P1:$consulta_etapa" . mysqli_error($enlace));
if (@mysqli_num_rows($resultado_etapa) >= 1) {
    $res_etapa = mysqli_fetch_row($resultado_etapa);
    if ($_GET['revision'] == '') {
        $revision = $res_etapa[0];
    } else {
        $revision = $_GET['revision'];
    }
    $etapa = $res_etapa[1];
}

$consulta_datos = "SELECT nombre, puesto, DATE_FORMAT(fecha_contratacion,'%d-%m-%Y'), DATEDIFF( NOW() , fecha_contratacion ), id_jefe from usuarios where id=$id_usuario";
$resultado_datos = mysqli_query($enlace,$consulta_datos) or die("La consulta 2 fall&oacute;P1:$consulta_datos  " . mysqli_error($enlace));
if (@mysqli_num_rows($resultado_datos) >= 1) {
    $res_datos = mysqli_fetch_row($resultado_datos);
    $nombre = $res_datos[0];
    $puesto = $res_datos[1];
    $jefe = $res_datos[4];
    $contratacion = $res_datos[2];
    $tiempo = round($res_datos[3] / 364, 0);
}

$consulta_nombre = "SELECT nombre from usuarios where id=$jefe";
$resultado_nombre = mysqli_query($enlace,$consulta_nombre) or die("La consulta 3 fall&oacute;P1:$consulta_nombre  " . mysqli_error($enlace)); //. mysqli_error($enlace)
if (@mysqli_num_rows($resultado_nombre) >= 1) {
    $res_nombre = mysqli_fetch_row($resultado_nombre);
    $manager = $res_nombre[0];
}

if ($_POST['guardar'] == ".") {
    $consulta_plan_desarrollo = "SELECT * from plan_desarrollo where id_usuario=$id_usuario and revision=$revision";
    $resultado_plan_desarrollo = mysqli_query($enlace,$consulta_plan_desarrollo) or die("La consulta 4 fall&oacute;P1:$consulta_plan_desarrollo" . mysqli_error($enlace));
    if (@mysqli_num_rows($resultado_plan_desarrollo) >= 1) {
        $actualiza_plan_desarrollo = "update plan_desarrollo set goal='" . $_POST['goal'] . "', competency='" . $_POST['competency'] . "', competency2='" . $_POST['competency2'] . "', indicator='" . $_POST['indicator'] . "', otro='" . $_POST['otro'] . "', otro2='" . $_POST['otro2'] . "' where id_usuario=$id_usuario and revision=$revision ";
        $resultado_actualiza_plan_desarrollo = mysqli_query($enlace,$actualiza_plan_desarrollo) or die("La consulta 5 fall&oacute;P1:$actualiza_plan_desarrollo" . mysqli_error($enlace));
        echo "<script>window.location=\"planes.php\"</script>";
    } else {
        $insert_plan_desarrollo = "insert into plan_desarrollo  (id_usuario, revision, goal, indicator, competency, competency2, otro, otro2) values($id_usuario, $revision, '" . $_POST['goal'] . "', '" . $_POST['indicator'] . "', '" . $_POST['competency'] . "', '" . $_POST['competency2'] . "', '" . $_POST['otro'] . "', '" . $_POST['otro2'] . "')";
        $resultado_insert_plan_desarrollo = mysqli_query($enlace,$insert_plan_desarrollo) or die("La consulta 6 fall&oacute;P1:$insert_plan_desarrollo" . mysqli_error($enlace));
        echo "<script>window.location=\"planes.php\"</script>";
    }
}

if ($_POST['agregar'] == "Agregar") {

    $consulta2 = "insert into acciones  (id_usuario, revision, id_competencia, accion, mes, tipo) values($id_usuario, $revision, '" . $_POST['id_competencia'] . "', '" . $_POST['accion'] . "', '" . $_POST['mes'] . "', '" . $_POST['tipo'] . "')";
    $resultado2 = mysqli_query($enlace,$consulta2) or die("La consulta fall&oacute;P1:$consulta2  " . mysqli_error($enlace));
    echo "<script>window.location=\"planes.php\"</script>";

}

if ($_POST['guardar2'] == ".") {

    $id_accion = $_POST['id_accion'];
    $count = 0;

    foreach ($id_accion as $i) {

        $nuevoC = $_POST['comentarios'][$count];
        $nuevoT = $_POST['terminado'][$count];
        $nuevoE = $_POST['entiempo'][$count];

        $consulta2 = "update acciones set comentarios='$nuevoC', terminado='$nuevoT', entiempo='$nuevoE' where id=$i";
        $resultado2 = mysqli_query($enlace,$consulta2) or die("$consulta2");
        //echo $consulta2;

        $count++;
    }
    $consulta2 = "update plan_desarrollo set sumary='" . $_POST['sumary'] . "', aspecto='" . $_POST['aspecto'] . "', meta='" . $_POST['meta'] . "', entregable='" . $_POST['entregable'] . "' where id_usuario=$id_usuario and revision=$revision ";
    $resultado2 = mysqli_query($enlace,$consulta2) or die("$consulta2");

    echo "<script>window.location=\"planes.php\"</script>";

}

$consulta = "SELECT * from plan_desarrollo where id_usuario=$id_usuario and revision=$revision";
$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1:$consulta  " . mysqli_error($enlace)); //. mysqli_error($enlace)
$res = mysqli_fetch_assoc($resultado);

if ($revision <= 2019) {
    if ($res['competency'] != "") {
        $consulta2 = "SELECT * from competencias where id={$res['competency']}";
        $resultado2 = mysqli_query($enlace,$consulta2) or die("La consulta fall&oacute;P1:$consulta2  " . mysqli_error($enlace)); //. mysqli_error($enlace)
        $res2 = mysqli_fetch_assoc($resultado2);
    }
    if ($res['competency2'] != "") {
        $consulta3 = "SELECT * from competencias where id={$res['competency2']}";
        $resultado3 = mysqli_query($enlace,$consulta3) or die("La consulta fall&oacute;P1:$consulta3  " . mysqli_error($enlace)); //. mysqli_error($enlace)
        $res3 = mysqli_fetch_assoc($resultado3);
    }
} else {
    if ($res['competency'] != "") {
        $consulta2 = "SELECT * from new_competencias where id={$res['competency']}";
        $resultado2 = mysqli_query($enlace,$consulta2) or die("La consulta fall&oacute;P1:$consulta2  " . mysqli_error($enlace)); //. mysqli_error($enlace)
        $res2 = mysqli_fetch_assoc($resultado2);
    }
    if ($res['competency2'] != "") {
        $consulta3 = "SELECT * from new_competencias where id={$res['competency2']}";
        $resultado3 = mysqli_query($enlace,$consulta3) or die("La consulta fall&oacute;P1:$consulta3  " . mysqli_error($enlace)); //. mysqli_error($enlace)
        $res3 = mysqli_fetch_assoc($resultado3);
        if ($res['competency2'] == 6) {
            $desc_competencia = $res3['e1_descripcion'];
        } else {
            $desc_competencia = $res3['c_1'] . ', ' . $res3['c_2'] . ', ' . $res3['c_3'] . ', ' . $res3['c_4'] . ', ' . $res3['c_5'];
        }
    }
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Bell</title>
<style type="text/css">

body {
				margin-left: 0px;
				margin-top: 0px;
				margin-right: 0px;
				margin-bottom: 0px;
				background-image: url();
				background-color: #E5E5E5;
			}
.texto_rojo {
	color: #F00;
}
.texto_verde {
	color: #060;
}
.texto_azul {
	color: #009;
}
.style3 { font-size: 24px; color: #013098}

.miboton{
width:150px;
height:23px;
background:url("images/b_guardarn.png");

}

</style>
<link href="images/textos.css" rel="stylesheet" type="text/css" />
<link type="text/css" href="css/smoothness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />
<link rel="stylesheet" href="colorbox.css" />
<script type="text/javascript" src="js/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.16.custom.min.js"></script>
<script src="colorbox/jquery.colorbox-min.js"></script>

<SCRIPT>
	$(document).ready(function(){
		$(".iframe2").colorbox({iframe:true,width:"450", height:"320",transition:"fade", scrolling:false, opacity:0.1});
		$(".iframe1").colorbox({iframe:true,width:"500", height:"320",transition:"fade", scrolling:true, opacity:0.7});
		$("#click").click(function(){
			$('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
			return false;
		});
	});

	$(function() {
		$( "#fecha_term" ).datepicker({ dateFormat: 'yy-mm-dd' });
		$( "#fecha_term2" ).datepicker({ dateFormat: 'yy-mm-dd' });
		$( "#fecha_term3" ).datepicker({ dateFormat: 'yy-mm-dd' });
		$( "#fecha_term4" ).datepicker({ dateFormat: 'yy-mm-dd' });
		$( "#fecha_term5" ).datepicker({ dateFormat: 'yy-mm-dd' });
		$( "#fecha_term6" ).datepicker({ dateFormat: 'yy-mm-dd' });

		$( "#inicio1" ).datepicker({ dateFormat: 'dd-mm-yy' });
		$( "#fin1" ).datepicker({ dateFormat: 'dd-mm-yy' });
		$( "#inicio2" ).datepicker({ dateFormat: 'dd-mm-yy' });
		$( "#fin2" ).datepicker({ dateFormat: 'dd-mm-yy' });
		$( "#inicio3" ).datepicker({ dateFormat: 'dd-mm-yy' });
		$( "#fin3" ).datepicker({ dateFormat: 'dd-mm-yy' });
		$( "#inicio4" ).datepicker({ dateFormat: 'dd-mm-yy' });
		$( "#fin4" ).datepicker({ dateFormat: 'dd-mm-yy' });
		$( "#inicio5" ).datepicker({ dateFormat: 'dd-mm-yy' });
		$( "#fin5" ).datepicker({ dateFormat: 'dd-mm-yy' });
		$( "#inicio6" ).datepicker({ dateFormat: 'dd-mm-yy' });
		$( "#fin6" ).datepicker({ dateFormat: 'dd-mm-yy' });
	});
	</SCRIPT>
<script type="text/javascript">
function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}



function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}





function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}


function eliminar(id){
        if(confirm('Deseas eliminar?')){
            var elem = document.createElement('input');
            elem.name='id';
            elem.value = id;
            elem.type = 'hidden';
            $("#form3").append(elem);

            $("#form3").attr('action','elimina_accion.php');
            $("#form3").submit();
        }
    }
// submit con revision del select revision.
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}

</script>

</head>
<body>
<!---->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
  <td background="images/Header_bkg.png"><table width="900" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td><div align="center"><a href="menu.php"><img src="images/header_logo.png" width="210" height="175" border="0" /></a></div></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="698" valign="top" background=""><table width="900" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td><div align="right"><a href="menu.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image30','','images/b_inicio.png',1)"><img src="images/b_inicio.png" name="Image30" width="58" height="23" border="0" id="Image30" /></a><a href="menu.php" class="boton"></a><img src="images/spacer.gif" width="56" height="19" /></div></td>
      </tr>

      <tr>
        <td><table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td height="250" valign="top" bgcolor="#eeeeee"><table width="800" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td><img src="images/spacer.gif" width="10" height="20" /></td>
              </tr>
              <tr>
                <td><table width="900" border="0" cellspacing="3" cellpadding="0">
                    <tr>
                      <td colspan="2" align="center" class="style3">Individual Development Plan</td>
                    </tr>
                    <tr>
                      <td width="237" class="tit_1">Name: <span class="texto_tareas"><? echo $nombre?></span></td>
                      <td width="237" class="tit_1">Manager: <span class="texto_tareas"><? echo $manager?></span></td>
                    </tr>
                    <tr>
                      <td class="tit_1">Time in present position: <span class="texto_tareas"><? echo $tiempo?></span></td>
                      <td class="tit_1">Date of Plan: <span class="texto_tareas"><? echo $revision?></span></td>
                    </tr>
                    <tr>
                      <td colspan="2" class="tit_1">&nbsp;</td>
                      </tr>
                    <tr>
                      <td colspan="2" class="tit_1" align="center">
                        <table width="50%" border="0" cellspacing="0" cellpadding="0" align="center">
                          <tr>
                            <td align="center">Revision
                              <select name="revision"  class="texto_tareas" style="width:120px" id="revision" onchange="MM_jumpMenu('window',this,0)">
                          	    <option value="">--Select--</option>
                                <?
                                  $query32 = "SELECT revision FROM plan_desarrollo group by revision union select revision from etapa";
                                  $result32 = mysqli_query($enlace,$query32) or print("<option value=\"ERROR\">".mysqli_error($enlace)."</option>");
                                  while($revs = mysqli_fetch_assoc($result32)){
							                  ?>
                                    <option value="planes.php?revision=<? echo $revs['revision']?>" <? echo $revision==$revs['revision']?"selected":"";?>><? echo $revs['revision']?></option>
                                <?
                                  }
                                ?>
                              </select>
                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table></td>
              </tr>

            </table>

              <table width="753" border="0" align="center" cellpadding="0" cellspacing="0">

                <tr>
                  <td><img src="images/spacer.gif" width="10" height="20" /></td>
                </tr>

                <tr>
                  <td><table width="900" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="350" valign="top"><table width="900" border="0" cellspacing="0" cellpadding="0">

							<form method="post" name="form1" id="form1" action="">
							<script type="text/javascript">


              <?
              if ($revision <= 2019) {

              ?>
						    function cambiar1(e){
						      <?
                  $consulta10="SELECT * from competencias where revision=$revision order by id";
                  $resultado10=mysqli_query($enlace,$consulta10) or die("La consulta fall&oacute;P1:$consulta10".mysqli_error($enlace));
                  $count3=1;
                  while($res10=mysqli_fetch_assoc($resultado10)){
                  ?>
                    if(e==<?echo $res10['id'];?>){
                    var element=document.getElementById("celda1").style;
                    if(e==72){
                      document.getElementById('celda1').innerHTML='<b>Describe the Competency:</b> <textarea name="otro" cols="55" rows="3" class="texto_tareas"><? echo $res['otro']?></textarea>';
                      }else{
                      document.getElementById('celda1').innerHTML='<b>Description:</b> <? echo $res10['descripcion']?>';
                      }

                    }
                  <?
                    $count3++; }
                  ?>
                }
              <?
              }
              ?>

function cambiar2(e){
  <?
    if ($revision <= 2019) {
      $consulta10  = "SELECT * from competencias where revision=$revision order by id";
      $resultado10 = mysqli_query($enlace,$consulta10) or die("La consulta fall&oacute;P1:$consulta10  ". mysqli_error($enlace) );//. mysqli_error($enlace)
      $count2=1;
      while($res10=mysqli_fetch_assoc($resultado10)){
	?>
        if(e==<? echo $res10['id']?>){
        var element = document.getElementById("celda2").style;
        //element.background = '#FF0000';
          if(e==72){
          document.getElementById('celda2').innerHTML='<b>Describe the Competency:</b> <textarea name="otro2" cols="55" rows="3" class="texto_tareas"><? echo $res['otro2']?></textarea>';
          }else{
          document.getElementById('celda2').innerHTML='<b>Description:</b> <? echo $res10['descripcion']?>';
          }
        }
  <?
        $count2++;
      }
    }else{

  ?>
      $("#celda2").load("llenardescripcion.php?id="+e);
  <?
    }
  ?>
}
						   </script>
                            <tr>
                              <td><img src="images/spacer.gif" width="10" height="20" /></td>
                            </tr>
                            <tr>
                              <td><table width="450" border="0" cellspacing="0" cellpadding="0"  background="images/tit_sin_nada.jpg">
                            <tr>
                              <td width="10"><img src="images/spacer.gif" width="15" height="28" /></td>
                              <td class="text_mediano_blanco">Values:</td>
                            </tr>
                        </table></td>
                            </tr>
                            <tr>
                              <td><img src="images/spacer.gif" width="10" height="20" /></td>
                            </tr>
                            <tr>
                              <td>
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="30%">
                                      <select name="competency"  class="texto_tareas" style="width:150px" id="competency" required onchange="cambiar1(this.value);">
                                        <option value="" <?echo $revision >= 2020?"disabled":"";?> >--Select--</option>
                                        <?
                                          if ($revision <= 2019) {
                                            $consulta4="select * from competencias where revision=$revision order by id";
                                            $resultado4 = mysqli_query($enlace,$consulta4) or die("$consulta4  ". mysqli_error($enlace) );
                                            while($res4=mysqli_fetch_assoc($resultado4)){
                                        ?>
                                              <option value="<? echo $res4['id']?>" <? echo $res2['id']==$res4['id']?"selected":"";?>><? echo $res4['competencia']?></option>
                                        <?
                                            }
                                          }else{
                                            $new_revision = $revision-1;
                                            $consulta4 = "select new_competencias.id,new_competencias.e1 AS competencia,new_competencias.c_1,new_competencias.c_2,new_competencias.c_3,new_competencias.c_4,new_competencias.c_5,min(round(r1.resultadon*150,1)) as rn from new_resultados as r1 inner join new_competencias on r1.id_numero=new_competencias.id where r1.id_evaluado=$id_usuario and revision=$new_revision AND round(r1.resultadon*150,1) = (select min(round(r1.resultadon*150,1)) as rn from new_resultados as r1 inner join new_competencias on r1.id_numero=new_competencias.id where r1.id_evaluado=$id_usuario and revision=$new_revision)";
                                            $resultado4 = mysqli_query($enlace,$consulta4) or die("$consulta4  ". mysqli_error($enlace) );
                                            $count = mysqli_num_rows($resultado4);
                                            $res4=mysqli_fetch_assoc($resultado4);
                                            $flag = $res4["id"];

                                            // echo "<script>alert('".gettype($flag)."');</script>";
                                            //var_dump($res413["id"]);
                                            if ($flag != NULL) {
                                              // echo "<script>alert('1');</script>";
                                              $consulta5 = "select new_competencias.id,new_competencias.e1 AS competencia,new_competencias.c_1,new_competencias.c_2,new_competencias.c_3,new_competencias.c_4,new_competencias.c_5,min(round(r1.resultadon*150,1)) as rn from new_resultados as r1 inner join new_competencias on r1.id_numero=new_competencias.id where r1.id_evaluado=$id_usuario and revision=$new_revision AND round(r1.resultadon*150,1) = (select min(round(r1.resultadon*150,1)) as rn from new_resultados as r1 inner join new_competencias on r1.id_numero=new_competencias.id where r1.id_evaluado=$id_usuario and revision=$new_revision)";
                                              $resultado5 = mysqli_query($enlace,$consulta5) or die("$consulta5  ". mysqli_error($enlace) );
                                              $res5=mysqli_fetch_assoc($resultado5);
                                              $descripcion = $res5['c_1'].', '.$res5['c_2'].', '.$res5['c_3'].', '.$res5['c_4'].', '.$res5['c_5'];

                                                ?>
                                                  <option value="<? $res5['id'];?>" selected><? echo $res5['competencia'];?></option>
                                                <?

                                            }else {
                                              $consulta123 = "SELECT * FROM new_competencias WHERE id=6";
                                              $resultado123 = mysqli_query($enlace,$consulta123) or die("$consulta123  ". mysqli_error($enlace) );
                                              $res123 = mysqli_fetch_assoc($resultado123);
                                              $descripcion = $res123['e1_descripcion'];
                                              $r = $res123['id'];
                                              $com = $res123['e1'];
                                              ?>
                                                <option value="<? echo $r?>" selected><? echo $com?></option>
                                              <?
                                            }
                                          }
                                        ?>
                                      </select>
                                    </td>
                                    <td width="70%" class="texto_tareas" id="celda1"><b>Description:</b> <? if($res['competency']==72){echo $res['otro']; }else{ if($revision<=2019){echo $res2['descripcion'];}else{echo $descripcion;}}?></td>
                                  </tr>
                                </table></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td>
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="30%">
                                      <select name="competency2"  class="texto_tareas" style="width:150px" id="competency2" required onChange="cambiar2(this.value);">
                          	            <option value="">--Select--</option>
                                        <?
                                          if ($revision <= 2019) {
                                            $consulta4="select * from competencias where revision=$revision order by id";
                                            $resultado4 = mysqli_query($enlace,$consulta4) or die("$consulta4  ". mysqli_error($enlace) );
                                            while($res4=mysqli_fetch_assoc($resultado4)){
                                        ?>
                                              <option value="<? echo $res4['id']?>" <? echo $res2['id']==$res4['id']?"selected":"";?>><? echo $res4['competencia']?></option>
                                        <?
                                            }
                                          }else{
                                            $new_revision = $revision-1;
                                            $consulta4 = "select new_competencias.id,new_competencias.e1 AS competencia FROM new_competencias";
                                            $resultado4 = mysqli_query($enlace,$consulta4) or die("$consulta4  ". mysqli_error($enlace) );
                                            while($res4=mysqli_fetch_assoc($resultado4)){
                                        ?>
                                              <option value="<? echo $res4['id']?>" <?echo $res3['id']==$res4['id']?'selected':'';?>><? echo $res4['competencia']?></option>
                                        <?
                                            }
                                          }
                                        ?>
                                      </select>
                                    </td>
                                    <td width="70%" class="texto_tareas" id="celda2"><b>Description:</b> <? if($res['competency']==72){echo $res['otro2']; }else{ if($revision<=2019){echo $res3['descripcion'];}else{echo $desc_competencia;}}?></td>
                                  </tr>
                                </table></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td class="texto_tareas">&nbsp;</td>
                            </tr>
                            <tr>
                              <td><img src="images/spacer.gif" width="10" height="20" /></td>
                            </tr>
                            <tr>
                              <td><table width="450" border="0" cellspacing="0" cellpadding="0"  background="images/tit_sin_nada.jpg">
                            <tr>
                              <td width="10"><img src="images/spacer.gif" width="15" height="28" /></td>
                              <td class="text_mediano_blanco">Goal:</td>
                            </tr>
                        </table></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td><textarea name="goal" cols="85" rows="4" class="texto_tareas"><? echo $res['goal']?></textarea></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td><table width="450" border="0" cellspacing="0" cellpadding="0"  background="images/tit_sin_nada.jpg">
                            <tr>
                              <td width="10"><img src="images/spacer.gif" width="15" height="28" /></td>
                              <td class="text_mediano_blanco">Indicator:</td>
                            </tr>
                        </table></td>
                            </tr>
                            <tr>
                              <td><img src="images/spacer.gif" width="10" height="20" /></td>
                            </tr>
                            <tr>
                              <td><textarea name="indicator" cols="85" rows="4" class="texto_tareas"><? echo $res['indicator']?></textarea></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                            </tr>

                            <tr>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td align="center"><input type="submit" name="guardar" id="guardar" value="." class="miboton"></td>
                            </tr>
							</form>
							<? if(@mysqli_num_rows($resultado)>0){?>
                            <tr>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td><table width="450" border="0" cellspacing="0" cellpadding="0"  background="images/tit_sin_nada.jpg">
                            <tr>
                              <td width="10"><img src="images/spacer.gif" width="15" height="28" /></td>
                              <td class="text_mediano_blanco">Actions:</td>
                            </tr>
                        </table></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                            </tr>
							<form method="post" name="form2" action="">
                            <tr>
                              <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="24%" class="tit_1" bgcolor="#ced0d1">Competency</td>
                                  <td width="32%" class="tit_1" bgcolor="#ced0d1">Action</td>
                                  <td width="19%" class="tit_1" bgcolor="#ced0d1">Type</td>
                                  <td width="17%" class="tit_1" bgcolor="#ced0d1">Month</td>
                                  <td width="8%">&nbsp;</td>
                                </tr>

                                <tr>
                                  <td><select name="id_competencia"  class="texto_tareas" style="width:150px" id="id_competencia" required>
                          	<option value="">--Select--</option>
                          	<?
							$consulta40="select * from competencias where revision=$revision order by id";
							$resultado40 = mysqli_query($enlace,$consulta40) or die("$consulta40  ". mysqli_error($enlace) );
							while($res40=mysqli_fetch_assoc($resultado40)){
							?>
							<option value="<? echo $res40['id']?>"><? echo $res40['competencia']?></option>
							<?
							}
							?>
                        </select></td>
                                  <td><textarea name="accion" cols="30" rows="4" class="texto_tareas" required></textarea></td>
                                  <td><select name="tipo"  class="texto_tareas" style="width:120px" id="tipo" required>
                          	<option value="">--Select--</option>
                          	<option value="70 - Learning by doing">70 - Learning by doing</option>
							<option value="20 - Learning from Others">20 - Learning from Others</option>
							<option value="10 - Learning from Courses & Materials">10 - Learning from Courses & Materials</option>
                        </select></td>
                                  <td><select name="mes"  class="texto_tareas" style="width:120px" id="mes" required>
                          	<option value="">--Select--</option>
                                <? $query2 = "SELECT * FROM meses order by id";
                            $result2 = mysqli_query($enlace,$query2) or print("<option value=\"ERROR\">".mysqli_error($enlace)."</option>");
                            while($meses = mysqli_fetch_assoc($result2)){
							?>
                          <option value="<? echo $meses['id']?>"><? echo $meses['nombre']?></option>
                          <?
                            }
                            ?>
                        </select></td>
                                  <td align="center"><input type="submit" name="agregar" id="agregar" value="Agregar" class="boton"></td>
                                </tr>
                              </table></td>
                            </tr>
							</form>
                            <tr>
                              <td>&nbsp;</td>
                            </tr>
							<tr>
                              <td>&nbsp;</td>
                            </tr>
							<form method="post" name="form3" id="form3" action="">
							<tr>
                              <td><table width="100%" border="0" cellspacing="0" cellpadding="1">
                                <tr bgcolor="#ced0d1">
                                  <td width="20%" class="tit_1">Competency</td>
                                  <td width="20%" class="tit_1">Action</td>
								  <td width="10%" class="tit_1">Type</td>
                                  <td width="10%" class="tit_1" align="center">Month</td>
                                  <td width="20%" class="tit_1">Comments</td>
                                  <td width="5%" class="tit_1" align="center">Finished</td>
                                  <td width="10%" class="tit_1" align="center">On time</td>
                                  <td width="5%" class="tit_1">&nbsp;</td>
                                </tr>
								<?
								$consulta5="select * from acciones where id_usuario=$id_usuario and revision=$revision and terminado=0 order by mes, tipo";
								$resultado5 = mysqli_query($enlace,$consulta5) or die("La consulta fall&oacute;P1:$consulta5  ". mysqli_error($enlace) );//. mysqli_error($enlace)
								$CONTADOR=0;
								while($res5=mysqli_fetch_assoc($resultado5)){

								$consulta30="select * from competencias where id={$res5['id_competencia']}";
								$resultado30 = mysqli_query($enlace,$consulta30) or die("$consulta30  ". mysqli_error($enlace) );
								$res30=mysqli_fetch_assoc($resultado30);

								if($res5['mes']!=""){
								$consulta40="select * from meses where id={$res5['mes']}";
								$resultado40 = mysqli_query($enlace,$consulta40) or die("$consulta40  ". mysqli_error($enlace) );
								$res40=mysqli_fetch_assoc($resultado40);
								}
								?>
                                <tr>
                                 <td class="texto_tareas"><a href="editar_accion.php?id=<? echo $res5['id']?>&revision=<? echo $revision?>" class="texto_tareas iframe1"><? echo $res30['competencia']?></a></td>
                                  <td class="texto_tareas"><a href="editar_accion.php?id=<? echo $res5['id']?>&revision=<? echo $revision?>" class="texto_tareas iframe1"><? echo $res5['accion']?></a></td>
								  <td class="texto_tareas"><a href="editar_accion.php?id=<? echo $res5['id']?>&revision=<? echo $revision?>" class="texto_tareas iframe1"><? echo $res5['tipo']?></a></td>
                                  <td class="texto_tareas" align="center"><a href="editar_accion.php?id=<? echo $res5['id']?>&revision=<? echo $revision?>" class="texto_tareas iframe1"><? echo $res40['nombre']?></a></td>
                                  <td><textarea name="comentarios[<? echo $CONTADOR?>]" cols="25" rows="4" class="texto_tareas"><? echo $res5['comentarios']?></textarea></td>
                                  <td align="center"><input type="checkbox" name="terminado[<? echo $CONTADOR?>]" value="1" <? if($res5['terminado']=="1"){ echo"checked";}?>> <input type="hidden" name="id_accion[]" value="<? echo $res5['id']?>"></td>
                                  <td align="center" class="texto_tareas">Yes <input type="radio" name="entiempo[<? echo $CONTADOR?>]" value="1" <? if($res5['entiempo']=="1"){ echo"checked";}?> ><br/>
								  					 No <input type="radio" name="entiempo[<? echo $CONTADOR?>]" value="0" <? if($res5['entiempo']=="0"){ echo"checked";}?>>								  </td>
                                  <td align="center"><a href="javascript:eliminar(<? echo $res5['id']?>);"><img src="images/eliminar.png" width="20px" height="20px" border="0" title="Eliminar"/></a></td>
                                </tr>

								<?
								$CONTADOR++;
								}
								?>
                              </table></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td class="style3">Action history</td>
                            </tr>
                            <tr>
                              <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="1">
                                <tr bgcolor="#ced0d1">
                                  <td width="15%" class="tit_1">Competency</td>
                                  <td width="25%" class="tit_1">Action</td>
								  <td width="10%" class="tit_1">Type</td>
                                  <td width="10%" class="tit_1" align="center">Month</td>
                                  <td width="25%" class="tit_1">Comments</td>
                                  <td width="5%" class="tit_1" align="center">Finished</td>
                                  <td width="10%" class="tit_1" align="center">On time</td>
                                </tr>
								<?
								$consulta55="select * from acciones where id_usuario=$id_usuario and revision=$revision and terminado=1 order by mes, tipo";
								$resultado55 = mysqli_query($enlace,$consulta55) or die("La consulta fall&oacute;P1:$consulta55  ". mysqli_error($enlace) );//. mysqli_error($enlace)
								$CONTADOR5=0;
								while($res55=mysqli_fetch_assoc($resultado55)){

								$consulta301="select * from competencias where id={$res55['id_competencia']}";
								$resultado301 = mysqli_query($enlace,$consulta301) or die("$consulta301  ". mysqli_error($enlace) );
								$res301=mysqli_fetch_assoc($resultado301);

								$consulta401="select * from meses where id={$res55['mes']}";
								$resultado401 = mysqli_query($enlace,$consulta401) or die("$consulta401  ". mysqli_error($enlace) );
								$res401=mysqli_fetch_assoc($resultado401);
								?>
                                <tr>
                                 <td class="texto_tareas"><? echo $res301['competencia']?></td>
                                  <td class="texto_tareas"><? echo $res55['accion']?></td>
								  <td class="texto_tareas"><? echo $res55['tipo']?></td>
                                  <td class="texto_tareas" align="center"><? echo $res401['nombre']?></td>
                                  <td class="texto_tareas"><? echo $res55['comentarios']?></td>
                                  <td align="center"><input type="checkbox" name="terminado2[<? echo $CONTADOR5?>]" value="1" <? if($res55['terminado']=="1"){ echo"checked";}?>></td>
                                  <td align="center" class="texto_tareas"><? if($res55['entiempo']=="1"){echo"Yes";}else{echo"No";}?></td>
                                </tr>

								<?
								$CONTADOR5++;
								}
								?>
                              </table></td>
                            </tr>
                            <tr>
                              <td align="center">&nbsp;</td>
                            </tr>
							<? if($revision<2018){?>
							<tr>
							  <td><table width="450" border="0" cellspacing="0" cellpadding="0"  background="images/tit_sin_nada.jpg">
                            <tr>
                              <td width="10"><img src="images/spacer.gif" width="15" height="28" /></td>
                              <td class="text_mediano_blanco">Proyecto:</td>
                            </tr>
                        </table></td>
							  </tr>
							<tr>
							  <td>&nbsp;</td>
							  </tr>
							<tr>
							  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="28%" class="tit_1">Aspecto a desarrollar: </td>
    <td width="72%"><input type="text" name="aspecto" class="texto_tareas" style="width:405px"  value="<? echo $res['aspecto']?>"></td>
  </tr>
  <tr>
    <td class="tit_1">Meta:</td>
    <td><textarea name="meta" cols="55" rows="3" class="texto_tareas"><? echo $res['meta']?></textarea></td>
  </tr>
   <tr>
    <td class="tit_1">Entregable:</td>
    <td><textarea name="entregable" cols="55" rows="3" class="texto_tareas"><? echo $res['entregable']?></textarea></td>
  </tr>
</table></td>
							  </tr>
							<tr>
							  <td>&nbsp;</td>
							  </tr>
							<? }?>

							<tr>
                              <td><table width="450" border="0" cellspacing="0" cellpadding="0"  background="images/tit_sin_nada.jpg">
                            <tr>
                              <td width="10"><img src="images/spacer.gif" width="15" height="28" /></td>
                              <td class="text_mediano_blanco">Summary of progress (Empleado):</td>
                            </tr>
                        </table></td>
                            </tr>
                            <tr>
                              <td class="texto_tareas">•	Describe las áreas de oportunidad en las competencias identificadas<br/>
•	¿Cuál fue el aprendizaje adquirido durante tu IDP?<br/>
•	¿Qué cambios has observado en ti mismo, a partir de estas acciones?
</td>
                            </tr>
                            <tr>
                              <td><textarea name="sumary" cols="85" rows="4" class="texto_tareas"><? echo $res['sumary']?></textarea></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td><table width="450" border="0" cellspacing="0" cellpadding="0"  background="images/tit_sin_nada.jpg">
                            <tr>
                              <td width="10"><img src="images/spacer.gif" width="15" height="28" /></td>
                              <td class="text_mediano_blanco">Validation of Training and Improvement (Jefe):</td>
                            </tr>
                        </table></td>
                            </tr>
                            <tr>
                              <td class="texto_tareas">Describe:<br/>
•	¿Cumplieron las expectativas de mejora, las acciones identificadas?<br/>
•	Menciona ejemplos de cómo aplicó las mejoras en estas competencias.<br/>
•	¿Cómo contribuyeron las acciones y cuál fue el mayor cambio observado?</td>
                            </tr>
							<tr>
                              <td><textarea name="sumary_j" cols="85" rows="4" class="texto_tareas" readonly><? echo $res['sumary_j']?></textarea></td>
                            </tr>
                            <tr>
                              <td align="center">&nbsp;</td>
                            </tr>
                            <tr>
                              <td align="center"><input type="submit" name="guardar2" id="guardar2" value="." class="miboton"></td>
                            </tr>
							</form>
                            <tr>
                              <td>&nbsp;</td>
                            </tr>
							<? }?>
                            <tr>
                              <td><img src="images/spacer.gif" width="10" height="20" /></td>
                            </tr>
                        </table></td>

                      </tr>
                  </table></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                </tr>

                <tr>
                  <td>&nbsp;</td>
                </tr>
              </table>
			  </td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><img src="images/spacer.gif" width="10" height="50" /></td>
      </tr>
      <tr>
        <td><table width="386" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td width="145"><a href="cambia_pass.php?id=<?echo"$id_usuario";?>" class="iframe2" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image21','','images/b_cambio_r.png',1)"><img src="images/b_cambio.png" name="Image21" width="145" height="23" border="0" id="Image21" /></a></td>
            <td><img src="images/spacer.gif" width="16" height="20" /></td>
            <td width="114">
			 <? if($_SESSION["idA"]=="1"){?>
			<a href="admin.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image24','','images/b_administracion_r.png',1)"><img src="images/b_administracion.png" name="Image24" width="114" height="23" border="0" id="Image24" /></a>
			<? }?>			</td>
            <td><img src="images/spacer.gif" width="17" height="20" /></td>
            <td><a href="logout.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image25','','images/b_log_out_r.png',1)"><img src="images/b_log_out.png" name="Image25" width="71" height="23" border="0" id="Image25" /></a></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><img src="images/spacer.gif" width="10" height="20" /></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="17" valign="top" background="images/bkg_azul.jpg"><img src="images/spacer.gif" width="10" height="17" /></td>
  </tr>
</table>

</body>
</html>
