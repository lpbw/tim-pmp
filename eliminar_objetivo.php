<?
    session_start();
    include "checar_sesion_admin.php";
    include "coneccion_i.php";
    $idU=$_SESSION['idU'];
    $id=$_GET["id"];

    $consulta1  = "DELETE FROM acciones_new WHERE id_objetivo = $id";
    $resultado1 = mysqli_query($enlace,$consulta1) or die("La consulta fall&oacute;P1: $consulta1". mysqli_error($enlace) );
    
    $consulta  = "DELETE FROM objetivos_new where id=$id";
    $resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1: $consulta". mysqli_error($enlace));

    echo"<script>window.parent.location=\"objetivos_new.php\";</script>";
?>