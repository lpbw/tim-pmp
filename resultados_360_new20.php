<?

ini_set("display_errors", 1);

ini_set("track_errors", 1);

ini_set("html_errors", 1);

ini_set("session.cookie_lifetime","7200"); 

ini_set("session.gc_maxlifetime","7200");

session_start();

include "checar_sesion_admin.php";

include "coneccion_i.php";



$idU=$_SESSION['idU'];

$id_depto=$_POST["depto"];

$plan=$res[0];

$estatus="";

$firma1e="";

$firma2e="";

$firma1j="";

$firma2j="";

	$consulta  = "SELECT revision, etapa from etapa where id=1";

	$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1:$consulta ". mysqli_error($enlace) );//. mysqli_error($enlace)	

	if(@mysqli_num_rows($resultado)>=1)

	{

		$res=mysqli_fetch_row($resultado);

		$revision=$res[0];

		$etapa=$res[1];

	}

	///////////////

	///////////

	//excepcion 2021 retro

	$etapa=4;

if($_GET["id"]!="" && $_GET["revision"]!="")

{

	$idU=$_GET["id"];

	$revision=$_GET["revision"];

}else

{

if($_POST["verobjetivos"]!="" && $_POST["verrevision"]!="")

{

	$idU=$_POST["verobjetivos"];

	$revision=$_POST["verrevision"];

}

}	

	$consulta2  = "SELECT nombre from usuarios where id=$idU";

	$resultado2 = mysqli_query($enlace,$consulta2) or die("La consulta fall&oacute;P1:$consulta ". mysqli_error($enlace) );//. mysqli_error($enlace)	

	if(@mysqli_num_rows($resultado2)>=1)

	{

		$res2=mysqli_fetch_row($resultado2);

		$nombre=$res2[0];

		

	}

	

if($_POST["mostrar"]!="" )

{

	$consulta2  = "update planes set retro=1  where id_empleado=$idU and revision=$revision";

	echo"$consulta2";

	$resultado2 = mysqli_query($enlace,$consulta2) or die("La consulta fall&oacute;P1:$consulta ". mysqli_error($enlace) );//. mysqli_error($enlace)

}

	$consulta2  = "SELECT resultado_calibracion, resultado_360, retro from planes where id_empleado=$idU and revision=$revision";

	//echo"$consulta2";

	$resultado2 = mysqli_query($enlace,$consulta2) or die("La consulta fall&oacute;P1:$consulta ". mysqli_error($enlace) );//. mysqli_error($enlace)	

	if(@mysqli_num_rows($resultado2)>=1)

	{

		$res2=mysqli_fetch_row($resultado2);

		$resultado_obj=$res2[0];

		$resultado_360=$res2[1];

		$mostrar=$res2[2];

		

	}

	

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Bell</title>

<link rel="stylesheet" href="colorbox.css" />

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>

<script src="colorbox/jquery.colorbox-min.js"></script>

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

.style11 {color: #FFFFFF}



.texto_contenido {

	font-family: Arial, Helvetica, sans-serif;

	font-size: 12px;

	font-weight: normal;

	color: #666666;

	text-decoration: none;

}

-->

</style>

<link href="images/textos.css" rel="stylesheet" type="text/css" />

<script>

	$(document).ready(function(){

		$(".iframe2").colorbox({iframe:true,width:"450", height:"320",transition:"fade", scrolling:false, opacity:0.1});

		$("#click").click(function(){ 

			$('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");

			return false;

		});

	});

</script>

<script type="text/javascript">

<!--

function MM_swapImgRestore() { //v3.0

  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;

}

function MM_preloadImages() { //v3.0

  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();

    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)

    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}

}



function MM_findObj(n, d) { //v4.01

  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {

    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}

  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];

  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);

  if(!x && d.getElementById) x=d.getElementById(n); return x;

}



function MM_swapImage() { //v3.0

  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)

   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}

}



function verobjetivos(dato)

{

	document.form1.verobjetivos.value=dato;

	document.form1.action="objetivos.php";

	document.form1.target="blank";

	document.form1.submit();

}

function buscar()

{

	document.form1.action="reporte_planes.php";

	document.form1.submit();

}

//-->

</script>

<style type="text/css">

<!--

.style1 {font-size: 24px}

.style12 {font-weight: bold}

.style14 {font-size: 12px; color: #666666; text-decoration: none; font-family: Arial, Helvetica, sans-serif;}

-->

</style>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

			<script src="../../js/highcharts.js"></script>

<script src="../../js/highcharts-more.js"></script>

<script src="../../js/modules/exporting.js"></script>

</head>



<body onload="MM_preloadImages('images/b_cambio_r.png','images/b_administracion_r.png','images/b_log_out_r.png')">

<form id="form1" name="form1" method="post" action="">

<table width="100%" border="0" cellspacing="0" cellpadding="0">

  <tr>

  <td background="images/Header_bkg.png"><table width="900" border="0" align="center" cellpadding="0" cellspacing="0">

      <tr>

        <td><div align="center"><a href="menu.php"><img src="images/header_logo.png" width="210" height="175" border="0" /></a></div></td>

      </tr>

    </table></td>

  </tr>

  <tr>

    <td height="698" valign="top"><table width="1085" border="0" align="center" cellpadding="0" cellspacing="0">

      <tr>

        <td width="974"><img src="images/spacer.gif" width="10" height="20" /></td>

      </tr>

      <tr>

        <td><div align="center">

          <table width="850" border="0" cellspacing="7" cellpadding="0">

            <tr>

              <td><div align="center" class="text_grande style1">Resultados de la Evaluación 360&deg;</div></td>

            </tr>

          

          </table>

        </div></td>

      </tr>

     

      <tr>

        <td><img src="images/spacer.gif" width="10" height="10" /></td>

      </tr>

      <tr>

        <td><table width="1029" border="0" align="center" cellpadding="0" cellspacing="0">

          <tr>

            <td height="250" valign="top" bgcolor="#ffffff"><table width="1062" border="0" align="center" cellpadding="0" cellspacing="0">

              <tr>

                <td width="1055"><img src="images/spacer.gif" width="10" height="20" /></td>

              </tr>

              <tr>

                <td class="texto_chico" align="center">A continuación se muestran los resultados de la encuesta de 360 grados efectuada a:<label class="usuario"> <? echo $nombre; ?></label></td>

              </tr>

              <tr>

                <td align="center">&nbsp;</td>

              </tr>

              <tr>

                <td class="text_mediano" align="center"><br /></td>

              </tr>

              <tr>

                <td valign="top" align="center"><table width="90%" border="0" cellspacing="0" cellpadding="0" align="center">

                  <tr>

                    <td colspan="4"><table width="100%" border="0" cellspacing="0" cellpadding="0">

                        <tr>

                          <td><table width="100%" border="0" cellspacing="2" cellpadding="0">

                              <tr>

                                <td height="20" bgcolor="#ced0d1" class="usuario"><div align="center">OBJETIVOS</div></td>

                              </tr>

                          </table></td>

                        </tr>

                    </table></td>

                  </tr>

                  <tr>

                    <td colspan="4"><table width="100%" border="0" cellspacing="2" cellpadding="2"  bgcolor="#FAFAFA">

                        <tr>

                          <td width="72%" class="texto_tareas">&nbsp;</td>

                          <td width="11%" class="texto_tareas"><b>Resultado Indv </b></td>

                          <td width="10%" class="texto_tareas" align="center"><b>Resultado BELL </b></td>

                          <td width="7%" class="texto_tareas" align="center"><b>Total</b></td>

                        </tr>

                    </table></td>

                  </tr>

                  <?

		$consulta2 = "SELECT objetivos_new.id as id_obj, io_principies.nombre as n_obj, lags.nombre as n_lag, DATE_FORMAT(inicio,'%d-%m-%Y') as inicio, DATE_FORMAT(limite,'%d-%m-%Y') as limite, descripcion, evaluacion, comentario_e, comentario_j, evaluacion_j, io_principies.meta, lags.calif   from objetivos_new inner join io_principies on objetivos_new.id_objetivo=io_principies.id inner join lags on objetivos_new.id_estrategia=lags.id where objetivos_new.revision=$revision and objetivos_new.id_empleado=$idU order by objetivos_new.id";

		$resultado2= mysqli_query($enlace,$consulta2) or die("La consulta fall&oacute;P1: $consulta2". mysqli_error($enlace));

		$color="F0F0F0";

		$count=1;

		$calif_f2=0;

		while($res2=mysqli_fetch_assoc($resultado2))

		{

			$calif=0;

			$total_ind=0;

			

			if($res2['evaluacion_j']==1){$val6=12;}//20 * 60%

			if($res2['evaluacion_j']==2){$val6=36;}//60

			if($res2['evaluacion_j']==3){$val6=60;}//100

			if($res2['evaluacion_j']==4){$val6=66;}//110

			

			$total_ind=$val6+$res2['calif'];

			$calif_f2=$calif_f2+$total_ind;

					  ?>

                  <tr bgcolor="#<? echo"$color";?>">

                    <td width="72%">

					<table width="100%">

					                <tr>

                  <td  ><table width="100%" border="0" cellspacing="0" cellpadding="0">

                      <tr>

                        <td width="410"><table width="100%" border="0" cellspacing="2" cellpadding="0">

                            <tr>

                              <td width="25%" height="20"  class="usuario"><img src="images/spacer.gif" width="10" height="10" />Objetivo LAG:</td>

                              <td width="75%" class="usuario"><? echo $res2['n_obj'];?></td>

                            </tr>

                        </table></td>

                      </tr>

                  </table></td>

                </tr>

                <tr>

                  <td  b><table width="100%" border="0" cellspacing="0" cellpadding="0">

                      <tr>

                        <td width="410"><table width="100%" border="0" cellspacing="2" cellpadding="0">

                            <tr>

                              <td width="25%" height="20" class="usuario"><img src="images/spacer.gif" width="10" height="10" /> Estrategia:</td>

                              <td width="75%" class="usuario"><? echo $res2['n_lag'];?></td>

                            </tr>

                        </table></td>

                      </tr>



                  </table></td>

                </tr>

                <tr>

                  <td  ><table width="100%" border="0" cellspacing="2" cellpadding="0">

                      <tr>

                        <td width="25%" height="20"  class="usuario"><p align="left"><img src="images/spacer.gif" alt="" width="10" height="10" />Objetivo SMART

                          :<br />

                                      <img src="images/spacer.gif" alt="" width="10" height="10" />(Descripción)</p></td>

                        <td width="75%" class="usuario"><? echo $res2['descripcion'];?></td>

                      </tr>

                  </table></td>

                </tr>

					</table>					</td>

                    <td width="11%"><table width="100%" align="right" border="0" cellspacing="6" cellpadding="6">

                      <tr>

                        <td width="100%" align="center" class="texto_tareas" valign="middle"><? echo $val6;?></td>

                      </tr>

                    </table></td>

                    <td width="10%"><table width="100%" align="right" border="0" cellspacing="6" cellpadding="6">

                      <tr>

                        <td width="100%" align="center" class="texto_tareas" valign="middle"><? echo $res2['calif'];?></td>

                      </tr>

                    </table></td>

                    <td width="7%"><table width="100%" align="right" border="0" cellspacing="6" cellpadding="6">

                      <tr>

                        <td width="100%" align="center" class="texto_tareas" valign="middle"><? echo $total_ind;?></td>

                      </tr>

                    </table></td>

                  </tr>

                  <? 

							

		if($color=="F0F0F0")

				  	$color="FFFFFF";

					else

					$color="F0F0F0";

			

		

		$count++;

		}	

		$calif_final=$calif_f2/($count-1);?>

                  <tr>

                    <td colspan="4"><table width="100%" border="0" cellspacing="2" cellpadding="2"  bgcolor="#FAFAFA">

                        <tr>

                          <td width="35%" class="texto_tareas">&nbsp;</td>

                          <td width="10%" class="texto_tareas" align="center">&nbsp;</td>

                          <td width="35%" class="texto_tareas">&nbsp;</td>

                          <td width="10%" class="texto_tareas" align="center"><b>Calif Final</b></td>

                          <td width="10%" class="texto_tareas" align="center"><b><? echo $calif_final?></b></td>

                        </tr>

                    </table></td>

                  </tr>

                  <tr>

                    <td colspan="4"><img src="images/spacer.gif" width="10" height="20" /></td>

                  </tr>

                </table></td>

              </tr>

              <tr>

			  <td>&nbsp;</td>

              </tr>

			  

			   <tr>

			  <td><table width="100%" border="0" align="center" cellspacing="0">

          <tr>

            <td  height="27" class="texto_contenido"><p class="text_mediano">Resultados por Expectativa</p></td>

          </tr>

          <tr>

            <td width="54%" class="style9"><table width="95%" border="0" cellspacing="1" cellpadding="0">

              <tr>

                <td width="2%" bgcolor="#666666" class="nombre_admin"></td>

			    <td width="78%" bgcolor="#666666" class="nombre_admin"><div align="center" class="style11">Expectativa</div></td>

                <td width="20%" bgcolor="#666666" class="nombre_admin style11" align="center">Normalizado</td>

              </tr>

			  <? 
        // ejecutar https://tim-pmp.com/dis_nom2_new.php
        $query= "SELECT co1.e1, round(avg(calificacion),1) as cal, round((avg(calificacion)*100/3),1) as pun, round(avg(normalizado)*150,1) as nor

FROM new_calificaciones as ca1 

inner join new_competencias as co1 on ca1.id_numero=co1.id 

where ca1.id_evaluado=$idU and ca1.revision=$revision group by co1.id"; 
// echo $query;

			  	 $result = mysqli_query($enlace,$query) or die("La consulta falla P1: ". mysqli_error($enlace) );

						$count1=0;

						$cont=0;

						while(@mysqli_num_rows($result)>$count1)					

						{

							$res12=mysqli_fetch_row($result);

						

							$dato.="{$res12[3]},";

							$nom.="'{$res12[0]}',";

									

			    ?>

              <tr>

			  <td height="35" bgcolor="#CCCCCC" class="texto_contenido"></td>

                <td height="35" bgcolor="#CCCCCC" class="texto_contenido"><? echo $res12[0]; ?></td>

                <td bgcolor="#CCCCCC" class="texto_contenido"><div align="center"><? echo $res12[3]; ?></div></td>

              </tr>

			<? $count1++; } 

			$dato=trim($dato, ',');

			$nom=trim($nom, ',');

			//echo $dato;

			?>

			

            </table></td>

			<td>

		

		<script type="text/javascript">

$(function () {



    $('#container').highcharts({

	credits: {  enabled: false },

	exporting: { enabled: false },

        chart: {

            polar: true,

            type: 'line'

        },



        title: {

            text: '',

            x: 0 //posicion del titulo

        },



        pane: {

            size: '70%' //tamaño de la grafica

        },



        xAxis: {	//nombre de cada punto de la grafica

            categories: [<? echo $nom;?>],

            tickmarkPlacement: 'on',

            lineWidth: 0

        },



        yAxis: {	//estilo de la grafica

            gridLineInterpolation: 'polygon',

            lineWidth: 0,

            min: 0

			

        },



       colors: ["#f45b5b"],		//color del area de la grafica de radar



        legend: {

            align: 'center',

            //verticalAlign: 'top',

            y: 70,

            layout: 'vertical'

        },



        series: [ {

		 	type: 'area', //tipo de area para rellenar todos los puntos

            name: ' ',

            data: [<? echo $dato;?>], //valores de la grafica

			pointPlacement: 'on'

        }]



    });

});

		</script>

	





<div id="container" style="min-width: 400px; max-width: 600px; height: 400px; margin: 0 auto"></div></td>

              </tr>

            </table></td>

          </tr>

		   <td><table width="100%" border="0" align="center" cellspacing="0">

          <tr>

            <td  height="27" class="texto_contenido"></td>

          </tr>

		  <tr>

		    <td><table width="100%" border="0" align="center" cellspacing="0">

          <tr>

            <td  height="27" class="texto_contenido"><p class="text_mediano">Resultados por tipo de evaluador</p></td>

          </tr>

          <tr>

            <td width="54%" class="style9"><table width="95%" border="0" cellspacing="1" cellpadding="0">

              <tr>

			  <td width="2%"  bgcolor="#666666" class="nombre_admin"><div align="center" class="style11"></div></td>

                <td width="78%" bgcolor="#666666" class="nombre_admin"><div align="center" class="style11">Evaluador</div></td>

                <td width="20%" bgcolor="#666666" class="nombre_admin style11" align="center">Normalizado</td>

              </tr>

              <? 
              // ejecutar https://tim-pmp.com/calcula_calificaciones.php
              $query2="SELECT round(avg(tipo1s),1) as t1,round(avg(tipo2s),1) as t2,round(avg(tipo3s),1) as t3,round(avg(tipo4s),1) as t4,round(avg(tipo5s),1) as t5, round((avg(tipo1s)*100/3),1) as c1,round((avg(tipo2s)*100/3),1) as c2,round((avg(tipo3s)*100/3),1) as c3,round((avg(tipo4s)*100/3),1) as c4,round((avg(tipo5s)*100/3),1) as c5, round(avg(tipo1n)*150,1) as n1,round(avg(tipo2n)*150,1) as n2,round(avg(tipo3n)*150,1) as n3,round(avg(tipo4n)*150,1) as n4,round(avg(tipo5n)*150,1) as n5 

			  FROM new_resultados 

			  where id_evaluado=$idU and revision=$revision";

			     $result2 = mysqli_query($enlace,$query2) or die("La consulta falla P2: ". mysqli_error($enlace) );

				 $res122=mysqli_fetch_row($result2);

			  

			  ?>

              <tr>

			  <td height="35" bgcolor="#CCCCCC" class="texto_contenido">&nbsp;</td>

                <td height="35" bgcolor="#CCCCCC" class="texto_contenido">Jefe Directo</td>

                <td bgcolor="#CCCCCC" class="texto_contenido"><div align="center"><? echo $res122[10]; ?></div></td>

              </tr>

			  <tr>

			  <td height="35" bgcolor="#CCCCCC" class="texto_contenido">&nbsp;</td>

                <td height="35" bgcolor="#CCCCCC" class="texto_contenido">Colaboradores</td>

                <td bgcolor="#CCCCCC" class="texto_contenido"><div align="center"><? echo $res122[11]; ?></div></td>

			  </tr>

			  <tr>

                <td height="35" bgcolor="#CCCCCC" class="texto_contenido">&nbsp;</td>

			    <td height="35" bgcolor="#CCCCCC" class="texto_contenido">Colaterales</td>

                <td bgcolor="#CCCCCC" class="texto_contenido"><div align="center"><? echo $res122[12]; ?></div></td>

			  </tr>

			  <tr>

                <td height="35" bgcolor="#CCCCCC" class="texto_contenido">&nbsp;</td>

			    <td height="35" bgcolor="#CCCCCC" class="texto_contenido">Clientes</td>

                <td bgcolor="#CCCCCC" class="texto_contenido"><div align="center"><? echo $res122[13]; ?></div></td>

			  </tr>

			  <tr>

                <td height="35" bgcolor="#CCCCCC" class="texto_contenido">&nbsp;</td>

			    <td height="35" bgcolor="#CCCCCC" class="texto_contenido">Autoevaluaci&oacute;n</td>

                <td bgcolor="#CCCCCC" class="texto_contenido"><div align="center"><? echo $res122[14]; ?></div></td>

			  </tr>

         

          </table></td>

			<td>

		

		<script type="text/javascript">

$(function () {



    $('#container1').highcharts({

	credits: {  enabled: false },

	exporting: { enabled: false },

        chart: {

            polar: true,

            type: 'line'

        },



        title: {

            text: '',

            x: 0 //posicion del titulo

        },



        pane: {

            size: '70%'

        },



        xAxis: {

            categories: ['Jefe Directo', 'Colaboradores', 'Colaterales', 'Clientes',

                    'Autoevaluación'],

            tickmarkPlacement: 'on',

            lineWidth: 0

        },



        yAxis: {

            gridLineInterpolation: 'polygon',

            lineWidth: 0,

            min: 0

        },



        legend: {

            align: 'center',

            //verticalAlign: 'top',

            y: 70,

            layout: 'vertical'

        },



        series: [ {

		 	type: 'area',

            name: ' ',

            data: [<? echo $res122[10]; ?>, <? echo $res122[11]; ?>, <? echo $res122[12]; ?>, <? echo $res122[13]; ?>, <? echo $res122[14]; ?>],

			pointPlacement: 'on'

        }]



    });

});

		</script>

	





<div id="container1" style="min-width: 400px; max-width: 600px; height: 400px; margin: 0 auto"></div></td>

          </tr>

            </table></td>

		  </tr>

		  

		   </table></td>

		

              </tr>

			 

		<tr>

		

		<td> <p>&nbsp;</p>

		  <table width="100%" border="0" align="center" cellpadding="0">

          <tr>

            <td colspan="8" class="text_mediano" scope="row">Resultados por Competencia </td>

          </tr>

          <tr>

            <td width="22%" bgcolor="#666666" class="style11" scope="row"><div align="center">Expectativa</div></td>

            <td width="19%" bgcolor="#666666" class="style11" scope="row"><div align="center">Competencia</div></td>

            <td width="6%" bgcolor="#666666" class="style11"><div align="center">Jefe</div></td>

            <td width="10%" bgcolor="#666666" class="style11"><div align="center">Colaboradores</div></td>

            <td width="7%" bgcolor="#666666" class="style11"><div align="center">Colaterales</div></td>

            <td width="8%" bgcolor="#666666" class="style11"><div align="center">Clientes</div></td>

            <td width="11%" bgcolor="#666666" class="style11"><div align="center">Autoevaluaci&oacute;n</div></td>

            <td width="17%" bgcolor="#666666" class="style11"><div align="center">Total Normalizado </div></td>

            </tr>

          <? $query3="select r1.tipo1s, r1.tipo2s, r1.tipo3s, r1.tipo4s, r1.tipo5s, r1.resultado, new_competencias.e1, round(r1.resultadon*150,1) as rn, new_competencias.e1 as espec 

		  from new_resultados as r1 

		  inner join new_competencias on r1.id_numero=new_competencias.id 

		  where r1.id_evaluado=$idU and revision=$revision

		  order by r1.id_numero";

		     $result3 = mysqli_query($enlace,$query3) or die("La consulta falla P3: ". mysqli_error($enlace) );

						$count3=0;

						while(@mysqli_num_rows($result3)>$count3)					

						{

							$res123=mysqli_fetch_row($result3);

		  					$valores_numeros.="{$res123[7]},";

							$valores_nombres.="'{$res123[6]}',";

		   ?>

          <tr>

            <td bgcolor="#CCCCCC" class="texto_contenido" scope="row"><? echo $res123[8]; ?></td>

            <td height="25" bgcolor="#CCCCCC" class="texto_contenido" scope="row"><? echo $res123[6]; ?></td>

            <td bgcolor="#CCCCCC" class="texto_contenido"><div align="center"><? echo $res123[0]; ?></div></td>

            <td bgcolor="#CCCCCC" class="texto_contenido"><div align="center"><? echo $res123[1]; ?></div></td>

            <td bgcolor="#CCCCCC" class="texto_contenido"><div align="center"><? echo $res123[2]; ?></div></td>

            <td bgcolor="#CCCCCC" class="texto_contenido"><div align="center"><? echo $res123[3]; ?></div></td>

            <td bgcolor="#CCCCCC" class="texto_contenido"><div align="center"><? echo $res123[4]; ?></div></td>

            <td bgcolor="#CCCCCC" class="texto_contenido"><div align="center"><? echo $res123[7]; ?></div></td>

            </tr>

          

          <? $count3++; } 

		  	$valores_numeros=trim($valores_numeros, ',');

			$valores_nombres=trim($valores_nombres, ',');

		  ?>

		  <tr>

            <td class="texto_contenido" scope="row">&nbsp;</td>

            <td height="25" class="texto_contenido" scope="row">&nbsp;</td>

            <td class="texto_contenido">&nbsp;</td>

            <td class="texto_contenido">&nbsp;</td>

            <td class="texto_contenido">&nbsp;</td>

            <td class="texto_contenido">&nbsp;</td>

            <td class="texto_contenido"><div align="right" class="text_mediano">Resultado</div></td>

            <td bgcolor="#CCCCCC" class="texto_contenido"><div align="center" class="tit_1"><? echo $resultado_360;?></div></td>

          </tr>

        </table></td>

		</tr>	  

        </table></td>

		

      </tr>

	  <script type="text/javascript">

$(function () {

    $('#container2').highcharts({

       	credits: {  enabled: false },

		exporting: { enabled: false },

	    chart: {

            type: 'line',

            inverted: true

        },

        title: {

            text: ''

        },

       

       

        xAxis: {

            categories: [ <? echo $valores_nombres;?> ]

        },

        yAxis: {

            title: {

                text: 'Total normalizado'

            },

            labels: {

                formatter: function () {

                    return this.value;

                }

            },

            min: 0

        },

		

        plotOptions: {

            area: {

                fillOpacity: 0.1

            }

        },

		legend: {

            align: 'center',

            //verticalAlign: 'top',

            y: 70,

            layout: 'vertical'

        },

        series: [{

            type: 'area',

            name: ' ',

            data: [<? echo $valores_numeros;?>],

			pointPlacement: 'on'

        }]

    });

});

		</script>

	  <tr> 

	  <td align="center"> <p><div id="container2" style="min-width: 400px; height: 600px; max-width: 600px; margin: 0 auto"></div></p><table width="80%" border="0" cellspacing="2" cellpadding="2">

              <tr >

			  	<td bgcolor="#666666" class="nombre_admin"><div align="center" class="style11">Competencia</div></td>

                <td bgcolor="#666666" class="nombre_admin"><div align="center" class="style11">Menciona ejemplos especificos que soporten tu calificacion:</div></td>

                </tr>

              <? $query22="SELECT id_numero, new_competencias.e1 from new_calificaciones 

			  inner join new_competencias on new_competencias.id=new_calificaciones.id_numero

			  where id_evaluado=$idU and revision=$revision group by id_numero";

			     $result22 = mysqli_query($enlace,$query22) or die("La consulta falla P4: $query22". mysqli_error($enlace) );//. mysqli_error($enlace)	

				while($res22=mysqli_fetch_assoc($result22)){

			  ?>

              <tr>

			  	<td height="35" bgcolor="#CCCCCC" class="texto_contenido" align="center"><? echo $res22['e1']?></td>

                <td height="35" bgcolor="#CCCCCC" class="texto_contenido"><table width="100%" border="0" cellspacing="2" cellpadding="2">

  

  				<?

				$query4="SELECT ejemplos from new_calificaciones where id_evaluado=$idU and revision=$revision and id_numero={$res22['id_numero']}";

			    $result4 = mysqli_query($enlace,$query4) or die("La consulta falla P5: $query4". mysqli_error($enlace) );//. mysqli_error($enlace)	

				while($res4=mysqli_fetch_assoc($result4)){

					//echo "*";

					

					//echo "<br/>";

				?>

  <tr>

    <td bgcolor="#FFFFFF"><? echo $res4['ejemplos']; ?></td>

  </tr>

  <? }?>

</table>

</td>

                </tr>

              <? }?>

          </table></td>

	  </tr>

	  <tr>

	  <td align="center">&nbsp;</td>

	  </tr>

      <tr>

        <td><p>&nbsp;</p>

          <table width="35%" border="0" align="center" cellpadding="0" cellspacing="1">

           <? $query5="SELECT resultado_obj, comentario_final_j, resultado_calibracion, comentario_final from planes where id_empleado=$idU and revision=$revision"; 

			  $result5 = mysqli_query($enlace,$query5) or die("La consulta fall&oacute;P1: ". mysqli_error($enlace) );//. mysqli_error($enlace)	

			  if($res125=mysqli_fetch_assoc($result5)){

			  			

		  ?>

		    <tr>

              <td width="38%" bgcolor="#666666" class="nombre_admin"><div align="center" class="style11 style12">

                <div align="center">Final Rating </div>

              </div></td>

              <td width="3%" class="nombre_admin">&nbsp;</td>

              <td width="59%" bgcolor="#CCCCCC" class="nombre_admin"><div align="center"><strong><span class="style14"><? 

			  

			  if($res125['resultado_calibracion']==4)

			  echo"Supera las expectativas";

			  else if($res125['resultado_calibracion']==3)

			  echo"Cumple con las expectativas"; 

			  else if($res125['resultado_calibracion']==2)

			  echo"Parcialmente cumple con las expectativas";

			  else if($res125['resultado_calibracion']==1)

			  echo"No cumple la mayoria de las expectativas";

			 // echo $res125[2]; 

			  

			 // else echo $res125[0];

			  

			  

			  ?></span></strong></div></td>

            </tr>

            

            <tr>

              <td height="35" bgcolor="#666666" class="texto_contenido"><div align="center"><strong><span class="style11">Supervisor/Manager Final Comments </span></strong></div></td>

              <td class="texto_contenido">&nbsp;</td>

              <td bgcolor="#CCCCCC" class="texto_contenido"><span class="nombre_admin"><strong><? echo $res125['comentario_final_j'];?></strong></span></td>

            </tr>

			<tr>

              <td height="35" bgcolor="#666666" class="texto_contenido"><div align="center"><strong><span class="style11">Employee Final Comments </span></strong></div></td>

              <td class="texto_contenido">&nbsp;</td>

              <td bgcolor="#CCCCCC" class="texto_contenido"><span class="nombre_admin"><strong><? echo $res125['comentario_final'];?></strong></span></td>

            </tr>

            <?  }?>

          </table>          

          <p align="center"><img src="images/spacer.gif" width="10" height="50" />

		  <? if($etapa==4 && $mostrar=="0"){?>

            <input name="mostrar" type="submit" id="mostrar" value="Mostrar Resultados a Colaborador" />

			

			<? }?>

          </p></td>

      </tr>

      <tr>

        <td><table width="350" border="0" align="center" cellpadding="0" cellspacing="0">

          <tr>

            <td width="145"><a href="cambia_pass.php?id=<?echo"$idU";?>" class="iframe2" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image21','','images/b_cambio_r.png',1)"><img src="images/b_cambio.png" name="Image21" width="150" height="23" border="0" id="Image21" /></a></td>

            <td><img src="images/spacer.gif" width="16" height="20" /></td>

            <td width="114">

			<a href="menu.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image24','','images/b_administracion.png',1)"><img src="images/b_administracion.png" name="Image24" width="150" height="23" border="0" id="Image24" /></a>			</td>

            <td><img src="images/spacer.gif" width="17" height="20" /></td>

            <td><a href="logout.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image25','','images/b_log_out_r.png',1)"><img src="images/b_log_out.png" name="Image25" width="150" height="23" border="0" id="Image25" /></a></td>

          </tr>

        </table></td>

      </tr>

    </table></td>

  </tr>

</table>



</form>

</body>

</html>

