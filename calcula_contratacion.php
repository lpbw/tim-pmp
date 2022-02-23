<?
// Programa para calcular la fecha de contratacion respecto al CAREER
include "coneccion_i.php";
$consulta="SELECT id_usuario, from_date FROM `job_history` where is_inside_textron=1 group by id_usuario order by id";
$resultado = mysqli_query($enlace,$consulta);

$count=1;
	  						while(@mysqli_num_rows($resultado)>=$count)
					
						{
								$res=mysqli_fetch_row($resultado);
								echo "$res[0] $res[1] <br/>";
								
								$count++;
						}

?>