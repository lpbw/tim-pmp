<?php

include 'coneccion.php';

// Array que vincula los IDs de los selects declarados en el HTML con el nombre de la tabla donde se encuentra su contenido

$listadoSelects=array(

"objetivo1"=>"objetivo1",

"descripcion1"=>"descripcion1",

"impacto1"=>"impacto1",

"objetivo2"=>"objetivo2",

"descripcion2"=>"descripcion2",

"impacto2"=>"impacto2",

"objetivo3"=>"objetivo3",

"descripcion3"=>"descripcion3",

"impacto3"=>"impacto3",

"objetivo4"=>"objetivo4",

"descripcion4"=>"descripcion4",

"impacto4"=>"impacto4",

"objetivo5"=>"objetivo5",

"descripcion5"=>"descripcion5",

"impacto5"=>"impacto5"



);



function validaSelect($selectDestino)

{

	// Se valida quemysqli_fetch_row(do via GET exista

	global $listadoSelects;

	if(isset($listadoSelects[$selectDestino])) return true;

	else return false;

}



function validaOpcion($opcionSeleccionada)

{

	// Se valida que la opcion seleccionada por el usuario en el select tenga un valor numerico

	if(is_numeric($opcionSeleccionada)) return true;

	else return false;

}



$selectDestino=$_GET["select"]; $opcionSeleccionada=$_GET["opcion"];



if(validaSelect($selectDestino) && validaOpcion($opcionSeleccionada))

{

	if($selectDestino=="descripcion1" || $selectDestino=="descripcion2" || $selectDestino=="descripcion3" || $selectDestino=="descripcion4" || $selectDestino=="descripcion5"){

	

	$consulta=mysqli_query($enlace,"SELECT id, nombre FROM lags WHERE id_io='$opcionSeleccionada'") or die(mysqli_error($enlace));

	?>	

	<select name='descripcion[]' id="<? echo $selectDestino?>" class="texto_tareas" style="width:300px" onChange="cargaContenido(this.id)">

	<option value=''>--Selecciona--</option>

	<?

	while($registro=mysqli_fetch_row($consulta))
mysqli_fetch_row(
	{

		$registro[1]=htmlentities($registro[1]);

	?>

		<option value=" <? echo $registro[0]?>"><? echo $registro[1]?></option>

	<?

	}

	?>			

	</select>mysqli_fetch_row(

	<br/>

	<?

	}else{

		if($selectDestino=="impacto1" || $selectDestino=="impacto2" || $selectDestino=="impacto3" || $selectDestino=="impacto4" || $selectDestino=="impacto5"){

			$consulta=mysqli_query($enlace,"

			SELECT leads.id, leads.nombre FROM lags_leads 

			inner join lags on lags.id=lags_leads.id_lag
mysqli_fetch_row(
			inner join leads on leads.id=lags_leads.id_lead

			where id_lag='$opcionSeleccionada'

			") or die(mysqli_error($enlace));

			$consulta2=mysqli_query($enlace,"

			SELECT leads.id, leads.nombre FROM lags_leads 

			inner join lags on lags.id=lags_leads.id_lag

			inner join leads on leads.id=lags_leads.id_lead

			where id_lag='$opcmysqli_fetch_row(

			") or die(mysqli_error($enlace));

			$consulta3=mysqli_query($enlace,"

			SELECT leads.id, leads.nombre FROM lags_leads 

			inner join lags on lags.id=lags_leads.id_lag

			inner join leads on leads.id=lags_leads.id_lead

			where id_lag='$opcionSeleccionada'

			") or die(mysqli_error($enlace));
mysqli_fetch_row(
			$consulta4=mysqli_query($enlace,"

			SELECT leads.id, leads.nombre FROM lags_leads 

			inner join lags on lags.id=lags_leads.id_lag

			inner join leads on leads.id=lags_leads.id_lead

			where id_lag='$opcionSeleccionada'

			") or die(mysqli_error($enlace));

			$consulta5=mysqli_query($enlace,"

			SELECT leads.id, leads.nombre FROM lags_leads 

			inner join lags on lags.id=lags_leads.id_lag

			inner join leads on leads.id=lags_leads.id_lead

			where id_lag='$opcionSeleccionada'

			") or die(mysqli_error($enlace));

			

			

			 //impacto?>

				<select name="impacto[]" id="impacto1" class="texto_tareas" style="width:230px" onChange="cargaContenido(this.id)">

				<option value="">--Selecciona--</option>

				<?

				while($registro=mysqli_fetch_row($consulta))

				{

				$registro[1]=htmlentities($registro[1]);

				?>

				<option value="<? echo $registro[0]?>"><? echo $registro[1]?></option>

				<?

				}	

				?>		

				</select>

				<input name="ponderacion[]" type="text" class="texto_tareas" id="ponderacion" value="<? echo $pon?>" size="5" /><span class="texto_tareas">%</span>

				<br/>

				<? //impacto2?>

				<select name="impacto2[]" id="impacto2" class="texto_tareas" style="width:230px" onChange="cargaContenido(this.id)">

				<option value="">--Selecciona--</option>

				<?

				while($registro2=mysqli_fetch_row($consulta2))

				{

				$registro2[1]=htmlentities($registro2[1]);

				?>

				<option value="<? echo $registro2[0]?>"><? echo $registro2[1]?></option>

				<?

				}	

				?>		

				</select>

				<input name="ponderacion2[]" type="text" class="texto_tareas" id="ponderacion2" value="<? echo $pon2?>" size="5" /><span class="texto_tareas">%</span>

				<br/>

				<? //impacto3?>

				<select name="impacto3[]" id="impacto3" class="texto_tareas" style="width:230px" onChange="cargaContenido(this.id)">

				<option value="">--Selecciona--</option>

				<?

				while($registro3=mysqli_fetch_row($consulta3))

				{

				$registro3[1]=htmlentities($registro3[1]);

				?>

				<option value="<? echo $registro3[0]?>"><? echo $registro3[1]?></option>

				<?

				}	

				?>		

				</select>

				<input name="ponderacion3[]" type="text" class="texto_tareas" id="ponderacion3" value="<? echo $pon3?>" size="5" /><span class="texto_tareas">%</span>

				<br/>

				<? //impacto4?>

				<select name="impacto4[]" id="impacto4" class="texto_tareas" style="width:230px" onChange="cargaContenido(this.id)">

				<option value="">--Selecciona--</option>

				<?

				while($registro4=mysqli_fetch_row($consulta4))

				{

				$registro4[1]=htmlentities($registro4[1]);

				?>

				<option value="<? echo $registro4[0]?>"><? echo $registro4[1]?></option>

				<?

				}	

				?>		

				</select>

				<input name="ponderacion4[]" type="text" class="texto_tareas" id="ponderacion4" value="<? echo $pon4?>" size="5" /><span class="texto_tareas">%</span>

				<br/>

				<? //impacto5?>

				<select name="impacto5[]" id="impacto5" class="texto_tareas" style="width:230px" onChange="cargaContenido(this.id)">

				<option value="">--Selecciona--</option>

				<?

				while($registro5=mysqli_fetch_row($consulta5))

				{

				$registro5[1]=htmlentities($registro5[1]);

				?>

				<option value="<? echo $registro5[0]?>"><? echo $registro5[1]?></option>

				<?

				}	

				?>		

				</select>

				<input name="ponderacion5[]" type="text" class="texto_tareas" id="ponderacion5" value="<? echo $pon5?>" size="5" /><span class="texto_tareas">%</span>

				<?

				

		}

	}

}

?>