<?
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
	$consulta2  = "SELECT resultado_calibracion, resultado_360 from planes where id_empleado=$idU and revision=$revision";
	//echo"$consulta2";
	$resultado2 = mysqli_query($enlace,$consulta2) or die("La consulta fall&oacute;P1:$consulta ". mysqli_error($enlace) );//. mysqli_error($enlace)	
	if(@mysqli_num_rows($resultado2)>=1)
	{
		$res2=mysqli_fetch_row($resultado2);
		$resultado_obj=$res2[0];
		$resultado_360=$res2[1];
		
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
                    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
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
                    <td><table width="100%" border="0" cellspacing="2" cellpadding="2"  bgcolor="#FAFAFA">
                        <tr>
                          <td width="35%" class="texto_tareas"><b>Lags</b></td>
                          <td width="10%" class="texto_tareas" align="center"><b>Calif Lag</b></td>
                          <td width="35%" class="texto_tareas"><b>Leads</b></td>
                          <td width="10%" class="texto_tareas" align="center"><b>Calif Lead</b></td>
                          <td width="10%" class="texto_tareas" align="center"><b>Total</b></td>
                        </tr>
                    </table></td>
                  </tr>
                  <?
		$consulta2 = "SELECT * FROM objetivos2 where id_empleado=$idU and revision=$revision and nombre>0";
		$resultado2= mysqli_query($enlace,$consulta2) or die("La consulta fall&oacute;P1: $consulta2". mysqli_error($enlace));
		$color="F0F0F0";
		$count=1;
		while($res2=mysqli_fetch_assoc($resultado2))
		{
			$calif=0;
			$consulta4 = "SELECT calif FROM lags where id in ({$res2['descripcion']}, {$res2['descripcion2']})";
			$resultado4= mysqli_query($enlace,$consulta4) or die("La consulta fall&oacute;P1: $consulta4". mysqli_error($enlace));
			$no=mysqli_num_rows($resultado4);
			while($res4=mysqli_fetch_assoc($resultado4)){
			
				$calif=$calif+$res4['calif'];
			}
			
	
	$calif1=0;
	$calif2=0;
	$calif3=0;
	$calif4=0;
	$calif5=0;
	$calif6=0;
	$calif=$calif/$no;
					  ?>
                  <tr bgcolor="#<? echo"$color";?>">
                    <td><table width="35%" align="left" border="0" cellspacing="6" cellpadding="6">
                        <?
			$consulta10 = "SELECT * FROM lags where id in ({$res2['descripcion']}, {$res2['descripcion2']})";
			$resultado10= mysqli_query($enlace,$consulta10) or die("La consulta fall&oacute;P1: $consulta10". mysqli_error($enlace));
			while($res10=mysqli_fetch_assoc($resultado10)){?>
                        <tr>
                          <td width="100%" align="justify" class="texto_tareas" valign="middle"><? echo $res10['nombre']?></td>
                        </tr>
                        <? }?>
                      </table>
                        <table width="10%" align="left" border="0" cellspacing="6" cellpadding="6">
                          <tr>
                            <td width="100%" align="center" class="texto_tareas" valign="middle"><? echo $calif?></td>
                          </tr>
                        </table>
                      <table width="45%" border="0" align="left" cellspacing="2" cellpadding="2"  >
                          <?
  if($res2['impacto']>0){
				if($res2['revision_final']==1){$val1=20;}
				if($res2['revision_final']==2){$val1=60;}
				if($res2['revision_final']==3){$val1=100;}
				if($res2['revision_final']==4){$val1=110;}
				$calif1=$val1*$res2['ponderacion'];
	$consulta99  = "SELECT * from leads where id={$res2['impacto']}";
	$resultado99 = mysqli_query($enlace,$consulta99);	
	$res99=mysqli_fetch_assoc($resultado99);
  ?>
                          <tr>
                            <td width="78%" class="texto_tareas" align="justify"><? echo $res99['nombre']?></td>
                            <td width="22%" class="texto_tareas" align="center"><? echo ($calif1/100)*.6;?></td>
                          </tr>
                          <?
  }

			if($res2['impacto2']>0){
				if($res2['revision_final2']==1){$val2=20;}
				if($res2['revision_final2']==2){$val2=60;}
				if($res2['revision_final2']==3){$val2=100;}
				if($res2['revision_final2']==4){$val2=110;}
				$calif2=$val2*$res2['ponderacion2'];
	
	$consulta99  = "SELECT * from leads where id={$res2['impacto2']}";
	$resultado99 = mysqli_query($enlace,$consulta99);	
	$res99=mysqli_fetch_assoc($resultado99);
  ?>
                          <tr>
                            <td width="78%" class="texto_tareas" align="justify"><? echo $res99['nombre']?></td>
                            <td width="22%" class="texto_tareas" align="center"><? echo ($calif2/100)*.6;?></td>
                          </tr>
                          <?
  }
			if($res2['impacto3']>0){
				if($res2['revision_final3']==1){$val3=20;}
				if($res2['revision_final3']==2){$val3=60;}
				if($res2['revision_final3']==3){$val3=100;}
				if($res2['revision_final3']==4){$val3=110;}
				$calif3=$val3*$res2['ponderacion3'];
	
	$consulta99  = "SELECT * from leads where id={$res2['impacto3']}";
	$resultado99 = mysqli_query($enlace,$consulta99);	
	$res99=mysqli_fetch_assoc($resultado99);
  ?>
                          <tr>
                            <td width="78%" class="texto_tareas" align="justify"><? echo $res99['nombre']?></td>
                            <td width="22%" class="texto_tareas" align="center"><? echo ($calif3/100)*.6;?></td>
                          </tr>
                          <?
  }
			if($res2['impacto4']>0){
				if($res2['revision_final4']==1){$val4=20;}
				if($res2['revision_final4']==2){$val4=60;}
				if($res2['revision_final4']==3){$val4=100;}
				if($res2['revision_final4']==4){$val4=110;}
				$calif4=$val4*$res2['ponderacion4'];

	$consulta99  = "SELECT * from leads where id={$res2['impacto4']}";
	$resultado99 = mysqli_query($enlace,$consulta99);	
	$res99=mysqli_fetch_assoc($resultado99);			
  ?>
                          <tr>
                            <td width="78%" class="texto_tareas" align="justify"><? echo $res99['nombre']?></td>
                            <td width="22%" class="texto_tareas" align="center"><? echo ($calif4/100)*.6;?></td>
                          </tr>
                          <?
  }
			if($res2['impacto5']>0){
				if($res2['revision_final5']==1){$val5=20;}
				if($res2['revision_final5']==2){$val5=60;}
				if($res2['revision_final5']==3){$val5=100;}
				if($res2['revision_final5']==4){$val5=110;}
				$calif5=$val5*$res2['ponderacion5'];
	
	$consulta99  = "SELECT * from leads where id={$res2['impacto5']}";
	$resultado99 = mysqli_query($enlace,$consulta99);	
	$res99=mysqli_fetch_assoc($resultado99);
  ?>
                          <tr>
                            <td width="78%" class="texto_tareas" align="justify"><? echo $res99['nombre']?></td>
                            <td width="22%" class="texto_tareas" align="center"><? echo ($calif5/100)*.6;?></td>
                          </tr>
                          <? 
  }
			if($res2['impacto6']!=""){
				if($res2['revision_final6']==1){$val6=20;}
				if($res2['revision_final6']==2){$val6=60;}
				if($res2['revision_final6']==3){$val6=100;}
				if($res2['revision_final6']==4){$val6=110;}
				$calif6=$val6*$res2['ponderacion6'];
				
  ?>
                          <tr>
                            <td width="78%" class="texto_tareas" align="justify"><? echo $res2['impacto6']?></td>
                            <td width="22%" class="texto_tareas" align="center"><? echo ($calif6/100)*.6;?></td>
                          </tr>
                          <? }  	$calif_s=0;
			$calif_s=$calif1+$calif2+$calif3+$calif4+$calif5+$calif6;
			//echo "S: $calif_s <br/>";
			$calif_f=(($calif_s*.6)/100)+$calif;
			//echo "F: $calif_f <br/>";
			$calif_f2=$calif_f2+$calif_f;?>
                        </table>
                      <table width="10%" align="right" border="0" cellspacing="6" cellpadding="6">
                          <tr>
                            <td width="100%" align="center" class="texto_tareas" valign="middle"><? echo $calif_f?></td>
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
                    <td><table width="100%" border="0" cellspacing="2" cellpadding="2"  bgcolor="#FAFAFA">
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
                    <td><img src="images/spacer.gif" width="10" height="20" /></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
			  <td>&nbsp;</td>
              </tr>
			  
			   <tr>
			  <td><table width="100%" border="0" align="center" cellspacing="0">
          <tr>
            <td  height="27" class="texto_contenido"><p class="text_mediano">Resultados por factor </p></td>
          </tr>
          <tr>
            <td width="54%" class="style9"><table width="95%" border="0" cellspacing="1" cellpadding="0">
              <tr>
                <td width="2%" bgcolor="#666666" class="nombre_admin"></td>
			    <td width="78%" bgcolor="#666666" class="nombre_admin"><div align="center" class="style11">Factor</div></td>
                <td width="20%" bgcolor="#666666" class="nombre_admin style11">Normalizado</td>
              </tr>
			  <? $query= "SELECT fa1.nombre, round(avg(calificacion),1) as cal, round((avg(calificacion)*100/3),1) as pun,  round(avg(normalizado)*150,1) as nor FROM `tex_calificaciones`  as ca1 inner join tex_competencias as co1 on ca1.id_competencia=co1.id inner join tex_expectativas as fa1 on co1.id_expectativa=fa1.id where ca1.id_evaluado=$idU and ca1.revision=$revision group by fa1.id"; 
			  
			  $result = mysqli_query($enlace,$query) or die("La consulta fall&oacute;P1: ". mysqli_error($enlace) );//. mysqli_error($enlace)	
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
                <td width="20%" bgcolor="#666666" class="nombre_admin style11">Normalizado</td>
              </tr>
              <? $query2="SELECT round(avg(tipo1s),1) as t1,round(avg(tipo2s),1) as t2,round(avg(tipo3s),1) as t3,round(avg(tipo4s),1) as t4,round(avg(tipo5s),1) as t5, round((avg(tipo1s)*100/3),1) as c1,round((avg(tipo2s)*100/3),1) as c2,round((avg(tipo3s)*100/3),1) as c3,round((avg(tipo4s)*100/3),1) as c4,round((avg(tipo5s)*100/3),1) as c5, round(avg(tipo1n)*150,1) as n1,round(avg(tipo2n)*150,1) as n2,round(avg(tipo3n)*150,1) as n3,round(avg(tipo4n)*150,1) as n4,round(avg(tipo5n)*150,1) as n5 FROM tex_resultados where id_evaluado=$idU and revision =$revision";
			  
			  $result2 = mysqli_query($enlace,$query2) or die("La consulta fall&oacute;P1: ". mysqli_error($enlace) );
						
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
            <td width="22%" bgcolor="#666666" class="style11" scope="row"><div align="center">Factor</div></td>
            <td width="19%" bgcolor="#666666" class="style11" scope="row"><div align="center">Competencia</div></td>
            <td width="6%" bgcolor="#666666" class="style11"><div align="center">Jefe</div></td>
            <td width="10%" bgcolor="#666666" class="style11"><div align="center">Colaboradores</div></td>
            <td width="7%" bgcolor="#666666" class="style11"><div align="center">Colaterales</div></td>
            <td width="8%" bgcolor="#666666" class="style11"><div align="center">Clientes</div></td>
            <td width="11%" bgcolor="#666666" class="style11"><div align="center">Autoevaluaci&oacute;n</div></td>
            <td width="17%" bgcolor="#666666" class="style11"><div align="center">Total Normalizado </div></td>
            </tr>
          <? $query3="select r1.tipo1s, r1.tipo2s, r1.tipo3s, r1.tipo4s, r1.tipo5s, r1.resultado, c1.nombre, round(r1.resultadon*150,1) as rn, tex_expectativas.nombre as espec from tex_resultados as r1 inner join tex_competencias as c1 on r1.id_competencia=c1.id inner join tex_expectativas on tex_expectativas.id=c1.id_expectativa where r1.id_evaluado=$idU and revision=$revision order by r1.id_competencia";
		 //echo $query3;
		   $result3 = mysqli_query($enlace,$query3) or die("La consulta fall&oacute;P1: ". mysqli_error($enlace) );//. mysqli_error($enlace)	
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
	  <td align="center"> <p><div id="container2" style="min-width: 400px; height: 600px; max-width: 600px; margin: 0 auto"></div></p><table width="80%" border="0" cellspacing="1" cellpadding="0">
              <tr >
                <td bgcolor="#666666" class="nombre_admin"><div align="center" class="style11">Comportamientos que demuestras en el trabajo y me gustaria sigas teniendo</div></td>
                </tr>
              <? $query4="SELECT hacer from tex_calificaciones_preg where hacer<>'' and id_evaluado=$idU and revision=$revision group by hacer"; 
			  
			    $result4 = mysqli_query($enlace,$query4) or die("La consulta fall&oacute;P1: ". mysqli_error($enlace) );//. mysqli_error($enlace)	
						$count4=0;
						while(@mysqli_num_rows($result4)>$count4)					
						{
							$res124=mysqli_fetch_row($result4);
			  ?>
              <tr>
                <td height="35" bgcolor="#CCCCCC" class="texto_contenido"><? echo $res124[0];?></td>
                </tr>
              <? $count4++; }?>
          </table></td>
	  </tr>
	  <tr>
	  <td align="center"><p>&nbsp;</p> <table width="80%" border="0" cellspacing="1" cellpadding="0">
                <tr>
                  <td bgcolor="#666666" class="nombre_admin"><div align="center" class="style11">Comportamientos que demuestras en el trabajo y me gustaria dejaras de tener </div></td>
                </tr>
                <? $query5="SELECT nohacer from tex_calificaciones_preg where hacer<>'' and id_evaluado=$idU and revision=$revision group by nohacer"; 
				
				  $result5 = mysqli_query($enlace,$query5) or die("La consulta fall&oacute;P1: ". mysqli_error($enlace) );//. mysqli_error($enlace)	
						$count5=0;
						while(@mysqli_num_rows($result5)>$count5)					
						{
							$res125=mysqli_fetch_row($result5);
				?>
                <tr>
                  <td height="35" bgcolor="#CCCCCC" class="texto_contenido"><? echo $res125[0];?></td>
                </tr>
                <? $count5++; }?>
            </table></td>
	  </tr>
      <tr>
        <td><p>&nbsp;</p>
          <table width="35%" border="0" align="center" cellpadding="0" cellspacing="1">
           <? $query5="SELECT resultado_obj, comentario_final_j, resultado_calibracion, comentario_final from planes where id_empleado=$idU and revision=$revision"; 
				//echo $query5;
				  $result5 = mysqli_query($enlace,$query5) or die("La consulta fall&oacute;P1: ". mysqli_error($enlace) );//. mysqli_error($enlace)	
						if(@mysqli_num_rows($result5)>0)					
						{
							$res125=mysqli_fetch_row($result5);
							
				?>
		    <tr>
              <td width="38%" bgcolor="#666666" class="nombre_admin"><div align="center" class="style11 style12">
                <div align="center">Final Rating </div>
              </div></td>
              <td width="3%" class="nombre_admin">&nbsp;</td>
              <td width="59%" bgcolor="#CCCCCC" class="nombre_admin"><div align="center"><strong><span class="style14"><? 
			  if($res125[2]==2)
			  echo"Parcialmente Cumple"; 
			  else if($res125[2]==3)
			  echo"Cumple";
			  if($res125[2]==4)
			  echo"Excede";
			 // echo $res125[2]; 
			  
			 // else echo $res125[0];
			  
			  
			  ?></span></strong></div></td>
            </tr>
            
            <tr>
              <td height="35" bgcolor="#666666" class="texto_contenido"><div align="center"><strong><span class="style11">Supervisor/Manager Final Comments </span></strong></div></td>
              <td class="texto_contenido">&nbsp;</td>
              <td bgcolor="#CCCCCC" class="texto_contenido"><span class="nombre_admin"><strong><? echo $res125[1];?></strong></span></td>
            </tr>
			<tr>
              <td height="35" bgcolor="#666666" class="texto_contenido"><div align="center"><strong><span class="style11">Employee Final Comments </span></strong></div></td>
              <td class="texto_contenido">&nbsp;</td>
              <td bgcolor="#CCCCCC" class="texto_contenido"><span class="nombre_admin"><strong><? echo $res125[3];?></strong></span></td>
            </tr>
            <? $count5++; }?>
          </table>          
          <p><img src="images/spacer.gif" width="10" height="50" /></p></td>
      </tr>
      <tr>
        <td><table width="350" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td width="145"><a href="cambia_pass.php?id=<?echo"$idU";?>" class="iframe2" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image21','','images/b_cambio_r.png',1)"><img src="images/b_cambio.png" name="Image21" width="145" height="23" border="0" id="Image21" /></a></td>
            <td><img src="images/spacer.gif" width="16" height="20" /></td>
            <td width="114">
			<a href="menu.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image24','','images/b_administracion_r.png',1)"><img src="images/b_administracion.png" name="Image24" width="114" height="23" border="0" id="Image24" /></a>
			</td>
            <td><img src="images/spacer.gif" width="17" height="20" /></td>
            <td><a href="logout.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image25','','images/b_log_out_r.png',1)"><img src="images/b_log_out.png" name="Image25" width="80" height="23" border="0" id="Image25" /></a></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>

</form>
</body>
</html>
