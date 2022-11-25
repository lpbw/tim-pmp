<?
session_start();
include "checar_sesion_admin.php";
include "coneccion_i.php";


require_once(dirname(__FILE__)."/dompdf/dompdf_config.inc.php");
require_once ("dompdf/include/style.cls.php");


$id=$_GET["id"]; 


 $consulta  = "SELECT id, admin, nombre, email, id_jefe, puesto, sexo, fecha_contratacion, TIMESTAMPDIFF(YEAR, fecha_nacimiento, now()) as edad, TIMESTAMPDIFF(YEAR, fecha_contratacion, now()) as servicio, id_departamento, numero_colaboradores, imagen from usuarios where id=$id";
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
	
	$consulta4  = "SELECT count(*) as direct from usuarios where id_jefe=$id and activo=1";
    $resultado4 = mysqli_query($enlace,$consulta4) or die("<h1>Usuario no encontrado</h1>");
	$direct=mysqli_fetch_assoc($resultado4);
	
	$consulta5  = "SELECT count(*) as team from usuarios where id_departamento={$usuario['id_departamento']} and activo=1";
    $resultado5 = mysqli_query($enlace,$consulta5) or die("<h1>Usuario no encontrado</h1>");
	$team=mysqli_fetch_assoc($resultado5);
	
	$total_team=($usuario['numero_colaboradores'])+($team['team']);
 
// -----------------
// OBTENIENDO DATOS
// -----------------

$query = "SELECT *,
                DATE_FORMAT( from_date,'%d %b %Y') AS from_date, 
                DATE_FORMAT( to_date  ,'%d %b %Y') AS to_date
                 FROM job_history WHERE id_usuario = $id AND is_inside_textron = 1";
$job_history_textron = mysqli_query($enlace,$query) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistema $query</h1>");

$query = "SELECT *,
                DATE_FORMAT( from_date,'%d %b %Y') AS from_date, 
                DATE_FORMAT( to_date  ,'%d %b %Y') AS to_date
                 FROM job_history WHERE id_usuario = $id AND is_inside_textron = 2";
$job_history_early = mysqli_query($enlace,$query) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistema</h1>");

$query = "SELECT *,
                DATE_FORMAT( from_date,'%d %b %Y') AS from_date, 
                DATE_FORMAT( to_date  ,'%d %b %Y') AS to_date
                  FROM job_history WHERE id_usuario = $id AND is_inside_textron = 0";
$job_history = mysqli_query($enlace,$query) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistema $query</h1>");

$query = "SELECT *, 
                DATE_FORMAT( to_date  ,'%d %b %Y') AS to_date
                  FROM education_history WHERE id_usuario = $id";
$education_history = mysqli_query($enlace,$query) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistema $query</h1>");

$query = "SELECT * FROM carrer_highlights WHERE id_usuario = $id";
$carrer_highlights = mysqli_query($enlace,$query) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistema</h1>");

$query = "SELECT * FROM other_skills WHERE id_usuario = $id";
$other_skills = mysqli_query($enlace,$query) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistema</h1>");

$query = "SELECT * FROM international_experience WHERE id_usuario = $id";
$career = mysqli_query($enlace,$query) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistema</h1>");

$query = "SELECT * FROM language_capability WHERE id_usuario = $id";
$career2 = mysqli_query($enlace,$query) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistema</h1>");

$query = "SELECT * FROM geographic_mobility WHERE id_usuario = $id order by id desc";
$career3 = mysqli_query($enlace,$query) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistema</h1>");

$query = "SELECT *,
			DATE_FORMAT( date,'%d %b %Y') AS date
 			FROM career_aspirations WHERE id_usuario = $id";
$career4 = mysqli_query($enlace,$query) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistema</h1>");

$query = "SELECT *,
			DATE_FORMAT( date,'%d %b %Y') AS date FROM textron_leadership_development WHERE id_usuario = $id";
$career5 = mysqli_query($enlace,$query) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistema</h1>");

$query = "SELECT * FROM textron_six_sigma_certifications WHERE id_usuario = $id";
$career6 = mysqli_query($enlace,$query) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistema</h1>");

$query = "SELECT * FROM training_and_development_needs WHERE id_usuario = $id";
$career7 = mysqli_query($enlace,$query) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistema</h1>");

$query = "SELECT *,
			DATE_FORMAT( date,'%d %b %Y') AS date FROM strengths WHERE id_usuario = $id";
$career8 = mysqli_query($enlace,$query) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistema</h1>");

$query = "SELECT *,
			DATE_FORMAT( date,'%d %b %Y') AS date FROM development_needs WHERE id_usuario = $id";
$career9 = mysqli_query($enlace,$query) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistema</h1>");

$query = "SELECT *,
			DATE_FORMAT( date,'%d %b %Y') AS date FROM development_needs_2 WHERE id_usuario = $id";
$career10 = mysqli_query($enlace,$query) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistema</h1>");

$query = "SELECT *,
			DATE_FORMAT( date,'%d %b %Y') AS date FROM career_potential WHERE id_usuario = $id";
$career11 = mysqli_query($enlace,$query) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistema</h1>");

$query = "SELECT * FROM talent_assessment WHERE id_usuario = $id order by id desc";
$career12 = mysqli_query($enlace,$query) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistema</h1>");

$query = "SELECT *,
				DATE_FORMAT( start_date,'%d %b %Y') AS start_date, DATE_FORMAT( end_date,'%d %b %Y') AS end_date FROM perfomance_history WHERE id_usuario = $id order by id desc";
$perfomance_history = mysqli_query($enlace,$query) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistema</h1>");

$query = "SELECT *,
				DATE_FORMAT( date_entered,'%d %b %Y') AS date_entered FROM general_summary WHERE id_usuario = $id order by id desc";
$general_summary = mysqli_query($enlace,$query) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistema</h1>");

$query = "SELECT * FROM succesor WHERE id_usuario = $id order by id desc";
$succesor = mysqli_query($enlace,$query) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistema</h1>");

$query = "SELECT * FROM current_nominations WHERE id_usuario = $id order by id desc";
$current_nominations = mysqli_query($enlace,$query) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistema</h1>");

$query = "SELECT * FROM resultados_anteriores WHERE id_usuario = $id";
$resultados_anteriores = mysqli_query($enlace,$query) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistema</h1>");

if($usuario['sexo']=="1"){
 $sexo="Female"; }
  else { $sexo="Male"; }
  

function covertDate($date){
  $date = explode('-', $date);
  return "$date[2]-$date[1]-$date[0]";
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?
$html="<head>";
$html .="<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
$html .="<link href=\"http://tim-pmp.com/images/textos.css\" rel=\"stylesheet\" type=\"text/css\" />";
$html .="<link type=\"text/css\" href=\"css/smoothness/jquery-ui-1.8.16.custom.css\" rel=\"stylesheet\" /> ";
$html .="<link rel=\"stylesheet\" href=\"colorbox.css\" />";
$html .="<script type=\"text/javascript\" src=\"js/jquery-1.6.2.min.js\"></script>";
$html .="<script type=\"text/javascript\" src=\"js/jquery-ui-1.8.16.custom.min.js\"></script>";
$html .="<script src=\"colorbox/jquery.colorbox-min.js\"></script>";
$html .="<style type=\"text/css\">";
$html .="  body {";
$html .="  	margin-left: 0px;";
$html .="  	margin-top: 0px;";
$html .="  	margin-right: 0px;";
$html .="  	margin-bottom: 0px;";
$html .="  	background-image: url();";
$html .="  }";
$html .="</style>";
$html .="<style type=\"text/css\">
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
</style>";
$html.="</head>";
$html.="<body onload=\"MM_preloadImages('images/b_cambio_r.png','images/b_administracion_r.png','images/b_log_out_r.png')\">";

$html.="<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
  <tr>
    <td height=\"698\" valign=\"top\"><table width=\"85%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
      <tr>
        <td><img src=\"http://tim-pmp.com/images/spacer.gif\" width=\"10\" height=\"20\" /></td>
      </tr>
      <tr>
        <td><div align=\"center\">
          <table width=\"850\" border=\"0\" cellspacing=\"7\" cellpadding=\"0\">
            <tr>
              <td><div align=\"center\" class=\"text_grande style1\">{$usuario['nombre']}</div></td>
            </tr>
            <tr>
              <td><div align=\"center\" class=\"text_mediano\">Career File</div></td>
            </tr>
          </table>
        </div></td>
      </tr>
      <tr>
        <td><img src=\"http://tim-pmp.com/images/spacer.gif\" width=\"10\" height=\"20\" /></td>
      </tr>
      <tr>
        <td><img src=\"http://tim-pmp.com/images/spacer.gif\" width=\"10\" height=\"10\" /></td>
      </tr>
	   <tr>
        <td><img src=\"http://tim-pmp.com/images/spacer.gif\" width=\"10\" height=\"10\" /></td>
      </tr>
	  <tr>
        <td bgcolor=\"#eeeeee\"><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
  <tr>
    <td width=\"65%\"><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
  <tr>
    <td width=\"25%\" rowspan=\"3\"><img src=\"http://tim-pmp.com/empleados/{$usuario['imagen']}\" height=\"300\" width=\"200\"/></td>
    <td width=\"75%\">&nbsp;</td>
  </tr>
  <tr>
    <td valign=\"top\">&emsp;<b>{$direct['direct']}</b> Direct Reports<br/>&emsp;<b>$total_team</b> Total Team</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table></td>
    <td width=\"35%\" valign=\"top\"><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"right\">
  <tr>
    <td colspan=\"2\" align=\"left\" height=\"25\" class=\"text_mediano_blanco title\">&nbsp;Personal Information </td>
    </tr>
  <tr>
    <td align=\"right\" valign=\"top\"><B>First Name</B></td>
    <td>&nbsp;{$usuario['nombre']}</td>
  </tr>
  <tr>
    <td align=\"right\" valign=\"top\"><b>Title</b></td>
    <td>&nbsp;{$puesto['nombre']}</td>
  </tr>
  <tr>
    <td align=\"right\"><b>Division</b></td>
    <td>&nbsp;Bell Division</td>
  </tr>
  <tr>
    <td align=\"right\" valign=\"top\"><b>Deparment</b></td>
    <td>&nbsp;{$dep['nombre']}</td>
  </tr>
  <tr>
    <td align=\"right\" valign=\"top\"><b>Supervisor</b></td>
    <td>&nbsp;{$sup['nombre']}</td>
  </tr>
  <tr>
    <td align=\"right\" valign=\"top\"><b>Location</b></td>
    <td> &nbsp;T.I.M. - Bell Helicopter plant (BHMBU-BC777) </td>
  </tr>
  <tr>
    <td align=\"right\"><b>City, State, Country</b></td>
    <td> &nbsp;MEX-Mexico</td>
  </tr>
  <tr>
    <td align=\"right\"><b>Hire Date</b></td>
    <td>&nbsp;{$usuario['fecha_contratacion']}</td>
  </tr>
  <tr>
    <td align=\"right\"><b>Years of Service (Not to be used for benefit calculations)</b></td>
    <td valign=\"top\">&nbsp;{$usuario['servicio']}</td>
  </tr>
  <tr>
    <td align=\"right\"><b>Years</b></td>
    <td>&nbsp;{$usuario['edad']}</td>
  </tr>
  <tr>
    <td align=\"right\"><b>Gender</b></td>
    <td>&nbsp; $sexo </td>
  </tr>
</table></td>
  </tr>
  <tr>
        <td align=\"right\">&nbsp;</td>
      </tr>
  <tr>
        <td colspan=\"2\" bgcolor=\"#eeeeee\">&nbsp;</td>
  </tr>
		 <tr>
        <td align=\"right\">&nbsp;</td>
      </tr>
		<tr>
          <td colspan=\"2\" bgcolor=\"#eeeeee\">&nbsp;</td>
		</tr>
</table>
</td>
      </tr>
	  <tr>
        <td><img src=\"http://tim-pmp.com/images/spacer.gif\" width=\"10\" height=\"10\" /></td>
      </tr>";
	 
	  $html.="
      <tr>
        <td bgcolor=\"#eeeeee\"><table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
          <tr>
            <td height=\"250\" valign=\"top\">
			";
			///////////////////////////////////////////////////////////////////////
			 $html.="
			  <div class=\"row topic\"> 
			<form name=\"formSuccessors\" method=\"post\">
			<input name=\"verobjetivos\" type=\"hidden\" id=\"verobjetivos\" value=\"$id\" />
                <div class=\"row text_mediano_blanco title\">Successors</div>
				<span class=\"style11\"></span>
                
				
                <div class=\"row\">
                  <div class=\"fixColumn date2\"><strong>Name</strong></div>
                  <div class=\"fixColumn date2\"><strong>Readiness</strong></div>
                  <div class=\"fixColumn date2\"><strong>Current Title</strong></div>
				  <div class=\"fixColumn date2\"><strong># of other nominations</strong></div>
                </div>";
				
                 while ($row=mysqli_fetch_assoc($succesor)) { 
				 $html.="
                <div class=\"row infoRow\" id=\"divJH2\">
                  <div class=\"fixColumn date2\">{$row['name']}</div>
                  <div class=\"fixColumn date2\">{$row['readiness']}</div>
                  <div class=\"fixColumn date2\">{$row['current_title']}</div>
				  <div class=\"fixColumn date2\">{$row['other']}</div>
                </div>";
                 }
			$html.="	  
              </form>
              </div>";
			
			$html.="
			 <div class=\"row topic\"> 
			<form name=\"formCURRENT\" method=\"post\">
			<input name=\"verobjetivos\" type=\"hidden\" id=\"verobjetivos\" value=\"$id\" />
             
                <div class=\"row text_mediano_blanco title\">Current Nominations</div>
				<span class=\"style11\"></span>
                
				
                <div class=\"row\">
                  <div class=\"fixColumn date2\"><strong>Role</strong></div>
                  <div class=\"fixColumn date2\"><strong>Readiness</strong></div>
                  <div class=\"fixColumn date2\"><strong>Incumbent(s)</strong></div>
				  <div class=\"fixColumn date2\"><strong>Last Modified</strong></div>
                </div>";
				
                while ($row=mysqli_fetch_assoc($current_nominations)) {
				$html.="
                <div class=\"row infoRow\" id=\"divJH2\">
                  <div class=\"fixColumn date2\">{$row['role_add']}</div>
                  <div class=\"fixColumn date2\">{$row['readiness']}</div>
                  <div class=\"fixColumn date2\">{$row['incumbent']}</div>
				  <div class=\"fixColumn date2\">{$row['last_modified']}</div>
                </div>";
                }
				$html.=" 
              </form>
              </div>
			  ";
			////////////////////////////////////////////////////////////////////////////////////////
			$html.="<div class=\"row topic\">
              <form id=\"form1\" name=\"form1\" method=\"post\" action=\"\">
                <div class=\"row text_mediano_blanco title\">Textron Job History </div>
              <div class=\"row\">
               <div class=\"fixColumn date\"><strong>Start Date</strong></div>
                <div class=\"fixColumn date\"><strong>End Date</strong></div>
				<div class=\"fixColumn date2\"><strong>Title</strong></div>
                <div class=\"fixColumn date2\"><strong>Business Unit</strong></div>
                <div class=\"fixColumn date2\"><strong>City, State</strong></div>
                <div class=\"fixColumn tinyText2\"><strong>Country</strong></div>
				<div class=\"fixColumn tinyText2\"><strong>Function</strong></div>
              </div> ";
			 
			  
             while ($row=mysqli_fetch_assoc($job_history_textron)) { 
               $html.="<div class=\"row infoRow\" id=\"divJH0\">
			    <div class=\"fixColumn date\">{$row['from_date']}</div>
                <div class=\"fixColumn date\">{$row['to_date']}</div>
                <div class=\"fixColumn date2\">{$row['position']}</div>
                <div class=\"fixColumn date2\">{$row['business_unit']}</div>
                <div class=\"fixColumn date2\">{$row['city_state']}</div>
				<div class=\"fixColumn tinyText2\">{$row['country']}</div>
				<div class=\"fixColumn tinyText2\">{$row['function']}</div>
                
              </div>";
               } 
			   
			  
              $html.="</form>
            </div>";
			
			
			
			 $html.="<div class=\"row topic\">
              <form id=\"form5\" name=\"form5\" method=\"post\" action=\"\">
                <div class=\"row text_mediano_blanco title\">Early Textron Job History not Reflected in Textron Job History Above </div> 
                <div class=\"row\">
                  <div class=\"fixColumn date\"><strong>Start Date</strong></div>
                  <div class=\"fixColumn date\"><strong>End Date</strong></div>
                  <div class=\"fixColumn tinyText\"><strong>Title</strong></div>
                  <div class=\"fixColumn tinyText\"><strong>Business Unit</strong></div>
                  <div class=\"fixColumn tinyText\"><strong>City, State</strong></div>
				  <div class=\"fixColumn tinyText\"><strong>Country</strong></div>
				  <div class=\"fixColumn tinyText\"><strong>Function</strong></div>
                </div>";
				
               while ($row=mysqli_fetch_assoc($job_history_early)) { 
                 $html.="<div class=\"row infoRow\" id=\"divJH\">
                <div class=\"fixColumn date\">{$row['from_date']}</div>
                <div class=\"fixColumn date\">{$row['to_date']}</div>
                <div class=\"fixColumn tinyText\">{$row['position']}</div>
                <div class=\"fixColumn tinyText\">{$row['business_unit']}</div>
                <div class=\"fixColumn tinyText\">{$row['city_state']}</div>
				<div class=\"fixColumn tinyText\">{$row['country']}</div>
				<div class=\"fixColumn tinyText\">{$row['function']}</div>
                </div>";
              } 
			  
			    $html.="</form>
              </div>";
			  
			  
              $html.="
			  <div class=\"row topic\">
              <form id=\"form2\" name=\"form2\" method=\"post\" action=\"\">
                <div class=\"row text_mediano_blanco title\">Non - Textron Job History </div>    
                <div class=\"row\">
                  <div class=\"fixColumn tinyText3\"><strong>Start Date</strong></div>
                  <div class=\"fixColumn tinyText3\"><strong>End Date</strong></div>
                  <div class=\"fixColumn tinyText\"><strong>Title</strong></div>
                  <div class=\"fixColumn tinyText\"><strong>Company Name</strong></div>
                  <div class=\"fixColumn tinyText\"><strong>Type of Business</strong></div>
				  <div class=\"fixColumn tinyText\"><strong>City, State</strong></div>
				  <div class=\"fixColumn tinyText\"><strong>Country</strong></div>
				  <div class=\"fixColumn tinyText\"><strong>Function</strong></div>
				  <div class=\"fixColumn tinyText\"><strong>Type of Role</strong></div>
                </div>
				";
               while ($row=mysqli_fetch_assoc($job_history)) { 
			  $html.="
                <div class=\"row infoRow\" id=\"divJH\">
                <div class=\"fixColumn2 tinyText3\">{$row['from_date']}</div>
                <div class=\"fixColumn2 tinyText3\">{$row['to_date']}</div>
                <div class=\"fixColumn2 tinyText\">{$row['position']}</div>
				<div class=\"fixColumn2 tinyText\">{$row['business_unit']}</div>
                <div class=\"fixColumn2 tinyText\">{$row['type_business']}</div>
                <div class=\"fixColumn2 tinyText\">{$row['city_state']}</div>
				<div class=\"fixColumn2 tinyText\">{$row['country']}</div>
				<div class=\"fixColumn2 tinyText\">{$row['function']}</div>
				<div class=\"fixColumn2 tinyText\">{$row['type_role']}</div>
                </div>
				";
               }  
			  $html.="
			  </form>
              </div>
			  ";
			  
			  
			  $html.="
			  <div class=\"row topic\">
              <form id=\"form4\" name=\"form4\" method=\"post\" action=\"\">
                <div class=\"row text_mediano_blanco title\">Career Highlights </div>
				<span class=\"style11\">Example. This section provides the opportunity to share highlights of your career. While this is not intended to be a resume or Curriculum Vita (CV), you may enter specific accomplishments or experiences to illustrate the most important aspects of your career. The Date, Job Title and Company Name must match a record in either the Textron Job History or Non-Textron Job History sections above.</span>  
                <div class=\"row\">
                  <div class=\"fixColumn date2\"><strong>Year</strong></div>
                  <div class=\"fixColumn date2\"><strong>Job Title</strong></div>
                  <div class=\"fixColumn date2\"><strong>Company Name</strong></div>
                  <div class=\"fixColumn date3\"><strong>Career Highlight</strong></div>
                </div>
				";
                 while ($row=mysqli_fetch_assoc($carrer_highlights)) { 
				$html.="
                <div class=\"row infoRow\" id=\"divJH2\">
                  <div class=\"fixColumn date2\">{$row['to_date']}</div>
                  <div class=\"fixColumn date2\">{$row['job_title']}</div>
                  <div class=\"fixColumn date2\">{$row['company']}</div>
                  <div class=\"fixColumn date3\">{$row['achievement']}</div>
                </div>
				";
                 }  
				$html.="
              </form>
              </div>
			  ";
			  
			  $html.="
			   <div class=\"row topic\">  
			<form name=\"formIE\" method=\"post\" id=\"formIE\" action=\"\">
                 <div class=\"row text_mediano_blanco title\">International Experience </div>
				  <span class=\"style11\">Example. Talent Management Summit (México, DF), Wealthness Coaching Summit (US), Stress Management (México), Human Resources Management, Coaching.</span>
			 <div class=\"row\">
                  <div class=\"fixColumn date2\"><strong>Country</strong></div>
                  <div class=\"fixColumn date2\"><strong>Type of Experince</strong></div>
                  <div class=\"fixColumn date2\"><strong>Years of Experience</strong></div>
                  <div class=\"fixColumn date2\"><strong>Company Name</strong></div>
				  <div class=\"fixColumn date2\"><strong>Comments</strong></div>
                </div>
				";
                
                while ($row=mysqli_fetch_assoc($career)) { 
				$html.="
           <div class=\"row infoRow\" id=\"divJH2\">
                  <div class=\"fixColumn date2\">{$row['country']}</div>
				  <div class=\"fixColumn date2\">{$row['type_experience']}</div>
				  <div class=\"fixColumn date2\">{$row['years']}</div>
				  <div class=\"fixColumn date2\">{$row['company']}</div>
				  <div class=\"fixColumn date2\">{$row['coments']}</div>
             </div>
			 ";
			     } 
				$html.="
              </form>
              </div>
			  ";
			  
			 $html.=" 
              <div class=\"row topic\">
              <form id=\"form3\" name=\"form3\" method=\"post\" action=\"\">
                <div class=\"row text_mediano_blanco title\">Education History </div>
				<span class=\"style11\">Example. This section should reflect your formal education history such as high school, compulsory, or university degrees completed or currently pursuing. Do not record Textron University courses, or other certifications, licenses or certificates of completion in this section. Note: Select the first day of the month if you do not remember the actual Graduation Date (e.g. 05-01-1997).</span>
                <div class=\"row\">
                  <div class=\"fixColumn date2\"><strong>Degree</strong></div>
				   <div class=\"fixColumn date2\"><strong>Major</strong></div>
				    <div class=\"fixColumn tinyText2\"><strong>Country</strong></div>
                  <div class=\"fixColumn date2\"><strong>School</strong></div>
                  <div class=\"fixColumn tinyText2\"><strong>Location</strong></div>
				   <div class=\"fixColumn tinyText2\"><strong>Graduation Date</strong></div>
				    <div class=\"fixColumn tinyText2\"><strong>Comments</strong></div>
                </div>
				";
               while ($row=mysqli_fetch_assoc($education_history)) { 
			  $html.="
                <div class=\"row infoRow\" id=\"divJH\">
                <div class=\"fixColumn3 date2\">{$row['degree']}</div>
				<div class=\"fixColumn3 date2\">{$row['major']}</div>
				<div class=\"fixColumn3 tinyText2\">{$row['country']}</div>
                <div class=\"fixColumn3 date2\">{$row['school']}</div>
                <div class=\"fixColumn3 tinyText2\">{$row['location']}</div>
				<div class=\"fixColumn3 tinyText2\">{$row['to_date']}</div>
				<div class=\"fixColumn3 tinyText2\">{$row['coments']}</div>
                </div>
				";
               } 
			  $html.="
			  </form>
              </div>";
			 

 $html.="
<div class=\"row topic\">  
			<form name=\"formTLD\" method=\"post\">
                <div class=\"row text_mediano_blanco title\">Textron Leadership Development</div>
            <div class=\"row\">
                  <div class=\"fixColumn date2\"><strong>Course Name</strong></div>
                  <div class=\"fixColumn date2\"><strong>Institution Name</strong></div>
                  <div class=\"fixColumn date2\"><strong>Status</strong></div>
                  <div class=\"fixColumn date2\"><strong>Date Completed</strong></div>
                </div>
				";
             
                while ($row=mysqli_fetch_assoc($career5)) { 
				$html.="
                <div class=\"row infoRow\" id=\"divJH2\">
                  <div class=\"fixColumn date2\">{$row['course']}</div>
				  <div class=\"fixColumn date2\">{$row['institution']}</div>
				  <div class=\"fixColumn date2\">{$row['status']}</div>
				  <div class=\"fixColumn date2\">{$row['date']}</div>
            </div>
			";
                 } 
				$html.="
              </form>
              </div>
            ";
			   
			  $html.="
		<div class=\"row topic\">  
			<form name=\"formLC\" method=\"post\" action=\"\" id=\"formLC\">
                <div class=\"row text_mediano_blanco title\">Language Capability </div>
				<span class=\"style11\">Example. English 800 points TOEIC tool</span>
			  <div class=\"row\">
                  <div class=\"fixColumn date2\"><strong>Language</strong></div>
                  <div class=\"fixColumn date2\"><strong>Speaking Proficiency</strong></div>
                  <div class=\"fixColumn date2\"><strong>Reading Proficiency</strong></div>
                  <div class=\"fixColumn date2\"><strong>Writing Proficiency</strong></div>
				  <div class=\"fixColumn date2\"><strong>Comments</strong></div>
                </div>
				";
                 while ($row=mysqli_fetch_assoc($career2)) { 
				 $html.="
                <div class=\"row infoRow\" id=\"divJH2\">
                  <div class=\"fixColumn date2\">{$row['language']}</div>
				  <div class=\"fixColumn date2\">{$row['speaking']}</div>
				  <div class=\"fixColumn date2\">{$row['reading']}</div>
				  <div class=\"fixColumn date2\">{$row['writing']}</div>
				  <div class=\"fixColumn date2\">{$row['coments']}</div>
             </div>
			 ";
			  } 
			 $html.="
              </form>
              </div>
			 ";
		 //si
			 $html.="
			 <div class=\"row topic\">  
			<form name=\"formPERFOR\" method=\"post\" action=\"\" id=\"formPERFOR\">
                <div class=\"row text_mediano_blanco title\">Performance History </div>
			  <div class=\"row\">
                  <div class=\"fixColumn date2\"><strong>Start Date</strong></div>
                  <div class=\"fixColumn date2\"><strong>End Date</strong></div>
                  <div class=\"fixColumn date2\"><strong>Rating</strong></div>
                </div>
				";
                 while ($row=mysqli_fetch_assoc($resultados_anteriores)) { 
                 $html.="<div class=\"row infoRow\" id=\"divJH2\">
                  <div class=\"fixColumn date2\">01/Jan/{$row['anio']}</div>
				  <div class=\"fixColumn date2\">31/Dec/{$row['anio']}</div>
				  <div class=\"fixColumn date2\">{$row['calificacion']}</div>
             </div>";
			  } 
				 while ($row=mysqli_fetch_assoc($perfomance_history)) { 
				 
                $html.="<div class=\"row infoRow\" id=\"divJH2\">
                  <div class=\"fixColumn date2\">{$row['start_date']}</div>
				  <div class=\"fixColumn date2\">{$row['end_date']}</div>
				  <div class=\"fixColumn date2\">{$row['rating']}</div>
             </div>";
			  } 
			  
			   
			  
			  $html.=" 
              </form>
              </div>";
			////////////////////////MANAGER
			$html.="
			 <div class=\"row topic\"> 
			<form name=\"formTA\" method=\"post\">
			<input name=\"verobjetivos\" type=\"hidden\" id=\"verobjetivos\" value=\"$id\" />
              <div class=\"row topic\">
                <div class=\"row text_mediano_blanco title2\">Talent Assessment **Manager View Only</div>
				<span class=\"style11\">Data in this section is displayed on the Succession Org Chart.</span>
				";
				
				  $rowTA=mysqli_fetch_assoc($career12);  
				  $html.="
				<div class=\"row\" style=\"background:#eeeeee\">
              <div class=\"column4\"  align=\"right\">
                    <div class=\"ancho\">Strategic Fit</div>
					<div class=\"ancho\">Probability of Loss</div>
					<div class=\"ancho\">Impact of Loss</div>
					<div class=\"ancho\">Potential</div>
					<div class=\"ancho\">Date Entered</div>					
					</div>
					
					<div class=\"column4\" align=\"left\">
					<div class=\"ancho\">{$rowTA['strategic']}</div>
					<div class=\"ancho\">{$rowTA['probability']}</div>
                    <div class=\"ancho\">{$rowTA['impact']}</div>
					<div class=\"ancho\">{$rowTA['potential']}</div>
					<div class=\"ancho\">{$rowTA['date']}</div> 
                    </div>
                </div>
					
              </div>
              </form>
              </div>
			";
			$html.="
			  <div class=\"row topic\"> 
			<form name=\"formCareerPotential\" method=\"post\">
			<input name=\"verobjetivos\" type=\"hidden\" id=\"verobjetivos\" value=\"$id\" />
             
                <div class=\"row text_mediano_blanco title2\">Career Potential **Manager View Only</div>
				<span class=\"style11\">This sectionis to reflect the higest level you believe this employee is able to achieve. If you choose to add a record in this section, the red star indicates that it is a required field.</span>
               
                <div class=\"row\">
                  <div class=\"fixColumn date2\"><strong>Level</strong></div>
                  <div class=\"fixColumn date2\"><strong>Function</strong></div>
                  <div class=\"fixColumn date2\"><strong>Business Unit</strong></div>
				  <div class=\"fixColumn date2\"><strong>Timeframe</strong></div>
				   <div class=\"fixColumn date2\"><strong>Date Entered</strong></div>
                </div>";
				
                 while ($row=mysqli_fetch_assoc($career11)) { 
                $html.="
				<div class=\"row infoRow\" id=\"divJH2\">
                  <div class=\"fixColumn date2\">{$row['level']}</div>
                  <div class=\"fixColumn date2\">{$row['function']}</div>
                  <div class=\"fixColumn date2\">{$row['business_unit']}</div>
				  <div class=\"fixColumn date2\">{$row['timeframe']}</div>
				  <div class=\"fixColumn date2\">{$row['date']}</div>
                  
                </div>";
                 }  
				 
				$html.="
              </form>
              </div>";
			
			/////////////////////////////
			  $html.="
			  <div class=\"row topic\">  
			<form name=\"formCA\" method=\"post\">
                <div class=\"row text_mediano_blanco title\">Career Aspirations </div>
             <div class=\"row\">
                  <div class=\"fixColumn date2\"><strong>Level</strong></div>
                  <div class=\"fixColumn date2\"><strong>Function</strong></div>
                  <div class=\"fixColumn date2\"><strong>Business Unit</strong></div>
                  <div class=\"fixColumn date2\"><strong>Comments</strong></div>
				  <div class=\"fixColumn date2\"><strong>Date Entered</strong></div>
                </div>
				";
                 while ($row=mysqli_fetch_assoc($career4)) { 
				$html.="
                <div class=\"row infoRow\" id=\"divJH2\">
                  <div class=\"fixColumn date2\">{$row['level']}</div>
				  <div class=\"fixColumn date2\">{$row['function']}</div>
				  <div class=\"fixColumn date2\">{$row['business_unit']}</div>
				  <div class=\"fixColumn date2\">{$row['career']}</div>
				  <div class=\"fixColumn date2\">{$row['date']}</div>
            </div>
			";
			  } 
			$html.=" 
              </form>
              </div>
			 ";
			 
			
			 $html.=" 
			<div class=\"row topic\">  
			<form name=\"formGM\" method=\"post\">
              <div class=\"row topic\">
                <div class=\"row text_mediano_blanco title\">Geographic Mobility </div>
				<span class=\"style11\">Example. Yes.</span>
				";
				  $rowGM=mysqli_fetch_assoc($career3); 
				  $html.=" 
                <div class=\"row\" style=\"background:#eeeeee\">
                    <div class=\"column4\"  align=\"right\">
                    <div class=\"ancho\">Willing to Relocate</div>
					<div class=\"ancho\">Comments</div>
					<div class=\"ancho\">Date Entered</div>
					</div>
					<div class=\"column4\" align=\"left\">
					<div>{$rowGM['willing']}</div>
					<div> 
					  {$rowGM['coments']}
					</div>
                      <div>{$rowGM['date']}</div>
                    </div>
                </div>
                  
              </div>
              </form>
              </div>
			  
		";
		
	$html.="
			<div class=\"row topic\">
			<form name=\"formStre\" method=\"post\">
                <div class=\"row text_mediano_blanco title2\">Strengths</div>
				<span class=\"style11\">Example. Use this section to document the employee’s strengths.</span>
                <div class=\"row\">
                  <div class=\"fixColumn date3\"><strong>Competency</strong></div>
                  <div class=\"fixColumn date3\"><strong>Comments</strong></div>
                  <div class=\"fixColumn date2\"><strong>Date Entered</strong></div>
                </div>
				";
                while ($row=mysqli_fetch_assoc($career8)) { 
				$html.="
                <div class=\"row infoRow\" id=\"divJH2\">
                  <div class=\"fixColumn date3\">{$row['competency']}</div>
				  <div class=\"fixColumn date3\">{$row['coments']}</div>
				  <div class=\"fixColumn date2\">{$row['date']}</div>
             </div>
			 ";
			 }
			 $html.="
              </form>
              </div>";
			
			  
			  $html.="
			<div class=\"row topic\">
			<form name=\"formDevN\" method=\"post\"> 
                <div class=\"row text_mediano_blanco title2\">Development Needs</div>
				<span class=\"style11\">Example. Use this section to document the employee’s development needs.</span>
                <div class=\"row\">
                  <div class=\"fixColumn date3\"><strong>Competency</strong></div>
                  <div class=\"fixColumn date3\"><strong>Comments</strong></div>
                  <div class=\"fixColumn date2\"><strong>Date Entered</strong></div>
                </div>
				";
                 while ($row=mysqli_fetch_assoc($career9)) { 
				 $html.="
                <div class=\"row infoRow\" id=\"divJH2\">
                 <div class=\"fixColumn date3\">{$row['competency']}</div>
				  <div class=\"fixColumn date3\">{$row['coments']}</div>
				  <div class=\"fixColumn date2\">{$row['date']}</div>
             </div>
			 ";
			   } 
			   $html.=" 
              </form>
              </div>";
			   
			   
			  $html.="
        <div class=\"row topic\">
			<form name=\"formDevNeed\" method=\"post\">
                <div class=\"row text_mediano_blanco title2\">Development Plan</div>
				<span class=\"style11\">Example. Use this section to document the employee’s development plan. List at least 2 action items. Avoid limiting development actions to classroom training only.</span>
               <div class=\"row\">
                  <div class=\"fixColumn date3\"><strong>Focus</strong></div>
                  <div class=\"fixColumn date3\"><strong>Description</strong></div>
                  <div class=\"fixColumn date2\"><strong>Date Entered</strong></div>
                </div>
				";
                while ($row=mysqli_fetch_assoc($career10)) { 
				$html.="
                <div class=\"row infoRow\" id=\"divJH2\">
                  <div class=\"fixColumn date3\">{$row['focus']}</div>
                  <div class=\"fixColumn date3\">{$row['description']}</div>
                  <div class=\"fixColumn date2\">{$row['date']}</div>
                </div>
				";
                 } 
				$html.="
              </form>
              </div>";
			  
			  //////ultima manager
			  $html.="
			  <div class=\"row topic\"> 
			<form name=\"formCareerPotential\" method=\"post\">
			<input name=\"verobjetivos\" type=\"hidden\" id=\"verobjetivos\" value=\"$id\" />
             
                <div class=\"row text_mediano_blanco title2\">General Summary **Manager View Only</div>
				<span class=\"style11\"></span>
                  
              
                <div class=\"row\">
                  <div class=\"fixColumn date2\"><strong>Comment</strong></div>
                  <div class=\"fixColumn date2\"><strong>Date Entered</strong></div>
                </div>";
				
                 while ($row=mysqli_fetch_assoc($general_summary)) { 
				 $html.="
                <div class=\"row infoRow\" id=\"divJH2\">
                  <div class=\"fixColumn date2\">{$row['comment']}</div>
				  <div class=\"fixColumn date2\">{$row['date_entered']}</div>
                </div>";
                }
				$html.=" 
              </form>
              </div>";
			  
			$html.="
			<br /> 
            <br />			</td>
          </tr>
        </table></td>
      </tr>
	  ";
	  
	  $html.="
      <tr>
        <td><img src=\"http://tim-pmp.com/images/spacer.gif\" width=\"10\" height=\"50\" /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
";


$html.="
</body>
</html>
";


			//////////////////////////////
			require 'pdfcrowd.php';
try
{   
    // create an API client instance
    $client = new Pdfcrowd("mgarciavarela", "3709d94e4fd72be816a1dbf9491577bb");
	$client->setPageWidth("8.5in");
	$client->setPageHeight("11in");
	$client->setPageMargins("5mm", "5mm", "5mm", "5mm");
	$client->enableBackgrounds();
	
	$archivo="pdfs/carer_gente_".$id.".pdf";
	$out_file = fopen("$archivo", "wb");
    $client->convertHtml("$html", $out_file);
    fclose($out_file);
	
	
		
	// boundary 
        $semi_rand = md5(time()); 
        $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 

        // headers for attachment 
        $headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\""; 

         $nameArchive = basename ($archivo);
                if(is_file( $archivo )){
                    $message .= "--{$mime_boundary}\n";
					$message2 .= "--{$mime_boundary}\n";
                    $fp = @fopen($archivo,"rb");
                    $data = @fread($fp,filesize( $archivo ));
                    @fclose($fp);
                    $data = chunk_split(base64_encode($data));
                   $message .= "Content-Type: application/octet-stream; name=\"".basename($archivo)."\"\n" . 
                        "Content-Description: ".basename($archivo)."\n" .
                        "Content-Disposition: attachment;\n" . " filename=\"".basename($archivo)."\"; size=".filesize($archivo).";\n" . 
                        "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
					$message2 .= "Content-Type: application/octet-stream; name=\"".basename($archivo)."\"\n" . 
                        "Content-Description: ".basename($archivo)."\n" .
                        "Content-Disposition: attachment;\n" . " filename=\"".basename($archivo)."\"; size=".filesize($archivo).";\n" . 
                        "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
                }	
			
}
catch(PdfcrowdException $why)
{
    echo "Pdfcrowd Error: " . $why;
}	
		
echo"<script>window.location=\"pdfs/carer_gente_".$id.".pdf\"; parent.cerrarV(); </script>";

?>