<?
ini_set('error_reporting', E_ALL);
include "coneccion_i.php";
if(isset($_POST['tipo']))
	$tipo=$_POST["tipo"];

if($tipo!="" && $_FILES){
	if(is_uploaded_file($_FILES['file']['tmp_name'])){
		$allowedExtensions = array("xls","xlsx");
		$varr=explode(".", strtolower($_FILES['file']['name']));
		$ext=$varr[1];
		$i=0;
		if(in_array($ext, $allowedExtensions)){
			$nombre=$tipo."_".date('Y-m-d').".$ext";
			if(move_uploaded_file($_FILES['file']['tmp_name'],"archivos/$nombre")){
				require_once('Classes/PHPExcel.php');
				if($ext=='xlsx'){
					require_once('Classes/PHPExcel/Reader/Excel2007.php');
					$objReader = new PHPExcel_Reader_Excel2007();
				}else{
					require_once('Classes/PHPExcel/Reader/Excel5.php');
					$objReader = new PHPExcel_Reader_Excel5();
				}
				$query="update empleados set  estatus_empleado=0";
				//echo"$query <br>";
				$ejecuta=mysqli_query($enlace,$query)or die("Error al insertar l�nea $i $query:".mysqli_error($enlace));
				$objPHPExcel = $objReader->load("archivos/$nombre");
				$objPHPExcel->setActiveSheetIndex(0);
				$i=2;
				$k=0;
				while($objPHPExcel->getActiveSheet()->getCell("A".$i)->getValue() != ''){
							$id = $objPHPExcel->getActiveSheet()->getCell("A".$i)->getValue();
							$nombre = $objPHPExcel->getActiveSheet()->getCell("B".$i)->getValue();
							$fecha_ingreso = $objPHPExcel->getActiveSheet()->getCell("C".$i)->getValue();
							$temp = PHPExcel_Shared_Date::ExcelToPHP($fecha_ingreso);
							$fecha_1 = gmdate('Y-m-d',$temp);
							$fecha_nacimiento = $objPHPExcel->getActiveSheet()->getCell("D".$i)->getValue();
							$temp = PHPExcel_Shared_Date::ExcelToPHP($fecha_nacimiento);
							$fecha_2 = gmdate('Y-m-d',$temp);
							$jefe = $objPHPExcel->getActiveSheet()->getCell("E".$i)->getValue();
							$curp = $objPHPExcel->getActiveSheet()->getCell("F".$i)->getValue();
							$rfc = $objPHPExcel->getActiveSheet()->getCell("G".$i)->getValue();
							$nss = $objPHPExcel->getActiveSheet()->getCell("H".$i)->getValue();
							$puesto = $objPHPExcel->getActiveSheet()->getCell("I".$i)->getValue();
							$categoria = $objPHPExcel->getActiveSheet()->getCell("J".$i)->getValue();

							$categoria = strtoupper(trim($categoria," "));

							//echo"categoria $categoria ";
							
							if($categoria=="ADMINISTRATIVO")
								$cat="1";
							if($categoria=="INDIRECTO" || $categoria=="INDIRECTO ")
								$cat="2";
							if($categoria=="DIRECTO")
								$cat="3";
//echo" $cat <br>";
							$sueldo = $objPHPExcel->getActiveSheet()->getCell("K".$i)->getValue();
							if($sueldo=="NA")
								$sueldo="0";

							$email = $objPHPExcel->getActiveSheet()->getCell("L".$i)->getValue();

							// tipo calendario A ó B
							// Nota: Se agrego columna tipo_calendario en tabla empleados
							$calendario = $objPHPExcel->getActiveSheet()->getCell("M".$i)->getValue();
							if ($calendario == "A" || $calendario == "a") {
								$tipo_calendario = 1;
							}
							if ($calendario == "B" || $calendario == "b") {
								$tipo_calendario = 2;
							}

							/** Tiempo extra */
							$colonia = "N/A";
							if ($objPHPExcel->getActiveSheet()->getCell("N".$i)->getValue() != "") {
								$colonia = $objPHPExcel->getActiveSheet()->getCell("N".$i)->getValue();
							}
							$calle = "N/A";
							if ($objPHPExcel->getActiveSheet()->getCell("O".$i)->getValue() != "") {
								$calle = $objPHPExcel->getActiveSheet()->getCell("O".$i)->getValue();
							}
							$numero = "N/A";
							if ($objPHPExcel->getActiveSheet()->getCell("P".$i)->getValue() != "") {
								$numero = $objPHPExcel->getActiveSheet()->getCell("P".$i)->getValue();
							}
							/** Tiempo extra */ 

							$consulta  = "SELECT id_usuario from empleados where id_usuario=$id ";
							$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1: " );//. mysqli_error($enlace)
							if(@mysqli_num_rows($resultado)>=1)
							{
								$query="update empleados set  nombre='$nombre', fecha_ingreso='$fecha_1', fecha_nacimiento='$fecha_2', id_sup='$jefe', curp='$curp', rfc='$rfc', nss='$nss',puesto='$puesto', categoria='$cat', sueldo='$sueldo', email='$email', tipo_calendario=$tipo_calendario,colonia='$colonia',calle='$calle',numero='$numero',estatus_empleado=1 where id_usuario='$id'";
								//echo"$query <br>";
								$ejecuta=mysqli_query($enlace,$query)or die("Error al insertar l�nea $i $query:".mysqli_error($enlace));
							}
							else{
								$query="insert into empleados(id_usuario, nombre, fecha_ingreso, fecha_nacimiento, id_sup, curp, rfc, nss,puesto, categoria, pass, tipo, sueldo,email,colonia,calle,numero,tipo_calendario,estatus_empleado) VALUES($id,'$nombre','$fecha_1','$fecha_2','$jefe','$curp','$rfc','$nss','$puesto','$cat', '$id',0,$sueldo, '$email','$colonia','$calle','$numero',$tipo_calendario,1)";
								$ejecuta=mysqli_query($enlace,$query)or die("Error al insertar l�nea $i $query:".mysqli_error($enlace));
							}
							
							
					$i++;
				}//while
				
					echo "<script> alert(\"Se insertaron $i registros de $tipo.\");</script>";
			}//if mover archivo
		}//if extension
		else
			echo"<script>alert(\"Solo se permiten archivos con extensi�n $ext\");</script>";
	}else
		echo"<script>alert(\"No se ha podido subir el archivo\");</script>";
	echo"<script>window.location='menu.php';</script>";
}//if tipo
else
	echo"Error";
?>