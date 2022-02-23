<?php

	include 'coneccion.php';

?>



<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">

<html lang="es">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<title>Objetivos</title>

<link href="images/textos.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" type="text/css" href="select_dependientes_3_niveles.css">



<script type="texmysqli_fetch_row(c="select_dependientes_3_niveles.js"></script>

</head>



<body>

<? for($i=1 ; $i<=5 ; $i++){ ?>

			<div id="demo" style="width:600px;">

			

			<div id="demoIzq">

	<select name="objetivo[]" id="objetivo<? echo $i?>" class="texto_tareas" style="width:300px" onChange="cargaContenido(this.id)">

	<option value="">--Selecciona--</option>

	<?

	$consulta=mysqli_query($enlace,"SELECT id, nombre FROM io_principies");

	while($registro=mysqli_fetch_row($consulta))

	{

	?>

		<option value="<? echo $registro[0]?>"><? echo $registro[1]?></option>

	<? }?>

	</select>

				</div>

				

				<div id="demoMed">

					<select disabled="disabled" name="descripcion[]" class="texto_tareas" style="width:300px" id="descripcion<? echo $i?>">

						<option value="">--Selecciona--</option>

					</select>

				</div>

			

				<div id="demoDer">

					<select disabled="disabled" name="impacto[]" class="texto_tareas" style="width:230px" id="impacto<? echo $i?>">

						<option value="">--Selecciona--</option>

					</select>

					<input name="ponderacion[]" type="text" class="texto_tareas" id="ponderacion" value="<? echo $pon?>" size="5" /><span class="texto_tareas">%</span>

					<br/>

					<select disabled="disabled" name="impacto2[]" class="texto_tareas" style="width:230px" id="impacto<? echo $i?>">

						<option value="">--Selecciona--</option>

					</select>

					<input name="ponderacion2[]" type="text" class="texto_tareas" id="ponderacion2" value="<? echo $pon2?>" size="5" /><span class="texto_tareas">%</span>

					<br/>

					<select disabled="disabled" name="impacto3[]" class="texto_tareas" style="width:230px" id="impacto<? echo $i?>">

						<option value="">--Selecciona--</option>

					</select>

					<input name="ponderacion3[]" type="text" class="texto_tareas" id="ponderacion3" value="<? echo $pon3?>" size="5" /><span class="texto_tareas">%</span>

					<br/>

					<select disabled="disabled" name="impacto4[]" class="texto_tareas" style="width:230px" id="impacto<? echo $i?>">

						<option value="">--Selecciona--</option>

					</select>

					<input name="ponderacion4[]" type="text" class="texto_tareas" id="ponderacion4" value="<? echo $pon4?>" size="5" /><span class="texto_tareas">%</span>

					<br/>

					<select disabled="disabled" name="impacto5[]" class="texto_tareas" style="width:230px" id="impacto<? echo $i?>">

						<option value="">--Selecciona--</option>

					</select>

					<input name="ponderacion5[]" type="text" class="texto_tareas" id="ponderacion5" value="<? echo $pon5?>" size="5" /><span class="texto_tareas">%</span>

					</div>

				</div>

				

			</div>

<? 

echo "-----------------------------------------------------------------------------------";

echo "<br/>";

echo "<br/>";

}?>



</body>

</html>