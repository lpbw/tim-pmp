<?php

include "checar_sesion_admin.php";
include "coneccion_i.php";

    $query = "delete from acciones WHERE id = {$_POST['id']}";
    $result = mysqli_query($enlace,$query) or print("<script>alert('Error al eliminar');</script>");

?>
<script>
    window.location = '<? echo $_SERVER['HTTP_REFERER'];?>';
</script>