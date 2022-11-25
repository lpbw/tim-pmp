<?
session_start();
include "checar_sesion_admin.php";
include "coneccion_i.php";

$idU = $_SESSION['idU'];
    $consulta  = "SELECT id, admin, nombre, email, id_jefe, puesto, sexo, fecha_contratacion, TIMESTAMPDIFF(YEAR, fecha_nacimiento, now()) as edad, TIMESTAMPDIFF(YEAR, fecha_contratacion, now()) as servicio, id_departamento, numero_colaboradores, imagen from usuarios   where id=$idU";
    $resultado = mysqli_query($enlace,$consulta) or die("<h1>Usuario no encontrado</h1>");

    if(@mysqli_num_rows($resultado)>=1)
      $usuario=mysqli_fetch_assoc($resultado);
    else  die("<h1>Usuario no encontrado</h1>");

$puestoid=$usuario['puesto'];
 $consulta  = "SELECT nombre from puestos where id=$puestoid";
    $resultado = mysqli_query($enlace,$consulta) or die();

    if(@mysqli_num_rows($resultado)>=1)
      $puesto=mysqli_fetch_assoc($resultado);


 	$consulta2  = "SELECT nombre from departamentos where id={$usuario['id_departamento']}";
    $resultado2 = mysqli_query($enlace,$consulta2) or die("<h1>Usuario no encontrado</h1>");
	$dep=mysqli_fetch_assoc($resultado2);
	
	$consulta3  = "SELECT nombre from usuarios where id={$usuario['id_jefe']}";
    $resultado3 = mysqli_query($enlace,$consulta3) or die("<h1>Usuario no encontrado</h1>");
	$sup=mysqli_fetch_assoc($resultado3);
	
	$consulta4  = "SELECT count(*) as direct from usuarios where id_jefe=$idU and activo=1";
    $resultado4 = mysqli_query($enlace,$consulta4) or die("<h1>Usuario no encontrado</h1>");
	$direct=mysqli_fetch_assoc($resultado4);
	
	$consulta5  = "SELECT count(*) as team from usuarios where id_departamento={$usuario['id_departamento']} and activo=1";
    $resultado5 = mysqli_query($enlace,$consulta5) or die("<h1>Usuario no encontrado</h1>");
	$team=mysqli_fetch_assoc($resultado5);

	$total_team=($usuario['numero_colaboradores'])+($team['team']);
// -------------
// PARA ELIMINAR
// -------------

if(isset($_POST['idEliminar']) && isset($_POST['funcion']))
  call_user_func_array($_POST['funcion'], array( $_POST['idEliminar'], $idU) );

function eliminateJH($id, $idU){
  $query = "DELETE FROM job_history WHERE id_usuario = $idU AND id = $id AND is_inside_textron = 1";
  mysqli_query($enlace,$query) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistema</h1>");
}
function eliminateJHEarly($id, $idU){
  $query = "DELETE FROM job_history WHERE id_usuario = $idU AND id = $id AND is_inside_textron = 2";
  mysqli_query($enlace,$query) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistema</h1>");
}
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
function eliminateJHNT($id, $idU){
  $query = "DELETE FROM job_history WHERE id_usuario = $idU AND id = $id AND is_inside_textron = 0";
  mysqli_query($enlace,$query) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistema</h1>");
}

function eliminateEH($id, $idU){
  $query = "DELETE FROM education_history WHERE id_usuario = $idU AND id = $id";
  mysqli_query($enlace,$query) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistema</h1>");
}

function eliminateCH($id, $idU){
  $query = "DELETE FROM carrer_highlights WHERE id_usuario = $idU AND id = $id";
  mysqli_query($enlace,$query) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistema</h1>");
}

function eliminateOS($id, $idU){
  $query = "DELETE FROM other_skills WHERE id_usuario = $idU AND id = $id";
  mysqli_query($enlace,$query) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistema</h1>");
}

function eliminateIE($id, $idU){
  $query = "DELETE FROM international_experience WHERE id_usuario = $idU AND id = $id";
  mysqli_query($enlace,$query) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistema</h1>");
}

function eliminateLC($id, $idU){
  $query = "DELETE FROM language_capability WHERE id_usuario = $idU AND id = $id";
  mysqli_query($enlace,$query) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistema</h1>");
}

function eliminateGM($id, $idU){
  $query = "DELETE FROM geographic_mobility WHERE id_usuario = $idU AND id = $id";
  mysqli_query($enlace,$query) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistema</h1>");
}

function eliminateCA($id, $idU){
  $query = "DELETE FROM career_aspirations WHERE id_usuario = $idU AND id = $id";
  mysqli_query($enlace,$query) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistema</h1>");
}

function eliminateTLD($id, $idU){
  $query = "DELETE FROM textron_leadership_development WHERE id_usuario = $idU AND id = $id";
  mysqli_query($enlace,$query) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistema</h1>");
}

function eliminateTSSC($id, $idU){
  $query = "DELETE FROM textron_six_sigma_certifications WHERE id_usuario = $idU AND id = $id";
  mysqli_query($enlace,$query) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistema</h1>");
}

function eliminateTADN($id, $idU){
  $query = "DELETE FROM training_and_development_needs WHERE id_usuario = $idU AND id = $id";
  mysqli_query($enlace,$query) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistema</h1>");
}

function eliminatePERFOR($id, $idU){
  $query = "DELETE FROM perfomance_history WHERE id_usuario = $idU AND id = $id";
  mysqli_query($enlace,$query) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistema</h1>");
}

// -------------
// PARA GUARDAR
// -------------

foreach($_POST as $k =>$v){
        $_POST[$k] = mysql_escape_string($v);
}

if($_POST['bttnStre']!=""){
  $query = "INSERT INTO strengths (id_usuario, competency, coments, date)
              VALUES ('".$usuario['id']."', '".$_POST['competencySTR']."', '".$_POST['comentsSTR']."', '".$_POST['toSTR']."')";
  mysqli_query($enlace,($query)) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistemaIN $query</h1>");
}

if($_POST['bttnDev']!=""){
  $query = "INSERT INTO development_needs (id_usuario, competency, coments, date)
              VALUES ('".$usuario['id']."', '".$_POST['competencyDN']."', '".$_POST['comentsDN']."', '".$_POST['toDN']."')";
  mysqli_query($enlace,($query)) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistemaIN $query</h1>");
}

if($_POST['bttnDev2']!=""){
  $query = "INSERT INTO development_needs_2 (id_usuario, focus, description, date)
              VALUES ('".$usuario['id']."', '".$_POST['focusDN2']."', '".$_POST['descriptionDN2']."', '".$_POST['toDN2']."')";
  mysqli_query($enlace,($query)) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistemaIN $query</h1>");
}

if($_POST['bttnJH']!=""){
  $query = "INSERT INTO job_history(id_usuario, from_date, to_date, position, business_unit, city_state, country, function, is_inside_textron) 
            VALUES ('".$usuario['id']."', '".$_POST['fromJH']."', '".
              $_POST['toJH']."', '".
			  $_POST['titleJH']."',  '".
			  $_POST['businessJH']."',  '".
			  $_POST['cityJH']."',
			   '".
			  $_POST['countryJH']."',
              '".$_POST['functionJH']."',1)";
  mysqli_query($enlace,($query)) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistema</h1>");
}

if($_POST['bttnJHEarly']!=""){
  $query = "INSERT INTO job_history(id_usuario, from_date, to_date, position, business_unit, city_state, country, function, is_inside_textron) 
            VALUES ('".$usuario['id']."', '".$_POST['fromJHEarly']."', '".
              $_POST['toJHEarly']."', '".
			  $_POST['titleJHEarly']."',  '".
			  $_POST['businessJHEarly']."',  '".
			  $_POST['cityJHEarly']."',
			   '".
			  $_POST['countryJHEarly']."',
              '".$_POST['functionJHEarly']."',2)";
  mysqli_query($enlace,($query)) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistema</h1>");
}

if($_POST['bttnJH2']!=""){
  $query = "INSERT INTO job_history(id_usuario,
  from_date,
  to_date,
  position,
  business_unit,
  
  type_business,
  city_state,
  country,
  function,
  
  
  type_role,
  is_inside_textron)  
              VALUES ('".$usuario['id']."',
			  '".$_POST['fromJH2']."',
			  '".$_POST['toJH2']."',
			  '".$_POST['titleJH2']."',
			  '".$_POST['companyJH2']."',
			  
			  '".$_POST['typeJH2']."',
			  '".$_POST['cityJH2']."',
			  '".$_POST['countryJH2']."',
			  '".$_POST['functionJH2']."',
			  
			  
			  '".$_POST['roleJH2']."'
			  ,0)";
  mysqli_query($enlace,$query) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistema</h1>");

}

if($_POST['bttnEH']!=""){
  $query = "INSERT INTO education_history(id_usuario, to_date, degree, major, country, school,location, coments) 
              VALUES ('".$usuario['id']."', '".$_POST['toEH']."', '".$_POST['degreeEH']."', '".$_POST['majorEH']."','".$_POST['countryEH']."',
              '".$_POST['schoolEH']."','".$_POST['locationEH']."','".$_POST['comentsEH']."')";
  mysqli_query($enlace,($query)) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistema</h1>");
}

if($_POST['bttnCH']!=""){
  $query = "INSERT INTO carrer_highlights(id_usuario, to_date, job_title, company, achievement)
              VALUES ('".$usuario['id']."',  '".$_POST['yearCH']."', '".$_POST['jobTitleCH']."',
               '".$_POST['companyCH']."', '".$_POST['achievementCH']."')";
  mysqli_query($enlace,($query)) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistema</h1>");
}

if($_POST['bttnOS']!=""){
  $query = "INSERT INTO other_skills(id_usuario, title, skill)
              VALUES ('".$usuario['id']."', '".$_POST['titleOS']."',
               '".$_POST['skillOS']."')";
  mysqli_query($enlace,($query)) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistema</h1>");
}

if($_POST['bttnIE']!=""){
  $query = "INSERT INTO international_experience (id_usuario, country, type_experience, years, company, coments)
              VALUES ('".$usuario['id']."', '".$_POST['countryIE']."', '".$_POST['typeIE']."','".$_POST['yearsIE']."','".$_POST['companyIE']."','".$_POST['comentsIE']."')";
  mysqli_query($enlace,($query)) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistema</h1>");
}

if($_POST['bttnLC']!=""){
  $query = "INSERT INTO language_capability (id_usuario, language, speaking, reading, writing, coments)
              VALUES ('".$usuario['id']."', '".$_POST['languageLC']."','".$_POST['speakingLC']."','".$_POST['readingLC']."','".$_POST['writingLC']."','".$_POST['comentsLC']."')";
  mysqli_query($enlace,($query)) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistema</h1>");
}

if($_POST['bttnGM']!=""){
  $query = "INSERT INTO geographic_mobility (id_usuario, willing, coments, date)
              VALUES ('".$usuario['id']."', '".$_POST['willingGM']."', '".$_POST['comenstGM']."','".$_POST['toGM']."')";
  mysqli_query($enlace,($query)) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistema</h1>");
}

if($_POST['bttnCA']!=""){
  $query = "INSERT INTO career_aspirations (id_usuario, level, function, business_unit, career, date)
              VALUES ('".$usuario['id']."', '".$_POST['levelCA']."', '".$_POST['functionCA']."', '".$_POST['businessCA']."','".$_POST['comentsCA']."','".$_POST['toCA']."')";
  mysqli_query($enlace,($query)) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistema</h1>");
}

if($_POST['bttnTLD']!=""){
  $query = "INSERT INTO textron_leadership_development (id_usuario, course, institution, status, date)
              VALUES ('".$usuario['id']."', '".$_POST['courseLD']."', '".$_POST['institutionLD']."','".$_POST['statusLD']."','".$_POST['toLD']."')";
  mysqli_query($enlace,($query)) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistema</h1>");
}

if($_POST['bttnTSSC']!=""){
  $query = "INSERT INTO textron_six_sigma_certifications (id_usuario, textron_six)
              VALUES ('".$usuario['id']."', '".$_POST['texSSC']."')";
  mysqli_query($enlace,($query)) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistema</h1>");
}

if($_POST['bttnTADN']!=""){
  $query = "INSERT INTO training_and_development_needs (id_usuario, training)
              VALUES ('".$usuario['id']."', '".$_POST['texADN']."')";
  mysqli_query($enlace,($query)) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistema</h1>");
}

if($_POST['bttnPERFOR']!=""){
  $query = "INSERT INTO perfomance_history (id_usuario, start_date, end_date, rating)
              VALUES ('".$usuario['id']."', '".$_POST['to_PERFOR']."', '".$_POST['from_PERFOR']."', '".$_POST['ratingPERFOR']."')";
  mysqli_query($enlace,($query)) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistema</h1>");
}

// -----------------
// OBTENIENDO DATOS
// -----------------

$query = "SELECT *,
                DATE_FORMAT( from_date,'%d %b %Y') AS from_date, 
                DATE_FORMAT( to_date  ,'%d %b %Y') AS to_date
                 FROM job_history WHERE id_usuario = $idU AND is_inside_textron = 1";
$job_history_textron = mysqli_query($enlace,$query) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistema</h1>");

$query = "SELECT *,
                DATE_FORMAT( from_date,'%d %b %Y') AS from_date, 
                DATE_FORMAT( to_date  ,'%d %b %Y') AS to_date
                 FROM job_history WHERE id_usuario = $idU AND is_inside_textron = 2";
$job_history_early = mysqli_query($enlace,$query) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistema</h1>");

$query = "SELECT *,
                DATE_FORMAT( from_date,'%d %b %Y') AS from_date, 
                DATE_FORMAT( to_date  ,'%d %b %Y') AS to_date
                  FROM job_history WHERE id_usuario = $idU AND is_inside_textron = 0";
$job_history = mysqli_query($enlace,$query) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistema</h1>");

$query = "SELECT *, 
                DATE_FORMAT( to_date  ,'%d %b %Y') AS to_date
                  FROM education_history WHERE id_usuario = $idU";
$education_history = mysqli_query($enlace,$query) or print("<H1>: hemos tenido un error. Contacta al adminsitrador del sistema</h1>");

$query = "SELECT * FROM carrer_highlights WHERE id_usuario = $idU order by to_date";
$carrer_highlights = mysqli_query($enlace,$query) or print("<H1> hemos tenido un error. Contacta al adminsitrador del sistema</h1>");

$query = "SELECT * FROM other_skills WHERE id_usuario = $idU";
$other_skills = mysqli_query($enlace,$query) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistema</h1>");

$query = "SELECT * FROM international_experience WHERE id_usuario = $idU";
$career = mysqli_query($enlace,$query) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistema</h1>");

$query = "SELECT * FROM language_capability WHERE id_usuario = $idU";
$career2 = mysqli_query($enlace,$query) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistema</h1>");

$query = "SELECT * FROM geographic_mobility WHERE id_usuario = $idU order by id desc";
$career3 = mysqli_query($enlace,$query) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistema</h1>");

$query = "SELECT *,
			DATE_FORMAT( date,'%d %b %Y') AS date
 			FROM career_aspirations WHERE id_usuario = $idU";
$career4 = mysqli_query($enlace,$query) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistema</h1>");

$query = "SELECT *,
			DATE_FORMAT( date,'%d %b %Y') AS date FROM textron_leadership_development WHERE id_usuario = $idU";
$career5 = mysqli_query($enlace,$query) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistema</h1>");

$query = "SELECT * FROM textron_six_sigma_certifications WHERE id_usuario = $idU";
$career6 = mysqli_query($enlace,$query) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistema</h1>");

$query = "SELECT * FROM training_and_development_needs WHERE id_usuario = $idU";
$career7 = mysqli_query($enlace,$query) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistema</h1>");

$query = "SELECT *,
			DATE_FORMAT( date,'%d %b %Y') AS date FROM strengths WHERE id_usuario = $idU";
$career8 = mysqli_query($enlace,$query) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistema</h1>");

$query = "SELECT *,
			DATE_FORMAT( date,'%d %b %Y') AS date FROM development_needs WHERE id_usuario = $idU";
$career9 = mysqli_query($enlace,$query) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistema</h1>");

$query = "SELECT *,
			DATE_FORMAT( date,'%d %b %Y') AS date FROM development_needs_2 WHERE id_usuario = $idU";
$career10 = mysqli_query($enlace,$query) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistema</h1>");

$query = "SELECT *,
			DATE_FORMAT( start_date,'%d %b %Y') AS start_date, DATE_FORMAT( end_date,'%d %b %Y') AS end_date FROM perfomance_history WHERE id_usuario = $idU order by start_date desc";
$performance_history = mysqli_query($enlace,$query) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistema</h1>");

$query = "SELECT * FROM resultados_anteriores WHERE id_usuario = $idU order by anio desc";
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
<script>
	$(document).ready(function(){
		$(".iframe2").colorbox({iframe:true,width:"450", height:"320",transition:"fade", scrolling:false, opacity:0.1});
		$(".iframe3").colorbox({iframe:true,width:"550", height:"350",transition:"fade", scrolling:false, opacity:0.1});
		$("#click").click(function(){ 
			$('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
			return false;
		});
	});
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
  .fixColumn2 {
  	text-align: left;
  	padding: 3px;
  	float:left;
	font-size: 10px
  }
  .fixColumn3 {
  	text-align: left;
  	padding: 3px;
  	float:left;
	font-size: 14px
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
   .date3{
    width:35%;
  }
  .text{
    width:10%;
  } 
  .tinyText{
    width:10%;
  }
  .tinyText2{
    width:11%;
  }
  .tinyText3{
    width:8%;
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
  <td background="images/Header_bkg.png"><table width="900" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td><div align="center"><a href="menu.php"><img src="images/header_logo.png" width="210" height="175" border="0" /></a></div></td>
      </tr>
    </table></td>
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
        <td align="right"><input name="generar" type="button" value="Exportar PDF" onclick="window.open('pdf_carer2.php?id=<? echo $idU?>')"/></td>
      </tr>
	   <tr>
        <td><img src="images/spacer.gif" width="10" height="10" /></td>
      </tr>
	  <tr>
        <td bgcolor="#eeeeee"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="65%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="25%" rowspan="3"><img src="empleados/<? echo $usuario['imagen']?>" height="300" width="200"/></td>
    <td width="75%">&nbsp;</td>
  </tr>
  <tr>
    <td valign="top">&emsp;<b><? echo $direct['direct']?></b> Direct Reports<br/>&emsp;<b><? echo $total_team ?></b> Total Team</td>
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
                <div class="row text_mediano_blanco">Textron Job History </div>
<div class="row" style="background:#eeeeee">
  <div class="column">Start Date
                  <input type="text" name="fromJH" id="fromJH" />
                  <div>End Date
                    <input type="text" name="toJH" id="toJH" />
                    </div>
                </div>
                <div class="column">Title
                  <input type="text" name="titleJH" id="titleJH" />
                  <div>
                    <div>Business Unit
                      <input type="text" name="businessJH" id="businessJH" />
</div>
					<div>City, State
                      <input type="text" name="cityJH" id="cityJH" />
                    </div>
                  </div>
                </div>
				<div class="column">
				
				<div>Country
                      <input type="text" name="countryJH" id="countryJH" />
                    </div>
				<div>Function
                      <input type="text" name="functionJH" id="functionJH" />
                    </div>
					</div>
              </div>
                <div class="fixColumn btnAgregar">
                  <input name="bttnJH" type="submit" id="bttnJH" value="agregar" />
                </div>
              <div class="row">
                <div class="fixColumn date"><strong>Start Date</strong></div>
                <div class="fixColumn date"><strong>End Date</strong></div>
				 <div class="fixColumn tinyText"><strong>Title</strong></div>
                <div class="fixColumn tinyText"><strong>Business Unit</strong></div>
                <div class="fixColumn date2"><strong>City, State</strong></div>
                <div class="fixColumn tinyText"><strong>Country</strong></div>
				<div class="fixColumn tinyText"><strong>Function</strong></div>
              </div>
              <? while ($row=mysqli_fetch_assoc($job_history_textron)) { ?>
              <div class="row infoRow" id="divJH0">
                <div class="fixColumn date"><? echo $row['from_date'];?></div>
                <div class="fixColumn date"><? echo $row['to_date'];?></div>
                <div class="fixColumn tinyText"><? echo $row['position'];?></div>
                <div class="fixColumn tinyText"><? echo $row['business_unit'];?></div>
                <div class="fixColumn date2"><? echo $row['city_state'];?></div>
				<div class="fixColumn tinyText"><? echo $row['country'];?></div>
				<div class="fixColumn tinyText"><? echo $row['function'];?></div>
                <div class="text_grande style1" style="float:left"><img src="images/eliminar.png" alt="" width="20" height="20" onclick="eliminar(<? echo $row['id']?>,'eliminateJH')" /></div>
              </div>
              <? } ?> 
              </form>
            </div>
			 <div class="row topic">
              <form id="form5" name="form5" method="post" action="">
                <div class="row text_mediano_blanco title">Early Textron Job History not Reflected in Textron Job History Above </div>
                <div class="row" style="background:#eeeeee">
                  <div class="column">Start Date
                    <input type="text" name="fromJHEarly" id="fromJHEarly" />
                    <div>End Date
                      <input type="text" name="toJHEarly" id="toJHEarly" />
                    </div>
                  </div>
                  <div class="column">Title
                    <input type="text" name="titleJHEarly" id="titleJHEarly" />
                    <div>Business Unit
                      <input type="text" name="businessJHEarly" id="businessJHEarly" />
                      <div>City, State
                        <input type="text" name="cityJHEarly" id="cityJHEarly" />
                      </div>
                    </div>
                  </div>
				  <div class="column">
				
				<div>Country
                      <input type="text" name="countryJHEarly" id="countryJHEarly" />
                    </div>
				<div>Function
                      <input type="text" name="functionJHEarly" id="functionJHEarly" />
                    </div>
					</div>
                </div>
                  <div class="fixColumn btnAgregar">
                    <input name="bttnJHEarly" type="submit" id="bttnJHEarly" value="agregar" />
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
              <? while ($row=mysqli_fetch_assoc($job_history_early)) { ?>
                <div class="row infoRow" id="divJH">
                <div class="fixColumn date"><? echo $row['from_date'];?></div>
                <div class="fixColumn date"><? echo $row['to_date'];?></div>
                <div class="fixColumn tinyText"><? echo $row['position'];?></div>
                <div class="fixColumn tinyText"><? echo $row['business_unit'];?></div>
                <div class="fixColumn tinyText"><? echo $row['city_state'];?></div>
				<div class="fixColumn tinyText"><? echo $row['country'];?></div>
				<div class="fixColumn tinyText"><? echo $row['function'];?></div>
                  <div class="text_grande style1" style="float:left"><img src="images/eliminar.png" alt="" width="20" height="20" onclick="eliminar(<? echo $row['id']?>,'eliminateJHEarly')" /></div>
                </div>
              <? } ?> </form>
              </div>
              <div class="row topic">
              <form id="form2" name="form2" method="post" action="">
                <div class="row text_mediano_blanco title">Non - Textron Job History </div>
                <div class="row" style="background:#eeeeee">
                  <div class="column">Start Date
                    <input type="text" name="fromJH2" id="fromJH2" />
                    <div>End Date
                      <input type="text" name="toJH2" id="toJH2" />
                    </div>
					<div>Title
                      <input type="text" name="titleJH2" id="titleJH2" />
                    </div>
                  </div>
                  <div class="column">Company Name
                    <input type="text" name="companyJH2" id="companyJH2" />
                    <div>Type of Business
                      <input type="text" name="typeJH2" id="typeJH2" />
					  </div>
                      <div>City, State
                        <input type="text" name="cityJH2" id="cityJH2" />
                      
                    </div>
                  </div>
				  <div class="column">
				
				<div>Country
                      <input type="text" name="countryJH2" id="countryJH2" />
                    </div>
				<div>Function
                      <input type="text" name="functionJH2" id="functionJH2" />
                    </div>
					<div>Type of Role
                      <input type="text" name="roleJH2" id="roleJH2" />
                    </div>
					</div>
                </div>
                  <div class="fixColumn btnAgregar">
                    <input name="bttnJH2" type="submit" id="bttnJH2" value="agregar" />
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
                <div class="fixColumn2 date"><? echo $row['from_date'];?></div>
                <div class="fixColumn2 date"><? echo $row['to_date'];?></div>
                <div class="fixColumn2 tinyText"><? echo $row['position'];?></div>
				<div class="fixColumn2 tinyText"><? echo $row['business_unit'];?></div>
                <div class="fixColumn2 tinyText"><? echo $row['type_business'];?></div>
                <div class="fixColumn2 tinyText"><? echo $row['city_state'];?></div>
				<div class="fixColumn2 tinyText"><? echo $row['country'];?></div>
				<div class="fixColumn2 tinyText"><? echo $row['function'];?></div>
				<div class="fixColumn2 tinyText"><? echo $row['type_role'];?></div>
				
                  <div class="text_grande style1" style="float:left"><img src="images/eliminar.png" alt="" width="20" height="20" onclick="eliminar(<? echo $row['id']?>,'eliminateJHNT')" /></div>
                </div>
              <? } ?> </form>
              </div>
			  
			  <div class="row topic">
              <form id="form4" name="form4" method="post" action="">
                <div class="row text_mediano_blanco title">Career Highlights </div>
				<span class="style11">Example. This section provides the opportunity to share highlights of your career. While this is not intended to be a resume or Curriculum Vita (CV), you may enter specific accomplishments or experiences to illustrate the most important aspects of your career. The Date, Job Title and Company Name must match a record in either the Textron Job History or Non-Textron Job History sections above.</span>
                <div class="row" style="background:#eeeeee">
                <div class="row" style="background:#eeeeee">
                  <div class="column">
                    <div>Year
                      <input type="text" name="yearCH" id="yearCH" />
                    </div>
                  </div>
                  <div class="column">
                   Job Title
                      <input type="text" name="jobTitleCH" id="jobTitleCH" />
                    <div>
					   Company Name
                    <input type="text" name="companyCH" id="companyCH" />
                    </div>
                  </div>
                    <div class="column" style="text-align:left">Career Highlight
                      <textarea name="achievementCH" rows="5" id="achievementCH" style="width:100%"></textarea>
                    </div>
                </div>
                  <div class="fixColumn btnAgregar">
                    <input name="bttnCH" type="submit" id="bttnCH" value="agregar" />
                  </div>
                <div class="row">
                  
                  <div class="fixColumn date2"><strong>Year</strong></div>
                  <div class="fixColumn date2"><strong>Job Title</strong></div>
                  <div class="fixColumn date2"><strong>Company Name</strong></div>
                  <div class="fixColumn date3"><strong>Career Highlight</strong></div>
                </div>
                <? while ($row=mysqli_fetch_assoc($carrer_highlights)) { ?>
                <div class="row infoRow" id="divJH2">
                  
                  <div class="fixColumn date2"><a href="editar_carrer.php?id=<? echo $row['id']?>" class="iframe2"><? echo $row['to_date'];?></a></div>
                  <div class="fixColumn date2"><? echo $row['job_title'];?></div>
                  <div class="fixColumn date2"><? echo $row['company'];?></div>
                  <div class="fixColumn date3"><? echo $row['achievement'];?></div>
                  <div class="text_grande style1" style="float:left"><img src="images/eliminar.png" alt="" width="20" height="20" onclick="eliminar(<? echo $row['id']?>,'eliminateCH')" /></div>
                </div>
                <? } ?> 
              </form>
              </div>
			  
			   <div class="row topic">  
			<form name="formIE" method="post" id="formIE" action="">
              <div class="row topic">
                 <div class="row text_mediano_blanco title">International Experience </div>
				  <span class="style11">Example. Talent Management Summit (México, DF), Wealthness Coaching Summit (US), Stress Management (México), Human Resources Management, Coaching.</span>
               	 <div class="row" style="background:#eeeeee">
                     <div class="column2" >
					 <div>Country
                      <input type="text" name="countryIE" id="countryIE" />
                    </div>
					<div>Type of Experience
                      <input type="text" name="typeIE" id="typeIE" />
                    </div>
             
                     </div>
					 <div class="column2" >
			 <div>Years of Experience
                      <input type="text" name="yearsIE" id="yearsIE" />
                    </div>
					<div>Company Name
                      <input type="text" name="companyIE" id="companyIE" />
                    </div>
					<div>Comments
                      <input type="text" name="comentsIE" id="comentsIE" />
                    </div>
			 </div>
                </div>
                   <div class="fixColumn btnAgregar">
                    <input name="bttnIE" type="submit" id="bttnIE" value="agregar" />
                   </div>
              </div>
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
                  <div class="text_grande style1" style="float:left"><img src="images/eliminar.png" alt="" width="20" height="20" onclick="eliminar(<? echo $row['id']?>,'eliminateIE')" /></div>
             </div>
			    <? } ?> 
              </form>
              </div>
			  
              <div class="row topic">
              <form id="form3" name="form3" method="post" action="">
                <div class="row text_mediano_blanco title">Education History </div>
				<span class="style11">Example. This section should reflect your formal education history such as high school, compulsory, or university degrees completed or currently pursuing. Do not record Textron University courses, or other certifications, licenses or certificates of completion in this section. Note: Select the first day of the month if you do not remember the actual Graduation Date (e.g. 05-01-1997).</span>
                <div class="row" style="background:#eeeeee">
                  <div class="column">Degree
                    <input type="text" name="degreeEH" id="degreeEH" />
					<div>Major
                      <input type="text" name="majorEH" id="majorEH" />
                    </div>
                    
                  </div>
                  <div class="column">
				  <div>Country
                      <input type="text" name="countryEH" id="countryEH" />
                    </div>
                    <div>School
                      <input type="text" name="schoolEH" id="schoolEH" />
                      <div>Location
                        <input type="text" name="locationEH" id="locationEH" />
                      </div>
                    </div>
                  </div>
				  <div class="column">
				  <div>Graduation Date
                      <input type="text" name="toEH" id="toEH" />
                    </div>
					<div>Comments
                      <input type="text" name="comentsEH" id="comentsEH" />
                    </div>
				  </div>
                </div>
                  <div class="fixColumn btnAgregar">
                    <input name="bttnEH" type="submit" id="bttnEH" value="agregar" />
                  </div>
                <div class="row">
                  <div class="fixColumn tinyText2"><strong>Degree</strong></div>
				   <div class="fixColumn tinyText2"><strong>Major</strong></div>
				    <div class="fixColumn tinyText2"><strong>Country</strong></div>
                  <div class="fixColumn tinyText2"><strong>School</strong></div>
                  <div class="fixColumn tinyText2"><strong>Location</strong></div>
				   <div class="fixColumn tinyText2"><strong>Graduation Date</strong></div>
				    <div class="fixColumn tinyText2"><strong>Comments</strong></div>
                </div>
              <? while ($row=mysqli_fetch_assoc($education_history)) { ?>
                <div class="row infoRow" id="divJH">
                <div class="fixColumn tinyText2"><? echo $row['degree'];?></div>
				<div class="fixColumn tinyText2"><? echo $row['major'];?></div>
				<div class="fixColumn tinyText2"><? echo $row['country'];?></div>
                <div class="fixColumn tinyText2"><? echo $row['school'];?></div>
                <div class="fixColumn tinyText2"><? echo $row['location'];?></div>
				<div class="fixColumn tinyText2"><? echo $row['to_date'];?></div>
				<div class="fixColumn tinyText2"><? echo $row['coments'];?></div>
                  <div class="text_grande style1" style="float:left"><img src="images/eliminar.png" alt="" width="20" height="20" onclick="eliminar(<? echo $row['id']?>,'eliminateEH')" /></div>
                </div>
              <? } ?> </form>
              </div>


              
<div class="row topic">  
			<form name="formTLD" method="post">
              <div class="row topic">
                <div class="row text_mediano_blanco title">Textron Leadership Development</div>
				
                <div class="row" style="background:#eeeeee">
                    <div class="column3" >
                      <div>Course Name
                      <input type="text" name="courseLD" id="courseLD" />
                    </div>
					<div>Institution Name
                      <input type="text" name="institutionLD" id="institutionLD" />
                    </div>
                    </div>
					<div class="column3" >
                      <div>Status
                      <input type="text" name="statusLD" id="statusLD" />
                    </div>
					<div>Date Completed
                      <input type="text" name="toLD" id="toLD" />
                    </div>
                    </div>
                </div>
                  <div class="fixColumn btnAgregar">
                    <input name="bttnTLD" type="submit" id="bttnTLD" value="agregar" />
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
                  <div class="text_grande style1" style="float:left"><img src="images/eliminar.png" alt="" width="20" height="20" onclick="eliminar(<? echo $row['id']?>,'eliminateTLD')" /></div>
            </div>
			
                <? } ?> 
              </form>
              </div>
            
			  
		<div class="row topic">  
			<form name="formLC" method="post" action="" id="formLC">
                <div class="row text_mediano_blanco title">Language Capability </div>
				<span class="style11">Example. English 800 points TOEIC tool</span>
                <div class="row" style="background:#eeeeee">
                    <div class="column3">
					<div>Lenguage
                      <input type="text" name="languageLC" id="languageLC" />
                    </div>
					<div>Speaking Proficiency
                      <input type="text" name="speakingLC" id="speakingLC" />
                    </div>
                    </div>
					<div class="column2">
					<div>Reading Proficieny
                      <input type="text" name="readingLC" id="readingLC" />
                    </div>
					<div>Writing Proficiency
                      <input type="text" name="writingLC" id="writingLC" />
                    </div>
					<div>Comments
                      <input type="text" name="comentsLC" id="comentsLC" />
                    </div>
                    </div>
                </div>
                  <div class="fixColumn btnAgregar">
                    <input name="bttnLC" type="submit" id="bttnLC" value="agregar" />
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
                  <div class="text_grande style1" style="float:left"><img src="images/eliminar.png" alt="" width="20" height="20" onclick="eliminar(<? echo $row['id']?>,'eliminateLC')" /></div>
             </div>
			 <? } ?> 
              </form>
              </div>
			 
			 <!-- SECCION 9 NUEVA-->
			 
			 <div class="row topic">  
			<form name="formPERFOR" method="post" action="" id="formPERFOR">
                <div class="row text_mediano_blanco title">Performance History </div>
				<span class="style11"></span>
                <div class="row" style="background:#eeeeee">
                    <div class="column3">
					<div>Start Date
                      <input type="text" name="to_PERFOR" id="to_PERFOR" />
                    </div>
					<div>End Date
                      <input type="text" name="from_PERFOR" id="from_PERFOR" />
                    </div>
                    </div>
					<div class="column2">
					<div>Rating
                      <input type="text" name="ratingPERFOR" id="ratingPERFOR" />
                    </div>
                    </div>
                </div>
                  <div class="fixColumn btnAgregar">
                    <input name="bttnPERFOR" type="submit" id="bttnPERFOR" value="agregar" />
                  </div>
              
			  <div class="row">
                  <div class="fixColumn date2"><strong>Start Date</strong></div>
                  <div class="fixColumn date2"><strong>End Date</strong></div>
                  <div class="fixColumn date2"><strong>Rating</strong></div>
                 
                </div>
				
                <? while ($row=mysqli_fetch_assoc($performance_history)) { ?>
                <div class="row infoRow" id="divJH2">
                  <div class="fixColumn date2"><? echo $row['start_date'];?></div>
				  <div class="fixColumn date2"><? echo $row['end_date'];?></div>
				  <div class="fixColumn date2"><? echo $row['rating'];?></div>
                  <div class="text_grande style1" style="float:left"><img src="images/eliminar.png" alt="" width="20" height="20" onclick="eliminar(<? echo $row['id']?>,'eliminatePERFOR')" /></div>
             </div>
			 <? } ?> 
			 <? while ($row=mysqli_fetch_assoc($resultados_anteriores)) { ?>
                <div class="row infoRow" id="divJH2">
                  <div class="fixColumn date2">01 Jan  <? echo $row['anio'];?></div>
				  <div class="fixColumn date2">31 Dec <? echo $row['anio'];?></div>
				  <div class="fixColumn date2"><? echo $row['calificacion'];?></div>
             </div>
			 <? } ?>
			  
              </form>
              </div>

			 
			 <!-- seccion 9 Performance History-(Final Rating Supervisor)
			  seccion 10 (solo manager)
			  seccion 11 (solo manager)-->
			  
			  <div class="row topic">  
			<form name="formCA" method="post">
              <div class="row topic">
                <div class="row text_mediano_blanco title">Career Aspirations </div>
				<div class="row" style="background:#eeeeee">
                 
                    <div class="column" >
                     <div>Level
                      <input type="text" name="levelCA" id="levelCA" />
                    </div>
					<div>Function
                      <input type="text" name="functionCA" id="functionCA" />
                    </div>
                    </div>
					<div class="column" >
                     <div>Business Unit
                      <input type="text" name="businessCA" id="businessCA" />
                    </div>
					<div>Comments
                      <input type="text" name="comentsCA" id="comentsCA" />
                    </div>
					<div>Date Entered
                      <input type="text" name="toCA" id="toCA" />
                    </div>
                    </div>
                </div>
                  <div class="fixColumn btnAgregar">
                    <input name="bttnCA" type="submit" id="bttnCA" value="agregar" />
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
                  <div class="text_grande style1" style="float:left"><img src="images/eliminar.png" alt="" width="20" height="20" onclick="eliminar(<? echo $row['id']?>,'eliminateCA')" /></div>
            </div>
			 <? } ?> 
              </form>
              </div>
			  
			<div class="row topic">  
			<form name="formGM" method="post">
              <div class="row topic">
                <div class="row text_mediano_blanco title">Geographic Mobility </div>
				<span class="style11">Example. Yes.</span>
				<?  $rowGM=mysqli_fetch_assoc($career3);  ?> 
                <div class="row" style="background:#eeeeee">
                    <div class="column4"  align="right">
                    <div class="ancho">Willing to Relocate</div>
					<div class="ancho">Comments</div>
					<div class="ancho">Date Entered</div>
					</div>
					<div class="column4" align="left">
					<div><input type="text" name="willingGM" id="willingGM" value="<? echo $rowGM['willing'];?>"/></div>
					<div> 
					  <textarea name="comenstGM" cols="50" rows="3" id="comenstGM"><? echo $rowGM['coments'];?></textarea>
					</div>
                      <div><input type="text" name="toGM" id="toGM" value="<? echo $rowGM['date'];?>"/></div>
                    </div>
                </div>
                  <div class="fixColumn btnAgregar">
                    <input name="bttnGM" type="submit" id="bttnGM" value="guardar" />
                  </div>
              </div>
              </form>
              </div>
			  
				
			  
			
			  
			  
			<!--<div class="row topic">
			<form name="formTSSC" method="post">
              <div class="row topic">
                <div class="row text_mediano_blanco title">Textron Six Sigma Certifications</div>
				<span class="style11">Example. If you are Textron Six Sigma (TSS) certified, list the highest certification achieved to date. Note: Select the first day of the month if you do not remember the actual Certification Date (e.g. 03/01/2011).</span>
                <div class="row" style="background:#eeeeee">
                
                    <div class="column" style="text-align:left">
                      <textarea name="texSSC" rows="5" id="texSSC" style="width:200%"></textarea>
                    </div>
                </div>
                  <div class="fixColumn btnAgregar">
                    <input name="bttnTSSC" type="submit" id="bttnTSSC" value="agregar" />
                  </div>
              </div>
           
                <? while ($row=mysqli_fetch_assoc($career6)) { ?>
              <div class="row topic">
             
                <div class="row infoRow" id="divJH2">
                  <div class="fixColumn date" style="width:800px"><? echo $row['textron_six'];?></div>
                  <div class="text_grande style1" style="float:left"><img src="images/eliminar.png" alt="" width="20" height="20" onclick="eliminar(<? echo $row['id']?>,'eliminateTSSC')" /></div>
            </div>
			<? } ?>
              </form>
              </div>-->
			  
			  
          
			<!--<div class="row topic">
			<form name="formTADN" method="post">
              <div class="row topic">
                <div class="row text_mediano_blanco title">Training and Development Needs</div>
				<span class="style11">Example. Use this section to communicate your training and development needs to your supervisor. Review your role’s main responsibilities and identify if there are gaps in terms of performance. Avoid limiting development actions to classroom training only.</span>
                <div class="row" style="background:#eeeeee">
                 
                    <div class="column" style="text-align:left">
                      <textarea name="texADN" rows="5" id="texADN" style="width:200%"></textarea>
                    </div>
                </div>
                  <div class="fixColumn btnAgregar">
                    <input name="bttnTADN" type="submit" id="bttnTADN" value="agregar" />
                  </div>
              </div>
            
                <? while ($row=mysqli_fetch_assoc($career7)) { ?>
              <div class="row topic">
            
                <div class="row infoRow" id="divJH2">
                  <div class="fixColumn date" style="width:800px"><? echo $row['training'];?></div>
                  <div class="text_grande style1" style="float:left"><img src="images/eliminar.png" alt="" width="20" height="20" onclick="eliminar(<? echo $row['id']?>,'eliminateTADN')" /></div>
             </div>
			 <? } ?> 
              </form>
              </div>-->
		
			
	<!--SECCION DE SUPERVISOREES-->
			<div class="row topic">
			<form name="formStre" method="post">
              <div class="row topic">
                <div class="row text_mediano_blanco title2">Strengths</div>
				<span class="style11">Example. Use this section to document the employee’s strengths.</span>
                
             <div class="row" style="background:#eeeeee">
                     <div class="column2">
					<div>Competency
                      <input type="text" name="competencySTR" id="competencySTR" />
                    </div>
					<div>Comments
                      <input type="text" name="comentsSTR" id="comentsSTR" />
                    </div>
                     </div>
					  <div class="column2">
					<div>Date Entered
                      <input type="text" name="toSTR" id="toSTR" />
                    </div>
					</div>
                </div>
           <div class="fixColumn btnAgregar">
                    <input name="bttnStre" type="submit" id="bttnStre" value="agregar" />
                   </div>
                <div class="row">
                  <div class="fixColumn date3"><strong>Competency</strong></div>
                  <div class="fixColumn date3"><strong>Comments</strong></div>
                  <div class="fixColumn date2"><strong>Date Entered</strong></div>
                </div>
                <? while ($row=mysqli_fetch_assoc($career8)) { ?>
           
                <div class="row infoRow" id="divJH2">
                  <div class="fixColumn date3"><? echo $row['competency'];?></div>
				  <div class="fixColumn date3"><? echo $row['coments'];?></div>
				  <div class="fixColumn date2"><? echo $row['date'];?></div>
                  <div class="text_grande style1" style="float:left"><img src="images/eliminar.png" alt="" width="20" height="20" onclick="eliminar(<? echo $row['id']?>,'eliminateStre')" /></div>
             </div>
			 <? } ?> 
              </form>
              </div>
			  
			<div class="row topic">
			<form name="formDevN" method="post">
              <div class="row topic">
                <div class="row text_mediano_blanco title2">Development Needs</div>
				<span class="style11">Example. Use this section to document the employee’s development needs.</span>
               <div class="row" style="background:#eeeeee">
                     <div class="column2">
					<div>Competency
                      <input name="competencyDN" type="text" id="competencyDN" maxlength="200" />
                    </div>
					<div>Comments
                      <input name="comentsDN" type="text" id="comentsDN" size="40" maxlength="200" />
                    </div>
                     </div>
					  <div class="column2">
					<div>Date Entered
                      <input type="text" name="toDN" id="toDN" />
                    </div>
					</div>
                </div>
                   <div class="fixColumn btnAgregar">
                    <input name="bttnDev" type="submit" id="bttnDev" value="agregar" />
					
                   </div>
              </div>
            
                <div class="row">
                  <div class="fixColumn date3"><strong>Competency</strong></div>
                  <div class="fixColumn date3"><strong>Comments</strong></div>
                  <div class="fixColumn date2"><strong>Date Entered</strong></div>
                </div>
                <? while ($row=mysqli_fetch_assoc($career9)) { ?>
           
                <div class="row infoRow" id="divJH2">
                 <div class="fixColumn date3"><a href="editar_needs.php?id=<? echo $row['id']?>" class="iframe3"><? echo $row['competency'];?></a></div>
				  <div class="fixColumn date3"><? echo $row['coments'];?></div>
				  <div class="fixColumn date2"><? echo $row['date'];?></div>
                  <div class="text_grande style1" style="float:left"><img src="images/eliminar.png" alt="" width="20" height="20" onclick="eliminar(<? echo $row['id']?>,'eliminateDev')" /></div>
             </div>
			  <? } ?> 
              </form>
              </div>
			   
			  
        <div class="row topic">
			<form name="formDevNeed" method="post">
              <div class="row topic">
                <div class="row text_mediano_blanco title2">Development Plan</div>
				<span class="style11">Example. Use this section to document the employee’s development plan. List at least 2 action items. Avoid limiting development actions to classroom training only.</span>
               <div class="row" style="background:#eeeeee">
                     <div class="column2">
				  <div>Focus
                      <input name="focusDN2" type="text" id="focusDN2" maxlength="100" />
                    </div>
					
					</div>
                  <div class="column4">
                   <div>Date Entered
                      <input type="text" name="toDN2" id="toDN2" />
                    </div>
					<div>Description
					<textarea name="descriptionDN2" rows="5" cols="50"  id="descriptionDN2" ></textarea>
                    </div>
					</div>
                </div>
                  <div class="fixColumn btnAgregar">
                    <input name="bttnDev2" type="submit" id="bttnDev2" value="agregar" />
					</div>
              	</div>
              
           
			
               <div class="row">
                  <div class="fixColumn date2"><strong>Focus</strong></div>
                  <div class="fixColumn date2"><strong>Description</strong></div>
                  <div class="fixColumn date2"><strong>Date Entered</strong></div>
                </div>
                <? while ($row=mysqli_fetch_assoc($career10)) { ?>
                <div class="row infoRow" id="divJH2">
                  <div class="fixColumn date2"><a href="editar_devel.php?id=<? echo $row['id']?>" class="iframe3"><? echo $row['focus'];?></a></div>
                  <div class="fixColumn date2"><? echo $row['description'];?></div>
                  <div class="fixColumn date2"><? echo $row['date'];?></div>
                  <div class="text_grande style1" style="float:left"><img src="images/eliminar.png" alt="" width="20" height="20" onclick="eliminar(<? echo $row['id']?>,'eliminateDev2')" /></div>
                </div>
                <? } ?> 
             
              </form>
              </div>
			  <!-- Nueva seccion 17 General Summary-->
			<br /> 
            <br />			</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><img src="images/spacer.gif" width="10" height="50" /></td>
      </tr>
      <tr>
        <?include_once("footer.php");?>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
