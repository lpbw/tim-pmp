<?

$verev = $_REQUEST["verev"];
include "checar_sesion_admin.php";
include "coneccion_i.php";

$idU=$_SESSION['idU'];

$idA=$_SESSION['idA'];

//busca informacion del evaluado
$consulta  = "SELECT empleados.id, empleados.nombre,empleados.app,

			empleados.apm, usuarios.nombre, DATE_FORMAT(evaluaciones.inicio_periodo,'%m-%d-%Y'), 

			DATE_FORMAT(evaluaciones.fin_periodo,'%d-%m-%Y'), DATE_FORMAT(evaluaciones.fecha_eval,'%d-%m-%Y'), estatus.nombre,

			 tipo_evaluacion.nombre, evaluaciones.id ,evaluaciones.inicio_periodo,

			  evaluaciones.fin_periodo, evaluaciones.estatus, empleados.nivel,

			   evaluaciones.puesto, empleados.value, evaluaciones.iks,

			    empleados.iks, MONTH(evaluaciones.inicio_periodo), MONTH(evaluaciones.fin_periodo),

				 evaluaciones.inicio_periodo, evaluaciones.fin_periodo, evaluaciones.tipo,

				 empleados.area, evaluaciones.fecha_c, evaluaciones.fecha_e ,

				 empleados.sueldo_actual , empleados.sueldo_anterior, evaluaciones.fecha_v

				 FROM evaluaciones inner join empleados on evaluaciones.id_empleado=empleados.id inner join usuarios on empleados.id_supervisor=usuarios.id inner join tipo_evaluacion on evaluaciones.tipo=tipo_evaluacion.id inner join estatus on evaluaciones.estatus=estatus.id where evaluaciones.id=$verev ";

//echo"$consulta";

$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1:$consulta ". mysqli_error($enlace) );//. mysqli_error($enlace)	

if(@mysqli_num_rows($resultado)>0){
	$res=mysqli_fetch_row($resultado);
	if($res[17]=="")
		$iks=$res[18];
	else
		$iks=$res[17];
	$mes_inicio=$res[19];
	$mes_fin=$res[20];
	$cuantos=($mes_fin-$mes_inicio)+1;
}


$relacion=array(0,0,0,0,0,0,0,0,0,0,0,0,0);
$temp_inicio=$mes_inicio;
for($i=1 ; $i<=12 ; $i++)
{
	$relacion[$i]=$temp_inicio;
	if($temp_inicio=="12")
		$temp_inicio=1;
	else
		$temp_inicio++;
}

$fis=array(0,0,0,0,0,0,0,0,0,0,0,0,0);
$pes=array(0,0,0,0,0,0,0,0,0,0,0,0,0);
$fjs=array(0,0,0,0,0,0,0,0,0,0,0,0,0);
$re=array(0,0,0,0,0,0,0,0,0,0,0,0,0);
$dis=array(0,0,0,0,0,0,0,0,0,0,0,0,0);
$consulta2  = "SELECT count(id),MONTH(fecha), tipo FROM `inasistencias`
				where id_empleado=$res[0] and fecha>='$res[21]' and fecha<='$res[22]' 
				group by MONTH(fecha), tipo order by MONTH(fecha)";

//echo" $consulta2";

$resultado2 = mysqli_query($enlace,$consulta2) or die("La consulta fall&oacute;P1: ". mysqli_error($enlace) );//. mysqli_error($enlace)	


$count=0;
while(@mysqli_num_rows($resultado2)>$count){

	$res2=mysqli_fetch_row($resultado2);

	if($res2[2]=="FI")
		$fis[$res2[1]]=$res2[0];

	if($res2[2]=="FJ")
		$fjs[$res2[1]]=$res2[0];

	if($res2[2]=="PE")
		$pes[$res[1]]=$res[0];

	if($res2[2]=="RE")
		$re[$res2[1]]=$res2[0];

	if($res2[2]=="SU")
		$dis[$res2[1]]=$res2[0];

	$count++;
}


$consultaE  = "SELECT evaluaciones.faltas_rh, us1.nombre, evaluaciones.fecha_faltas_rh,

			 evaluaciones.efi_sup, us2.nombre, evaluaciones.fecha_efi_sup,

			  evaluaciones.coment_s, evaluaciones.fecha_s, evaluaciones.aprovado_s,

			  evaluaciones.coment_c, evaluaciones.fecha_c, evaluaciones.aprovado_c,

			  evaluaciones.coment_e, evaluaciones.fecha_e, evaluaciones.aprovado_e, 

			  us3.nombre, us4.nombre, us5.nombre,

			   us6.nombre,  evaluaciones.fecha_rh, evaluaciones.aprovado_rh,

				evaluaciones.fecha_v, evaluaciones.aprovado_v, evaluaciones.coment_rh,

				evaluaciones.sueldo_autorizado, evaluaciones.fecha_valida_gerente_rh

			    FROM evaluaciones left outer join usuarios as us1 on evaluaciones.id_faltas_rh=us1.id left outer join usuarios as us2 on evaluaciones.id_efi_sup=us2.id left outer join usuarios as us3 on evaluaciones.id_c=us3.id left outer join usuarios as us4 on evaluaciones.id_e=us4.id left outer join usuarios as us5 on evaluaciones.id_rh=us5.id  left outer join usuarios as us6 on evaluaciones.id_v=us6.id where evaluaciones.id=$verev ";

//echo"$id_sup $id_estatus $consulta";

$resultadoE = mysqli_query($enlace,$consultaE) or die("La consulta fall&oacute;P1: ". mysqli_error($enlace) );//. mysqli_error($enlace)	

if(@mysqli_num_rows($resultadoE)>0)
{

	$resE=mysqli_fetch_row($resultadoE);
        if($resE[2]!=null){
            if($resE[0]==0)
                $faltas_rh = "No Aprobado";
        elseif ($resE[0]==1)
                $faltas_rh = "Aprobado";
        }
        
        if($resE[3]=="1")
            $efi_sup= "Aprobado";
        else $efi_sup= "No Aprobado";
        
        if($resE[8]==1)
        	$resE[8]="Aprobado";
        else $resE[8]="No Aprobado";

        if($resE[11]==1)
        	$resE[11]= "Aprobado";
        else $resE[11]= "No Aprobado";

        if($resE[14]==1)
        	$resE[14]= "Aprobado";
        else $resE[14]= "No Aprobado";


        if($resE[20]==1)
        	$resE[20]= "Aprobado";
        else $resE[20]= "No Aprobado";

        if($resE[22]==1)
        	$resE[22]= "Aprobado";
        else $resE[22]= "No Aprobado";
}



$efi= array();
$consultaC  = "SELECT * from detalle_eficiencia where id_evaluacion=$verev";
        $resultadoC = mysqli_query($enlace,$consultaC) or die("La consulta fall&oacute;P1: ". mysqli_error($enlace) );//. mysqli_error($enlace)	
        if(@mysqli_num_rows($resultadoC)>0){
                $resC=mysqli_fetch_row($resultadoC);
                foreach($resC as $k => $v){
                    $efi[$k-1]=$resC[$k];
                }
        }
?>

<?
//-------------------------------
//----------CALIDAD--------------
//-------------------------------


$ncr_meta=   array(0,0,0,0,0,0,0,0,0,0,0,0,0);
$ncr_resul=  array(0,0,0,0,0,0,0,0,0,0,0,0,0);
$scrap_meta= array(0,0,0,0,0,0,0,0,0,0,0,0,0);
$scrap_resul=array(0,0,0,0,0,0,0,0,0,0,0,0,0);
$snag_meta=  array(0,0,0,0,0,0,0,0,0,0,0,0,0);
$snag_resul= array(0,0,0,0,0,0,0,0,0,0,0,0,0);

$consultaC  = "SELECT * from detalle_calidad where id_evaluacion=$verev order by numero";
        $resultadoC = mysqli_query($enlace,$consultaC) or die("La consulta fall&oacute;P1: ". mysqli_error($enlace) );//. mysqli_error($enlace)	
        $countC=0;
        while(@mysqli_num_rows($resultadoC)>$countC)
        {
                $resC=mysqli_fetch_row($resultadoC);
                $ncr_meta[$countC]=$resC[3];
                $ncr_resul[$countC]=$resC[4];
                $scrap_meta[$countC]=$resC[5];
                $scrap_resul[$countC]=$resC[6];
                $snag_meta[$countC]=$resC[7];
                $snag_resul[$countC]=$resC[8];
                $countC++;
        }	
?>



<?
//-------------------------------------------
//--------------CONOCIOMIENTOS TECNICOS------
//-------------------------------------------
	
            $coment=array('','','','','','');
            $v_sup=array(0,0,0,0,0,0);
            $v_cal=array(0,0,0,0,0,0);
            $v_entre=array(0,0,0,0,0,0);
            $consultaC  = "SELECT * from detalle_competencia where id_evaluacion=$verev order by numero";
            //echo"$consulta";
            $resultadoC = mysqli_query($enlace,$consultaC) or die("La consulta fall&oacute;P1: ". mysqli_error($enlace) );//. mysqli_error($enlace)	
            $countC=0;
            while(@mysqli_num_rows($resultadoC)>$countC)					
            {
                    $resC=mysqli_fetch_row($resultadoC);
                    $coment[$countC]=$resC[4];
                    $v_sup[$countC]=$resC[5];
                    $v_cal[$countC]=$resC[6];
                    $v_entre[$countC]=$resC[7];
                    $coment_cc[$countC]=$resC[8];
                    $coment_ec[$countC]=$resC[9];
                    $countC++;
            }
            $texto1=array('','','','','','');
            $texto2=array('','','','','','');
            $nivelC=substr($res[15], -1);
            $consultaC  = "SELECT * from competencias where nivel='$nivelC'";
            //echo"$consultaC";
            $resultadoC = mysqli_query($enlace,$consultaC) or die("La consulta fall&oacute;P1: ". mysqli_error($enlace) );//. mysqli_error($enlace)	

            if(@mysqli_num_rows($resultadoC)>0)					
            {
                    $resC=mysqli_fetch_row($resultadoC);
                    $countT=0;
                    for($i=2;$i<13;$i=$i+2)
                    {
                            $texto1[$countT]=str_replace("\n","<br>",$resC[$i]);

                            $countT++;
                    }
                    $countT=0;
                    for($i=3;$i<14;$i=$i+2)
                    {

                            $texto2[$countT]=str_replace("\n","<br>",$resC[$i]);
                            $countT++;
                    }

            }
?>

<?
foreach ($v_cal as $key => $value): 

	if($key!=1 && $key!=4 ){
		if($v_cal[$key]=="1")
			$v_cal[$key]="Si";
		else
			$v_cal[$key]="No";
	} else 
		$v_cal[$key] = "N/A";

	if($key!=2){
		if($v_entre[$key]=="1")
			$v_entre[$key]="Si";
		else 
			$v_entre[$key]="No";
	} else 
		$v_entre[$key]="N/A";

	if($v_sup[$key]=="1")
		$v_sup[$key]="Si";
	else $v_sup[$key]="No";
	
endforeach;        
?>




<?
function getRowOn($id){
	global $texto2, $texto1, $coment, $coment_cc, $coment_ec, $v_sup, $v_cal, $v_entre;

  return "<tr>
                    <td valign=\"top\" class=\"text_mediano_blanco\">&nbsp;</td>

                    <td colspan=\"3\" rowspan=\"2\" valign=\"top\" bgcolor=\"#E2E2E2\" class=\"texto_tareas\"><p>
                    <span class=\"texto_tareas\"><strong>$texto1[$id]
                    </strong></span></p>

                      <p><span class=\"text_mediano\"><span class=\"texto_tareas\">$texto2[$id]</span></span></p></td>

                    </tr>

                  <tr>

                    <td valign=\"top\" class=\"text_mediano_blanco\">&nbsp;</td>

                    </tr>

  <tr>
                    <td width=\"7\" valign=\"top\" class=\"text_mediano_blanco\">&nbsp;</td>
                    <td width=\"210\" valign=\"top\" bgcolor=\"#FFFFFF\" class=\"texto_tareas\">
                    <p>Comentarios o ejemplos que soportan esta calificación:</p>
                      <p align=\"center\"></p></td>
                    <td width=\"739\" colspan=\"2\" bgcolor=\"#FFFFFF\"><div align=\"center\">
                      <table width=\"100%\" border=\"0\" cellspacing=\"3\" cellpadding=\"0\">
                         <tr>
                           <td width=\"14%\" valign=\"top\" bgcolor=\"#EEEEEE\" class=\"olvido\">
                           <div align=\"right\">Supervisor</div></td>
                           <td width=\"86%\" bgcolor=\"#EEEEEE\"><div align=\"left\">
                                  $coment[$id]          
                           </div></td>
                         </tr>
                         <tr>
                           <td valign=\"top\" bgcolor=\"#DDDDDD\" class=\"olvido\"><div align=\"right\">Calidad</div></td>
                           <td bgcolor=\"#DDDDDD\"><div align=\"left\">
                             $coment_cc[$id]
                           </div></td>
                         </tr>
                         <tr>
                           <td valign=\"top\" bgcolor=\"#B9B9B9\" class=\"olvido\"><div align=\"right\">Entrenamiento</div></td>
                           <td bgcolor=\"#B9B9B9\"><div align=\"left\">
                                   $coment_ec[$id]
                           </div></td>
                         </tr>
                       </table>
                       </div></td>
                    </tr>

                  <tr>
                    <td valign=\"top\" class=\"text_mediano_blanco\">&nbsp;</td>
                    <td colspan=\"3\" valign=\"top\" bgcolor=\"#FFFFFF\" class=\"texto_tareas\">

                      <table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"3\" bgcolor=\"#FFFFFF\">
                      <tr>
                        <td width=\"28%\" height=\"30\" bgcolor=\"#666666\" class=\"text_mediano\">
                        <div align=\"right\" class=\"text_mediano_blanco\">
                          <div align=\"center\">Validación</div>
                        </div></td>
                        <td width=\"9%\" bgcolor=\"#FFFF00\" class=\"text_mediano\">
                        <div align=\"right\">Supervisor</div></td>
                        <td width=\"12%\" bgcolor=\"#FFFF00\" class=\"text_mediano\"><div align=\"left\">
                          $v_sup[$id]
                        </div></td>

                        <td width=\"11%\" bgcolor=\"#FFFF00\" class=\"text_mediano\">
                            <div align=\"right\">
                              Calidad
                                </div></td>
                        <td width=\"15%\" bgcolor=\"#FFFF00\" class=\"text_mediano\"><div align=\"left\">
                            $v_cal[$id]
                          </div></td>
                        <td width=\"10%\" bgcolor=\"#FFFF00\" class=\"text_mediano\">
                            <div align=\"right\">
                              Entrenamiento
                                </div></td>
                        <td width=\"15%\" bgcolor=\"#FFFF00\" class=\"text_mediano\"><div align=\"left\">
                                $v_entre[$id]
                        </div></td>
                      </tr>
                    </table></td>
                    </tr>";
  
}
?>


<?
$asistenciaArray = array();
$disciplinaArray = array();
$eficienciaArray = array();
$calidadArray = array();

function getMonths($res){
	$r="";
	global $asistenciaArray, $disciplinaArray,$eficienciaArray,$calidadArray;
	for ($i=1; $i<13 ; $i++) { 
		if($i < 4){
			$r .= "<td width=\"4%\" bgcolor=\"#00475c\" class=\"text_mediano_blanco\"><div align=\"center\">Mes <br />$i </div></td>";
			$asistenciaArray[$i] = asistenciaRow($i);
			$disciplinaArray[$i] = disciplinaRow($i);
			$eficienciaArray[$i] = eficienciaRow($i);
			$calidadArray[$i] = calidadRow($i);

		}else if($res[23]>3 && $i<7){
			$r.="<td width=\"4%\" bgcolor=\"#00475c\" class=\"text_mediano_blanco\"><div align=\"center\">Mes <br />$i </div></td>";
			$asistenciaArray[$i] = asistenciaRow($i);
			$disciplinaArray[$i] = disciplinaRow($i);
			$eficienciaArray[$i] = eficienciaRow($i);
			$calidadArray[$i] = calidadRow($i);

		}else if($res[23]>6){
			$r.="<td width=\"4%\" bgcolor=\"#00475c\" class=\"text_mediano_blanco\"><div align=\"center\">Mes <br />$i </div></td>";
			$asistenciaArray[$i] = asistenciaRow($i);
			$disciplinaArray[$i] = disciplinaRow($i);
			$eficienciaArray[$i] = eficienciaRow($i);
			$calidadArray[$i] = calidadRow($i);

		}else{
			$r.="<td width=\"4%\" bgcolor=\"#00475c\" class=\"text_mediano_blanco\"><div align=\"center\"></div></td>";
			$asistenciaArray[$i] = asistenciaRow();
			$disciplinaArray[$i] = disciplinaRow();
			$eficienciaArray[$i] = eficienciaRow();
			$calidadArray[$i] = calidadRow();
		}
	}
	return $r;	
}
?>


<?
function asistenciaRow( $id = null ){
  global $fis, $relacion,$re, $fjs, $pes;
  if(!is_null($id))
  return "
    <td  class=\"texto_tareas\">
         <div align=\"left\">
          <table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"3\">
            <tr>
              <td><div align=\"center\">".$fis[$relacion[$id]]."</div></td>
            </tr>
            <tr>
              <td><div align=\"center\">".($fjs[$relacion[$id]]+$pes[$relacion[$id]])."</div></td>
            </tr>
            <tr>
              <td><div align=\"center\">".$re[$relacion[$id]]."</div></td>
            </tr>
          </table>
         </div>
        </td>";

    else return "
    	<td  class=\"texto_tareas\">
         <div align=\"left\">
          <table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"3\">
            <tr>
              <td><div align=\"center\"></div></td>
            </tr>
            <tr>
              <td><div align=\"center\"></div></td>
            </tr>
            <tr>
              <td><div align=\"center\"></div></td>
            </tr>
          </table>
         </div>
        </td>";
}
?>



<?
function disciplinaRow( $id = null ){
	global $dis,$relacion;
	if(!is_null($id))
		return "<td bgcolor=\"#FFFFFF\" class=\"texto_tareas\"><div align=\"center\">".$dis[$relacion[$id]]."</div></td>";
    else 
    	return "<td bgcolor=\"#FFFFFF\" class=\"texto_tareas\"><div align=\"center\"></div></td>";
}
?>



<?
function eficienciaRow( $id = null ){
  global $efi;
  if(!is_null($id))
   	 return "<td class=\"texto_tareas\"><div align=\"center\">".$efi[$id]."</div></td>";
   else
      return "<td class=\"texto_tareas\"><div align=\"center\"></div></td>";
}
?>


<?
function calidadRow($key){
    global $ncr_meta;
    global $ncr_resul;
    global $scrap_meta;
    global $scrap_resul;
    global $snag_meta;
    global $snag_resul;
    
    if(!is_null($key))
       return "
	
<td bgcolor=\"#FFFFFF\" class=\"texto_chico\"><table width=\"100%\" border=\"0\" cellspacing=\"3\" cellpadding=\"0\">
<table width=\"100%\" border=\"0\" cellspacing=\"3\" cellpadding=\"0\">
                      <tr>
                        <td><div align=\"center\">
                          $ncr_meta[$key]
                        </div></td>
                      </tr>
                      <tr>
                        <td bgcolor=\"#EEEEEE\"><div align=\"center\">
                          $ncr_resul[$key]
                        </div></td>
                      </tr>
                      <tr>
                        <td><div align=\"center\">
                          $scrap_meta[$key]
                        </div></td>
                      </tr>
                      <tr>
                        <td bgcolor=\"#EEEEEE\"><div align=\"center\">
                         $scrap_resul[$key]
                        </div></td>
                      </tr>
                      <tr>
                        <td><div align=\"center\">
                          $snag_meta[$key]
                        </div></td>
                      </tr>
                      <tr>
                        <td bgcolor=\"#EEEEEE\"><div align=\"center\">
                         $snag_resul[$key]
                        </div></td>
                      </tr>
                    </table>
                </td>";
 
                else return "
<td bgcolor=\"#FFFFFF\" class=\"texto_chico\"><table width=\"100%\" border=\"0\" cellspacing=\"3\" cellpadding=\"0\">
<table width=\"100%\" border=\"0\" cellspacing=\"3\" cellpadding=\"0\">
                      <tr>
                        <td><div align=\"center\">
                          
                        </div></td>
                      </tr>
                      <tr>
                        <td bgcolor=\"#EEEEEE\"><div align=\"center\">
                          
                        </div></td>
                      </tr>
                      <tr>
                        <td><div align=\"center\">
                          
                        </div></td>
                      </tr>
                      <tr>
                        <td bgcolor=\"#EEEEEE\"><div align=\"center\">
                         
                        </div></td>
                      </tr>
                      <tr>
                        <td><div align=\"center\">
                          
                        </div></td>
                      </tr>
                      <tr>
                        <td bgcolor=\"#EEEEEE\"><div align=\"center\">
                         
                        </div></td>
                      </tr>
                    </table>
                </td>";
}
?>



<?
function htmlEvaluacion(){
	  global $fis, $relacion, $re, $fjs, $pes, $re, $relacion, $dis,
	  $res2, $iks, $verev,
	  $disciplinaArray, $asistenciaArray, $eficienciaArray, $calidadArray, 
	  $resE, $resC, $res;

    global $ncr_meta;
    global $ncr_resul;
    global $scrap_meta;
    global $scrap_resul;
    global $snag_meta;
    global $snag_resul;
    global $efi;

return "
<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">

<html xmlns=\"http://www.w3.org/1999/xhtml\">

<head>

<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />

<title>Bell</title>

<link rel=\"stylesheet\" href=\"colorbox.css\" />

<script src=\"https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js\"></script>

<script src=\"colorbox/jquery.colorbox-min.js\"></script>



<style type=\"text/css\">

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

<link href=\"images/textos.css\" rel=\"stylesheet\" type=\"text/css\" />

<style type=\"text/css\">

<!--

.style17 {font-family: Arial, Helvetica, sans-serif; color: #999999; font-size: 12px; font-weight: bold; }

.style18 {font-size: 14px; color: #404040; text-decoration: none; font-family: \"Helvetica LT Std\";}

.style19 {color: #FFFFFF}

-->

</style>

</head>



<body onload=\"MM_preloadImages('images/b_cambio_r.png','images/b_administracion_r.png','images/b_log_out_r.png')\">

<form id=\"form1\" name=\"form1\" method=\"post\" action=\"\">

  <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">

  <tr>

    <td background=\"\"><table width=\"900\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">

      <tr>

        <td><img src=\"images/header_1.jpg\" width=\"900\" height=\"107\" /></td>

      </tr>

    </table></td>

  </tr>

  <tr>

    <td height=\"698\" valign=\"top\" background=\"\"><table width=\"1020\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">

      <tr>

        <td><img src=\"images/spacer.gif\" width=\"10\" height=\"20\" /></td>

      </tr>

      <tr>

        <td><div align=\"center\">

          <table width=\"850\" border=\"0\" cellspacing=\"7\" cellpadding=\"0\">



            <tr>

              <td><div align=\"center\" class=\"text_mediano\">EVALAUCION DE DESEMPEÑO</div></td>

            </tr>

          </table>

        </div></td>

      </tr>

      <tr>

        <td><img src=\"images/spacer.gif\" width=\"10\" height=\"20\" /></td>

      </tr>

      <tr>

        <td><img src=\"images/spacer.gif\" width=\"10\" height=\"10\" /></td>

      </tr>

      <tr>

        <td><table width=\"1020\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">

          <tr>

            <td height=\"250\" valign=\"top\" bgcolor=\"#eeeeee\"><table width=\"964\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">

              <tr>

                <td><table width=\"100%\" border=\"0\" cellspacing=\"3\" cellpadding=\"0\">

                  <tr>

                    <td colspan=\"2\"><div align=\"center\"><span class=\"style18\"><strong>Tipo de Evaluación:</strong> $res[9]</span></div></td>

                    <td colspan=\"2\"><div align=\"center\"><span class=\"text_mediano\"><span class=\"text_mediano\"><strong>Nivel Actual</strong></span>: </span><span class=\"style18\">$res[14]</span> </div></td>

                    <td colspan=\"2\" class=\"style18\"><div align=\"center\"><span class=\"text_mediano\">Nivel que Aplica:</span>$res[15]</div></td>

                  </tr>

                  <tr>

                    <td colspan=\"2\">&nbsp;</td>

                    <td colspan=\"2\"><div align=\"right\"></div></td>

                    <td colspan=\"2\" class=\"style18\">&nbsp;</td>

                  </tr>

                  <tr>

                    <td colspan=\"2\" bgcolor=\"#FFFFFF\" class=\"style18\">No. y Nombre : </td>

                    <td colspan=\"2\" bgcolor=\"#FFFFFF\" class=\"style18\">Item / Value Stream: </td>

                    <td colspan=\"2\" bgcolor=\"#FFFFFF\" class=\"style18\">Supervisor:</td>

                  </tr>

                  <tr>

                    <td width=\"3%\" class=\"text_mediano\">&nbsp;</td>

                    <td width=\"32%\" class=\"text_mediano\"><span class=\"style18\">$res[0]</span> <span class=\"style18\">$res[1] $res[2] $res[3]</span></td>

                    <td width=\"4%\" class=\"text_mediano\">&nbsp;</td>

                    <td width=\"30%\" class=\"text_mediano\"><span class=\"style18\">$res[16]</span></td>

                    <td width=\"4%\" class=\"text_mediano\">&nbsp;</td>

                    <td width=\"27%\" class=\"text_mediano\"><span class=\"style18\">$res[4]</span></td>

                  </tr>

                  <tr>

                    <td colspan=\"2\" bgcolor=\"#FFFFFF\" class=\"style18\">Periodo de evaluación: </td>

                    <td colspan=\"2\" bgcolor=\"#FFFFFF\" class=\"style18\">IKs que domina: </td>

                    <td colspan=\"2\" bgcolor=\"#FFFFFF\" class=\"style18\">&nbsp;</td>

                  </tr>

                  <tr>

                    <td class=\"text_mediano\">&nbsp;</td>

                    <td class=\"text_mediano\"><span class=\"style18\">$res[5]</span> al <span class=\"style18\">$res[6]</span></td>

                    <td colspan=\"4\" class=\"style18\"> $iks</td>

                    </tr>

                </table></td>

              </tr>

              <tr>

                <td><div align=\"center\"></div></td>

              </tr>

              <tr>

                <td><img src=\"images/spacer.gif\" width=\"10\" height=\"10\" /></td>

              </tr>

              <tr>

                <td height=\"40\" valign=\"bottom\" bgcolor=\"#FFFFFF\" class=\"text_grande\">1.- PRE-REQUISITOS </td>

              </tr>

              <tr>

                <td valign=\"top\"><table width=\"100%\" border=\"2\" cellpadding=\"0\" cellspacing=\"0\">

                  <tr>

                    <td width=\"18%\">&nbsp;</td>

                    <td width=\"19%\"><input name=\"verobjetivos\" type=\"hidden\" id=\"verobjetivos\" />

                      <input name=\"cuantos\" type=\"hidden\" id=\"cuantos\" value=\"$res[23]\" /></td>

                    <td colspan=\"12\"><div align=\"center\" class=\"style17\">Resultados del Periodo de Revisión NORMAL </div></td>

                    <td width=\"15%\"><div align=\"center\"></div></td>

                    </tr>

                  <tr>

                    <td bgcolor=\"#00475c\" class=\"text_mediano_blanco\">Criterios</td>

                    <td bgcolor=\"#00475c\" class=\"text_mediano_blanco\">KPIs</td>
".getMonths($res)."
				  
<td bgcolor=\"#00475c\" class=\"text_mediano_blanco\"><div align=\"center\">Autorizaciones</div></td>
                  <tr >

                    <td  class=\"texto_tareas\"><div align=\"left\">

                      <p><strong>1.- Asistencia</strong><br /> 

                        <span class=\"texto_chico\">Inaistencias y retardos</span></p>

                      </div></td>

                    <td  class=\"texto_tareas\"><table width=\"100%\" border=\"0\" cellspacing=\"3\" cellpadding=\"0\">

                      <tr>

                        <td width=\"15%\" class=\"texto_chico\">Meta:</td>

                        <td width=\"63%\" class=\"texto_chico\">Injustificadas </td>

                        <td width=\"22%\" class=\"texto_tareas\"><div align=\"center\">0</div></td>

                      </tr>

                      <tr>

                        <td class=\"texto_chico\">&nbsp;</td>

                        <td class=\"texto_chico\">Permisos </td>

                        <td class=\"texto_tareas\"><div align=\"center\">7</div></td>

                      </tr>

                      <tr>

                        <td class=\"texto_chico\">&nbsp;</td>

                        <td class=\"texto_chico\">Retardos </td>

                        <td class=\"texto_tareas\"><div align=\"center\">5</div></td>

                      </tr>

                    </table>                      

                      </td>

       $asistenciaArray[1]
       $asistenciaArray[2]
       $asistenciaArray[3]
       $asistenciaArray[4]
       $asistenciaArray[5]
       $asistenciaArray[6]
       $asistenciaArray[7]
       $asistenciaArray[8]
       $asistenciaArray[9]
       $asistenciaArray[10]
       $asistenciaArray[11]
       $asistenciaArray[12]

                    
                    <td rowspan=\"2\" bgcolor=\"#FFFFFF\"  class=\"texto_chico\"><div align=\"center\">

                      <table width=\"88%\" border=\"0\" cellspacing=\"3\" cellpadding=\"0\">
						<tr>

                          <td>$faltas_rh</td>

                          </tr>

					

                        <tr>

                          <td></td>

                        </tr>

						  

                        <tr>

                          <td><div align=\"left\">HRBP:  </div></td>

                        </tr>

                        <tr>

                          <td> $resE[1] <br>($resE[2])</td>

                        </tr>

                        <tr>

                          <td><img src=\"images/spacer.gif\" width=\"10\" height=\"20\" />$resE[26]</td>

                        </tr>

                      </table>

                    </div></td>

                    </tr>

				 

                  <tr>

                    <td bgcolor=\"#FFFFFF\" class=\"texto_tareas\"><p><strong>2.- Disciplina</strong><br />

                        <span class=\"texto_chico\">Suspensiones y medidas disciplinarias                       
                        </span></p>                      </td>

                    <td bgcolor=\"#FFFFFF\" class=\"texto_tareas\"><table width=\"100%\" border=\"0\" cellspacing=\"3\" cellpadding=\"0\">

                      <tr>

                        <td width=\"18%\" valign=\"top\" class=\"texto_chico\">Meta:</td>

                        <td width=\"59%\" class=\"texto_chico\">Suspensiones y medidas disciplinarias </td>

                        <td width=\"23%\"><div align=\"center\" class=\"texto_tareas\">0</div></td>

                      </tr>



                    </table></td>
                    $disciplinaArray[1]
                    $disciplinaArray[2]
                    $disciplinaArray[3]
                    $disciplinaArray[4]
                    $disciplinaArray[5]
                    $disciplinaArray[6]
                    $disciplinaArray[7]
                    $disciplinaArray[8]
                    $disciplinaArray[9]
                    $disciplinaArray[10]
                    $disciplinaArray[11]
                    $disciplinaArray[12]

                  </tr>


                  <tr>

                    <td class=\"texto_tareas\"><strong>3.- Eficiencia</strong><br />

                      <span class=\"texto_chico\">Cumplimiento de meta ind. de eficiencia </span></td>

                    <td class=\"texto_tareas\"><table width=\"100%\" border=\"0\" cellspacing=\"3\" cellpadding=\"0\">

                      <tr>

                        <td width=\"18%\" valign=\"top\" class=\"texto_chico\">Meta:</td>

                        <td width=\"58%\" valign=\"top\" class=\"texto_chico\">Eficiencia Individual </td>

                        <td width=\"24%\">
                            $efi[0]

                          <span class=\"texto_chico\">%</span></td>

                      </tr>

                    </table></td>

                    $eficienciaArray[1]
                    $eficienciaArray[2]
                    $eficienciaArray[3]
                    $eficienciaArray[4]
                    $eficienciaArray[5]
                    $eficienciaArray[6]
                    $eficienciaArray[7]
                    $eficienciaArray[8]
                    $eficienciaArray[9]
                    $eficienciaArray[10]
                    $eficienciaArray[11]
                    $eficienciaArray[12]

                    <td rowspan=\"2\" bgcolor=\"#FFFFFF\" class=\"texto_chico\"> 
                        
                        <table width=\"89%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"3\">
					  <tr>

                        <td>$efi_sup</td>

                      </tr>
                      <tr>

                        <td></td>

                      </tr>
                      <tr>

                        <td><div align=\"left\">Supervisor: </div></td>

                      </tr>

                      <tr>

                        <td>$resE[4] <br>($resE[5])</td>

                      </tr>

                      <tr>

                        <td><img src=\"images/spacer.gif\" width=\"10\" height=\"20\" /></td>

                      </tr>

                    </table></td>

                    </tr>

                  <tr>

                    <td valign=\"top\" bgcolor=\"#FFFFFF\" class=\"texto_tareas\"><strong>4.- Calidad</strong><br />

                      Nivel de defectos individuales <br /></td>

                    <td bgcolor=\"#FFFFFF\" class=\"texto_tareas\"><table width=\"100%\" border=\"0\" cellspacing=\"3\" cellpadding=\"0\">

                      <tr>

                        <td width=\"15%\" class=\"texto_chico\">Meta:</td>

                        <td width=\"66%\" height=\"22\" class=\"texto_chico\"><div align=\"right\">NCR </div></td>

                        </tr>

                      <tr>

                        <td bgcolor=\"#EEEEEE\" class=\"texto_chico\">&nbsp;</td>

                        <td height=\"22\" bgcolor=\"#EEEEEE\" class=\"texto_chico\"><div align=\"right\">Resultados NCR </div></td>

                        </tr>

                      <tr>

                        <td class=\"texto_chico\">Meta:</td>

                        <td height=\"22\" class=\"texto_chico\"><div align=\"right\">Scrap </div></td>

                        </tr>

                      <tr>

                        <td bgcolor=\"#EEEEEE\" class=\"texto_chico\">&nbsp;</td>

                        <td height=\"22\" bgcolor=\"#EEEEEE\" class=\"texto_chico\"><div align=\"right\">Resultados SCRAP </div></td>

                      </tr>

                      <tr>

                        <td class=\"texto_chico\">Meta:</td>

                        <td height=\"22\" class=\"texto_chico\"><div align=\"right\">Snags</div></td>

                      </tr>

                      <tr>

                        <td bgcolor=\"#EEEEEE\" class=\"texto_chico\">&nbsp;</td>

                        <td height=\"22\" bgcolor=\"#EEEEEE\" class=\"texto_chico\"><div align=\"right\">Resultados SNAGS </div></td>

                      </tr>

                    </table></td>

                    
                    $calidadArray[1]
                    $calidadArray[2]
                    $calidadArray[3]
                    $calidadArray[4]
                    $calidadArray[5]
                    $calidadArray[6]
                    $calidadArray[7]
                    $calidadArray[8]
                    $calidadArray[9]
                    $calidadArray[10]
                    $calidadArray[11]
                    $calidadArray[12]

                  </tr>

                </table></td>

              </tr>

              <tr>

                <td><div align=\"center\"><img src=\"images/spacer.gif\" width=\"10\" height=\"20\" /></div></td>

              </tr>


              <tr>

                <td height=\"40\" valign=\"bottom\" bgcolor=\"#FFFFFF\" class=\"text_grande\">2.- VALIDACÓN DE COMPETENCIAS </td>

              </tr>

              <tr>

                <td>

			

				<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"2\" bordercolor=\"#FFFFFF\" bgcolor=\"#FFFFFF\">

                  <tr valign=\"top\" bgcolor=\"#00475c\" class=\"text_mediano_blanco\">

                    <td colspan=\"4\" bgcolor=\"#999999\" class=\"text_mediano_blanco\">Para cada competencia, indicar &quot;SI&quot; en la columna correspondiente si los resultados del empleado coinciden con la definición de la competencia y pueden ser validados</td>

                    </tr>

                  <tr>

                    <td colspan=\"4\" valign=\"top\" bgcolor=\"#00475c\" class=\"text_mediano_blanco\"><span class=\"text_mediano_blanco\">1.- CONOCIMIENTOS TÉCNICOS  (BPS) </span><br>                      <div align=\"center\"></div></td>

                    </tr>
                
					".getRowOn(0)."

					<tr>

                    <td colspan=\"4\" valign=\"top\" bgcolor=\"#00475c\" class=\"text_mediano_blanco\">2.- EFICIENCIA <span class=\"texto_chico style19\">(Validar contra registros de eficiencia)</span><br>                      

                      <div align=\"center\"></div></td>

                    </tr>

                    ".getRowOn(1)."

					<tr>

                    <td colspan=\"4\" valign=\"top\" bgcolor=\"#00475c\" class=\"text_mediano_blanco\">3.-CALIDAD- AUTO INSPECCION<span class=\"text_mediano\">
                     <span class=\"texto_chico style19\">(Validar contra registros de calidad)</span></span><br>                      <div align=\"center\"></div></td>

                    </tr>

                    ".getRowOn(2)."

					<tr>
                    	<td colspan=\"4\" valign=\"top\" bgcolor=\"#00475c\" class=\"text_mediano_blanco\">4.-PREVENCIÓN DE PROBLEMAS DE PRODUCCION <br>
                   		<div align=\"center\"></div></td>
                    </tr>

                    ".getRowOn(3)."

					<tr>

                    <td colspan=\"4\" valign=\"top\" bgcolor=\"#00475c\" class=\"text_mediano_blanco\">5.- SEGURIDAD<br>
                    	<div align=\"center\"></div></td>

                    </tr>

                  

                    ".getRowOn(4)."
                    
					<tr>

                    <td colspan=\"4\" valign=\"top\" bgcolor=\"#00475c\" class=\"text_mediano_blanco\">6.-TRABAJO EN EQUIPO <br>                      <div align=\"center\"></div></td>

                    </tr>

                  

                  <tr>

                    <td valign=\"top\" class=\"text_mediano_blanco\">&nbsp;</td>

                    <td colspan=\"3\" rowspan=\"2\" valign=\"top\" bgcolor=\"#E2E2E2\" class=\"texto_tareas\"><p><span class=\"texto_tareas\"><strong>$texto1[5]</strong></span></p>

                      <p><span class=\"text_mediano\"><span class=\"texto_tareas\">$texto2[5]</span></span></p></td>

                    </tr>

                  <tr>

                    <td valign=\"top\" class=\"text_mediano_blanco\">&nbsp;</td>

                    </tr>

				".getRowOn(5)."

                </table></td>

              </tr>

              <tr>

                <td>&nbsp;</td>

              </tr>

              <tr>

                <td><table width=\"100%\" border=\"0\" cellspacing=\"3\" cellpadding=\"0\">

                  <tr>

                    <td height=\"40\" colspan=\"2\" valign=\"bottom\" bgcolor=\"#FFFFFF\" class=\"text_grande\">3.- Autorizaciones <br />

                      <span class=\"olvido\">Se requiere acreditar las Competencias 1 al 5 para que proceda el cambio de nivel y el cambio de salario.</span></td>

                  </tr>

                  <tr>

                    <td width=\"15%\"><table width=\"100%\" border=\"0\" cellspacing=\"3\" cellpadding=\"0\">

                      <tr>

                        <td width=\"29%\" bgcolor=\"#FFFFFF\" class=\"text_mediano\">Supervisor de Producción </td>

                        </tr>

                      <tr>

                        <td>

                          <div align=\"left\">

                    $resE[6]

                          </div></td></tr>


                    </table></td>

                    <td width=\"16%\" valign=\"top\"><table width=\"100%\" border=\"0\" cellspacing=\"3\" cellpadding=\"0\">

                      <tr>

                        <td width=\"29%\" bgcolor=\"#FFFFFF\" class=\"text_mediano\">
                        	$resE[4] ($resE[7]) </td>

                      </tr>

                      <tr>

                        <td> $resE[8]</td>

                      </tr>

                      <tr>

                        <td>

                          <div align=\"left\">                            

                          </div></td>

                      </tr>

                    </table></td>

                  </tr>

                  <tr>

                    <td><table width=\"100%\" border=\"0\" cellspacing=\"3\" cellpadding=\"0\">

                      <tr>

                        <td width=\"29%\" bgcolor=\"#FFFFFF\" class=\"text_mediano\">Supervisor de Calidad </td>

                      </tr>

                      <tr>

                        <td>

                          <div align=\"left\">
$resE[9]

                              </div></td></tr>

                    </table></td>

                    <td valign=\"top\"><table width=\"100%\" border=\"0\" cellspacing=\"3\" cellpadding=\"0\">

                      <tr>

                        <td width=\"29%\" bgcolor=\"#FFFFFF\" class=\"text_mediano\">
                                                 $resE[15] ($resE[10])

                          </td>

                      </tr>

                      <tr>

                        <td>
                        	$resE[11]
                        </td>

                      </tr>

                      <tr>

                        <td>

                          <div align=\"left\" >
                            

                          </div></td>

                      </tr>

                    </table></td>

                  </tr>

					
					<tr>

                    <td><table width=\"100%\" border=\"0\" cellspacing=\"3\" cellpadding=\"0\">

                      <tr>

                        <td width=\"29%\" bgcolor=\"#FFFFFF\" class=\"text_mediano\">Supervisor de Entrenamiento </td>

                      </tr>

                      <tr>

                        <td>

                          <div align=\"left\">
                          	$resE[12]
                            </div></td></tr>

                    </table></td>

                    <td valign=\"top\"><table width=\"100%\" border=\"0\" cellspacing=\"3\" cellpadding=\"0\">

                      <tr>

                        <td width=\"29%\" bgcolor=\"#FFFFFF\" class=\"text_mediano\">

                          $resE[16] ($resE[13])

                          </td>

                      </tr>

                      <tr>

                        <td>
                        $resE[14]
                    </td>

                      </tr>

                      <tr>

                        <td>

                          <div align=\"left\">

                            

                          </div></td>

                      </tr>

                    </table></td>

                  </tr>

                  <tr>

                    <td colspan=\"2\"><table width=\"100%\" border=\"0\" cellspacing=\"3\" cellpadding=\"0\">

                      <tr>

                        <td width=\"50%\">


						<table width=\"100%\" border=\"0\" cellspacing=\"3\" cellpadding=\"0\">

                          <tr>

                            <td width=\"29%\" bgcolor=\"#FFFFFF\" class=\"text_mediano\">HRBP</td>

                          </tr>

                          <tr>

                            <td><div align=\"center\">

                              <table width=\"100%\" border=\"0\" cellspacing=\"3\" cellpadding=\"0\">

                                <tr>

                                  <td width=\"29%\" bgcolor=\"#FFFFFF\" class=\"text_mediano\"><div align=\"left\">

                                    $resE[17] ($resE[19])
                                  </div></td>
                                </tr>
                                <tr>
                                  <td>
                                    <div align=\"left\">
                                    	$resE[20]

                                    </div></td>

                                </tr>

                                <tr>

                                  <td>
                                  Sueldo Actual: $res[27] 

												Nuevo Autorizado: 

												$resE[24]</td>

                                </tr>

                                <tr>

                                  <td><div align=\"left\">


</div></td>

                                </tr>

                              </table>

                            </div></td>

                          </tr>

                        </table>

												</td>

                        <td width=\"50%\">


						<table width=\"100%\" border=\"0\" cellspacing=\"3\" cellpadding=\"0\">

                          <tr>

                            <td width=\"29%\" bgcolor=\"#FFFFFF\" class=\"text_mediano\">Value Stream Manager </td>

                          </tr>

                          <tr>

                            <td><table width=\"100%\" border=\"0\" cellspacing=\"3\" cellpadding=\"0\">

                              <tr>

                                <td width=\"29%\" bgcolor=\"#FFFFFF\" class=\"text_mediano\">

                                    $resE[18] ($resE[21])

                                  </td>

                              </tr>

                              <tr>

                                <td>$resE[22]</td>

                              </tr>

                              <tr>

                                <td><div align=\"left\">
                                </div></td>

                              </tr>

                            </table></td>

                          </tr>

                        </table>

												</td>

                      </tr>

                    </table></td>

                    </tr>

                  <tr>

                    <td colspan=\"2\"><table width=\"100%\" border=\"0\" cellspacing=\"3\" cellpadding=\"0\">

                      <tr>

                        <td>

                          <table width=\"100%\" border=\"0\" cellspacing=\"3\" cellpadding=\"0\">

                            <tr>

                              <td width=\"29%\" bgcolor=\"#FFFFFF\" class=\"text_mediano\">Gerente de RH </td>

                            </tr>

                            <tr>

                              <td><table width=\"100%\" border=\"0\" cellspacing=\"3\" cellpadding=\"0\">

                                  <tr>

                                    <td width=\"29%\" bgcolor=\"#FFFFFF\" class=\"text_mediano\">
                                         ($resE[25])

                                      </td>

                                  </tr>

                                  <tr>

                                    <td>&nbsp;</td>

                                  </tr>

                                  <tr>

                                    <td><div align=\"left\">
                                        

                                    </div></td>

                                  </tr>

                              </table></td>

                            </tr>

                          </table>

                          </td>

                        <td>&nbsp;</td>

                      </tr>

                    </table></td>

                  </tr>

                  

                </table></td>

              </tr>

              <tr>

                <td><div align=\"center\">

                  <p>&nbsp;                    </p>

                  <p>


                    

                  </p>

                </div></td>

              </tr>

              

            </table></td>

          </tr>

        </table></td>

      </tr>

      <tr>

        <td><img src=\"images/spacer.gif\" width=\"10\" height=\"50\" /></td>

      </tr>

      <tr>

        <td></td>

      </tr>

    </table></td>

  </tr>

</table>
</form>
</body>
</html>";
}
?>





<?

if($_REQUEST['generarPDF']!=""){
  date_default_timezone_set('America/Chihuahua');
  
    require_once(dirname(__FILE__)."/dompdf/dompdf_config.inc.php");
    require_once ("dompdf/include/style.cls.php");
    
      $html= htmlEvaluacion();
      echo "asdf".$html;
      $pdf = new DOMPDF();
      $pdf ->load_html($html);
      $pdf ->render();
      $archivo="pdfs/evaluacion_$verev.pdf";
      file_put_contents($archivo,$pdf->output());
      $pdf ->stream("evaluacion_$verev.pdf");

}

?>