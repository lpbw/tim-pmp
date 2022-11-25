<?
include 'coneccion.php';
$id = $_GET['id'];
if ($id != "") {
    $consulta4 = "select new_competencias.c_1,new_competencias.c_2,new_competencias.c_3,new_competencias.c_4,new_competencias.c_5 from new_competencias where id=$id";
    $resultado4 = mysqli_query($enlace,$consulta4) or die("$consulta4  ". mysqli_error($enlace) );
    while($res4=mysqli_fetch_assoc($resultado4)){
        if ($id==6) {
            $descripcion = "<b>Description: </b> No Aplica.";
        }else {
            $descripcion = "<b>Description: </b>".$res4['c_1'].', '.$res4['c_2'].', '.$res4['c_3'].', '.$res4['c_4'].', '.$res4['c_5'];
        }
        
    }
    echo $descripcion;
}

?>