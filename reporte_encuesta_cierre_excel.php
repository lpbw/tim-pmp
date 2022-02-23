<?php
header("Content-type: application/vnd.ms-excel; name='excel'");
header("Pragma: no-cache");
header("Expires: 0");
header("Content-Disposition: filename=reporte_encuesta_cierre.xls");
//-----------------------------------------------------------------

include "checar_sesion_admin.php";
include "coneccion_i.php";

//para generarlo como excel


$revision=$_GET["revision"];


	
?>

<!-- saved from url=(0014)about:internet -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table width="932" border="0" align="center">
            <tr>
              <td width="100%"><div align="center">
                <table width="100%" border="0" cellpadding="0" id="tablaIngresos">
                 <tr>
				
        <td width="9%" bgcolor="#F0F031" class="text_mediano_blanco"><div align="center">Empleado</div></td>
		<td width="13%" bgcolor="#F0F031" class="text_mediano_blanco"><div align="center">Jefe</div></td>
		<td width="13%" bgcolor="#F0F031" class="text_mediano_blanco"><div align="center">1.- Recibiste retroalimentación de tu resultado en Objetivos?</div></td>
		<td width="11%" bgcolor="#F0F031" class="text_mediano_blanco"><div align="center">2.-Recibiste retroalimentación de tu Evaluación 360°?</div></td>
		<td width="5%" bgcolor="#F0F031" class="text_mediano_blanco"><div align="center">3.-	Recibiste calificación final de desempeño?</div></td>
		<td width="5%" bgcolor="#F0F031" class="text_mediano_blanco">Comentarios</td>
                 </tr>
                  <?	  
	$consulta ="SELECT e.nombre, j.nombre, p1, p2, p3, c.comentarios FROM encuesta_cierre as c inner join usuarios as e on c.id_empleado=e.id inner join usuarios as j on e.id_jefe=j.id where  revision=$revision";			//
	$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1:<br>$consulta<br>----<br> " . mysqli_error($enlace));
	$count=1;
	$color="F1F2F4";
	while(@mysqli_num_rows($resultado)>=$count)
	{
	$res=mysqli_fetch_row($resultado);
		
		?>
                  <tr  bgcolor="#<? echo"$color";?>">
                    
		<td  class="text_mediano"><div align="center"><? echo $res[0];?></div></td>
		<td  class="text_mediano"><div align="center"><? echo $res[1];?></div></td>
		<td  class="text_mediano"><div align="center"><? echo $res[2];?></div></td>
		<td  class="text_mediano"><div align="center"><? echo $res[3]; ?></div></td>
		<td  class="text_mediano"><div align="center"><? echo $res[4];?></div></td>
		<td  class="text_mediano"><div align="center"><? echo $res[5];?></div></td>
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
