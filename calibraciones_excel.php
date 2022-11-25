<?php
header("Content-type: application/vnd.ms-excel; name='excel'");
header("Pragma: no-cache");
header("Expires: 0");
header("Content-Disposition: filename=reporte.xls");
//-----------------------------------------------------------------

include "checar_sesion_admin.php";
include "coneccion_i.php";

//para generarlo como excel


$revision=$_GET["revision"];


	
?>

<!-- saved from url=(0014)about:internet -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table width="790" border="0" align="center">
            <tr>
              <td width="100%"><div align="center">
                <table width="100%" border="0" cellpadding="0" id="tablaIngresos">
                 <tr>
				
        <td width="11%" bgcolor="#F0F031" class="text_mediano_blanco"><div align="center">Empleado</div></td>
		<td width="11%" bgcolor="#F0F031" class="text_mediano_blanco"><div align="center">Jefe</div></td>
		<td width="11%" bgcolor="#F0F031" class="text_mediano_blanco"><div align="center">360</div></td>
		<td width="11%" bgcolor="#F0F031" class="text_mediano_blanco"><div align="center">Obj Ind</div></td>
		<td width="11%" bgcolor="#F0F031" class="text_mediano_blanco"><div align="center">Rating PMP</div></td>
		<td width="11%" bgcolor="#F0F031" class="text_mediano_blanco"><div align="center">Rating Jefe</div></td>
		<td width="11%" bgcolor="#F0F031" class="text_mediano_blanco"><div align="center">Clasificacion</div></td>
		<td width="11%" bgcolor="#F0F031" class="text_mediano_blanco"><div align="center">Puesto</div></td>
		<td width="11%" bgcolor="#F0F031" class="text_mediano_blanco"><div align="center">Calibration Rating</div></td>
		</tr>
                  <?	  
	$consulta ="SELECT planes.id_empleado, jef.id, resultado_calibracion, clasificacion, usu.puesto, planes.resultado_obj_final, planes.resultado_360, resultado_obj FROM `planes` inner join usuarios  as usu on planes.id_empleado=usu.id inner join usuarios as jef  on usu.id_jefe=jef.id where resultado_calibracion <>0 and revision=$revision";			//
	$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1:<br>$consulta<br>----<br> " . mysqli_error($enlace));
	$count=1;
	$color="F1F2F4";
	while(@mysqli_num_rows($resultado)>=$count)
	{
	$res=mysqli_fetch_row($resultado);
	$c=$res[3];
	if($c=="3")
		$c="A";
	else
		if($c=="2")
			$c="M";
		else
		  if($c=="1")
			$c="B";
		  else 
			$c="";
			
			
							if($res[5]<=20){$rating=1;}
							if($res[5]>20 && $res[5]<=60){$rating=2;}
							if($res[5]>60 && $res[5]<=90){$rating=3;}
							if($res[5]>90 && $res[5]<=100){$rating=4;}
		
		?>
                  <tr  bgcolor="#<? echo"$color";?>">
                    
		<td  class="text_mediano"><div align="center"><? echo $res[0];?></div></td>
		<td  class="text_mediano"><div align="center"><? echo $res[1];?></div></td>
		<td  class="text_mediano"><div align="center"><? echo $res[6];?></div></td>
		<td  class="text_mediano"><div align="center"><? echo $res[5];?></div></td>
		<td  class="text_mediano"><div align="center"><? echo $rating;?></div></td>
		<td  class="text_mediano"><div align="center"><? echo $res[7];?></div></td>
		<td  class="text_mediano"><div align="center"><? echo $c; ?></div></td>
		<td  class="text_mediano"><div align="center"><? echo $res[4];?></div></td>
		<td  class="text_mediano"><div align="center"><? echo $res[2];?></div></td>
		</tr>
                  <?
			   if($color=="F1F2F4")
			 	$color="FFFFFF";
			else
				$color="F1F2F4";
			   $count=$count+1;
	}
	

?>
                </table>
              </div></td>
            </tr>
</table>
