<?
session_start();
include "checar_sesion_admin.php";
include "coneccion_i.php";

$idU = $_SESSION['idU'];
$idA = $_SESSION['idA'];
$verobjetivos = $_REQUEST['verobjetivos'];

 $consulta  = "SELECT id, admin, nombre, email, id_jefe, puesto, sexo, fecha_contratacion, TIMESTAMPDIFF(YEAR, fecha_nacimiento, now()) as edad, TIMESTAMPDIFF(YEAR, fecha_contratacion, now()) as servicio, id_departamento, numero_colaboradores from usuarios where id=$verobjetivos";
    $resultado = mysqli_query($enlace,$consulta) or die("<h1>Usuario no encontrado</h1>");

    if(@mysqli_num_rows($resultado)>=1)
      $usuario=mysqli_fetch_assoc($resultado);
    else  die("<h1>Usuario no encontrado</h1>");
$puestoid=$usuario['puesto'];
 $consulta  = "SELECT nombre from puestos where id=$puestoid";
    $resultado = mysqli_query($enlace,$consulta) or die("<h1>Usuario no encontrado</h1>");

    if(@mysqli_num_rows($resultado)>=1)
      $puesto=mysqli_fetch_assoc($resultado);



 	$consulta2  = "SELECT nombre from departamentos where id={$usuario['id_departamento']}";
    $resultado2 = mysqli_query($enlace,$consulta2) or die("<h1>Usuario no encontrado</h1>");
	$dep=mysqli_fetch_assoc($resultado2);
	
	$consulta3  = "SELECT nombre from usuarios where id={$usuario['id_jefe']}";
    $resultado3 = mysqli_query($enlace,$consulta3) or die("<h1>Usuario no encontrado</h1>");
	$sup=mysqli_fetch_assoc($resultado3);
	
	$consulta4  = "SELECT count(*) as direct from usuarios where id_jefe=$verobjetivos";
    $resultado4 = mysqli_query($enlace,$consulta4) or die("<h1>Usuario no encontrado</h1>");
	$direct=mysqli_fetch_assoc($resultado4);
	
	$consulta5  = "SELECT count(*) as team from usuarios where id_departamento={$usuario['id_departamento']}";
    $resultado5 = mysqli_query($enlace,$consulta5) or die("<h1>Usuario no encontrado</h1>");
	$team=mysqli_fetch_assoc($resultado5);
	
	$total_team=($usuario['numero_colaboradores'])+($team['team']);

// -------------
// PARA ELIMINAR
// -------------

if(isset($_POST['idEliminar']) && isset($_POST['funcion']))
  call_user_func_array($_POST['funcion'], array( $_POST['idEliminar'], $idU) );

function eliminateStre($id, $idU){
  $query = "DELETE FROM strengths WHERE id = $id";
  mysqli_query($enlace,$query) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistemaDE1</h1>");
}

function eliminateDev($id, $idU){
  $query = "DELETE FROM development_needs WHERE id = $id";
  mysqli_query($enlace,$query) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistemaDE2</h1>");
}

function eliminateDev2($id, $idU){
  $query = "DELETE FROM development_needs_2 WHERE id = $id";
  mysqli_query($enlace,$query) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistemaDE3</h1>");
}

function eliminateCP($id, $idU){
  $query = "DELETE FROM career_potential WHERE id = $id";
  mysqli_query($enlace,$query) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistemaDE3</h1>"); 
}

function eliminateTA($id, $idU){
  $query = "DELETE FROM talent_assessment WHERE id = $id";
  mysqli_query($enlace,$query) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistemaDE3</h1>"); 
}

// -------------
// PARA GUARDAR
// -------------

foreach($_POST as $k =>$v){
        $_POST[$k] = mysql_escape_string($v);
}

if($_POST['bttnStre']!=""){
  $query = "INSERT INTO strengths (id_usuario, competency, coments, date)
              VALUES ($verobjetivos, '".$_POST['competencySTR']."', '".$_POST['comentsSTR']."', '".$_POST['toSTR']."')";
  mysqli_query($enlace,($query)) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistemaIN</h1>");
}

if($_POST['bttnDev']!=""){
  $query = "INSERT INTO development_needs (id_usuario, competency, coments, date)
              VALUES ($verobjetivos, '".$_POST['competencyDN']."', '".$_POST['comentsDN']."', '".$_POST['toDN']."')";
  mysqli_query($enlace,($query)) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistemaIN</h1>");
}

if($_POST['bttnDev2']!=""){
  $query = "INSERT INTO development_needs_2 (id_usuario, focus, description, date)
              VALUES ($verobjetivos, '".$_POST['focusDN2']."', '".$_POST['descriptionDN2']."', '".$_POST['toDN2']."')";
  mysqli_query($enlace,($query)) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistemaIN</h1>");
}

if($_POST['bttnCP']!=""){
  $query = "INSERT INTO career_potential (id_usuario, level, function, business_unit, timeframe, date)
              VALUES ($verobjetivos, '".$_POST['levelCP']."', '".$_POST['functionCP']."', '".$_POST['businessCP']."','".$_POST['timeCP']."','".$_POST['toCP']."')";
  mysqli_query($enlace,($query)) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistemaIN</h1>");
}

if($_POST['bttnTA']!=""){
  $query = "INSERT INTO talent_assessment (id_usuario, strategic, probability, impact, potential, date)
              VALUES ($verobjetivos, '".$_POST['strategicTA']."', '".$_POST['probabilityTA']."', '".$_POST['impactTA']."','".$_POST['potentialTA']."','".$_POST['toTA']."')";
  mysqli_query($enlace,($query)) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistemaIN</h1>");
}

// -----------------
// OBTENIENDO DATOS
// -----------------

$query = "SELECT *,
                DATE_FORMAT( from_date,'%d %b %Y') AS from_date, 
                DATE_FORMAT( to_date  ,'%d %b %Y') AS to_date
                 FROM job_history WHERE id_usuario = $verobjetivos AND is_inside_textron = 1";
$job_history_textron = mysqli_query($enlace,$query) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistema $query</h1>");

$query = "SELECT *,
                DATE_FORMAT( from_date,'%d %b %Y') AS from_date, 
                DATE_FORMAT( to_date  ,'%d %b %Y') AS to_date
                 FROM job_history WHERE id_usuario = $verobjetivos AND is_inside_textron = 2";
$job_history_early = mysqli_query($enlace,$query) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistema</h1>");

$query = "SELECT *,
                DATE_FORMAT( from_date,'%d %b %Y') AS from_date, 
                DATE_FORMAT( to_date  ,'%d %b %Y') AS to_date
                  FROM job_history WHERE id_usuario = $verobjetivos AND is_inside_textron = 0";
$job_history = mysqli_query($enlace,$query) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistema $query</h1>");

$query = "SELECT *, 
                DATE_FORMAT( to_date  ,'%d %b %Y') AS to_date
                  FROM education_history WHERE id_usuario = $verobjetivos";
$education_history = mysqli_query($enlace,$query) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistema $query</h1>");

$query = "SELECT * FROM carrer_highlights WHERE id_usuario = $verobjetivos";
$carrer_highlights = mysqli_query($enlace,$query) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistema</h1>");

$query = "SELECT * FROM other_skills WHERE id_usuario = $verobjetivos";
$other_skills = mysqli_query($enlace,$query) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistema</h1>");

$query = "SELECT * FROM international_experience WHERE id_usuario = $verobjetivos";
$career = mysqli_query($enlace,$query) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistema</h1>");

$query = "SELECT * FROM language_capability WHERE id_usuario = $verobjetivos";
$career2 = mysqli_query($enlace,$query) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistema</h1>");

$query = "SELECT * FROM geographic_mobility WHERE id_usuario = $verobjetivos order by id desc";
$career3 = mysqli_query($enlace,$query) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistema</h1>");

$query = "SELECT *,
			DATE_FORMAT( date,'%d %b %Y') AS date
 			FROM career_aspirations WHERE id_usuario = $verobjetivos";
$career4 = mysqli_query($enlace,$query) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistema</h1>");

$query = "SELECT *,
			DATE_FORMAT( date,'%d %b %Y') AS date FROM textron_leadership_development WHERE id_usuario = $verobjetivos";
$career5 = mysqli_query($enlace,$query) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistema</h1>");

$query = "SELECT * FROM textron_six_sigma_certifications WHERE id_usuario = $verobjetivos";
$career6 = mysqli_query($enlace,$query) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistema</h1>");

$query = "SELECT * FROM training_and_development_needs WHERE id_usuario = $verobjetivos";
$career7 = mysqli_query($enlace,$query) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistema</h1>");

$query = "SELECT *,
			DATE_FORMAT( date,'%d %b %Y') AS date FROM strengths WHERE id_usuario = $verobjetivos";
$career8 = mysqli_query($enlace,$query) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistema</h1>");

$query = "SELECT *,
			DATE_FORMAT( date,'%d %b %Y') AS date FROM development_needs WHERE id_usuario = $verobjetivos";
$career9 = mysqli_query($enlace,$query) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistema</h1>");

$query = "SELECT *,
			DATE_FORMAT( date,'%d %b %Y') AS date FROM development_needs_2 WHERE id_usuario = $verobjetivos";
$career10 = mysqli_query($enlace,$query) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistema</h1>");

$query = "SELECT *,
			DATE_FORMAT( date,'%d %b %Y') AS date FROM career_potential WHERE id_usuario = $verobjetivos";
$career11 = mysqli_query($enlace,$query) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistema</h1>");

$query = "SELECT * FROM talent_assessment WHERE id_usuario = $verobjetivos order by id desc";
$career12 = mysqli_query($enlace,$query) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistema</h1>");

$query = "SELECT *, DATE_FORMAT( start_date,'%d %b %Y') AS start_date, DATE_FORMAT( end_date,'%d %b %Y') AS end_date FROM perfomance_history WHERE id_usuario = $verobjetivos order by id desc";
$perfomance_history = mysqli_query($enlace,$query) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistema</h1>");

$query = "SELECT *, DATE_FORMAT( date_entered,'%d %b %Y') AS date_entered FROM general_summary WHERE id_usuario = $verobjetivos order by id desc";
$general_summary = mysqli_query($enlace,$query) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistema</h1>");

$query = "SELECT * FROM resultados_anteriores WHERE id_usuario = $verobjetivos";
$resultados_anteriores = mysqli_query($enlace,$query) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistema</h1>");

function covertDate($date){
  $date = explode('-', $date);
  return "$date[2]-$date[1]-$date[0]";
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Bell</title>

<link href="images/textos.css" rel="stylesheet" type="text/css" />
<link type="text/css" href="css/smoothness/jquery-ui-1.8.16.custom.css" rel="stylesheet" /> 
<link rel="stylesheet" href="colorbox.css" />
<script type="text/javascript" src="js/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.16.custom.min.js"></script>
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

  //-->
</script>

<script type="text/javascript">
    $(function() {
     $(  "input[name^='from']" ).datepicker({ dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true });
      $(  "input[name^='to']" ).datepicker({ dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true  });
    });
</script>

<script type="text/javascript">
    function eliminar(id,funcion){
      form = document.createElement('form');
      form.method='post';
      form.action='';

      elem = document.createElement('input');
      elem.name = 'idEliminar';
      elem.value = id;
      form.appendChild(elem);

      elem = document.createElement('input');
      elem.name = 'funcion';
      elem.value = funcion;
      form.appendChild(elem);
	  
	  elem = document.createElement('input');
      elem.name = 'verobjetivos';
      elem.value = <?echo"$verobjetivos";?>;
      form.appendChild(elem);

      document.body.appendChild(form);

      form.submit();
    }
</script>

<style type="text/css">
  <!--
  .style1 {font-size: 24px}
  .column {
  	text-align: right;
  	float:left;
    width:28%;
    margin: 5px;
  }
    .column2 {
  	text-align: right;
  	float:left;
    width:30%;
    margin: 5px;
  }
    .column3 {
  	text-align: right;
  	float:left;
    width:32%;
    margin: 5px;
  }
  .column4 {
  	
  	float:left;
    width:40%;
    margin: 5px;
  }
  .fixColumn {
  	text-align: left;
  	padding: 3px;
  	float:left;
  }
  .btnAgregar{
    float: right;
	width: 100px;
  }
    .ancho{
    height:21px;
  }
  .date{
    width:10%;
  }
   .date2{
    width:18%;
  }
  .text{
    width:10%;
  } 
  .tinyText{
    width:10%;
  }
  .row{
    width: 99%;
  	float: left;
	padding: 5px;
  }
  .title{
	  background-color:#00475c}
.title2{
	  background-color:#E26F36}	  

  .topic{
  	margin-bottom:30px;
  }
  .infoRow{
	  background-color:#FFFFFF;
	  width:100%;
  }
.style11 {color: #999999}
  -->
</style>
</head>

<body onload="MM_preloadImages('images/b_cambio_r.png','images/b_administracion_r.png','images/b_log_out_r.png')">

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
   <?include_once("header.php");?>
  </tr>
  <tr>
    <td height="698" valign="top" background=""><table width="85%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td><img src="images/spacer.gif" width="10" height="20" /></td>
      </tr>
      <tr>
        <td><div align="center">
          <table width="850" border="0" cellspacing="7" cellpadding="0">
            <tr>
              <td><div align="center" class="text_grande style1"><? echo  $usuario['nombre']?></div></td>
            </tr>
            <tr>
              <td><div align="center" class="text_mediano">Career File</div></td>
            </tr>
          </table>
        </div></td>
      </tr>
      <tr>
        <td><img src="images/spacer.gif" width="10" height="20" /></td>
      </tr>
	   <tr>
        <td><img src="images/spacer.gif" width="10" height="10" /></td>
      </tr>
      <tr>
        <td align="right"><? if($idA=="1"){?><input name="generar" type="button" value="Exportar PDF" onclick="window.open('pdf_carer_gente.php?id=<? echo $verobjetivos?>')"/><? }?></td> 
      </tr>
	  <tr>
        <td><img src="images/spacer.gif" width="10" height="10" /></td>
      </tr>
	  <tr>
        <td bgcolor="#eeeeee"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="65%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="25%" rowspan="3"><img src="empleados/<? echo $verobjetivos?>.jpg" height="300" width="200"/></td>
    <td width="75%">&nbsp;</td>
  </tr>
  <tr>
    <td valign="top">&emsp;<b><? echo $direct['direct']?></b> Direct Reports<br/>&emsp;<b><? echo $total_team?></b> Total Team</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table></td>
    <td width="35%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" align="right">
  <tr>
    <td colspan="2" align="left" height="25" class="text_mediano_blanco title">&nbsp;Personal Information </td>
    </tr>
  <tr>
    <td align="right" valign="top"><B>First Name</B></td>
    <td>&nbsp;<? echo  $usuario['nombre']?></td>
  </tr>
 
  <tr>
    <td align="right" valign="top"><b>Title</b></td>
    <td>&nbsp;<? echo  $puesto['nombre']?></td>
  </tr>
  <tr>
    <td align="right"><b>Division</b></td>
    <td>&nbsp;Bell Division</td>
  </tr>
  <tr>
    <td align="right"><b>Deparment</b></td>
    <td>&nbsp;<? echo $dep['nombre']?></td>
  </tr>
  <tr>
    <td align="right" valign="top"><b>Supervisor</b></td>
    <td>&nbsp;<? echo $sup['nombre']?></td>
  </tr>
  <tr>
    <td align="right" valign="top"><b>Location</b></td>
    <td> &nbsp;T.I.M. - Bell Helicopter plant (BHMBU-BC777) </td>
  </tr>
  <tr>
    <td align="right"><b>City, State, Country</b></td>
    <td> &nbsp;MEX-Mexico</td>
  </tr>
  <tr>
    <td align="right"><b>Hire Date</b></td>
    <td>&nbsp;<? echo  $usuario['fecha_contratacion']?></td>
  </tr>
  <tr>
    <td align="right"><b>Years of Service (Not to be used for benefit calculations)</b></td>
    <td valign="top">&nbsp;<? echo  $usuario['servicio']?></td>
  </tr>
  <tr>
    <td align="right"><b>Years</b></td>
    <td>&nbsp;<? echo  $usuario['edad']?></td>
  </tr>
  <tr>
    <td align="right"><b>Gender</b></td>
    <td>&nbsp;<? if($usuario['sexo']=="1"){ echo "Female"; } else { echo "Male"; }?></td>
  </tr>
</table></td>
  </tr>
  <tr>
        <td align="right">&nbsp;</td>
      </tr>
  <tr>
        <td colspan="2" bgcolor="#eeeeee">&nbsp;</td>
  </tr>
		 <tr>
        <td align="right">&nbsp;</td>
      </tr>
		<tr>
          <td colspan="2" bgcolor="#eeeeee">&nbsp;</td>
		</tr>
</table>
</td>
      </tr>
	  <tr>
        <td><img src="images/spacer.gif" width="10" height="10" /></td>
      </tr>
      <tr>
        <td bgcolor="#eeeeee"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td height="250" valign="top"><div class="row topic">
              <form id="form1" name="form1" method="post" action="">
			<input name="verobjetivos" type="hidden" id="verobjetivos" value="<?echo"$verobjetivos";?>" />
                <div class="row text_mediano_blanco title">Textron Job History </div>
<div class="row" style="background:#eeeeee">
  <div class="column">
                  <div>
                    </div>
                </div>
                <div class="column">
                  <div>
                    <div>
                    </div>
                  </div>
                </div>
              </div>
                <div class="fixColumn btnAgregar">
                  
                </div>
              <div class="row">
                <div class="fixColumn date"><strong>Start Date</strong></div>
                <div class="fixColumn date"><strong>End Date</strong></div>
				 <div class="fixColumn tinyText"><strong>Title</strong></div>
                <div class="fixColumn tinyText"><strong>Business Unit</strong></div>
                <div class="fixColumn tinyText"><strong>City, State</strong></div>
                <div class="fixColumn tinyText"><strong>Country</strong></div>
				<div class="fixColumn tinyText"><strong>Function</strong></div>
              </div>
              <? while ($row=mysqli_fetch_assoc($job_history_textron)) { ?>
              <div class="row infoRow" id="divJH0">
                <div class="fixColumn date"><? echo $row['from_date'];?></div>
                <div class="fixColumn date"><? echo $row['to_date'];?></div>
                <div class="fixColumn tinyText"><? echo $row['position'];?></div>
                <div class="fixColumn tinyText"><? echo $row['business_unit'];?></div>
                <div class="fixColumn tinyText"><? echo $row['city_state'];?></div>
				<div class="fixColumn tinyText"><? echo $row['country'];?></div>
				<div class="fixColumn tinyText"><? echo $row['function'];?></div>
              </div>
              <? } ?> 
              </form>
			  
            </div>
			 <div class="row topic">
              <form id="form5" name="form5" method="post" action="">
                <div class="row text_mediano_blanco title">Early Textron Job History not Reflected in Textron Job History Above </div>
              
                  
                <div class="row">
                  <div class="fixColumn date"><strong>Start Date</strong></div>
                  <div class="fixColumn date"><strong>End Date</strong></div>
                  <div class="fixColumn tinyText"><strong>Title</strong></div>
                  <div class="fixColumn tinyText"><strong>Business Unit</strong></div>
                  <div class="fixColumn tinyText"><strong>City, State</strong></div>
				  <div class="fixColumn tinyText"><strong>Country</strong></div>
				  <div class="fixColumn tinyText"><strong>Function</strong></div>
                </div>
              <? while ($row=mysqli_fetch_assoc($job_history_early)) { ?>
                <div class="row infoRow" id="divJH">
                <div class="fixColumn date"><? echo $row['from_date'];?></div>
                <div class="fixColumn date"><? echo $row['to_date'];?></div>
                <div class="fixColumn tinyText"><? echo $row['position'];?></div>
                <div class="fixColumn tinyText"><? echo $row['business_unit'];?></div>
                <div class="fixColumn tinyText"><? echo $row['city_state'];?></div>
				<div class="fixColumn tinyText"><? echo $row['country'];?></div>
				<div class="fixColumn tinyText"><? echo $row['function'];?></div>
                 
                </div>
              <? } ?> </form>
              </div>
              <div class="row topic">
              <form id="form2" name="form2" method="post" action="">
			  <input name="verobjetivos" type="hidden" id="verobjetivos" value="<?echo"$verobjetivos";?>" />
                <div class="row text_mediano_blanco title">Non - Textron Job History </div>
                <div class="row" style="background:#eeeeee">
                  <div class="column">
                    <div>
                    </div>
                  </div>
                  <div class="column">
                    <div>
                      <div>
                      </div>
                    </div>
                  </div>
                </div>
                  
                 <div class="row">
                  <div class="fixColumn date"><strong>Start Date</strong></div>
                  <div class="fixColumn date"><strong>End Date</strong></div>
                  <div class="fixColumn tinyText"><strong>Title</strong></div>
                  <div class="fixColumn tinyText"><strong>Company Name</strong></div>
                  <div class="fixColumn tinyText"><strong>Type of Business</strong></div>
				  <div class="fixColumn tinyText"><strong>City, State</strong></div>
				  <div class="fixColumn tinyText"><strong>Country</strong></div>
				  <div class="fixColumn tinyText"><strong>Function</strong></div>
				  <div class="fixColumn tinyText"><strong>Type of Role</strong></div>
                </div>
              <? while ($row=mysqli_fetch_assoc($job_history)) { ?>
                <div class="row infoRow" id="divJH">
                <div class="fixColumn date"><? echo $row['from_date'];?></div>
                <div class="fixColumn date"><? echo $row['to_date'];?></div>
                <div class="fixColumn tinyText"><? echo $row['position'];?></div>
				<div class="fixColumn tinyText"><? echo $row['business_unit'];?></div>
                <div class="fixColumn tinyText"><? echo $row['type_business'];?></div>
                <div class="fixColumn tinyText"><? echo $row['city_state'];?></div>
				<div class="fixColumn tinyText"><? echo $row['country'];?></div>
				<div class="fixColumn tinyText"><? echo $row['function'];?></div>
				<div class="fixColumn tinyText"><? echo $row['type_role'];?></div>
                </div>
              <? } ?>
			   </form>
              </div>
			  
			  <div class="row topic">
              <form id="form4" name="form4" method="post" action="">
			  <input name="verobjetivos" type="hidden" id="verobjetivos" value="<?echo"$verobjetivos";?>" />
                <div class="row text_mediano_blanco title">Career Highlights </div>
				<span class="style11">Example. This section provides the opportunity to share highlights of your career. While this is not intended to be a resume or Curriculum Vita (CV), you may enter specific accomplishments or experiences to illustrate the most important aspects of your career. The Date, Job Title and Company Name must match a record in either the Textron Job History or Non-Textron Job History sections above.</span>
                <div class="row" style="background:#eeeeee">
                <div class="row" style="background:#eeeeee">
                  <div class="column">
                    <div>
                    </div>
                  </div>
                  <div class="column">
                  
                    <div>
                    </div>
                  </div>
                    <div class="column" style="text-align:left">                    </div>
                </div>
                  <div class="fixColumn btnAgregar">
                   
                  </div>
                  <div class="row">
                  
                  <div class="fixColumn date2"><strong>Year</strong></div>
                  <div class="fixColumn date2"><strong>Job Title</strong></div>
                  <div class="fixColumn date2"><strong>Company Name</strong></div>
                  <div class="fixColumn date2"><strong>Career Highlight</strong></div>
                </div>
                <? while ($row=mysqli_fetch_assoc($carrer_highlights)) { ?>
                <div class="row infoRow" id="divJH2">
                  
                  <div class="fixColumn date2"><? echo $row['to_date'];?></div>
                  <div class="fixColumn date2"><? echo $row['job_title'];?></div>
                  <div class="fixColumn date2"><? echo $row['company'];?></div>
                  <div class="fixColumn date2"><? echo $row['achievement'];?></div>
                  
                </div>
                <? } ?> 
              </form>
              </div>
			  
			  <div class="row topic">
			<form name="formIE" method="post">
			<input name="verobjetivos" type="hidden" id="verobjetivos" value="<?echo"$verobjetivos";?>" />
              <div class="row topic">
                 <div class="row text_mediano_blanco title">International Experience </div>
				  <span class="style11">Example. Talent Management Summit (México, DF), Wealthness Coaching Summit (US), Stress Management (México), Human Resources Management, Coaching.</span>
               	 <div class="row" style="background:#eeeeee">
                     <div class="column" style="text-align:left">
                    
                     </div>
                </div>
                   <div class="fixColumn btnAgregar">
                 
                   </div>
              </div>
            
              
              <div class="row topic">
             
			  <input name="verobjetivos" type="hidden" id="verobjetivos" value="<?echo"$verobjetivos";?>" />
               <div class="row">
                  
                  <div class="fixColumn date2"><strong>Country</strong></div>
                  <div class="fixColumn date2"><strong>Type of Experince</strong></div>
                  <div class="fixColumn date2"><strong>Years of Experience</strong></div>
                  <div class="fixColumn date2"><strong>Company Name</strong></div>
				  <div class="fixColumn date2"><strong>Comments</strong></div>
                </div>
                <?
                while ($row=mysqli_fetch_assoc($career)) { ?>
           <div class="row infoRow" id="divJH2">
                  <div class="fixColumn date2"><? echo $row['country'];?></div>
				  <div class="fixColumn date2"><? echo $row['type_experience'];?></div>
				  <div class="fixColumn date2"><? echo $row['years'];?></div>
				  <div class="fixColumn date2"><? echo $row['company'];?></div>
				  <div class="fixColumn date2"><? echo $row['coments'];?></div>
                  
             </div>
			    <? } ?> 
			 
              </form>
              </div>
			  
			  
              <div class="row topic">
              <form id="form3" name="form3" method="post" action="">
			  <input name="verobjetivos" type="hidden" id="verobjetivos" value="<?echo"$verobjetivos";?>" />
                <div class="row text_mediano_blanco title">Education History </div>
				<span class="style11">Example. This section should reflect your formal education history such as high school, compulsory, or university degrees completed or currently pursuing. Do not record Textron University courses, or other certifications, licenses or certificates of completion in this section. Note: Select the first day of the month if you do not remember the actual Graduation Date (e.g. 05-01-1997).</span>
                <div class="row" style="background:#eeeeee">
                  <div class="column">
                    <div>
                    </div>
                  </div>
                  <div class="column">
                    <div>
                      <div>
                      </div>
                    </div>
                  </div>
                </div>
                  <div class="fixColumn btnAgregar">
                   
                  </div>
                <div class="row">
                  <div class="fixColumn tinyText"><strong>Degree</strong></div>
				   <div class="fixColumn date"><strong>Major</strong></div>
				    <div class="fixColumn date"><strong>Country</strong></div>
                  <div class="fixColumn tinyText"><strong>School</strong></div>
                  <div class="fixColumn tinyText"><strong>Location</strong></div>
				   <div class="fixColumn date"><strong>Graduation Date</strong></div>
				    <div class="fixColumn date"><strong>Comments</strong></div>
                </div>
              <? while ($row=mysqli_fetch_assoc($education_history)) { ?>
                <div class="row infoRow" id="divJH">
                <div class="fixColumn tinyText"><? echo $row['degree'];?></div>
				<div class="fixColumn tinyText"><? echo $row['major'];?></div>
				<div class="fixColumn tinyText"><? echo $row['country'];?></div>
                <div class="fixColumn tinyText"><? echo $row['school'];?></div>
                <div class="fixColumn tinyText"><? echo $row['location'];?></div>
				<div class="fixColumn tinyText"><? echo $row['to_date'];?></div>
				<div class="fixColumn tinyText"><? echo $row['coments'];?></div>
                 
                </div>
              <? } ?> </form>
              </div>

              <div class="row topic">
			<form name="formTLD" method="post">
			<input name="verobjetivos" type="hidden" id="verobjetivos" value="<?echo"$verobjetivos";?>" />
              <div class="row topic">
                <div class="row text_mediano_blanco title">Textron Leadership Development</div>
				
                <div class="row" style="background:#eeeeee">

                    
                </div>
                  
              </div>
          <div class="row">
                  <div class="fixColumn date2"><strong>Course Name</strong></div>
                  <div class="fixColumn date2"><strong>Institution Name</strong></div>
                  <div class="fixColumn date2"><strong>Status</strong></div>
                  <div class="fixColumn date2"><strong>Date Completed</strong></div>
                </div>
                <?
                while ($row=mysqli_fetch_assoc($career5)) { ?>
                <div class="row infoRow" id="divJH2">
                  <div class="fixColumn date2"><? echo $row['course'];?></div>
				  <div class="fixColumn date2"><? echo $row['institution'];?></div>
				  <div class="fixColumn date2"><? echo $row['status'];?></div>
				  <div class="fixColumn date2"><? echo $row['date'];?></div>
                 
            </div>
			
                <? } ?> 
              </form>
              </div>
                
			<div class="row topic"> 
			<form name="formLC" method="post">
			<input name="verobjetivos" type="hidden" id="verobjetivos" value="<?echo"$verobjetivos";?>" />
              <div class="row topic">
                <div class="row text_mediano_blanco title">Language Capability </div>
				<span class="style11">Example. English 800 points TOIEC tool</span>
                <div class="row" style="background:#eeeeee">
                  
                 
                    <div class="column" style="text-align:left">
                     
                    </div>
                </div>
                  <div class="fixColumn btnAgregar">
                   
                  </div>
              </div>
           
              <div class="row">
                  <div class="fixColumn date2"><strong>Language</strong></div>
                  <div class="fixColumn date2"><strong>Speaking Proficiency</strong></div>
                  <div class="fixColumn date2"><strong>Reading Proficiency</strong></div>
                  <div class="fixColumn date2"><strong>Writing Proficiency</strong></div>
				  <div class="fixColumn date2"><strong>Comments</strong></div>
                </div>
                <? while ($row=mysqli_fetch_assoc($career2)) { ?>
                <div class="row infoRow" id="divJH2">
                  <div class="fixColumn date2"><? echo $row['language'];?></div>
				  <div class="fixColumn date2"><? echo $row['speaking'];?></div>
				  <div class="fixColumn date2"><? echo $row['reading'];?></div>
				  <div class="fixColumn date2"><? echo $row['writing'];?></div>
				  <div class="fixColumn date2"><? echo $row['coments'];?></div>
                  
             </div>
			 <? } ?> 
              </form>
              </div>
			  
			  <!--seccion 9 nueva-->
			  <div class="row topic"> 
			<form name="formLC" method="post">
			<input name="verobjetivos" type="hidden" id="verobjetivos" value="<?echo"$verobjetivos";?>" />
              <div class="row topic">
                <div class="row text_mediano_blanco title">Performance History</div>
				<span class="style11"></span>
                <div class="row" style="background:#eeeeee">
                  
                 
                    <div class="column" style="text-align:left">
                     
                    </div>
                </div>
                  <div class="fixColumn btnAgregar">
                   
                  </div>
              </div>
           
              <div class="row">
                  <div class="fixColumn date2"><strong>Start Date</strong></div>
                  <div class="fixColumn date2"><strong>End Date</strong></div>
                  <div class="fixColumn date2"><strong>Rating</strong></div>
                  
                </div>
				<? while ($row=mysqli_fetch_assoc($resultados_anteriores)) { ?>
                <div class="row infoRow" id="divJH2">
                  <div class="fixColumn date2">01/Jan/ <? echo $row['anio'];?></div>
				  <div class="fixColumn date2">31/Dec/<? echo $row['anio'];?></div>
				  <div class="fixColumn date2"><? echo $row['calificacion'];?></div>
             </div>
			 <? } ?>
                <? while ($row=mysqli_fetch_assoc($perfomance_history)) { ?>
                <div class="row infoRow" id="divJH2">
                  <div class="fixColumn date2"><? echo $row['start_date'];?></div>
				  <div class="fixColumn date2"><? echo $row['end_date'];?></div>
				  <div class="fixColumn date2"><? echo $row['rating'];?></div>
             </div>
			 <? } ?> 
			 
              </form>
              </div>
			  <!--FIN secicon 9 nueva-->
			  <!--
			  <div class="row topic"> 
			<form name="formTA" method="post">
			<input name="verobjetivos" type="hidden" id="verobjetivos" value="<?echo"$verobjetivos";?>" />
              <div class="row topic">
                <div class="row text_mediano_blanco title2">Talent Assessment **Manager View Only</div>
				<span class="style11">Data in this section is displayed on the Succession Org Chart.</span>
				<?  $rowTA=mysqli_fetch_assoc($career12);  ?> 
				<div class="row" style="background:#eeeeee">
              <div class="column4"  align="right">
                    <div class="ancho">Strategic Fit</div>
					<div class="ancho">Probability of Loss</div>
					<div class="ancho">Impact of Loss</div>
					<div class="ancho">Potential</div>
					<div class="ancho">Date Entered</div>					
					</div>
					
					<div class="column4" align="left">
					<div><input type="text" name="strategicTA" id="strategicTA" value="<? echo $rowTA['strategic'];?>"/></div>
					<div> <input type="text" name="probabilityTA" id="probabilityTA" value="<? echo $rowTA['probability'];?>"/></div>
                    <div><input type="text" name="impactTA" id="impactTA" value="<? echo $rowTA['impact'];?>"/></div>
					<div><input type="text" name="potentialTA" id="potentialTA" value="<? echo $rowTA['potential'];?>"/></div>
					<div><input type="text" name="toTA" id="toTA" value="<? echo $rowTA['date'];?>"/></div> 
                    </div>
                </div>
					 <div class="fixColumn btnAgregar">
                  
                  </div>
              </div>
              </form>
              </div>
			-->
			
			 <!--SECCION MANAGER VIEW ONLY-->
			 <!--
			  <div class="row topic"> 
			<form name="formCareerPotential" method="post">
			<input name="verobjetivos" type="hidden" id="verobjetivos" value="<?echo"$verobjetivos";?>" />
               <div class="row topic">
                <div class="row text_mediano_blanco title2">Career Potential **Manager View Only</div>
				<span class="style11">This sectionis to reflect the higest level you believe this employee is able to achieve. If you choose to add a record in this section, the red star indicates that it is a required field.</span>
                 
              
              	</div>
				
                <div class="row">
                  <div class="fixColumn date2"><strong>Level</strong></div>
                  <div class="fixColumn date2"><strong>Function</strong></div>
                  <div class="fixColumn date2"><strong>Business Unit</strong></div>
				  <div class="fixColumn date2"><strong>Timeframe</strong></div>
				   <div class="fixColumn date2"><strong>Date Entered</strong></div>
                </div>
                <? while ($row=mysqli_fetch_assoc($career11)) { ?>
                <div class="row infoRow" id="divJH2">
                  <div class="fixColumn date2"><? echo $row['level'];?></div>
                  <div class="fixColumn date2"><? echo $row['function'];?></div>
                  <div class="fixColumn date2"><? echo $row['business_unit'];?></div>
				  <div class="fixColumn date2"><? echo $row['timeframe'];?></div>
				  <div class="fixColumn date2"><? echo $row['date'];?></div>
                 
                </div>
                <? } ?> 
              </form>
              </div>
			-->
			
			<div class="row topic">
			
			<form name="formCA" method="post">
			<input name="verobjetivos" type="hidden" id="verobjetivos" value="<?echo"$verobjetivos";?>" />
              <div class="row topic">
                <div class="row text_mediano_blanco title">Career Aspirations </div>
				<span class="style11">Example. Implement and systematize the Performance Management System in TIM.<br />
Reach that TIM be the model to follow in developing talent for other manufacturing companies.<br />
Look and bring best practices to improve certain administrative processes in TIM.<br />
Have a Training Program appropriate for each job profile.</span>
                <div class="row" style="background:#eeeeee">
                    <div class="column" >
                     
                    </div>
                </div>
                  <div class="fixColumn btnAgregar">
                    
                  </div>
              </div>
          
               <div class="row">
                  <div class="fixColumn date2"><strong>Level</strong></div>
                  <div class="fixColumn date2"><strong>Function</strong></div>
                  <div class="fixColumn date2"><strong>Business Unit</strong></div>
                  <div class="fixColumn date2"><strong>Comments</strong></div>
				  <div class="fixColumn date2"><strong>Date Entered</strong></div>
                </div>
                <? while ($row=mysqli_fetch_assoc($career4)) { ?>
                <div class="row infoRow" id="divJH2">
                  <div class="fixColumn date2"><? echo $row['level'];?></div>
				  <div class="fixColumn date2"><? echo $row['function'];?></div>
				  <div class="fixColumn date2"><? echo $row['business_unit'];?></div>
				  <div class="fixColumn date2"><? echo $row['career'];?></div>
				  <div class="fixColumn date2"><? echo $row['date'];?></div>
                
            </div>
			 <? } ?> 
              </form>
              </div>
			
			<div class="row topic"> 
			<form name="formGM" method="post">
			<input name="verobjetivos" type="hidden" id="verobjetivos" value="<?echo"$verobjetivos";?>" />
              <div class="row topic">
                <div class="row text_mediano_blanco title">Geographic Mobility </div>
				<span class="style11">Example. Yes.</span>
               
              </div>
          
              <div class="column4"  align="right">
                    <div class="ancho">Willing to Relocate</div>
					<div class="ancho">Comments</div>
					<div class="ancho">Date Entered</div>
					<?  $rowGM=mysqli_fetch_assoc($career3);  ?> 
					</div>
					<div class="column4" align="left">
					<div><input type="text" name="willingGM" id="willingGM" value="<? echo $rowGM['willing'];?>"/></div>
					<div> <input type="text" name="comenstGM" id="comenstGM" value="<? echo $rowGM['coments'];?>"/></div>
                      <div><input type="text" name="toGM" id="toGM" value="<? echo $rowGM['date'];?>"/></div>
                    </div>
              </form>
              </div>
			  
			  
              
			  
			<!--<div class="row topic">  
			<form name="formTSSC" method="post">
			<input name="verobjetivos" type="hidden" id="verobjetivos" value="<?echo"$verobjetivos";?>" />
              <div class="row topic">
                <div class="row text_mediano_blanco title">Textron Six Sigma Certifications</div>
				<span class="style11">Example. If you are Textron Six Sigma (TSS) certified, list the highest certification achieved to date. Note: Select the first day of the month if you do not remember the actual Certification Date (e.g. 03/01/2011).</span>
                <div class="row" style="background:#eeeeee">
                
                    <div class="column" style="text-align:left">
                     
                    </div>
                </div>
                  <div class="fixColumn btnAgregar">
                    
                  </div>
              </div>
           
                <?  while ($row=mysqli_fetch_assoc($career6)) { ?>
              <div class="row topic">
           
                <div class="row infoRow" id="divJH2">
                  <div class="fixColumn date" style="width:800px"><? echo $row['textron_six'];?></div>
                  <div class="text_grande style1" style="float:left"></div>
            </div>
			 <? } ?> 
              </form>
              </div>-->
			  
			  
        <!-- <div class="row topic">  
			<form name="formTADN" method="post">
			<input name="verobjetivos" type="hidden" id="verobjetivos" value="<?echo"$verobjetivos";?>" />
              <div class="row topic">
                <div class="row text_mediano_blanco title">Training and Development Needs</div>
				<span class="style11">Example. Use this section to communicate your training and development needs to your supervisor. Review your role’s main responsibilities and identify if there are gaps in terms of performance. Avoid limiting development actions to classroom training only.</span>
                <div class="row" style="background:#eeeeee">
                 
                    <div class="column" style="text-align:left">
                      
                    </div>
                </div>
                  <div class="fixColumn btnAgregar">
                   
                  </div>
              </div>
           
                <? while ($row=mysqli_fetch_assoc($career7)) { ?>
              <div class="row topic">
           
                <div class="row infoRow" id="divJH2">
                  <div class="fixColumn date" style="width:800px"><? echo $row['training'];?></div>
                  <div class="text_grande style1" style="float:left"></div>
             </div>
			   
                <? } ?> 
              </form>
              </div>-->
			  
			
		
	<!--SECCION DE SUPERVISOREES-->
	<div class="row topic">  
			<form name="formStre" method="post">
			<input name="verobjetivos" type="hidden" id="verobjetivos" value="<?echo"$verobjetivos";?>" />
              <div class="row topic">
                <div class="row text_mediano_blanco title2">Strengths</div>
				<span class="style11">Example. Use this section to document the employee’s strengths.</span>
              </div>
           <div class="row">
                  <div class="fixColumn date2"><strong>Competency</strong></div>
                  <div class="fixColumn date2"><strong>Comments</strong></div>
                  <div class="fixColumn date2"><strong>Date Entered</strong></div>
                </div>
                <? while ($row=mysqli_fetch_assoc($career8)) { ?>
           
                <div class="row infoRow" id="divJH2">
                  <div class="fixColumn date2"><? echo $row['competency'];?></div>
				  <div class="fixColumn date2"><? echo $row['coments'];?></div>
				  <div class="fixColumn date2"><? echo $row['date'];?></div>
                 
             </div>
			 <? } ?> 
              </form>
              </div>
			  
			  
            <div class="row topic">  
			<form name="formDevN" method="post">
			<input name="verobjetivos" type="hidden" id="verobjetivos" value="<?echo"$verobjetivos";?>" />
              <div class="row topic">
                <div class="row text_mediano_blanco title2">Development Needs</div>
				<span class="style11">Example. Use this section to document the employee’s development needs.</span>
               
              </div>
            <div class="row">
                  <div class="fixColumn date2"><strong>Competency</strong></div>
                  <div class="fixColumn date2"><strong>Comments</strong></div>
                  <div class="fixColumn date2"><strong>Date Entered</strong></div>
                </div>
                <? while ($row=mysqli_fetch_assoc($career9)) { ?>
           
                <div class="row infoRow" id="divJH2">
                 <div class="fixColumn date2"><? echo $row['competency'];?></div>
				  <div class="fixColumn date2"><? echo $row['coments'];?></div>
				  <div class="fixColumn date2"><? echo $row['date'];?></div>
                 
             </div>
			  <? } ?> 
              </form>
              </div>
			  
			  
              <div class="row topic"> 
			<form name="formDevNeed" method="post">
			<input name="verobjetivos" type="hidden" id="verobjetivos" value="<?echo"$verobjetivos";?>" />
               <div class="row topic">
                <div class="row text_mediano_blanco title2">Development Plan</div>
				<span class="style11">Example. Use this section to document the employee’s development plan. List at least 2 action items. Avoid limiting development actions to classroom training only.</span>
                 
              	</div>
				
                <div class="row">
                  <div class="fixColumn date2"><strong>Focus</strong></div>
                  <div class="fixColumn date2"><strong>Description</strong></div>
                  <div class="fixColumn date2"><strong>Date Entered</strong></div>
                </div>
                <? while ($row=mysqli_fetch_assoc($career10)) { ?>
                <div class="row infoRow" id="divJH2">
                  <div class="fixColumn date2"><? echo $row['focus'];?></div>
                  <div class="fixColumn date2"><? echo $row['description'];?></div>
                  <div class="fixColumn date2"><? echo $row['date'];?></div>
                 
                </div>
                <? } ?> 
              </form>
              </div>
			  
			 <!-- SECCION 17-->
			 <!--
			   <div class="row topic"> 
			<form name="formGENERAL" method="post">
			<input name="verobjetivos" type="hidden" id="verobjetivos" value="<?echo"$verobjetivos";?>" />
               <div class="row topic">
                <div class="row text_mediano_blanco title2">General Summary **Manager view inly</div>
				<span class="style11"></span>
                 
              	</div>
				
                <div class="row">
                  <div class="fixColumn date2"><strong>Comment</strong></div>
                  <div class="fixColumn date2"><strong>Date Entered</strong></div>
                </div>
                <? while ($row=mysqli_fetch_assoc($general_summary)) { ?>
                <div class="row infoRow" id="divJH2">
                  <div class="fixColumn date2"><? echo $row['comment'];?></div>
                  <div class="fixColumn date2"><? echo $row['date_entered'];?></div>
                  
                 
                </div>
                <? } ?> 
              </form>
              </div>
			  
			  -->
			<br />
            <br />
			</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><img src="images/spacer.gif" width="10" height="50" /></td>
      </tr>
      <tr>
        <td><table width="350" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td width="145"><a href="cambia_pass.php?id=<?echo"$idU";?>" class="iframe2" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image21','','images/b_cambio_r.png',1)"><img src="images/b_cambio.png" name="Image21" width="145" height="23" border="0" id="Image21" /></a></td>
            <td><img src="images/spacer.gif" width="16" height="20" /></td>
            <td width="114">
			<a href="<? echo $_SESSION["idA"]=="1"? 'admin.php':'menu.php';?>" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image24','','images/b_administracion_r.png',1)"><img src="images/b_administracion.png" name="Image24" width="114" height="23" border="0" id="Image24" /></a></td>
            <td><img src="images/spacer.gif" width="17" height="20" /></td>
            <td><a href="logout.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image25','','images/b_log_out_r.png',1)"><img src="images/b_log_out.png" name="Image25" width="71" height="23" border="0" id="Image25" /></a></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
