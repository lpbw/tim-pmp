<?

session_start();

include "checar_sesion_admin.php";

include "coneccion_i.php";

$idU=$_SESSION['idU'];

$idA=$_SESSION['idA'];

$valueU=$_SESSION['valueU'];

$idE=$_SESSION['idE'];

$idGA=$_SESSION['idGA'];

$idAux=$_SESSION['idAux'];



$debug = TRUE;

$nombreU=$_SESSION['usuario']['nombre'];

$value=$_SESSION['usuario']['value'];



///para mis solicitudes

$query="SELECT solicitudes.id AS id, usuarios.nombre AS requisitor, solicitudes.fecha_solicitud AS fecha, estatus.nombre AS estatus, u1.nombre, left(solicitudes.titulo, 30)

        FROM solicitudes

    	INNER JOIN estatus ON estatus.id = solicitudes.id_estatus

		INNER JOIN usuarios ON usuarios.id = solicitudes.id_solicitante

		INNER JOIN usuarios AS u1 ON u1.id = solicitudes.id_comprador

		WHERE usuarios.id=$idU and id_estatus<>9 order by id desc";

		

    $ejecuta=mysqli_query($enlace,$query)or die("Error al consultar $query : ".mysqli_error($enlace));

   

   //para mensaje

	$query2="SELECT mensaje FROM mensaje WHERE id=1";		

    $ejecuta2=mysqli_query($enlace,$query2)or die("Error al consultar $query2 : ".mysqli_error($enlace));

	$res2=mysqli_fetch_row($ejecuta2);

	

	

	

	//para compras

	

	

	$query22="SELECT solicitudes.id AS id, usuarios.nombre AS requisitor, solicitudes.fecha_solicitud AS fecha, estatus.nombre AS estatus, u1.nombre, left(solicitudes.titulo, 30)

        FROM solicitudes

    	INNER JOIN estatus ON estatus.id = solicitudes.id_estatus

		INNER JOIN usuarios ON usuarios.id = solicitudes.id_solicitante

		INNER JOIN usuarios AS u1 ON u1.id = solicitudes.id_comprador

		WHERE solicitudes.id_comprador=$idU and solicitudes.id_estatus=2";

		

    $ejecuta22=mysqli_query($enlace,$query22)or die("Error al consultar $query33: ".mysqli_error($enlace)); 

	

	//para compras requi

	

	

	$query1010="SELECT solicitudes.id AS id, usuarios.nombre AS requisitor, solicitudes.fecha_solicitud AS fecha, estatus.nombre AS estatus, u1.nombre, left(solicitudes.titulo, 30)

        FROM solicitudes

    	INNER JOIN estatus ON estatus.id = solicitudes.id_estatus

		INNER JOIN usuarios ON usuarios.id = solicitudes.id_solicitante

		INNER JOIN usuarios AS u1 ON u1.id = solicitudes.id_comprador

		WHERE solicitudes.id_comprador=$idU and solicitudes.id_estatus=10";

		

    $ejecuta1010=mysqli_query($enlace,$query1010)or die("Error al consultar $query1010: ".mysqli_error($enlace)); 

	

	//para gerente de area

	$query234="SELECT areas.id, usuarios.id

				FROM areas

				INNER JOIN usuarios ON usuarios.id = areas.id_gerente

				WHERE usuarios.id=$idU";		

    $ejecuta234=mysqli_query($enlace,$query234)or die("Error al consultar $query234: ".mysqli_error($enlace));

	$resE=mysqli_fetch_row($ejecuta234);

	$resES=$resE[1];

	

	$query44="SELECT solicitudes.id AS id, usuarios.nombre AS requisitor, solicitudes.fecha_solicitud AS fecha, estatus.nombre AS estatus, u1.nombre, left(solicitudes.titulo, 30)

        FROM solicitudes

    	INNER JOIN estatus ON estatus.id = solicitudes.id_estatus

		INNER JOIN usuarios ON usuarios.id = solicitudes.id_solicitante

		INNER JOIN usuarios AS u1 ON u1.id = solicitudes.id_comprador

		INNER JOIN areas ON areas.id = solicitudes.id_area

		WHERE areas.id_gerente='$resES' and id_estatus=4";

		

    $ejecuta44=mysqli_query($enlace,$query44)or die("Error al consultar $query44: ".mysqli_error($enlace)); 

	

	//para gerente de planta

	

	$query55="SELECT solicitudes.id AS id, usuarios.nombre AS requisitor, solicitudes.fecha_solicitud AS fecha, estatus.nombre AS estatus, u1.nombre, left(solicitudes.titulo, 30)

        FROM solicitudes

    	INNER JOIN estatus ON estatus.id = solicitudes.id_estatus

		INNER JOIN usuarios ON usuarios.id = solicitudes.id_solicitante

		INNER JOIN usuarios AS u1 ON u1.id = solicitudes.id_comprador

		

		WHERE  id_estatus=6 and id_planta=$idU";

		

    $ejecuta55=mysqli_query($enlace,$query55)or die("Error al consultar $query55: ".mysqli_error($enlace));

	

	//para gerente de Finanzas

	

	$query66="SELECT solicitudes.id AS id, usuarios.nombre AS requisitor, solicitudes.fecha_solicitud AS fecha, estatus.nombre AS estatus, u1.nombre, left(solicitudes.titulo, 30)

        FROM solicitudes

    	INNER JOIN estatus ON estatus.id = solicitudes.id_estatus

		INNER JOIN usuarios ON usuarios.id = solicitudes.id_solicitante

		INNER JOIN usuarios AS u1 ON u1.id = solicitudes.id_comprador

		

		WHERE id_estatus=5";

		
mysqli_num_rows(
    $ejecuta66=mysqli_query($enlace,$query66)or die("Error al consultar d$query66: ".mysqli_error($enlace));

	

	//para gerente de Finanzas auxiliar

	

	$query664="SELECT solicitudes.id AS id, usuarios.nombre AS requisitor, solicitudes.fecha_solicitud AS fecha, estatus.nombre AS estatus, u1.nombre, left(solicitudes.titulo, 30)

        FROM solicitudes

    	INNER JOIN estatus ON estatus.id = solicitudes.id_estatus

		INNER JOIN usuarios ON usuarios.id = solicitudes.id_solicitante

		INNER JOIN usuarios AS u1 ON u1.id = solicitudes.id_comprador

		

		WHERE id_estatus=5 and solicitudes.fecha_solicitud > SUBDATE( solicitudes.fecha_solicitud, INTERVAL 3 DAY)";

		

    $ejecuta664=mysqli_query($enlace,$query664)or die("Error al consultar d$query66: ".mysqli_error($enlace));

	

	//para tipo especial SISTEMAS

	

	$query555="SELECT solicitudes.id AS id, usuarios.nombre AS requisitor, solicitudes.fecha_solicitud AS fecha, estatus.nombre AS estatus, u1.nombre, left(solicitudes.titulo, 30)

        FROM solicitudes

    	INNER JOIN estatus ON estatus.id = solicitudes.id_estatus

		INNER JOIN usuarios ON usuarios.id = solicitudes.id_solicitante

		INNER JOIN usuarios AS u1 ON u1.id = solicitudes.id_comprador

		

		WHERE id_estatus=98";

		

    $ejecuta555=mysqli_query($enlace,$query555)or die("Error al consultar d$query66: ".mysqli_error($enlace));

	

	//para tipo especial SISTEMAS auxiliar

	

	$query5559="SELECT solicitudes.id AS id, usuarios.nombre AS requisitor, solicitudes.fecha_solicitud AS fecha, estatus.nombre AS estatus, u1.nombre, left(solicitudes.titulo, 30)

        FROM solicitudes

    	INNER JOIN estatus ON estatus.id = solicitudes.id_estatus

		INNER JOIN usuarios ON usuarios.id = solicitudes.id_solicitante

		INNER JOIN usuarios AS u1 ON u1.id = solicitudes.id_comprador

		

		WHERE id_estatus=98 and solicitudes.fecha_solicitud > SUBDATE( solicitudes.fecha_solicitud, INTERVAL 3 DAY)";

		

    $ejecuta5559=mysqli_query($enlace,$query5559)or die("Error al consultar d$query66: ".mysqli_error($enlace));

	

	//para tipo especial CALIBRACION

	

	$query444="SELECT solicitudes.id AS id, usuarios.nombre AS requisitor, solicitudes.fecha_solicitud AS fecha, estatus.nombre AS estatus, u1.nombre, left(solicitudes.titulo, 30)

        FROM solicitudes

    	INNER JOIN estatus ON estatus.id = solicitudes.id_estatus

		INNER JOIN usuarios ON usuarios.id = solicitudes.id_solicitante

		INNER JOIN usuarios AS u1 ON u1.id = solicitudes.id_comprador

		

		WHERE id_estatus=97";

		

    $ejecuta444=mysqli_query($enlace,$query444)or die("Error al consultar d$query66: ".mysqli_error($enlace));

	

	//para tipo especial CALIBRACION auxiliar

	

	$query4442="SELECT solicitudes.id AS id, usuarios.nombre AS requisitor, solicitudes.fecha_solicitud AS fecha, estatus.nombre AS estatus, u1.nombre, left(solicitudes.titulo, 30)

        FROM solicitudes

    	INNER JOIN estatus ON estatus.id = solicitudes.id_estatus

		INNER JOIN usuarios ON usuarios.id = solicitudes.id_solicitante

		INNER JOIN usuarios AS u1 ON u1.id = solicitudes.id_comprador

		

		WHERE id_estatus=97 and solicitudes.fecha_solicitud > SUBDATE( solicitudes.fecha_solicitud, INTERVAL 3 DAY)";

		

    $ejecuta4442=mysqli_query($enlace,$query4442)or die("Error al consultar d$query66: ".mysqli_error($enlace));

	

	//para tipo especial SEGURIDAD

	

	$query333="SELECT solicitudes.id AS id, usuarios.nombre AS requisitor, solicitudes.fecha_solicitud AS fecha, estatus.nombre AS estatus, u1.nombre, left(solicitudes.titulo, 30)

        FROM solicitudes

    	INNER JOIN estatus ON estatus.id = solicitudes.id_estatus

		INNER JOIN usuarios ON usuarios.id = solicitudes.id_solicitante

		INNER JOIN usuarios AS u1 ON u1.id = solicitudes.id_comprador

		

		WHERE id_estatus=96 ";

		

    $ejecuta333=mysqli_query($enlace,$query333)or die("Error al consultar d$query66: ".mysqli_error($enlace));

	

	//para tipo especial SEGURIDAD auxiliar

	

	$query3337="SELECT solicitudes.id AS id, usuarios.nombre AS requisitor, solicitudes.fecha_solicitud AS fecha, estatus.nombre AS estatus, u1.nombre, left(solicitudes.titulo, 30)

        FROM solicitudes

    	INNER JOIN estatus ON estatus.id = solicitudes.id_estatus

		INNER JOIN usuarios ON usuarios.id = solicitudes.id_solicitante

		INNER JOIN usuarios AS u1 ON u1.id = solicitudes.id_comprador

		

		WHERE id_estatus=96 and solicitudes.fecha_solicitud > SUBDATE( solicitudes.fecha_solicitud, INTERVAL 3 DAY) ";

		

    $ejecuta3337=mysqli_query($enlace,$query3337)or die("Error al consultar d$query66: ".mysqli_error($enlace));

	

	$buscar=$_POST["buscar"];

	if($_POST['enviar']=="Buscar..."){

		echo"<script>window.location=\"ver_solicitud.php?id=$buscar\";</script>";

	}

	

	$buscar2=$_POST["buscar2"];

	if($_POST['enviar2']=="Buscar..."){

	

	 $consulta  = "SELECT id from solicitudes where numero_orden= $buscar2";		

	 $resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1: ". mysqli_error($enlace));

     if(@mysqli_num_rows($resultado)>=1){

		$res=mysqli_fetch_row($resultado);

		$id_ver=$res[0];

		echo"<script>window.location=\"ver_solicitud.php?id=$id_ver\";</script>";

	 }else

	 {

	 	echo"<script>alert(\"No se encontro numero de orden $buscar2\");</script>";

	 }

	}

?>

<?

$consulta_area="select presupuesto, gastado from areas where id=$idGA";

$resultado_area= mysqli_query($enlace,$consulta_area) or die("La consulta fallo $consulta_area: ". mysqli_error($enlace));

$res_area=mysqli_fetch_row($resultado_area);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
mysqli_num_rows(
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Textron</title>

<link rel="stylesheet" href="colorbox.css" />
mysqli_num_rows(
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

<script src="colorbox/jquery.colorbox-min.js" type="text/javascript"></script>

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

<script type="text/javascript">

	$(document).ready(function(){

		$(".iframe1").colorbox({iframe:true,width:"450", height:"600",transition:"fade", scrolling:true, opacity:0.1});

		$(".iframe2").colorbox({iframe:true,width:"450", height:"320",transition:"fade", scrolling:false, opacity:0.1});

		$(".iframe3").colorbox({iframe:true,width:"400", height:"200",transition:"fade", scrolling:false, opacity:0.1});

		$("#click").click(function(){ 

			$('#clmysqli_num_rows(kground-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");

			return false;

		});

	});

	function cerrarV(){

		$.fn.colorbox.close();

	}

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
mysqli_num_rows(
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}

  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];

  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);

  if(!x && d.getElementById) x=d.getElementById(n); return x;

}



function MM_swapImage() { //v3.0

  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)

   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}

}



function verev(dato,cuantos,esContrato){

    if(cuantos>=0) {

	document.form1.verev.value=dato;

        

        if(!esContrato)

            document.form1.action="evaluacion.php";

	else

            document.form1.action = 'evaluacionContrato.php';

        

	document.form1.submit();

    } else

        alert('La fecha de evaluación ha vencido y no puede ser accesada, comuniquese con su HRBP');

}



function verSoli(dato)

{

	document.form1.verSoli.value=dato;

	document.form1.action="cambia_solicitud.php";
mysqli_num_rows(
	document.form1.target="blank";

	document.form1.submit();

}


mysqli_num_rows(
 function abrirV(href){

        $.colorbox({iframe:true,width:"600", height:"600",transition:"fade", scrolling:true, opacity:0.1,href:href});

    }

	function eliminar(id){

	

        if(confirm('Deseas eliminar?')){

            var elem = document.createElement('input');

            elem.name='idSoli';

            elem.value = id;

            elem.type = 'hidden';

            $("#form1").append(elem);



            $("#form1").attr('action','eliminar_proveedores.php');

            $("#form1").submit();

        

    									}

    }

function progEv(idEv){

//        var myWindow2 = window.open("nueva_evaluacion.php?id="+idEv);

	form = document.getElementById('form1');

	elem = document.createElement('input');
mysqli_num_rows(
	elem.name = 'id';

	elem.value = idEv;

	elem.type = 'hidden';

	form.appendChild(elem);

	document.form1.action="nueva_evaluacion.php";

	document.form1.submit();

}



//-->

</script>





<style type="text/css">

<!--

.style1 {font-size: 24px}

-->
mysqli_num_rows(
</style>

</head>



<body onload="MM_preloadImages('images/b_cambio_r.png','images/b_administracion_r.png','images/b_log_out_r.png')">

<form id="form1" name="form1" method="post" action="">

<table width="100%" border="0" cellspacing="0" cellpadding="0">

  <tr>

    <td background="images/bkg_admin.jpg"><table width="900" border="0" align="center" cellpadding="0" cellspacing="0">

      <tr>mysqli_num_rows(

        <td><img src="images/header_1.jpg" width="900" height="107" /></td>

      </tr>

    </table></td>

  </tr>mysqli_num_rows(

  <tr>

    <td height="550" valign="top" background="images/bkg_fondo.jpg"><table width="900" border="0" align="center" cellpadding="0" cellspacing="0">

      <tr>

        <td><img src="images/spacer.gif" width="10" height="20" /></td>

      </tr>

      <tr>

        <td><div align="center">

          <table width="850" border="0" cellspacing="7" cellpadding="0">

            <tr>

              <td><div align="center" class="text_grande style1">BIENVENIDO A TU PORTAL ORDENES DE COMPRA</div></td>

            </tr>

			 <tr>

			   <td><div align="center" class="text_mediano"> <? echo $res2[0];?></div></td>

          	 </tr>

		  </table>

        </div></td>

      </tr>

      <tr>

        <td>&nbsp;</td>

      </tr>

      <tr>

        <td> <table width="800" border="0" bgcolor="#eeeeee" align="center">

          <tr>

            <td width="50%" align="center" >Presupuesto en dolares <b><? setlocale(LC_MONETARY, 'en_US'); echo money_format('%(#10n',$res_area[0]) ?></b></td>

            <td width="50%" align="center">Gastado en dolares <b><? setlocale(LC_MONETARY, 'en_US'); echo money_format('%(#10n',$res_area[1]) ?></b></td>

          </tr>

        </table></td>

      </tr>

      

      <tr>mysqli_num_rows(

        <td><table width="800" border="0" bgcolor="#eeeeee" align="center">

          <tr>

            <td align="center" class="boton" ><? if($idA==1 || $idA==2 || $idE==1 || $idE==2){?><a href="areas.php" class="iframe1" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image22','','images/b_info_s_r.png',1)"><img src="images/b_info_s.png" name="Image22"  border="0" id="Image22"></a><? }?></td>

			mysqli_num_rows(

            </tr>

			<tr>

            <td align="center" class="text_grande" >&nbsp;</td>

            </tr>

        </table></td>

      </tr>

      <tr>

        <td><table width="800" border="0" align="center" cellpadding="0" cellspacing="0">

          <tr>

            <td height="250" valign="top" bgcolor="#eeeeee"><table width="753" border="0" align="center" cellpadding="0" cellspacing="0">

              <tr>

                <td width="396"><img src="images/spacer.gif" width="10" height="20" />

                  <input name="verev" type="hidden" id="verev" />

                  Bienvenido <b><? echo $_SESSION['usuario']['nombre'];?></b></td>

				  <td width="185" align="right"><? if($idA!="5" ){?><img src="images/spacer.gif" width="10" height="20" />

<a href="adm_alta_solicitud.php" class="texto_tareas" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image28','','images/b_nueva_s_r.png',1)"><img src="images/b_nueva_s.png" name="Image28" width="114" height="23" border="0" id="Image28"></a>		<? }?></td>		 

              <td width="172" align="center"><? if($idA!="5" ){?><img src="images/spacer.gif" width="10" height="20" />

          <a href="historial.php" class="texto_tareas" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image27','','images/b_historial_r.png',1)"><img src="images/b_historial.png" name="Image27" width="71" height="23" border="0" id="Image27"></a><? }?></td>

			  </tr>

              

             

              <tr>

                <td><img src="images/spacer.gif" width="10" height="10" /></td>

              </tr>

             

              <tr>

                <td><p><b>Mis Solicitudes </b><img src="images/spacer.gif" width="10" height="20" /></p>

				<td width="185" align="center"></td>

				  <td width="172" align="center">                  </td>

              </tr>

              

            </table>

              <table width="100%" border="0" cellspacing="1" cellpadding="3">

	  <tr>mysqli_num_rows(

	   

		<td width="10%" bgcolor="#003198" class="text_mediano_blanco"><div align="center">FOLIO</div></td>

		<td width="19%" bgcolor="#003198" class="text_mediano_blanco"><div align="center">REQUISITOR</div></td>

		<td widthmysqli_num_rows("#003198" class="text_mediano_blanco"><div align="center">TITULO</div></td>

		<td width="12%" bgcolor="#003198" class="text_mediano_blanco"><div align="center">ESTATUS</div></td>

		<td width="10%" bgcolor="#003198" class="text_mediano_blanco"><div align="center">FECHA</div></td>

		<td width="19%" bgcolor="#003198" class="text_mediano_blanco"><div align="center">COMPRADOR</div></td>

		

		

		<td width="5%" bgcolor="#003198" class="text_mediano_blanco">&nbsp;</td>

	  </tr>

	  <?

	  							$count=1;

	  						while(@mysqli_num_rows($ejecuta)>=$count)

							

						{

							$res=mysqli_fetch_row($ejecuta);

							

							$consulta2  = "select count(id), max(fecha_solicitud) from solicitudes where id_solicitante=$idA";

							$resultado2 = mysqli_query($enlace,$consulta2) or die("La consulta fall&oacute;P1: " );

							

							if(@mysqli_num_rows($resultado2)>0)

								

							{

								$res22=mysqli_fetch_row($resultado2);

							}

							

					

							echo $estatus;

						?>

						

	  <tr>
mysqli_num_rows(
	 

		

		<td  class="text_mediano"><div align="center"><? echo $res[0];?></div></td>

		<td  class="text_mediano"><div align="center"><? echo $res[1];?></div></td>
mysqli_num_rows(
		<td  class="text_mediano"><div align="center"><? echo $res[5];?></div></td>

		<td  class="text_mediano"><div align="center"><? echo $res[3];?></div></td>

		<td  class="text_mediano"><div align="center"><? echo $res[2];?></div></td>

		<td  class="text_mediano"><div align="center"><? echo $res[4];?></div></td>

<td  class="text_mediano"><div align="center"><a href="cambia_solicitud.php?id=<? echo $res[0]?>" class="boton">Ver</a></div></td>

	  </tr>

	 <?	

							

							$count++;

						}

						?>

	</table>

	

	<br />	</td>

          </tr>

        </table>

		

		<p>

		    <? 

			$consul="SELECT usuarios.id, usuarios.nombre

				FROM usuarios

				WHERE usuarios.id_auxiliar=$idU";		

    $ejecut=mysqli_query($enlace,$consul)or die("Error al consultar $query234: ".mysqli_error($enlace));

	

		

		$contador=0;

		while(@mysqli_num_rows($ejecut)>$contador)					

						{

	$ReS=mysqli_fetch_row($ejecut);	?>

		  </p>

		  <p>&nbsp;</p>

		  <table width="800" border="0" align="center" cellpadding="0" cellspacing="0">

		   <td height="221" valign="top" bgcolor="#eeeeee">

		   <p>&nbsp;&nmysqli_num_rows(;&nbsp; <b>Solicitudes Pendientes de mi Auxiliar <? echo $ReS[1] ?></b> </p>

		   <table width="753" border="0" align="center" cellpadding="0" cellspacing="0">

  <tr>

    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">

	mysqli_num_rows(

	  <tr>

	   

<td width="8%" bgcolor="#003198" class="text_mediano_blanco"><div align="center">FOLIO</div></td>

		<td width="20%" bgcolor="#003198" class="text_mediano_blanco"><div align="center">REQUISITOR</div></td>

		<td width="23%" bgcolor="#003198" class="text_mediano_blanco"><div align="center">TITULO</div></td>

		<td width="10%" bgcolor="#003198" class="text_mediano_blanco"><div align="center">ESTATUS</div></td>

		<td width="12%" bgcolor="#003198" class="text_mediano_blanco"><div align="center">FECHA</div></td>

		<td width="22%" bgcolor="#003198" class="text_mediano_blanco"><div align="center">COMPRADOR</div></td>

		

		

		<td width="3%" bgcolor="#003198" class="text_mediano_blanco">&nbsp;</td>

	  </tr>

	  <?

	  //para auxiliar de mis solicitudes

	

		

	

	

	$consUL2="SELECT solicitudes.id AS id, usuarios.nombre AS requisitor, solicitudes.fecha_solicitud AS fecha, estatus.nombre AS estatus, u1.nombre, left(solicitudes.titulo, 30)

        FROM solicitudes

    	INNER JOIN estatus ON estatus.id = solicitudes.id_estatus

		INNER JOIN usuarios ON usuarios.id = solicitudes.id_solicitante

		INNER JOIN usuarios AS u1 ON u1.id = solicitudes.id_comprador

		WHERE usuarios.id_auxiliar=$idU and id_estatus<>9 and usuarios.id=$ReS[0] and solicitudes.fecha_solicitud > SUBDATE( solicitudes.fecha_solicitud, INTERVAL 3 DAY)  order by id desc";

		

    $eje44=mysqli_query($enlace,$consUL2)or die("Error al consultar $query44: ".mysqli_error($enlace)); 

	  

	  

	  							$countmysqli_num_rows(

	  						while(@mysqli_num_rows($eje44)>=$count424)

							

						{

							$resmysqli_num_rows(_row($eje44);

							

							$consulta424  = "select count(id), max(fecha_solicitud) from solicitudes where id_solicitante=$idA";

							$resultado424 = mysqli_query($enlace,$consulta424) or die("La consulta fall&oacute;P1: " );

					

						?>

						

	  <tr>

	 

		

		<td  class="text_mediano"><div align="center"><? echo $res424[0];?></div></td>

		<td  class="text_mediano"><div align="center"><? echo $res424[1];?></div></td>

		<td  class="text_mediano"><div align="center"><? echo $res424[5];?></div></td>

		<td  class="text_mediano"><div align="center"><? echo $res424[3];?></div></td>

		<td  class="text_mediano"><div align="center"><? echo $res424[2];?></div></td>

		<td  class="text_mediano"><div align="center"><? echo $res424[4];?></div></td>

<td  class="text_mediano"><div align="center"><a href="cambia_solicitud.php?id=<? echo $res424[0]?>" class="boton">Ver</a></div></td>

	  </tr>

	 <?	

							

							$count424++;

						}

						$contador++;

						

						?>

	</table></td>

  </tr>

</table>

</table>

	<? }?>

		<p>

		    <? if($idGA=$resES){?>

		  </p>

		  <p>&nbsp;</p>
mysqli_num_rows(
		  <table width="800" border="0" align="center" cellpadding="0" cellspacing="0">

		   <td height="221" valign="top" bgcolor="#eeeeee">

		   <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>Solicitudes Pendientes de Gerente de Área</b> </p>

		   <table width="753" border="0" align="center" cellpadding="0" cellspacing="0">
mysqli_num_rows(
  <tr>

    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">

	

	  <tr>

	   

<td width="8%" bgcolor="#003198" class="text_mediano_blanco"><div align="center">FOLIO</div></td>

		<td width="20%" bgcolor="#003198" class="text_mediano_blanco"><div align="center">REQUISITOR</div></td>

		<td width="23%" bgcolor="#003198" class="text_mediano_blanco"><div align="center">TITULO</div></td>

		<td width="10%" bgcolor="#003198" class="text_mediano_blanco"><div align="center">ESTATUS</div></td>

		<td width="12%" bgcolor="#003198" class="text_mediano_blanco"><div align="center">FECHA</div></td>

		<td width="22%" bgcolor="#003198" class="text_mediano_blanco"><div align="center">COMPRADOR</div></td>

		

		

		<td width="5%" bgcolor="#003198" class="text_mediano_blanco">&nbsp;</td>

	  </tr>

	  <?

	  							$count44=1;

	  						while(@mysqli_num_rows($ejecuta44)>=$count44)

							

						{

							$res44=mysqli_fetch_row($ejecuta44);

							

							$consulta44  = "select count(id), max(fecha_solicitud) from solicitudes where id_solicitante=$idA";

							$resultado44 = mysqli_query($enlace,$consulta44) or die("La consulta fall&oacute;P1: " );

							

							if(@mysqli_num_rows($resultado44)>0)

								

							{

								$res444=mysqli_fetch_row($resultado44);
mysqli_num_rows(
							}

							

					

							echo $estatus;
mysqli_num_rows(
						?>

						

	  <tr>

	 

		

		<td  class="text_mediano"><div align="center"><? echo $res44[0];?></div></td>

		<td  class="text_mediano"><div align="center"><? echo $res44[1];?></div></td>

		<td  class="text_mediano"><div align="center"><? echo $res44[5];?></div></td>

		<td  class="text_mediano"><div align="center"><? echo $res44[3];?></div></td>

		<td  class="text_mediano"><div align="center"><? echo $res44[2];?></div></td>

		<td  class="text_mediano"><div align="center"><? echo $res44[4];?></div></td>

<td  class="text_mediano"><div align="center"><a href="ver_solicitud.php?id=<? echo $res44[0]?>" class="boton">Ver</a></div></td>

	  </tr>

	 <?	

							

							$count44++;

						}

						?>

	</table></td>

  </tr>

</table>

</table>

	<? }?>

	

	

	<p>

		    <? 

			$query234="SELECT areas.id, usuarios.id

				FROM areas

				INNER JOIN usuarios ON usuarios.id = areas.id_gerente

				WHERE usuarios.id_auxiliar=$idU";		

    $ejecuta234=mysqli_query($enlace,$query234)or die("Error al consultar $query234: ".mysqli_error($enlace));

	

		mysqli_num_rows(

		if(@mysqli_num_rows($ejecuta234)>0)					

						{?>

		  </p>

		  <p>&nbsmysqli_num_rows(

		  <table width="800" border="0" align="center" cellpadding="0" cellspacing="0">

		   <td height="221" valign="top" bgcolor="#eeeeee">

		   <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>Solicitudes Pendientes de Auxiliar Gerente de Área</b> </p>

		   <table width="753" border="0" align="center" cellpadding="0" cellspacing="0">

  <tr>

    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">

	

	  <tr>

	   

<td width="8%" bgcolor="#003198" class="text_mediano_blanco"><div align="center">FOLIO</div></td>

		<td width="20%" bgcolor="#003198" class="text_mediano_blanco"><div align="center">REQUISITOR</div></td>

		<td width="23%" bgcolor="#003198" class="text_mediano_blanco"><div align="center">TITULO</div></td>

		<td width="10%" bgcolor="#003198" class="text_mediano_blanco"><div align="center">ESTATUS</div></td>

		<td width="12%" bgcolor="#003198" class="text_mediano_blanco"><div align="center">FECHA</div></td>

		<td width="22%" bgcolor="#003198" class="text_mediano_blanco"><div align="center">COMPRADOR</div></td>

		

		

		<td width="3%" bgcolor="#003198" class="text_mediano_blanco">&nbsp;</td>

	  </tr>

	  <?

	  //para auxiliar gerente de area

	$query234="SELECT areas.id, usuarios.id

				FROM areas

				INNER JOIN usuarios ON usuarios.id = areas.id_gerente

				WHERE usuarios.id_auxiliar=$idU";		

    $ejecuta234=mysqli_query($enlace,$query234)or die("Error al consultar $query234: ".mysqli_error($enlace));

	

		$count=0;
mysqli_num_rows(
		while(@mysqli_num_rows($ejecuta234)>$count)					

						{

	$resE=mysqli_fetch_row($ejecuta234);

	
mysqli_num_rows(
	

	$query44="SELECT solicitudes.id AS id, usuarios.nombre AS requisitor, solicitudes.fecha_solicitud AS fecha, estatus.nombre AS estatus, u1.nombre, left(solicitudes.titulo, 30)

        FROM solicitudes

    	INNER JOIN estatus ON estatus.id = solicitudes.id_estatus

		INNER JOIN usuarios ON usuarios.id = solicitudes.id_solicitante

		INNER JOIN usuarios AS u1 ON u1.id = solicitudes.id_comprador

		INNER JOIN areas ON areas.id = solicitudes.id_area

		WHERE areas.id='$resE[0]' and id_estatus=4 and solicitudes.fecha_solicitud > SUBDATE( solicitudes.fecha_solicitud, INTERVAL 3 DAY) ";

		

    $ejecuta44=mysqli_query($enlace,$query44)or die("Error al consultar $query44: ".mysqli_error($enlace)); 

	  

	  

	  							$count44=1;

	  						while(@mysqli_num_rows($ejecuta44)>=$count44)

							

						{

							$res44=mysqli_fetch_row($ejecuta44);

							

							$consulta44  = "select count(id), max(fecha_solicitud) from solicitudes where id_solicitante=$idA";

							$resultado44 = mysqli_query($enlace,$consulta44) or die("La consulta fall&oacute;P1: " );

							

							if(@mysqli_num_rows($resultado44)>0)

								

							{

								$res444=mysqli_fetch_row($resultado44);

							}

							

					

							echo $estatus;

						?>

						

	  <tr>

	 

		
mysqli_num_rows(
		<td  class="text_mediano"><div align="center"><? echo $res44[0];?></div></td>

		<td  class="text_mediano"><div align="center"><? echo $res44[1];?></div></td>

		<td  class="text_mediano"><div align="center"><? echo $res44[5];?></div></td>

		<td  class="text_mediano"><div align="center"><? echo $res44[3];?></div></td>
mysqli_num_rows(
		<td  class="text_mediano"><div align="center"><? echo $res44[2];?></div></td>

		<td  class="text_mediano"><div align="center"><? echo $res44[4];?></div></td>

<td  class="text_mediano"><div align="center"><a href="ver_solicitud.php?id=<? echo $res44[0]?>" class="boton">Ver</a></div></td>

	  </tr>

	 <?	

							

							$count44++;

						}

						$count++;

						}

						?>

	</table></td>

  </tr>

</table>

</table>

	<? }?>

	

	

	<p>

		    <? if($idE=="1"){?>

		  </p>

		  <p>&nbsp;</p>

		  <table width="800" border="0" align="center" cellpadding="0" cellspacing="0">

		   <td height="221" valign="top" bgcolor="#eeeeee">

		   <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>Solicitudes Pendientes de Gerente de Planta</b> </p>

		   <table width="753" border="0" align="center" cellpadding="0" cellspacing="0">

  <tr>

    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">

	

	  <tr>

	   

<td width="8%" bgcolor="#003198" class="text_mediano_blanco"><div align="center">FOLIO</div></td>

		<td width="20%" bgcolor="#003198" class="text_mediano_blanco"><div align="center">REQUISITOR</div></td>

		<td width="23%" bgcolor="#003198" class="text_mediano_blanco"><div align="center">TITULO</div></td>

		<td width="10%" bgcolor="#003198" class="text_mediano_blanco"><div align="center">ESTATUS</div></td>

		<td width="12%" bgcolor="#003198" class="text_mediano_blanco"><div align="center">FECHA</div></td>
mysqli_num_rows(
		<td width="22%" bgcolor="#003198" class="text_mediano_blanco"><div align="center">COMPRADOR</div></td>

		

		

		<td width="3%" bgcolor="#003198" class="text_mediano_blanco">&nbsp;</td>
mysqli_num_rows(
	  </tr>

	  <?

	  							$count55=1;

	  						while(@mysqli_num_rows($ejecuta55)>=$count55)

							

						{

							$res55=mysqli_fetch_row($ejecuta55);

							

							$consulta55  = "select count(id), max(fecha_solicitud) from solicitudes where id_solicitante=$idA";

							$resultado55 = mysqli_query($enlace,$consulta55) or die("La consulta fall&oacute;P1: " );

							

							if(@mysqli_num_rows($resultado55)>0)

								

							{

								$res555=mysqli_fetch_row($resultado55);

							}

							

					

							echo $estatus;

						?>

						

	  <tr>

	 

		

		<td  class="text_mediano"><div align="center"><? echo $res55[0];?></div></td>

		<td  class="text_mediano"><div align="center"><? echo $res55[1];?></div></td>

		<td  class="text_mediano"><div align="center"><? echo $res55[5];?></div></td>

		<td  class="text_mediano"><div align="center"><? echo $res55[3];?></div></td>

		<td  class="temysqli_num_rows(v align="center"><? echo $res55[2];?></div></td>

		<td  class="text_mediano"><div align="center"><? echo $res55[4];?></div></td>

<td  class="text_mediano"><div align="center"><a href="ver_solicitud.php?id=<? echo $res55[0]?>" class="boton">Ver</a></div></td>

	  </tr>

	 <?	mysqli_num_rows(

							

							$count55++;

						}

						?>

	</table></td>

  </tr>

</table>

</table>

<? }?>

<p>

	 <? 

			

			//para gerente auxiliar de Gerente Planta

	$query234="SELECT usuarios.id_auxiliar, usuarios.id

				FROM usuarios

				INNER JOIN solicitudes on solicitudes.id_planta=usuarios.id

				

				";		

    $ejecuta234=mysqli_query($enlace,$query234)or die("Error al consultar $query234: ".mysqli_error($enlace));

		$resFIN=mysqli_fetch_row($ejecuta234);

		

		if($resFIN[0]==$idU)					

						{?>

		  </p>

		  <p>&nbsp;</p>

		  <table width="800" border="0" align="center" cellpadding="0" cellspacing="0">

		   <td height="221" valign="top" bgcolor="#eeeeee">

		   <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>Solicitudes Pendientes Auxiliar de Gerente de Planta</b> </p>

		   <table width="753" border="0" align="center" cellpadding="0" cellspacing="0">

  <tr>

    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">

	

	  <tr>

	   

<td width="8%" bgcolor="#003198" class="text_mediano_blanco"><div align="center">FOLIO</div></td>

		<td width="20%" bgcolor="#003198" class="text_mediano_blanco"><div align="center">REQUISITOR</div></td>

		<td width="23%" bgcolor="#003198" class="text_mediano_blanco"><div align="center">TITULO</div></td>

		<td width="10%" bgcolor="#003198" class="text_mediano_blanco"><div align="center">ESTATUS</div></td>

		<td width="12%" bgcolor="#003198" class="text_mediano_blanco"><div align="center">FECHA</div></td>

		<td width="22%" bgcolor="#003198" class="text_mediano_blanco"><div align="center">COMPRADOR</div></td>

		

		

		<td width="3%" bgcolor="#003198" class="text_mediano_blanco">&nbsp;</td>

	  </tr>

	  <?

	  							$count55=1;

	  						while(@mysqli_num_rows($ejecuta55)>=$count55)

							

						{

							$res55=mysqli_fetch_row($ejecuta55);

							

							$consulta55  = "select count(id), max(fecha_solicitud) from solicitudes where id_solicitante=$idA";

							$resultado55 = mysqli_query($enlace,$consulta55) or die("La consulta fall&oacute;P1: " );

							

							if(@mysqli_num_rows($resultado55)>0)

								

							{

								$res555=mysqli_fetch_row($resultado55);

							}

							

					

							echo $estatus;

						?>

						

	  <tr>

	 

		

		<td  class="text_mediano"><div align="center"><? echo $res55[0];?></div></td>

		<td  class="text_mediano"><div align="center"><? echo $res55[1];?></div></td>

		<td  class="text_mediano"><div align="center"><? echo $res55[5];?></div></td>

		<td  class="text_mediano"><div align="center"><? echo $res55[3];?></div></td>

		<td  class="text_mediano"><div align="center"><? echo $res55[2];?></div></td>

		<td  class="text_mediano"><div align="center"><? echo $res55[4];?></div></td>

<td  class="text_mediano"><div align="center"><a href="ver_solicitud.php?id=<? echo $res55[0]?>" class="boton">Ver</a></div></td>

	  </tr>

	 <?	

							

							$count55++;

						}

						?>

	</table></td>

  </tr>

</table>

</table>

	 <? }?>

	 

	 <p>

		    <? if($idE=="2"){?>

		  </p>

		  <p>&nbsp;</p>

		  <table width="800" border="0" align="center" cellpadding="0" cellspacing="0">

		   <td height="221" valign="top" bgcolor="#eeeeee">

		   <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>Solicitudes Pendientes de Finanzas</b> </p>

		   <table width="753" border="0" align="center" cellpadding="0" cellspacing="0">

  <tr>

    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">

	

	  <tr>

	   

<td width="8%" bgcolor="#003198" class="text_mediano_blanco"><div align="center">FOLIO</div></td>

		<td width="20%" bgcolor="#003198" class="text_mediano_blanco"><div align="center">REQUISITOR</div></td>

		<td width="23%" bgcolor="#003198" class="text_mediano_blanco"><div align="center">TITULO</div></td>

		<td width="10%" bgcolor="#003198" class="text_mediano_blanco"><div align="center">ESTATUS</div></td>

		<td width="12%" bgcolor="#003198" class="text_mediano_blanco"><div align="center">FECHA</div></td>

		<td width="22%" bgcolor="#003198" class="text_mediano_blanco"><div align="center">COMPRADOR</div></td>

		

		

		<td width="3%" bgcolor="#003198" class="text_mediano_blanco">&nbsp;</td>

	  </tr>

	  <?

	  							$count66=1;

	  						while(@mysqli_num_rows($ejecuta66)>=$count66)

							

						{

							$res66=mysqli_fetch_row($ejecuta66);

							

							$consulta66  = "select count(id), max(fecha_solicitud) from solicitudes where id_solicitante=$idA";

							$resultado66 = mysqli_query($enlace,$consulta66) or die("La consulta fall&oacute;P1: " );

							

							if(@mysqli_num_rows($resultado66)>0)

								

							{

								$res666=mysqli_fetch_row($resultado66);

							}

							

					

							echo $estatus;

						?>

						

	  <tr>

	 

		

		<td  class="text_mediano"><div align="center"><? echo $res66[0];?></div></td>

		<td  class="text_mediano"><div align="center"><? echo $res66[1];?></div></td>

		<td  class="text_mediano"><div align="center"><? echo $res66[5];?></div></td>

		<td  class="text_mediano"><div align="center"><? echo $res66[3];?></div></td>

		<td  class="text_mediano"><div align="center"><? echo $res66[2];?></div></td>

		<td  class="text_mediano"><div align="center"><? echo $res66[4];?></div></td>

<td  class="text_mediano"><div align="center"><a href="ver_solicitud.php?id=<? echo $res66[0]?>" class="boton">Ver</a></div></td>

	  </tr>

	 <?	

							

							$count66++;

						}

						?>

	</table></td>

  </tr>

</table>

</table>

	 <? }?>

	 

	  <p>

		    <? 

			

			//para gerente auxiliar de Finanzas

	$query234="SELECT id_auxiliar

				FROM usuarios

				WHERE es_finanzas=2";		

    $ejecuta234=mysqli_query($enlace,$query234)or die("Error al consultar $query234: ".mysqli_error($enlace));

		$resFIN=mysqli_fetch_row($ejecuta234);

		

		if($resFIN[0]==$idU)					

						{?>

		  </p>

		  <p>&nbsp;</p>

		  <table width="800" border="0" align="center" cellpadding="0" cellspacing="0">

		   <td height="221" valign="top" bgcolor="#eeeeee">

		   <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>Solicitudes Pendientes Auxiliar de Finanzas</b> </p>

		   <table width="753" border="0" align="center" cellpadding="0" cellspacing="0">

  <tr>

    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">

	

	  <tr>

	   

<td width="8%" bgcolor="#003198" class="text_mediano_blanco"><div align="center">FOLIO</div></td>

		<td width="20%" bgcolor="#003198" class="text_mediano_blanco"><div align="center">REQUISITOR</div></td>

		<td width="23%" bgcolor="#003198" class="text_mediano_blanco"><div align="center">TITULO</div></td>

		<td width="10%" bgcolor="#003198" class="text_mediano_blanco"><div align="center">ESTATUS</div></td>

		<td width="12%" bgcolor="#003198" class="text_mediano_blanco"><div align="center">FECHA</div></td>

		<td width="22%" bgcolor="#003198" class="text_mediano_blanco"><div align="center">COMPRADOR</div></td>

		

		

		<td width="3%" bgcolor="#003198" class="text_mediano_blanco">&nbsp;</td>

	  </tr>

	  <?

	  							$count664=1;

	  						while(@mysqli_num_rows($ejecuta664)>=$count664)

							

						{

							$res664=mysqli_fetch_row($ejecuta664);

							

							$consulta664  = "select count(id), max(fecha_solicitud) from solicitudes where id_solicitante=$idA";

							$resultado664 = mysqli_query($enlace,$consulta66) or die("La consulta fall&oacute;P1: " );

							

							if(@mysqli_num_rows($resultado664)>0)

								

							{

								$res6664=mysqli_fetch_row($resultado664);

							}

							

					

							echo $estatus;

						?>

						

	  <tr>

	 

		

		<td  class="text_mediano"><div align="center"><? echo $res664[0];?></div></td>

		<td  class="text_mediano"><div align="center"><? echo $res664[1];?></div></td>

		<td  class="text_mediano"><div align="center"><? echo $res664[5];?></div></td>

		<td  class="text_mediano"><div align="center"><? echo $res664[3];?></div></td>

		<td  class="text_mediano"><div align="center"><? echo $res664[2];?></div></td>

		<td  class="text_mediano"><div align="center"><? echo $res664[4];?></div></td>

<td  class="text_mediano"><div align="center"><a href="ver_solicitud.php?id=<? echo $res664[0]?>" class="boton">Ver</a></div></td>

	  </tr>

	 <?	

							

							$count664++;

						}

						?>

	</table></td>

  </tr>

</table>

</table>

	 <? }?>

	 

	 

	  <p>

		    <? if($idE=="5"){?>

		  </p>

		  <p>&nbsp;</p>

		  <table width="800" border="0" align="center" cellpadding="0" cellspacing="0">

		   <td height="221" valign="top" bgcolor="#eeeeee">

		   <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>Solicitudes Pendientes de Sistemas</b> </p>

		   <table width="753" border="0" align="center" cellpadding="0" cellspacing="0">

  <tr>

    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">

	

	  <tr>

	   

<td width="8%" bgcolor="#003198" class="text_mediano_blanco"><div align="center">FOLIO</div></td>

		<td width="20%" bgcolor="#003198" class="text_mediano_blanco"><div align="center">REQUISITOR</div></td>

		<td width="23%" bgcolor="#003198" class="text_mediano_blanco"><div align="center">TITULO</div></td>

		<td width="10%" bgcolor="#003198" class="text_mediano_blanco"><div align="center">ESTATUS</div></td>

		<td width="12%" bgcolor="#003198" class="text_mediano_blanco"><div align="center">FECHA</div></td>

		<td width="22%" bgcolor="#003198" class="text_mediano_blanco"><div align="center">COMPRADOR</div></td>

		

		

		<td width="3%" bgcolor="#003198" class="text_mediano_blanco">&nbsp;</td>

	  </tr>

	  <?

	  							$count555=1;

	  						while(@mysqli_num_rows($ejecuta555)>=$count555)

							

						{

							$res555=mysqli_fetch_row($ejecuta555);

							

							$consulta555  = "select count(id), max(fecha_solicitud) from solicitudes where id_solicitante=$idA";

							$resultado555 = mysqli_query($enlace,$consulta555) or die("La consulta fall&oacute;P1: " );

							

							if(@mysqli_num_rows($resultado555)>0)

								

							{

								$res5555=mysqli_fetch_row($resultado555);

							}

							

					

							echo $estatus;

						?>

						

	  <tr>

	 

		

		<td  class="text_mediano"><div align="center"><? echo $res555[0];?></div></td>

		<td  class="text_mediano"><div align="center"><? echo $res555[1];?></div></td>

		<td  class="text_mediano"><div align="center"><? echo $res555[5];?></div></td>

		<td  class="text_mediano"><div align="center"><? echo $res555[3];?></div></td>

		<td  class="text_mediano"><div align="center"><? echo $res555[2];?></div></td>

		<td  class="text_mediano"><div align="center"><? echo $res555[4];?></div></td>

<td  class="text_mediano"><div align="center"><a href="ver_solicitud.php?id=<? echo $res555[0]?>" class="boton">Ver</a></div></td>

	  </tr>

	 <?	

							

							$count555++;

						}

						?>

	</table></td>

  </tr>

</table>

</table>

	 <? }?>

	 

	<p>

		    <? 

			

			//para gerente auxiliar de Sistemas

	$query234="SELECT id_auxiliar

				FROM usuarios

				WHERE es_finanzas=5";		

    $ejecuta234=mysqli_query($enlace,$query234)or die("Error al consultar $query234: ".mysqli_error($enlace));

		$resFIN=mysqli_fetch_row($ejecuta234);

		

		if($resFIN[0]==$idU)					

						{?>

		  </p>

		  <p>&nbsp;</p>

		  <table width="800" border="0" align="center" cellpadding="0" cellspacing="0">

		   <td height="221" valign="top" bgcolor="#eeeeee">

		   <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>Solicitudes Pendientes Auxiliar de Sistemas</b> </p>

		   <table width="753" border="0" align="center" cellpadding="0" cellspacing="0">

  <tr>

    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">

	

	  <tr>

	   

<td width="8%" bgcolor="#003198" class="text_mediano_blanco"><div align="center">FOLIO</div></td>

		<td width="20%" bgcolor="#003198" class="text_mediano_blanco"><div align="center">REQUISITOR</div></td>

		<td width="23%" bgcolor="#003198" class="text_mediano_blanco"><div align="center">TITULO</div></td>

		<td width="10%" bgcolor="#003198" class="text_mediano_blanco"><div align="center">ESTATUS</div></td>

		<td width="12%" bgcolor="#003198" class="text_mediano_blanco"><div align="center">FECHA</div></td>

		<td width="22%" bgcolor="#003198" class="text_mediano_blanco"><div align="center">COMPRADOR</div></td>

		

		

		<td width="3%" bgcolor="#003198" class="text_mediano_blanco">&nbsp;</td>

	  </tr>

	  <?

	  							$count5559=1;

	  						while(@mysqli_num_rows($ejecuta5559)>=$count5559)

							

						{

							$res5559=mysqli_fetch_row($ejecuta5559);

							

							$consulta5559  = "select count(id), max(fecha_solicitud) from solicitudes where id_solicitante=$idA";

							$resultado5559 = mysqli_query($enlace,$consulta5559) or die("La consulta fall&oacute;P1: " );

							

							if(@mysqli_num_rows($resultado5559)>0)

								

							{

								$res55559=mysqli_fetch_row($resultado5559);

							}

							

					

							echo $estatus;

						?>

						

	  <tr>

	 

		

		<td  class="text_mediano"><div align="center"><? echo $res5559[0];?></div></td>

		<td  class="text_mediano"><div align="center"><? echo $res5559[1];?></div></td>

		<td  class="text_mediano"><div align="center"><? echo $res5559[5];?></div></td>

		<td  class="text_mediano"><div align="center"><? echo $res5559[3];?></div></td>

		<td  class="text_mediano"><div align="center"><? echo $res5559[2];?></div></td>

		<td  class="text_mediano"><div align="center"><? echo $res5559[4];?></div></td>

<td  class="text_mediano"><div align="center"><a href="ver_solicitud.php?id=<? echo $res5559[0]?>" class="boton">Ver</a></div></td>

	  </tr>

	 <?	

							

							$count5559++;

						}

						?>

	</table></td>

  </tr>

</table>

</table>

	 <? }?>

	 

	 

	 <p>

		    <? if($idE=="4"){?>

		  </p>

		  <p>&nbsp;</p>

		  <table width="800" border="0" align="center" cellpadding="0" cellspacing="0">

		   <td height="221" valign="top" bgcolor="#eeeeee">

		   <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>Solicitudes Pendientes de Calibración</b> </p>

		   <table width="753" border="0" align="center" cellpadding="0" cellspacing="0">

  <tr>

    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">

	

	  <tr>

	   

<td width="8%" bgcolor="#003198" class="text_mediano_blanco"><div align="center">FOLIO</div></td>

		<td width="20%" bgcolor="#003198" class="text_mediano_blanco"><div align="center">REQUISITOR</div></td>

		<td width="23%" bgcolor="#003198" class="text_mediano_blanco"><div align="center">TITULO</div></td>

		<td width="10%" bgcolor="#003198" class="text_mediano_blanco"><div align="center">ESTATUS</div></td>

		<td width="12%" bgcolor="#003198" class="text_mediano_blanco"><div align="center">FECHA</div></td>

		<td width="22%" bgcolor="#003198" class="text_mediano_blanco"><div align="center">COMPRADOR</div></td>

		

		

		<td width="3%" bgcolor="#003198" class="text_mediano_blanco">&nbsp;</td>

	  </tr>

	  <?

	  							$count444=1;

	  						while(@mysqli_num_rows($ejecuta444)>=$count444)

							

						{

							$res444=mysqli_fetch_row($ejecuta444);

							

							$consulta444  = "select count(id), max(fecha_solicitud) from solicitudes where id_solicitante=$idA";

							$resultado444 = mysqli_query($enlace,$consulta444) or die("La consulta fall&oacute;P1: " );

							

							if(@mysqli_num_rows($resultado444)>0)

								

							{

								$res4444=mysqli_fetch_row($resultado444);

							}

							

					

							echo $estatus;

						?>

						

	  <tr>

	 

		

		<td  class="text_mediano"><div align="center"><? echo $res444[0];?></div></td>

		<td  class="text_mediano"><div align="center"><? echo $res444[1];?></div></td>

		<td  class="text_mediano"><div align="center"><? echo $res444[5];?></div></td>

		<td  class="text_mediano"><div align="center"><? echo $res444[3];?></div></td>

		<td  class="text_mediano"><div align="center"><? echo $res444[2];?></div></td>

		<td  class="text_mediano"><div align="center"><? echo $res444[4];?></div></td>

<td  class="text_mediano"><div align="center"><a href="ver_solicitud.php?id=<? echo $res444[0]?>" class="boton">Ver</a></div></td>

	  </tr>

	 <?	

							

							$count444++;

						}

						?>

	</table></td>

  </tr>

</table>

</table>

	 <? }?>

	 

	  <p>

		    <? 

			

			//para gerente auxiliar de Calibracion

	$query234="SELECT id_auxiliar

				FROM usuarios

				WHERE es_finanzas=4";		

    $ejecuta234=mysqli_query($enlace,$query234)or die("Error al consultar $query234: ".mysqli_error($enlace));

		$resFIN=mysqli_fetch_row($ejecuta234);

		

		if($resFIN[0]==$idU)					

						{?>

		  </p>

		  <p>&nbsp;</p>

		  <table width="800" border="0" align="center" cellpadding="0" cellspacing="0">

		   <td height="221" valign="top" bgcolor="#eeeeee">

		   <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>Solicitudes Pendientes Auxiliar de Calibración</b> </p>

		   <table width="753" border="0" align="center" cellpadding="0" cellspacing="0">

  <tr>

    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">

	

	  <tr>

	   

<td width="8%" bgcolor="#003198" class="text_mediano_blanco"><div align="center">FOLIO</div></td>

		<td width="20%" bgcolor="#003198" class="text_mediano_blanco"><div align="center">REQUISITOR</div></td>

		<td width="23%" bgcolor="#003198" class="text_mediano_blanco"><div align="center">TITULO</div></td>

		<td width="10%" bgcolor="#003198" class="text_mediano_blanco"><div align="center">ESTATUS</div></td>

		<td width="12%" bgcolor="#003198" class="text_mediano_blanco"><div align="center">FECHA</div></td>

		<td width="22%" bgcolor="#003198" class="text_mediano_blanco"><div align="center">COMPRADOR</div></td>

		

		

		<td width="3%" bgcolor="#003198" class="text_mediano_blanco">&nbsp;</td>

	  </tr>

	  <?

	  							$count4442=1;

	  						while(@mysqli_num_rows($ejecuta4442)>=$count4442)

							

						{

							$res4442=mysqli_fetch_row($ejecuta4442);

							

							$consulta4442  = "select count(id), max(fecha_solicitud) from solicitudes where id_solicitante=$idA";

							$resultado4442 = mysqli_query($enlace,$consulta4442) or die("La consulta fall&oacute;P1: " );

							

							if(@mysqli_num_rows($resultado4442)>0)

								

							{

								$res44442=mysqli_fetch_row($resultado4442);

							}

							

					

							echo $estatus;

						?>

						

	  <tr>

	 

		

		<td  class="text_mediano"><div align="center"><? echo $res4442[0];?></div></td>

		<td  class="text_mediano"><div align="center"><? echo $res4442[1];?></div></td>

		<td  class="text_mediano"><div align="center"><? echo $res4442[5];?></div></td>

		<td  class="text_mediano"><div align="center"><? echo $res4442[3];?></div></td>

		<td  class="text_mediano"><div align="center"><? echo $res4442[2];?></div></td>

		<td  class="text_mediano"><div align="center"><? echo $res4442[4];?></div></td>

<td  class="text_mediano"><div align="center"><a href="ver_solicitud.php?id=<? echo $res4442[0]?>" class="boton">Ver</a></div></td>

	  </tr>

	 <?	

							

							$count4442++;

						}

						?>

	</table></td>

  </tr>

</table>

</table>

	 <? }?>

	 

	 <p>

		    <? if($idE=="3"){?>

		  </p>

		  <p>&nbsp;</p>

		  <table width="800" border="0" align="center" cellpadding="0" cellspacing="0">

		   <td height="221" valign="top" bgcolor="#eeeeee">

		   <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>Solicitudes Pendientes de Seguridad</b> </p>

		   <table width="753" border="0" align="center" cellpadding="0" cellspacing="0">

  <tr>

    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">

	

	  <tr>

	   

<td width="8%" bgcolor="#003198" class="text_mediano_blanco"><div align="center">FOLIO</div></td>

		<td width="20%" bgcolor="#003198" class="text_mediano_blanco"><div align="center">REQUISITOR</div></td>

		<td width="23%" bgcolor="#003198" class="text_mediano_blanco"><div align="center">TITULO</div></td>

		<td width="10%" bgcolor="#003198" class="text_mediano_blanco"><div align="center">ESTATUS</div></td>

		<td width="12%" bgcolor="#003198" class="text_mediano_blanco"><div align="center">FECHA</div></td>

		<td width="22%" bgcolor="#003198" class="text_mediano_blanco"><div align="center">COMPRADOR</div></td>

		

		

		<td width="3%" bgcolor="#003198" class="text_mediano_blanco">&nbsp;</td>

	  </tr>

	  <?

	  							$count333=1;

	  						while(@mysqli_num_rows($ejecuta333)>=$count333)

							

						{

							$res333=mysqli_fetch_row($ejecuta333);

							

							$consulta333  = "select count(id), max(fecha_solicitud) from solicitudes where id_solicitante=$idA";

							$resultado333 = mysqli_query($enlace,$consulta333) or die("La consulta fall&oacute;P1: " );

							

							if(@mysqli_num_rows($resultado333)>0)

								

							{

								$res3333=mysqli_fetch_row($resultado333);

							}

							

					

							echo $estatus;

						?>

						

	  <tr>

	 

		

		<td  class="text_mediano"><div align="center"><? echo $res333[0];?></div></td>

		<td  class="text_mediano"><div align="center"><? echo $res333[1];?></div></td>

		<td  class="text_mediano"><div align="center"><? echo $res333[5];?></div></td>

		<td  class="text_mediano"><div align="center"><? echo $res333[3];?></div></td>

		<td  class="text_mediano"><div align="center"><? echo $res333[2];?></div></td>

		<td  class="text_mediano"><div align="center"><? echo $res333[4];?></div></td>

<td  class="text_mediano"><div align="center"><a href="ver_solicitud.php?id=<? echo $res333[0]?>" class="boton">Ver</a></div></td>

	  </tr>

	 <?	

							

							$count333++;

						}

						?>

	</table></td>

  </tr>

</table>

</table>

	 <? }?>

	 

	 

	  <p>

		    <? 

			

			//para gerente auxiliar de Seguridad

	$query234="SELECT id_auxiliar

				FROM usuarios

				WHERE es_finanzas=3";		

    $ejecuta234=mysqli_query($enlace,$query234)or die("Error al consultar $query234: ".mysqli_error($enlace));

		$resFIN=mysqli_fetch_row($ejecuta234);

		

		if($resFIN[0]==$idU)					

						{?>

		  </p>

		  <p>&nbsp;</p>

		  <table width="800" border="0" align="center" cellpadding="0" cellspacing="0">

		   <td height="221" valign="top" bgcolor="#eeeeee">

		   <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>Solicitudes Pendientes Auxiliar de Seguridad</b> </p>

		   <table width="753" border="0" align="center" cellpadding="0" cellspacing="0">

  <tr>

    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">

	

	  <tr>

	   

<td width="8%" bgcolor="#003198" class="text_mediano_blanco"><div align="center">FOLIO</div></td>

		<td width="20%" bgcolor="#003198" class="text_mediano_blanco"><div align="center">REQUISITOR</div></td>

		<td width="23%" bgcolor="#003198" class="text_mediano_blanco"><div align="center">TITULO</div></td>

		<td width="10%" bgcolor="#003198" class="text_mediano_blanco"><div align="center">ESTATUS</div></td>

		<td width="12%" bgcolor="#003198" class="text_mediano_blanco"><div align="center">FECHA</div></td>

		<td width="22%" bgcolor="#003198" class="text_mediano_blanco"><div align="center">COMPRADOR</div></td>

		

		

		<td width="3%" bgcolor="#003198" class="text_mediano_blanco">&nbsp;</td>

	  </tr>

	  <?

	  							$count3337=1;

	  						while(@mysqli_num_rows($ejecuta3337)>=$count3337)

							

						{

							$res3337=mysqli_fetch_row($ejecuta3337);

							

							$consulta3337  = "select count(id), max(fecha_solicitud) from solicitudes where id_solicitante=$idA";

							$resultado3337 = mysqli_query($enlace,$consulta3337) or die("La consulta fall&oacute;P1: " );

							

							if(@mysqli_num_rows($resultado3337)>0)

								

							{

								$res33337=mysqli_fetch_row($resultado3337);

							}

							

					

							echo $estatus;

						?>

						

	  <tr>

	 

		

		<td  class="text_mediano"><div align="center"><? echo $res3337[0];?></div></td>

		<td  class="text_mediano"><div align="center"><? echo $res3337[1];?></div></td>

		<td  class="text_mediano"><div align="center"><? echo $res3337[5];?></div></td>

		<td  class="text_mediano"><div align="center"><? echo $res3337[3];?></div></td>

		<td  class="text_mediano"><div align="center"><? echo $res3337[2];?></div></td>

		<td  class="text_mediano"><div align="center"><? echo $res3337[4];?></div></td>

<td  class="text_mediano"><div align="center"><a href="ver_solicitud.php?id=<? echo $res3337[0]?>" class="boton">Ver</a></div></td>

	  </tr>

	 <?	

							

							$count3337++;

						}

						?>

	</table></td>

  </tr>

</table>

</table>

	 <? }?>

	  

	    <p>

		    <? if($idA=="2"){?>

		  </p>

		  <p>&nbsp; </p>

		  <table width="800" border="0" align="center" cellpadding="0" cellspacing="0">

   <td height="221" valign="top" bgcolor="#eeeeee"><table width="753" border="0" align="center" cellpadding="0" cellspacing="0">

    <td>

	    <p><b>Solicitudes Pendientes de Cotizar</b> </p>

	    <table width="700" border="0">

          <tr>

            <td width="271" class="texto_tareas" align="right">No. Folio:</td>

            <td width="120"><label>

              <input type="text" name="buscar" class="texto_tareas" />

            </label></td>

            <td width="295"><label>

              <input type="submit" class="texto_tareas" name="enviar" value="Buscar..." />

            </label></td>

          </tr>

          <tr>

            <td class="texto_tareas" align="right">No. OC </td>

            <td><input type="text" name="buscar2" class="texto_tareas" /></td>

            <td><input type="submit" class="texto_tareas" name="enviar2" value="Buscar..." /></td>

          </tr>

        </table>

		<br/>

	    <table width="100%" border="0" cellspacing="1" cellpadding="3">

	  <tr>

	   

<td width="8%" bgcolor="#003198" class="text_mediano_blanco"><div align="center">FOLIO</div></td>

		<td width="20%" bgcolor="#003198" class="text_mediano_blanco"><div align="center">REQUISITOR</div></td>

		<td width="23%" bgcolor="#003198" class="text_mediano_blanco"><div align="center">TITULO</div></td>

		<td width="10%" bgcolor="#003198" class="text_mediano_blanco"><div align="center">ESTATUS</div></td>

		<td width="12%" bgcolor="#003198" class="text_mediano_blanco"><div align="center">FECHA</div></td>

		<td width="22%" bgcolor="#003198" class="text_mediano_blanco"><div align="center">COMPRADOR</div></td>

		

		

		<td width="5%" bgcolor="#003198" class="text_mediano_blanco">&nbsp;</td>

	  </tr>

	  <?

	  							$count22=1;

	  						while(@mysqli_num_rows($ejecuta22)>=$count22)

							

						{

							$res22=mysqli_fetch_row($ejecuta22);

							

							$consulta22  = "select count(id), max(fecha_solicitud) from solicitudes where id_solicitante=$idA";

							$resultado22 = mysqli_query($enlace,$consulta22) or die("La consulta fall&oacute;P1: " );

							

							if(@mysqli_num_rows($resultado22)>0)

								

							{

								$res222=mysqli_fetch_row($resultado22);

							}

							

					

							echo $estatus;

						?>

						

	  <tr>

	 

		

		<td  class="text_mediano"><div align="center"><? echo $res22[0];?></div></td>

		<td  class="text_mediano"><div align="center"><? echo $res22[1];?></div></td>

		<td  class="text_mediano"><div align="center"><? echo $res22[5];?></div></td>

		<td  class="text_mediano"><div align="center"><? echo $res22[3];?></div></td>

		<td  class="text_mediano"><div align="center"><? echo $res22[2];?></div></td>

		<td  class="text_mediano"><div align="center"><? echo $res22[4];?></div></td>

<td  class="text_mediano"><div align="center"><a href="ver_solicitud.php?id=<? echo $res22[0]?>" class="boton">Ver</a></div></td>

	  </tr>

	 <?	

							

							$count22++;

						}

						?>

	</table>	</td>

  </tr>

</table>

</table>

<? }?>

	  

	  <p>

		   <? if($idA=="2"){?>

		  </p>

		  <p>&nbsp;</p>

		  <table width="800" border="0" align="center" cellpadding="0" cellspacing="0">

		   <td height="221" valign="top" bgcolor="#eeeeee">

		   <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>Requisiciones Pendientes de envio para firma Final</b> </p>

		   <table width="753" border="0" align="center" cellpadding="0" cellspacing="0">

  <tr>

    <td><table width="100%" border="0" cellspacing="1" cellpadding="3">

	

	  <tr>

	   

<td width="8%" bgcolor="#003198" class="text_mediano_blanco"><div align="center">FOLIO</div></td>

		<td width="20%" bgcolor="#003198" class="text_mediano_blanco"><div align="center">REQUISITOR</div></td>

		<td width="23%" bgcolor="#003198" class="text_mediano_blanco"><div align="center">TITULO</div></td>

		<td width="10%" bgcolor="#003198" class="text_mediano_blanco"><div align="center">ESTATUS</div></td>

		<td width="12%" bgcolor="#003198" class="text_mediano_blanco"><div align="center">FECHA</div></td>

		<td width="22%" bgcolor="#003198" class="text_mediano_blanco"><div align="center">COMPRADOR</div></td>

		

		

		<td width="3%" bgcolor="#003198" class="text_mediano_blanco">&nbsp;</td>

	  </tr>

	  <?

	  							$count1010=1;

	  						while(@mysqli_num_rows($ejecuta1010)>=$count1010)

							

						{

							$res1010=mysqli_fetch_row($ejecuta1010);

							

							$consulta1010  = "select count(id), max(fecha_solicitud) from solicitudes where id_solicitante=$idA";

							$resultado1010 = mysqli_query($enlace,$consulta1010) or die("La consulta fall&oacute;P1: " );

							

							if(@mysqli_num_rows($resultado1010)>0)

								

							{

								$res101010=mysqli_fetch_row($resultado1010);

							}

							

					

							echo $estatus;

						?>

						

	  <tr>

	 

		

		<td  class="text_mediano"><div align="center"><? echo $res1010[0];?></div></td>

		<td  class="text_mediano"><div align="center"><? echo $res1010[1];?></div></td>

		<td  class="text_mediano"><div align="center"><? echo $res1010[5];?></div></td>

		<td  class="text_mediano"><div align="center"><? echo $res1010[3];?></div></td>

		<td  class="text_mediano"><div align="center"><? echo $res1010[2];?></div></td>

		<td  class="text_mediano"><div align="center"><? echo $res1010[4];?></div></td>

<td  class="text_mediano"><div align="center"><a href="ver_solicitud.php?id=<? echo $res1010[0]?>" class="boton">Ver</a></div></td>

	  </tr>

	 <?	

							

							$count1010++;

						}

						?>

	</table></td>

  </tr>

</table>

</table>

	 <? }?>		</td>

      </tr>

	  

	  

      <tr>

        <td><img src="images/spacer.gif" width="10" height="50" /></td>

      </tr>

      <tr>

        <td><table width="350" border="0" align="center" cellpadding="0" cellspacing="0">

          <tr>

            <td width="145"><a href="cambia_pass.php?id=<? echo"$idU";?>" class="iframe2" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image21','','images/b_cambio_r.png',1)"><img src="images/b_cambio.png" name="Image21" width="145" height="23" border="0" id="Image21" /></a></td>

            <td><img src="images/spacer.gif" width="16" height="20" /></td>

            <td width="114"><? if($_SESSION["idA"]=="1" || $_SESSION["idA"]=="2"){?>

			<a href="menu.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image24','','images/b_administracion_r.png',1)"><img src="images/b_administracion.png" name="Image24" width="114" height="23" border="0" id="Image24" /></a>

			<? }?></td>

            <td><img src="images/spacer.gif" width="17" height="20" /></td>

            <td><a href="logout.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image25','','images/b_log_out_r.png',1)"><img src="images/b_log_out.png" name="Image25" width="71" height="23" border="0" id="Image25" /></a></td>

          </tr>

        </table>

		

		

		

		

		  <p>&nbsp;</p></td>

      </tr>

	  

    </table></td>

  </tr>

</table>



<table width="100%"  border="0" cellspacing="0" cellpadding="0">

<tr>

    <td background="images/bkg_footer.jpg"><table width="900" border="0" align="center" cellpadding="0" cellspacing="0">

      <tr>

        <td><div align="right"><img src="images/logo_footer.jpg" width="234" height="44" /></div></td>

      </tr>

    </table></td>

  </tr>

</table>

</form>

</body>

</html>

